-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2022 at 07:10 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `mid` int(11) NOT NULL,
  `m_uid` int(11) DEFAULT NULL,
  `m_rid` int(11) DEFAULT NULL,
  `mstatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mid`, `m_uid`, `m_rid`, `mstatus`) VALUES
(1, 1, 1, 1),
(6, 2, 1, 1),
(19, 1, 9, 1),
(22, 3, 1, 1),
(28, 3, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msid` int(11) NOT NULL,
  `ms_uid` int(11) DEFAULT NULL,
  `ms_rid` int(11) DEFAULT NULL,
  `msdatetime` datetime DEFAULT NULL,
  `mstext` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msid`, `ms_uid`, `ms_rid`, `msdatetime`, `mstext`) VALUES
(21, 1, 9, '2022-02-15 17:57:00', 'Hey'),
(22, 3, 9, '2022-02-15 17:59:27', 'Hey'),
(23, 3, 9, '2022-02-15 18:04:19', 'Whats up?'),
(24, 1, 9, '2022-02-15 18:04:30', 'Not much'),
(25, 3, 9, '2022-02-15 19:00:31', 'Haha');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `rid` int(11) NOT NULL,
  `rname` varchar(15) DEFAULT NULL,
  `rowner` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`rid`, `rname`, `rowner`) VALUES
(1, 'General', NULL),
(9, 'Dimitris', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `uusername` varchar(15) DEFAULT NULL,
  `uname` varchar(15) DEFAULT NULL,
  `usurname` varchar(20) DEFAULT NULL,
  `upass` varchar(15) DEFAULT NULL,
  `uemail` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `uusername`, `uname`, `usurname`, `upass`, `uemail`) VALUES
(1, 'sarjim', 'Dimitris', 'Sarris', 'Aa123456789!@#$', 'sarjim99@gmail.com'),
(2, 'Mauros', 'Dimitris', 'Sarris', 'Aa123456789!@#', 'dsarris99@gmail.com'),
(3, 'Stef', 'Eirini', 'Stef', 'Aa123456789!@#', 'ASf@asfk.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msid`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
