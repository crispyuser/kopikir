-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2025 at 10:00 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kopipas`
--
CREATE DATABASE IF NOT EXISTS `kopipas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `kopipas`;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `price`, `image`, `created_at`) VALUES
(1, 'Espresso', 'Ekstrak kopi pekat yang disajikan hangat dengan aroma yang khas', '15000.00', 'espresso.jpg', '2023-01-01 00:00:00'),
(2, 'Cappuccino', 'Paduan sempurna antara espresso, susu, dan busa susu yang lembut', '20000.00', 'cappuccino.jpg', '2023-01-01 00:00:00'),
(3, 'Latte', 'Espresso dengan susu steamed yang lembut dan sedikit foam di atasnya', '22000.00', 'latte.jpg', '2023-01-01 00:00:00'),
(4, 'Americano', 'Espresso yang dicampur dengan air panas, menghasilkan rasa yang seimbang', '18000.00', 'americano.jpg', '2023-01-01 00:00:00'),
(5, 'Mocha', 'Perpaduan sempurna antara espresso, cokelat, dan susu yang lembut', '25000.00', 'mocha.jpg', '2023-01-01 00:00:00'),
(6, 'Cold Brew', 'Kopi yang diseduh dingin selama 12 jam untuk hasil yang halus', '23000.00', 'coldbrew.jpg', '2023-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `testimonial` text NOT NULL,
  `rating` int NOT NULL DEFAULT '5',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `position`, `testimonial`, `rating`, `created_at`) VALUES
(1, 'Budi Santoso', 'Pecinta Kopi', 'Kopi di sini benar-benar luar biasa! Saya selalu datang ke sini setiap pagi sebelum bekerja. Suasananya yang nyaman membuat saya betah berlama-lama.', 5, '2023-01-01 00:00:00'),
(2, 'Siti Rahayu', 'Barista', 'Sebagai barista profesional, saya sangat menghargai kualitas biji kopi yang digunakan di sini. Proses seduhannya juga sangat presisi dan konsisten.', 5, '2023-01-01 00:00:00'),
(3, 'Ahmad Fauzi', 'Pelanggan Setia', 'Tempat ini menjadi favorit keluarga kami. Selain kopinya yang enak, pelayanannya juga ramah dan harga sangat terjangkau untuk semua kalangan.', 4, '2023-01-01 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;