-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 30, 2022 at 12:20 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bit_academy_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `file_color` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cookie` varchar(255) NOT NULL,
  `upload_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `file_name`, `type`, `url`, `file_color`, `description`, `cookie`, `upload_date`) VALUES
(31, 'SampleJPGImage_500kbmb.jpg', 'file system', 'uploads/09-30-2022_12-08-29SampleJPGImage_500kbmb.jpg', '#37A661', 'Butterfly', '1588139785', '2022-09-30 06:38:29'),
(32, 'SampleJPGImage_500kbmb.jpg', 'file system', 'uploads/09-30-2022_12-15-57SampleJPGImage_500kbmb.jpg', '#B81C1C', 'butterfly', '1680577870', '2022-09-30 06:45:57'),
(33, 'sample_1920×1280.jpg', 'imgur', 'https://i.imgur.com/jYjPgsf.jpg', '#16A223', 'Nature img', '1680577870', '2022-09-30 06:46:23'),
(34, 'rene-porter-hteGzeFuB7w-unsplash (1).jpg', 'file system', 'uploads/09-30-2022_12-16-57rene-porter-hteGzeFuB7w-unsplash (1).jpg', '#B11CFB', 'A test desc', '1680577870', '2022-09-30 06:46:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
