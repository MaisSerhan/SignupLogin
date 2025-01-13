-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06 ديسمبر 2024 الساعة 04:38
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webass`
--

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `privileges` enum('User','Admin') NOT NULL,
  `entercode` varchar(9) NOT NULL,
  `ProfilePhoto` varchar(100) DEFAULT NULL,
  `UploadingFile` varchar(100) DEFAULT NULL,
  `md5_pass` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `privileges`, `entercode`, `ProfilePhoto`, `UploadingFile`, `md5_pass`) VALUES
(14, 'mais', '05923227455m0', 'User', '55g5', '../photo/Facebook.png', '../photo/a1.jpg', 49447);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- بنية الجدول `deleteusers`
--

CREATE TABLE `deleteusers` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `privileges` enum('User','Admin') NOT NULL,
  `entercode` varchar(9) NOT NULL,
  `ProfilePhoto` varchar(100) DEFAULT NULL,
  `UploadingFile` varchar(100) DEFAULT NULL,
  `md5_pass` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `deleteusers` (`id`, `username`, `password`, `privileges`, `entercode`, `ProfilePhoto`, `UploadingFile`, `md5_pass`) VALUES
(14, 'mais', '05923227455m0', 'User', '55g5', '../photo/Facebook.png', '../photo/a1.jpg', 49447);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `deleteusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `deleteusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;