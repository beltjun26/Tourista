-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2016 at 08:05 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourista`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `post_id` int(9) NOT NULL,
  `place_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int(9) NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(30) NOT NULL,
  `about_me` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `username`, `firstname`, `lastname`, `password`, `email`, `address`, `about_me`) VALUES
(1, 'clyde', 'Clyde', 'Delgado', 'Delgado', 'clydedelgado@gmail.com', 'San Jose, Antique', 'Draw paint create master doctor derma '),
(2, 'maynard', 'Maynard', 'Vargas', 'vargas', 'vargasmaynard@gmail.com', 'Kalibo, Aklan', 'asdfghjk12345678'),
(3, 'rollin', 'Rollin', 'Pacheco', 'pacheco', 'rollinpachecko@gmail.com', 'Rollin City, Pacheco', 'Rollin in the deep.'),
(4, 'alonzo', 'Alonzo', 'Locsin', 'locsin', 'alonzolocsin@gmail.com', 'Alonzo City, Locsin, Iloilo', 'Ace hardware ace hardware.'),
(5, 'andrew', 'Andrew', 'Dagdag', 'dagdag', 'andrewdagdag@gmail.com', 'Andrew City, Dagdag', 'I am Andrew D.'),
(6, 'diana', 'Diana Chris', 'Pacaña', 'pacana', 'diana@gmail.com', 'Diana City, Miagao', 'Diana diana diana'),
(7, 'donn', 'Donn', 'Cruz', 'cruz', 'donn_cruz@gmail.com', 'Address, Negros', 'Ako si Donn.'),
(8, 'angelica', 'Ma. Angelica', 'Talabucon', 'talabucon', 'jing@gmail.com', 'Somewhere, Capiz', 'Ako si Jong. '),
(9, 'rosiebelt', 'Rosiebelt Jun', 'Abisado', 'abisado', 'beltjun@gmail.com', 'Lemery, Iloilo', 'About about about rosiebelt.'),
(10, 'rosjel', 'Rosjel Jolly', 'Lambungan', 'lambungan', 'lambunganrosjel@gmail.com', 'Dueñas, Iloilo', 'Adventure junkie\r\n'),
(11, 'salvy', 'Salvy Jessa', 'Arnaiz', 'arnaiz', 'arnaiz@gmail.com', 'My Address, Somewhere', 'Hahahaha. '),
(12, 'shebna', 'Shebna Rose', 'Fabilloren', 'fabilloren', 'shebnarose@gmail.com', 'Somewhere, Negros', 'Ako shebna shebna'),
(13, 'popo', 'Dragon', 'Hehe', 'popopo123', 'popo@gmail.com', '', ''),
(14, 'hello', 'Alcohol', 'Ethyl', 'aasdassddsa1', 'assd@gmail.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `place_id` int(9) NOT NULL,
  `acc_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `acc_id_follower` int(9) NOT NULL,
  `acc_id_follows` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`acc_id_follower`, `acc_id_follows`) VALUES
(2, 10),
(3, 2),
(3, 1),
(2, 3),
(2, 8),
(9, 2),
(9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(10) NOT NULL,
  `notif_from` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `place_id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `desciption` varchar(100) NOT NULL,
  `location_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`place_id`, `name`, `desciption`, `location_id`) VALUES
(1, 'Miagao Church', 'This is Miagao Church.', 'ChIJCfn0zHZcrjMRqI11lJHSPGY'),
(2, 'Balay Cawayan', 'Balay nga cawayan', 'ChIJNyOoLYRbrjMRKgljYP_KdWo'),
(3, 'Lanz Pizza', 'Masharap na pizza lol', 'ChIJadk10nZcrjMRZ66xPc1HlXg'),
(4, 'Plaza Miagao', 'Plaza sng Miagao', 'ChIJxW6uf4pbrjMRsZwTF9N9lko'),
(5, 'College of Arts and Sciences (CAS)', 'College of really cool people.', 'ChIJRfmlQnpcrjMRO3w9ayZy24g'),
(6, 'College of Fisheries and Ocean Studies', 'Isda isda fish fish', 'ChIJG1tKfY1CrjMRRMPdEBPMm_g');

-- --------------------------------------------------------

--
-- Table structure for table `posted`
--

CREATE TABLE `posted` (
  `post_id` int(9) NOT NULL,
  `content` varchar(300) NOT NULL,
  `place_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `time_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `if_image` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posted`
--

INSERT INTO `posted` (`post_id`, `content`, `place_id`, `acc_id`, `time_post`, `if_image`) VALUES
(1, 'Hello', 1, 9, '2016-11-24 13:03:22', 1),
(2, 'Text', 3, 9, '2016-11-24 13:39:09', 1),
(3, 'aaaaaa', 3, 9, '2016-11-24 13:03:31', 1),
(4, 'asd\r\n', 4, 9, '2016-11-24 13:05:22', 0),
(5, 'Hello\r\nRosiebelt\r\nKonichiwa Rosie san Ligo na', 3, 9, '2016-11-24 13:40:21', 0),
(6, 'qweqweqwe', 2, 2, '2016-11-24 08:36:10', 0),
(7, 'asdghdkjasdjahd', 2, 2, '2016-11-24 09:00:21', 0),
(8, 'dragonite', 2, 2, '2016-11-24 15:30:39', 0),
(13, 'Rollin post 1', 2, 3, '2016-11-24 18:08:02', 0),
(14, 'Rollin post 2', 2, 3, '2016-11-24 18:08:07', 0),
(15, 'Post 3', 2, 8, '2016-11-24 18:08:22', 0),
(16, 'Post 4', 2, 8, '2016-11-24 18:08:28', 0),
(17, 'I love balay cawayan!!!', 2, 2, '2016-11-24 18:47:03', 0),
(18, 'a\r\n', 2, 2, '2016-11-24 19:20:40', 0),
(19, '', 2, 2, '2016-11-24 19:20:44', 0),
(20, 'asdasdasdd', 2, 2, '2016-11-24 20:19:46', 0),
(22, 'Komsai <3', 2, 2, '2016-11-24 22:01:56', 1),
(23, 'Hehe. POSTING DONE!', 2, 2, '2016-11-24 22:15:34', 1),
(24, 'Just posted an inception. ðŸ˜ƒ ðŸ¤¤', 2, 2, '2016-11-24 22:16:50', 0),
(25, 'Hello', 2, 2, '2016-11-24 22:29:38', 1),
(26, '', 2, 2, '2016-11-25 03:34:20', 1),
(27, 'a', 2, 2, '2016-11-25 04:43:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `account_id` int(9) NOT NULL,
  `place_id` int(9) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `acc_id` int(9) NOT NULL,
  `post_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upvote`
--

CREATE TABLE `upvote` (
  `acc_id` int(9) NOT NULL,
  `post_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`place_id`,`acc_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `posted`
--
ALTER TABLE `posted`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`account_id`,`place_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `place_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `posted`
--
ALTER TABLE `posted`
  MODIFY `post_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
