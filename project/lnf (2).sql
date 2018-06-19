-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2017 at 03:16 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lnf`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_general_mysql500_ci NOT NULL,
  `category` set('bags','electronics','others','books') COLLATE utf8_general_mysql500_ci NOT NULL,
  `image` varchar(30) CHARACTER SET ucs2 COLLATE ucs2_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `title`, `category`, `image`) VALUES
(1, 'humor', 'others', '59871-humor.png'),
(2, 'hi', 'others', '56367-health.jpg'),
(3, 'Food', 'others', '54411-serai.jpg'),
(4, 'Food2', 'others', '96389-budu.jpg'),
(5, 'Food3', 'others', '14625-belacan kering.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `image_id`, `uploader_id`, `date`) VALUES
(1, 1, 2015057474, '2017-11-15 11:27:06'),
(2, 2, 2015057474, '2017-11-15 11:35:37'),
(3, 3, 2016067891, '2017-12-04 04:08:14'),
(4, 4, 2147483647, '2017-12-04 04:09:05'),
(5, 5, 2013098012, '2017-12-04 05:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `uploader`
--

CREATE TABLE `uploader` (
  `id` int(11) NOT NULL,
  `contact_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `uploader`
--

INSERT INTO `uploader` (`id`, `contact_no`) VALUES
(2016, 56),
(2017, 2132313),
(2013098012, 807123),
(2015057474, 885755),
(2016067891, 9012),
(2147483647, 201923);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `uploader_id` (`uploader_id`);

--
-- Indexes for table `uploader`
--
ALTER TABLE `uploader`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`uploader_id`) REFERENCES `uploader` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
