-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 26, 2022 at 09:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `education`
--

-- --------------------------------------------------------

--
-- Table structure for table `course_tb`
--

CREATE TABLE `course_tb` (
  `course_id` int(8) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `min_cap` tinyint(4) NOT NULL,
  `max_cap` tinyint(4) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enroll_tb`
--

CREATE TABLE `enroll_tb` (
  `course_id` int(8) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `student_id` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `marks_tb`
--

CREATE TABLE `marks_tb` (
  `student_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(8) NOT NULL,
  `mark` float DEFAULT NULL,
  `comment` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `vaccine` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `country` varchar(20) DEFAULT NULL,
  `position` varchar(20) NOT NULL,
  `salt` varchar(20) NOT NULL,
  `user_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_tb`
--
ALTER TABLE `course_tb`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `teacher_id_FK` (`teacher_id`);

--
-- Indexes for table `enroll_tb`
--
ALTER TABLE `enroll_tb`
  ADD KEY `student_FK` (`student_id`),
  ADD KEY `course2_FK` (`course_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `marks_tb`
--
ALTER TABLE `marks_tb`
  ADD KEY `course_FK` (`course_id`),
  ADD KEY `teacher_FK` (`teacher_id`),
  ADD KEY `user_id_FK` (`student_id`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_tb`
--
ALTER TABLE `course_tb`
  ADD CONSTRAINT `teacher_id_FK` FOREIGN KEY (`teacher_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enroll_tb`
--
ALTER TABLE `enroll_tb`
  ADD CONSTRAINT `student_FK` FOREIGN KEY (`student_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marks_tb`
--
ALTER TABLE `marks_tb`
  ADD CONSTRAINT `course_FK` FOREIGN KEY (`course_id`) REFERENCES `course_tb` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_FK` FOREIGN KEY (`teacher_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_FK` FOREIGN KEY (`student_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
