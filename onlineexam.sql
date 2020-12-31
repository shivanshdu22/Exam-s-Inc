-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 31, 2020 at 12:32 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `PHPTEST`
--

CREATE TABLE `PHPTEST` (
  `id` int(11) NOT NULL,
  `Question` varchar(30) DEFAULT NULL,
  `op1` varchar(30) DEFAULT NULL,
  `op2` varchar(30) DEFAULT NULL,
  `op3` varchar(30) DEFAULT NULL,
  `op4` varchar(30) DEFAULT NULL,
  `correct` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PHPTEST`
--

INSERT INTO `PHPTEST` (`id`, `Question`, `op1`, `op2`, `op3`, `op4`, `correct`) VALUES
(1, 'What is my name?', '1', '2', '3', 'shiv', '1'),
(4, 'What is life?', 'a', 'b', '2', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `PHPTEST1`
--

CREATE TABLE `PHPTEST1` (
  `id` int(11) NOT NULL,
  `Question` varchar(30) DEFAULT NULL,
  `op1` varchar(30) DEFAULT NULL,
  `op2` varchar(30) DEFAULT NULL,
  `op3` varchar(30) DEFAULT NULL,
  `op4` varchar(30) DEFAULT NULL,
  `correct` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PHPTEST1`
--

INSERT INTO `PHPTEST1` (`id`, `Question`, `op1`, `op2`, `op3`, `op4`, `correct`) VALUES
(2, 'What is my name?', 'a', 'b', 'c', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `PHPTEST12`
--

CREATE TABLE `PHPTEST12` (
  `id` int(11) NOT NULL,
  `Question` varchar(30) DEFAULT NULL,
  `op1` varchar(30) DEFAULT NULL,
  `op2` varchar(30) DEFAULT NULL,
  `op3` varchar(30) DEFAULT NULL,
  `op4` varchar(30) DEFAULT NULL,
  `correct` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `Name`) VALUES
(2, 'PHP');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `Test_ID` int(15) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`Test_ID`, `Name`, `Category`) VALUES
(8, 'PHP TEST', 'PHP'),
(12, 'PHP TEST1', 'PHP'),
(14, 'PHP TEST12', 'PHP');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(15) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Role` varchar(20) NOT NULL DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `Username`, `Password`, `Email`, `Role`) VALUES
(1, 'Shivansh', '123', 'shiv@mail.com', 'Admin'),
(2, 'tufail', 'Tufail123', 'apaperboat2@gmail.com', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `PHPTEST`
--
ALTER TABLE `PHPTEST`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `PHPTEST1`
--
ALTER TABLE `PHPTEST1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `PHPTEST12`
--
ALTER TABLE `PHPTEST12`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`Test_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `PHPTEST`
--
ALTER TABLE `PHPTEST`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `PHPTEST1`
--
ALTER TABLE `PHPTEST1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `PHPTEST12`
--
ALTER TABLE `PHPTEST12`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `Test_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
