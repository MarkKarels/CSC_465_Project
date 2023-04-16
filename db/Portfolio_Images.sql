-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 25, 2023 at 04:05 PM
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
-- Table structure for table `Portfolio_Images`
--

CREATE TABLE `Portfolio_Images` (
  `image_id` int(10) NOT NULL,
  `filename` varchar(25) DEFAULT NULL,
  `caption` varchar(120) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Portfolio_Images`
--

INSERT INTO `Portfolio_Images` (`image_id`, `filename`, `caption`, `details`) VALUES
(1, 'test1.jpg', 'Computer Science Showcase', 'Check out the next computer science showcase coming soon'),
(2, 'test2.jpg', 'Education At Your Fingertips', 'Show what you can do with a computer science degree from UNCW'),
(3, 'test3.jpg', 'Coding Bootcamp', 'Learn to code in just one week at our amazing coding bootcamp, coming soon'),
(4, '465project.jpg', 'Home Page of This Project', 'Filler Homepage of the 465 project'),
(5, 'UNCW.jpg', 'Welcome to UNCW', 'The wonderful university where I obtained my BS in CS'),
(6, 'chatgpt.jpeg', 'chatGPT, The Way of the Future', 'Can we use AI to help us with our careers?'),
(7, 'congdon.jpg', 'The Home For CS Students', 'The heart and sould of the computer science program'),
(8, 'cs.jpg', 'Computer Science, The Future is Now', 'What better degree than that in Computer Science');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Portfolio_Images`
--
ALTER TABLE `Portfolio_Images`
  ADD PRIMARY KEY (`image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Portfolio_Images`
--
ALTER TABLE `Portfolio_Images`
  MODIFY `image_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
