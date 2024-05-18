-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 11:16 AM
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
-- Database: `hatchery_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch_details`
--

CREATE TABLE `batch_details` (
  `id` int(11) NOT NULL,
  `batch_name` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `amount_invested` decimal(10,2) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `supplier_phone` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit` enum('kg','g') DEFAULT NULL,
  `health_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch_details`
--

INSERT INTO `batch_details` (`id`, `batch_name`, `start_date`, `amount_invested`, `supplier`, `supplier_phone`, `quantity`, `unit`, `health_status`) VALUES
(1, 'Batch1', '2024-05-01', 500.00, 'Supplier1', '1234567890', 100, 'kg', 'Healthy'),
(2, 'Batch2', '2024-05-03', 750.00, 'Supplier2', '0987654321', 150, 'g', 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `costPerMeal` int(11) NOT NULL,
  `mealsPerDay` int(11) NOT NULL,
  `numberOfPersonsPresent` int(11) NOT NULL,
  `date` date NOT NULL,
  `total_cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`costPerMeal`, `mealsPerDay`, `numberOfPersonsPresent`, `date`, `total_cost`) VALUES
(0, 3, 0, '0000-00-00', 0),
(130, 3, 35, '2024-01-01', 13650),
(100, 3, 15, '2024-01-04', 4500),
(200, 3, 15, '2024-01-05', 9000),
(200, 3, 23, '2024-01-06', 13800),
(250, 3, 30, '2024-01-08', 22500),
(170, 3, 35, '2024-01-09', 17850),
(150, 3, 15, '2024-04-29', 6750),
(230, 3, 34, '2024-04-30', 23460),
(10, 3, 67, '2024-05-01', 2010),
(90, 3, 60, '2024-05-03', 16200),
(150, 3, 10, '2024-05-04', 4500),
(809, 3, 15, '2024-05-09', 36405),
(345, 4, 34, '2024-05-10', 46920);

-- --------------------------------------------------------

--
-- Table structure for table `larvae_info`
--

CREATE TABLE `larvae_info` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `tank_number` int(11) NOT NULL,
  `larvae_count` int(11) NOT NULL,
  `food_type` varchar(50) NOT NULL,
  `feeding_frequency` int(11) NOT NULL,
  `feeding_amount` float NOT NULL,
  `water_temperature` float NOT NULL,
  `water_salinity` float NOT NULL,
  `pH` float NOT NULL,
  `tank_cleanliness` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `larvae_info`
--

INSERT INTO `larvae_info` (`id`, `date`, `tank_number`, `larvae_count`, `food_type`, `feeding_frequency`, `feeding_amount`, `water_temperature`, `water_salinity`, `pH`, `tank_cleanliness`) VALUES
(1, '2024-05-01', 1, 100, 'Artemia', 3, 5.5, 28, 32, 7.2, 8),
(2, '2024-05-01', 2, 120, 'Microalgae', 4, 6.2, 26, 30, 7, 7),
(3, '2024-05-02', 1, 110, 'Commercial Feed', 3, 7, 29, 33, 7.5, 9),
(4, '2024-05-09', 32, 35000, 'Artemia', 4, 36, 29, 26, 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `production_data`
--

CREATE TABLE `production_data` (
  `id` int(11) NOT NULL,
  `tank_name` varchar(50) NOT NULL,
  `harvest_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` decimal(5,2) NOT NULL,
  `survival_rate` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `production_data`
--

INSERT INTO `production_data` (`id`, `tank_name`, `harvest_date`, `quantity`, `size`, `survival_rate`) VALUES
(1, 'Tank 1', '2024-04-15', 10000, 1.20, 75.00),
(2, 'Tank 2', '2024-04-20', 8000, 1.00, 80.00),
(3, 'Tank 3', '2024-04-22', 12000, 1.50, 82.00),
(4, 'Tank 4', '2024-05-01', 9500, 1.30, 78.00),
(5, 'Tank 5', '2024-05-05', 11200, 1.40, 83.00),
(6, 'Tank 6', '2024-05-10', 7800, 0.90, 77.00),
(7, 'Tank 7', '2024-05-15', 10500, 1.10, 81.00),
(8, 'Tank 8', '2024-05-20', 8700, 1.20, 79.00),
(9, 'Tank 9', '2024-05-25', 11800, 1.60, 84.00),
(10, 'Tank 10', '2024-05-30', 9300, 1.00, 76.00),
(11, 'Tank 11', '2024-06-01', 10200, 1.30, 80.00),
(12, 'Tank 12', '2024-06-05', 8500, 1.10, 78.00),
(13, 'Tank 13', '2024-06-10', 11500, 1.40, 83.00),
(14, 'Tank 14', '2024-06-15', 9800, 1.20, 79.00),
(15, 'Tank 15', '2024-06-20', 10800, 1.50, 82.00),
(16, 'Tank 16', '2024-06-25', 8200, 1.00, 77.00),
(17, 'Tank 17', '2024-06-30', 11000, 1.30, 81.00),
(18, 'Tank 18', '2024-07-05', 9600, 1.10, 80.00),
(19, 'Tank 19', '2024-07-10', 10700, 1.40, 84.00),
(20, 'Tank 20', '2024-07-15', 8900, 1.20, 78.00),
(21, 'Tank 36', '2024-05-10', 30000, 39.00, 90.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'BHAVANI_HATCHERY14', 'BHK@1714');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`ID`, `Date`, `Details`) VALUES
(1, '2024-05-01', 'Clean and disinfect all surfaces.'),
(2, '2024-05-02', 'Focus on high-touch areas like doorknobs and light switches.'),
(3, '2024-05-03', 'Use bleach solution for disinfection.'),
(4, '2024-05-05', 'fghjkl'),
(10, '2024-05-06', 'fghjkl'),
(12, '2024-05-07', 'ghjkl'),
(15, '2024-05-09', '6f7oupoi'),
(16, '2024-06-08', 'vfi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch_details`
--
ALTER TABLE `batch_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`date`);

--
-- Indexes for table `larvae_info`
--
ALTER TABLE `larvae_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_data`
--
ALTER TABLE `production_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`Date`),
  ADD KEY `ID_2` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch_details`
--
ALTER TABLE `batch_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `larvae_info`
--
ALTER TABLE `larvae_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `production_data`
--
ALTER TABLE `production_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
