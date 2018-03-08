-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2018 at 03:59 PM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ttc`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'admin', 'a@a.a', '$2y$10$u9SKeRO0XqKWNs.WZjhobOyXCV6DJr6cT84jBdNe0D6ZAqBPbRx7i', '2018-02-24 19:16:26'),
(2, 'user', '', '$2y$10$HRH7E9asGrU6dQXRv8kMXu.siURkKJG6GduLofdqwMk4ZWlg8lNn2', '2018-02-24 20:06:37'),
(3, 'himan', '', '$2y$10$9ttUJ7lbepMOMExaGeLOZ.amDRttpU3JkAoV4FQ06vbMyEPR2psku', '2018-02-28 07:33:51'),
(4, 'nok', 'nok@gmail.com', '$2y$10$tWijO2ndBGeb0X/V0/X65.DUPDLfjyjnC6H4BRAsCRpePotI24GQS', '2018-03-01 10:03:14'),
(5, 'new', 'new@gmail.com', '$2y$10$Vb1x.CkKvvORPqwdjCmaf.Sj.JlIrql/cClwSx9AbyTK27vRR3Rwq', '2018-03-01 10:04:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
