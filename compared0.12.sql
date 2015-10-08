-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 28 Juin 2015 à 19:59
-- Version du serveur :  5.6.24-0ubuntu2
-- Version de PHP :  5.6.4-4ubuntu6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `compared`
--
CREATE DATABASE IF NOT EXISTS `compared` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `compared`;

-- --------------------------------------------------------

--
-- Structure de la table `COMPARED`
--

DROP TABLE IF EXISTS `COMPARED`;
CREATE TABLE IF NOT EXISTS `COMPARED` (
`idCOMPARED` int(11) NOT NULL,
  `idS1` int(11) NOT NULL,
  `idS2` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `COMPARED`
--

INSERT INTO `COMPARED` (`idCOMPARED`, `idS1`, `idS2`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 1, 1),
(4, 1, 2),
(5, 1, 2),
(6, 2, 1),
(7, 1, 2),
(8, 2, 1),
(9, 1, 2),
(10, 1, 2),
(11, 1, 2),
(12, 1, 2),
(13, 1, 2),
(14, 1, 2),
(15, 1, 2),
(16, 1, 2),
(17, 2, 1),
(18, 2, 1),
(19, 1, 2),
(20, 2, 1),
(21, 1, 2),
(22, 1, 2),
(23, 1, 2),
(24, 1, 2),
(25, 1, 1),
(26, 1, 2),
(27, 1, 2),
(28, 1, 2),
(29, 1, 2),
(30, 1, 2),
(31, 1, 2),
(32, 1, 2),
(33, 1, 2),
(34, 1, 2),
(35, 1, 2),
(36, 1, 2),
(37, 1, 2),
(38, 1, 2),
(39, 1, 2),
(40, 1, 2),
(41, 1, 2),
(42, 1, 2),
(43, 1, 2),
(44, 1, 2),
(45, 1, 2),
(46, 1, 2),
(47, 1, 2),
(48, 1, 2),
(49, 1, 2),
(50, 1, 2),
(51, 1, 2),
(52, 1, 2),
(53, 1, 2),
(54, 1, 2),
(55, 1, 2),
(56, 1, 2),
(57, 1, 2),
(58, 1, 2),
(59, 1, 2),
(60, 1, 2),
(61, 1, 2),
(62, 1, 2),
(63, 1, 2),
(64, 1, 2),
(65, 1, 2),
(66, 1, 2),
(67, 1, 2),
(68, 1, 2),
(69, 1, 2),
(70, 1, 2),
(71, 1, 2),
(72, 1, 2),
(73, 1, 2),
(74, 1, 2),
(75, 1, 2),
(76, 1, 2),
(77, 1, 2),
(78, 1, 2),
(79, 1, 2),
(80, 1, 2),
(81, 1, 2),
(82, 1, 2),
(83, 1, 2),
(84, 1, 2),
(85, 1, 2),
(86, 1, 2),
(87, 1, 2),
(88, 1, 2),
(89, 1, 2),
(90, 1, 2),
(91, 1, 2),
(92, 1, 2),
(93, 1, 2),
(94, 1, 2),
(95, 1, 2),
(96, 1, 2),
(97, 1, 2),
(98, 1, 2),
(99, 1, 2),
(100, 1, 2),
(101, 1, 2),
(102, 1, 2),
(103, 1, 2),
(104, 1, 2),
(105, 1, 2),
(106, 1, 2),
(107, 1, 2),
(108, 1, 2),
(109, 1, 2),
(110, 1, 2),
(111, 1, 2),
(112, 1, 2),
(113, 1, 2),
(114, 1, 2),
(115, 1, 2),
(116, 1, 2),
(117, 1, 2),
(118, 1, 2),
(119, 1, 2),
(120, 1, 2),
(121, 1, 2),
(122, 1, 2),
(123, 1, 2),
(124, 1, 2),
(125, 1, 2),
(126, 1, 2),
(127, 2, 1),
(131, 2, 1),
(132, 2, 1),
(133, 2, 1),
(134, 2, 1),
(135, 2, 1),
(136, 3, 1),
(137, 3, 1),
(138, 3, 1),
(139, 3, 4),
(140, 3, 4),
(141, 4, 3),
(142, 2, 3),
(143, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `GPU`
--

DROP TABLE IF EXISTS `GPU`;
CREATE TABLE IF NOT EXISTS `GPU` (
`idG` int(11) NOT NULL,
  `nameG` varchar(200) NOT NULL,
  `constructorG` varchar(200) NOT NULL,
  `versionG` int(11) NOT NULL,
  `frequency` float NOT NULL,
  `gflops` decimal(4,1) DEFAULT NULL,
  `print` int(11) DEFAULT NULL,
  `directXV` decimal(4,1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `GPU`
--

INSERT INTO `GPU` (`idG`, `nameG`, `constructorG`, `versionG`, `frequency`, `gflops`, `print`, `directXV`) VALUES
(1, 'Adreno', 'Qualcomm', 330, 578, 166.5, 28, 11.1),
(2, 'Adreno', 'Qualcomm', 420, 600, 172.8, 28, 11.2),
(3, 'PowerVR GX', 'Apple', 6450, 1400, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `HelpMessage`
--

DROP TABLE IF EXISTS `HelpMessage`;
CREATE TABLE IF NOT EXISTS `HelpMessage` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `object` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `HelpMessage`
--

INSERT INTO `HelpMessage` (`id`, `name`, `email`, `object`, `content`, `date`) VALUES
(8, 'fz', 'rafina77@hotmail.fr', 'Quoi', 'dsqdq', '0000-00-00'),
(9, 'fz', 'rafina77@hotmail.fr', 'Quoi', 'dsqdq', '15/06/2015'),
(10, 'fz', 'rafina77@hotmail.fr', 'Quoi', 'dsqdq', '15/06/2015');

-- --------------------------------------------------------

--
-- Structure de la table `Notice`
--

DROP TABLE IF EXISTS `Notice`;
CREATE TABLE IF NOT EXISTS `Notice` (
`idA` int(11) NOT NULL,
  `nomInter` varchar(50) NOT NULL,
  `content` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
`idOS` int(11) NOT NULL,
  `nameOS` varchar(50) NOT NULL,
  `versionOS` varchar(20) NOT NULL,
  `constructorOS` varchar(50) NOT NULL,
  `releaseDateOS` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

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
`idProc` int(11) NOT NULL,
  `nameProc` varchar(50) NOT NULL,
  `constructorProc` varchar(50) NOT NULL,
  `nbCoreProc` int(11) NOT NULL,
  `archProc` varchar(11) NOT NULL,
  `versionProc` varchar(25) NOT NULL,
  `frequencyProc` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Processor`
--

INSERT INTO `Processor` (`idProc`, `nameProc`, `constructorProc`, `nbCoreProc`, `archProc`, `versionProc`, `frequencyProc`) VALUES
(1, 'Snapdragon', 'Qualcomm', 4, 'ARM 32', '801', 2.5),
(2, 'Snapdragon', 'Qualcomm', 4, 'ARM 32', '805', 2.7),
(3, 'A', 'Samsung Electronics', 2, 'ARM 64', '7', 1.4),
(4, 'A', 'Samsung Electronics', 2, 'ARM 32', '6', 1.3),
(5, 'Snapdragon', 'Qualcomm', 4, 'ARM 32', '800', 2.26),
(6, 'A', 'Samsung', 2, 'ARM 64', '8', 1.4);

-- --------------------------------------------------------

--
-- Structure de la table `Screen`
--

DROP TABLE IF EXISTS `Screen`;
CREATE TABLE IF NOT EXISTS `Screen` (
`idScr` int(11) NOT NULL,
  `typeScr` varchar(50) NOT NULL,
  `resolutionScr` varchar(50) NOT NULL,
  `densityScr` int(11) NOT NULL,
  `sizeScr` float NOT NULL,
  `capacityScr` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Screen`
--

INSERT INTO `Screen` (`idScr`, `typeScr`, `resolutionScr`, `densityScr`, `sizeScr`, `capacityScr`) VALUES
(1, 'SUPER AMOLED', '1920x1080', 386, 5.7, 'FULLHD'),
(2, 'SUPER AMOLED', '2560x1440', 511, 5.7, 'QHD '),
(3, 'IPS', '1920x1080', 424, 5.2, 'FULLHD'),
(4, 'IPS', '1334x750', 326, 4.7, 'HD+');

-- --------------------------------------------------------

--
-- Structure de la table `Smartphone`
--

DROP TABLE IF EXISTS `Smartphone`;
CREATE TABLE IF NOT EXISTS `Smartphone` (
`idS` int(11) NOT NULL,
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
  `idScr` int(11) NOT NULL,
  `idOS` int(11) NOT NULL,
  `idProc` int(11) NOT NULL,
  `idG` int(11) NOT NULL,
  `creation_date` date NOT NULL,
  `resolutionVideoFront` varchar(100) NOT NULL,
  `resolutionVideoBack` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Smartphone`
--

INSERT INTO `Smartphone` (`idS`, `codeNameS`, `fullNameS`, `constructorS`, `ramS`, `weightS`, `thinknessS`, `heightS`, `widthS`, `releaseDateS`, `priceS`, `photoFrontS`, `photoBackS`, `internalStorageS`, `externalStorageS`, `batteryCapacityS`, `cNetworkS`, `videoFrontS`, `videoBackS`, `pictureS`, `idScr`, `idOS`, `idProc`, `idG`, `creation_date`, `resolutionVideoFront`, `resolutionVideoBack`) VALUES
(1, 'SM-N916L', 'Galaxy Note 4 32 Go', 'Samsung', 3, 176, 8.5, 78.6, 153.5, '2014-10-17', 0, 3.7, 16, '32', '128', 3220, '2G/3G/3G+/4G(LTE)/4G+', 'FULLHD', '4K/FULLHD/HD', 'samsunggalaxynote4', 2, 6, 2, 2, '2015-02-03', '1920x1080', '3840x2160 '),
(2, 'SM-N9005', 'Galaxy Note 3 64 Go', 'Samsung', 3, 168, 8.3, 79.2, 151.2, '2013-09-12', NULL, 2, 13, '64', '64', 3200, '2G/3G/3G+/4G(LTE)', 'FULLHD', '4K/FULLHD/HD', 'samsunggalaxynote3', 1, 5, 5, 1, '2015-02-03', '1920x1080', '3840x2160'),
(3, 'D6603', 'XPERIA Z3 32Go', 'SONY', 3, 152, 7.3, 72, 146, '2014-09-17', NULL, 2.2, 20.7, '32', '128', 3100, '2G/3G/3G+/4G', '4K', 'FULLHD', 'sonyxperiaz3', 3, 5, 1, 2, '2015-06-17', '3840x2160', '1920x1080'),
(4, 'N61', 'iPhone 6 16Go', 'Apple', 1, 129, 6.9, 67, 138.1, '2015-04-17', 709, 1.2, 8, '16', 'NULL', 1810, '2G/3G/3G+/4G', 'HD', 'FULLHD', 'appleiphone6', 4, 2, 6, 3, '2015-06-17', '1280x720', '1920x1080');

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
`idU` int(11) NOT NULL,
  `pseudoU` varchar(50) NOT NULL,
  `passwordU` varchar(50) NOT NULL,
  `firstNameU` varchar(100) NOT NULL,
  `lastNameU` varchar(100) NOT NULL,
  `emailU` varchar(50) NOT NULL,
  `pictureU` varchar(100) DEFAULT NULL,
  `idUT` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`idU`, `pseudoU`, `passwordU`, `firstNameU`, `lastNameU`, `emailU`, `pictureU`, `idUT`) VALUES
(1, 'dany', 'azerty', 'RAFINA', 'Dany', 'danyrafina@gmail.com', NULL, 1),
(2, 'marc', 'azerty', 'LACHARD', 'Marc', 'mlachard@gmail.com', NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `UserSmartphone`
--

DROP TABLE IF EXISTS `UserSmartphone`;
CREATE TABLE IF NOT EXISTS `UserSmartphone` (
  `idU` int(11) NOT NULL,
  `idS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `UserType`
--

DROP TABLE IF EXISTS `UserType`;
CREATE TABLE IF NOT EXISTS `UserType` (
`idUT` int(11) NOT NULL,
  `nameUT` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
-- Index pour les tables exportées
--

--
-- Index pour la table `COMPARED`
--
ALTER TABLE `COMPARED`
 ADD PRIMARY KEY (`idCOMPARED`), ADD KEY `FK_sm1` (`idS1`), ADD KEY `FK_sm2` (`idS2`);

--
-- Index pour la table `GPU`
--
ALTER TABLE `GPU`
 ADD PRIMARY KEY (`idG`);

--
-- Index pour la table `HelpMessage`
--
ALTER TABLE `HelpMessage`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Notice`
--
ALTER TABLE `Notice`
 ADD PRIMARY KEY (`idA`);

--
-- Index pour la table `OS`
--
ALTER TABLE `OS`
 ADD PRIMARY KEY (`idOS`);

--
-- Index pour la table `Processor`
--
ALTER TABLE `Processor`
 ADD PRIMARY KEY (`idProc`);

--
-- Index pour la table `Screen`
--
ALTER TABLE `Screen`
 ADD PRIMARY KEY (`idScr`);

--
-- Index pour la table `Smartphone`
--
ALTER TABLE `Smartphone`
 ADD PRIMARY KEY (`idS`), ADD KEY `FK_Smartphone_idScr` (`idScr`), ADD KEY `FK_Smartphone_idOS` (`idOS`), ADD KEY `FK_Smartphone_idProc` (`idProc`), ADD KEY `FK_idG` (`idG`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
 ADD PRIMARY KEY (`idU`), ADD UNIQUE KEY `pseudoU` (`pseudoU`,`passwordU`), ADD KEY `FK_User_idUT` (`idUT`);

--
-- Index pour la table `UserSmartphone`
--
ALTER TABLE `UserSmartphone`
 ADD PRIMARY KEY (`idS`), ADD UNIQUE KEY `PRIMARY2` (`idU`);

--
-- Index pour la table `UserType`
--
ALTER TABLE `UserType`
 ADD PRIMARY KEY (`idUT`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `COMPARED`
--
ALTER TABLE `COMPARED`
MODIFY `idCOMPARED` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT pour la table `GPU`
--
ALTER TABLE `GPU`
MODIFY `idG` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `HelpMessage`
--
ALTER TABLE `HelpMessage`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `Notice`
--
ALTER TABLE `Notice`
MODIFY `idA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `OS`
--
ALTER TABLE `OS`
MODIFY `idOS` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `Processor`
--
ALTER TABLE `Processor`
MODIFY `idProc` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `Screen`
--
ALTER TABLE `Screen`
MODIFY `idScr` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `Smartphone`
--
ALTER TABLE `Smartphone`
MODIFY `idS` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
MODIFY `idU` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `UserType`
--
ALTER TABLE `UserType`
MODIFY `idUT` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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
ADD CONSTRAINT `Smartphone_ibfk_1` FOREIGN KEY (`idG`) REFERENCES `GPU` (`idG`);

--
-- Contraintes pour la table `User`
--
ALTER TABLE `User`
ADD CONSTRAINT `FK_User_idUT` FOREIGN KEY (`idUT`) REFERENCES `UserType` (`idUT`);

--
-- Contraintes pour la table `UserSmartphone`
--
ALTER TABLE `UserSmartphone`
ADD CONSTRAINT `UserSmartphone_ibfk_1` FOREIGN KEY (`idS`) REFERENCES `Smartphone` (`idS`),
ADD CONSTRAINT `UserSmartphone_ibfk_2` FOREIGN KEY (`idU`) REFERENCES `User` (`idU`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
