-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2024 at 07:34 PM
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
-- Database: `management`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attRN` int(11) NOT NULL,
  `empID` int(11) NOT NULL,
  `attDate` datetime NOT NULL DEFAULT current_timestamp(),
  `attTimeIn` datetime NOT NULL,
  `attTimeOut` datetime NOT NULL,
  `attStat` varchar(255) NOT NULL DEFAULT 'Cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attRN`, `empID`, `attDate`, `attTimeIn`, `attTimeOut`, `attStat`) VALUES
(1, 1, '2024-10-24 19:11:06', '2024-10-24 19:09:00', '2024-10-24 22:00:00', 'Cancelled'),
(2, 1, '2024-10-24 19:11:52', '2024-10-24 19:11:00', '2024-10-24 20:14:00', 'Cancelled'),
(3, 1, '2024-10-24 19:12:13', '2024-10-24 19:12:00', '2024-10-24 19:16:00', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `depCode` int(11) NOT NULL,
  `depName` varchar(255) NOT NULL,
  `depHead` varchar(255) NOT NULL,
  `depTelNo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`depCode`, `depName`, `depHead`, `depTelNo`) VALUES
(1, 'Accounting', 'Cananua', '09876545678'),
(2, 'HR', 'Rojo', '12343564643'),
(3, 'Marketing', 'Agac Ac', '34567890877');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empID` int(11) NOT NULL,
  `depCode` int(11) NOT NULL,
  `empFName` varchar(255) NOT NULL,
  `empLName` varchar(255) NOT NULL,
  `empRPH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empID`, `depCode`, `empFName`, `empLName`, `empRPH`) VALUES
(1, 1, 'Kerr Harvey', 'Cananua', 500),
(2, 2, 'Trisha Mitch', 'Bantecil', 500),
(3, 1, 'Jhon Rhiel', 'Agac Ac', 500),
(4, 3, 'Niel Dave', 'Gastardo', 500),
(5, 1, 'Joshua', 'Rojo', 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attRN`),
  ADD KEY `empID_FK` (`empID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`depCode`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`),
  ADD KEY `depCode_FK` (`depCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attRN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `depCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12313;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `empID_FK` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `depCode_FK` FOREIGN KEY (`depCode`) REFERENCES `department` (`depCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
