-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 10:48 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignation`
--

CREATE TABLE `assignation` (
  `id` int(11) NOT NULL,
  `id_tache` int(25) NOT NULL,
  `id_emp` int(25) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_yn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignation`
--

INSERT INTO `assignation` (`id`, `id_tache`, `id_emp`, `date`, `deleted_yn`) VALUES
(2, 5, 3, '2023-02-24 16:21:52', 0),
(7, 3, 4, '2023-02-24 00:40:36', 0),
(8, 4, 2, '2023-02-24 15:49:58', 0),
(9, 4, 3, '2023-02-24 15:50:51', 0),
(10, 5, 1, '2023-02-24 16:22:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `id` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `mail` varchar(25) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `numero` int(25) NOT NULL,
  `sexe` varchar(11) NOT NULL,
  `poste` varchar(25) NOT NULL,
  `choix` varchar(50) NOT NULL DEFAULT 'employe',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_yn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employe`
--

INSERT INTO `employe` (`id`, `nom`, `prenom`, `mail`, `pass`, `numero`, `sexe`, `poste`, `choix`, `date`, `deleted_yn`) VALUES
(1, 'Fodouop Fodouop', 'sharon', 'fodouopnathan@gmail.com', 'admine', 696330760, 'femme', 'chef', 'responsable', '2023-03-06 04:57:08', 0),
(2, 'trr', 'sharon', 'smemvouta@gmail.com', 'quila', 657245386, 'Femme', 'respo', 'employe', '2023-02-23 17:58:57', 0),
(3, 'salvatore', 'damond', 'damond@gmail.com', 'acteur', 696335874, 'Homme', 'marketing', 'employe', '2023-02-23 17:59:55', 0),
(4, 'Mr John ', 'Do', 'hamzadbani@gmail.com', '123456789', 689878525, 'Homme', 'ouvrier', 'employe', '2023-02-24 15:51:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `engins`
--

CREATE TABLE `engins` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_yn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `engins`
--

INSERT INTO `engins` (`id`, `nom`, `model`, `etat`, `commentaire`, `date`, `deleted_yn`) VALUES
(1, 'caterpillar', 'fr254', 'très bon', 'vient d\'être acheter   ', '2023-02-24 16:29:22', 0),
(4, 'frigo ', 'fr555', 'mauvais', 'vieux', '2023-02-24 15:44:16', 0),
(5, 'telephone', 'z14', 'très bon', 'vient d\'etre acheté', '2023-02-24 16:30:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `horaire`
--

CREATE TABLE `horaire` (
  `id_hor` int(11) NOT NULL,
  `temps_entree` datetime NOT NULL,
  `temps_sortie` datetime NOT NULL,
  `id_emp` int(255) NOT NULL,
  `entree_sortie` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_yn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `horaire`
--

INSERT INTO `horaire` (`id_hor`, `temps_entree`, `temps_sortie`, `id_emp`, `entree_sortie`, `date`, `deleted_yn`) VALUES
(34, '2023-03-06 03:39:36', '2023-03-06 03:39:54', 1, 2, '2023-03-06 02:39:54', 0),
(35, '2023-03-06 03:40:09', '2023-03-06 03:40:24', 4, 2, '2023-03-06 02:40:24', 0),
(36, '2023-03-06 03:40:40', '2023-03-06 03:40:55', 3, 2, '2023-03-06 02:40:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `presence`
--

CREATE TABLE `presence` (
  `id` int(11) NOT NULL,
  `id_emp` int(255) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_yn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presence`
--

INSERT INTO `presence` (`id`, `id_emp`, `statut`, `date`, `deleted_yn`) VALUES
(1, 1, 'employe', '2023-02-23 19:54:49', 0),
(2, 1, 'employé', '2023-02-23 22:39:40', 0),
(3, 2, 'responsable', '2023-02-24 00:48:27', 0),
(4, 3, 'employé', '2023-02-24 02:30:09', 0),
(5, 3, 'employé', '2023-02-24 02:44:05', 0),
(6, 1, 'responsable', '2023-02-24 15:38:12', 0),
(7, 1, 'responsable', '2023-02-24 15:41:34', 0),
(8, 1, 'responsable', '2023-02-24 15:42:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `qrcode`
--

CREATE TABLE `qrcode` (
  `id` int(11) NOT NULL,
  `id_emp` int(255) NOT NULL,
  `poste` varchar(255) NOT NULL,
  `qr` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_yn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qrcode`
--

INSERT INTO `qrcode` (`id`, `id_emp`, `poste`, `qr`, `date`, `deleted_yn`) VALUES
(22, 3, '', '../fichier/df101154249c81c75c6ba34b9e7fa00d.png', '2023-03-04 11:04:06', 0),
(23, 4, '', '../fichier/afaefd95d9fae5fa3d00de26cf3fcda2.png', '2023-03-04 11:04:39', 0),
(24, 1, '', '../fichier/5f15a552c9aa9bf8a66289bb087c537b.png', '2023-03-04 11:05:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rapport_jour`
--

CREATE TABLE `rapport_jour` (
  `id` int(11) NOT NULL,
  `id_chef` int(25) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `rapport` varchar(255) NOT NULL,
  `fichier` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_yn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rapport_jour`
--

INSERT INTO `rapport_jour` (`id`, `id_chef`, `nom`, `rapport`, `fichier`, `date`, `deleted_yn`) VALUES
(18, 1, '28357.pdf', '1er depot', 'files_upload/64055c9680b865.11188319.pdf', '2023-02-01 03:23:02', 0),
(20, 1, 'PPE_bras_robotise.pdf', '3i', 'files_upload/64056c3ccc85c8.68544138.pdf', '2023-03-06 04:29:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tache`
--

CREATE TABLE `tache` (
  `id` int(11) NOT NULL,
  `nom_tache` varchar(255) NOT NULL,
  `Details` varchar(255) NOT NULL,
  `statut` int(12) NOT NULL,
  `date_d` varchar(255) NOT NULL,
  `date_f` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_yn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tache`
--

INSERT INTO `tache` (`id`, `nom_tache`, `Details`, `statut`, `date_d`, `date_f`, `date`, `deleted_yn`) VALUES
(1, 'fondation', 'Creuser la fondation et couler la dalle', 0, '2023-02-24 ', '2023-02-25', '2023-02-25 18:49:42', 0),
(3, 'peinture', 'étaler la peinture sur tous les murs', 0, '2023-02-24', '2023-02-26', '2023-02-25 18:50:22', 0),
(4, 'crépissage', 'polisser tous les murs', 0, '2023-02-25', '2023-02-27', '2023-02-25 18:50:28', 0),
(5, 'electricité', 'electrifié', 1, '2023-02-28', '2023-03-05', '2023-02-25 18:50:52', 0),
(6, 'finition', 'installer les derniers trucs', 0, '', '', '2023-02-26 20:46:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `Poste` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_yn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mail`, `Poste`, `password`, `created_at`, `deleted_yn`) VALUES
(1, 'John doe', 'fodouopnathan@gmail.com', 'admin', 'adminee', '2021-08-09 20:30:46', 0),
(2, 'juste', 'fodouop@gmail.com', 'employee', 'justo', '2023-02-21 23:07:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `mail` varchar(25) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `numero` int(25) NOT NULL,
  `sexe` varchar(11) NOT NULL,
  `poste` varchar(50) NOT NULL,
  `choix` varchar(50) NOT NULL DEFAULT 'responsable',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_yn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `mail`, `pass`, `numero`, `sexe`, `poste`, `choix`, `date`, `deleted_yn`) VALUES
(1, 'fodouop', 'nathan', 'fodouopnathan@gmail.com', 'adminee', 657245383, 'Homme', 'chef', 'responsable', '2023-02-24 00:23:23', 0),
(2, 'mum', 'calmant', 'mum@gmail.com', 'nathan05', 697808559, 'homme', 'admin', 'responsable', '2023-02-24 00:10:04', 0),
(3, 'Mr Do', 'duuuuuuu', 'thanos@titan.com', 'nathan05', 651492151, 'homme', 'infographe', 'responsable', '2023-02-24 16:17:53', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignation`
--
ALTER TABLE `assignation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `engins`
--
ALTER TABLE `engins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`id_hor`);

--
-- Indexes for table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rapport_jour`
--
ALTER TABLE `rapport_jour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignation`
--
ALTER TABLE `assignation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `engins`
--
ALTER TABLE `engins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `horaire`
--
ALTER TABLE `horaire`
  MODIFY `id_hor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `presence`
--
ALTER TABLE `presence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `qrcode`
--
ALTER TABLE `qrcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rapport_jour`
--
ALTER TABLE `rapport_jour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tache`
--
ALTER TABLE `tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;