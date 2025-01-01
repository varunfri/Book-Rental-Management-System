-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 06:33 AM
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
-- Database: `laptop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` varchar(255) NOT NULL,
  `ADMIN_PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_PASSWORD`) VALUES
('ADMIN', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BOOK_ID` int(11) NOT NULL,
  `LAP_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `BOOK_DATE` date NOT NULL,
  `DURATION` int(11) NOT NULL,
  `PHONE_NUMBER` bigint(20) NOT NULL,
  `RETURN_DATE` date NOT NULL,
  `PRICE` int(11) NOT NULL,
  `BOOK_STATUS` varchar(255) NOT NULL DEFAULT 'UNDER PROCESSING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BOOK_ID`, `LAP_ID`, `EMAIL`, `BOOK_DATE`, `DURATION`, `PHONE_NUMBER`, `RETURN_DATE`, `PRICE`, `BOOK_STATUS`) VALUES
(94, 27, 'varunvishwanath1@gmail.com', '2024-06-25', 1, 9513475397, '2024-06-26', 1020, 'UNDER PROCESSING'),
(95, 27, 'varunvishwanath1@gmail.com', '2024-06-25', 1, 9513475397, '2024-06-26', 1020, 'UNDER PROCESSING'),
(96, 27, 'varunvishwanath1@gmail.com', '2024-06-26', 2, 9513475397, '2024-06-28', 2040, 'RETURNED'),
(98, 36, 'varunvishwanath1@gmail.com', '2024-06-26', 3, 9513475397, '2024-06-29', 750, 'UNDER PROCESSING'),
(99, 27, 'varunvishwanath1@gmail.com', '2024-06-28', 2, 9513475397, '2024-06-30', 2040, 'UNDER PROCESSING');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FED_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `COMMENT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laptops`
--

CREATE TABLE `laptops` (
  `LAP_ID` int(11) NOT NULL,
  `LAP_NAME` varchar(255) NOT NULL,
  `COMPANY` varchar(255) NOT NULL,
  `RAM` varchar(11) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `LAP_IMG` varchar(255) NOT NULL,
  `AVAILABLE` varchar(255) NOT NULL,
  `processor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laptops`
--

INSERT INTO `laptops` (`LAP_ID`, `LAP_NAME`, `COMPANY`, `RAM`, `PRICE`, `LAP_IMG`, `AVAILABLE`, `processor`) VALUES
(27, 'Dell Insprion', 'Dell', '8', 1020, 'IMG-66757b01a2fa84.91742553.png', 'Y', 'i7'),
(30, 'HP OMEN', 'HP', '8', 1500, 'IMG-66784f6107e040.91380420.png', 'Y', 'Ryzen 5'),
(31, 'ASUS Zephyrus Dual ', 'ASUS', '8', 2500, 'IMG-6678538ec336c2.71356042.png', 'Y', 'Ryzen 7'),
(32, 'HP VICTUS ', 'HP', '8', 1900, 'IMG-667853e48012a9.33123141.png', 'Y', 'i7'),
(33, 'Dell Vostro 14', 'Dell', '12', 1200, 'IMG-6678542dd523d2.45639609.png', 'Y', 'i5'),
(34, 'HP Pavilion Plus', 'HP', '16', 1500, 'IMG-66785466401458.62810158.png', 'Y', 'i7'),
(35, 'HP Pavilion Plus 360x', 'HP', '16', 2500, 'IMG-66786d004e8062.35456545.png', 'Y', 'i7'),
(36, 'HP Pavilion Gaming', 'HP', '16', 250, 'IMG-667b9fe609be85.78530739.png', 'Y', 'Ryzen 7');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PAY_ID` int(11) NOT NULL,
  `BOOK_ID` int(11) NOT NULL,
  `CARD_NO` varchar(255) NOT NULL,
  `EXP_DATE` varchar(255) NOT NULL,
  `CVV` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PAY_ID`, `BOOK_ID`, `CARD_NO`, `EXP_DATE`, `CVV`, `PRICE`) VALUES
(46, 94, '1212121212121212', '1211', 121, 1020),
(47, 95, '1111111111111111', '1111', 111, 1020),
(48, 96, '1111111111111111', '1111', 111, 2040),
(49, 98, '1212121212121212', '1212', 121, 750),
(50, 99, '1111111111111111', '1111', 111, 2040);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `req_type` varchar(50) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `req_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `email`, `category`, `req_type`, `message`, `req_date`) VALUES
(8, 'Varun Vishwanath', 'varunvishwanath1@gmail.com', 'Technical Support', 'Hardware Issues', 'Need to check the hardware', '2024-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `FNAME` varchar(255) NOT NULL,
  `LNAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PHONE_NUMBER` bigint(11) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `GENDER` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`FNAME`, `LNAME`, `EMAIL`, `PHONE_NUMBER`, `PASSWORD`, `GENDER`) VALUES
('Varun', 'Vishwanath', 'varunvishwanath1@gmail.com', 9513475397, 'Varun123', 'male'),
('Varun', 'K V', 'vv9991997@gmail.com', 9448140164, 'Varun123', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BOOK_ID`),
  ADD KEY `CAR_ID` (`BOOK_ID`),
  ADD KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FED_ID`),
  ADD KEY `TEST` (`EMAIL`);

--
-- Indexes for table `laptops`
--
ALTER TABLE `laptops`
  ADD PRIMARY KEY (`LAP_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PAY_ID`),
  ADD UNIQUE KEY `BOOK_ID` (`BOOK_ID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BOOK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FED_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laptops`
--
ALTER TABLE `laptops`
  MODIFY `LAP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PAY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`LAP_ID`) REFERENCES `laptops` (`LAP_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `TEST` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`BOOK_ID`) REFERENCES `booking` (`BOOK_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
