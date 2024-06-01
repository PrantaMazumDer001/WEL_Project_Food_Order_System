-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 09:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `khulna_tour`
--

CREATE TABLE `khulna_tour` (
  `Roll` int(10) UNSIGNED NOT NULL,
  `Name` varchar(15) NOT NULL,
  `Class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khulna_tour`
--

INSERT INTO `khulna_tour` (`Roll`, `Name`, `Class`) VALUES
(1, 'Pranta', 11),
(4, 'Fatema', 9),
(5, 'Rekha', 10);

-- --------------------------------------------------------

--
-- Table structure for table `rajshahi_tour`
--

CREATE TABLE `rajshahi_tour` (
  `Roll` int(11) NOT NULL,
  `Name` varchar(15) NOT NULL,
  `Class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rajshahi_tour`
--

INSERT INTO `rajshahi_tour` (`Roll`, `Name`, `Class`) VALUES
(1, 'Pranta', 11),
(2, 'Ali', 9),
(3, 'Oyshy', 7);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Roll` int(5) UNSIGNED NOT NULL,
  `Name` varchar(15) NOT NULL,
  `Age` int(5) NOT NULL,
  `Gander` varchar(11) NOT NULL,
  `GPA` double(3,2) NOT NULL,
  `City` varchar(15) NOT NULL,
  `DOB` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Roll`, `Name`, `Age`, `Gander`, `GPA`, `City`, `DOB`) VALUES
(1, 'Pranta', 19, 'Male', 5.00, 'Rangamati', '2024-01-30 00:00:00'),
(2, 'Oyshy', 21, 'Female', 4.58, 'Chittagong', '2024-01-30 00:00:00'),
(3, 'Oyshe', 19, 'Male', 4.33, 'Cumilla', '2024-01-30 00:00:00'),
(4, 'Rekha', 17, 'female', 4.11, 'Khulna', '2024-01-30 00:00:00'),
(5, 'Fatema', 21, 'Female', 4.57, 'Dhaka', '2024-01-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_result`
--

CREATE TABLE `student_result` (
  `Course_Code` int(11) NOT NULL,
  `Roll` int(11) NOT NULL,
  `Subject` varchar(15) DEFAULT NULL,
  `Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_result`
--

INSERT INTO `student_result` (`Course_Code`, `Roll`, `Subject`, `Number`) VALUES
(1414225, 7, 'English', 77),
(20191601, 1, 'Math', 95),
(20191602, 2, 'Accounting', 75),
(20191603, 1, 'Physics', 99),
(20191604, 1, 'Chemistry', 91),
(20191605, 3, 'Biology', 85);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_view`
-- (See below for the actual view)
--
CREATE TABLE `student_view` (
`Roll` int(5) unsigned
,`Name` varchar(15)
,`GPA` double(3,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(15) DEFAULT NULL,
  `salary` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `student_view`
--
DROP TABLE IF EXISTS `student_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_view`  AS SELECT `student`.`Roll` AS `Roll`, `student`.`Name` AS `Name`, `student`.`GPA` AS `GPA` FROM `student` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `khulna_tour`
--
ALTER TABLE `khulna_tour`
  ADD PRIMARY KEY (`Roll`);

--
-- Indexes for table `rajshahi_tour`
--
ALTER TABLE `rajshahi_tour`
  ADD PRIMARY KEY (`Roll`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Roll`);

--
-- Indexes for table `student_result`
--
ALTER TABLE `student_result`
  ADD PRIMARY KEY (`Course_Code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `khulna_tour`
--
ALTER TABLE `khulna_tour`
  MODIFY `Roll` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rajshahi_tour`
--
ALTER TABLE `rajshahi_tour`
  MODIFY `Roll` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_result`
--
ALTER TABLE `student_result`
  MODIFY `Course_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20191606;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
