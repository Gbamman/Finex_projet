-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 05 Février 2016 à 18:28
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `sahgescredit`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE IF NOT EXISTS `agence` (
  `idagence` int(40) NOT NULL AUTO_INCREMENT,
  `idbanque` int(40) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `iduser` int(40) NOT NULL,
  PRIMARY KEY (`idagence`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `agence`
--

INSERT INTO `agence` (`idagence`, `idbanque`, `libelle`, `iduser`) VALUES
(1, 1, 'Agence Gahi Ora', 0),
(2, 1, 'Agence Saint Michel Ora', 0),
(3, 2, 'Agence Saint Michel BIBE', 0),
(4, 2, 'Agence Tokpa BIBE', 0),
(5, 3, 'Agence Tokpa Ecobank', 0),
(6, 3, 'Agence Calavi Ecobank', 0),
(7, 4, 'Agence Akpakpa BOA', 0),
(8, 4, 'Agence Gbegamey BOA', 0);

-- --------------------------------------------------------

--
-- Structure de la table `banque`
--

CREATE TABLE IF NOT EXISTS `banque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `logo` blob NOT NULL,
  `etat` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `banque`
--

INSERT INTO `banque` (`id`, `libelle`, `logo`, `etat`) VALUES
(1, 'Orabanque', '', 'Actif'),
(2, 'BIBE', '', 'Actif'),
(3, 'Ecobank', '', 'Actif'),
(4, 'BOA', '', 'Actif');

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE IF NOT EXISTS `contrat` (
  `idcontrat` int(40) NOT NULL AUTO_INCREMENT,
  `numcontrat` varchar(80) DEFAULT NULL,
  `numeropret` varchar(100) DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  `idbanque` int(40) DEFAULT NULL,
  `banquelibelle` varchar(100) DEFAULT NULL,
  `idagence` int(40) DEFAULT NULL,
  `libelleagence` varchar(100) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `datenaissance` date DEFAULT NULL,
  `sexe` char(2) DEFAULT NULL,
  `profession` varchar(40) DEFAULT NULL,
  `capital` int(40) DEFAULT NULL,
  `dateeffet` date DEFAULT NULL,
  `duree` varchar(40) DEFAULT NULL,
  `dateecheance` date DEFAULT NULL,
  `tauxemprunt` double DEFAULT NULL,
  `reglementprime` varchar(40) DEFAULT NULL COMMENT 'On peut aussi l''appeler nature',
  `periodicite` varchar(40) DEFAULT NULL,
  `differe` int(10) DEFAULT NULL,
  `perteemploi` varchar(100) DEFAULT NULL,
  `remboursement` varchar(40) DEFAULT NULL,
  `tauxprimes` double DEFAULT NULL,
  `primeassurance` double DEFAULT NULL,
  `typeremb` int(40) DEFAULT NULL,
  `primeperte` int(11) DEFAULT NULL,
  `supprime` int(11) DEFAULT NULL,
  `accessoires` int(11) DEFAULT NULL,
  `iduser` int(40) DEFAULT NULL,
  `codeagence` int(40) DEFAULT NULL,
  `estpaye` varchar(5) DEFAULT NULL,
  `datepaiement` datetime DEFAULT NULL,
  `estenvoye` varchar(5) DEFAULT NULL,
  `dateenvoi` datetime DEFAULT NULL,
  `montantpaye` int(40) DEFAULT NULL,
  `bordereauxcom` varchar(25) DEFAULT NULL,
  `save` varchar(100) NOT NULL,
  PRIMARY KEY (`idcontrat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Contenu de la table `contrat`
--

INSERT INTO `contrat` (`idcontrat`, `numcontrat`, `numeropret`, `status`, `idbanque`, `banquelibelle`, `idagence`, `libelleagence`, `nom`, `prenom`, `datenaissance`, `sexe`, `profession`, `capital`, `dateeffet`, `duree`, `dateecheance`, `tauxemprunt`, `reglementprime`, `periodicite`, `differe`, `perteemploi`, `remboursement`, `tauxprimes`, `primeassurance`, `typeremb`, `primeperte`, `supprime`, `accessoires`, `iduser`, `codeagence`, `estpaye`, `datepaiement`, `estenvoye`, `dateenvoi`, `montantpaye`, `bordereauxcom`, `save`) VALUES
(1, 'SAHAM Assurance', '1246996', 'SOUSCRIPTION', NULL, NULL, 0, NULL, 'Paul', 'Dossou', '2015-10-12', 'M', 'Marketing', 135652233, '2003-05-15', '2', '2006-03-14', 3, NULL, 'semestrielle', 3, 'non', 'periodique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(2, 'SAHAM Assurance 2', 'ANPLKO12', 'ANNULATION', NULL, NULL, 0, NULL, 'Jean', 'TOUPE', '2015-10-12', 'M', 'Professeur', NULL, NULL, '2', NULL, 3, NULL, 'trimestrielle', 3, 'non', 'periodique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(3, 'ARV12POO12', '12333', 'SOUSCRIPTION', NULL, NULL, NULL, NULL, 'Youki', 'Blaise', '2015-10-12', 'F', 'Menusier', 12366, '2015-11-10', NULL, '2015-10-14', 5, NULL, 'bimestrille', 5, 'oui', 'periodique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(4, 'Bloom', '12333', 'ANNULATION', NULL, NULL, NULL, NULL, 'BONOU', 'DAVID', '2015-10-12', 'F', NULL, NULL, NULL, NULL, NULL, 5, NULL, 'bimestrille', 5, 'oui', 'periodique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(6, 'frer', 'gergg', 'ANNULATION', NULL, NULL, NULL, NULL, 'rergg', 'erger', '0000-00-00', 'F', NULL, NULL, NULL, '5', NULL, 5, NULL, 'mensuelle', 8, 'non', 'a terme', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(7, 'frer', 'gergg', 'SOUSCRIPTION', NULL, NULL, NULL, NULL, 'rergg', 'erger', '0000-00-00', 'F', NULL, NULL, NULL, '5', NULL, 5, NULL, 'mensuelle', 8, 'non', 'a terme', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(8, 'deeee', 'ddddd', 'ANNULATION', NULL, NULL, NULL, NULL, 'ddddd', 'dddd', '2015-10-12', 'F', 'Grand', NULL, NULL, '2', NULL, 5, NULL, 'mensuelle', 5, 'non', 'periodique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(9, 'deeee', 'ddddd', 'SOUSCRIPTION', NULL, NULL, NULL, NULL, 'ddddd', 'dddd', '2015-10-12', 'F', 'Grand', NULL, NULL, '2', NULL, 5, NULL, 'mensuelle', 5, 'non', 'periodique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(10, 'fff', 'ttt', 'ANNULATION', NULL, NULL, NULL, NULL, '''rrrr', '''tt', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(11, 'rg''y-', 'grehreh', 'SOUSCRIPTION', NULL, NULL, NULL, NULL, 'ghtyru', 'trhthh', '0000-00-00', 'F', 'eg', NULL, NULL, '3', NULL, 2, NULL, 'bimestrille', 2, 'non', 'periodique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(12, 'rg''y-', 'grehreh', 'ANNULATION', NULL, NULL, NULL, NULL, 'ghtyru', 'trhthh', '0000-00-00', 'F', 'eg', NULL, NULL, '3', NULL, 2, NULL, 'bimestrille', 2, 'non', 'periodique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(15, 'JJUoOO', '525552', 'ANNULATION', 4, NULL, 7, NULL, 'Juste', 'Tresor', '2015-10-12', 'F', 'ghthtth', 15126, '2005-05-12', '12', '2015-11-10', 12, NULL, 'bimestrille', 3, NULL, 'periodique', 10, 1230, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(17, 'Dada', 'eg', 'SOUSCRIPTION', 1, NULL, 0, NULL, 'Serge', 'eggegeg', '2015-10-12', 'F', 'ghthtth', 12222, '2015-10-12', 'ererg', '2015-11-10', 2, NULL, 'bimestrille', 0, NULL, 'periodique', 12, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(18, 'Jules', '12363', 'SOUSCRIPTION', 1, 'Orabanque', 1, 'Agence Gahi Ora', 'Fawaz', 'Karl', '2015-10-12', 'M', 'Banqiuer', 12563, '2020-12-22', '20', '2015-11-10', 12, 'UNIQUE', 'annuelle', 52, 'oui', 'periodique', 10, 10, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(22, 'Angular', '122223', 'SOUSCRIPTION', 1, NULL, 2, NULL, 'Josse', 'Grand', '2015-10-12', 'M', 'Banquier', 50245, '2013-04-02', '60', '2015-12-24', 25, 'unique', 'trimestrielle', 30, NULL, 'periodique', 123132, 256, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(23, 'AKK12563', '126354', 'SOUSCRIPTION', 0, NULL, 2, NULL, 'Grace', 'Divine', '2014-11-30', 'F', 'Chauffeur', 12463, '2015-08-14', '5', '2016-06-14', 80, NULL, 'mensuelle', 23, NULL, 'periodique', 424, 4242452, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(24, 'AVB1235', '124366', 'ANNULATION', NULL, NULL, 2, NULL, 'Goum', 'Michel', '2015-11-30', 'M', 'Comedien', 124563, '2014-05-14', '20', '2017-09-14', 66, 'unique', 'bimestrille', 12, NULL, 'a terme', 100, 105, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(35, 'DG1254', 'dgdfgfg', 'ANNULATION', 0, NULL, 1, NULL, 'DEDEDE', 'Jean', '2015-10-12', 'M', 'Banquier', 5245242, '2015-12-09', '15', '2015-11-10', 13, 'annulation', 'mensuelle', 11, NULL, 'periodique', 10, 12, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(37, '12050', '54145', 'SOUSCRIPTION', 1, NULL, 1, NULL, 'TOTIN', 'FRITZ', '2016-11-30', 'M', 'ANALYSTE ACTUARIEL', 5000000, '2014-05-14', '20', '2017-09-14', 7, 'unique', 'mensuelle', 20, NULL, 'a terme', 20, 10, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(36, 'DG1255', 'Grand', 'SOUSCRIPTION', NULL, NULL, 5, NULL, 'Dieu-Donne', 'Jean', '2015-10-13', 'M', 'Banquier', 5245242, '2015-12-09', '15', '2015-11-10', 13, 'unique', 'mensuelle', 11, NULL, 'periodique', 10, 12, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(38, 'ggggggg', 'ggggggggg', 'ANNULATION', 2, 'BIBE', 4, 'Agence Tokpa BIBE', 'ZINSOU', 'LIONEL', '2016-11-30', 'M', '11111', 111100, '2015-05-14', '8', '2016-09-14', 11111, 'ANNNUEL', 'trimestrielle', 11111, NULL, 'periodique', 1111, 1111, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(39, '12222', '5124', 'SOUSCRIPTION', 1, NULL, 2, NULL, 'TOTIN', 'FRITZ', '0000-00-00', 'M', 'COMMERCANT', 15000, '2015-10-14', '3', '2016-02-14', 5, 'unique', 'mensuelle', 0, NULL, 'periodique', 1.5, 5290, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(40, 'mmmm', 'mmmm', 'SOUSCRIPTION', NULL, NULL, NULL, NULL, 'mmmm', 'mmmm', '0000-00-00', 'M', '12', 0, '2014-05-15', '20', '2017-09-15', 12, NULL, NULL, 23, NULL, 'periodique', 2, 2, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(41, 'Bffff', '102', 'SOUSCRIPTION', NULL, NULL, 1, NULL, 'mpmm', 'mpmp', '0000-00-00', 'M', '1020', 12, '2014-05-18', '20', '2017-09-18', 21, 'unique', 'mensuelle', NULL, NULL, 'periodique', 10, 10, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(42, 'NLJUM', '14', 'SOUSCRIPTION', 4, 'BOA', 8, 'Agence Gbegamey BOA', 'DJOSSOU', 'Beatrice', '0000-00-00', 'M', 'Grand', 105102, '2015-08-18', '5', '2016-06-18', 12, 'unique', 'mensuelle', 120, NULL, 'periodique', 2, 100, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(60, 'hhhul', '1202', 'ANNULATION', 3, 'Ecobank', 6, 'Agence Calavi Ecobank', 'kioo', 'loop', '2012-02-12', 'M', 'Professeur', 120344422, '2012-02-12', '25', '2018-02-19', 12, 'unique', 'trimestrielle', 2, 'oui', 'periodique', 2, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(61, 'LOMPP', '1253', 'SOUSCRIPTION', 3, 'Ecobank', 6, 'Agence Calavi Ecobank', 'NASSAIRE', 'Pacome', '1959-01-01', 'M', 'Professeur', 1263548, '2015-11-27', '2', '2016-01-19', 12, 'ANNNUEL', 'mensuelle', 1323, 'oui', 'periodique', 0, 11223, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'insert'),
(69, 'kiomp', 'lllll', 'SOUSCRIPTION', 3, NULL, 5, NULL, 'llllll', 'llllll', '2015-02-12', 'M', 'llll', 252969666, '2016-01-21', '0', '2016-01-21', 2, 'unique', 'bimestrille', 12, 'oui', 'a terme', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(68, 'NGTBB', 'NHGT', 'SOUSCRIPTION', 2, NULL, 3, NULL, 'MPLOO', 'Pacome', '0000-00-00', 'M', 'Professeur', 2147483647, '2015-10-20', '3', '2016-04-20', 20, 'annulation', 'mensuelle', 10, NULL, 'a terme', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(67, 'LLOO', '10', 'SOUSCRIPTION', 1, 'Orabanque', 0, 'Agence Saint Michel Ora', 'PAULETTE', 'HUIY', '2015-11-30', 'F', 'Photographe', 5255896, '2014-10-21', '15', '0000-00-00', 2, 'unique', 'mensuelle', 2, 'oui', 'periodique', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(66, 'grerr', 'gggg', 'SOUSCRIPTION', 3, NULL, 5, NULL, 'gggg', 'ttttt', '2015-02-02', 'M', 'ttttt', 2147483647, '2015-08-19', '5', '2016-06-19', 25, 'unique', 'mensuelle', 12, 'oui', 'periodique', 0, 15002, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'insert'),
(70, 'BBVFUO', '3621MPOO', 'SOUSCRIPTION', 2, NULL, 0, NULL, 'LOGOSSOU', 'Luc', '2016-02-12', 'M', 'Professeur', 2147483647, '2015-08-25', '5', '2016-06-25', 5, 'UNIQUE', 'bimestrille', 2, 'oui', 'periodique', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(71, 'BBLOL', 'LOMMM', 'SOUSCRIPTION', 1, NULL, 0, NULL, 'MPOLKKK', 'MPOLKJ', '2015-12-02', 'M', 'Professeur', 26544231, '2015-05-25', '8', '2016-09-25', 12, NULL, 'trimestrielle', 12, 'oui', 'periodique', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(72, 'MOJYH', '123654', 'SOUSCRIPTION', 2, NULL, 0, NULL, 'JOJO', 'Joel', '2016-02-02', 'M', 'Photographe', 21525555, '2015-01-25', '12', '2017-01-25', 12, 'UNIQUE', 'bimestrille', 12, 'oui', 'periodique', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(73, 'DERGYJI', 'DEFRT', 'SOUSCRIPTION', 3, NULL, 0, NULL, 'LOGOSSOUI', 'Germain', '2016-02-11', 'M', 'Professeur', 3265522, '2015-08-25', '5', '2016-06-25', 2, 'UNIQUE', 'mensuelle', 10, 'non', 'periodique', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(74, 'NOOODD', 'MLPO', 'SOUSCRIPTION', 4, NULL, 0, NULL, 'MPOLKKK', 'LOLL', '2016-02-02', 'M', '1201', 12, '2016-01-25', '0', '2016-01-25', 120, 'UNIQUE', 'mensuelle', 12, 'oui', 'periodique', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(75, 'NHH', 'fff', 'SOUSCRIPTION', 3, NULL, 0, NULL, 'ffff', 'fff', '2015-02-02', 'M', 'fffff', 5555555, '2015-08-25', '5', '2016-06-25', 10, 'UNIQUE', 'bimestrille', 10, 'non', 'periodique', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(76, 'hhh', 'hhhh', 'SOUSCRIPTION', 2, NULL, 0, NULL, 'hhhh', 'hhhh', '2016-02-02', 'M', 'hhhh', 225666666, '2016-01-25', '0', '2016-01-25', 10, 'UNIQUE', 'mensuelle', 12, NULL, 'periodique', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(77, 'bgyy', 'MOPLKK', 'SOUSCRIPTION', 3, NULL, 0, NULL, 'NBGH', 'KJIUU', '2016-02-02', 'M', 'Photographe', 22565222, '2016-01-25', '0', '2016-01-25', 0, 'UNIQUE', 'mensuelle', 22, 'non', 'a terme', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(78, 'MPLLL22', 'mommm', 'SOUSCRIPTION', 4, 'BOA', 7, 'Agence Akpakpa BOA', 'NEELIK', 'AMOOSSOUVI', '2019-02-12', 'Ma', 'Photographe', 2147483647, '2015-08-27', '5', '2016-06-27', 0, 'UNIQUE', 'trimestrielle', 10, 'oui', 'periodique', 0, 15000, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'insert'),
(79, 'moldldld', 'dddd', 'SOUSCRIPTION', 3, 'Ecobank', 5, 'Agence Tokpa Ecobank', 'MOPPP', 'MOULE', '2015-02-02', 'M', 'Photographe', 253333, '2015-05-27', '8', '2016-09-27', 12, 'UNIQUE', 'mensuelle', 5, 'oui', 'periodique', 0, 15200, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(80, 'NHUUU', 'BGOLO', 'SOUSCRIPTION', 2, 'BIBE', 4, 'Agence Tokpa BIBE', 'MPOMM', 'DSKI', '2015-02-02', 'M', 'Photographe', 55555, '2015-08-27', '5', '2016-06-27', 12, 'ANNNUEL', 'mensuelle', 23, 'non', 'periodique', 0, 15000, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(81, 'MPLLL', 'KIIII', 'SOUSCRIPTION', 2, 'BIBE', 4, 'Agence Tokpa BIBE', 'MPOUJHH', 'LOMPPP', '2016-03-02', 'M', 'Photographe', 1252699, '2016-01-27', '0', '2016-01-27', 0, 'UNIQUE', 'semestrielle', 2, 'non', 'periodique', 10, 1200, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'insert'),
(82, 'BOUM', '12MPON', 'SOUSCRIPTION', 1, 'Orabanque', 2, 'Agence Saint Michel Ora', 'VENANCE', 'BOSSOU', '2016-03-12', 'M', 'Devéloppeur', 78961265, '2015-09-04', '5', '2016-07-04', 2, 'ANNNUEL', 'bimestrille', 3, 'non', 'periodique', 0, 15000, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(83, 'BOUM', '12MPON', 'SOUSCRIPTION', NULL, NULL, NULL, NULL, 'VENANCE', 'BOSSOU', '2016-03-12', 'M', 'Devéloppeur', 78961265, '2015-09-04', '5', '2016-07-04', 2, 'ANNNUEL', 'bimestrille', 3, 'non', 'periodique', 0, 15000, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(84, 'BIEN', 'VNHU', 'SOUSCRIPTION', 1, 'Orabanque', 1, 'Agence Gahi Ora', 'DOSSOU', 'Michel', '2016-02-12', 'M', 'Soudeur', 12636205, '2015-09-04', '5', '2016-07-04', 0, 'UNIQUE', 'mensuelle', 6, 'non', 'a terme', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'insert'),
(85, 'BOUBLE', 'WZZ', 'SOUSCRIPTION', 1, 'Orabanque', 1, 'Agence Gahi Ora', 'BOUNJOUR', 'Sourou', '2013-02-12', 'M', 'MILITAIRE', 12632015, '2015-11-04', '3', '2016-05-04', 3, 'ANNNUEL', 'mensuelle', 7, 'non', 'a terme', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'insert'),
(86, 'BBNU', '12MOP', 'SOUSCRIPTION', 2, 'BIBE', 3, 'Agence Saint Michel BIBE', 'KAKPO', 'PAUL', '2016-03-12', 'M', 'Photographe', 123654200, '2015-09-04', '5', '2016-07-04', 12, 'ANNNUEL', 'bimestrille', 12, 'non', 'a terme', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(87, 'BBVFUO12', '1236', 'SOUSCRIPTION', 1, 'Orabanque', 1, 'Agence Gahi Ora', 'BOUNCE', 'Jean', '2016-02-12', 'Ma', 'Founisseur', 5201236, '2015-09-04', '5', '2016-02-04', 0, 'UNIQUE', 'mensuelle', 12, 'non', 'periodique', 0, 1500, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'insert');

-- --------------------------------------------------------

--
-- Structure de la table `courrier`
--

CREATE TABLE IF NOT EXISTS `courrier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expediteur` varchar(100) NOT NULL,
  `objet` varchar(250) NOT NULL,
  `contenu` text NOT NULL,
  `responsable` smallint(20) NOT NULL,
  `creted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `groupeutilisateur`
--

CREATE TABLE IF NOT EXISTS `groupeutilisateur` (
  `idgroup` int(40) NOT NULL AUTO_INCREMENT,
  `idsousmenu` int(40) NOT NULL,
  `idnomgroupe` int(40) DEFAULT NULL,
  `libelle` varchar(100) NOT NULL,
  `iduser` int(40) DEFAULT NULL,
  `actionMenue` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idgroup`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `groupeutilisateur`
--

INSERT INTO `groupeutilisateur` (`idgroup`, `idsousmenu`, `idnomgroupe`, `libelle`, `iduser`, `actionMenue`) VALUES
(1, 10, 1, '', 1, 'modification'),
(2, 2, 1, '', 1, 'consultation'),
(3, 3, 1, '', 1, 'ecriture'),
(44, 2, 3, '', NULL, 'consultation'),
(45, 31, 2, '', NULL, 'modification'),
(46, 35, 2, '', NULL, 'ecriture'),
(47, 3, 2, '', NULL, 'consultation'),
(51, 10, 2, '', NULL, 'modification'),
(49, 1, 2, '', NULL, 'modification'),
(50, 35, 3, '', NULL, 'modification');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `idmenue` int(40) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  PRIMARY KEY (`idmenue`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `menus`
--

INSERT INTO `menus` (`idmenue`, `libelle`, `icon`) VALUES
(1, 'Etatique', 'fa fa-anchor'),
(2, 'Souscription', 'fa fa-pencil'),
(3, 'Parametres', 'fa fa-cog'),
(10, 'Bref', 'fa fa-envelope-square'),
(11, 'Bref1', 'fa fa-shopping-basket'),
(12, 'Exemple3', 'fa fa-cogs'),
(13, 'mpoooo', 'fa fa-circle-o-notch'),
(14, 'hyytttt126', 'fa fa-eraser'),
(16, 'Brave', 'fa fa-binoculars');

-- --------------------------------------------------------

--
-- Structure de la table `nomgroupeutilisteur`
--

CREATE TABLE IF NOT EXISTS `nomgroupeutilisteur` (
  `idnomgroup` int(40) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`idnomgroup`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `nomgroupeutilisteur`
--

INSERT INTO `nomgroupeutilisteur` (`idnomgroup`, `libelle`) VALUES
(1, 'Secretaire'),
(2, 'maître'),
(3, 'CONTROLLEUR'),
(16, 'VERIFICATION'),
(15, 'Boom'),
(14, 'CONTROLLEUR66'),
(17, 'jgjgjgj');

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE IF NOT EXISTS `parametres` (
  `idparam` int(40) NOT NULL AUTO_INCREMENT,
  `idbanque` int(40) NOT NULL,
  `fraisgestion` double NOT NULL,
  `fraisacquisition` double NOT NULL,
  `capitalmax` int(40) NOT NULL,
  `typepret` int(40) NOT NULL,
  `tauxprime` int(40) NOT NULL,
  `accessoires` int(40) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idparam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `idprofil` int(40) NOT NULL AUTO_INCREMENT,
  `idnomgroup` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `chemin` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idprofil`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `profil`
--

INSERT INTO `profil` (`idprofil`, `idnomgroup`, `libelle`, `chemin`) VALUES
(1, 1, 'Secretaire1', 'listebanque'),
(2, 2, 'Gestionnaire2', 'listedescontrats'),
(3, 3, 'Controleur', 'utilisateurs'),
(8, 3, 'COMMISSION', '');

-- --------------------------------------------------------

--
-- Structure de la table `sousmenus`
--

CREATE TABLE IF NOT EXISTS `sousmenus` (
  `idsousmenu` int(40) NOT NULL AUTO_INCREMENT,
  `idmenu` int(40) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `nomcourt` varchar(100) DEFAULT NULL,
  `icon` varchar(10) NOT NULL,
  PRIMARY KEY (`idsousmenu`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `sousmenus`
--

INSERT INTO `sousmenus` (`idsousmenu`, `idmenu`, `libelle`, `nomcourt`, `icon`) VALUES
(1, 3, 'Liste des banques', 'listebanque', ''),
(2, 3, 'Gestion des utilisateurs', 'utilisateurs', ''),
(3, 2, 'Liste des contrats', 'listedescontrats', ''),
(35, 1, 'Etat des menus', 'gestiondesmenus', ''),
(10, 3, 'Gestion des menus', 'gestiondesmenus', ''),
(31, 3, 'Gestion de profil', 'gestionprofil', '');

-- --------------------------------------------------------

--
-- Structure de la table `user_auth`
--

CREATE TABLE IF NOT EXISTS `user_auth` (
  `uid` smallint(40) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `surname` varchar(150) NOT NULL,
  `sexe` char(2) NOT NULL,
  `phone` int(100) NOT NULL,
  `fonction` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `etat` varchar(10) NOT NULL,
  `lastconnect` datetime NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idprofil` int(40) NOT NULL,
  `idbanque` int(40) DEFAULT NULL,
  `idagence` int(40) DEFAULT NULL,
  `droit` varchar(100) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `user_auth`
--

INSERT INTO `user_auth` (`uid`, `pseudo`, `name`, `surname`, `sexe`, `phone`, `fonction`, `email`, `password`, `etat`, `lastconnect`, `created`, `idprofil`, `idbanque`, `idagence`, `droit`, `action`) VALUES
(1, 'popo', 'Viou', 'popo', 'M', 97889678, 'Banquier', 'popo@yahoo.fr', '$2a$10$7f5ee4019c168badbc8e5umX2tWbtWDjHk/o4AE2Ibb7FvmoFiLT6', 'Actif', '2016-02-02 13:03:00', '2015-12-06 16:35:17', 1, 1, 1, 'agence', 'consultation'),
(2, 'Farbian', 'Fabian', 'Alain', 'M', 99778909, 'Directeur', 'alain@yahoo.fr', '$2a$10$a401cec5c674748838d24ufqFCmHatPovKeUJPrSpfHSGI46h1QX.', 'Actif', '2015-12-06 21:40:00', '2015-12-06 21:40:49', 2, 2, 4, 'agence', 'modification'),
(17, 'Gael', 'Gael', 'Amoussouvi', 'M', 69699588, 'Travail', 'gael@yahoo.fr', '$2a$10$db1a01017f53d72861f17ucz1nufv1RLX9H4ZRqMLLJGCZsGdRAsK', 'Actif', '2016-02-05 16:56:00', '2016-01-05 09:17:19', 2, 1, 2, 'banque', 'modification'),
(19, 'Laurant', 'Laurant', 'Soddou', 'M', 98653223, 'Banquier', 'laurant@yahoo.fr', '$2a$10$7d2ce388f2d1f8c585d46OdKcT8udJJqHuoKH3i5Ojmv3E5.zrZ/u', 'Actif', '2016-01-08 12:17:00', '2016-01-08 11:17:58', 1, 1, 1, 'agence', 'consultation'),
(21, 'Brice', 'Brice', 'Noukpo', 'M', 98653322, 'brice@yahoo.fr', 'brice@yahoo.fr', '$2a$10$5dbcb7730a3020fe61903OUXipKTcKn21bZRcGFS22O3LH1yLmrvy', 'Actif', '2016-01-27 12:08:00', '2016-01-08 11:29:07', 2, 4, 7, 'agence', 'modification'),
(22, 'Aldo', 'Dossou', 'Romuald', 'M', 13456, 'Professeur', 'aldo@yahoo.fr', '$2a$10$5d5ae24af1f6ffa123735u.vp9zinSotFqBJQnbtvFaHc.bNQg0E6', 'Actif', '2016-02-05 12:40:00', '2016-02-01 12:27:01', 1, 3, 6, 'banque', 'modification'),
(23, 'Pelagie', 'Mondou', 'Pelagie', 'M', 96993612, 'Professeur', 'pepe@yahoo.fr', '$2a$10$f8ba0a30bfa3daf13790euNCRlK45fyhckr4REnAOBJ.iD0KHrWCG', 'Actif', '2016-02-05 10:06:00', '2016-02-02 09:06:47', 2, 3, 5, 'agence', 'modification'),
(24, 'Paul', 'PREGO', 'Paul', 'M', 96365489, 'Comptable', 'donne@yahoo.fr', '$2a$10$4524f36b7594273d5e1dbO520FFUdAyri2HB4RzCHrLmZdsHs/0oG', 'Actif', '2016-02-05 11:52:00', '2016-02-02 09:11:11', 3, 1, 1, 'agence', 'modification'),
(25, 'Control', 'Control', 'Control1', 'M', 98563212, 'Magasinier', 'donne1@yahoo.fr', 'sahgescredit', 'Actif', '2016-02-02 10:13:00', '2016-02-02 09:13:04', 2, 1, 1, 'banque', 'modification'),
(29, 'Coordina', 'Boom', 'Boom23', 'M', 32659812, 'Prof', 'prof1@yahoo.fr', 'sahgescredit', 'Actif', '2016-02-02 10:33:00', '2016-02-02 09:33:34', 1, 4, 8, 'banque', 'modification');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
