-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 05 oct. 2020 à 16:37
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
-- Base de données : `ex_01`
--

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `num_F` int(8) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `ville` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`num_F`, `nom`, `ville`) VALUES
(1, 'Peugeot', 'Grasse'),
(2, 'Renault', 'Cannes'),
(3, 'Tesla', 'Fremont (USA)');

-- --------------------------------------------------------

--
-- Structure de la table `fournitures`
--

CREATE TABLE `fournitures` (
  `num_F` int(8) NOT NULL,
  `code_p` int(8) NOT NULL,
  `quantite` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fournitures`
--

INSERT INTO `fournitures` (`num_F`, `code_p`, `quantite`) VALUES
(1, 1, 6),
(1, 2, 4),
(1, 3, 1),
(2, 4, 5),
(2, 5, 2),
(3, 6, 6),
(3, 7, 2);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `code_p` int(8) NOT NULL,
  `libelle` varchar(40) DEFAULT NULL,
  `origine` varchar(40) DEFAULT NULL,
  `couleur` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`code_p`, `libelle`, `origine`, `couleur`) VALUES
(1, 'antracite', '208', 'France'),
(2, 'bleu', '208', 'France'),
(3, 'gris', '208', 'France'),
(4, 'pomme', 'clio4', 'France'),
(5, 'sable', 'clio4', 'France'),
(6, 'antracite', 'model3', 'USA'),
(7, 'bleu nuit', 'modelS', 'USA');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`num_F`);

--
-- Index pour la table `fournitures`
--
ALTER TABLE `fournitures`
  ADD PRIMARY KEY (`num_F`,`code_p`),
  ADD KEY `code_p` (`code_p`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`code_p`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fournitures`
--
ALTER TABLE `fournitures`
  ADD CONSTRAINT `fournitures_ibfk_1` FOREIGN KEY (`num_F`) REFERENCES `fournisseurs` (`num_F`),
  ADD CONSTRAINT `fournitures_ibfk_2` FOREIGN KEY (`code_p`) REFERENCES `produits` (`code_p`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
