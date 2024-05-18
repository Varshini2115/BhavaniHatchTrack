-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 10:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance_assistance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `financial_records`
--

CREATE TABLE `financial_records` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `payment_reason` text NOT NULL,
  `amount_paid` double NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `financial_records`
--

INSERT INTO `financial_records` (`id`, `date`, `payment_reason`, `amount_paid`, `status`) VALUES
(2, '2024-05-03', 'Purchase of equipment', 900, 'Completed'),
(3, '2024-05-05', 'Office rent', 300, 'Completed'),
(4, '2024-05-07', 'Payment for supplies', 1200, 'Processing'),
(25, '2024-05-03', 'Purchase of equipment', 900, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `run_details`
--

CREATE TABLE `run_details` (
  `id` int(6) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `manager_name` varchar(255) NOT NULL,
  `manager_phone` varchar(15) NOT NULL,
  `investment_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `run_details`
--

INSERT INTO `run_details` (`id`, `start_date`, `manager_name`, `manager_phone`, `investment_amount`) VALUES
(1, '2024-05-09', 'dsfgfhgj', '1234567890', 65789.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `financial_records`
--
ALTER TABLE `financial_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `run_details`
--
ALTER TABLE `run_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `financial_records`
--
ALTER TABLE `financial_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `run_details`
--
ALTER TABLE `run_details`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
