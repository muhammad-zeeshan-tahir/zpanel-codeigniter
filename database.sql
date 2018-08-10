-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2018 at 04:04 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `localfor_makanika`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(1) DEFAULT '1',
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `password`, `status`, `created_on`, `updated_on`) VALUES
(1, 'sd', 'sadsad@dasdsad', '1312321', '3213213', 1, '2018-08-08 15:14:24', '2018-08-09 11:43:42'),
(2, 'zeeshan', 'k112340@nu.edu.pk', '3213213213123', 'z123Z321', 1, '2018-08-10 12:21:02', '2018-08-10 15:21:02'),
(5, 'zeeshan', 'zeeshan@zpanel.com', '2342134213423', 'f7a8e49325fe4a238df4', 1, '2018-08-10 15:18:12', '2018-08-10 18:18:12'),
(6, 'admin', 'admin@admin.com', '2342134213423', 'f865b53623b121fd34ee5426c792e5c33af8c227', 1, '2018-08-10 15:18:45', '2018-08-10 18:22:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
