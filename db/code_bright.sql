-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2021 at 05:53 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `code_bright`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` smallint(6) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_on`, `updated_on`) VALUES
(9, 'Depertment A', 1, '2021-07-08 10:16:44', '2021-08-04 06:15:56'),
(12, 'Department B', 1, '2021-07-08 10:17:17', '2021-08-04 06:15:32'),
(38, 'Department D', 2, '2021-11-07 06:31:06', '2021-11-07 06:31:06'),
(37, 'Department C', 1, '2021-11-07 06:28:47', '2021-11-07 06:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `name` varchar(70) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `parent`, `name`, `email`, `password`, `status`) VALUES
(1, 0, 'Abu Sumain', 'sumain@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(43, 0, 'EMP1', 'ceo@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(44, 43, 'EMP2', 'emp2@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(46, 44, 'EMP3', 'emp3@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(47, 44, 'EMP4', 'emp4@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(48, 46, 'EMP5', 'emp5@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(49, 46, 'EMP6', 'emp6@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(50, 47, 'EMP7', 'emp7@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(51, 47, 'EMP8', 'emp8@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(52, 48, 'EMP9', 'emp9@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(53, 48, 'EMP10', 'emp10@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(54, 49, 'EMP11', 'emp11@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(55, 49, 'EMP12', 'emp12@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(56, 50, 'EMP13', 'emp13@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(57, 56, 'EMP14', 'emp14@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(58, 56, 'EMP15', 'emp15@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(59, 47, 'EMP16', 'emp@gmail.com', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_dept_role`
--

DROP TABLE IF EXISTS `emp_dept_role`;
CREATE TABLE `emp_dept_role` (
  `id` int(11) NOT NULL,
  `employeeid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `dept` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emp_dept_role`
--

INSERT INTO `emp_dept_role` (`id`, `employeeid`, `roleid`, `dept`) VALUES
(1, 1, 1, 0),
(216, 43, 2, 9),
(217, 44, 4, 9),
(219, 46, 5, 9),
(220, 47, 5, 9),
(221, 48, 6, 9),
(222, 49, 6, 9),
(223, 50, 6, 9),
(224, 51, 6, 9),
(225, 52, 7, 9),
(226, 53, 7, 9),
(227, 54, 7, 9),
(228, 55, 7, 9),
(229, 56, 7, 9),
(230, 57, 8, 9),
(231, 58, 8, 9),
(232, 47, 6, 12),
(233, 49, 7, 12),
(234, 59, 7, 12);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT '',
  `details` varchar(50) NOT NULL DEFAULT '',
  `var_name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `details`, `var_name`) VALUES
(1, 'ADMIN', 'Super Admin', 'isAdmin'),
(2, 'CEO', 'Chief Execution Officer', 'isCEO'),
(4, 'COO', 'Chief Operating Officer', 'isCOO'),
(5, 'GM', 'General Manager', 'isGM'),
(6, 'MA', 'Manager', 'isMA'),
(7, 'SUP', 'Supervisor', 'isSUP'),
(8, 'STA', 'Staff', 'isSTA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_dept_role`
--
ALTER TABLE `emp_dept_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `emp_dept_role`
--
ALTER TABLE `emp_dept_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
