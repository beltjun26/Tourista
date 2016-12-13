-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2016 at 11:01 PM
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
(12, 'shebna', 'Shebna Rose', 'Fabilloren', '38a542d4677b83db32880b30057eacf7', 'shebnarose@gmail.com', 'Ako shebna shebna'),
(20, 'hello', 'Hello', 'World', '6a864555478cae0aa7751f19123973ac', 'hello@gmail.com', '');

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
(18, 3),
(10, 2),
(9, 10),
(10, 9),
(10, 5),
(4, 10),
(4, 2),
(4, 12),
(2, 4),
(2, 12),
(2, 9),
(2, 5),
(10, 4),
(10, 12),
(10, 3),
(20, 2);

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

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notif_id`, `redirect_id`, `user_id_from`, `notif_type`, `time_stamp_notif`) VALUES
(1, 10, 10, 3, '2016-12-12 14:49:52'),
(2, 1, 10, 2, '2016-12-12 14:51:34'),
(3, 2, 2, 2, '2016-12-12 14:55:36'),
(4, 0, 2, 2, '2016-12-12 14:56:30'),
(5, 0, 2, 2, '2016-12-12 14:59:48'),
(6, 0, 2, 2, '2016-12-12 15:02:21'),
(7, 3, 9, 2, '2016-12-12 15:07:21'),
(8, 9, 9, 3, '2016-12-12 15:07:36'),
(9, 0, 2, 2, '2016-12-12 15:10:36'),
(10, 4, 5, 2, '2016-12-12 15:26:21'),
(11, 5, 5, 2, '2016-12-12 15:27:25'),
(12, 6, 2, 2, '2016-12-12 15:31:26'),
(13, 7, 10, 2, '2016-12-12 15:37:07'),
(14, 8, 2, 2, '2016-12-12 15:39:24'),
(15, 9, 5, 2, '2016-12-12 15:41:43'),
(16, 10, 5, 2, '2016-12-12 15:42:57'),
(17, 10, 10, 3, '2016-12-12 15:44:13'),
(18, 10, 10, 3, '2016-12-12 15:44:23'),
(19, 11, 10, 2, '2016-12-12 15:45:19'),
(20, 12, 10, 2, '2016-12-12 15:45:51'),
(21, 13, 10, 2, '2016-12-12 15:48:01'),
(22, 14, 9, 2, '2016-12-12 15:49:32'),
(23, 15, 2, 2, '2016-12-12 15:55:19'),
(24, 16, 2, 2, '2016-12-12 15:56:31'),
(25, 17, 12, 2, '2016-12-12 15:57:37'),
(26, 18, 4, 2, '2016-12-12 15:58:53'),
(27, 4, 4, 3, '2016-12-12 15:59:05'),
(28, 4, 4, 3, '2016-12-12 15:59:20'),
(29, 19, 3, 2, '2016-12-12 16:00:29'),
(30, 20, 12, 2, '2016-12-12 16:01:51'),
(31, 4, 4, 3, '2016-12-12 16:02:17'),
(32, 21, 4, 2, '2016-12-12 16:03:06'),
(33, 2, 2, 3, '2016-12-12 16:03:44'),
(34, 2, 2, 3, '2016-12-12 16:03:54'),
(35, 2, 2, 3, '2016-12-12 16:04:07'),
(36, 2, 2, 3, '2016-12-12 16:04:29'),
(37, 2, 2, 3, '2016-12-12 16:04:31'),
(38, 22, 2, 2, '2016-12-12 16:05:47'),
(39, 23, 2, 2, '2016-12-12 16:08:27'),
(40, 24, 10, 2, '2016-12-12 16:10:44'),
(41, 25, 10, 2, '2016-12-12 16:11:44'),
(42, 26, 10, 2, '2016-12-12 16:14:31'),
(43, 27, 10, 2, '2016-12-12 16:15:45'),
(44, 28, 9, 2, '2016-12-12 16:17:46'),
(45, 29, 2, 2, '2016-12-12 16:19:08'),
(46, 30, 10, 2, '2016-12-12 16:20:16'),
(47, 10, 10, 3, '2016-12-12 16:20:55'),
(48, 10, 10, 3, '2016-12-12 16:21:03'),
(49, 10, 10, 3, '2016-12-12 16:21:22'),
(50, 20, 20, 3, '2016-12-12 17:28:53'),
(51, 30, 2, 1, '2016-12-12 20:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `notified`
--

CREATE TABLE `notified` (
  `notif_id` int(9) NOT NULL,
  `user_id_notified` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notified`
--

