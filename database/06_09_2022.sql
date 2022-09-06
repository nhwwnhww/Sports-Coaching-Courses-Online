-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2022 at 07:49 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fia3_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `mentee_id` int(11) DEFAULT NULL,
  `mentor_id` int(11) DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `mentee_id`, `mentor_id`, `sport_id`, `city`, `date`, `feedback`) VALUES
(1, 1, 2, 3, 'SPRINGWOOD', '2022-08-28-10:06', NULL),
(2, 3, 1, 2, 'SPRINGFIELD LAKES', '2022-08-27-11:11', NULL),
(3, 3, 1, 3, 'SPRINGFIELD LAKES', '2022-08-24-01:30', NULL),
(4, 3, 2, 3, 'SPRINGWOOD', '2022-08-28-10:06', NULL),
(5, 3, 1, 1, 'SPRINGFIELD LAKES', '2022-08-20-01:28', NULL),
(8, 1, 3, 3, 'SPRINGFIELD LAKES', '2022-08-04-11:18', NULL),
(9, 1, 3, 3, 'SPRINGFIELD LAKES', '2022-08-10-13:19', NULL),
(15, 2, 1, 1, 'SPRINGFIELD LAKES', '2022-08-20-01:28', NULL),
(16, 2, 1, 2, 'SPRINGFIELD LAKES', '2022-08-27-11:11', NULL),
(17, 2, 4, 1, '', '-', NULL),
(18, 1, 4, 1, '', '2022-08-05-13:15', NULL),
(19, 1, 3, 2, 'SPRINGFIELD LAKES', '2022-08-10-10:53', NULL),
(20, 5, 1, 3, 'SPRINGFIELD LAKES', '2022-08-24-01:30', NULL),
(21, 5, 3, 2, 'SPRINGFIELD LAKES', '2022-08-10-10:53', NULL),
(22, 5, 3, 3, 'SPRINGFIELD LAKES', '2022-08-04-11:18', NULL),
(23, 5, 4, 1, '', '2022-08-05-13:15', NULL),
(24, 5, 1, 2, 'SPRINGFIELD LAKES', '2022-08-27-11:11', NULL),
(25, 6, 1, 2, 'SPRINGFIELD LAKES', '2022-08-27-11:11', NULL),
(26, 6, 3, 3, 'SPRINGFIELD LAKES', '2022-08-04-11:18', NULL),
(27, 7, 5, 3, '', '2022-08-25-03:00', NULL),
(28, 8, 3, 3, 'SPRINGFIELD LAKES', '2022-08-10-13:19', NULL),
(29, 8, 1, 3, 'SPRINGFIELD LAKES', '2022-08-11-11:35', NULL),
(30, 8, 3, 3, 'SPRINGFIELD LAKES', '2022-08-04-11:18', NULL),
(31, 8, 5, 3, '', '2022-08-25-03:00', NULL),
(32, 1, 5, 3, '', '2022-08-25-03:00', NULL),
(33, 1, 8, 2, 'SPRINGFIELD LAKES', '2022-08-12-06:51', NULL),
(34, 1, 4, 1, '', '-', NULL),
(35, 1, 4, 1, '', '2022-08-25-11:32', NULL),
(36, 3, 1, 1, 'SPRINGFIELD LAKES', '2022-08-20T13:44', NULL),
(37, 5, 2, 3, 'SPRINGWOOD', '2022-08-28-10:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `sport_average_level` int(11) DEFAULT NULL,
  `participate_number` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`game_id`, `sport_id`, `sport_average_level`, `participate_number`, `city`, `time`) VALUES
(1, 1, 3, 1, 'SPRINGFIELD LAKES', '2022-08-25T10:06'),
(2, 3, 10, 1, 'SPRINGFIELD LAKES', '2022-09-02T10:06'),
(3, 3, 2, 2, 'SPRINGWOOD', '2022-08-26T10:07'),
(4, 1, 1, 22, 'SPRINGWOOD', '2022-08-28T07:30'),
(5, 1, 1, 1, 'SPRINGWOOD', '2022-08-31T07:31'),
(6, 2, 2, 1, 'SPRINGFIELD LAKES', '2022-08-29T07:44'),
(7, 1, 3, 1, 'SPRINGFIELD LAKES', ''),
(8, 1, 3, 1, 'SPRINGFIELD LAKES', '2022-09-01T02:33'),
(9, 1, 3, 1, 'SPRINGFIELD LAKES', '2022-08-19T14:57');

