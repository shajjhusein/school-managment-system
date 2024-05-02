<?php

class DatabaseService
{
    private static $instance;
    private $db;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DatabaseService();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $host = '127.0.0.1';
        $dbname = 'isd1';
        $username = 'root';
        $password = 'admin';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->db = new PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function checkUser($email, $password)
    {
        // Prepare the SQL statement to retrieve the user row based on the email
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        // Execute the prepared statement with the provided email
        $stmt->execute([$email]);
        // Fetch the result row
        $user = $stmt->fetch();

        // Convert the PHP array to a JSON string
        $user_json = json_encode($user);

        // Echo a <script> tag with JavaScript that uses console.log
        echo "<script>console.log('PHP to JavaScript:', $user_json);</script>";
        // Check if a user was found and verify the password
        if ($user && $password === $user['password']) {
            return $user;  // Return true if password is correct
        }
        return null;  // Return false if no user is found or password is incorrect
    }

    public function getUsers($role)
    {
        // Check if the role is "director"
        if ($role === 'director') {
            // Prepare the SQL statement to retrieve all users if the role is director
            $stmt = $this->db->prepare('SELECT users.*, classe.name AS class_name
            FROM users
            LEFT JOIN studentClass ON users.id = studentClass.user_id
            LEFT JOIN classe ON classe.id = studentClass.class_id;
            ');
            // Execute the prepared statement without any parameters
            $stmt->execute();
        } else {
            // Prepare the SQL statement to retrieve users based on their specific role
            $stmt = $this->db->prepare('SELECT users.*, classe.name AS class_name
            FROM users
            LEFT JOIN studentClass ON users.id = studentClass.user_id
            LEFT JOIN classe ON classe.id = studentClass.class_id;
             WHERE users.role = ?');
            // Execute the prepared statement with the provided role
            $stmt->execute([$role]);
        }

        // Fetch all result rows as an array of arrays
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Optionally, convert the PHP array to a JSON string for debugging
        // $user_json = json_encode($users);
        // echo "<script>console.log('PHP to JavaScript:', $user_json);</script>";

        // Return the array of users
        return $users;
    }

    public function addUser($name, $email, $password, $role, $date_of_birth, $class)
    {
        // Prepare the SQL statement to insert user data
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, role, date_of_birth) VALUES (?, ?, ?, ?, ?)");
        // Hash the password for security
        // $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Execute user insertion
        $success = $stmt->execute([$name, $email, $password, $role, $date_of_birth]);

        if ($success) {
            // Get the ID of the newly inserted user
            $userId = $this->db->lastInsertId();

            // Check if class is provided and not empty
            if (!empty($class)) {
                // Prepare the SQL statement to insert into studentClass
                $stmtClass = $this->db->prepare("INSERT INTO studentClass (user_id, class_id) VALUES (?, ?)");
                // Execute insertion into studentClass
                $stmtClass->execute([$userId, $class]);
            }

            return true; // Return true indicating the overall process was successful
        } else {
            return false; // Return false if the user insertion failed
        }
    }

    public function getClasses()
    {
        // Prepare the SQL statement to retrieve users based on their specific role
        $stmt = $this->db->prepare('SELECT * FROM classe');
        // Execute the prepared statement with the provided role
        $stmt->execute();
        // Fetch all result rows as an array of arrays
        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the array of classes
        return $classes;
    }

    public function getUserById($id)
    {
        // Updated query to include a JOIN with the studentClass table
        $stmt = $this->db->prepare(
            "SELECT users.*, studentClass.class_id 
            FROM users 
            LEFT JOIN studentClass ON users.id = studentClass.user_id 
            WHERE users.id = ?"
        );
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);  // Fetches the user and class_id as an associative array.
        return $user;
    }

