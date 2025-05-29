-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 09:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `redcross`
--

-- --------------------------------------------------------

--
-- Table structure for table `administratori`
--

CREATE TABLE `administratori` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(100) NOT NULL,
  `lozinka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administratori`
--

INSERT INTO `administratori` (`id`, `korisnicko_ime`, `lozinka`) VALUES
(16, 'medina', '$2y$10$2XdmbGY4l3rqcWvr4aXAX.DTnHOTTn5dl66/wRIuc09idcp38e/cK'),
(17, 'asija', '$2y$10$B0/pDrj7stsYgFv304q7COYjK1IcmOsCs6LRWgwJMwGQtIUpK3mla'),
(18, 'amra', '$2y$10$JBGoa3JxzWN49LsmMnuKD.eZwBP2oo8pLjWcLT2n9F5rsYzxyLsaa'),
(19, 'sajra', '$2y$10$UV7cQ.brIAzPxn16lwqbt.dBdIfQQbFayFTSQhX8/GBok6InzRRi2'),
(20, 'edna', '$2y$10$0wDxV9dX/BqHhfadve4DdOyht2rSb3TcI4qb8B0zO3gvJA.TxucnG'),
(22, 'mensur', '$2y$10$Lbqs27CpVdTP1U385LHeduVYuJVGSCQEjtKM5ttXvg066nv0OJzTO'),
(23, 'admir', '$2y$10$XWtOoImm3eb8psLD0MaiTeop3KP3/mZhRNWSGSDZgw2M.vV7hDXnW');

-- --------------------------------------------------------

--
-- Table structure for table `donacije`
--

CREATE TABLE `donacije` (
  `id` int(11) NOT NULL,
  `datum_donacije` date NOT NULL,
  `vrijeme_donacije` time NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donacije`
--

INSERT INTO `donacije` (`id`, `datum_donacije`, `vrijeme_donacije`, `admin_id`) VALUES
(21, '2025-06-12', '13:00:00', 18),
(23, '2025-11-11', '08:00:00', 16);

-- --------------------------------------------------------

--
-- Table structure for table `prijave`
--

CREATE TABLE `prijave` (
  `id` int(11) NOT NULL,
  `ime_prezime` varchar(100) NOT NULL,
  `jmbg` varchar(13) NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `spol` varchar(20) NOT NULL,
  `krvna_grupa` varchar(5) NOT NULL,
  `kontakt` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mjesto` varchar(100) NOT NULL,
  `uvjerenje` varchar(255) NOT NULL,
  `datum_prijave` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prijave`
--

INSERT INTO `prijave` (`id`, `ime_prezime`, `jmbg`, `datum_rodjenja`, `spol`, `krvna_grupa`, `kontakt`, `email`, `mjesto`, `uvjerenje`, `datum_prijave`) VALUES
(11, 'Mehmed Krupić', '1703007110019', '2007-03-17', 'muško', 'A+', '060312637', 'mehmedkrupic2@gmail.com', 'Bužim', '../uploads/Uvjerenje o redovnom školovanju.pdf', '2025-05-07 09:48:03'),
(12, 'Amra Hadžić', '2907007115019', '2007-07-29', 'žensko', 'O+', '0603035594', 'jekoamra@gmail.com', 'Bihać', '../uploads/Uvjerenje o redovnom školovanju.pdf', '2025-05-07 10:08:07'),
(13, 'Asija Harbaš', '1709007115009', '2007-09-17', 'žensko', 'O+', '0603035594', 'asijaharbas@gmail.com', 'Bosanska Krupa', '../uploads/Scanned-image_26-02-2025-093405.pdf', '2025-05-08 07:07:40');

-- --------------------------------------------------------

--
-- Table structure for table `privremeni_admini`
--

CREATE TABLE `privremeni_admini` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(255) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `datum_zahtjeva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `volonter`
--

CREATE TABLE `volonter` (
  `id` int(11) NOT NULL,
  `ime` varchar(30) DEFAULT NULL,
  `prezime` varchar(50) DEFAULT NULL,
  `datum_rodenja` date DEFAULT NULL,
  `broj_telefona` varchar(30) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administratori`
--
ALTER TABLE `administratori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donacije`
--
ALTER TABLE `donacije`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `prijave`
--
ALTER TABLE `prijave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privremeni_admini`
--
ALTER TABLE `privremeni_admini`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volonter`
--
ALTER TABLE `volonter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administratori`
--
ALTER TABLE `administratori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `donacije`
--
ALTER TABLE `donacije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `prijave`
--
ALTER TABLE `prijave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `privremeni_admini`
--
ALTER TABLE `privremeni_admini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `volonter`
--
ALTER TABLE `volonter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donacije`
--
ALTER TABLE `donacije`
  ADD CONSTRAINT `donacije_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `administratori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
