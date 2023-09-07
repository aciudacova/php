-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2023 at 10:42 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orase`
--

-- --------------------------------------------------------

--
-- Table structure for table `orase`
--

CREATE TABLE `orase` (
  `codOras` int(11) NOT NULL,
  `denumire` varchar(20) NOT NULL,
  `numarulLocuitori` int(11) NOT NULL,
  `codTara` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orase`
--

INSERT INTO `orase` (`codOras`, `denumire`, `numarulLocuitori`, `codTara`) VALUES
(1, 'Chisinau', 100000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tara`
--

CREATE TABLE `tara` (
  `codTara` int(11) NOT NULL,
  `denumire` varchar(20) NOT NULL,
  `continent` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tara`
--

INSERT INTO `tara` (`codTara`, `denumire`, `continent`) VALUES
(1, 'Moldova', 'Eurasia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orase`
--
ALTER TABLE `orase`
  ADD PRIMARY KEY (`codOras`),
  ADD KEY `cod` (`codTara`);

--
-- Indexes for table `tara`
--
ALTER TABLE `tara`
  ADD PRIMARY KEY (`codTara`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orase`
--
ALTER TABLE `orase`
  MODIFY `codOras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tara`
--
ALTER TABLE `tara`
  MODIFY `codTara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orase`
--
ALTER TABLE `orase`
  ADD CONSTRAINT `cod` FOREIGN KEY (`codTara`) REFERENCES `tara` (`codTara`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
