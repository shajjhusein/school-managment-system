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
            LEFT JOIN classe ON classe.id = studentClass.class_id
             WHERE users.role = ?;');
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
    public function addQuiz($dueDate, $content, $courseId)
    {
        try {
            // Get the current date
            $currentDate = date('Y-m-d H:i:s');

            // Prepare the SQL statement to insert quiz data
            $stmt = $this->db->prepare("INSERT INTO quizzes_assignments (date_posted, due_date, content, course_id) VALUES (?, ?, ?, ?)");

            // Execute quiz insertion
            $success = $stmt->execute([$currentDate, $dueDate, $content, $courseId]);

            if ($success) {
                return true; // Return true indicating the overall process was successful
            } else {
                return false; // Return false if the quiz insertion failed
            }
        } catch (PDOException $e) {
            // Consider logging the error instead of displaying it
            error_log("Error adding quiz: " . $e->getMessage());
            return false; // Return false if an error occurred during the database operation
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

    public function getInstructorClassesByUserId($userId)
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare("SELECT DISTINCT c.id, c.name, c.section 
                                    FROM class_course cc
                                    JOIN classe c ON cc.class_id = c.id
                                    JOIN Instructor_courses ic ON cc.course_id = ic.course_id
                                    WHERE ic.user_id = :userId");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            // Consider logging the error instead of displaying it
            error_log("Error fetching instructor classes: " . $e->getMessage());
            return [];
        }
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

    public function getCoursesByClassId($classId)
    {
        $stmt = $this->db->prepare("
        SELECT c.* 
        FROM course c
        JOIN class_course cc ON c.id = cc.course_id
        WHERE cc.class_id = :classId
    ");
        $stmt->execute(['classId' => $classId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function assignCourseToInstructor($instructorId, $courseId, $classId)
    {
        try {
            // First, check if the course is already assigned to this instructor for the specified class
            $checkStmt = $this->db->prepare("SELECT COUNT(*) FROM Instructor_courses WHERE user_id = ? AND course_id = ? AND class_id = ?");
            $checkStmt->execute([$instructorId, $courseId, $classId]);
            $exists = $checkStmt->fetchColumn() > 0;

            if ($exists) {
                // If the assignment already exists, return false or handle as needed
                return false; // No need to reassign the same course to the same instructor for the same class
            }

            // If not already assigned, proceed to insert the new assignment
            $stmt = $this->db->prepare("INSERT INTO Instructor_courses (user_id, course_id, class_id) VALUES (?, ?, ?)");
            $stmt->execute([$instructorId, $courseId, $classId]);
            return true; // Return true to indicate successful assignment
        } catch (PDOException $e) {
            // Log and handle any error during the database operation
            // error_log("Failed to assign course to instructor: " . $e->getMessage());
            return false; // Return false if an error occurs
        }
    }
    public function getCoursesByInstructorAndClass($instructorId, $classId)
    {
        try {
            // Prepare SQL to fetch course details linked through instructor and class
            $stmt = $this->db->prepare("
                SELECT c.id, c.name 
                FROM course AS c
                JOIN Instructor_courses AS ic ON c.id = ic.course_id
                WHERE ic.user_id = :instructorId AND ic.class_id = :classId
            ");

            // Execute the query with bound parameters
            $stmt->bindParam(':instructorId', $instructorId, PDO::PARAM_INT);
            $stmt->bindParam(':classId', $classId, PDO::PARAM_INT);
            $stmt->execute();

            // Fetch and return results
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle potential errors in execution or connection issues
            error_log("Error fetching courses for instructor and class: " . $e->getMessage());
            return [];  // Return an empty array on failure
        }
    }
    public function getStudentsByInstructorAndClass($instructorId, $classId)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT DISTINCT users.id, users.name, users.email,course.name as courseName
                FROM users
                INNER JOIN studentClass ON users.id = studentClass.user_id
                INNER JOIN course ON studentClass.class_id = course.class_id
                INNER JOIN Instructor_courses ON course.id = Instructor_courses.course_id
                WHERE Instructor_courses.user_id = :instructor_id
                AND Instructor_courses.class_id = :class_id
            ");
            $stmt->bindParam(':instructor_id', $instructorId);
            $stmt->bindParam(':class_id', $classId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function getStudentsByInstructorAndClassAndCourse($instructorId, $classId, $course_id)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT DISTINCT users.id, users.name, users.email
                FROM users
                INNER JOIN studentClass ON users.id = studentClass.user_id
                INNER JOIN course ON studentClass.class_id = course.class_id
                INNER JOIN Instructor_courses ON course.id = Instructor_courses.course_id
                WHERE Instructor_courses.user_id = :instructor_id
                AND Instructor_courses.class_id = :class_id
                AND course.id = :course_id

            ");
            $stmt->bindParam(':instructor_id', $instructorId);
            $stmt->bindParam(':class_id', $classId);
            $stmt->bindParam(':course_id', $course_id);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    // public function generateMonthlySchedule($classId)
    // {
    //     try {
    //         // Fetch courses assigned to the class
    //         $stmt = $this->db->prepare("SELECT course_id FROM class_course WHERE class_id = :classId");
    //         $stmt->bindParam(':classId', $classId, PDO::PARAM_INT);
    //         $stmt->execute();
    //         $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         if (empty($courses)) {
    //             return false; // No courses found for the class
    //         }

    //         // Define start times
    //         $startTime = new DateTime('08:00 AM');
    //         $endTime = clone $startTime;
    //         $endTime->modify('+1 hour');

    //         // Generate schedule for one month
    //         $currentDate = new DateTime(); // Today
    //         $endDate = clone $currentDate;
    //         $endDate->modify('+1 month'); // One month from today

    //         while ($currentDate < $endDate) {
    //             $dayOfWeek = $currentDate->format('l'); // 'Monday', 'Tuesday', etc.
    //             if ($dayOfWeek !== 'Saturday' && $dayOfWeek !== 'Sunday') { // Skip weekends
    //                 foreach ($courses as $index => $course) {
    //                     if ($index >= 6) break; // Max 6 sessions per day

    //                     // Insert session into the database
    //                     $insertStmt = $this->db->prepare("INSERT INTO schedule (class_id, course_id, day, start_time, end_time) VALUES (:classId, :courseId, :day, :startTime, :endTime)");
    //                     $insertStmt->bindParam(':classId', $classId);
    //                     $insertStmt->bindParam(':courseId', $course['course_id']);
    //                     $insertStmt->bindParam(':day', $currentDate->format('Y-m-d'));
    //                     $insertStmt->bindParam(':startTime', $startTime->format('H:i:s'));
    //                     $insertStmt->bindParam(':endTime', $endTime->format('H:i:s'));
    //                     $insertStmt->execute();

    //                     // Update start and end times for the next session
    //                     $startTime->modify('+1 hour');
    //                     $endTime->modify('+1 hour');
    //                 }
    //             }

    //             // Reset times for the next day
    //             $startTime->setTime(8, 0);
    //             $endTime->setTime(9, 0);
    //             $currentDate->modify('+1 day'); // Move to the next day
    //         }

    //         return true;
    //     } catch (PDOException $e) {
    //         // Echo a <script> tag with JavaScript that uses console.log
    //         echo "Error generating schedule: " . $e->getMessage();
    //         return false;
    //     }
    // }
    public function generateMonthlySchedule($classId)
    {
        try {
            // Start transaction
            $this->db->beginTransaction();

            // Delete existing schedule records for this class
            $deleteStmt = $this->db->prepare("DELETE FROM schedule WHERE class_id = :classId");
            $deleteStmt->bindParam(':classId', $classId, PDO::PARAM_INT);
            $deleteStmt->execute();

            // Fetch courses assigned to the class
            $stmt = $this->db->prepare("SELECT course_id FROM class_course WHERE class_id = :classId");
            $stmt->bindParam(':classId', $classId, PDO::PARAM_INT);
            $stmt->execute();
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($courses)) {
                $this->db->rollBack(); // Roll back transaction if no courses found
                return false; // No courses found for the class
            }

            // Define start times
            $startTime = new DateTime('08:00 AM');
            $endTime = clone $startTime;
            $endTime->modify('+1 hour');

            // Generate schedule for one month
            $currentDate = new DateTime(); // Today
            $endDate = clone $currentDate;
            $endDate->modify('+1 month'); // One month from today

            while ($currentDate < $endDate) {
                $dayOfWeek = $currentDate->format('l'); // 'Monday', 'Tuesday', etc.
                if ($dayOfWeek !== 'Saturday' && $dayOfWeek !== 'Sunday') { // Skip weekends
                    foreach ($courses as $index => $course) {
                        if ($index >= 6) break; // Max 6 sessions per day

                        // Insert session into the database
                        $insertStmt = $this->db->prepare("INSERT INTO schedule (class_id, course_id, day, start_time, end_time) VALUES (:classId, :courseId, :day, :startTime, :endTime)");
                        $insertStmt->bindParam(':classId', $classId);
                        $insertStmt->bindParam(':courseId', $course['course_id']);
                        $insertStmt->bindParam(':day', $currentDate->format('Y-m-d'));
                        $insertStmt->bindParam(':startTime', $startTime->format('H:i:s'));
                        $insertStmt->bindParam(':endTime', $endTime->format('H:i:s'));
                        $insertStmt->execute();

                        // Update start and end times for the next session
                        $startTime->modify('+1 hour');
                        $endTime->modify('+1 hour');
                    }
                }

                // Reset times for the next day
                $startTime->setTime(8, 0);
                $endTime->setTime(9, 0);
                $currentDate->modify('+1 day'); // Move to the next day
            }

            $this->db->commit(); // Commit transaction
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack(); // Roll back the transaction on error
            echo "Error generating schedule: " . $e->getMessage();
            return false;
        }
    }
    public function getScheduleByClassId($classId)
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare("SELECT s.id, s.day, s.start_time, s.end_time, c.name as course_name 
                                        FROM schedule s 
                                        JOIN course c ON s.course_id = c.id 
                                        WHERE s.class_id = :classId 
                                        ORDER BY s.day, s.start_time");
            $stmt->bindParam(':classId', $classId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Format the results for FullCalendar
            $events = array_map(function ($item) {
                return [
                    'id' => $item['id'],
                    'title' => $item['course_name'], // use course name as the title
                    'start' => $item['day'] . 'T' . $item['start_time'], // Combine date and time for full ISO8601 string
                    'end' => $item['day'] . 'T' . $item['end_time'],
                    'className' => 'bg-info' // Optional: you can use different classes for styling
                ];
            }, $results);

            return $events;
        } catch (PDOException $e) {
            // Consider logging the error instead of displaying it
            error_log("Error fetching schedule: " . $e->getMessage());
            return [];
        }
    }
    public function fetchQuizzesForCourse($courseId)
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare("SELECT * FROM quizzes_assignments WHERE course_id = ?");
            $stmt->execute([$courseId]);
            $quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $quizzes;
        } catch (PDOException $e) {
            // Consider logging the error instead of displaying it
            error_log("Error fetching quizzes for course: " . $e->getMessage());
            return [];
        }
    }
    

    public function getScheduleByUserId($userId)
    {
        try {
            // Prepare SQL statement to fetch class IDs associated with the user
            $stmt = $this->db->prepare("SELECT class_id FROM studentClass WHERE user_id = :userId");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $classIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Initialize an empty array to store the schedule
            $events = [];

            // Iterate through each class to fetch its schedule
            foreach ($classIds as $classId) {
                // Fetch the schedule for the class
                $classSchedule = $this->getScheduleByClassId($classId);

                // Merge the class schedule with the main schedule array
                $events = array_merge($events, $classSchedule);
            }

            // Sort the events by start time
            usort($events, function ($a, $b) {
                return strcmp($a['start'], $b['start']);
            });

            return $events;
        } catch (PDOException $e) {
            // Handle exceptions
            error_log("Error fetching schedule by user ID: " . $e->getMessage());
            return [];
        }
    }

    public function fetchUserCourses($userId)
    {
        try {
            // Prepare the SQL query to fetch user's courses
            $stmt = $this->db->prepare("
            SELECT c.id, c.name, c.description
            FROM studentClass sc
            INNER JOIN class_course cc ON sc.class_id = cc.class_id
            INNER JOIN course c ON cc.course_id = c.id
            WHERE sc.user_id = ?
        ");

            // Execute the query
            $stmt->execute([$userId]);

            // Fetch the results
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $courses;
        } catch (PDOException $e) {
            // Handle PDO exceptions
            echo "<script>console.error('PDO Exception: " . $e->getMessage() . "');</script>";
            return [];
        } catch (Exception $e) {
            // Handle other exceptions
            echo "<script>console.error('Exception: " . $e->getMessage() . "');</script>";
            return [];
        }
    }
    public function getUserClassNameByUserId($userId)
    {
        try {
            // Prepare SQL statement to fetch the class name associated with the user
            $stmt = $this->db->prepare("SELECT classe.name 
                                    FROM studentClass 
                                    JOIN classe ON studentClass.class_id = classe.id 
                                    WHERE studentClass.user_id = :userId");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $className = $stmt->fetchColumn();

            return $className;
        } catch (PDOException $e) {
            // Handle exceptions
            error_log("Error fetching user class name by user ID: " . $e->getMessage());
            return null;
        }
    }
}
