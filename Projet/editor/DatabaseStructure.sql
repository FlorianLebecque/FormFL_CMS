-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 27 fév. 2018 à 14:31
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fl_cms`
--

SET FOREIGN_KEY_CHECKS = 0;

-- --------------------------------------------------------

--
-- Structure de la table `colums`
--

DROP TABLE IF EXISTS `colums`;
CREATE TABLE IF NOT EXISTS `colums` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `titre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `colum_image`
--

DROP TABLE IF EXISTS `colum_image`;
CREATE TABLE IF NOT EXISTS `colum_image` (
  `id_colum` int(10) UNSIGNED NOT NULL,
  `id_image` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_colum`),
  KEY `id_colum` (`id_colum`,`id_image`),
  KEY `id_image` (`id_image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `colum_lien`
--

DROP TABLE IF EXISTS `colum_lien`;
CREATE TABLE IF NOT EXISTS `colum_lien` (
  `id_colum` int(10) UNSIGNED NOT NULL,
  `id_lien` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_colum`),
  KEY `id_colum` (`id_colum`,`id_lien`),
  KEY `id_lien` (`id_lien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `colum_texte`
--

DROP TABLE IF EXISTS `colum_texte`;
CREATE TABLE IF NOT EXISTS `colum_texte` (
  `id_colum` int(10) UNSIGNED NOT NULL,
  `id_text` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_colum`),
  KEY `id_colum` (`id_colum`,`id_text`),
  KEY `id_text` (`id_text`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `conteneurs`
--

DROP TABLE IF EXISTS `conteneurs`;
CREATE TABLE IF NOT EXISTS `conteneurs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `conteneur_colum`
--

DROP TABLE IF EXISTS `conteneur_colum`;
CREATE TABLE IF NOT EXISTS `conteneur_colum` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_conteneur` int(10) UNSIGNED NOT NULL,
  `id_colum` int(10) UNSIGNED NOT NULL,
  `taille` int(2) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `EnsembleColCon` (`id_conteneur`,`id_colum`) USING BTREE,
  KEY `id_colum` (`id_colum`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `headerbutton`
--

DROP TABLE IF EXISTS `headerbutton`;
CREATE TABLE IF NOT EXISTS `headerbutton` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `emplacement` int(1) UNSIGNED NOT NULL,
  `titre` mediumtext NOT NULL,
  `lien` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `ext` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `liens`
--

DROP TABLE IF EXISTS `liens`;
CREATE TABLE IF NOT EXISTS `liens` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` mediumtext NOT NULL,
  `lien` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) DEFAULT NULL,
  `online` int(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `page_conteneurs`
--

DROP TABLE IF EXISTS `page_conteneurs`;
CREATE TABLE IF NOT EXISTS `page_conteneurs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_page` int(10) UNSIGNED NOT NULL,
  `id_conteneur` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_page` (`id_page`,`id_conteneur`),
  KEY `id_conteneur` (`id_conteneur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `textes`
--

DROP TABLE IF EXISTS `textes`;
CREATE TABLE IF NOT EXISTS `textes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `texte` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `utilisateur` varchar(30) NOT NULL,
  `mdp` varchar(90) NOT NULL,
  `email` varchar(90) DEFAULT NULL,
  `rank` int(1) NOT NULL,
  `mail` int(1) NOT NULL,
  PRIMARY KEY (`utilisateur`),
  UNIQUE KEY `U_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Vide le tables 
--

TRUNCATE `colums`;
TRUNCATE `colum_image`;
TRUNCATE `colum_lien`;
TRUNCATE `colum_texte`;
TRUNCATE `conteneurs`;
TRUNCATE `conteneur_colum`;
TRUNCATE `images`;
TRUNCATE `liens`;
TRUNCATE `pages`;
TRUNCATE `page_conteneurs`;
TRUNCATE `textes`;
TRUNCATE `headerbutton`;
TRUNCATE `utilisateur`;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `colum_image`
--
ALTER TABLE `colum_image`
  ADD CONSTRAINT `colum_image_ibfk_1` FOREIGN KEY (`id_colum`) REFERENCES `colums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `colum_image_ibfk_2` FOREIGN KEY (`id_image`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `colum_lien`
--
ALTER TABLE `colum_lien`
  ADD CONSTRAINT `colum_lien_ibfk_1` FOREIGN KEY (`id_colum`) REFERENCES `colums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `colum_lien_ibfk_2` FOREIGN KEY (`id_lien`) REFERENCES `liens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `colum_texte`
--
ALTER TABLE `colum_texte`
  ADD CONSTRAINT `colum_texte_ibfk_1` FOREIGN KEY (`id_colum`) REFERENCES `colums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `colum_texte_ibfk_2` FOREIGN KEY (`id_text`) REFERENCES `textes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `conteneur_colum`
--
ALTER TABLE `conteneur_colum`
  ADD CONSTRAINT `conteneur_colum_ibfk_1` FOREIGN KEY (`id_conteneur`) REFERENCES `conteneurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conteneur_colum_ibfk_2` FOREIGN KEY (`id_colum`) REFERENCES `colums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `page_conteneurs`
--
ALTER TABLE `page_conteneurs`
  ADD CONSTRAINT `page_conteneurs_ibfk_1` FOREIGN KEY (`id_page`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_conteneurs_ibfk_2` FOREIGN KEY (`id_conteneur`) REFERENCES `conteneurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;