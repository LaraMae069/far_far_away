-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2026 at 12:05 PM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `far_far_away`
--

-- --------------------------------------------------------

--
-- Table structure for table `grading_system`
--

CREATE TABLE `grading_system` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grading_system`
--

INSERT INTO `grading_system` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123'),
(2, 'maisarah', 'maisarah123'),
(3, 'farhan', 'farhan123'),
(4, 'johann', 'johann123'),
(5, 'adam', 'adam123'),
(6, 'aisya', 'aisya123');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `matric_no` varchar(50) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `test1` decimal(5,2) DEFAULT NULL,
  `test2` decimal(5,2) DEFAULT NULL,
  `final_exam` decimal(5,2) DEFAULT NULL,
  `total_marks` decimal(5,2) DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `student_name`, `matric_no`, `subject_name`, `subject_code`, `test1`, `test2`, `final_exam`, `total_marks`, `grade`) VALUES
(1, 'Aiman bin Abu', 'MAHSA01', 'Pengaturcaraan Web', 'WEB2101', 24.50, 26.00, 42.00, 92.50, 'A'),
(2, 'Siti Nur Aishah binti Rahman', 'MAHSA02', 'Interaksi Manusia-Komputer', 'IMK3202', 21.00, 23.50, 38.00, 82.50, 'A'),
(3, 'Muhammad Farhan bin Zulkifli', 'MAHSA03', 'Animasi 3D dan Pemodelan', 'ANI3103', 25.00, 27.50, 45.00, 97.50, 'A'),
(4, 'Nurul Ain binti Hassan', 'MAHSA04', 'Pembangunan Aplikasi Mudah Alih', 'MMS4104', 18.50, 20.00, 34.00, 72.50, 'B'),
(6, 'Leman bin Tatsumi', 'MAHSA05', 'Pengaturcaraan Web', 'WEB2101', 13.00, 23.00, 34.00, 70.00, 'B'),
(7, 'Zakwan Bin Exhibition', 'MAHSA06', 'Interaksi Manusia-Komputer', 'IMK3202', 12.00, 13.00, 14.00, 39.00, 'E'),
(8, 'Max Verstappen', 'MAHSA07', 'Pembangunan Aplikasi Mudah Alih', 'MMS4104', 20.00, 28.00, 3.00, 51.00, 'C'),
(10, 'Amir Sazali', 'MAHSA09', 'Interaksi Manusia-Komputer', 'MMS4104', 19.00, 12.00, 47.00, 78.00, 'B'),
(11, 'Zikry Emran', 'MAHSA10', 'Animasi 3D dan Pemodelan', 'MMS4104', 20.00, 8.00, 24.00, 52.00, 'C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grading_system`
--
ALTER TABLE `grading_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grading_system`
--
ALTER TABLE `grading_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