-- --------------------------------------------------------

--
-- Table structure for table `mentor_session`
--

CREATE TABLE `mentor_session` (
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `mentor_id` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mentor_session`
--

INSERT INTO `mentor_session` (`session_id`, `sport_id`, `mentor_id`, `city`, `date`) VALUES
(1, 1, 1, 'SPRINGFIELD LAKES', '2022-08-20-01:28'),
(2, 3, 1, 'SPRINGFIELD LAKES', '2022-08-24-01:30'),
(3, 3, 2, 'SPRINGWOOD', '2022-08-28-10:06'),
(4, 2, 1, 'SPRINGFIELD LAKES', '2022-08-27-11:11'),
(5, 2, 3, 'SPRINGFIELD LAKES', '2022-08-10-10:53'),
(6, 3, 3, 'SPRINGFIELD LAKES', '2022-08-04-11:18'),
(7, 3, 3, 'SPRINGFIELD LAKES', '2022-08-10-13:19'),
(8, 1, 4, '', '2022-08-05-13:15'),
(9, 3, 5, '', '2022-08-25-03:00'),
(10, 1, 4, '', '-'),
(11, 1, 4, '', '2022-08-25-11:32'),
(12, 3, 1, 'SPRINGFIELD LAKES', '2022-08-11-11:35'),
(13, 2, 8, 'SPRINGFIELD LAKES', '2022-08-12-06:51'),
(14, 1, 1, 'SPRINGFIELD LAKES', '2022-09-01T14:31'),
(15, 2, 1, 'SPRINGFIELD LAKES', '2022-08-25T13:40'),
(16, 1, 1, 'SPRINGFIELD LAKES', '2022-08-20T13:44'),
(17, 1, 3, 'SPRINGFIELD LAKES', '2022-08-19T06:00'),
(18, 1, 5, 'SPRINGFIELD LAKES', '2022-09-17T11:33'),
(19, 8, 1, 'SPRINGFIELD LAKES', '2022-09-16T10:29');

-- --------------------------------------------------------

--
-- Table structure for table `participate`
--

CREATE TABLE `participate` (
  `participate_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `sport_level` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participate`
--

INSERT INTO `participate` (`participate_id`, `user_id`, `sport_id`, `sport_level`, `game_id`) VALUES
(1, 1, 1, 3, 1),
(2, 1, 3, 10, 2),
(3, 2, 3, 1, 3),
(4, 2, 1, 1, 4),
(5, 2, 1, 1, 5),
(6, 1, 1, 2, 4),
(7, 4, 1, 1, 4),
(12, 5, 1, 1, 4),
(13, 1, 2, 2, 6),
(14, 8, 3, 2, 3),
(15, 1, 1, 3, 7),
(16, 1, 1, 3, 8),
(17, 3, 1, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `user_id` int(11) NOT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `sport_level` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`user_id`, `sport_id`, `sport_level`) VALUES
(1, 1, 3),
(1, 2, 3),
(1, 3, 4),
(2, 1, 3),
(2, 2, 2),
(2, 3, 5),
(3, 1, 3),
(3, 3, 4),
(3, 2, 3),
(4, 3, 2),
(5, 3, 5),
(5, 2, 4),
(4, 1, 5),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(0, 0, 1),
(5, 1, 2),
(6, 2, 2),
(6, 3, 2),
(7, 3, 2),
(8, 3, 5),
(1, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

CREATE TABLE `sport` (
  `sport_id` bigint(20) UNSIGNED NOT NULL,
  `sport_name` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `sport_describe` varchar(255) DEFAULT NULL,
  `sport_max_level` int(11) DEFAULT NULL,
  `sport_book_time` int(11) DEFAULT NULL,
  `sport_max_participate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sport`
--

INSERT INTO `sport` (`sport_id`, `sport_name`, `img_url`, `sport_describe`, `sport_max_level`, `sport_book_time`, `sport_max_participate`) VALUES
(1, 'Football', './sport_img/football.png', 'Association football, more commonly known as simply football or soccer, is a team sport played between two teams of 11 players who primarily use their feet to propel the ball around a rectangular field called a pitch.', 10, 9, 22),
(2, 'Basketball', './sport_img/basketball.png', 'Basketball is a team sport in which two teams, most commonly of five players each, opposing one another on a rectangular court, compete with the primary objective of shooting a basketball (approximately 9.4 inches (24 cm) in diameter) through the defender', 10, 7, 10),
(3, 'Tennis', './sport_img/tennis.png', 'Tennis is a racket sport that is played either individually against a single opponent or between two teams of two players each.', 10, 43, 4),
(4, 'badminton', './sport_img/badminton.png', 'Badminton is a racquet sport played using racquets to hit a shuttlecock across a net.', 10, NULL, 4),
(5, 'baseball', './sport_img/baseball.png', 'Baseball is a bat-and-ball sport played between two teams of nine players each, taking turns batting and fielding.', 10, NULL, 9),
(6, 'golf', './sport_img/golf.png', 'Golf is a club-and-ball sport in which players use various clubs to hit balls into a series of holes on a course in as few strokes as possible.', 10, NULL, 20),
(7, 'karate', './sport_img/karate.png', 'Karate is a martial art developed in the Ryukyu Kingdom. It developed from the indigenous Ryukyuan martial arts under the influence of Chinese martial arts, particularly Fujian White Crane.', 10, NULL, 25),
(8, 'rugby', './sport_img/rugby.png', 'Rugby union, commonly known simply as rugby, is a close-contact combat team sport that originated at Rugby School in the first half of the 19th century. One of the two codes of rugby football, it is based on running with the ball in hand.', 10, NULL, 30),
(9, 'swimming', './sport_img/swimming.png', 'the sport or activity of propelling oneself through water using the limbs.', 10, NULL, 10),
(10, 'volleyball', './sport_img/volleyball.png', 'Volleyball is a team sport in which two teams of six players are separated by a net. Each team tries to score points by grounding a ball on the other teams court under organized rules. It has been a part of the official program of the Summer Olympic Games', 10, NULL, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `is_admin` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `img_url`, `city`, `email`, `age`, `phone`, `is_admin`) VALUES
(1, 'nhwwnhww', '123', './user_img/try.png.png', 'SPRINGFIELD LAKES', 'nhwenhww@gmail.com', 18, 404961471, 1),
(2, '123', '123', NULL, 'SPRINGWOOD', 'gaoyixuan20@gmail.com', 14, 0, NULL),
(3, 'springfield', '123', './user_img/iphone_oryx.png.png', 'SPRINGFIELD LAKES', 'springfield@lol.com', 11, 404961471, NULL),
(4, 'jainil', 'password', NULL, NULL, 'jpunj1@eq.edu.au', NULL, NULL, NULL),
(5, 'lol', 'asdf', './user_img/nice.png.png', 'SPRINGFIELD LAKES', '123123', 0, 404961471, NULL),
(6, 'ruben', 'ruben', './user_img/IMG_1886.JPG.png', 'SPRINGFIELD LAKES', 'rubenmartini2006@gmail.com', 16, 404961471, NULL),
(7, 'HackTec', 'HailHackTec', NULL, 'Earth', 'HackTec@Hack.com.jo', 500000, 999999999, NULL),
(8, 'tin', ':)', './user_img/IMG_1866.JPG.png', 'SPRINGFIELD LAKES', 'tin@tin.com', 2300, 404961471, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `city` (`city`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `sport_id` (`sport_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `mentor_session`
--
ALTER TABLE `mentor_session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `user_id` (`mentor_id`),
  ADD KEY `city` (`city`);

--
-- Indexes for table `participate`
--
ALTER TABLE `participate`
  ADD PRIMARY KEY (`participate_id`),
  ADD KEY `sport_id` (`sport_id`),
  ADD KEY `sport_level` (`sport_level`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`sport_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `game_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mentor_session`
--
ALTER TABLE `mentor_session`
  MODIFY `session_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `participate`
--
ALTER TABLE `participate`
  MODIFY `participate_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `sport_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
