-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 20, 2018 at 11:34 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`id`, `first_name`, `last_name`, `birthday`) VALUES
(1, 'Tom', 'Ford', '2018-07-09'),
(2, 'Martin', 'Karelius', '1981-07-15'),
(3, 'Luc', 'Besson', '1956-11-02'),
(4, 'Dave', 'Johnson', '1980-09-21'),
(5, 'Zoe', 'Zhang', '2000-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `director_movie`
--

CREATE TABLE `director_movie` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `director_movie`
--

INSERT INTO `director_movie` (`id`, `author_id`, `movie_id`) VALUES
(1, 2, 2),
(2, 2, 3),
(3, 2, 4),
(4, 2, 5),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movie_name` varchar(30) NOT NULL,
  `director` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `year` int(11) NOT NULL,
  `barcode` varchar(10) NOT NULL,
  `available` int(1) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movie_name`, `director`, `type`, `year`, `barcode`, `available`, `id`) VALUES
('Leon', 'Luc Besson', 'crime', 1994, 'c94lb01', 0, 1),
('Inception', 'Martin Karelius', 'crime', 2010, 'c10cn00', 0, 2),
('Mission Impossible6', 'Martin Karelius', 'crime', 2018, 'c18bd01', 0, 3),
('The Notebook', 'Martin Karelius', 'romance', 1999, 'r99mz01', 0, 4),
('The Notebook', 'Zoe Zhang', 'romance', 1999, 'r99mz02', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(1) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `director_movie`
--
ALTER TABLE `director_movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
