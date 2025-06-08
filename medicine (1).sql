-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 07:09 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicine`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_store`
--

CREATE TABLE `admin_store` (
  `member_id` int(10) NOT NULL,
  `img` varchar(100) NOT NULL,
  `member_fname` varchar(20) NOT NULL,
  `member_sname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(20) NOT NULL,
  `phone_no` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_store`
--

INSERT INTO `admin_store` (`member_id`, `img`, `member_fname`, `member_sname`, `gender`, `address`, `phone_no`) VALUES
(14, '4.jpg', 'Beki', 'Junior', 'Male', 'Debremarkos', 911111111);

-- --------------------------------------------------------

--
-- Table structure for table `med_store`
--

CREATE TABLE `med_store` (
  `med_id` int(11) NOT NULL,
  `med_name` varchar(30) NOT NULL,
  `img` varchar(100) NOT NULL,
  `exp_date` varchar(10) NOT NULL,
  `price` int(10) NOT NULL,
  `med_desc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `med_store`
--

INSERT INTO `med_store` (`med_id`, `med_name`, `img`, `exp_date`, `price`, `med_desc`) VALUES
(1, 'Fzocalmin', 'med8.webp', '2023', 50, 'This medicine belongs to a class of medicines called nutritional supplements used to prevent and treat nutritional deficiencies and vitamin C deficiency. 500 mg Chewable Orange Tablet 15\'s usually does not affect your ability to drive or operate machinery.'),
(2, 'Teethstr8', 'med9.webp', '2023', 60, 'This medicine belongs to a class of medicines called nutritional supplements used to prevent and treat nutritional deficiencies and vitamin C deficiency.\r\n500 mg Chewable Orange Tablet 15\'s usually does not affect your ability to drive or operate machinery.'),
(3, 'Bronzatine', 'med5.webp', '2023', 70, 'This medicine belongs to a class of medicines called nutritional supplements used to prevent and treat nutritional deficiencies and vitamin C deficiency.\r\n500 mg Chewable Orange Tablet 15\'s usually does not affect your ability to drive or operate machinery.'),
(4, 'Tekasept', 'med7.webp', '2023', 45, 'This medicine belongs to a class of medicines called nutritional supplements used to prevent and treat nutritional deficiencies and vitamin C deficiency.\r\n500 mg Chewable Orange Tablet 15\'s usually does not affect your ability to drive or operate machinery.'),
(5, 'Pilerozone', 'med8.webp', '2023', 25, 'This medicine belongs to a class of medicines called nutritional supplements used to prevent and treat nutritional deficiencies and vitamin C deficiency.\r\n500 mg Chewable Orange Tablet 15\'s usually does not affect your ability to drive or operate machinery.'),
(6, 'Blephaclean', 'med7.webp', '2023', 20, 'This medicine belongs to a class of medicines called nutritional supplements used to prevent and treat nutritional deficiencies and vitamin C deficiency.\r\n500 mg Chewable Orange Tablet 15\'s usually does not affect your ability to drive or operate machinery.'),
(7, 'vitamin', 'med6.webp', '2023', 50, 'This medicine belongs to a class of medicines called nutritional supplements used to prevent and treat nutritional deficiencies and vitamin C deficiency.\r\n500 mg Chewable Orange Tablet 15\'s usually does not affect your ability to drive or operate machinery.'),
(8, 'Malix Natural Gel', 'med5.webp', '2023', 44, 'This medicine belongs to a class of medicines called nutritional supplements used to prevent and treat nutritional deficiencies and vitamin C deficiency. 500 mg Chewable Orange Tablet 15\'s usually does not affect your ability to drive or operate machinery.');

-- --------------------------------------------------------

--
-- Table structure for table `member_store`
--

CREATE TABLE `member_store` (
  `member_id` int(10) NOT NULL,
  `img` varchar(100) NOT NULL,
  `member_fname` varchar(20) NOT NULL,
  `member_sname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(20) NOT NULL,
  `phone_no` int(15) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `member_store`
--

INSERT INTO `member_store` (`member_id`, `img`, `member_fname`, `member_sname`, `gender`, `address`, `phone_no`, `role`) VALUES
(1, '4.jpg', 'Dagim', 'Beki', 'Male', 'debremarkos', 900000000, 'Storeman'),
(3, '3.jpg', 'Gelila', 'Dagim', 'Female', 'debremarkos', 900000000, 'Pharmacist');

-- --------------------------------------------------------

--
-- Table structure for table `report_store`
--

CREATE TABLE `report_store` (
  `report_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `img` varchar(100) NOT NULL,
  `address` varchar(20) NOT NULL,
  `phone_no` int(15) NOT NULL,
  `med_name` varchar(20) NOT NULL,
  `buy_date` varchar(10) NOT NULL,
  `quantity` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_store`
--
ALTER TABLE `admin_store`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `med_store`
--
ALTER TABLE `med_store`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `member_store`
--
ALTER TABLE `member_store`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `report_store`
--
ALTER TABLE `report_store`
  ADD PRIMARY KEY (`report_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_store`
--
ALTER TABLE `admin_store`
  MODIFY `member_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `med_store`
--
ALTER TABLE `med_store`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `member_store`
--
ALTER TABLE `member_store`
  MODIFY `member_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `report_store`
--
ALTER TABLE `report_store`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
