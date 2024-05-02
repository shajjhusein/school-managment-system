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

        // Log to browser console
        if ($user) {
            $userDataJson = json_encode($user);
            echo "<script>console.log('Debug Info: User fetched successfully with ID = $id', $userDataJson);</script>";
        } else {
            echo "<script>console.log('Debug Info: Failed to fetch user with ID = $id');</script>";
        }

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
    // Fetch all classes
    // public function getClasses()
    // {
    //     $stmt = $this->db->prepare("SELECT * FROM classes");
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // Add a class
    public function addClass($name, $section)
    {
        $stmt = $this->db->prepare("INSERT INTO classes (name, section) VALUES (?, ?)");
        $stmt->execute([$name, $section]);
        return $stmt->rowCount() > 0;
    }

    // Update a class
    public function updateClass($id, $name, $section)
    {
        $stmt = $this->db->prepare("UPDATE classes SET name = ?, section = ? WHERE id = ?");
        $stmt->execute([$name, $section, $id]);
        return $stmt->rowCount() > 0;
    }

    // Delete a class
    public function deleteClass($id)
    {
        $stmt = $this->db->prepare("DELETE FROM classes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}
