-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2023 at 11:53 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ee_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `live_device`
--

CREATE TABLE `live_device` (
  `id` int(11) NOT NULL,
  `device_Id` varchar(3) DEFAULT NULL,
  `mob_no` varchar(11) DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `live_device`
--

INSERT INTO `live_device` (`id`, `device_Id`, `mob_no`, `status`, `created`, `modified`) VALUES
(1, '5', NULL, 0, '2023-11-19 16:05:32', '2023-11-19 16:05:32'),
(2, '1', '0142069420', 1, '2023-11-19 16:06:42', '2023-11-19 16:06:42'),
(3, '1', '01675702741', 1, '2023-11-19 16:19:41', '2023-11-19 16:19:41'),
(4, '1', '0176942069', 1, '2023-11-19 16:31:39', '2023-11-19 16:31:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `live_device`
--
ALTER TABLE `live_device`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `live_device`
--
ALTER TABLE `live_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
