-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2024 at 07:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_orphelinah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adoption`
--

CREATE TABLE `adoption` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` text NOT NULL,
  `enfant` int(11) NOT NULL,
  `tuteur` int(11) NOT NULL,
  `Etat` int(11) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoption`
--

INSERT INTO `adoption` (`id`, `date`, `note`, `enfant`, `tuteur`, `Etat`, `statut`) VALUES
(1, '2024-09-06', 'blablabla bla', 1, 1, 0, 1),
(2, '2024-09-06', 'kkkkkkkkkkkkkkkkkk', 2, 2, 0, 0),
(3, '2024-09-06', 'wwwwwwwwwwwwwww', 3, 1, 0, 1),
(4, '2024-09-06', 'enfant obeissant', 4, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bienfaiteur`
--

CREATE TABLE `bienfaiteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `postnom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `adresse` text NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `mail` text NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bienfaiteur`
--

INSERT INTO `bienfaiteur` (`id`, `nom`, `postnom`, `prenom`, `genre`, `adresse`, `telephone`, `mail`, `statut`) VALUES
(1, 'Furaha', 'nyonge', 'furaha', 'Masculin', 'gallery kisune', '0987655', 'divinemakili@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comptable`
--

CREATE TABLE `comptable` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `postnom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `photo` text NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comptable`
--

INSERT INTO `comptable` (`id`, `nom`, `postnom`, `prenom`, `pwd`, `mail`, `photo`, `statut`) VALUES
(1, 'Rosine', 'Mahuka', 'masika', '1234', 'gladkombis@gmail.com', '_ba8541c6-92f7-4345-822c-71ac5aa0ce8e.jpeg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `declaration`
--

CREATE TABLE `declaration` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `adoption` int(11) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `declaration`
--

INSERT INTO `declaration` (`id`, `date`, `description`, `adoption`, `statut`) VALUES
(1, '2024-09-05', 'wwwwwwwwwwwwwww', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `don`
--

CREATE TABLE `don` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `bienfaiteur` int(11) NOT NULL,
  `description` text NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `montant` double NOT NULL,
  `devise` varchar(50) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `don`
--

INSERT INTO `don` (`id`, `date`, `bienfaiteur`, `description`, `categorie`, `montant`, `devise`, `statut`) VALUES
(1, '2024-09-05', 1, 'Commercial et Gestion', 'Nature', 0, 'Null', 0),
(2, '2024-09-05', 1, 'Commercial et Gestion', 'Numeraire', 100, 'Dollards', 0),
(3, '2024-09-06', 1, 'Riz 25kg', 'Nature', 0, 'Null', 0),
(4, '2024-09-06', 1, 'apport en numeraire', 'Numeraire', 18888, 'Dollards', 0);

-- --------------------------------------------------------

--
-- Table structure for table `enfant`
--

CREATE TABLE `enfant` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `postnom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `age` date NOT NULL,
  `photo` text NOT NULL,
  `adopt` int(11) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enfant`
--

INSERT INTO `enfant` (`id`, `nom`, `postnom`, `prenom`, `genre`, `age`, `photo`, `adopt`, `statut`) VALUES
(1, 'Rosine', 'masika', 'mahuka', 'Feminin', '2015-09-14', 'IMG-20240714-WA0017.jpg', 1, 0),
(2, 'Alice', 'Katungu', 'Lariene', 'Feminin', '2017-01-24', '_a4cf2cd0-5d9c-47c7-800c-4ee0e0603013.jpeg', 1, 0),
(3, 'Furaha', 'nyonge', 'furaha', 'Feminin', '2021-12-28', 'WhatsApp Image 2024-06-08 at 08.06.15_f4562177.jpg', 1, 0),
(4, 'katunga', 'kwali', 'sarah', 'Feminin', '2018-10-05', '_54919107-e9cf-466c-be05-2f4bf69af68c.jpeg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mouvementcaisse`
--

CREATE TABLE `mouvementcaisse` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `Montant` double NOT NULL,
  `devise` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mouvementcaisse`
--

INSERT INTO `mouvementcaisse` (`id`, `date`, `description`, `Montant`, `devise`, `type`, `statut`) VALUES
(1, '2024-09-06', 'recette ndazi', 100, 'Dollards', 'Entree', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sortie`
--

CREATE TABLE `sortie` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `adoption` int(11) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sortie`
--

INSERT INTO `sortie` (`id`, `date`, `description`, `adoption`, `statut`) VALUES
(1, '2024-09-06', 'Commercial et Gestion', 1, 0),
(2, '2024-09-06', 'louange', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suivis`
--

CREATE TABLE `suivis` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `constation` text NOT NULL,
  `adoption` int(11) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suivis`
--

INSERT INTO `suivis` (`id`, `date`, `constation`, `adoption`, `statut`) VALUES
(1, '2024-09-05', 'Brigat', 1, 0),
(2, '2024-09-06', 'diareee', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tuteur`
--

CREATE TABLE `tuteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `postnom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `confession` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tuteur`
--

INSERT INTO `tuteur` (`id`, `nom`, `postnom`, `prenom`, `genre`, `adresse`, `telephone`, `confession`, `profession`, `statut`) VALUES
(1, 'Furaha', 'nyonge', 'furaha', 'Masculin', 'kambali', '0997019883', 'catolique', 'Commercante', 0),
(2, 'Kasero', 'deAlice', 'george', 'Masculin', 'kambali', '0987654', 'horove', 'developper', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adoption`
--
ALTER TABLE `adoption`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bienfaiteur`
--
ALTER TABLE `bienfaiteur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comptable`
--
ALTER TABLE `comptable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `declaration`
--
ALTER TABLE `declaration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `don`
--
ALTER TABLE `don`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enfant`
--
ALTER TABLE `enfant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mouvementcaisse`
--
ALTER TABLE `mouvementcaisse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sortie`
--
ALTER TABLE `sortie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suivis`
--
ALTER TABLE `suivis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tuteur`
--
ALTER TABLE `tuteur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adoption`
--
ALTER TABLE `adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bienfaiteur`
--
ALTER TABLE `bienfaiteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comptable`
--
ALTER TABLE `comptable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `declaration`
--
ALTER TABLE `declaration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `don`
--
ALTER TABLE `don`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enfant`
--
ALTER TABLE `enfant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mouvementcaisse`
--
ALTER TABLE `mouvementcaisse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suivis`
--
ALTER TABLE `suivis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tuteur`
--
ALTER TABLE `tuteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