INSERT INTO `notified` (`notif_id`, `user_id_notified`) VALUES
(1, 2),
(8, 10),
(17, 9),
(18, 5),
(27, 10),
(28, 2),
(31, 12),
(33, 4),
(34, 12),
(35, 9),
(36, 5),
(37, 5),
(47, 4),
(48, 12),
(49, 3),
(50, 2),
(51, 10);

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
(6, 'College of Fisheries and Ocean Studies', 'Isda isda fish fish', 'ChIJG1tKfY1CrjMRRMPdEBPMm_g'),
(13, 'Boracay Island', 'Fun place to be.', 'ChIJ505LMi88pTMRNtptXh7oOKc'),
(14, 'Antique', 'Fun place to be', 'ChIJV2I832m5rzMRgS3oyKxYVMA'),
(15, 'Bucari, Leon', 'Fun', 'ChIJyUsgcMpUrjMRpQ4Enh2xa6c'),
(16, 'Carribean Resort', 'hi', 'ChIJschKRAp_3YgR_NHSXu6lkqI'),
(17, 'Sulu Garden', 'Mahal', 'ChIJx1zXwHBcrjMRKyRZxi6P2bY'),
(18, 'UPV', 'Kabuluang', 'ChIJh-n_S0PlrjMRSknta1YqIY8'),
(19, 'University of the Philippines, Visayas Miagao Camp', 'Mahal', 'ChIJ9SnGYYdbrjMRzTDMRHiMCos'),
(20, 'Atria Park District, Donato Pison Avenue, Iloilo C', 'Haha', 'ChIJQ6JMi0jlrjMRP88uS3qqHzk'),
(21, 'Atria Park District, Donato Pison Avenue, Iloilo C', 'Layo', 'ChIJN6AI9mxf74gRBtMrGMAhRl4'),
(22, 'Bohol', 'Saya', 'ChIJ31ShG94XqjMRINAYIQS_yGs'),
(23, 'Cebu City', 'Queen City', 'ChIJ_S3NjSWZqTMRBzXT2wwDNEw'),
(24, 'Taoist Temple Cebu, Cebu City, Central Visayas, Ph', 'Solemn', 'ChIJRWw8AyuZqTMR9sDlVvA6oIg'),
(25, 'Guimaras, Western Visayas, Philippines', 'sd', 'ChIJ0SCN80PsrjMR_N5Wa1eJuSQ'),
(26, 'La Pachira Mountain View Resort, Nueva Valencia, W', 'sd', 'ChIJW9e_HTmMrjMRle99RPnqnyM'),
(27, 'Iloilo City, Western Visayas, Philippines', 'Love', 'ChIJgdc45W_lrjMRiKQwvNYMJeg'),
(28, 'Baguio, Cordillera Administrative Region, Philippi', 'Best', 'ChIJP_HeeWihkTMRwHU6vjT13o4'),
(29, 'Manila', 's', 'ChIJi8MeVwPKlzMRH8FpEHXV0Wk'),
(30, 'Mactan, Lapu-Lapu City, Central Visayas, Philippin', 'sd', 'ChIJS3_qVxiXqTMRi9ja7VQwHhY'),
(31, 'Guimaras Island', 's', 'ChIJk1kVDUPsrjMRQ9ySpxb5Zks'),
(32, 'Iloilo Grand Hotel', 'mahal', 'ChIJm_k5i2TlrjMR4iIdTWqvMKg');

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
(3, 'Kayo na ang humusga...', 13, 9, '2016-12-12 15:07:20', 1),
(8, 'Anona plan ta guys lol', 6, 2, '2016-12-12 15:39:24', 1),
(10, 'Bleeeeeh', 4, 5, '2016-12-12 15:42:56', 1),
(12, 'Team Bracket B. Haha', 17, 10, '2016-12-12 15:45:51', 1),
(13, 'Kyat-kyat', 18, 10, '2016-12-12 15:48:01', 1),
(16, '', 22, 2, '2016-12-12 15:56:31', 1),
(17, 'Faith.', 23, 12, '2016-12-12 15:57:37', 1),
(18, 'Twin Dragons.', 24, 4, '2016-12-12 15:58:53', 1),
(19, 'Take me baaackkkkk <3', 22, 3, '2016-12-12 16:00:29', 1),
(20, 'Friendship.', 25, 12, '2016-12-12 16:01:51', 1),
(21, 'Part 2 pleaseee', 26, 4, '2016-12-12 16:03:06', 1),
(23, 'Pappieeees. ', 4, 2, '2016-12-12 16:08:27', 1),
(26, 'Where do broekn hearted squad go ba nga ba? :(', 30, 10, '2016-12-12 16:14:31', 1),
(27, 'Throwback to my meh self lol', 31, 10, '2016-12-12 16:15:45', 1),
(28, 'u be the judge', 4, 9, '2016-12-12 16:17:45', 1),
(29, 'love you forever, pretty <3', 32, 2, '2016-12-12 16:19:08', 1),
(30, 'pati ba naman puno sagabal sa pagmamahalan haha ', 15, 10, '2016-12-12 16:20:16', 1);

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

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`acc_id`, `place_id`, `comment`, `rating_no`) VALUES
(2, 15, 'The best. <3', 4),
(3, 15, 'Ang lamig pero ang ganda! ', 5);

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
-- Dumping data for table `upvote`
--

INSERT INTO `upvote` (`acc_id`, `post_id`) VALUES
(2, 30);

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
  MODIFY `acc_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `place_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `posted`
--
ALTER TABLE `posted`
  MODIFY `post_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
