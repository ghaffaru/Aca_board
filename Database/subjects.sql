-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2018 at 11:20 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aca_board`
--

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subj_id` int(11) NOT NULL,
  `mod_id` int(11) NOT NULL,
  `subj_name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subj_id`, `mod_id`, `subj_name`) VALUES
(1, 1, 'Biochemistry'),
(2, 1, 'Histology'),
(3, 1, 'Physiology'),
(4, 1, 'Pharmacology'),
(5, 1, 'Embryology'),
(6, 2, 'Biochemistry'),
(7, 3, 'Biochemistry'),
(8, 3, 'Pathology'),
(9, 3, 'Haematology'),
(10, 4, 'Gross Anatomy'),
(11, 4, 'Embryology'),
(12, 4, 'Physiology'),
(13, 4, 'Pharmacology'),
(14, 5, 'Gross Anatomy'),
(15, 5, 'Physiology'),
(16, 5, 'Histology'),
(17, 5, 'Embryology'),
(18, 6, 'Microbiology'),
(19, 7, 'Gross Anatomy'),
(20, 7, 'Physiology'),
(21, 7, 'Histology'),
(22, 7, 'Embryology'),
(23, 8, 'Gross Anatomy'),
(24, 8, 'Physiology'),
(25, 8, 'Histology'),
(26, 8, 'Embryology'),
(27, 9, 'Pathology'),
(28, 9, 'Chemical Pathology'),
(29, 9, 'Pharmacology'),
(30, 11, 'Pathology'),
(33, 13, 'Microbiology'),
(34, 15, 'Pathology'),
(35, 15, 'Chemical Pathology'),
(36, 15, 'Pharmacology');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subj_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
