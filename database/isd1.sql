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
-- Database: `isd1`
--

-- --------------------------------------------------------
-- Create the users table
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Date_of_birth` date NOT NULL,
  `role` enum('director','instructor','student','supervisor') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert new data into the users table with assigned roles
INSERT INTO `users` (`Name`, `email`, `password`, `Date_of_birth`, `role`)
VALUES ('Mhmd', 'mhmd@gmail.com', '1234', '1999-02-01', 'director');

INSERT INTO `users` (`Name`, `email`, `password`, `Date_of_birth`, `role`)
VALUES ('Hassan', 'hassan@gmail.com', '123456', '1999-02-01', 'instructor');

INSERT INTO `users` (`Name`, `email`, `password`, `Date_of_birth`, `role`)
VALUES ('Hsein', 'hsein@gmail.com', '1234', '2006-06-09', 'student');

INSERT INTO `users` (`Name`, `email`, `password`, `Date_of_birth`, `role`)
VALUES ('Ali', 'ali@gmail.com', '123', '2005-09-08', 'student');

INSERT INTO `users` (`Name`, `email`, `password`, `Date_of_birth`, `role`)
VALUES ('Hsn', 'hsn@gmail.com', '1234', '2008-09-08', 'student');

INSERT INTO `users` (`Name`, `email`, `password`, `Date_of_birth`, `role`)
VALUES ('ahmad', 'ahmad@gmail.com', '12345', '2004-01-02', 'supervisor');
--
-- Table structure for table `classe`
--

CREATE TABLE `classe` (
  `Cl_id` int(100) NOT NULL ,
  `Name` varchar(30) NOT NULL,
  `Section` varchar(10) NOT NULL,
  `Super_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classe`
--

INSERT INTO `classe` (`Cl_id`, `Name`, `Section`, `Super_id`) VALUES
(1, 'First Class', 'A', 1),
(2, 'First Class', 'B', 1),
(3, 'First Class', 'c', 1),
(4, 'Second Class', 'B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `Cour_id` int(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Cl_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`Cour_id`, `Name`, `Description`, `Cl_id`) VALUES
(1, 'Math', 'jdbiwoyevdoiw', 1),
(2, 'Physics', 'WREDTFYGUBINOLPMih  ougbiyhv  ihv ', 2),
(3, 'Sports', 'ob  ougbiyhv  ihv ', 1);

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Table structure for table `has`
--

CREATE TABLE `has` (
  `Cour_id` int(100) NOT NULL,
  `Cl_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `Mat_id` int(100) NOT NULL,
  `Content` text NOT NULL,
  `Date_posted` datetime NOT NULL,
  `Cour_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes and assignments`
--

CREATE TABLE `quizzes and assignments` (
  `Qa-_id` int(100) NOT NULL,
  `Date_posted` datetime NOT NULL,
  `Due_date` datetime NOT NULL,
  `Content` text NOT NULL,
  `Cour_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `Sched_id` int(100) NOT NULL,
  `Cl_id` int(100) NOT NULL,
  `Cour_id` int(100) NOT NULL,
  `day` varchar(20) NOT NULL,
  `Start_time` time NOT NULL,
  `End_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `take`
--

CREATE TABLE `take` (
  `St-id` int(100) NOT NULL,
  `Qa_id` int(100) NOT NULL,
  `Grade` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teach_a`
--

CREATE TABLE `teach_a` (
  `Ins_id` int(100) NOT NULL,
  `Cour-id` int(100) NOT NULL,
  `Cl_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`Cl_id`),
  ADD KEY `Super_id` (`Super_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`Cour_id`);

--
-- Indexes for table `has`
--
ALTER TABLE `has`
  ADD PRIMARY KEY (`Cour_id`,`Cl_id`),
  ADD KEY `Cl_id` (`Cl_id`);


-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`Mat_id`),
  ADD KEY `Cour_id` (`Cour_id`);

--
-- Indexes for table `quizzes and assignments`
--
ALTER TABLE `quizzes and assignments`
  ADD PRIMARY KEY (`Qa-_id`),
  ADD KEY `Cour_id` (`Cour_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`Sched_id`),
  ADD KEY `Cl_id` (`Cl_id`),
  ADD KEY `Cour_id` (`Cour_id`);

-- Indexes for table `take`
--
ALTER TABLE `take`
  ADD PRIMARY KEY (`St-id`,`Qa_id`),
  ADD KEY `Qa_id` (`Qa_id`);

--
-- Indexes for table `teach_a`
--
ALTER TABLE `teach_a`
  ADD PRIMARY KEY (`Ins_id`,`Cour-id`,`Cl_id`),
  ADD KEY `Cl_id` (`Cl_id`),
  ADD KEY `Cour-id` (`Cour-id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `Cl_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `Cour_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `Mat_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizzes and assignments`
--
ALTER TABLE `quizzes and assignments`
  MODIFY `Qa-_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `Sched_id` int(100) NOT NULL AUTO_INCREMENT;

