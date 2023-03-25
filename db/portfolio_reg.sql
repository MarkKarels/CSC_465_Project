-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 25, 2023 at 03:00 PM
-- Server version: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mak8966`
--

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_reg`
--

CREATE TABLE `portfolio_reg` (
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `emailAddr` varchar(40) NOT NULL,
  `pw` varchar(255) DEFAULT NULL,
  `firstport` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio_reg`
--

INSERT INTO `portfolio_reg` (`firstname`, `lastname`, `emailAddr`, `pw`, `firstport`) VALUES
('Amanda', 'Karels', 'akarels@gmail.com', '$2y$10$e0m9C7sbq8.e8GYFpW3DB.huxGztRe1leBTdfKzHpJdonS2ScdePe', 1),
('Mark', 'Karels', 'chicagoarkouda@gmail.com', '$2y$10$z.VoMbLJTM1G8nqOr5NL1.LDYiZjTuKDTe2SJOLZ/l1FamNoAYZOq', 1),
('Testing', 'Login', 'testlogin@uncw.edu', '$2y$10$fgtfODPQoEOIr.hBTG9/.el5Ph.gFhjiX1TLoUphfee.DJvdtd51m', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `portfolio_reg`
--
ALTER TABLE `portfolio_reg`
  ADD PRIMARY KEY (`emailAddr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
