-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 05:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: isd1
--
-- --------------------------------------------------------
-- Create the users table
CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  date_of_birth date NOT NULL,
  role enum('director','instructor','student','supervisor') NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert new data into the users table with assigned roles
INSERT INTO users (Name, email, password, date_of_birth, role)
VALUES ('Mhmd', 'mhmd@gmail.com', '1234', '1999-02-01', 'director');

INSERT INTO users (Name, email, password, date_of_birth, role)
VALUES ('Hassan', 'hassan@gmail.com', '123456', '1999-02-01', 'instructor');

INSERT INTO users (Name, email, password, date_of_birth, role)
VALUES ('Hsein', 'hsein@gmail.com', '1234', '2006-06-09', 'student');

INSERT INTO users (Name, email, password, date_of_birth, role)
VALUES ('Ali', 'ali@gmail.com', '123', '2005-09-08', 'student');

INSERT INTO users (Name, email, password, date_of_birth, role)
VALUES ('Hsn', 'hsn@gmail.com', '1234', '2008-09-08', 'student');

INSERT INTO users (Name, email, password, date_of_birth, role)
VALUES ('ahmad', 'ahmad@gmail.com', '12345', '2004-01-02', 'supervisor');

--
-- Table structure for table studentClass
--

CREATE TABLE studentClass (
  id int(100) NOT NULL,
  user_id varchar(30) NOT NULL,
  class_id varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table classe
--

CREATE TABLE classe (
  id int(100) NOT NULL ,
  name varchar(30) NOT NULL,
  section varchar(10) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table classe
--

INSERT INTO classe (id, name, section, user_id) VALUES
(1, 'First Class', 'A', 1),
(2, 'Second Class', 'B', 1),
(3, 'First Class', 'c', 1),
(4, 'Second Class', 'B', 1);

-- --------------------------------------------------------

--
-- Table structure for table course
--

CREATE TABLE course (
  id int(100) NOT NULL,
  name varchar(100) NOT NULL,
  description text NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table course
--

INSERT INTO course (id, name, description, class_id) VALUES
(1, 'Math', 'jdbiwoyevdoiw', 1),
(2, 'Physics', 'WREDTFYGUBINOLPMih  ougbiyhv  ihv ', 2),
(3, 'Sports', 'ob  ougbiyhv  ihv ', 1);

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Table structure for table class_course
--

CREATE TABLE class_course (
  course_id int(100) NOT NULL,
  class_id int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table materials
--

CREATE TABLE materials (
  id int(100) NOT NULL,
  content text NOT NULL,
  cate_posted datetime NOT NULL,
  course_id int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table quizzes and assignments
--

CREATE TABLE quizzes_assignments (
  id int(100) NOT NULL,
  date_posted datetime NOT NULL,
  due_date datetime NOT NULL,
  content text NOT NULL,
  course_id int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table schedule
--

CREATE TABLE schedule (
  id int(100) NOT NULL,
  class_id int(100) NOT NULL,
  course_id int(100) NOT NULL,
  day varchar(20) NOT NULL,
  start_time time NOT NULL,
  end_time time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table student_quiz
--

CREATE TABLE student_quiz (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(100) NOT NULL,
  quiz_id int(100) NOT NULL,
  grade int(10) NOT NULL,
   PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table supervisor_classes
--

CREATE TABLE supervisor_classes (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(100) NOT NULL,
  class_id int(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Table structure for table Instructor_courses
--

CREATE TABLE Instructor_courses (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(100) NOT NULL,
  course_id int(100) NOT NULL,
  class_id int(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table classe
--
ALTER TABLE classe
  ADD PRIMARY KEY (id),
  ADD KEY user_id (user_id);

--
-- Indexes for table course
--
ALTER TABLE course
  ADD PRIMARY KEY (id);

--
-- Indexes for table class_course
--
ALTER TABLE class_course
  ADD PRIMARY KEY (course_id,class_id),
  ADD KEY class_id (class_id);


-- Indexes for table materials
--
ALTER TABLE materials
  ADD PRIMARY KEY (id),
  ADD KEY course_id (Course_id);

--
-- Indexes for table quizzes and assignments
--
ALTER TABLE quizzes_assignments
  ADD PRIMARY KEY (id),
  ADD KEY course_id (course_id);

--
-- Indexes for table schedule
--
ALTER TABLE schedule
  ADD PRIMARY KEY (id),
  ADD KEY classid (class_id),
  ADD KEY course_id (course_id);

-- Indexes for table student_quiz
--
ALTER TABLE student_quiz
  ADD PRIMARY KEY (user_id,quiz_id),
  ADD KEY quiz_id (quiz_id);

--
-- Indexes for table teach_a
--
ALTER TABLE teach_a
  ADD PRIMARY KEY (user_id,course_id,class_id),
  ADD KEY class_id (class_id),
  ADD KEY course_id (course_id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table classe
--
ALTER TABLE classe
  MODIFY id int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table course
--
ALTER TABLE course
  MODIFY id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table materials
--
ALTER TABLE materials
  MODIFY id int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table quizzes and assignments
--
ALTER TABLE quizzes_assignments
  MODIFY id int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table schedule
--
ALTER TABLE schedule
  MODIFY id int(100) NOT NULL AUTO_INCREMENT;


--
-- TODO
--

ALTER TABLE courses
MODIFY COLUMN class_id INT DEFAULT NULL;