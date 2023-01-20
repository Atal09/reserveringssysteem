-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2022 at 12:51 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Reservering`
--
CREATE DATABASE IF NOT EXISTS `Reservering` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Reservering`;

-- --------------------------------------------------------

--
-- Table structure for table `Reservering`
--

DROP TABLE IF EXISTS `Reservering`;
CREATE TABLE `Reservering` (
                          `id` int(11) UNSIGNED NOT NULL,
                          `naam` varchar(50) NOT NULL,
                          `email` varchar(50) NOT NULL,
                          `genre` varchar(20) NOT NULL,
                          `datum` smallint(6) UNSIGNED NOT NULL,
                          `tijd` tinyint(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `albums`
--

INSERT INTO `Reservering`.Reservering (`id`, `naam`, `email`, `genre`, `datum`, `tijd`) VALUES
    (1, 'Harry\'s House', 'atal.baktash@gmail.com', 'Pop', 2022, 13),
(2, '=', 'Ed Sheeran', 'DavedeRover@hotmail.com', 2022, 14),
(3, 'The Highlights', 'ThijsvanGeest@outlook.com', 'R&B', 2022, 15),
(4, 'The Greatest Hits', 'NielsGroen15@gmail.com', 'Rock', 2022, 16);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `Reservering`
--
ALTER TABLE `Reservering`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Reservering`
--
ALTER TABLE `Reservering`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
