-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 08 oct. 2020 à 09:49
-- Version du serveur :  5.7.24
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `exercice4`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `codeClient` varchar(50) NOT NULL DEFAULT '',
  `nom` varchar(50) NOT NULL DEFAULT '',
  `cpclient` varchar(5) NOT NULL DEFAULT '',
  `villeclient` varchar(50) NOT NULL DEFAULT '',
  `tel` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `echantillon`
--

CREATE TABLE `echantillon` (
  `codeEchantillon` int(8) NOT NULL,
  `dateEntree` date NOT NULL,
  `codeClient` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `realiser`
--

CREATE TABLE `realiser` (
  `codeEchantillon` int(8) NOT NULL,
  `refTypeAnalyse` int(8) NOT NULL,
  `dateRealisation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `typeanalyse`
--

CREATE TABLE `typeanalyse` (
  `refTypeAnalyse` int(8) NOT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `prixTypeAnalyse` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`codeClient`);

--
-- Index pour la table `echantillon`
--
ALTER TABLE `echantillon`
  ADD PRIMARY KEY (`codeEchantillon`),
  ADD KEY `FK_echantillon_client` (`codeClient`);

--
-- Index pour la table `realiser`
--
ALTER TABLE `realiser`
  ADD PRIMARY KEY (`codeEchantillon`,`refTypeAnalyse`),
  ADD KEY `FK_realiser_typeanalyse` (`refTypeAnalyse`);

--
-- Index pour la table `typeanalyse`
--
ALTER TABLE `typeanalyse`
  ADD PRIMARY KEY (`refTypeAnalyse`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `typeanalyse`
--
ALTER TABLE `typeanalyse`
  MODIFY `refTypeAnalyse` int(8) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `echantillon`
--
ALTER TABLE `echantillon`
  ADD CONSTRAINT `FK_echantillon_client` FOREIGN KEY (`codeClient`) REFERENCES `client` (`codeClient`);

--
-- Contraintes pour la table `realiser`
--
ALTER TABLE `realiser`
  ADD CONSTRAINT `FK_realiser_echantillon` FOREIGN KEY (`codeEchantillon`) REFERENCES `echantillon` (`codeEchantillon`),
  ADD CONSTRAINT `FK_realiser_typeanalyse` FOREIGN KEY (`refTypeAnalyse`) REFERENCES `typeanalyse` (`refTypeAnalyse`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
