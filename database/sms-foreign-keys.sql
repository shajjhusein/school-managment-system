SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Create users table and insert mock data
CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  date_of_birth date NOT NULL,
  role enum('director','instructor','student','supervisor') NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users (name, email, password, date_of_birth, role) VALUES
('John Doe', 'john.doe@gmail.com', 'password123', '1980-05-15', 'director'),
('Jane Smith', 'jane.smith@gmail.com', 'password456', '1985-07-20', 'instructor'),
('Alice Johnson', 'alice.johnson@gmail.com', 'password789', '2000-08-25', 'student'),
('Bob Brown', 'bob.brown@gmail.com', 'password321', '2001-11-30', 'student'),
('Charlie Davis', 'charlie.davis@gmail.com', 'password654', '2002-02-05', 'student'),
('David Wilson', 'david.wilson@gmail.com', 'password987', '1990-03-10', 'supervisor');

-- Create student_class table and insert mock data
CREATE TABLE student_class (
  id int(100) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  class_id int(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO student_class (user_id, class_id) VALUES
(3, 1),
(4, 1),
(5, 2);

-- Create class table and insert mock data
CREATE TABLE class (
  id int(100) NOT NULL AUTO_INCREMENT,
  name varchar(30) NOT NULL,
  section varchar(10) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO class (id, name, section) VALUES
(1, 'Math 101', 'A'),
(2, 'Physics 101', 'B'),
(3, 'Chemistry 101', 'C'),
(4, 'Biology 101', 'D');

-- Create course table and insert mock data
CREATE TABLE course (
  id int(100) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  description text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO course (id, name, description) VALUES
(1, 'Algebra', 'Introduction to Algebra'),
(2, 'Classical Mechanics', 'Fundamentals of Physics'),
(3, 'Organic Chemistry', 'Basics of Organic Chemistry');

-- Create class_course table and insert mock data
CREATE TABLE class_course (
  course_id int(100) NOT NULL,
  class_id int(100) NOT NULL,
  PRIMARY KEY (course_id, class_id),
  KEY class_id (class_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO class_course (course_id, class_id) VALUES
(1, 1),
(2, 2),
(3, 3);

-- Create materials table and insert mock data
CREATE TABLE materials (
  id int(100) NOT NULL AUTO_INCREMENT,
  content text NOT NULL,
  cate_posted datetime NOT NULL,
  course_id int(100) NOT NULL,
  PRIMARY KEY (id),
  KEY course_id (course_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO materials (content, cate_posted, course_id) VALUES
('Algebra Chapter 1', '2024-04-23 09:00:00', 1),
('Classical Mechanics Lecture 1', '2024-04-23 10:00:00', 2),
('Organic Chemistry Lab 1', '2024-04-23 11:00:00', 3);

-- Create quizzes_assignments table and insert mock data
CREATE TABLE quizzes_assignments (
  id int(100) NOT NULL AUTO_INCREMENT,
  date_posted datetime NOT NULL,
  due_date datetime NOT NULL,
  content text NOT NULL,
  course_id int(100) NOT NULL,
  PRIMARY KEY (id),
  KEY course_id (course_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO quizzes_assignments (date_posted, due_date, content, course_id) VALUES
('2024-04-23 09:00:00', '2024-05-01 09:00:00', 'Algebra Quiz 1', 1),
('2024-04-23 10:00:00', '2024-05-01 10:00:00', 'Classical Mechanics Assignment 1', 2),
('2024-04-23 11:00:00', '2024-05-01 11:00:00', 'Organic Chemistry Quiz 1', 3);

-- Create schedule table and insert mock data
CREATE TABLE schedule (
  id int(100) NOT NULL AUTO_INCREMENT,
  class_id int(100) NOT NULL,
  course_id int(100) NOT NULL,
  day varchar(20) NOT NULL,
  start_time time NOT NULL,
  end_time time NOT NULL,
  PRIMARY KEY (id),
  KEY class_id (class_id),
  KEY course_id (course_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO schedule (class_id, course_id, day, start_time, end_time) VALUES
(1, 1, 'Monday', '09:00:00', '10:00:00'),
(2, 2, 'Tuesday', '10:00:00', '11:00:00'),
(3, 3, 'Wednesday', '11:00:00', '12:00:00');

-- Create student_quiz table and insert mock data
CREATE TABLE student_quiz (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(100) NOT NULL,
  quiz_id int(100) NOT NULL,
  grade int(10) NOT NULL,
  PRIMARY KEY (id),
  KEY quiz_id (quiz_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO student_quiz (user_id, quiz_id, grade) VALUES
(3, 1, 85),
(4, 2, 90),
(5, 3, 75);

-- Create supervisor_classes table and insert mock data
CREATE TABLE supervisor_classes (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(100) NOT NULL,
  class_id int(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO supervisor_classes (user_id, class_id) VALUES
(6, 1),
(6, 2);

-- Create Instructor_courses table and insert mock data
CREATE TABLE Instructor_courses (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(100) NOT NULL,
  course_id int(100) NOT NULL,
  class_id int(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO Instructor_courses (user_id, course_id, class_id) VALUES
(2, 1, 1),
(2, 2, 2);

-- Add Foreign Key Constraints
ALTER TABLE student_class
ADD CONSTRAINT FK_studentClass_user FOREIGN KEY (user_id) REFERENCES users(id),
ADD CONSTRAINT FK_studentClass_class FOREIGN KEY (class_id) REFERENCES class(id);

ALTER TABLE class_course
ADD CONSTRAINT FK_classCourse_course FOREIGN KEY (course_id) REFERENCES course(id),
ADD CONSTRAINT FK_classCourse_class FOREIGN KEY (class_id) REFERENCES class(id);

ALTER TABLE materials
ADD CONSTRAINT FK_materials_course FOREIGN KEY (course_id) REFERENCES course(id);

ALTER TABLE quizzes_assignments
ADD CONSTRAINT FK_quizzesAssignments_course FOREIGN KEY (course_id) REFERENCES course(id);

ALTER TABLE schedule
ADD CONSTRAINT FK_schedule_class FOREIGN KEY (class_id) REFERENCES class(id),
ADD CONSTRAINT FK_schedule_course FOREIGN KEY (course_id) REFERENCES course(id);

ALTER TABLE student_quiz
ADD CONSTRAINT FK_studentQuiz_user FOREIGN KEY (user_id) REFERENCES users(id),
ADD CONSTRAINT FK_studentQuiz_quiz FOREIGN KEY (quiz_id) REFERENCES quizzes_assignments(id);

ALTER TABLE supervisor_classes
ADD CONSTRAINT FK_supervisorClasses_user FOREIGN KEY (user_id) REFERENCES users(id),
ADD CONSTRAINT FK_supervisorClasses_class FOREIGN KEY (class_id) REFERENCES class(id);

ALTER TABLE Instructor_courses
ADD CONSTRAINT FK_instructorCourses_user FOREIGN KEY (user_id) REFERENCES users(id),
ADD CONSTRAINT FK_instructorCourses_course FOREIGN KEY (course_id) REFERENCES course(id),
ADD CONSTRAINT FK_instructorCourses_class FOREIGN KEY (class_id) REFERENCES class(id);

COMMIT;
