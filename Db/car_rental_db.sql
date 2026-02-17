-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2026 at 04:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cars`
--

CREATE TABLE `tbl_cars` (
  `id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Available',
  `daily_rate` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cars`
--

INSERT INTO `tbl_cars` (`id`, `model`, `type`, `status`, `daily_rate`, `image`) VALUES
(3, 'Toyota Innova', 'MPV', 'Available', 1450.00, 'toyota_innova.webp\r\n'),
(4, 'Toyota Wigo', 'Hatchback', 'Available', 800.00, 'toyota_wigo.jpg'),
(5, 'BMW M4', 'Luxury', 'Available', 9000.00, 'bmw_m4.avif'),
(6, 'Tesla Model V3', 'SUV', 'Available', 2250.00, 'tesla_v3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `role`) VALUES
(12, 'NarutoUzumaki', '$2y$10$9Tl8HVw8FneIjaOuQGtAKOC0.Em2s8gGoq1a/0PGonX67bCR/sMP6', 'Customer'),
(13, 'SasukeUchiha', '$2y$10$4CLHC9fBdLC1k0MGG4oFae2.8h1X/K1YyIjd37dOqzs2P3QxNb88m', 'Customer'),
(14, 'HiashiHyuga', '$2y$10$2bKLh2VksxzvRcEDC16rbefSPZHySTVX2HjNEO52dBFI2qSmkBTem', 'Customer'),
(15, 'InoYamanaka', '$2y$10$USJEvUMP6fiMXzvV3yeZnuHuBrQ40xEHM8bhTdBhtd769p8zNjAm6', 'Customer'),
(16, 'Dan Carlo', '$2y$10$TZRHGiBYCrJXRqkcjWD92ehAvpg0G3Xz3/QUnWpDT8KRTMnuw3EHe', 'ADMIN'),
(17, 'Josh Ngalis', '$2y$10$0ZYcsQ/uhqMa1cqBwOG/hOba6UupfMcSvXjorGi8iCMr95sd/UBxC', 'STAFF'),
(18, 'David Pomeranz', '$2y$10$lGkcSvxmbuYVZTJY3ro2Q.hHACkECG3HXqOkpPG0C6DzbwF234Vz6', 'Customer'),
(19, 'Shaun', '$2y$10$C5qGba/NYNlZoBf/TPc2tegUADTL48Mz9USnOgXkb3b7ckvydxeFG', 'ADMIN'),
(20, 'Administrator', '$2y$10$7NQep1I9FWqZVg8bg8GwKuhpH43QLk34SZVcZ8n7o7ahOfMIgQx5i', 'ADMIN'),
(21, 'Staff', '$2y$10$5SSgsQbdurTYsZ3RQ8xn2OGOCM5E8P.k.ruaWLSYMC44JscDsePUa', 'Customer'),
(22, 'Customer', '$2y$10$M5LX5cbXo.a474T8B1eNEusO2Kzrd9NYBpCo9uxHSqFHazBMemzR6', 'Customer'),
(23, 'qwertyuiop', '$2y$10$CNQFTrxOyS12zoDrhFijWeCUxXTnhDcqVVGU1OUdPsxOymVTWOcU2', 'Customer'),
(24, '1234', '$2y$10$cfe5.giJq/IBA9PFmIrSjeYKQHyCrwS/uYKKbp2Juut.o1ihZbNyK', 'Customer'),
(25, 'reg', '$2y$10$1JdQRkb0TDIyKkYB49hPMe7.tJFstfWIuNMA4abrMVwMep.VvfhQO', 'Customer'),
(26, 'rreeg', '$2y$10$NfciH/n4umxJRrCLG.EmPemd5DACj.y17XFS94sxHcA62B8w4AUWy', 'Customer'),
(27, '12345', '$2y$10$/NLqS5Ydr1eF5IQYYaEAwevCioM22E8dwZ1JWj8x.eFHCzOJJtIZ2', 'STAFF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cars`
--
ALTER TABLE `tbl_cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cars`
--
ALTER TABLE `tbl_cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
