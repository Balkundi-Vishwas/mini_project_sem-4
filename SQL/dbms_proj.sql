-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2022 at 11:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+05:30";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbms_proj`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `aname` varchar(25) NOT NULL,
  `uname` varchar(25) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bid` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `price` smallint(6) NOT NULL,
  `occupied` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `seat_id` int(11) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `class` varchar(20) NOT NULL,
  `seat_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `sport_event`
--

CREATE TABLE `sport_event` (
  `eid` int(11) NOT NULL,
  `ename` varchar(50) NOT NULL,
  `edate` date NOT NULL,
  `etime` time NOT NULL,
  `sname` varchar(50) NOT NULL,
  `eimg` varchar(50) NOT NULL,
  `edesc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `stadium`
--

CREATE TABLE `stadium` (
  `sname` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `simg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `ticket_info`
--

CREATE TABLE `ticket_info` (
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `bid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `uname` varchar(25) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `seat_id` (`seat_id`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`seat_id`),
  ADD UNIQUE KEY `sname` (`sname`,`class`,`seat_num`);

--
-- Indexes for table `sport_event`
--
ALTER TABLE `sport_event`
  ADD PRIMARY KEY (`eid`),
  ADD UNIQUE KEY `edate` (`edate`,`etime`,`sname`),
  ADD KEY `sname` (`sname`);

--
-- Indexes for table `stadium`
--
ALTER TABLE `stadium`
  ADD PRIMARY KEY (`sname`);

--
-- Indexes for table `ticket_info`
--
ALTER TABLE `ticket_info`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `ticket_info_ibfk_1` (`bid`),
  ADD KEY `ticket_info_ibfk_2` (`uid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sport_event`
--
ALTER TABLE `sport_event`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_info`
--
ALTER TABLE `ticket_info`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`seat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`eid`) REFERENCES `sport_event` (`eid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`sname`) REFERENCES `stadium` (`sname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sport_event`
--
ALTER TABLE `sport_event`
  ADD CONSTRAINT `sport_event_ibfk_1` FOREIGN KEY (`sname`) REFERENCES `stadium` (`sname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_info`
--
ALTER TABLE `ticket_info`
  ADD CONSTRAINT `ticket_info_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `booking` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_info_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
