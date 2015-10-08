-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 06 Février 2015 à 10:15
-- Version du serveur: 5.5.41-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `compared`
--
CREATE DATABASE IF NOT EXISTS `compared` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `compared`;

-- --------------------------------------------------------

--
-- Structure de la table `COMPARED`
--

DROP TABLE IF EXISTS `COMPARED`;
CREATE TABLE IF NOT EXISTS `COMPARED` (
  `idCOMPARED` int(11) NOT NULL AUTO_INCREMENT,
  `idS1` int(11) NOT NULL,
  `idS2` int(11) NOT NULL,
  PRIMARY KEY (`idCOMPARED`),
  KEY `FK_sm1` (`idS1`),
  KEY `FK_sm2` (`idS2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Vider la table avant d'insérer `COMPARED`
--

TRUNCATE TABLE `COMPARED`;
-- --------------------------------------------------------

--
-- Structure de la table `GPU`
--

DROP TABLE IF EXISTS `GPU`;
CREATE TABLE IF NOT EXISTS `GPU` (
  `idG` int(11) NOT NULL AUTO_INCREMENT,
  `nameG` varchar(200) NOT NULL,
  `constructorG` varchar(200) NOT NULL,
  `versionG` int(11) NOT NULL,
  PRIMARY KEY (`idG`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Vider la table avant d'insérer `GPU`
--

TRUNCATE TABLE `GPU`;
--
-- Contenu de la table `GPU`
--

INSERT INTO `GPU` (`idG`, `nameG`, `constructorG`, `versionG`) VALUES
(1, 'Adreno', 'Qualcomm', 330),
(2, 'Adreno', 'Qualcomm', 420);

-- --------------------------------------------------------

--
-- Structure de la table `Notice`
--

DROP TABLE IF EXISTS `Notice`;
CREATE TABLE IF NOT EXISTS `Notice` (
  `idA` int(11) NOT NULL AUTO_INCREMENT,
  `nomInter` varchar(50) NOT NULL,
  `content` varchar(200) NOT NULL,
  PRIMARY KEY (`idA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Vider la table avant d'insérer `Notice`
--

TRUNCATE TABLE `Notice`;
--
-- Contenu de la table `Notice`
--

INSERT INTO `Notice` (`idA`, `nomInter`, `content`) VALUES
(1, 'lander', 'Super comparateur !'),
(2, 'marc', 'Je vous recommande COMPARED!'),
(3, 'anonyme', 'J''adore faire des comparaisons'),
(4, 'anonyme', 'Que dire de COMPARED ! C''est génial');

-- --------------------------------------------------------

--
-- Structure de la table `OS`
--

DROP TABLE IF EXISTS `OS`;
CREATE TABLE IF NOT EXISTS `OS` (
  `idOS` int(11) NOT NULL AUTO_INCREMENT,
  `nameOS` varchar(50) NOT NULL,
  `versionOS` varchar(20) NOT NULL,
  `constructorOS` varchar(50) NOT NULL,
  `releaseDateOS` date NOT NULL,
  PRIMARY KEY (`idOS`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Vider la table avant d'insérer `OS`
--

TRUNCATE TABLE `OS`;
--
-- Contenu de la table `OS`
--

INSERT INTO `OS` (`idOS`, `nameOS`, `versionOS`, `constructorOS`, `releaseDateOS`) VALUES
(1, 'Android Lollipop', '5.0', 'Google', '2014-10-15'),
(2, 'iOS ', '8', 'Apple', '2014-09-17'),
(3, 'Android Jelly Bean', '4.2', 'Google', '2012-11-13'),
(4, 'Android Jelly Bean', '4.1', 'Google', '2012-07-09'),
(5, 'Android Jelly Bean', '4.3', 'Google', '2013-07-24'),
(6, 'Android KitKat', '4.4', 'Google', '2013-10-31'),
(7, 'Android Ice Cream Sandwich', '4.0', 'Google', '2011-12-16'),
(8, 'Android Honeycomb', '3', 'Google', '2010-12-26'),
(9, 'Android Gingerbread', '2.3', 'Google', '2010-12-06'),
(10, 'iOS ', '7', 'Apple', '2013-09-18'),
(11, 'iOS', '6', 'Apple', '2012-09-19'),
(12, 'iOS ', '5', 'Apple', '2011-06-06'),
(13, 'iOS', '4', 'Apple', '2010-06-21');

-- --------------------------------------------------------

--
-- Structure de la table `Processor`
--

DROP TABLE IF EXISTS `Processor`;
CREATE TABLE IF NOT EXISTS `Processor` (
  `idProc` int(11) NOT NULL AUTO_INCREMENT,
  `nameProc` varchar(50) NOT NULL,
  `constructorProc` varchar(50) NOT NULL,
  `nbCoreProc` int(11) NOT NULL,
  `archProc` int(11) NOT NULL,
  `versionProc` varchar(25) NOT NULL,
  `frenquecyProc` float NOT NULL,
  PRIMARY KEY (`idProc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Vider la table avant d'insérer `Processor`
--

TRUNCATE TABLE `Processor`;
--
-- Contenu de la table `Processor`
--

INSERT INTO `Processor` (`idProc`, `nameProc`, `constructorProc`, `nbCoreProc`, `archProc`, `versionProc`, `frenquecyProc`) VALUES
(1, 'Snapdragon', 'Qualcomm', 4, 0, '801', 2.5),
(2, 'Snapdragon', 'Qualcomm', 4, 0, '805', 2.7),
(3, 'A', 'Samsung Electronics', 2, 64, '7', 1.4),
(4, 'A', 'Samsung Electronics', 2, 0, '6', 1.3),
(5, 'Snapdragon', 'Qualcomm', 4, 0, '800', 2.26);

-- --------------------------------------------------------

--
-- Structure de la table `Screen`
--

DROP TABLE IF EXISTS `Screen`;
CREATE TABLE IF NOT EXISTS `Screen` (
  `idScr` int(11) NOT NULL AUTO_INCREMENT,
  `typeScr` varchar(50) NOT NULL,
  `resolutionScr` varchar(50) NOT NULL,
  `densityScr` int(11) NOT NULL,
  `sizeSrc` float NOT NULL,
  `capacityScr` varchar(50) NOT NULL,
  PRIMARY KEY (`idScr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Vider la table avant d'insérer `Screen`
--

TRUNCATE TABLE `Screen`;
--
-- Contenu de la table `Screen`
--

INSERT INTO `Screen` (`idScr`, `typeScr`, `resolutionScr`, `densityScr`, `sizeSrc`, `capacityScr`) VALUES
(1, 'SUPER AMOLED', '1920x1080', 386, 5.7, 'FULL HD'),
(2, 'SUPER AMOLED', '1440x2560', 511, 5.7, 'QHD ');

-- --------------------------------------------------------

--
-- Structure de la table `Smartphone`
--

DROP TABLE IF EXISTS `Smartphone`;
CREATE TABLE IF NOT EXISTS `Smartphone` (
  `idS` int(11) NOT NULL AUTO_INCREMENT,
  `codeNameS` varchar(50) NOT NULL,
  `fullNameS` varchar(50) NOT NULL,
  `constructorS` varchar(50) NOT NULL,
  `ramS` float NOT NULL,
  `weightS` float NOT NULL,
  `thinknessS` float NOT NULL,
  `heightS` float NOT NULL,
  `widthS` float NOT NULL,
  `releaseDateS` date NOT NULL,
  `priceS` float DEFAULT NULL,
  `photoFrontS` float NOT NULL,
  `photoBackS` float NOT NULL,
  `internalStorageS` varchar(50) NOT NULL,
  `externalStorageS` varchar(100) DEFAULT NULL,
  `batteryCapacityS` int(11) NOT NULL,
  `cNetworkS` varchar(50) DEFAULT NULL,
  `videoFrontS` varchar(50) DEFAULT NULL,
  `videoBackS` varchar(50) DEFAULT NULL,
  `pictureS` varchar(100) NOT NULL,
  `idU` int(11) NOT NULL,
  `idScr` int(11) NOT NULL,
  `idOS` int(11) NOT NULL,
  `idProc` int(11) NOT NULL,
  `idG` int(11) NOT NULL,
  `creation_date` date NOT NULL,
  PRIMARY KEY (`idS`),
  KEY `FK_Smartphone_idU` (`idU`),
  KEY `FK_Smartphone_idScr` (`idScr`),
  KEY `FK_Smartphone_idOS` (`idOS`),
  KEY `FK_Smartphone_idProc` (`idProc`),
  KEY `FK_idG` (`idG`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Vider la table avant d'insérer `Smartphone`
--

TRUNCATE TABLE `Smartphone`;
--
-- Contenu de la table `Smartphone`
--

INSERT INTO `Smartphone` (`idS`, `codeNameS`, `fullNameS`, `constructorS`, `ramS`, `weightS`, `thinknessS`, `heightS`, `widthS`, `releaseDateS`, `priceS`, `photoFrontS`, `photoBackS`, `internalStorageS`, `externalStorageS`, `batteryCapacityS`, `cNetworkS`, `videoFrontS`, `videoBackS`, `pictureS`, `idU`, `idScr`, `idOS`, `idProc`, `idG`, `creation_date`) VALUES
(1, 'SM-N916L', 'Galaxy Note 4', 'Samsung', 3, 176, 8.5, 78.6, 153.5, '2014-10-17', 729, 3.7, 16, '32', '128', 3220, '2G/3G/3G+/4G(LTE)/4G+', 'HD 1080p (1920*1080)', '3840x2160 ', '', 1, 2, 6, 2, 2, '2015-02-03'),
(2, 'SM-N9005', 'Galaxy Note 3', 'Samsung', 3, 168, 8.3, 79.2, 151.2, '2013-09-12', NULL, 2, 13, '16/32/64', '64', 3200, '2G/3G/3G+/4G(LTE)', 'HD 1080p (1920x1080)', '2160p@30fps /  1080p@60fps', '', 1, 2, 5, 5, 1, '2015-02-03');

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
  `idU` int(11) NOT NULL AUTO_INCREMENT,
  `pseudoU` varchar(50) NOT NULL,
  `passwordU` varchar(50) NOT NULL,
  `firstNameU` varchar(100) NOT NULL,
  `lastNameU` varchar(100) NOT NULL,
  `emailU` varchar(50) NOT NULL,
  `pictureU` varchar(100) DEFAULT NULL,
  `idUT` int(11) NOT NULL,
  PRIMARY KEY (`idU`),
  UNIQUE KEY `pseudoU` (`pseudoU`,`passwordU`),
  KEY `FK_User_idUT` (`idUT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Vider la table avant d'insérer `User`
--

TRUNCATE TABLE `User`;
--
-- Contenu de la table `User`
--

INSERT INTO `User` (`idU`, `pseudoU`, `passwordU`, `firstNameU`, `lastNameU`, `emailU`, `pictureU`, `idUT`) VALUES
(1, 'dany', 'azerty', 'RAFINA', 'Dany', 'danyrafina@gmail.com', NULL, 1),
(2, 'marc', 'azerty', 'LACHARD', 'Marc', 'mlachard@gmail.com', NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `UserType`
--

DROP TABLE IF EXISTS `UserType`;
CREATE TABLE IF NOT EXISTS `UserType` (
  `idUT` int(11) NOT NULL AUTO_INCREMENT,
  `nameUT` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idUT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Vider la table avant d'insérer `UserType`
--

TRUNCATE TABLE `UserType`;
--
-- Contenu de la table `UserType`
--

INSERT INTO `UserType` (`idUT`, `nameUT`) VALUES
(1, 'Developer'),
(2, 'SimpleUser'),
(3, 'Redactor'),
(4, 'Administrator'),
(5, 'Moderator');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `COMPARED`
--
ALTER TABLE `COMPARED`
  ADD CONSTRAINT `FK_sm1` FOREIGN KEY (`idS1`) REFERENCES `Smartphone` (`idS`),
  ADD CONSTRAINT `FK_sm2` FOREIGN KEY (`idS2`) REFERENCES `Smartphone` (`idS`);

--
-- Contraintes pour la table `Smartphone`
--
ALTER TABLE `Smartphone`
  ADD CONSTRAINT `FK_Smartphone_idOS` FOREIGN KEY (`idOS`) REFERENCES `OS` (`idOS`),
  ADD CONSTRAINT `FK_Smartphone_idProc` FOREIGN KEY (`idProc`) REFERENCES `Processor` (`idProc`),
  ADD CONSTRAINT `FK_Smartphone_idScr` FOREIGN KEY (`idScr`) REFERENCES `Screen` (`idScr`),
  ADD CONSTRAINT `FK_Smartphone_idU` FOREIGN KEY (`idU`) REFERENCES `User` (`idU`),
  ADD CONSTRAINT `Smartphone_ibfk_1` FOREIGN KEY (`idG`) REFERENCES `GPU` (`idG`);

--
-- Contraintes pour la table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `FK_User_idUT` FOREIGN KEY (`idUT`) REFERENCES `UserType` (`idUT`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
