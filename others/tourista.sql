-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2016 at 02:03 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

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
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(30) NOT NULL,
  `about_me` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `username`, `firstname`, `middlename`, `lastname`, `password`, `email`, `address`, `about_me`) VALUES
(1, 'clyde', 'Clyde', 'Middlenameclyde', 'Delgado', 'Delgado', 'clydedelgado@gmail.com', 'San Jose, Antique', 'Draw paint create master doctor derma '),
(2, 'maynard', 'Maynard', 'Fuentes', 'Vargas', 'vargas', 'vargasmaynard@gmail.com', 'Kalibo, Aklan', 'Best foods, natures spring, C2 tea. Dragon. '),
(3, 'rollin', 'Rollin', 'Dragonmaster', 'Pacheco', 'pacheco', 'rollinpachecko@gmail.com', 'Rollin City, Pacheco', 'Rollin in the deep.'),
(4, 'alonzo', 'Alonzo', 'Middlename', 'Locsin', 'locsin', 'alonzolocsin@gmail.com', 'Alonzo City, Locsin, Iloilo', 'Ace hardware ace hardware.'),
(5, 'andrew', 'Andrew', 'mname', 'Dagdag', 'dagdag', 'andrewdagdag@gmail.com', 'Andrew City, Dagdag', 'I am Andrew D.'),
(6, 'diana', 'Diana Chris', 'middle', 'Pacaña', 'pacana', 'diana@gmail.com', 'Diana City, Miagao', 'Diana diana diana'),
(7, 'donn', 'Donn', 'Middle', 'Cruz', 'cruz', 'donn_cruz@gmail.com', 'Address, Negros', 'Ako si Donn.'),
(8, 'angelica', 'Ma. Angelica', 'Middlename', 'Talabucon', 'talabucon', 'jing@gmail.com', 'Somewhere, Capiz', 'Ako si Jong. '),
(9, 'rosiebelt', 'Rosiebelt Jun', 'Ayupan', 'Abisado', 'abisado', 'beltjun@gmail.com', 'Lemery, Iloilo', 'About about about rosiebelt.'),
(10, 'rosjel', 'Rosjel Jolly', 'Pamposa', 'Lambungan', 'lambungan', 'lambunganrosjel@gmail.com', 'Dueñas, Iloilo', 'Ako jolly jolly gid.'),
(11, 'salvy', 'Salvy Jessa', 'Middle', 'Arnaiz', 'arnaiz', 'arnaiz@gmail.com', 'My Address, Somewhere', 'Hahahaha. '),
(12, 'shebna', 'Shebna Rose', 'Middle', 'Fabilloren', 'fabilloren', 'shebnarose@gmail.com', 'Somewhere, Negros', 'Ako shebna shebna');

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

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `post_id` int(9) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`post_id`, `name`) VALUES
(7, 'place-5555'),
(8, 'place-4555'),
(9, 'place-4412');

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
(4, 'Plaza Miagao', 'Plaza sng Miagao', '2'),
(5, 'College of Arts and Sciences (CAS)', 'College of really cool people.', '1'),
(6, 'College of Fisheries and Ocean Studies', 'Isda isda fish fish', '2');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(9) NOT NULL,
  `content` varchar(70) NOT NULL,
  `acc_id` int(9) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `content`, `acc_id`, `time`, `location_id`) VALUES
(1, 'Content of the post here', 2, '0000-00-00 00:00:00.000000', 'ChIJCfn0zHZcrjMRqI11lJHSPGY'),
(2, 'Content of the post here', 4, '0000-00-00 00:00:00.000000', 'ChIJCfn0zHZcrjMRqI11lJHSPGY'),
(3, 'content here', 5, '2016-11-22 17:11:24.235000', 'ChIJT4bs8HBcrjMR5uNjfChF9NA'),
(4, 'Content here', 3, '0000-00-00 00:00:00.000000', 'ChIJ9SnGYYdbrjMRzTDMRHiMCos'),
(7, 'Content here', 9, '0000-00-00 00:00:00.000000', 'ChIJETTaZCNVrjMRg1BnBP-10a0'),
(8, 'Content here', 9, '0000-00-00 00:00:00.000000', 'ChIJPQHr8x8tkTMRWA3o67UViy0'),
(9, 'Content here', 9, '2016-11-22 20:24:24.662639', 'ChIJxW6uf4pbrjMRsZwTF9N9lko');

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
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`post_id`,`name`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`place_id`);

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
  MODIFY `acc_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `place_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