    public function updateUser($id, $name, $email, $password, $role, $date_of_birth, $class)
    {
        // Debug initial input
        echo "<script>console.log('Debug Info: Updating user with ID = $id');</script>";

        // Prepare and execute the main user update
        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ?, password = ?, role = ?, date_of_birth = ? WHERE id = ?");
        $executeSuccess = $stmt->execute([$name, $email, $password, $role, $date_of_birth, $id]);

        // Check and update or insert class
        if (!empty($class)) {
            // First, check if the studentClass record exists
            $stmtCheck = $this->db->prepare("SELECT * FROM studentClass WHERE user_id = ?");
            $stmtCheck->execute([$id]);
            if ($stmtCheck->fetch()) {
                // Update existing studentClass record
                $stmtClass = $this->db->prepare("UPDATE studentClass SET class_id = ? WHERE user_id = ?");
                $stmtClass->execute([$class, $id]);
            } else {
                // Insert new studentClass record
                $stmtClass = $this->db->prepare("INSERT INTO studentClass (user_id, class_id) VALUES (?, ?)");
                $stmtClass->execute([$id, $class]);
            }
        }

        // Debug SQL statement execution result
        echo "<script>console.log('Debug Info: Statement execute success = $executeSuccess');</script>";

        return $executeSuccess;
    }
    public function deleteUser($id)
    {
        try {
            // Prepare a DELETE statement
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");

            // Execute the deletion
            $stmt->execute([$id]);

            // Check if the deletion was successful
            if ($stmt->rowCount() > 0) {
                // Optionally, you might want to handle related data deletions here
                // For example, deleting user roles, settings, etc., associated with the user
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle any SQL errors
            return false;
        }
    }
    public function getClassById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM classe WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching class: " . $e->getMessage());
            return null;
        }
    }
    // Add a class
    public function addClass($name, $section)
    {
        $stmt = $this->db->prepare("INSERT INTO classe (name, section) VALUES (?, ?)");
        $stmt->execute([$name, $section]);
        return $stmt->rowCount() > 0;
    }

    // Update a class
    public function updateClass($id, $name, $section)
    {
        $stmt = $this->db->prepare("UPDATE classe SET name = ?, section = ? WHERE id = ?");
        $stmt->execute([$name, $section, $id]);
        return $stmt->rowCount() > 0;
    }

    // Delete a class
    public function deleteClass($id)
    {
        $stmt = $this->db->prepare("DELETE FROM classe WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    public function getCourses()
    {
        $stmt = $this->db->prepare("SELECT * FROM course");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCourse($name, $description)
    {
        $stmt = $this->db->prepare("INSERT INTO course (name, description) VALUES (?, ?)");
        $stmt->execute([$name, $description]);
        return $stmt->rowCount() > 0;
    }

    public function updateCourse($id, $name, $description)
    {
        $stmt = $this->db->prepare("UPDATE course SET name = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $description, $id]);
        return $stmt->rowCount() > 0;
    }

    public function deleteCourse($id)
    {
        $stmt = $this->db->prepare("DELETE FROM course WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    public function getCourseById($id)
    {
        try {
            // Prepare the SQL query to retrieve the course row based on the provided ID
            $stmt = $this->db->prepare("SELECT * FROM course WHERE id = ?");
            // Execute the prepared statement with the provided course ID
            $stmt->execute([$id]);
            // Fetch the result row
            return $stmt->fetch(PDO::FETCH_ASSOC);  // Fetches the course as an associative array.
        } catch (PDOException $e) {
            // If there's a PDO exception, log the error message
            error_log("Error fetching course: " . $e->getMessage());
            return null;  // Return null if an error occurs
        }
    }

    public function getAssignedCourses($class_id)
    {
        $stmt = $this->db->prepare("SELECT course.id, course.name,course.description  FROM course JOIN class_course ON course.id = class_course.course_id WHERE class_course.class_id = ?");
        $stmt->execute([$class_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeCourseFromClass($course_id, $class_id)
    {
        $stmt = $this->db->prepare("DELETE FROM class_course WHERE course_id = ? AND class_id = ?");
        $stmt->execute([$course_id, $class_id]);
        return $stmt->rowCount() > 0;
    }

    public function assignCourseToClass($courseId, $classId)
    {
        try {
            // First, check if the course is already assigned to the class
            $checkStmt = $this->db->prepare("SELECT COUNT(*) FROM class_course WHERE class_id = ? AND course_id = ?");
            $checkStmt->execute([$classId, $courseId]);
            $exists = $checkStmt->fetchColumn() > 0;

            if ($exists) {
                // Return a specific value or throw an exception if the course is already assigned
                return false; // Indicates that the course is already assigned
            }

            // If not already assigned, proceed to insert the new assignment
            $stmt = $this->db->prepare("INSERT INTO class_course (class_id, course_id) VALUES (?, ?)");
            $stmt->execute([$classId, $courseId]);
            return true; // Return true to indicate successful assignment
        } catch (PDOException $e) {
            // Log and handle any error during the database operation
            error_log("Failed to assign course to class: " . $e->getMessage());
            return false; // Return false if an error occurs
        }
    }
}
