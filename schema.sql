-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 11, 2014 at 12:14 AM
-- Server version: 5.5.37-cll
-- PHP Version: 5.4.23

/*
 * Copyright (C) 2014 radsaggi(ashutosh)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `njath`
--

-- --------------------------------------------------------

--
-- Table structure for table `Contestants`
--

CREATE TABLE IF NOT EXISTS `Contestants` (
  `Username` varchar(15) NOT NULL,
  `Anwesha ID` varchar(9) NOT NULL,
  `Hash` varchar(60) NOT NULL,
  `Disqualified` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `ContestantsData`
--

CREATE TABLE IF NOT EXISTS `ContestantsData` (
  `Username` varchar(15) NOT NULL,
  `Level` int(11) NOT NULL DEFAULT '1',
  `Level Score` int(11) NOT NULL DEFAULT '40',
  `Total Score` int(11) NOT NULL DEFAULT '40',
  `Hints` int(11) NOT NULL DEFAULT '5',
  `TChests Unlocked` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Username`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `Questions`
--

CREATE TABLE IF NOT EXISTS `Questions` (
  `Question ID` varchar(3) NOT NULL,
  `Type` smallint(6) NOT NULL DEFAULT '3',
  `Question Text` varchar(400) DEFAULT NULL,
  `Question Picture` varchar(20) DEFAULT NULL,
  `Hint` varchar(200) NOT NULL,
  `Answer Regular` varchar(25) NOT NULL,
  `Answer Hinted` varchar(25) NOT NULL,
  PRIMARY KEY (`Question ID`),
  UNIQUE KEY `Question ID` (`Question ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `QuestionSolves`
--

CREATE TABLE IF NOT EXISTS `QuestionSolves` (
  `Question ID` varchar(3) NOT NULL,
  `First Solve` int(11) NOT NULL DEFAULT '-1',
  `Solves` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Question ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `stud`
--

CREATE TABLE IF NOT EXISTS `stud` (
  `name` varchar(255) NOT NULL,
  `rollno` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `room` int(3) NOT NULL,
  `hostel` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `contact` text NOT NULL,
  `anw_id` varchar(255) NOT NULL,
  `feepaid` enum('y','n') DEFAULT 'n',
  PRIMARY KEY (`rollno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
