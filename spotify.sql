-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 03:52 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotify`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'abc123'),
(2, 'admin2', 'admin2@gmail.com', 'abc123');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Spotify Playlists'),
(2, 'Focus'),
(3, 'Sound of India');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `audio` longtext NOT NULL,
  `image` longtext NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `audio`, `image`, `description`) VALUES
(1, 'Today\'s Top Hits', 'Olivia Rodrygo', 'audio/hide.mp3', 'today-hit.jpg', 'Olivia Rodrigo is on top of the Hottest 50!'),
(2, 'RapCaviar', 'Cardi B', 'audio/sleep.mp3', 'rap-caviar.jpg', 'New Music from Cardi B, Megan Thee Stallion an...'),
(3, 'All out 2010s', 'pf tje', 'audio/coffee.mp3', 'all-out-2010.jpg', 'The biggest spmgs pf tje 2010s.'),
(4, 'Rock Classics', 'Various Artist', 'audio/hide.mp3', 'rock-classics.jpg', 'Rock Legends & epic songs that continue to...'),
(5, 'Chill Hits', 'Various Artist', 'audio/sleep.mp3', 'chill-hits.jpg', 'Kick back to the best new and recent chill hits'),
(6, 'Viva Latino', 'Elevando Nuestra', 'audio/coffee.mp3', 'viva-latino.jpg', 'Today\'s top Latin hits elevando nuestra...'),
(7, 'All out 80s', 'Michael Jakson', 'audio/hide.mp3', 'all-out-80s.jpg', 'The biggest songs of the 1980s. Cover: Michael...'),
(8, 'Peaceful Piano', 'Mitsukiyo', 'audio/sleep.mp3', 'peaceful-piano.jpg', 'Peaceful piano to help you slow down, breath...'),
(9, 'Deep Focus', 'Mitsukiyo', 'audio/coffee.mp3', 'deep-focus.jpg', 'Keep calm and focus with ambient and post-...'),
(10, 'Instrumental Study', 'Various Artist', 'audio/hide.mp3', 'instrumental.jpg', 'Focus with soft study music in the background.'),
(11, 'Focus Flow', 'Various Artist', 'audio/sleep.mp3', 'focus-flow.jpg', 'Uptempo instrumental hip hop beats'),
(12, 'Beats to think to', 'Various Artist', 'audio/coffee.mp3', 'beats.jpg', 'Focus with melodic techno and tech house.'),
(13, 'Reading Adventure', 'Various Artist', 'audio/hide.mp3', 'reading.jpg', 'Scores and soundtracks for daring quests, epic...'),
(14, 'Workday Lounge', 'Mitsukiyo', 'audio/sleep.mp3', 'workday.jpg', 'Lounge and chill out music for your workday'),
(15, 'The Sound of Mumbai', 'Various Artist', 'audio/coffee.mp3', 'mumbai.jpg', 'The songs that define, unite and distinguish...'),
(16, 'The Sound of Kolkata', 'Various Artist', 'audio/hide.mp3', 'kolkata.jpg', 'The songs that define, unite and distinguish...'),
(17, 'The Sound of Delhi', 'Various Artist', 'audio/sleep.mp3', 'delhi.jpg', 'The songs that define, unite and distinguish...'),
(18, 'The Sound of Bengaluru', 'Various Artist', 'audio/hide.mp3', 'bengal.jpg', 'The songs that define, unite and distinguish...'),
(19, 'The Sound of Chennai', 'Various Artist', 'audio/sleep.mp3', 'chennai.jpg', 'The songs that define, unite and distinguish...'),
(20, 'The Sound of Hyderabad', 'Various Artist', 'audio/coffee.mp3', 'hyderabad.jpg', 'The songs that define, unite and distinguish...');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`) VALUES
(1, 'yudh43z', 'yudhaez@gmail.com', 'abc123', 'snapedit_1704558588904.png'),
(2, 'testing123', 'testing12@gmail.com', 'abc123', 'avaeriri.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
