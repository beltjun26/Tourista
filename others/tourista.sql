-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2016 at 03:01 PM
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
  `password` varchar(100) NOT NULL,
  `email` varchar(40) NOT NULL,
  `about_me` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `username`, `firstname`, `lastname`, `password`, `email`, `about_me`) VALUES
(1, 'clyde', 'Clyde', 'Delgado', '1f3e1525c6ee8678781be4b3dd87f778', 'clydedelgado@gmail.com', 'Draw paint create master doctor derma '),
(2, 'maynard', 'Maynard', 'Vargas', '63a090d564111973d07fc57a2c1a3a4d', 'vargasmaynard@gmail.com', 'asdfghjk12345678'),
(3, 'rollin', 'Rollin', 'Pacheco', 'e3b9592341f871b73ecff949459ba9c1', 'rollinpachecko@gmail.com', 'Rollin in the deep.'),
(4, 'alonzo', 'Alonzo', 'Locsin', '0d2c075f8c7fe0ccb116bc03c9f6fac2', 'alonzolocsin@gmail.com', 'Ace hardware ace hardware.'),
(5, 'andrew', 'Andrew', 'Dagdag', '0fd3764434fe203a9079675d7925a0ee', 'andrewdagdag@gmail.com', 'I am Andrew D.'),
(6, 'diana', 'Diana Chris', 'Pacaña', '76409f904586a65c02a4b0dadce8a033', 'diana@gmail.com', 'Diana diana diana'),
(7, 'donn', 'Donn', 'Cruz', '52c7915d4e0b6d93268b1f63bfd4578b', 'donn_cruz@gmail.com', 'Ako si Donn.'),
(8, 'angelica', 'Ma. Angelica', 'Talabucon', 'b2a7885c40e12bc9478916ff561937c9', 'jing@gmail.com', 'Ako si Jong. '),
(9, 'rosiebelt', 'Rosiebelt Jun', 'Abisado', 'b60a41f4619d920abe5550473176f2e3', 'beltjun@gmail.com', 'About about about rosiebelt.'),
(10, 'rosjel', 'Rosjel Jolly', 'Lambungan', 'b853337477f12302aee400fa56edfcbf', 'lambunganrosjel@gmail.com', 'Adventure junkie\r\n'),
(11, 'salvy', 'Salvy Jessa', 'Arnaiz', '734a5311c4b5470784a16f600297b9ac', 'arnaiz@gmail.com', 'Hahahaha. '),
(12, 'shebna', 'Shebna Rose', 'Fabilloren', '38a542d4677b83db32880b30057eacf7', 'shebnarose@gmail.com', 'Ako shebna shebna');

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
(9, 3),
(12, 2),
(1, 2),
(9, 2),
(18, 2),
(18, 8),
(18, 3);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_id` int(9) NOT NULL,
  `redirect_id` int(9) NOT NULL,
  `user_id_from` int(9) NOT NULL,
  `notif_type` int(1) NOT NULL,
  `time_stamp_notif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notified`
--

CREATE TABLE `notified` (
  `notif_id` int(9) NOT NULL,
  `user_id_notified` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `place_id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `location_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`place_id`, `name`, `description`, `location_id`) VALUES
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

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `acc_id` int(9) NOT NULL,
  `place_id` int(9) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `rating_no` int(9) NOT NULL
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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_id`);

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
  ADD PRIMARY KEY (`acc_id`,`place_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `place_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `posted`
--
ALTER TABLE `posted`
  MODIFY `post_id` int(9) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
