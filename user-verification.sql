-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2021 at 10:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user-verification`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `postinguserid` varchar(200) NOT NULL,
  `postingusername` varchar(200) NOT NULL,
  `postingrealname` varchar(200) NOT NULL,
  `receivinguserid` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `commenttext` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `postinguserid`, `postingusername`, `postingrealname`, `receivinguserid`, `date`, `commenttext`) VALUES
(3, '1', 'kosh', 'Josh Jayshan', '1', '2020-02-17 17:33:45', 'hey this is a comment i (user1) left on my (user1) page at 6:33 pm 2/17/2020'),
(4, '1', 'kosh', 'Josh Jayshan', '1', '2020-02-17 18:02:17', 'this is another comment that i, josh jayshan, have left on my own page'),
(5, '1', 'kosh', 'Josh Jayshan', '2', '2020-02-17 18:03:01', 'hello!'),
(6, '1', 'kosh', 'Josh Jayshan', '2', '2020-02-17 18:03:31', 'hello #2!'),
(7, '1', 'kosh', 'Josh Jayshan', '1', '2020-02-17 19:41:24', 'hey i also left this thing on my own page'),
(9, '1', 'kosh', 'Josh Jayshan', '1', '2020-02-17 21:40:38', 'hewwo is this wowwkiwing owo'),
(10, '1', 'kosh', 'Josh Jayshan', '1', '2020-02-17 21:42:50', 'wowowowking'),
(11, '4', 'pepegathekosh', 'kosh is pepega', '1', '2020-02-17 22:02:39', 'hewwo'),
(12, '4', 'pepegathekosh', 'kosh is pepega', '1', '2020-02-17 22:05:06', 'hello again'),
(13, '1', 'kosh', 'Josh Jayshan', '1', '2020-02-17 22:26:09', 'hey i left a comment about how happy i am that i finished this'),
(20, '9', 'koshtest', 'HoshForTesting', '9', '2021-03-19 20:19:12', 'i smell'),
(21, '9', 'koshtest', 'Hosh For Testing', '9', '2021-03-19 20:19:53', 'I smell more'),
(22, '9', 'hoshtest', 'Hosh For Testing', '1', '2021-03-19 21:08:09', 'oof');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(16) NOT NULL,
  `realname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `pfp` varchar(2000) NOT NULL,
  `bio` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `realname`, `username`, `pfp`, `bio`, `email`, `password`) VALUES
(1, 'Josh Jayshan', 'kosh', 'users/autoimages/1581957475_IMG_20191108_122310.jpg', 'This is an actual bio.', 'pepega@kosh.com', '$2y$10$Nf6824SMx/s9qEfe9ZdXt.tPvtNShzLATJOUHUWh65iYYuMUmo65i'),
(2, 'Kosh Datian', 'kosh2', 'users/websiteresources/defpfp.jpg', 'This user has not set a bio.', 'koshispepega@kosh.com', '$2y$10$oMZBPdIkW6reyaTXhc86vOxQ349FyYLXHd2Fuw0BqZcDaRZnXCVWW'),
(4, 'kosh is pepega', 'pepegathekosh', 'users/autoimages/1616172643_4d6xKeF.jpg', 'This user has not set a bio.', 'pepega@kosh5.com', '$2y$10$d2Of/j.W0SpIka/SwExZc.PHxhmSItEeOm0qxqL/8vZMFXcchyTGe'),
(9, 'Hosh For Testing', 'Hoshtest', 'users/autoimages/1616181149_1438440048491.jpg', 'My profile picture is an accurate representation of me.', 'kosh@kosh.kosh', '$2y$10$aPwUhxHhubAKIBZ.WAl0PeqlZTmyN7N1oIVgec8mmyaBPI.vVCtku');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `user_info` ADD FULLTEXT KEY `realname` (`realname`);
ALTER TABLE `user_info` ADD FULLTEXT KEY `nickname` (`username`);
ALTER TABLE `user_info` ADD FULLTEXT KEY `pfp` (`pfp`);
ALTER TABLE `user_info` ADD FULLTEXT KEY `bio` (`bio`);
ALTER TABLE `user_info` ADD FULLTEXT KEY `password` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
