-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2018 at 02:05 PM
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
(4, 'Dave', 'Johnson', '1980-09-21'),
(5, 'Zoe', 'Zhang', '2000-12-12'),
(14, 'Chunying', 'Zhang', '0000-00-00'),
(15, 'Jay', 'Chou', '0000-00-00'),
(17, 'zhen', 'chen', '0000-00-00'),
(18, 'Robort', 'Smith', '0000-00-00'),
(19, 'Gaga', 'Danish', '0000-00-00'),
(20, 'Happy', 'Tiger', '0000-00-00'),
(21, 'zhen', 'Zhang', '0000-00-00'),
(22, 'Chunying', 'Karelius', '0000-00-00'),
(23, 'Stephen', 'King', '0000-00-00'),
(24, 'Dave', 'Karelius', '0000-00-00'),
(25, 'Zoe', 'Karelius', '0000-00-00'),
(26, 'Daaa', 'Saaa', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `director_movie`
--

CREATE TABLE `director_movie` (
  `author_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `director_movie`
--

INSERT INTO `director_movie` (`author_id`, `movie_id`) VALUES
(2, 42),
(2, 47),
(20, 58),
(21, 58),
(2, 60),
(17, 61),
(2, 61),
(5, 60),
(25, 61),
(26, 61);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movie_name` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `year` varchar(4) DEFAULT NULL,
  `available` int(1) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movie_name`, `type`, `year`, `available`, `id`) VALUES
('A star is born', 'Comedy', '1999', 0, 42),
('The spirited away', 'Comedy', '', 0, 47),
('Final Maste', 'Horror', '2009', 1, 58),
('Lion_2', 'Horror', '2018', 1, 60),
('Get Out', 'Comedy', '', 0, 61);

-- --------------------------------------------------------

--
-- Table structure for table `reservemovie`
--

CREATE TABLE `reservemovie` (
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservemovie`
--

INSERT INTO `reservemovie` (`user_id`, `movie_id`) VALUES
(29, 58),
(29, 60);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(1) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `type` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `type`) VALUES
(22, 'zoe', '$1$rasmusle$8cJyCKdQMHsXdAfs1jAtt0', 'admin'),
(29, 'martin', '$1$rasmusle$8cJyCKdQMHsXdAfs1jAtt0', 'moderator'),
(31, 'elephant', '$1$rasmusle$8cJyCKdQMHsXdAfs1jAtt0', 'user'),
(32, 'tiger', '$1$rasmusle$8cJyCKdQMHsXdAfs1jAtt0', 'user'),
(33, 'zoee', '$1$rasmusle$8cJyCKdQMHsXdAfs1jAtt0', 'moderator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `director`
--
ALTER TABLE `director`
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
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
