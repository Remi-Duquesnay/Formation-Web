-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 30 oct. 2020 à 09:50
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `niveau2`
--

-- --------------------------------------------------------

--
-- Structure de la table `ban`
--

CREATE TABLE `ban` (
  `id` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `ban-time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Connexions`
--

CREATE TABLE `Connexions` (
  `id` int(8) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_connexion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip` varchar(32) NOT NULL,
  `succes` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Connexions`
--

INSERT INTO `Connexions` (`id`, `login`, `password`, `date_connexion`, `ip`, `succes`) VALUES
(156, 'test@test.fr', 's', '2020-10-22 14:48:27', '127.0.0.1', 0),
(157, 'test@test.fr', 's', '2020-10-22 14:48:31', '127.0.0.1', 0),
(158, 'test@test.fr', 's', '2020-10-22 14:49:59', '127.0.0.1', 0),
(159, 'test@test.fr', 's', '2020-10-22 14:50:07', '127.0.0.1', 1),
(160, 'test@test.fr', 's', '2020-10-22 14:48:39', '127.0.0.1', 0),
(161, 'test@test.fr', 'c', '2020-10-22 14:49:29', '127.0.0.1', 0),
(162, 'test@test.fr', 'e', '2020-10-22 14:52:08', '127.0.0.1', 0),
(163, 'test@test.fr', 'Azerty1234', '2020-10-22 14:52:22', '127.0.0.1', 1),
(164, 'test@test.fr', 'd', '2020-10-22 14:52:30', '127.0.0.1', 0),
(165, 'test@test.fr', 'd', '2020-10-22 14:53:14', '127.0.0.1', 0),
(166, 'rduquesnay@orange.fr', 'Azerty4321', '2020-10-28 15:27:09', '127.0.0.1', 0),
(167, 'rduquesnay@orange.fr', 'Azerty1234', '2020-10-28 15:27:19', '127.0.0.1', 0),
(168, 'test@test.fr', 'Azerty1234', '2020-10-28 15:32:35', '127.0.0.1', 0),
(169, 'test@test.fr', 'Azerty1234', '2020-10-28 15:34:23', '127.0.0.1', 1),
(170, 'test@test.fr', 'Azerty1234', '2020-10-28 15:34:57', '127.0.0.1', 1),
(171, 'test@test.fr', 'Azerty1234', '2020-10-28 15:35:53', '127.0.0.1', 1),
(172, 'test@test.fr', 'Azerty1234', '2020-10-29 09:18:28', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `pwdReset`
--

CREATE TABLE `pwdReset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pro` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`id`, `name`, `lastname`, `email`, `password`, `pro`) VALUES
(7, 'Duquesnay', 'remi', 'test@test.fr', '$2y$10$8ZMkVyKXsUepA4fUsPmw6eqzIuJNBTqvTO1Vr/fi1zkXSab57YLx.', 0),
(8, 'plopilol', 'test', 'test@test.com', '$2y$10$2E1Kzzkh6/kppEFL.HvI/uuv6fDAyUt8R8imN2t75BdqyWC8QrET.', 0),
(9, 'Végéta', 'plop', 'test@plop.com', '$2y$10$JYmpGexjWuBRJbniXCG1fOW9KKBQKW8wZV1XFVWkFO/TMIyb4MU3a', 0),
(10, 'Végéta', 'fromage', 'plop@plop.com', '$2y$10$9LKaYdjXAHVox1Gu2Bg4bOtLaV7VR/1ZpyoQauKe8xasf0/oiz422', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Connexions`
--
ALTER TABLE `Connexions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pwdReset`
--
ALTER TABLE `pwdReset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ban`
--
ALTER TABLE `ban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Connexions`
--
ALTER TABLE `Connexions`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT pour la table `pwdReset`
--
ALTER TABLE `pwdReset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
