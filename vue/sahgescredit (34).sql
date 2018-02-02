-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 31 Mars 2016 à 22:09
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
  `ville` varchar(100) DEFAULT NULL,
  `iduser` int(40) NOT NULL,
  PRIMARY KEY (`idagence`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `agence`
--

INSERT INTO `agence` (`idagence`, `idbanque`, `libelle`, `ville`, `iduser`) VALUES
(19, 28, 'AGENCE KINDONOU', 'COTONOU', 0),
(20, 28, 'AGENCE FIDJROSSE', 'COTONOU', 0),
(21, 28, 'AGENCE HABITAT', 'COTONOU', 0),
(22, 28, 'AGENCE AKPAKPA', 'COTONOU', 0),
(23, 28, 'AGENCE PRINCIPALE', 'COTONOU', 0),
(24, 28, 'AGENCE PORTO-NOVO', 'PORTO-NOVO', 0),
(25, 28, 'AGENCE SAINT MICHEL', 'COTONOU', 0),
(26, 28, 'AGENCE CALAVI', 'CALAVI', 0),
(27, 28, 'AGENCE PARAKOU', 'PARAKOU', 0),
(28, 28, 'AGENCE GANHI', 'COTONOU', 0),
(29, 28, 'AGENCE BOHICON', 'BOHICON', 0),
(30, 28, 'AGENCE PK10/HOUDEGBE', 'COTONOU', 0),
(31, 28, 'AGENCE COCOTIER', 'COTONOU', 0),
(32, 28, 'AGENCE PORT SOLEN', 'COTONOU', 0),
(33, 28, 'AGENCE SAINTE RITA', 'COTONOU', 0),
(34, 28, 'AGENCE HABITAT', 'COTONOU', 0),
(35, 28, 'AGENCE STEIMETZ', 'COTONOU', 0),
(36, 28, 'AGENCE VEDOKO', 'COTONOU', 0),
(37, 28, 'AGENCE MIVO', 'COTONOU', 0),
(38, 28, 'AGENCE MISSEBO', 'COTONOU', 0),
(39, 28, 'AGENCE KRAKE', 'SEME', 0),
(40, 28, 'AGENCE UNAFRICA', 'COTONOU', 0);

-- --------------------------------------------------------

--
-- Structure de la table `banque`
--

CREATE TABLE IF NOT EXISTS `banque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `etat` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Contenu de la table `banque`
--

INSERT INTO `banque` (`id`, `libelle`, `logo`, `etat`) VALUES
(1, 'ORABANK', 'Banque93ce4a25037bbe03815035c14b9f83e5.jpg', 'Inactif'),
(2, 'BIBE', 'Banque21301993db4fc77f4893c66dbdeddbe6.jpg', 'Inactif'),
(3, 'Ecobank', 'Banque78fed9c67de14f5cad1761477900037b.jpg', 'Inactif'),
(13, 'BGFI', 'Banquee55bb64c5b2b35874018ccfb283def81.jpg', 'Inactif'),
(14, 'Banque Atlantique', 'Banquec23c2006d6982bad2bd8274198645f61.png', 'Inactif'),
(19, 'BOA', 'Banqueb466bb9bb5afa758a5f9036467672bd4.jpg', 'Inactif'),
(21, 'Société Générale', 'Banquef8c9b4adca3d6d75fc679dd97e3b852c.jpg', 'Inactif'),
(22, 'BHB', 'Banque6da6cbad3a7227d03175c2837feaa04e.jpg', 'Inactif'),
(24, 'BANQUE HABIBAT', 'Banquec039a3f1fbe1be05f7072a5133510f2c.jpg', 'Inactif'),
(25, 'BSIC', 'Banquef02821ea7c0811090fd518e2bb4ab264.jpg', 'Inactif'),
(28, 'DIAMOND BANK SA', 'Banque1208b2bb6af6797a4e0009f1e167354b.jpg', 'Actif');

--
-- Déclencheurs `banque`
--
DROP TRIGGER IF EXISTS `maj_parametres_banque`;
DELIMITER //
CREATE TRIGGER `maj_parametres_banque` AFTER INSERT ON `banque`
 FOR EACH ROW begin

insert into parametres (idbanque) values (new.id);
insert into typepret (idbanque) values (new.id);

end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `coassureur`
--

CREATE TABLE IF NOT EXISTS `coassureur` (
  `idcoass` int(4) NOT NULL AUTO_INCREMENT,
  `nomcoassureur` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `part` int(4) NOT NULL,
  `etat` tinyint(1) NOT NULL,
  `estAperiteur` int(40) DEFAULT NULL,
  PRIMARY KEY (`idcoass`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `coassureur`
--

INSERT INTO `coassureur` (`idcoass`, `nomcoassureur`, `logo`, `part`, `etat`, `estAperiteur`) VALUES
(6, 'L''AFRICAINE VIE', 'Coassureurde89740e075170963930eb41436eb402.jpg', 19, 0, 0),
(7, 'SUNU ASSURANCES VIE', 'Coassureur9adca04fa0ee990c17763ee81b450169.jpg', 19, 0, 0),
(8, 'ARGG', 'Coassureurd4967baac36192bdc2e4a5ff6369a05c.png', 19, 0, 0),
(9, 'SAHAM ASSURANCE VIE', 'Coassureurf3df1e9ee76c2317189d0e4c22778520.jpg', 24, 0, 1),
(10, 'NSIA VIE', 'Coassureur63fcc1f779765e2437b6c59386f3fa52.jpg', 19, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE IF NOT EXISTS `contrat` (
  `idcontrat` int(40) NOT NULL AUTO_INCREMENT,
  `numcontrat` varchar(100) CHARACTER SET utf8 NOT NULL,
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
  `primedeces` double DEFAULT NULL,
  `typeremb` int(40) DEFAULT NULL,
  `primeperte` int(11) DEFAULT NULL,
  `totalesupprime` int(11) DEFAULT '1',
  `montantsupprime` int(40) DEFAULT NULL,
  `niveau` int(40) DEFAULT '3',
  `accessoires` int(11) DEFAULT NULL,
  `iduser` int(40) DEFAULT NULL,
  `referencecredit` varchar(100) DEFAULT NULL,
  `idtypepret` int(40) DEFAULT NULL,
  `codeagence` int(40) DEFAULT NULL,
  `estpaye` varchar(5) DEFAULT NULL,
  `datepaiement` datetime DEFAULT NULL,
  `estenvoye` varchar(5) DEFAULT NULL,
  `dateenvoi` datetime DEFAULT NULL,
  `montantpaye` int(40) DEFAULT NULL,
  `bordereauxcom` varchar(25) DEFAULT NULL,
  `save` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`idcontrat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=125 ;

--
-- Contenu de la table `contrat`
--

INSERT INTO `contrat` (`idcontrat`, `numcontrat`, `numeropret`, `status`, `idbanque`, `banquelibelle`, `idagence`, `libelleagence`, `nom`, `prenom`, `datenaissance`, `sexe`, `profession`, `capital`, `dateeffet`, `duree`, `dateecheance`, `tauxemprunt`, `reglementprime`, `periodicite`, `differe`, `perteemploi`, `remboursement`, `tauxprimes`, `primeassurance`, `primedeces`, `typeremb`, `primeperte`, `totalesupprime`, `montantsupprime`, `niveau`, `accessoires`, `iduser`, `referencecredit`, `idtypepret`, `codeagence`, `estpaye`, `datepaiement`, `estenvoye`, `dateenvoi`, `montantpaye`, `bordereauxcom`, `save`, `created`) VALUES
(88, '0694052754334', 'SAHBEN2016/1', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'Gerard', 'Bruno', '1970-01-01', 'M', 'Professeur', 200000, '2016-10-30', '5', '0000-00-00', 5, 'UNIQUE', 'mensuelle', 5, 'non', 'A TERME', 0, 51746, 46746, NULL, 0, NULL, NULL, 4, 5000, 17, '002MTB7063310993', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0000-00-00 00:00:00'),
(89, '0876786227585', 'SAHBEN2016/2', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'SARDOU', 'Michel', '1970-01-01', 'M', 'Avocat', 300000, '2016-06-30', '6', '2016-08-23', 10, 'UNIQUE', 'mensuelle', 10, 'oui', 'PERIODIQUE', 5.89, 73812979, 48438, NULL, 73762541, NULL, NULL, 10, 2000, 17, '002MTB6133710994', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0000-00-00 00:00:00'),
(90, '0340518029192', 'SAHBEN2016/3', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'Viou', 'Elisabeth', '1970-01-01', 'F', 'Amazone', 700001, '2016-07-30', '5', '2016-08-01', 2, 'UNIQUE', 'trimestrielle', 0, 'non', 'A TERME', 0.01, 10311, 3219, NULL, 0, 65, NULL, 8, 5000, 17, '002MTB3197510995', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7@OUI@40|5@OUI@25|', '0000-00-00 00:00:00'),
(91, '0562107277792', 'SAHBEN2016/4', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'AMOUSSOU', 'Elie', '1970-01-20', 'M', 'Biologiste', 130000, '2016-05-30', '3', '2016-03-02', 2, 'UNIQUE', 'trimestrielle', 0, 'non', 'A TERME', 0.01, 5477, 1932, NULL, 0, 80, NULL, 4, 2000, 17, '002MTB5656410996', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8@OUI@10|7@OUI@40|6@OUI@30|', '0000-00-00 00:00:00'),
(92, '814152037058', 'SAHBEN2016/5', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'Judith', 'BOSSOU', '1966-02-02', 'F', 'Comptable', 300000, '2016-10-30', '5', '2014-07-02', 5, 'UNIQUE', 'mensuelle', 0, 'non', 'A TERME', 0.02, 7067, 1253, NULL, 0, 65, 814, 4, 5000, 17, '002MTB3124210997', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8@OUI@10|5@OUI@25|6@OUI@30|', '0000-00-00 00:00:00'),
(93, '478204095666', 'SAHBEN2016/6', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'AGBELESSESY', 'TOUSSAIN', '1985-11-01', 'M', 'Biologiste', 200000, '2016-03-30', '5', '2016-07-02', 5, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.03, 5329, 161, NULL, 0, 105, 169, 4, 5000, 17, '002MTB4541110998', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5@OUI@25|8@OUI@10|6@OUI@30|7@OUI@40|', '0000-00-00 00:00:00'),
(94, 'BEN/SAHAM/TOHOU', 'SAHBEN2016/7', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'TOHOU', 'ROSINE', '1978-02-02', 'Ma', 'COMMERCANTE', 1000000, '2016-03-30', '5', '2016-08-11', 2, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.01, 7158, 1053, NULL, 0, 105, 1105, 5, 5000, 17, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5@OUI@25|6@OUI@30|8@OUI@10|7@OUI@40|', '0000-00-00 00:00:00'),
(95, '909858482987', 'SAHBEN2016/8', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'BANKOLE', 'EMILIE', '1987-03-02', 'M', 'IT', 300000, '2016-03-14', '5', '2016-08-14', 5, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.02, 5509, 248, NULL, 0, 105, 261, 2, 5000, 17, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5@OUI@25|6@OUI@30|7@OUI@40|8@OUI@10|', '0000-00-00 00:00:00'),
(96, 'BEN/SAHAM/Karl', 'SAHBEN2016/9', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'Karl', 'Marx', '1988-03-20', 'Fe', 'IO', 1200000, '2016-03-16', '2', '2016-05-16', 5, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.22, 2625, 368, NULL, 0, 70, 257, 1, 2000, 17, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6@OUI@30|7@OUI@40|', '0000-00-00 00:00:00'),
(97, 'BBVFUO14', 'SAHBEN2016/10', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'PATRIC', 'GAGNON', '1976-02-22', 'M', 'IT', 1200000, '2016-03-21', '5', '2016-08-21', 3, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.59, 7037, 1509, NULL, 0, 35, 528, 1, 5000, 17, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5@OUI@25|8@OUI@10|', '0000-00-00 00:00:00'),
(98, 'PLOO', 'SAHBEN2016/11', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'TALON', 'Patrice', '1978-02-02', 'M', 'IT', 300000, '2016-03-21', '5', '2016-08-21', 5, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.85, 2539, 317, NULL, 0, 70, 222, 1, 2000, 17, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6@OUI@30|7@OUI@40|', '0000-00-00 00:00:00'),
(99, '0584755', 'SAHBEN2016/12', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'AZATA', 'MARTIAL', '1980-01-01', 'M', 'COMMERCANT', 1000000, '2016-03-21', '12', '2017-03-21', 10, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.56, 5601, 2323, NULL, 0, 0, 1278, 1, 2000, 17, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0000-00-00 00:00:00'),
(100, '0854547454', 'SAHBEN2016/13', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'GBAMAN', 'PYREX', '1980-10-10', 'M', 'COMMERCANT', 1000000, '2016-03-21', '60', '2021-03-21', 12, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 2.29, 22852, 11915, NULL, 0, 75, 8937, 1, 2000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5@OUI@25|7@OUI@40|8@OUI@10|', '0000-00-00 00:00:00'),
(101, '0132928074781', 'SAHBEN2016/14', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'YAYI', 'BONI', '1957-01-01', 'M', 'PRESIDENT', 600000, '2016-03-21', '60', '2021-03-21', 10, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 7.7, 115447, 66734, NULL, 0, 70, 46713, 1, 2000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6@OUI@30|7@OUI@40|', '0000-00-00 00:00:00'),
(102, '159183402322', 'SAHBEN2016/14', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'TALON', 'PATRICE', '1985-01-01', 'M', 'macon', 162000, '2016-03-21', '12', '2017-03-21', 10, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.28, 42301, 29112, NULL, 0, 35, 10189, 1, 3000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5@OUI@25|8@OUI@10|', '0000-00-00 00:00:00'),
(104, '0212159557476', 'SAHBEN2016/16', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'TOHOU', 'Denis', '1987-02-03', 'M', 'IT', 215000, '2016-03-22', '5', '2016-08-22', 2, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.27, 3257, 931, NULL, 0, 35, 326, 1, 2000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5@OUI@25|8@OUI@10|', '0000-00-00 00:00:00'),
(105, '154872552', 'SAHBEN2016/17', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'DJOSSOU', 'MICHEL', '1980-01-01', 'M', 'ASSUREUR', 15000000, '2016-03-22', '12', '2017-03-22', 10, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.36, 53530, 34848, NULL, 0, 45, 15682, 1, 3000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5@OUI@25|10@OUI@20|', '0000-00-00 00:00:00'),
(106, '52100', 'SAHBEN2016/18', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'FATOU', 'DIALLO', '1980-01-01', 'M', 'COMMERCANT', 15000000, '2016-03-22', '12', '2017-03-22', 10, 'UNIQUE', 'mensuelle', 0, 'oui', 'A TERME', 1.24, 185800, 63412, NULL, 44118, 70, 75271, 1, 3000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6@OUI@30|7@OUI@40|', '0000-00-00 00:00:00'),
(109, '2025896', 'SAHBEN2016/21', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'GANDAHO', 'Mefia', '1987-02-02', 'Fe', NULL, 120000, '2016-03-22', '2', '2016-05-22', 2, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.89, 1071, 37, NULL, 0, 90, 34, 3, 1000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6@OUI@30|7@OUI@40|11@OUI@20|', '0000-00-00 00:00:00'),
(110, '0202002', 'SAHBEN2016/22', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'DOHOU', 'Denis', '1985-02-02', 'M', NULL, 1200000, '2016-03-23', '3', '2016-06-23', 2, 'UNIQUE', 'trimestrielle', 0, 'oui', 'A TERME', 0.43, 5107, 1059, NULL, 882, 60, 1165, 3, 2000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7@OUI@40|11@OUI@20|', '0000-00-00 00:00:00'),
(111, '0541155', 'SAHBEN2016/23', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'FATOU', 'KAMAL', '1975-01-01', 'M', 'COMMERCANTE', 9000000, '2016-03-24', '60', '2021-05-24', 10, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 2.49, 224351, 142807, NULL, 0, 55, 78544, 3, 3000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5@OUI@25|6@OUI@30|', '0000-00-00 00:00:00'),
(112, '0101001520501510000', 'SAHBEN2016/23', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'KOKOUI', 'PARFAIT', '1980-01-01', 'M', NULL, 2180000, '2016-03-24', '12', '2017-05-24', 10, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.79, 17194, 5065, NULL, 0, 200, 10129, 4, 2000, 17, '010MTB1160740001', 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19@OUI@25|18@OUI@75|17@OUI@75|22@OUI@25|', '0000-00-00 00:00:00'),
(116, '1.0130152001836E+17', 'SAHAM2016/26', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'BONI', 'Christophe', '1985-02-02', 'M', NULL, 4158000, '2016-03-24', '5', '2016-10-24', 1.5, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.18, 7483, 3322, NULL, 0, 50, 1661, 4, 2500, 17, '013MTB1160680002', 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16@OUI@50|', '0000-00-00 00:00:00'),
(115, '0101301520651479043', 'SAHBEN2016/25', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'SOSSOU', 'Baudelaire', '1980-02-02', 'M', NULL, 1360000, '2016-03-24', '5', '2016-10-24', 5, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.33, 4484, 1307, NULL, 0, 90, 1177, 4, 2000, 17, '013MTB1160760003', 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6@OUI@30|7@OUI@40|11@OUI@20|', '0000-00-00 00:00:00'),
(117, '1.0130152065481E+17', 'SAHBEN2016/27', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'AHOUNA', 'CYRILLE', '1957-01-01', 'M', 'DOCTEUR', 3025000, '2016-03-24', '60', '2021-05-24', 2, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 6.78, 205198, 126686, NULL, 0, 60, 76012, 8, 2500, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11@OUI@20|7@OUI@40|', '0000-00-00 00:00:00'),
(118, '0101701510901974027', 'SAHAM2016/28', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'LUMUMBA', 'PATRICE', '1960-11-05', 'M', NULL, 2681090, '2016-03-24', '12', '2017-05-24', 10, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 1.25, 33579, 18576, NULL, 0, 70, 13003, 4, 2000, 17, '017STB1160740004', 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6@OUI@30|7@OUI@40|', '0000-00-00 00:00:00'),
(119, '514548745555', 'SAHBEN2016/29', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'AYIMONTCHE', 'ACHILLE', '1987-05-01', 'M', 'ACTUAIRE', 5000000, '2016-03-26', '60', '2021-05-26', 10, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 1.85, 92324, 45807, NULL, 0, 95, 43517, 3, 3000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5@OUI@25|6@OUI@30|7@OUI@40|', '0000-00-00 00:00:00'),
(120, '05555485545', 'SAHBEN2016/30', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'TOTIN', 'FRITZ', '1984-07-11', 'M', 'ACTUAIRE', 5000000, '2016-03-26', '60', '2021-05-26', 10, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 1.59, 79641, 49446, NULL, 0, 55, 27195, 3, 3000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5@OUI@25|6@OUI@30|', '0000-00-00 00:00:00'),
(121, '58475411225545', 'SAHBEN2016/31', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'DOSSOU', 'SERGE', '1987-01-01', 'M', 'COMMERCANT', 5000000, '2016-03-26', '60', '2021-05-26', 10, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 2.58, 128969, 45807, NULL, 0, 175, 80162, 3, 3000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12@OUI@25|14@OUI@50|13@OUI@100|', '0000-00-00 00:00:00'),
(122, '2020505', 'SAHBEN2016/32', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'Hermane', 'Norbert', '1987-02-02', 'M', NULL, 5000000, '2016-03-27', '5', '2016-10-27', 3, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 0.42, 21050, 3886, NULL, 3334, 150, 10830, 3, 3000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19@OUI@25|20@OUI@50|21@OUI@50|22@OUI@25|', '0000-00-00 00:00:00'),
(123, '2001555545454', 'SAHBEN2016/33', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'SESSOU', 'SOPHIE', '1987-05-14', 'M', 'SOCIAL MANAGER', 6000000, '2016-03-28', '36', '2019-05-28', 5, 'UNIQUE', 'mensuelle', 0, 'non', 'PERIODIQUE', 1.25, 75165, 32073, NULL, 0, 125, 40092, 10, 3000, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12@OUI@25|14@OUI@50|15@OUI@50|', '0000-00-00 00:00:00'),
(124, '5829101100000', 'SAHBEN2016/34', 'SOUSCRIPTION', 28, NULL, 19, NULL, 'GBAMMAN', 'PYREX', '1980-05-01', 'F', NULL, 5000000, '2016-03-31', '24', '2018-05-31', 10, 'UNIQUE', 'mensuelle', 0, 'oui', 'PERIODIQUE', 0.76, 37867, 22739, NULL, 12628, 0, 0, 3, 2500, 17, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0000-00-00 00:00:00');

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
-- Structure de la table `etatcontrat`
--

CREATE TABLE IF NOT EXISTS `etatcontrat` (
  `idetat` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`idetat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `etatcontrat`
--

INSERT INTO `etatcontrat` (`idetat`, `libelle`) VALUES
(1, 'REJET'),
(2, 'ALERTE'),
(3, 'PROPOSITION'),
(4, 'VALIDE'),
(5, 'PAYE'),
(6, 'TERME'),
(7, 'REMBOURSE'),
(8, 'DECES'),
(9, 'INVALIDITE'),
(10, 'PERTE EMPLOI');

-- --------------------------------------------------------

--
-- Structure de la table `groupeutilisateur`
--

CREATE TABLE IF NOT EXISTS `groupeutilisateur` (
  `idgroup` int(40) NOT NULL AUTO_INCREMENT,
  `idsousmenu` int(40) NOT NULL,
  `idnomgroupe` int(40) DEFAULT NULL,
  `actionMenue` varchar(200) DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idgroup`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=437 ;

--
-- Contenu de la table `groupeutilisateur`
--

INSERT INTO `groupeutilisateur` (`idgroup`, `idsousmenu`, `idnomgroupe`, `actionMenue`, `etat`) VALUES
(416, 51, 35, 'consultation', 0),
(415, 50, 35, 'ecriture', 1),
(45, 31, 2, 'modification', 1),
(46, 35, 2, 'ecriture', 1),
(47, 3, 2, 'ecriture', 1),
(49, 1, 2, 'ecriture', 1),
(414, 49, 35, 'consultation', 0),
(109, 41, 2, 'modification', 1),
(413, 48, 35, 'consultation', 0),
(412, 47, 35, 'consultation', 1),
(123, 42, 2, 'modification', 1),
(411, 46, 35, 'consultation', 0),
(137, 43, 2, 'ecriture', 1),
(165, 45, 2, 'ecriture', 1),
(410, 45, 35, 'consultation', 0),
(409, 43, 35, 'consultation', 0),
(189, 46, 2, 'ecriture', 1),
(408, 42, 35, 'consultation', 0),
(204, 47, 2, 'modification', 1),
(407, 41, 35, 'consultation', 0),
(219, 48, 2, 'ecriture', 1),
(406, 35, 35, 'consultation', 0),
(234, 49, 2, 'ecriture', 1),
(263, 50, 2, 'ecriture', 1),
(405, 31, 35, 'consultation', 0),
(277, 51, 2, 'ecriture', 1),
(420, 1, 36, 'consultation', 0),
(323, 52, 2, 'consultation', 1),
(403, 3, 35, 'ecriture', 1),
(354, 53, 2, 'consultation', 1),
(436, 54, 36, 'consultation', 0),
(435, 53, 36, 'consultation', 0),
(434, 52, 36, 'consultation', 0),
(433, 51, 36, 'consultation', 0),
(432, 50, 36, 'consultation', 1),
(431, 49, 36, 'consultation', 1),
(430, 48, 36, 'consultation', 1),
(429, 47, 36, 'consultation', 1),
(428, 46, 36, 'consultation', 1),
(427, 45, 36, 'consultation', 0),
(426, 43, 36, 'consultation', 0),
(425, 42, 36, 'consultation', 0),
(424, 41, 36, 'consultation', 0),
(423, 35, 36, 'consultation', 0),
(422, 31, 36, 'consultation', 0),
(421, 3, 36, 'consultation', 1),
(419, 54, 35, 'consultation', 0),
(402, 1, 35, 'consultation', 0),
(387, 54, 2, 'consultation', 1),
(418, 53, 35, 'consultation', 0),
(417, 52, 35, 'consultation', 0);

-- --------------------------------------------------------

--
-- Structure de la table `imports`
--

CREATE TABLE IF NOT EXISTS `imports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `prix` int(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `imports`
--

INSERT INTO `imports` (`id`, `nom`, `prenom`, `prix`) VALUES
(1, 'SOSSOU', 'HELENE', 12000),
(2, 'DANSOU', 'Gergerges', 2300),
(3, 'Comlan', 'Narcisse', 1500),
(4, 'TOTIN', 'Fritz', 15000),
(5, 'GBAMMAN', 'Pyrex', 201500),
(6, 'SOSSOU', 'HELENE', 12000),
(7, 'DANSOU', 'Gergerges', 2300),
(8, 'Comlan', 'Narcisse', 1500),
(9, 'TOTIN', 'Fritz', 15000),
(10, 'GBAMMAN', 'Pyrex', 201500);

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `idmenue` int(40) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  PRIMARY KEY (`idmenue`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `menus`
--

INSERT INTO `menus` (`idmenue`, `libelle`, `icon`) VALUES
(1, 'Administration', 'fa fa-gears'),
(2, 'Souscription', 'fa fa-pencil-square-o'),
(3, 'Parametres', 'fa fa-sliders'),
(17, 'Accueil', 'fa fa-windows'),
(18, 'Importation', 'gi gi-inbox_in'),
(19, 'Sinistre', 'fa fa-ambulance'),
(20, 'Aide', 'fa fa-anchor');

-- --------------------------------------------------------

--
-- Structure de la table `nomprofil`
--

CREATE TABLE IF NOT EXISTS `nomprofil` (
  `idnomgroup` int(40) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `chemin` varchar(200) DEFAULT 'dashbord',
  PRIMARY KEY (`idnomgroup`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `nomprofil`
--

INSERT INTO `nomprofil` (`idnomgroup`, `libelle`, `chemin`) VALUES
(2, 'SUPERADMIN', 'dashbord'),
(36, 'BANCASSURANCE', 'dashbord'),
(35, 'GESTIONNAIRE', 'dashbord');

--
-- Déclencheurs `nomprofil`
--
DROP TRIGGER IF EXISTS `DroitProfil`;
DELIMITER //
CREATE TRIGGER `DroitProfil` AFTER INSERT ON `nomprofil`
 FOR EACH ROW BEGIN
 declare fini integer default 0;
 declare smenu integer;
 declare curseur_sousgroup cursor for SELECT idsousmenu FROM sousmenus;
 declare continue handler for not found set fini=1;

OPEN curseur_sousgroup;
INSERTION: loop
fetch curseur_sousgroup INTO smenu;
if fini=1 then
leave INSERTION;
end if;

INSERT INTO groupeutilisateur (idsousmenu,idnomgroupe,actionMenue) 
VALUES (smenu,new.idnomgroup,'consultation');

end loop INSERTION;
close curseur_sousgroup;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `supprime_profil`;
DELIMITER //
CREATE TRIGGER `supprime_profil` BEFORE DELETE ON `nomprofil`
 FOR EACH ROW BEGIN

delete from groupeutilisateur where idnomgroupe=old.idnomgroup;

end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE IF NOT EXISTS `parametres` (
  `idparam` int(40) NOT NULL AUTO_INCREMENT,
  `idbanque` int(40) DEFAULT NULL,
  `fraisgestion` double DEFAULT '0.001',
  `agemaxi` int(18) NOT NULL,
  `agemini` int(40) NOT NULL,
  `fraisacquisition` double DEFAULT '0.15',
  `capitalmax` int(40) DEFAULT '15000000',
  `idtypepret` int(40) DEFAULT NULL,
  `tauxprime` double DEFAULT '0',
  `commission` double DEFAULT NULL,
  `quotepartaccessoires` double DEFAULT NULL,
  `fraisaperition` double DEFAULT NULL,
  `tauxperteemploi` double DEFAULT '0',
  `accessoires` int(40) DEFAULT '0',
  `primeplanchet` int(40) DEFAULT '2000',
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`idparam`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `parametres`
--

INSERT INTO `parametres` (`idparam`, `idbanque`, `fraisgestion`, `agemaxi`, `agemini`, `fraisacquisition`, `capitalmax`, `idtypepret`, `tauxprime`, `commission`, `quotepartaccessoires`, `fraisaperition`, `tauxperteemploi`, `accessoires`, `primeplanchet`, `date`) VALUES
(16, 28, 0.001, 65, 18, 0.15, 50000000, 11, 0, 0.15, 0, 0.075, 0.002, 2500, 0, '2016-03-31 12:36:58');

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

CREATE TABLE IF NOT EXISTS `piece` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `piece`
--

INSERT INTO `piece` (`id`, `libelle`) VALUES
(1, 'DECLARATION ECRITE PAR LA BANQUE'),
(2, 'ACTE DE NAISSANCE DE L''ASSURE'),
(3, 'ACTE DE NAISSANCE DU BENEFICIAIRE'),
(4, 'ACTE DE DECES'),
(5, 'PIECE D''IDENTITE DE L''ASSURE'),
(6, 'PIECE D''IDENTITE DU BENEFICIAIRE'),
(7, 'TABLEAU D''AMORTISSEMENT'),
(8, 'LETTRE DE LICENCIEMENT AVEC MENTION DU MOTIF'),
(9, 'CONTRAT DE TRAVAIL'),
(10, 'COPIE DU BIA'),
(11, 'DOCUMENTS MEDICAUX ATTESTANT DE L''ETAT D''INVALIDITE');

-- --------------------------------------------------------

--
-- Structure de la table `pieceprestation`
--

CREATE TABLE IF NOT EXISTS `pieceprestation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idprestation` int(11) NOT NULL,
  `idpiece` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=157 ;

--
-- Contenu de la table `pieceprestation`
--

INSERT INTO `pieceprestation` (`id`, `idprestation`, `idpiece`, `etat`) VALUES
(113, 17, 1, 1),
(114, 17, 2, 1),
(115, 17, 3, 0),
(116, 17, 4, 1),
(117, 17, 5, 0),
(118, 17, 6, 0),
(119, 17, 7, 1),
(120, 17, 8, 0),
(121, 17, 9, 0),
(122, 17, 10, 1),
(123, 17, 11, 0),
(124, 18, 1, 1),
(125, 18, 2, 0),
(126, 18, 3, 0),
(127, 18, 4, 0),
(128, 18, 5, 1),
(129, 18, 6, 0),
(130, 18, 7, 1),
(131, 18, 8, 0),
(132, 18, 9, 0),
(133, 18, 10, 1),
(134, 18, 11, 1),
(135, 19, 1, 1),
(136, 19, 2, 0),
(137, 19, 3, 0),
(138, 19, 4, 0),
(139, 19, 5, 1),
(140, 19, 6, 0),
(141, 19, 7, 1),
(142, 19, 8, 1),
(143, 19, 9, 1),
(144, 19, 10, 1),
(145, 19, 11, 0),
(146, 20, 1, 1),
(147, 20, 2, 0),
(148, 20, 3, 0),
(149, 20, 4, 0),
(150, 20, 5, 1),
(151, 20, 6, 0),
(152, 20, 7, 1),
(153, 20, 8, 0),
(154, 20, 9, 0),
(155, 20, 10, 1),
(156, 20, 11, 0);

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

CREATE TABLE IF NOT EXISTS `prestation` (
  `idprestation` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `idetat` int(11) NOT NULL,
  PRIMARY KEY (`idprestation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `prestation`
--

INSERT INTO `prestation` (`idprestation`, `libelle`, `idetat`) VALUES
(17, 'DECES', 8),
(18, 'INVALIDITE ABSOLUE ET DEFINITIVE', 9),
(19, 'PERTE EMPLOI', 10),
(20, 'REMBOURSEMENT ANTICIPE', 7);

--
-- Déclencheurs `prestation`
--
DROP TRIGGER IF EXISTS `AddPieces`;
DELIMITER //
CREATE TRIGGER `AddPieces` AFTER INSERT ON `prestation`
 FOR EACH ROW BEGIN
 declare fini integer default 0;
 declare prespiece integer;
 declare curseur_pieces cursor for SELECT id FROM piece;
 declare continue handler for not found set fini=1;

OPEN curseur_pieces;
INSERTION: loop

fetch curseur_pieces INTO prespiece;

if fini=1 then
leave INSERTION;
end if;

INSERT INTO pieceprestation (idprestation,idpiece) 
VALUES (new.idprestation,prespiece);

end loop INSERTION;
close curseur_pieces;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Deletepiece`;
DELIMITER //
CREATE TRIGGER `Deletepiece` BEFORE DELETE ON `prestation`
 FOR EACH ROW BEGIN

delete from pieceprestation where idprestation=old.idprestation;

end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `idprofil` int(40) NOT NULL AUTO_INCREMENT,
  `idnomgroup` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `chemin` varchar(100) DEFAULT 'dashbord',
  PRIMARY KEY (`idprofil`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `profil`
--

INSERT INTO `profil` (`idprofil`, `idnomgroup`, `libelle`, `chemin`) VALUES
(1, 1, 'Secretaire1', 'listebanque'),
(2, 2, 'Gestionnaire2', 'listedescontrats'),
(3, 3, 'Controleur', 'utilisateurs'),
(8, 3, 'COMMISSION', 'commission');

-- --------------------------------------------------------

--
-- Structure de la table `questions_medicales`
--

CREATE TABLE IF NOT EXISTS `questions_medicales` (
  `idm` int(40) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) DEFAULT NULL,
  `tauxsup` double DEFAULT NULL,
  `etat` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `questions_medicales`
--

INSERT INTO `questions_medicales` (`idm`, `libelle`, `tauxsup`, `etat`) VALUES
(1, 'Souffrez-vous des maux d''yeux?', 0.12, 'Inactif'),
(3, 'De quel mal aviez-vous souffert ces trois dernières années?', 0.13, 'Inactif'),
(4, 'Etes vous fumeur', 15, 'Inactif'),
(8, 'Souffrez vous ou avez vous été atteint de maladie du système nerveux?', 10, 'Inactif'),
(9, 'Souffrez vous ou avez vous été atteint de maladie neuropsychique?', 30, 'Inactif'),
(10, 'Michel est il présent dans les banques?', 20, 'Inactif'),
(12, 'Souffrez vous d''obésité ?', 25, 'Actif'),
(13, 'Avez vous souffert ou souffrez vous de problèmes cardio-vasculaires, AVC ou crise cardiaque ?', 100, 'Actif'),
(14, 'Souffrez vous hypertension artérielle ?', 50, 'Actif'),
(15, 'Souffrez vous de maladie broncho-pulmonaire (Tuberculose, Emphysème ou autres) ?', 50, 'Actif'),
(16, 'Souffrez vous d''Hépatite A ?', 50, 'Actif'),
(17, 'Souffrez vous d''Hépatite B ou C', 75, 'Actif'),
(18, 'Souffrez vous de diabète ?', 75, 'Actif'),
(19, 'Souffrez vous d''asthme ou d''autres allergies ?', 25, 'Actif'),
(20, 'Souffrez vous de maladie du sang (Drépanocytose AS, SC, FC ou anémie) ?', 50, 'Actif'),
(21, 'Souffrez vous d''hypercholestérolémie, goutte ou goitre ?', 50, 'Actif'),
(22, 'Souffrez vous de maladies utérines (Fibromes ou autres) ou ovariennes ?', 25, 'Actif');

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE IF NOT EXISTS `reglement` (
  `idregle` int(40) NOT NULL AUTO_INCREMENT,
  `referencecredit` varchar(20) DEFAULT NULL,
  `referencevirement` varchar(20) DEFAULT NULL,
  `numcomptedebite` varchar(20) DEFAULT NULL,
  `dateoperation` date DEFAULT NULL,
  `datevaleur` date DEFAULT NULL,
  `montantcredite` int(40) DEFAULT NULL,
  PRIMARY KEY (`idregle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `reglement`
--

INSERT INTO `reglement` (`idregle`, `referencecredit`, `referencevirement`, `numcomptedebite`, `dateoperation`, `datevaleur`, `montantcredite`) VALUES
(1, '002MTB5396710001', '0378024689056', '0378024689056', '1992-01-01', '1992-01-01', 50000),
(2, '002MTB4173310002', '0434814092025', '0434814092025', '1983-01-01', '1983-01-01', 185000),
(3, '002MTB9829410003', '0768512925934', '0768512925934', '1959-01-01', '1959-01-01', 550000),
(4, '002MTB9165610004', '0932042153865', '0932042153865', '1966-01-01', '1966-01-01', 20000),
(5, '002MTB4885010005', '0189714331918', '0189714331918', '1960-11-05', '1960-11-05', 1000000),
(6, '002MTB2525710006', '0391520984120', '0391520984120', '1960-12-26', '1960-12-26', 110000),
(7, '002MTB4674810007', '0917425515983', '0917425515983', '1988-01-01', '1988-01-01', 210000),
(8, '002MTB7861110008', '0907123163061', '0907123163061', '1959-01-01', '1959-01-01', 425000),
(9, '002MTB6914110009', '0500606519454', '0500606519454', '1984-12-24', '1984-12-24', 100000),
(10, '002MTB6305810010', '0848086274387', '0848086274387', '1964-12-19', '1964-12-19', 600000),
(11, '002MTB4652810011', '0193954778709', '0193954778709', '1981-02-26', '1981-02-26', 250000),
(12, '002MTB5756110012', '0924493294976', '0924493294976', '1985-02-10', '1985-02-10', 300000),
(13, '002MTB1313110013', '0415324632380', '0415324632380', '1983-02-03', '1983-02-03', 775000),
(14, '002MTB4291910014', '0677758243769', '0677758243769', '1975-01-01', '1975-01-01', 100000),
(15, '002MTB9750410015', '0896988272650', '0896988272650', '1947-01-01', '1947-01-01', 150000),
(16, '002MTB1484810016', '0345748901108', '0345748901108', '1967-06-09', '1967-06-09', 300000),
(17, '002MTB8760710017', '0132928074781', '0132928074781', '1963-01-01', '1963-01-01', 600000),
(18, '002MTB2141510018', '0159183402322', '0159183402322', '1980-06-27', '1980-06-27', 162000),
(19, '002MTB3126610019', '0212159557476', '0212159557476', '1986-05-07', '1986-05-07', 215000);

-- --------------------------------------------------------

--
-- Structure de la table `sinistre`
--

CREATE TABLE IF NOT EXISTS `sinistre` (
  `idsinistre` int(40) NOT NULL AUTO_INCREMENT,
  `idprestation` int(11) NOT NULL,
  `datedeclaration` date DEFAULT NULL,
  `nomdeclarant` varchar(100) DEFAULT NULL,
  `montantattendu` int(11) DEFAULT NULL,
  `montantregle` int(11) DEFAULT NULL,
  `datereglement` date DEFAULT NULL,
  `numerocontrat` varchar(100) DEFAULT NULL,
  `idbanque` int(40) NOT NULL,
  `idagence` int(40) NOT NULL,
  `assureur_name` varchar(50) DEFAULT NULL,
  `dateeffet` date DEFAULT NULL,
  `dateecheance` date DEFAULT NULL,
  `datesurvenance` date DEFAULT NULL,
  `capital` int(50) NOT NULL,
  `primeassurance` int(50) NOT NULL,
  `identifiant` varchar(40) DEFAULT NULL,
  `pieces` varchar(255) DEFAULT NULL,
  `observations` varchar(255) DEFAULT NULL,
  `datepardefaut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsinistre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `sinistre`
--

INSERT INTO `sinistre` (`idsinistre`, `idprestation`, `datedeclaration`, `nomdeclarant`, `montantattendu`, `montantregle`, `datereglement`, `numerocontrat`, `idbanque`, `idagence`, `assureur_name`, `dateeffet`, `dateecheance`, `datesurvenance`, `capital`, `primeassurance`, `identifiant`, `pieces`, `observations`, `datepardefaut`) VALUES
(1, 17, '2016-03-02', 'Gildas', 200200, 120500, '2015-03-02', 'SAHBEN2016/27', 28, 13, 'CO-ASSURANCE', '2016-03-24', '2021-05-24', '2016-03-25', 3025000, 205198, 'AHOUNA CYRILLE', '', NULL, '2016-03-24 14:48:55'),
(2, 20, '2016-03-02', 'Gildas', 200200, 0, '0000-00-00', 'SAHBEN2016/27', 28, 13, 'CO-ASSURANCE', '2016-03-24', '2021-05-24', '2016-03-25', 3025000, 205198, 'AHOUNA CYRILLE', '10@|5@|', NULL, '2016-03-24 14:48:55'),
(3, 18, '2016-03-30', 'Gael', NULL, NULL, '0000-00-00', 'SAHBEN2016/2', 28, 20, 'CO-ASSURANCE', '2016-06-30', '2016-08-23', '2016-07-24', 300000, 73812979, 'SARDOU Michel', '7@|10@|', NULL, '2016-03-24 14:48:55'),
(4, 17, '2016-03-02', 'Gildas', 200200, 120500, '2015-03-02', 'SAHBEN2016/27', 28, 20, 'CO-ASSURANCE', '2016-03-24', '2021-05-24', '2016-03-25', 3025000, 205198, 'AHOUNA CYRILLE', '7@|4@|2@|', NULL, '2016-03-24 17:55:26'),
(5, 19, '2016-03-30', 'Gael', NULL, NULL, '0000-00-00', 'SAHBEN2016/2', 28, 20, 'CO-ASSURANCE', '2016-06-30', '2016-08-23', '2016-07-24', 300000, 73812979, 'SARDOU Michel', '7@|8@|9@|', NULL, '2016-03-25 11:57:28'),
(6, 19, '2016-03-02', 'Gildas', 200200, 0, '0000-00-00', 'SAHBEN2016/27', 28, 20, 'CO-ASSURANCE', '2016-03-24', '2021-05-24', '2016-03-25', 3025000, 205198, 'AHOUNA CYRILLE', '7@|8@|', NULL, '2016-03-25 12:05:10'),
(7, 18, '2016-03-30', 'Gael', NULL, NULL, '0000-00-00', 'SAHBEN2016/2', 28, 20, 'CO-ASSURANCE', '2016-06-30', '2016-08-23', '2016-07-24', 300000, 73812979, 'SARDOU Michel', '1@|5@|7@|10@|11@|', NULL, '2016-03-28 18:06:52'),
(10, 20, '2016-03-02', 'Gildas', 200200, 0, '0000-00-00', 'SAHBEN2016/27', 28, 13, 'CO-ASSURANCE', '2016-03-24', '2021-05-24', '2016-03-25', 3025000, 205198, 'AHOUNA CYRILLE', '10@|5@|', NULL, '2016-03-29 07:33:53'),
(11, 17, '2015-02-03', 'GADONOU', 50000, 20000, '2016-03-02', 'l12525', 28, 13, 'ARGG', '2015-02-02', '2016-01-23', '2015-04-03', 2000000, 2000, 'Mougrer', '7@|2@|4@|', NULL, '2016-03-29 17:12:53'),
(12, 19, '2016-03-30', 'Gael', NULL, NULL, '0000-00-00', 'SAHBEN2016/2', 28, 13, 'CO-ASSURANCE', '2016-06-30', '2016-08-23', '2016-07-24', 300000, 73812979, 'SARDOU Michel', '9@|8@|7@|', NULL, '2016-03-29 18:03:04'),
(13, 19, '2016-03-30', 'Gael', NULL, NULL, '0000-00-00', 'SAHBEN2016/2', 28, 13, 'CO-ASSURANCE', '2016-06-30', '2016-08-23', '2016-07-24', 300000, 73812979, 'SARDOU Michel', '', NULL, '2016-03-30 09:17:48'),
(14, 17, '2016-03-30', 'Gildas', 500000, 1000000, NULL, 'SAHBEN2016/3', 28, 13, 'CO-ASSURANCE', '2016-07-30', '2016-08-01', '2016-07-31', 700001, 10311, 'Viou Elisabeth', '10@|7@|2@|', NULL, '2016-03-30 10:25:37');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Contenu de la table `sousmenus`
--

INSERT INTO `sousmenus` (`idsousmenu`, `idmenu`, `libelle`, `nomcourt`, `icon`) VALUES
(1, 1, 'Liste des banques', 'listebanque', ''),
(46, 3, 'Gestion des utilisateurs', 'utilisateurs', ''),
(3, 2, 'Gestion des contrats', 'listedescontrats', ''),
(35, 1, 'Etat des menus', 'gestiondesmenus', ''),
(31, 1, 'Gestion de profil', 'gestionprofil', ''),
(41, 3, 'Type Pret', 'typepretpath', ''),
(42, 3, 'Gestion Co-Assureur', 'gestioncoassureur', ''),
(43, 1, 'Paramètres Prime', 'parametrescalculprime', ''),
(45, 1, 'Questionnaire Médical', 'questionsmedicales', ''),
(47, 17, 'Bienvenue', 'dashbord', ''),
(48, 3, 'Gestion des agences', 'gestiondesagences', ''),
(49, 18, 'Importation', 'importation', ''),
(50, 19, 'Sinistre', 'sinistre', ''),
(51, 3, 'Gestion des prestations', 'prestation', ''),
(52, 20, 'Souscription', 'help', ''),
(53, 20, 'Vidéo Sinistre', 'videosinistre', ''),
(54, 20, 'Gestion Banques Tuto', 'gestionbanquesvideos', '');

--
-- Déclencheurs `sousmenus`
--
DROP TRIGGER IF EXISTS `delete_soumenu_profil`;
DELIMITER //
CREATE TRIGGER `delete_soumenu_profil` BEFORE DELETE ON `sousmenus`
 FOR EACH ROW BEGIN

delete from groupeutilisateur where idsousmenu=old.idsousmenu;

end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `maj_groupe_utilisateur`;
DELIMITER //
CREATE TRIGGER `maj_groupe_utilisateur` AFTER INSERT ON `sousmenus`
 FOR EACH ROW BEGIN
 declare fini integer default 0;
 declare profil integer;
 declare curseur_group cursor for SELECT idnomgroup FROM nomprofil;
 declare continue handler for not found set fini=1;

OPEN curseur_group;
INSERTION: loop
fetch curseur_group INTO profil;
INSERT INTO groupeutilisateur (idsousmenu,idnomgroupe,actionMenue) 
VALUES (new.idsousmenu,profil,'consultation');
if fini=1 then
leave INSERTION;
end if;
end loop INSERTION;
close curseur_group;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `synchronisationnum`
--

CREATE TABLE IF NOT EXISTS `synchronisationnum` (
  `id` int(40) NOT NULL AUTO_INCREMENT,
  `contratnum` int(40) NOT NULL DEFAULT '0',
  `profil` int(40) NOT NULL DEFAULT '0',
  `utilisateurs` int(40) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `synchronisationnum`
--

INSERT INTO `synchronisationnum` (`id`, `contratnum`, `profil`, `utilisateurs`) VALUES
(1, 34, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tablemortalite`
--

CREATE TABLE IF NOT EXISTS `tablemortalite` (
  `x` int(4) NOT NULL,
  `lx` int(4) DEFAULT NULL,
  `dx` int(4) DEFAULT NULL,
  `px` decimal(16,5) DEFAULT NULL,
  `qx` decimal(16,5) DEFAULT NULL,
  `d_x` decimal(16,5) DEFAULT NULL,
  `cx` decimal(16,5) DEFAULT NULL,
  `nx` decimal(16,5) DEFAULT NULL,
  `mx` decimal(16,5) DEFAULT NULL,
  `sx` decimal(16,5) DEFAULT NULL,
  `rx` decimal(16,5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tablemortalite`
--

INSERT INTO `tablemortalite` (`x`, `lx`, `dx`, `px`, `qx`, `d_x`, `cx`, `nx`, `mx`, `sx`, `rx`) VALUES
(0, 1000000, 5368, '0.99463', '0.00537', '1000000.00000', '5276.45614', '26565816.05000', '103402.45760', '615047484.40000', '5867165.28700'),
(1, 994632, 726, '0.99927', '0.00073', '960997.10140', '689.48702', '25565816.05000', '98126.00149', '588481668.30000', '5763762.82900'),
(2, 993906, 555, '0.99944', '0.00056', '927821.88620', '509.26298', '24604818.95000', '97436.51447', '562915852.30000', '5665636.82800'),
(3, 993351, 473, '0.99952', '0.00048', '895945.68860', '419.34350', '23676997.06000', '96927.25148', '538311033.40000', '5568200.31400'),
(4, 992878, 404, '0.99959', '0.00041', '865235.81620', '346.05872', '22781051.37000', '96507.90798', '514634036.30000', '5471273.06200'),
(5, 992474, 369, '0.99963', '0.00037', '835636.47680', '305.38974', '21915815.56000', '96161.84927', '491852984.90000', '5374765.15400'),
(6, 992105, 332, '0.99967', '0.00033', '807078.05670', '265.47633', '21080179.08000', '95856.45953', '469937169.40000', '5278603.30500'),
(7, 991773, 313, '0.99968', '0.00032', '779524.61310', '241.81972', '20273101.02000', '95590.98319', '448856990.30000', '5182746.84500'),
(8, 991460, 313, '0.99968', '0.00032', '752926.18150', '233.64224', '19493576.41000', '95349.16347', '428583889.30000', '5087155.86200'),
(9, 991147, 294, '0.99970', '0.00030', '727235.25190', '212.03815', '18740650.23000', '95115.52123', '409090312.90000', '4991806.69900'),
(10, 990853, 312, '0.99969', '0.00031', '702434.33330', '217.41070', '18013414.98000', '94903.48308', '390349662.60000', '4896691.17700'),
(11, 990541, 313, '0.99968', '0.00032', '678466.81220', '210.73192', '17310980.64000', '94686.07238', '372336247.60000', '4801787.69400'),
(12, 990228, 368, '0.99963', '0.00037', '655316.35190', '239.38308', '16632513.83000', '94475.34046', '355025267.00000', '4707101.62200'),
(13, 989860, 438, '0.99956', '0.00044', '632920.59480', '275.28300', '15977197.48000', '94235.95739', '338392753.20000', '4612626.28100'),
(14, 989422, 538, '0.99946', '0.00054', '611246.89450', '326.69855', '15344276.88000', '93960.67439', '322415555.70000', '4518390.32400'),
(15, 988884, 708, '0.99928', '0.00072', '590255.58250', '415.39172', '14733029.99000', '93633.97584', '307071278.80000', '4424429.65000'),
(16, 988176, 897, '0.99909', '0.00091', '569886.94100', '508.48327', '14142774.41000', '93218.58412', '292338248.80000', '4330795.67400'),
(17, 987279, 1113, '0.99887', '0.00113', '550115.59020', '609.59170', '13572887.47000', '92710.10085', '278195474.40000', '4237577.09000'),
(18, 986166, 1318, '0.99866', '0.00134', '530913.45150', '697.45941', '13022771.88000', '92100.50915', '264622586.90000', '4144866.98900'),
(19, 984848, 1466, '0.99851', '0.00149', '512274.29140', '749.54403', '12491858.42000', '91403.04974', '251599815.10000', '4052766.48000'),
(20, 983382, 1552, '0.99842', '0.00158', '494214.24460', '766.68073', '11979584.13000', '90653.50571', '239107956.60000', '3961363.43000'),
(21, 981830, 1603, '0.99837', '0.00163', '476748.07950', '765.09612', '11485369.89000', '89886.82498', '227128372.50000', '3870709.92400'),
(22, 980227, 1631, '0.99834', '0.00166', '459874.11530', '752.13551', '11008621.81000', '89121.72886', '215643002.60000', '3780823.09900'),
(23, 978596, 1653, '0.99831', '0.00169', '443583.50790', '736.50319', '10548747.69000', '88369.59335', '204634380.80000', '3691701.37000'),
(24, 976943, 1681, '0.99828', '0.00172', '427859.15630', '723.65096', '10105164.19000', '87633.09016', '194085633.10000', '3603331.77700'),
(25, 975262, 1710, '0.99825', '0.00175', '412679.17900', '711.24167', '9677305.02900', '86909.43920', '183980468.90000', '3515698.68700'),
(26, 973552, 1752, '0.99820', '0.00180', '398024.73210', '704.06837', '9264625.85000', '86198.19753', '174303163.90000', '3428789.24800'),
(27, 971800, 1796, '0.99815', '0.00185', '383872.89710', '697.34343', '8866601.11800', '85494.12917', '165038538.10000', '3342591.05000'),
(28, 970004, 1838, '0.99811', '0.00189', '370206.23680', '689.51789', '8482728.22100', '84796.78574', '156171936.90000', '3257096.92100'),
(29, 968166, 1885, '0.99805', '0.00195', '357009.42620', '683.23646', '8112521.98400', '84107.26785', '147689208.70000', '3172300.13500'),
(30, 966281, 1927, '0.99801', '0.00199', '344265.05890', '674.84036', '7755512.55800', '83424.03138', '139576686.70000', '3088192.86700'),
(31, 964354, 1964, '0.99796', '0.00204', '331959.91340', '664.53899', '7411247.49900', '82749.19103', '131821174.20000', '3004768.83600'),
(32, 962390, 2028, '0.99789', '0.00211', '320081.00970', '662.98940', '7079287.58600', '82084.65204', '124409926.70000', '2922019.64500'),
(33, 960362, 2118, '0.99779', '0.00221', '308605.33110', '668.99710', '6759206.57600', '81421.66265', '117330639.10000', '2839934.99300'),
(34, 958244, 2244, '0.99766', '0.00234', '297511.81380', '684.82686', '6450601.24500', '80752.66554', '110571432.50000', '2758513.33000'),
(35, 956000, 2368, '0.99752', '0.00248', '286777.87970', '698.23125', '6153089.43100', '80067.83868', '104120831.30000', '2677760.66500'),
(36, 953632, 2516, '0.99736', '0.00264', '276393.75320', '716.78329', '5866311.55100', '79369.60744', '97967741.84000', '2597692.82600'),
(37, 951116, 2671, '0.99719', '0.00281', '266342.54500', '735.20893', '5589917.79800', '78652.82415', '92101430.29000', '2518323.21900'),
(38, 948445, 2849, '0.99700', '0.00300', '256613.12130', '757.68551', '5323575.25300', '77917.61523', '86511512.49000', '2439670.39400'),
(39, 945596, 3057, '0.99677', '0.00323', '247190.61870', '785.50983', '5066962.13200', '77159.92971', '81187937.24000', '2361752.77900'),
(40, 942539, 3296, '0.99650', '0.00350', '238059.40160', '818.28207', '4819771.51300', '76374.41989', '76120975.11000', '2284592.85000'),
(41, 939243, 3584, '0.99618', '0.00382', '229204.75630', '859.69319', '4581712.11200', '75556.13782', '71301203.59000', '2208218.43000'),
(42, 935659, 3877, '0.99586', '0.00414', '220608.83850', '898.52659', '4352507.35500', '74696.44463', '66719491.48000', '2132662.29200'),
(43, 931782, 4194, '0.99550', '0.00450', '212265.43280', '939.12459', '4131898.51700', '73797.91804', '62366984.13000', '2057965.84700'),
(44, 927588, 4523, '0.99512', '0.00488', '204164.26560', '978.54550', '3919633.08400', '72858.79345', '58235085.61000', '1984167.92900'),
(45, 923065, 4866, '0.99473', '0.00527', '196298.30220', '1017.15278', '3715468.81900', '71880.24796', '54315452.53000', '1911309.13600'),
(46, 918199, 5200, '0.99434', '0.00566', '188660.38870', '1050.21225', '3519170.51600', '70863.09518', '50599983.71000', '1839428.88800'),
(47, 912999, 5515, '0.99396', '0.00604', '181248.26650', '1076.16510', '3330510.12800', '69812.88293', '47080813.19000', '1768565.79300'),
(48, 907484, 5815, '0.99359', '0.00641', '174061.28550', '1096.33368', '3149261.86100', '68736.71784', '43750303.06000', '1698752.91000'),
(49, 901669, 6108, '0.99323', '0.00677', '167097.51790', '1112.63243', '2975200.57600', '67640.38416', '40601041.20000', '1630016.19200'),
(50, 895561, 6395, '0.99286', '0.00714', '160353.21910', '1125.51914', '2808103.05800', '66527.75174', '37625840.63000', '1562375.80800'),
(51, 889166, 6704, '0.99246', '0.00754', '153824.32160', '1140.00299', '2647749.83900', '65402.23260', '34817737.57000', '1495848.05600'),
(52, 882462, 7027, '0.99204', '0.00796', '147501.97110', '1154.52034', '2493925.51700', '64262.22960', '32169987.73000', '1430445.82300'),
(53, 875435, 7359, '0.99159', '0.00841', '141379.15020', '1168.18087', '2346423.54600', '63107.70926', '29676062.21000', '1366183.59400'),
(54, 868076, 7711, '0.99112', '0.00888', '135449.95360', '1182.66471', '2205044.39600', '61939.52840', '27329638.67000', '1303075.88400'),
(55, 860365, 8066, '0.99062', '0.00938', '129707.02440', '1195.27767', '2069594.44200', '60756.86368', '25124594.27000', '1241136.35600'),
(56, 852299, 8425, '0.99011', '0.00989', '124145.90260', '1206.25783', '1939887.41800', '59561.58602', '23054999.83000', '1180379.49200'),
(57, 843874, 8941, '0.98940', '0.01060', '118762.04530', '1236.84701', '1815741.51500', '58355.32818', '21115112.41000', '1120817.90600'),
(58, 834933, 9531, '0.98858', '0.01142', '113530.18320', '1273.87850', '1696979.47000', '57118.48118', '19299370.90000', '1062462.57800'),
(59, 825402, 10282, '0.98754', '0.01246', '108438.84400', '1327.78203', '1583449.28700', '55844.60268', '17602391.43000', '1005344.09700'),
(60, 815120, 11026, '0.98647', '0.01353', '103466.69140', '1375.70978', '1475010.44300', '54516.82065', '16018942.14000', '949499.49430'),
(61, 804094, 11913, '0.98518', '0.01482', '98615.56883', '1436.11636', '1371543.75100', '53141.11087', '14543931.70000', '894982.67370'),
(62, 792181, 12791, '0.98385', '0.01615', '93869.11746', '1489.81601', '1272928.18300', '51704.99451', '13172387.95000', '841841.56280'),
(63, 779390, 13653, '0.98248', '0.01752', '89230.39023', '1536.44097', '1179059.06500', '50215.17850', '11899459.76000', '790136.56830'),
(64, 765737, 14647, '0.98087', '0.01913', '84702.69835', '1592.56116', '1089828.67500', '48678.73753', '10720400.70000', '739921.38980'),
(65, 751090, 15611, '0.97922', '0.02078', '80272.95367', '1639.97721', '1005125.97700', '47086.17637', '9630572.02400', '691242.65220'),
(66, 735479, 16578, '0.97746', '0.02254', '75946.39969', '1682.66970', '924853.02290', '45446.19917', '8625446.04700', '644156.47590'),
(67, 718901, 17371, '0.97584', '0.02416', '71724.18988', '1703.53558', '848906.62320', '43763.52947', '7700593.02400', '598710.27670'),
(68, 701530, 18178, '0.97409', '0.02591', '67624.25006', '1722.39255', '777182.43330', '42059.99388', '6851686.40100', '554946.74720'),
(69, 683352, 18989, '0.97221', '0.02779', '63644.42016', '1738.39228', '709558.18320', '40337.60133', '6074503.96800', '512886.75340'),
(70, 664363, 19812, '0.97018', '0.02982', '59783.44700', '1752.40167', '645913.76310', '38599.20906', '5364945.78400', '472549.15200'),
(71, 644551, 20634, '0.96799', '0.03201', '56039.26767', '1763.39017', '586130.31610', '36846.80739', '4719032.02100', '433949.94300'),
(72, 623917, 21427, '0.96566', '0.03434', '52410.90200', '1769.23699', '530091.04840', '35083.41721', '4132901.70500', '397103.13560'),
(73, 602490, 22187, '0.96317', '0.03683', '48899.48757', '1770.03916', '477680.14640', '33314.18023', '3602810.65700', '362019.71840'),
(74, 580303, 22921, '0.96050', '0.03950', '45506.02814', '1766.75977', '428780.65880', '31544.14107', '3125130.51000', '328705.53810'),
(75, 557382, 23642, '0.95758', '0.04242', '42230.54684', '1760.70989', '383274.63070', '29777.38130', '2696349.85200', '297161.39710'),
(76, 533740, 24351, '0.95438', '0.04562', '39071.77731', '1752.18534', '341044.08390', '28016.67141', '2313075.22100', '267384.01580'),
(77, 509389, 25022, '0.95088', '0.04912', '36028.20526', '1739.58202', '301972.30660', '26264.48608', '1972031.13700', '239367.34440'),
(78, 484367, 25672, '0.94700', '0.05300', '33099.94431', '1724.41680', '265944.10130', '24524.90405', '1670058.83000', '213102.85830'),
(79, 458695, 26347, '0.94256', '0.05744', '30285.61328', '1709.91044', '232844.15700', '22800.48725', '1404114.72900', '188577.95420'),
(80, 432348, 27049, '0.93744', '0.06256', '27580.71184', '1696.10625', '202558.54370', '21090.57682', '1171270.57200', '165777.46700'),
(81, 405299, 27722, '0.93160', '0.06840', '24980.84927', '1679.52337', '174977.83190', '19394.47056', '968712.02850', '144686.89010'),
(82, 377577, 28260, '0.92515', '0.07485', '22485.20485', '1654.22012', '149996.98260', '17714.94719', '793734.19660', '125292.41960'),
(83, 349317, 28556, '0.91825', '0.08175', '20098.82593', '1615.02097', '127511.77770', '16060.72707', '643737.21400', '107577.47240'),
(84, 320761, 28543, '0.91101', '0.08899', '17831.67648', '1559.69637', '107412.95180', '14445.70610', '516225.43630', '91516.74532'),
(85, 292218, 28248, '0.90333', '0.09667', '15695.57504', '1491.37822', '89581.27533', '12886.00974', '408812.48450', '77071.03922'),
(86, 263970, 27685, '0.89512', '0.10488', '13698.86199', '1412.22622', '73885.70029', '11394.63151', '319231.20910', '64185.02948'),
(87, 236285, 26840, '0.88641', '0.11359', '11847.47280', '1322.82351', '60186.83831', '9982.40529', '245345.50880', '52790.39796'),
(88, 209445, 25718, '0.87721', '0.12279', '10146.56905', '1224.66198', '48339.36551', '8659.58178', '185158.67050', '42807.99267'),
(89, 183727, 24318, '0.86764', '0.13236', '8599.67131', '1118.83630', '38192.79645', '7434.91980', '136819.30500', '34148.41089'),
(90, 159409, 22676, '0.85775', '0.14225', '7209.10508', '1008.00989', '29593.12515', '6316.08351', '98626.50857', '26713.49108'),
(91, 136733, 21960, '0.83940', '0.16060', '5974.49926', '943.17076', '22384.02007', '5308.07362', '69033.38342', '20397.40758'),
(92, 114773, 21943, '0.80881', '0.19119', '4845.37677', '910.57065', '16409.52081', '4364.90286', '46649.36335', '15089.33396'),
(93, 92830, 21051, '0.77323', '0.22677', '3786.48133', '844.01473', '11564.14404', '3454.33221', '30239.84254', '10724.43110'),
(94, 71779, 19222, '0.73221', '0.26779', '2828.81485', '744.62141', '7777.66271', '2610.31748', '18675.69850', '7270.09890'),
(95, 52557, 16535, '0.68539', '0.31461', '2001.23153', '618.87194', '4948.84786', '1865.69607', '10898.03579', '4659.78142'),
(96, 36022, 13233, '0.63264', '0.36736', '1325.23910', '478.53594', '2947.61633', '1246.82413', '5949.18793', '2794.08535'),
(97, 22789, 9706, '0.57409', '0.42591', '810.04909', '339.12217', '1622.37723', '768.28819', '3001.57160', '1547.26122'),
(98, 13083, 6405, '0.51043', '0.48957', '449.31722', '216.21941', '812.32814', '429.16602', '1379.19437', '778.97303'),
(99, 6678, 3723, '0.44250', '0.55750', '221.59083', '121.43063', '363.01092', '212.94661', '566.86623', '349.80701'),
(100, 2955, 1855, '0.37225', '0.62775', '94.73763', '58.45730', '141.42009', '91.51599', '203.85531', '136.86040'),
(101, 1100, 768, '0.30182', '0.69818', '34.07355', '23.38383', '46.68246', '33.05868', '62.43522', '45.34441'),
(102, 332, 254, '0.23494', '0.76506', '9.93625', '7.47219', '12.60891', '9.67485', '15.75276', '12.28573'),
(103, 78, 65, '0.16667', '0.83333', '2.25548', '1.84751', '2.67267', '2.20266', '3.14384', '2.61088'),
(104, 13, 11, '0.15385', '0.84615', '0.36320', '0.30208', '0.41719', '0.35515', '0.47118', '0.40822'),
(105, 2, 2, '0.00000', '1.00000', '0.05399', '0.05307', '0.05399', '0.05307', '0.05399', '0.05307');

-- --------------------------------------------------------

--
-- Structure de la table `tabletemporaire`
--

CREATE TABLE IF NOT EXISTS `tabletemporaire` (
  `idtemp` int(40) NOT NULL AUTO_INCREMENT,
  `referencecredit` varchar(100) DEFAULT NULL,
  `numcompte` varchar(20) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `adresse` varchar(20) DEFAULT NULL,
  `datenaissance` varchar(50) DEFAULT NULL,
  `sexe` varchar(20) DEFAULT NULL,
  `typepret` varchar(20) DEFAULT NULL,
  `periodicite` varchar(20) DEFAULT NULL,
  `datedeblocage` date DEFAULT NULL,
  `duree` int(20) DEFAULT NULL,
  `datefirstecheance` varchar(50) DEFAULT NULL,
  `dateleastecheance` varchar(50) DEFAULT NULL,
  `tauxinteret` double DEFAULT NULL,
  `agence` varchar(20) DEFAULT NULL,
  `gescompte` varchar(20) DEFAULT NULL,
  `capital` int(40) DEFAULT NULL,
  `prime` int(40) DEFAULT NULL,
  `statutcontrat` varchar(20) DEFAULT NULL,
  `numbord` varchar(40) DEFAULT NULL,
  `categorie` varchar(20) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idtemp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=177 ;

--
-- Contenu de la table `tabletemporaire`
--

INSERT INTO `tabletemporaire` (`idtemp`, `referencecredit`, `numcompte`, `nom`, `prenom`, `profession`, `adresse`, `datenaissance`, `sexe`, `typepret`, `periodicite`, `datedeblocage`, `duree`, `datefirstecheance`, `dateleastecheance`, `tauxinteret`, `agence`, `gescompte`, `capital`, `prime`, `statutcontrat`, `numbord`, `categorie`, `code`) VALUES
(1, '018MTB1160690001', '0101801520952012020', 'BOKO-HAYA ALITONDJI ', NULL, 'QTIER GBODO AB-CALAVI 95900498  AB-CALAVI', NULL, '1987-12-02', 'M', 'M', '42438', NULL, NULL, '2016-03-09', '2020-10-09', 1300000, '018', '664', 1300000, 0, 'A', NULL, 'OTHERS', '664'),
(2, '016STB1160830002', '0101601510850956021', 'OFF NAT DE SOUT DES ', NULL, '01 BP 186 COT 95951885/66993929 adriendelidji@yahoo.fr BENIN', NULL, '2036-02-05', NULL, 'M', '42452', NULL, NULL, '2016-03-23', '2016-03-24', 4522936300, '016', '264', 2147483647, 0, 'A', NULL, 'ONG', '264'),
(3, '000STB2160780001', '0100001510104161031', 'MEHOUENOU KPENAGNI G', NULL, 'BP mehouenou.gilbert@yahoo.fr 0022996545410 C SB QT PODJI AGUE MS FADONOUGBO', NULL, '1989-06-21', 'M', 'M', '42447', NULL, NULL, '2016-03-18', '2017-03-24', 745000, '000', '337', 745000, 0, 'A', NULL, 'OTHERS', '337'),
(4, '000MTB1160780004', '0100001520100383039', 'AGBAMATE CHRISTIAN J', NULL, 'DIAMOND BANK BENIN 01 BP 955 RP COT 97 33 48 34 COTONOU', NULL, '1984-07-13', 'M', 'M', '42447', NULL, NULL, '2016-03-18', '2019-04-24', 1200000, '000', '769', 1200000, 0, 'A', NULL, 'STAFF', '769'),
(5, '000STB1160780002', '0100001510002351023', 'STE METAL BENIN', NULL, 'RUE LAGUNAIRE  NUMERO 840 BP 652 COTONOU TEL : 71 26 43 BENIN', NULL, '2036-02-05', NULL, 'M', '42447', NULL, NULL, '2016-03-18', '2016-06-18', 35519595, '000', '427', 35519595, 0, 'A', NULL, 'SOCIETE', '427'),
(6, '000STB2160770001', '0100001510101328039', 'SAHOU GILCHRIST DEBR', NULL, 'DIAMOND BANK 01 BP 955 COT 95 23 61 33 COTONOU', NULL, '1987-04-09', 'M', 'M', '42446', NULL, NULL, '2016-03-17', '2016-09-24', 709000, '000', '769', 709000, 0, 'A', NULL, 'STAFF', '769'),
(7, '000STB1160690002', '0100001510000403040', 'SO.COM.IMP.EX SA', NULL, 'BP 22 AZOVE 31 25 79 / 91 27 54 COTONOU BENIN', NULL, '2036-02-05', NULL, 'M', '42438', NULL, NULL, '2016-03-09', '2016-09-09', 6000000, '000', '372', 6000000, 0, 'A', NULL, 'SOCIETE', '372'),
(8, '000MTB1160640003', '0100001520008227071', 'ADJANOHOUN MATHIEU', NULL, '02 BP 2645 COTONOU m-adj1@hotmail.fr 0022997 91 78 30 QTIER SALAMEY GODOMEY', NULL, '1986-10-31', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2019-09-04', 5077700, '000', '769', 5077700, 0, 'A', NULL, 'ETUDIANT', '769'),
(9, '000STB2160610001', '0100001510007820055', 'CREDITS AUX AGENTS P', NULL, 'GBEDJROMEDE 01 BP 6384 COT 97492390 / 98762145/ 66 01 27 77 COTONOU', NULL, '2036-02-05', NULL, 'M', '42430', NULL, NULL, '2016-03-01', '2018-02-28', 1306615, '000', '396', 1306615, 0, 'A', NULL, 'SOCIETE', '396'),
(10, '001STB1160810001', '0100101510153235040', 'ETS CERI - SERVICES', NULL, 'QT GODOMEY GARE MS ADANMADO 0022997172022 0022996744772 COTONOU - BENIN', NULL, '2036-02-05', NULL, 'M', '42450', NULL, NULL, '2016-03-21', '2017-03-21', 6322000, '001', '608', 6322000, 0, 'A', NULL, 'ETABLIS', '608'),
(11, '002MTB1160640001', '0100201520201007062', 'TCHOKPON IDOSSOU TCH', NULL, 'C SB AYEDERO DASSA II MS DEHOUE 95373178 BENIN', NULL, '1983-10-15', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2023-03-04', 3211000, '002', '613', 3211000, 0, 'A', NULL, 'FCTIONAIRE', '613'),
(12, '002MTB1160640003', '0100201520200835047', 'AGBOTON AKINLADE DID', NULL, 'LOT 0160 AGBLANGANDAN COTONOU MS AWOUNOU AKPLOGAN 97229397 BENIN', NULL, '1975-05-23', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2023-03-04', 2057000, '002', '613', 2057000, 0, 'A', NULL, 'FCTIONAIRE', '613'),
(13, '003STB1160750002', '0100301510254880034', 'SOCIETE ADS SARL', NULL, 'BP  0022996805746  0022995053203 QT DEKOUNGBE MS CAKPO', NULL, '2036-02-05', NULL, 'M', '42444', NULL, NULL, '2016-03-15', '2017-03-15', 5734250, '003', '285', 5734250, 0, 'A', NULL, 'SOCIETE', '285'),
(14, '004MMPI160780001', '0100401680950661017', 'BSIC MALI - PIB', NULL, 'BP   MALI', NULL, '2036-02-05', NULL, NULL, '42447', NULL, NULL, '2016-03-18', '2016-04-01', 1000000000, '004', '029', 1000000000, 0, 'A', NULL, 'BKETRANG', '029'),
(15, '005MTB1160640002', '0100501520301551041', 'PADONOU SENAKPON M.B', NULL, 'ECOLE NATIONALE DE POLICE  66477012 / 98879471 BENIN', NULL, '1989-12-22', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2023-03-04', 1680000, '005', '019-INT', 1680000, 0, 'A', NULL, 'OTHERS', '019-INT'),
(16, '005MTB1160640001', '0100501520301542040', 'GNACADJA BISMARK PAT', NULL, 'ECOLE NATIONALE DE POLICE 95975172 67317295 BENIN', NULL, '1988-01-18', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2021-03-04', 1300000, '005', '692', 1300000, 0, 'A', NULL, 'OTHERS', '692'),
(17, '010MTB1160710003', '0101001520501340036', 'HOUNSOU SIMON', NULL, 'AYETEDJOU / IFANGNI  022997048955 BENIN', NULL, '1983-01-01', 'M', 'M', '42440', NULL, NULL, '2016-03-11', '2021-03-11', 1580000, '010', '690', 1580000, 0, 'A', NULL, 'FCTIONAIRE', '690'),
(18, '013MTB1160760005', '0101301520653298050', 'GOUDJANOU MARTIN', NULL, 'MS GOUDJANOU QT SEME BOHICON TEL: 22966376143/22999490191 BENIN', NULL, '1988-01-01', 'M', 'M', '42445', NULL, NULL, '2016-03-16', '2021-03-16', 1086000, '013', '383', 1086000, 0, 'A', NULL, 'FCTIONAIRE', '383'),
(19, '013MTB1160690001', '0101301520650756068', 'GBEGAN JONAS', NULL, 'ADOFAN / ZOGBODOMEY TEL 95576253 MS HOUNKPONOU BENIN', NULL, '1972-01-01', 'M', 'M', '42438', NULL, NULL, '2016-03-09', '2021-03-09', 2429000, '013', '383', 2429000, 0, 'A', NULL, 'FCTIONAIRE', '383'),
(20, '017MTB1160690001', '0101701520905010055', 'APELETE COMLAN THIER', NULL, 'BP  22996954274 ZOUNGO MS APELETE', NULL, '1973-01-01', 'M', 'M', '42438', NULL, NULL, '2016-03-09', '2019-03-09', 1300000, '017', '616', 1300000, 0, 'A', NULL, 'OTHERS', '616'),
(21, '017STB2160640001', '0101701510900966023', 'DODOO JEAN MARIE', NULL, 'C 358 359 GBEDOKPO COTONOU 03 BP 1244 COTONOU 95062454 COTONOU', NULL, '1956-12-21', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2017-01-04', 400000, '017', '616', 400000, 0, 'A', NULL, 'OTHERS', '616'),
(22, '021STB1160740002', '0102101514101711021', 'PADONOU ADJOBIGNON F', NULL, '.  0022997228802 97224256 QT COCOCODJI AB CAL', NULL, '1981-04-03', 'F', 'M', '42443', NULL, NULL, '2016-03-14', '2017-03-14', 60000000, '021', '010-INT', 60000000, 0, 'A', NULL, 'OTHERS', '010-INT'),
(23, '021MTB1160690002', '0102101524100405038', 'AKOUTEY LAMBERT', NULL, '.  0022994429421 C SB ZONGO NIMA COT', NULL, '1964-03-20', 'M', 'M', '42438', NULL, NULL, '2016-03-09', '2019-03-09', 1100000, '021', '679', 1100000, 0, 'A', NULL, 'RETRAITE', '679'),
(24, '000STP1160770001', '0100001510001788034', 'SIGMA 2 - SA', NULL, 'C/1514 D VEDOKO TEL 95 96 66 99 / 95 05 87 30 01 BP 3354 RECETTE PRINCIPALE BENIN', NULL, '2036-02-05', NULL, 'M', '42446', NULL, NULL, '2016-03-17', '2017-03-05', 93384123, '000', '324', 93384123, 3, 'A', NULL, 'SOCIETE', '324'),
(25, '000STB1160780001', '0100001510002238021', 'HBP SARL BENIN', NULL, '04 BP 0526 COTONOU C/ 750 CADJEHOUN MAIS SETCHEGBE TEL 33 33 48 BENIN', NULL, '2036-02-05', NULL, 'M', '42447', NULL, NULL, '2016-03-18', '2017-03-14', 8489068, '000', '324', 8489068, 0, 'A', NULL, 'SOCIETE', '324'),
(26, '000STB1160690003', '0100001510000403040', 'SO.COM.IMP.EX SA', NULL, 'BP 22 AZOVE 31 25 79 / 91 27 54 COTONOU BENIN', NULL, '2036-02-05', NULL, 'M', '42438', NULL, NULL, '2016-03-09', '2016-09-09', 16019432, '000', '372', 16019432, 0, 'A', NULL, 'SOCIETE', '372'),
(27, '001STB1160760001', '0100101510021920021', ' ETS ENTREPRISE  SAI', NULL, 'C/ 1754 FIDJROSSE COT OUEST MS/ FANDOHAN LAMBERT TEL: 90914636 / 95344197 BENIN', NULL, '2036-02-05', NULL, 'M', '42445', NULL, NULL, '2016-03-16', '2016-07-16', 50000000, '001', '136', 50000000, 0, 'A', NULL, 'ETABLIS', '136'),
(28, '002STP1160830001', '0100201510030283033', 'STE MTCHESSY ET FILS', NULL, 'C/ 207-208 COTONOU OUEST 01 BP 6536 RECETTE PRINCIPALE TEL 21316506 90905053 21315653', NULL, '2036-02-05', NULL, 'M', '42452', NULL, NULL, '2016-03-23', '2016-06-16', 200249412, '002', '431', 200249412, 0, 'A', NULL, 'SOCIETE', '431'),
(29, '003STB1160750003', '0100301510254880034', 'SOCIETE ADS SARL', NULL, 'BP  0022996805746  0022995053203 QT DEKOUNGBE MS CAKPO', NULL, '2036-02-05', NULL, 'M', '42444', NULL, NULL, '2016-03-15', '2017-03-15', 7970535, '003', '285', 7970535, 0, 'A', NULL, 'SOCIETE', '285'),
(30, '003MTB1160680002', '0100301520255865033', 'DOMINGO EP AMOUSSOU ', NULL, 'BP  22995248488 QT AYIMEVO MS KINKPONHOUE', NULL, '1974-08-30', 'F', 'M', '42437', NULL, NULL, '2016-03-08', '2021-03-08', 11180000, '003', '653', 11180000, 0, 'A', NULL, 'OTHERS', '653'),
(31, '005MTB1160630001', '0100501520301570035', 'KEKE MAHUKPEGO GEOFF', NULL, 'QTIER TODOTE C 421 MS LAURIANO 22966362835 BENIN', NULL, '1985-09-25', 'M', 'M', '42432', NULL, NULL, '2016-03-03', '2022-03-03', 3300000, '005', '019-INT', 3300000, 0, 'A', NULL, 'FCTIONAIRE', '019-INT'),
(32, '007MTB1160710001', '0100701520405299043', 'GBATOTCHI ZINSOU SAM', NULL, 'ALBARIKA  22994799971 BENIN', NULL, '1991-01-01', 'M', 'M', '42440', NULL, NULL, '2016-03-11', '2021-03-11', 1319000, '007', '100-500', 1319000, 0, 'A', NULL, 'FCTIONAIRE', '100-500'),
(33, '007MTB1160750001', '0100701520405288025', 'BONI ZIME MAMOUDOU', NULL, 'LADJIFARANI  22995910903 96658726 BENIN', NULL, '1989-10-25', 'M', 'M', '42444', NULL, NULL, '2016-03-15', '2023-03-15', 1680000, '007', '100-500', 1680000, 0, 'A', NULL, 'FCTIONAIRE', '100-500'),
(34, '009MTB1160820001', '0100901520452012059', 'DAKPE SAMUEL', NULL, '96 95 98 30 samdakp@gmail.com C/ 4235 AHWANLEKE CAMP-GUEZO BENIN', NULL, '1993-04-30', 'M', 'M', '42451', NULL, NULL, '2016-03-22', '2021-09-22', 1170000, '009', '614', 1170000, 0, 'A', NULL, 'FCTIONAIRE', '614'),
(35, '009STB1160760001', '0100901510046312026', 'STE ADEDOYIN ET COMP', NULL, 'C/ 559 DEDOKPO 01 BP 1922 COTONOU TEL 21043787 /97687818 BENIN', NULL, '2036-02-05', NULL, 'M', '42445', NULL, NULL, '2016-03-16', '2016-07-16', 50000000, '009', '441', 50000000, 0, 'A', NULL, 'SOCIETE', '441'),
(36, '010MTB1160750002', '0101001520501521030', 'KOLECHE OLABODE A. I', NULL, 'IDENAN / KETOU  66052896/94139669 BENIN', NULL, '1983-12-28', 'M', 'M', '42444', NULL, NULL, '2016-03-15', '2019-03-15', 376000, '010', '690', 376000, 0, 'A', NULL, 'FCTIONAIRE', '690'),
(37, '012MTB1160610001', '0101201520602935047', 'TCHAKI THOMAS', NULL, 'BP ttchaki@yahoo.fr 22995355495 QT CADJ KPOTA', NULL, '1988-01-01', 'M', 'M', '42430', NULL, NULL, '2016-03-01', '2023-03-01', 1485000, '012', '739', 1485000, 0, 'A', NULL, 'OTHERS', '739'),
(38, '013MTB1160640001', '0101301520654217043', 'SODONON ALFRED FREDE', NULL, 'QT AHOUAME BOHICON MSON SODONON TEL 22996985057/22995495996 BENIN', NULL, '1971-03-04', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2023-03-04', 1750000, '013', '383', 1750000, 0, 'A', NULL, 'OTHERS', '383'),
(39, '014MTB1160740001', '0101401520054546061', 'MAMA DRAMANE BABANGU', NULL, 'ENP TEL 95269460 97319722  BENIN', NULL, '1987-04-22', 'M', 'M', '42443', NULL, NULL, '2016-03-14', '2022-03-14', 2860000, '014', '745', 2860000, 0, 'A', NULL, 'OTHERS', '745'),
(40, '015STB1160740001', '0101501510752856019', 'GAYET S BUSINEES INV', NULL, 'C/936 LIEUDIT ADOGLA M GAYET 229 66546654  COTONOU', NULL, '2036-02-05', NULL, 'M', '42443', NULL, NULL, '2016-03-14', '2017-03-14', 63700770, '015', '426', 63700770, 0, 'A', NULL, 'SOCIETE', '426'),
(41, '015STB1160620003', '0101501510753228044', 'GRPMT ASTRO STAR/AGR', NULL, 'C/1442 QT MISSOGBE 229 95251228/95067908 COTONOU BENIN', NULL, '2036-02-05', NULL, 'M', '42431', NULL, NULL, '2016-03-02', '2017-03-02', 15000000, '015', '776', 15000000, 0, 'A', NULL, 'SOCIETE', '776'),
(42, '017LTB1160830002', '0101701530901735086', 'EZIN EUGENE', NULL, 'COTONOU  0033616534783 COTONOU', NULL, '1972-12-13', 'M', 'M', '42452', '2016-03-23', 5235, '2016-03-23', '2030-07-23', 1270000000, '017', '197', 1270000000, 0, 'A', NULL, 'COMPTABLE', '197'),
(43, '017STB1160740003', '0101701510901974027', 'QUALITY CORPORATE', NULL, 'COTONOU   COTONOU', NULL, '2036-02-05', NULL, 'M', '42443', NULL, NULL, '2016-03-14', '2017-03-14', 4708155, '017', '428', 4708155, 0, 'A', NULL, 'SOCIETE', '428'),
(44, '017STB1160700001', '0101701510900528037', 'STE AFRICAINE DE TEC', NULL, 'C/831 SIKECODJI 03 BP 050 JERICHO TEL 21034097/95065234/95287694 BENIN', NULL, '2036-02-05', NULL, 'M', '42439', NULL, NULL, '2016-03-10', '2016-06-30', 13880918, '017', '428', 13880918, 0, 'A', NULL, 'SOCIETE', '428'),
(45, '018STP1160670002', '0101801510951095014', 'ANIFOWOSHE  EP. BELL', NULL, 'QTIER DANGBEDJA AB-CALAVI TEL 97136832  BENIN', NULL, '1958-09-19', 'F', 'M', '42436', NULL, NULL, '2016-03-07', '2017-01-25', 8045195, '018', '664', 8045195, 2, 'A', NULL, 'OTHERS', '664'),
(46, '016MTB1160810001', '0101601520853642027', 'ALECHENU PATRICIA EN', NULL, 'BP enewapat@gmail.com 22998352876 C7004 C3 COCOTIERS', NULL, '1970-09-13', 'F', 'M', '42450', NULL, NULL, '2016-03-21', '2018-06-21', 17590732, '016', '164', 17590732, 0, 'A', NULL, 'OTHERS', '164'),
(47, '000STB2160710001', '0100001510000065027', 'DOSSOU PEDETIN', NULL, 'DIAMOND BANK BENIN S.A. 01 BP 955 RP COTONOU BENIN', NULL, '1974-06-11', 'M', 'M', '42440', NULL, NULL, '2016-03-11', '2016-09-24', 1000000, '000', '769', 1000000, 0, 'A', NULL, 'STAFF', '769'),
(48, '000STB1160690005', '0100001510005332026', 'CAB DING ET DE RECH ', NULL, '11 BP 1571 ABIDJAN 11 TEL (00225) 20312690  COTE DIVOIRE', NULL, '2036-02-05', NULL, 'M', '42438', NULL, NULL, '2016-03-09', '2016-09-09', 17000000, '000', '427', 17000000, 0, 'A', NULL, 'SOCIETE', '427'),
(49, '000STB2160700001', '0100001510100738024', 'NWANERI CHIJIOKE COL', NULL, 'DIAMOND BANK BENIN 01 BP 955 RP COT 67 51 33 36 COTONOU', NULL, '1983-01-25', 'M', 'M', '42439', NULL, NULL, '2016-03-10', '2016-09-24', 600000, '000', '769', 600000, 0, 'A', NULL, 'STAFF', '769'),
(50, '000STB1160680001', '0100001510001788034', 'SIGMA 2 - SA', NULL, 'C/1514 D VEDOKO TEL 95 96 66 99 / 95 05 87 30 01 BP 3354 RECETTE PRINCIPALE BENIN', NULL, '2036-02-05', NULL, 'M', '42437', NULL, NULL, '2016-03-08', '2017-03-08', 60000000, '000', '324', 60000000, 0, 'A', NULL, 'SOCIETE', '324'),
(51, '001MTB1160630001', '0100101520154635030', 'FATOMON ALEX MICHEE ', NULL, 'BP fatomon1@yahoo.fr 22997057096 C 235 QT TOKPOTA1 MS ASSOGBAH', NULL, '1982-12-22', 'M', 'M', '42432', NULL, NULL, '2016-03-03', '2023-03-03', 4092000, '001', '608', 4092000, 0, 'A', NULL, 'OTHERS', '608'),
(52, '001MTB1160640002', '0100101520154653032', 'LOHOU ASSOGBA ANTOIN', NULL, 'BP  22997462648 QT AGBOKOU 3 MS GANDONOU', NULL, '1965-01-01', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2023-03-04', 4470000, '001', '608', 4470000, 0, 'A', NULL, 'OTHERS', '608'),
(53, '004MMPI160820001', '0100401680950699020', 'BIMAO PIB', NULL, 'BP   BENIN', NULL, '2036-02-05', NULL, NULL, '42451', NULL, NULL, '2016-03-22', '2016-04-05', 1000000000, '004', '15', 1000000000, 0, 'A', NULL, 'BKETRANG', '15'),
(54, '004MMPI160750001', '0100401680950546019', 'ORABANK TOGO', NULL, 'TOGO  2225 TOGO', NULL, '2036-02-05', NULL, NULL, '42444', NULL, NULL, '2016-03-15', '2016-03-29', 2000000000, '004', '654', 2000000000, 0, 'A', NULL, 'BKETRANG', '654'),
(55, '004MMPI160700001', '0100401680950546019', 'ORABANK TOGO', NULL, 'TOGO  2225 TOGO', NULL, '2036-02-05', NULL, NULL, '42439', NULL, NULL, '2016-03-10', '2016-03-24', 3000000000, '004', '654', 2147483647, 0, 'A', NULL, 'BKETRANG', '654'),
(56, '011MTB1160740002', '0101101520552211060', 'LODEME OSCAR', NULL, 'C 1882 FIYEGNON I 67780715  COT', NULL, '1991-12-22', 'M', 'M', '42443', NULL, NULL, '2016-03-14', '2019-11-14', 1324000, '011', '802', 1324000, 0, 'A', NULL, 'FCTIONAIRE', '802'),
(57, '011MTB1160700004', '0101101520555862032', 'GRIMAUD SEDJRO CHARM', NULL, 'BP  22997654228 QT OUNVENOUMEDE MR GRIMAUD', NULL, '1987-08-07', 'M', 'M', '42439', NULL, NULL, '2016-03-10', '2023-03-10', 1970000, '011', '802', 1970000, 0, 'A', NULL, 'OTHERS', '802'),
(58, '011MTB1160690002', '0101101520551699053', 'ZINDEGLA AURELIEN', NULL, 'AGORI C/SB M/ADJOMATIN 97595994 / 95350719 AB CALAVI BENIN', NULL, '1977-06-18', 'M', 'M', '42438', NULL, NULL, '2016-03-09', '2023-03-09', 6059000, '011', '802', 6059000, 0, 'A', NULL, 'FCTIONAIRE', '802'),
(59, '013MTB1160760001', '0101301520650598058', 'GBOLI-HONON ARNAUD', NULL, 'AGBANGNIZOUN TEL: 95292998  BENIN', NULL, '1986-06-26', 'M', 'M', '42445', NULL, NULL, '2016-03-16', '2021-03-16', 1381000, '013', '725', 1381000, 0, 'A', NULL, 'ENSEIGNANT', '725'),
(60, '013MTB1160680001', '0101301520650725053', 'GOUKOTAN SENAMI BELL', NULL, 'GBANGNANME / CANA 2 TEL 95161974 MS AHEHEHINNOU BENIN', NULL, '1985-05-15', 'F', 'M', '42437', NULL, NULL, '2016-03-08', '2019-03-08', 862000, '013', '383', 862000, 0, 'A', NULL, 'FCTIONAIRE', '383'),
(61, '014MTB1160750001', '0101401520701544030', 'ADJAHOTO METOGBE MAR', NULL, 'C 1272 VODJE FINAGNON COTONOU  0022997928725 0022995286483 BENIN', NULL, '1981-08-07', 'M', 'M', '42444', NULL, NULL, '2016-03-15', '2023-03-15', 19127000, '014', '745', 19127000, 0, 'A', NULL, 'OTHERS', '745'),
(62, '015STP1160760001', '0101501510752856019', 'GAYET S BUSINEES INV', NULL, 'C/936 LIEUDIT ADOGLA M GAYET 229 66546654  COTONOU', NULL, '2036-02-05', NULL, 'M', '42445', NULL, NULL, '2016-03-16', '2016-06-03', 51039000, '015', '426', 51039000, 0, 'A', NULL, 'SOCIETE', '426'),
(63, '018MTB1160820001', '0101801520958109034', 'HOUESSOU BIDOSSESSI ', NULL, 'BP  22994944567 QT TCHINANGBEGBO MS HOUESSOU', NULL, '1977-03-14', 'M', 'M', '42451', NULL, NULL, '2016-03-22', '2023-03-22', 3025000, '018', '827', 3025000, 0, 'A', NULL, 'ENSEIGNANT', '827'),
(64, '021MTB1160690001', '0102101524102171029', 'BONI GBEA IZBATH', NULL, 'ZOKPAH PALMERAIE C/SB M/ SIDI ALI TADJOU DIN 0022997978961 ABOMEY CALAVI', NULL, '1983-10-05', 'F', 'M', '42438', NULL, NULL, '2016-03-09', '2023-03-09', 19922794, '021', '744', 19922794, 0, 'A', NULL, 'OTHERS', '744'),
(65, '016MTB1160690001', '0101601520853340050', 'FANOU KOUABA YVETTE', NULL, 'BP  22996625578 DONATEN MS FANOU', NULL, '1977-10-23', 'F', 'M', '42438', NULL, NULL, '2016-03-09', '2021-03-09', 973188, '016', '729', 973188, 0, 'A', NULL, 'OTHERS', '729'),
(66, '016MTB1160680001', '0101601520850515056', 'ATCHADE SYLVAIN DOSS', NULL, 'GBETAGBO AKASSATO 95847991 03 BP 922 ABOMEY CALAVI', NULL, '1979-05-03', 'M', 'M', '42437', NULL, NULL, '2016-03-08', '2023-03-08', 2180970, '016', '464', 2180970, 0, 'A', NULL, 'OTHERS', '464'),
(67, '000MTB1160770001', '0100001520100735034', 'ZOCLI ENAGNON D. CON', NULL, 'DIAMOND BANK BENIN 01 BP 955 RP COT 94 74 19 58 COTONOU', NULL, '1980-09-23', 'M', 'M', '42446', NULL, NULL, '2016-03-17', '2019-03-24', 2500000, '000', '337', 2500000, 0, 'A', NULL, 'STAFF', '337'),
(68, '000STB1160750001', '0100001510102228040', 'VICO SARL', NULL, 'LOT 918 QT AGBODJEDO 06 BP 3018 COT  22997364027 COTONOU', NULL, '2036-02-05', NULL, 'M', '42444', NULL, NULL, '2016-03-15', '2017-03-15', 27000000, '000', '324', 27000000, 0, 'A', NULL, 'SOCIETE', '324'),
(69, '000MTB1160750001', '0100001520101039050', 'SANNI RIDWAN ADESHIN', NULL, 'NIS / BLVD DE LA CENSAD MARINA BP 2019 COTONOU 66 36 67 29 COTONOU', NULL, '1986-03-08', 'M', 'M', '42444', NULL, NULL, '2016-03-15', '2019-03-15', 3538000, '000', '769', 3538000, 0, 'A', NULL, 'ENSEIGNANT', '769'),
(70, '000STB2160700004', '0100001510104152030', 'ACLAMAVO METOGBE BRI', NULL, 'BP aclamavobrice@yahoo.fr 0022997501097 C SB QT AGORI FINAFA MS OKPETCHE', NULL, '1974-11-13', 'M', 'M', '42439', NULL, NULL, '2016-03-10', '2017-07-24', 1000000, '000', '337', 1000000, 0, 'A', NULL, 'STAFF', '337'),
(71, '000MTB1160630001', '0100001520102466035', 'PLOMEY KWASI BRUNO', NULL, 'QT MISSITE C 1570 MS DOSSOU FASSI  22997678818 COTONOU', NULL, '1973-08-19', 'M', 'M', '42432', NULL, NULL, '2016-03-03', '2019-03-03', 1500000, '000', '337', 1500000, 0, 'A', NULL, 'OTHERS', '337'),
(72, '000STB1160610005', '0100001510002349043', 'ENTREPRISE C.E.C-BTP', NULL, '04 BP 1459 COTONOU C/01376 F HOUENOUSSOU TEL 32 31 96 BENIN', NULL, '2036-02-05', NULL, 'M', '42430', NULL, NULL, '2016-03-01', '2018-02-25', 38500000, '000', '324', 38500000, 0, 'A', NULL, 'ETABLIS', '324'),
(73, '001STB1160810002', '0100101510024684051', 'ETS ENTREPRISE GRAND', NULL, '08 BP 0221 ABOMEY CALAVI C/1391 STE RITA COT MS/GANSE ANTOIN TEL:95 35 33 32 BENIN', NULL, '2036-02-05', NULL, 'M', '42450', NULL, NULL, '2016-03-21', '2016-06-21', 4533899, '001', '591', 4533899, 0, 'A', NULL, 'ETABLIS', '591'),
(74, '001MTB1160640001', '0100101520154413028', 'ETEKA CAMILLE AGBOTA', NULL, 'BP etekacamille@yahoo.fr 0022996751054 C SB QT DJEGAN KPEVI', NULL, '1960-04-30', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2019-12-04', 4500000, '001', '608', 4500000, 0, 'A', NULL, 'OTHERS', '608'),
(75, '002MTB1160680001', '0100201520034011068', 'MIGNANNOU SETOMAGBE ', NULL, 'M/KOUKPESSO TANKPE GODOMEY 01 BP 2802 COT TEL 97395343 BENIN', NULL, '1979-11-21', 'M', 'M', '42437', NULL, NULL, '2016-03-08', '2023-03-08', 1623000, '002', '652', 1623000, 0, 'A', NULL, 'FCTIONAIRE', '652'),
(76, '003MTB1160680003', '0100301520255866025', 'ADEDE PAUL MIKI KOSS', NULL, 'BP  22966180927 LOT 1495 VEDOKO', NULL, '1987-02-05', 'M', 'M', '42437', NULL, NULL, '2016-03-08', '2021-03-08', 3564000, '003', '653', 3564000, 0, 'A', NULL, 'OTHERS', '653'),
(77, '003MTB1160680004', '0100301520251513056', 'WILSON ADJETE MAWUSS', NULL, 'QT COCOCODJI GODOMEY  97608938 BENIN', NULL, '1980-09-14', 'M', 'M', '42437', NULL, NULL, '2016-03-08', '2023-03-08', 2484000, '003', '653', 2484000, 0, 'A', NULL, 'ENSEIGNANT', '653'),
(78, '004MMPI160750002', '0100406680950384060', 'ORABANK BENIN PIB', NULL, 'BENIN BENIN BENIN BENIN', NULL, '2036-02-05', NULL, NULL, '42444', NULL, NULL, '2016-03-15', '2016-03-29', 2000000000, '004', '15', 2000000000, 0, 'A', NULL, 'BKETRANG', '15'),
(79, '005MTB1160740001', '0100501520301574025', 'CHALLA EYILOMON JANV', NULL, 'ECOLE NATIONALE DE POLICE  95185130 BENIN', NULL, '1988-01-01', 'M', 'M', '42443', NULL, NULL, '2016-03-14', '2023-03-14', 1691000, '005', '019-INT', 1691000, 0, 'A', NULL, 'FCTIONAIRE', '019-INT'),
(80, '007STB2160740001', '0100701510401454023', 'ETS ATA BE SITU', NULL, 'QTIER ZONGO 97743566 / 95405003 PKOU PKOU', NULL, '2036-02-05', NULL, 'M', '42443', NULL, NULL, '2016-03-14', '2016-07-14', 20000000, '007', '408', 20000000, 0, 'A', NULL, 'ETABLIS', '408'),
(81, '010MTB1160750001', '0101001520501125033', 'CHINA EP.OREYICHAN Y', NULL, 'TOKPOTA P/N  97939397 BENIN', NULL, '1957-05-15', 'F', 'M', '42444', NULL, NULL, '2016-03-15', '2021-03-15', 4000000, '010', '690', 4000000, 0, 'A', NULL, 'FCTIONAIRE', '690'),
(82, '010MTB1160710004', '0101001520504302055', 'NONVIGNON DOVOME CLE', NULL, 'HOUEZE AVRANKOU  22996519710 BENIN', NULL, '1984-10-11', 'F', 'M', '42440', NULL, NULL, '2016-03-11', '2021-03-11', 1580000, '010', '690', 1580000, 0, 'A', NULL, 'FCTIONAIRE', '690'),
(83, '010MTB1160690003', '0101001520508069032', 'PETERS MICHAELI P AB', NULL, '.  0022997229046 AHOUANTINKOMEY PN', NULL, '1980-01-11', 'M', 'M', '42438', NULL, NULL, '2016-03-09', '2023-03-09', 2660000, '010', '690', 2660000, 0, 'A', NULL, 'ENSEIGNANT', '690'),
(84, '010MTB1160630001', '0101001520503263049', 'DESSIN GODEFFROY MAT', NULL, 'AKONABOE P/NOVO  97315207 BENIN', NULL, '1974-11-08', 'M', 'M', '42432', NULL, NULL, '2016-03-03', '2021-03-03', 1276000, '010', '690', 1276000, 0, 'A', NULL, 'FCTIONAIRE', '690'),
(85, '012MTB1160680001', '0101201520602956036', 'SOHOUGAN SALIHOU HEN', NULL, 'BP henrisso13@yahoo.fr 22997119693 LOT 3894 QT FIDJROSSE KPOTA', NULL, '1977-04-03', 'M', 'M', '42437', NULL, NULL, '2016-03-08', '2021-03-08', 2700000, '012', '739', 2700000, 0, 'A', NULL, 'FCTIONAIRE', '739'),
(86, '015STP1160820001', '0101501510039362035', 'ENTREPRISE ESPOIR GL', NULL, 'TEL 95953957 09 BP 168  COTONOU', NULL, '2036-02-05', NULL, 'M', '42451', NULL, NULL, '2016-03-22', '2016-06-20', 50000000, '015', '316', 50000000, 0, 'A', NULL, 'ETABLIS', '316'),
(87, '015STP1160620001', '0101501510039515078', 'CONTINENTAL ENERGY E', NULL, 'TEL 97829210 03 BP 3338 GODOMEY M/BASSO COTONOU', NULL, '2036-02-05', NULL, 'M', '42431', NULL, NULL, '2016-03-02', '2016-05-15', 41877307, '015', '426', 41877307, 0, 'A', NULL, 'SOCIETE', '426'),
(88, '019MTB1160750003', '0101901524001088060', 'CHAGAS ANTOINE FORTU', NULL, 'C/ 1225-A GBEDJROMEDE 1 97 09 52 21 chatofort@yahoo.fr BENIN', NULL, '1979-06-13', 'M', 'M', '42444', NULL, NULL, '2016-03-15', '2021-03-15', 10080000, '019', '615', 10080000, 0, 'A', NULL, 'OTHERS', '615'),
(89, '018MTB1160630001', '0101801520957873040', 'NOUATIN KOUDESSA JUS', NULL, 'BP  22995831556 C SB ADJAGBO', NULL, '1967-01-01', 'M', 'M', '42432', NULL, NULL, '2016-03-03', '2022-06-03', 2700000, '018', '664', 2700000, 0, 'A', NULL, 'FCTIONAIRE', '664'),
(90, '000MTB1160780003', '0100001520100383039', 'AGBAMATE CHRISTIAN J', NULL, 'DIAMOND BANK BENIN 01 BP 955 RP COT 97 33 48 34 COTONOU', NULL, '1984-07-13', 'M', 'M', '42447', NULL, NULL, '2016-03-18', '2020-04-24', 3560000, '000', '769', 3560000, 0, 'A', NULL, 'STAFF', '769'),
(91, '000STCB160750002', '0100001580100615091', 'LADDER LOGISTICS SAR', NULL, 'LOT 58 TOPLEGBE PK6 01 BP 3025 COT 97 51 80 86 COTONOU', NULL, '2036-02-05', NULL, NULL, '42444', NULL, NULL, '2016-03-15', '2016-08-27', 25000000, '000', '103', 25000000, 0, 'A', NULL, 'SOCIETE', '103'),
(92, '000MTB1160750002', '0100001520100643071', 'BAMIDELE OLUWAFEMI O', NULL, 'NIGERIA INT. SCHOOL BP 2019 COT 68 01 99 32 COTONOU', NULL, '1982-03-19', 'M', 'M', '42444', NULL, NULL, '2016-03-15', '2019-03-15', 4342000, '000', '769', 4342000, 0, 'A', NULL, 'COMPTABLE', '769'),
(93, '000STB2160700005', '0100001510103471022', 'OLERU UGOCHI ELSIE', NULL, '01 BP 955 RP COTONOU . 0022962314978 QTIER FIYEGNON 1 MS INNOCENT', NULL, '1988-05-13', 'F', 'M', '42439', NULL, NULL, '2016-03-10', '2017-03-24', 1000000, '000', '337', 1000000, 0, 'A', NULL, 'STAFF', '337'),
(94, '000MTB1160610001', '0100001520007820028', 'CREDITS AUX AGENTS P', NULL, 'GBEDJROMEDE 01 BP 6384 COT 97492390 / 98762145/ 66 01 27 77 COTONOU', NULL, '2036-02-05', NULL, 'M', '42430', NULL, NULL, '2016-03-01', '2021-02-28', 127728566, '000', '396', 127728566, 0, 'A', NULL, 'SOCIETE', '396'),
(95, '001STB1160780001', '0100101510152402034', 'STE HEBA SARL', NULL, 'C 1561 HOUENOUSSOU COT MS TOKPLONOU BONIFACE TEL 97 49 97 49 COTONOU - BENIN', NULL, '2036-02-05', NULL, 'M', '42447', NULL, NULL, '2016-03-18', '2016-07-18', 200000000, '001', '591', 200000000, 0, 'A', NULL, 'SOCIETE', '591'),
(96, '001MTB1160710002', '0100101520154784030', 'HOUESSOU ROBERT', NULL, 'BP houesr028@yahoo.fr 22997871370 22968506476 QT EKPE GBEDJAME', NULL, '1975-12-28', 'M', 'M', '42440', NULL, NULL, '2016-03-11', '2023-03-11', 3240000, '001', '136', 3240000, 0, 'A', NULL, 'FCTIONAIRE', '136'),
(97, '002MTB1160820003', '0100201520206437036', 'ADJIKOUI MARIE ABLAW', NULL, 'BP  22997868619 TANKPE MS ADJIKOUI', NULL, '1956-08-14', 'F', 'M', '42451', NULL, NULL, '2016-03-22', '2019-03-22', 2507000, '002', '613', 2507000, 0, 'A', NULL, 'RETRAITE', '613'),
(98, '002MTB1160640002', '0100201520203513036', 'MIDOGNI DJIDJOHO BAR', NULL, 'QTIER GBODJE C SB MS DOKOKO  22966353301 COTONOU', NULL, '1988-06-11', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2021-03-04', 1505000, '002', '152', 1505000, 0, 'A', NULL, 'OTHERS', '152'),
(99, '003STB1160760001', '0100301510251899047', 'ETS  FH', NULL, 'C/0499 SURU LERE COTONOU EST  97372689 BENIN', NULL, '2036-02-05', NULL, 'M', '42445', NULL, NULL, '2016-03-16', '2017-03-16', 11380000, '003', '285', 11380000, 0, 'A', NULL, 'ETABLIS', '285'),
(100, '003MTB1160630001', '0100301520254961031', 'KOUKPA LUCIEN', NULL, 'BP  22968883428 22965264607 C SB BEMBEREKE', NULL, '1985-01-11', 'M', 'M', '42432', NULL, NULL, '2016-03-03', '2021-03-03', 2982000, '003', '650', 2982000, 0, 'A', NULL, 'FCTIONAIRE', '650'),
(101, '005STB1160750001', '0100501510060873024', 'AKIM CASH INTERNATIO', NULL, 'C/ 312 FIGNON 03 BP 2997 COTONOU 21312663 / 97902820 BENIN', NULL, '2036-02-05', NULL, 'M', '42444', NULL, NULL, '2016-03-15', '2016-06-15', 29042496, '005', '019-INT', 29042496, 0, 'A', NULL, 'SOCIETE', '019-INT'),
(102, '005STB1160700001', '0100501510060361024', 'MOUSTAPHA EPSE KATO-', NULL, 'LOT 274 PK10 TEL 95 96 49 12 COTONOU BENIN', NULL, '1961-01-01', 'F', 'M', '42439', NULL, NULL, '2016-03-10', '2016-10-10', 5000000, '005', '019-INT', 5000000, 0, 'A', NULL, 'OTHERS', '019-INT'),
(103, '005STB1160640001', '0100501510060237023', 'ETS YANNI MAMADOU BA', NULL, 'C/4860 QTIER JAK MAISON AMINOU 03 BP 1704 COTONOU TEL 97 57 57 33 BENIN', NULL, '2036-02-05', NULL, 'M', '42433', NULL, NULL, '2016-03-04', '2016-06-04', 40000000, '005', '019-INT', 40000000, 0, 'A', NULL, 'ETABLIS', '019-INT'),
(104, '007STB1160830002', '0100701510081207040', 'STE AIR S.A', NULL, 'M/S ABOUDOU RASSAKI QT KPEBIE BP 319 PARAKOU TEL 23612185 societeair@yahoo.fr', NULL, '2036-02-05', NULL, 'M', '42452', NULL, NULL, '2016-03-23', '2016-06-23', 36499965, '007', '313', 36499965, 0, 'A', NULL, 'SOCIETE', '313'),
(105, '007STB2160750001', '0100701510401771026', 'ETS M E I', NULL, 'GODOMEY TOGOUDO 98925257/97634727 PARAKOU BENIN', NULL, '2036-02-05', NULL, 'M', '42444', NULL, NULL, '2016-03-15', '2016-07-15', 20000000, '007', '408', 20000000, 0, 'A', NULL, 'ETABLIS', '408'),
(106, '009STB1160780001', '0100901510045365049', 'CDPA SARL', NULL, 'C/ 516 ST MICHEL COTONOU 08 BP 665 TRI POSTAL COTONOU TEL 21 32 61 92 BENIN (cdpa@cdp', NULL, '2036-02-05', NULL, 'M', '42447', NULL, NULL, '2016-03-18', '2016-07-11', 976863572, '009', '441', 976863572, 0, 'A', NULL, 'SOCIETE', '441'),
(107, '009STP1160700002', '0100901510045365049', 'CDPA SARL', NULL, 'C/ 516 ST MICHEL COTONOU 08 BP 665 TRI POSTAL COTONOU TEL 21 32 61 92 BENIN (cdpa@cdp', NULL, '2036-02-05', NULL, 'M', '42439', NULL, NULL, '2016-03-10', '2016-08-28', 565773221, '009', '441', 565773221, 0, 'A', NULL, 'SOCIETE', '441'),
(108, '010MTB1160750003', '0101001520036311051', 'TOUDONOU ELIE', NULL, 'QTGBODJE PORTO NOVO M/S TOUDONOU TEL 95281024 BENIN', NULL, '1961-01-01', 'M', 'M', '42444', NULL, NULL, '2016-03-15', '2021-03-15', 2830000, '010', '690', 2830000, 0, 'A', NULL, 'ENSEIGNANT', '690'),
(109, '010MTB1160690002', '0101001520501291054', 'BOTON LASSISSI', NULL, 'SAKETE  97110815 BENIN', NULL, '1980-12-27', 'M', 'M', '42438', NULL, NULL, '2016-03-09', '2023-03-09', 5160000, '010', '690', 5160000, 0, 'A', NULL, 'FCTIONAIRE', '690'),
(110, '010MTB1160640001', '0101001520503208073', 'ATINDEBAKOU S.CONSUE', NULL, 'TOKPOTA P/NOVO M/ADJAHO  97182496-64253376 BENIN', NULL, '1981-07-11', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2023-03-04', 4275000, '010', '690', 4275000, 0, 'A', NULL, 'ENSEIGNANT', '690'),
(111, '012STB1160830001', '0101201510601076018', 'STE TRIPLE E SARL', NULL, 'C/188 AGBALILAME M/BALOGOUN ibrahimbalogoun@ gmail.com 61109469 BENIN', NULL, '2036-02-05', NULL, 'M', '42452', NULL, NULL, '2016-03-23', '2017-03-23', 1800000, '012', '146-INT', 1800000, 0, 'A', NULL, 'SOCIETE', '146-INT'),
(112, '013MTB1160820001', '0101301520654188047', 'TOVI AMOUSSOU SYLVAI', NULL, 'MS TOVI QT KPOCON BOHICON TEL:22995156859/22998476802 BENIN', NULL, '1960-01-01', 'M', 'M', '42451', NULL, NULL, '2016-03-22', '2019-03-22', 2707000, '013', '725', 2707000, 0, 'A', NULL, 'RETRAITE', '725'),
(113, '013MTB1160760004', '0101301520650448055', 'ADADJA DANIEL FRANCI', NULL, 'ADINGNIGON AGBANGNIZOUN MS ADADJA 22995184575 BENIN', NULL, '1978-10-15', 'M', 'M', '42445', NULL, NULL, '2016-03-16', '2023-03-16', 2970000, '013', '383', 2970000, 0, 'A', NULL, 'FCTIONAIRE', '383'),
(114, '013MTB1160710001', '0101301520650444054', 'DJOHON GBEDIGA JEAN-', NULL, 'OUKANME ABOMEY TEL: 94667805  BENIN', NULL, '1981-08-04', 'M', 'M', '42440', NULL, NULL, '2016-03-11', '2023-03-11', 1126000, '013', '383', 1126000, 0, 'A', NULL, 'FCTIONAIRE', '383'),
(115, '014MTB1160820001', '0101401520058715036', 'AHLONSOU ULRICH GERA', NULL, 'ENP TEL 95887174  BENIN', NULL, '1986-07-06', 'M', 'M', '42451', NULL, NULL, '2016-03-22', '2021-03-22', 1360000, '014', '745', 1360000, 0, 'A', NULL, 'OTHERS', '745'),
(116, '014MTB2160620001', '0101401520019083062', 'OROU BATA  ABOU DAVI', NULL, 'BP  0022994126035 ALEJO ABOMEY CALAVI', NULL, '1979-07-20', 'M', 'M', '42431', NULL, NULL, '2016-03-02', '2018-09-02', 30000000, '014', '657', 30000000, 0, 'A', NULL, 'FCTIONAIRE', '657'),
(117, '015STB1160780001', '0101501510016679035', 'STE  O. M. N SARL', NULL, 'C/1094 WOLOGUEDE COT-OUEST 01 BP 989 COTONOU TEL  95954343 COTONOU', NULL, '2036-02-05', NULL, 'M', '42447', NULL, NULL, '2016-03-18', '2017-03-18', 55000000, '015', '426', 55000000, 0, 'A', NULL, 'SOCIETE', '426'),
(118, '015STP1160670002', '0101501510750993019', 'GPMT C2E SARL /GECI', NULL, 'C/ 1266 STE RITA COTONOU 95456177 / 97829210 / 21032450 03 BP 3328 COTONOU BENIN', NULL, '2036-02-05', NULL, 'M', '42436', NULL, NULL, '2016-03-07', '2017-02-11', 20579755, '015', '426', 20579755, 0, 'A', NULL, 'SOCIETE', '426'),
(119, '018MTB1160640002', '0101801520957228049', 'ADJANOHOUN NICOLAS', NULL, 'QTIER GBODJO CALAVI MSN ADJANOHOUN  0022996074170 COTONOU', NULL, '1984-12-05', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2020-10-04', 1350000, '018', '664', 1350000, 0, 'A', NULL, 'OTHERS', '664'),
(120, '018MTB1160640001', '0101801520953953024', 'MAHOUCHI FLORENT', NULL, 'QT LOM NAVA / MS DJOSSOU  TEL 97335728 BENIN', NULL, '1991-09-30', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2020-12-04', 1165000, '018', '664', 1165000, 0, 'A', NULL, 'FCTIONAIRE', '664'),
(121, '018MTB2160620001', '0101801520958021024', 'STE CIVILE IMMOBILIE', NULL, '06 BP 1675 COTONOU  22998749213  22961107713 LOT 17 G TOKPLEGBE MS MEVI', NULL, '2036-02-05', NULL, 'M', '42431', NULL, NULL, '2016-03-02', '2020-12-02', 183000000, '018', '409', 183000000, 0, 'A', NULL, 'SOCIETE', '409'),
(122, '016MTB1160640001', '0101601520853179035', 'AVOCEFOHOUN SAHO RAP', NULL, 'BP  22997530402 C2161 QT ZOGBOHOUE', NULL, '1963-01-01', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2021-03-04', 6557691, '016', '729', 6557691, 0, 'A', NULL, 'OTHERS', '729'),
(123, '000LTB1160770001', '0100001530000028043', 'do-REGO MARTINE SIDO', NULL, 'DIAMOND BANK BENIN S.A. 01 BP 955 RECETTE PRINCIPALE COTONOU REPUBLIQUE DU BENIN', NULL, '1974-11-11', 'F', 'M', '42446', NULL, NULL, '2016-03-17', '2031-03-24', 30000000, '000', '769', 30000000, 0, 'A', NULL, 'STAFF', '769'),
(124, '000STB2160700003', '0100001510100698076', 'GUIDI AUREL RODRIGUE', NULL, 'DIAMOND BANK BENIN 01 BP 955 RP COT 97 37 11 08 COTONOU', NULL, '1988-05-05', 'M', 'M', '42439', NULL, NULL, '2016-03-10', '2017-09-24', 1500000, '000', '769', 1500000, 0, 'A', NULL, 'STAFF', '769'),
(125, '000STB1160690004', '0100001510000920060', 'DYJESCK SA', NULL, '01 BP 721 RP COTONOU C/217 AKPAKPA 33 13 11 BENIN', NULL, '2036-02-05', NULL, 'M', '42438', NULL, NULL, '2016-03-09', '2017-03-09', 240000000, '000', '324', 240000000, 0, 'A', NULL, 'SOCIETE', '324'),
(126, '000STB1160640001', '0100001510003126025', 'CFAO MOTORS BENIN SA', NULL, 'SOGEFRPPRIG C 4237 VILL COT OUEST  01BP147 COT tly@cfao.com 22921381601 22921380562', NULL, '2036-02-05', NULL, 'M', '42433', NULL, NULL, '2016-03-04', '2016-06-04', 500000000, '000', '438', 500000000, 0, 'A', NULL, 'SOCIETE', '438'),
(127, '001MTB1160710001', '0100101520154662033', 'AKPOLOU CODJO ARSENE', NULL, 'BP akpolouarsene@yahoo.fr 22995150736 C 1371 QT GBEDAGBA', NULL, '1970-01-01', 'M', 'M', '42440', NULL, NULL, '2016-03-11', '2023-03-11', 3579000, '001', '608', 3579000, 0, 'A', NULL, 'FCTIONAIRE', '608'),
(128, '003MTB1160820001', '0100301520255885030', 'GBEHANZIN MICHAEL YO', NULL, 'BP  22966827949 22994941062 QT KANSOUNKPA AB CAL', NULL, '1988-07-17', 'M', 'M', '42451', NULL, NULL, '2016-03-22', '2023-03-22', 2511000, '003', '650', 2511000, 0, 'A', NULL, 'FCTIONAIRE', '650'),
(129, '003STB2160770002', '0100301510040342027', 'ETS AKAMBI ANDFILS', NULL, '03 BP 4037 COTONOU C/490 JERICHO M/S RAOUFOU ROUCHA TEL 97183412/21320359', NULL, '2036-02-05', NULL, 'M', '42446', NULL, NULL, '2016-03-17', '2016-07-17', 2572993, '003', '285', 2572993, 0, 'A', NULL, 'ETABLIS', '285'),
(130, '004MMPI160760001', '0100401680950661017', 'BSIC MALI - PIB', NULL, 'BP   MALI', NULL, '2036-02-05', NULL, NULL, '42445', NULL, NULL, '2016-03-16', '2016-03-30', 1000000000, '004', '029', 1000000000, 0, 'A', NULL, 'BKETRANG', '029'),
(131, '006MTB1160820002', '0100601520351696043', 'AHOUANDJINOU HERMANN', NULL, 'C13774 FIDJROSSE KPOTA COTONOU  22997977921 BENIN', NULL, '1980-01-09', 'M', 'M', '42451', NULL, NULL, '2016-03-22', '2023-03-22', 19999196, '006', '566', 19999196, 0, 'A', NULL, 'OTHERS', '566'),
(132, '007MTB1160640001', '0100701520405268039', 'N DAH N TOAMA AKIBI ', NULL, 'LADJIFARANI  22966203797 95623697 BENIN', NULL, '1990-01-09', 'M', 'M', '42433', NULL, NULL, '2016-03-04', '2023-03-04', 1680000, '007', '803', 1680000, 0, 'A', NULL, 'FCTIONAIRE', '803'),
(133, '009MTB1160740001', '0100901520454898029', 'AGBOTOUNNOU SEWANOU ', NULL, 'BP  22967802665 QT BORIYOURE MS DOSSI', NULL, '1990-09-30', 'M', 'M', '42443', NULL, NULL, '2016-03-14', '2023-03-14', 7500000, '009', '614', 7500000, 0, 'A', NULL, 'OTHERS', '614'),
(134, '010MTB1160760001', '0101001520504263044', 'SAKALIE COMLAN ALEXI', NULL, 'MALANHOUI ADJARRA  22996973700 BENIN', NULL, '1979-05-29', 'M', 'M', '42445', NULL, NULL, '2016-03-16', '2023-03-16', 4096000, '010', '690', 4096000, 0, 'A', NULL, 'FCTIONAIRE', '690'),
(135, '011MTB1160740001', '0101101520551861060', 'GBOZO SEDRO FABRICE', NULL, 'QT COCOTOMEY MSON GBOZO 96570863  COT', NULL, '1989-01-10', 'M', 'M', '42443', NULL, NULL, '2016-03-14', '2023-03-14', 1674000, '011', '802', 1674000, 0, 'A', NULL, 'FCTIONAIRE', '802'),
(136, '013MTB1160690002', '0101301520651434056', 'YOVODJE ALOUGBA PELA', NULL, 'VIDOLE ABOMEY TEL: 95253468  BENIN', NULL, '1983-01-01', 'F', 'M', '42438', NULL, NULL, '2016-03-09', '2019-03-09', 806000, '013', '383', 806000, 0, 'A', NULL, 'ENSEIGNANT', '383'),
(137, '013MTB1160630002', '0101301520651010049', 'DANTON HONTONGNON SY', NULL, 'AGBLOME / ABOMEY TEL: 22997534593 / 22964445260  BENIN', NULL, '1988-11-27', 'M', 'M', '42432', NULL, NULL, '2016-03-03', '2023-03-03', 1970000, '013', '383', 1970000, 0, 'A', NULL, 'FCTIONAIRE', '383'),
(138, '015STP1160670001', '0101501510753276025', 'STE NORDIC SARL(SOCN', NULL, 'C/759 QT DANDJI 229 66261601 COTONOU BENIN', NULL, '2036-02-05', NULL, 'M', '42436', NULL, NULL, '2016-03-07', '2016-05-26', 22680290, '015', '776', 22680290, 0, 'A', NULL, 'SOCIETE', '776'),
(139, '015STB1160620001', '0101501510753231049', 'STE GLOBAL LOGISTIC ', NULL, 'LOT 759 QT DANDJI 229 99741728 COTONOU BENIN', NULL, '2036-02-05', NULL, 'M', '42431', NULL, NULL, '2016-03-02', '2017-02-18', 417455400, '015', '426', 417455400, 0, 'A', NULL, 'SOCIETE', '426'),
(140, '017STB1160740002', '0101701510901974027', 'QUALITY CORPORATE', NULL, 'COTONOU   COTONOU', NULL, '2036-02-05', NULL, 'M', '42443', NULL, NULL, '2016-03-14', '2017-03-14', 4432536, '017', '428', 4432536, 0, 'A', NULL, 'SOCIETE', '428'),
(141, '017MTB1160630001', '0101701520905116045', 'HOUETO MONDUKPE VIRG', NULL, 'BP  22966462110 TOKPOTA 1 MS ADAMON', NULL, '1965-07-12', 'F', 'M', '42432', NULL, NULL, '2016-03-03', '2023-03-03', 4869042, '017', '197', 4869042, 0, 'A', NULL, 'OTHERS', '197'),
(142, '016MTB1160710001', '0101601520853226033', 'BOKO FRANCIS KPONOU', NULL, 'BP  22997731868 QT PAHOU MS BOKO', NULL, '1962-01-01', 'M', 'M', '42440', NULL, NULL, '2016-03-11', '2021-03-11', 2281682, '016', '464', 2281682, 0, 'A', NULL, 'FCTIONAIRE', '464'),
(143, '000MTB1160780005', '0100001520100735034', 'ZOCLI ENAGNON D. CON', NULL, 'DIAMOND BANK BENIN 01 BP 955 RP COT 94 74 19 58 COTONOU', NULL, '1980-09-23', 'M', 'M', '42447', NULL, NULL, '2016-03-18', '2020-03-24', 7200000, '000', '337', 7200000, 0, 'A', NULL, 'STAFF', '337'),
(144, '000STB2160770002', '0100001510101786022', 'HOUETO FOLABI DONA N', NULL, 'DIAMOND BANK 01 BP 955 COT 97 29 45 08 COTONOU', NULL, '1986-09-22', 'M', 'M', '42446', NULL, NULL, '2016-03-17', '2017-09-24', 2000000, '000', '769', 2000000, 0, 'A', NULL, 'STAFF', '769'),
(145, '000MTB1160680001', '0100001520003707080', 'ALERE BENJAMIN OLANR', NULL, 'C/ 4237 FACE COT OUEST BP 2019 COTONOU TEL 21300248 / 21309386 NIGERIA INTERNATIONAL ', NULL, '1971-06-11', 'M', 'M', '42437', NULL, NULL, '2016-03-08', '2019-03-08', 2750000, '000', '337', 2750000, 0, 'A', NULL, 'ASST DIREC', '337'),
(146, '000STB2160700002', '0100001510101360031', 'SALANON SEGBEGNON  M', NULL, 'DIAMOND BANK 01 BP 955 COT 97 11 31 83 COTONOU', NULL, '1987-11-14', 'M', 'M', '42439', NULL, NULL, '2016-03-10', '2017-03-24', 1350000, '000', '337', 1350000, 0, 'A', NULL, 'STAFF', '337'),
(147, '000STB1160610001', '0100001510002238021', 'HBP SARL BENIN', NULL, '04 BP 0526 COTONOU C/ 750 CADJEHOUN MAIS SETCHEGBE TEL 33 33 48 BENIN', NULL, '2036-02-05', NULL, 'M', '42430', NULL, NULL, '2016-03-01', '2017-02-26', 33152067, '000', '324', 33152067, 0, 'A', NULL, 'SOCIETE', '324'),
(148, '001STB2160770001', '0100101510151359020', 'SOCIETE KETA ET FILS', NULL, 'LOT 887 PARCELLE A 05 BP 971 COT 97 22 07 14/ 97 58 21 34 BENIN/COTONOU', NULL, '2036-02-05', NULL, 'M', '42446', NULL, NULL, '2016-03-17', '2016-07-17', 15000000, '001', '591', 15000000, 0, 'A', NULL, 'SOCIETE', '591'),
(149, '002MTB1160690002', '0100201520205589039', 'CODJO ROMENCE CEPHYS', NULL, 'QTR MENONTIN LOT 2136 22997376965 MS CODJO R BENIN', NULL, '1983-03-10', 'F', 'M', '42438', NULL, NULL, '2016-03-09', '2023-03-09', 2628000, '002', '613', 2628000, 0, 'A', NULL, 'OTHERS', '613'),
(150, '002MTB1160690001', '0100201520200999066', 'KPONSO LEON DAVID', NULL, 'C SB COCOTOMEY GODOMEY MS DOHOUNKPAN JOSEPH 97066300 BENIN', NULL, '1972-05-04', 'M', 'M', '42438', NULL, NULL, '2016-03-09', '2021-03-09', 933000, '002', '652', 933000, 0, 'A', NULL, 'FCTIONAIRE', '652'),
(151, '006MTB1160820001', '0100601520351672056', 'OYABI DODJIVI OLAWOL', NULL, 'MINONTCHOU COTONOU goyabi@mtn.bj 22997979970 BENIN', NULL, '1975-07-07', 'M', 'M', '42451', NULL, NULL, '2016-03-22', '2023-03-22', 18106330, '006', '566', 18106330, 0, 'A', NULL, 'OTHERS', '566'),
(152, '010MTB1160820001', '0101001520501178062', 'FASSANOU LIAMIDI EPI', NULL, 'BONOU  97620723 BENIN', NULL, '1982-03-31', 'M', 'M', '42451', NULL, NULL, '2016-03-22', '2021-03-22', 1445000, '010', '690', 1445000, 0, 'A', NULL, 'FCTIONAIRE', '690'),
(153, '013MTB1160630001', '0101301520650554030', 'AHOMAGNON TONTCHEKPO', NULL, 'KETEGADJI COVE 22995730227  BENIN', NULL, '1983-11-17', 'F', 'M', '42432', NULL, NULL, '2016-03-03', '2023-03-03', 728000, '013', '383', 728000, 0, 'A', NULL, 'FCTIONAIRE', '383'),
(154, '015STB1160750001', '0101501510039434023', 'ETS LE VAINQUEUR', NULL, 'TEL 97339574  QT DEKOUNGBE COTONOU', NULL, '2036-02-05', NULL, 'M', '42444', NULL, NULL, '2016-03-15', '2016-07-15', 25000000, '015', '426', 25000000, 0, 'A', NULL, 'ETABLIS', '426'),
(155, '015STP1160680001', '0101501510016956027', 'ETS  AMEN ENTREPRISE', NULL, 'C/1266  COT-OUEST 05 BP 620 COT TEL 95969245 COTONOU', NULL, '2036-02-05', NULL, 'M', '42437', NULL, NULL, '2016-03-08', '2016-05-07', 22296881, '015', '316', 22296881, 0, 'A', NULL, 'ETABLIS', '316'),
(156, '017MTB1160610002', '0101701520905346034', 'MAMA ALI ADEKUNLE AH', NULL, 'BP  22997890552 SOME MS MAMA ALI', NULL, '1981-05-13', 'M', 'M', '42430', NULL, NULL, '2016-03-01', '2023-03-01', 4339000, '017', '616', 4339000, 0, 'A', NULL, 'FCTIONAIRE', '616'),
(157, '018MTB1160740001', '0101801520955040033', 'ADJE KOUASSI MARTIAL', NULL, 'HOUEKE GBO / MS ADJE 95791606  BENIN', NULL, '1978-10-08', 'M', 'M', '42443', NULL, NULL, '2016-03-14', '2023-03-14', 7908000, '018', '664', 7908000, 0, 'A', NULL, 'ENSEIGNANT', '664'),
(158, '018MTB1160680001', '0101801520956977040', 'TISSOUN NICODEME', NULL, 'BP  0022996708324 C SB SEME AB CALAVI', NULL, '1990-01-01', 'M', 'M', '42437', NULL, NULL, '2016-03-08', '2023-03-08', 1600000, '018', '664', 1600000, 0, 'A', NULL, 'OTHERS', '664'),
(159, '018STB1160610002', '0101801510952491039', 'STE SAINT PAUL SARL', NULL, 'LOT 4 PARCELLE D 05 BP 1228 COTONOU 90016261 21339625 96378187 SEME PODJI', NULL, '2036-02-05', NULL, 'M', '42430', NULL, NULL, '2016-03-01', '2016-06-29', 7835000, '018', '409', 7835000, 0, 'A', NULL, 'SOCIETE', '409'),
(160, '000STB1160830001', '0100001510001788034', 'SIGMA 2 - SA', NULL, 'C/1514 D VEDOKO TEL 95 96 66 99 / 95 05 87 30 01 BP 3354 RECETTE PRINCIPALE BENIN', NULL, '2036-02-05', NULL, 'M', '42452', NULL, NULL, '2016-03-23', '2017-03-23', 20000000, '000', '324', 20000000, 0, 'A', NULL, 'SOCIETE', '324'),
(161, '000MTB1160700003', '0100001520100612034', 'GBADAMASSI ISLAMIYAT', NULL, 'DIAMOND BANK BENIN 01 BP 955 RP COT 97 93 42 47 COTONOU', NULL, '1985-09-29', 'F', 'M', '42439', NULL, NULL, '2016-03-10', '2019-09-24', 3500000, '000', '337', 3500000, 0, 'A', NULL, 'STAFF', '337'),
(162, '000STB2160700006', '0100001510104615026', 'GNAGLI MONDEA JEANNE', NULL, 'BP mjoli1212@gmail.com 22964449743 22967770502 LOT 2027 QT ZOGBOHOUE', NULL, '1990-12-12', 'F', 'M', '42439', NULL, NULL, '2016-03-10', '2016-09-24', 590000, '000', '769', 590000, 0, 'A', NULL, 'STAFF', '769'),
(163, '000MTB1160700002', '0100001520090080049', 'LAWANI MOUHEMED', NULL, 'DIAMOND BANK BENIN S.A. 01 BP 955 RP COTONOU TEL: 21 31 79 27 BENIN', NULL, '1982-09-23', 'M', 'M', '42439', NULL, NULL, '2016-03-10', '2019-03-24', 1500000, '000', '769', 1500000, 0, 'A', NULL, 'STAFF', '769'),
(164, '001MTB1160760001', '0100101520154773034', 'WEMENOU CHARLES JAME', NULL, 'BP  22995275221 LOT 2089 QT MENONTIN', NULL, '1972-12-21', 'M', 'M', '42445', NULL, NULL, '2016-03-16', '2023-03-16', 4433000, '001', '608', 4433000, 0, 'A', NULL, 'OTHERS', '608'),
(165, '004MMD1160710001', '0100401700950003022', 'TRESOR PUBLIC - BURK', NULL, 'OUAGADOUDOU   BURKINA-FASO', NULL, '2036-02-05', NULL, 'M', '42440', NULL, NULL, '2016-03-11', '2018-03-09', 1000000000, '004', '15', 1000000000, 0, 'A', NULL, 'BKETRANG', '15'),
(166, '004MMPI160740001', '0100401680950384019', 'ORABANK BENIN PIB', NULL, 'BENIN BENIN BENIN BENIN', NULL, '2036-02-05', NULL, NULL, '42443', NULL, NULL, '2016-03-14', '2016-03-28', 2000000000, '004', '15', 2000000000, 0, 'A', NULL, 'BKETRANG', '15'),
(167, '005STB1160810001', '0100501510062210028', 'STE CAT LOGISTICS BE', NULL, 'C/ 0059 M 1ERE RUE TEL 21 31 05 96 / 90 02 98 87 01 BP 00938 COTONOU COTONOU', NULL, '2036-02-05', NULL, 'M', '42450', NULL, NULL, '2016-03-21', '2016-06-21', 345000000, '005', '019-INT', 345000000, 0, 'A', NULL, 'SOCIETE', '019-INT'),
(168, '007STB1160830001', '0100701510081207040', 'STE AIR S.A', NULL, 'M/S ABOUDOU RASSAKI QT KPEBIE BP 319 PARAKOU TEL 23612185 societeair@yahoo.fr', NULL, '2036-02-05', NULL, 'M', '42452', NULL, NULL, '2016-03-23', '2016-06-23', 57000000, '007', '313', 57000000, 0, 'A', NULL, 'SOCIETE', '313'),
(169, '007STB2160740002', '0100701510080484029', 'ETS LE TROPICAL SERV', NULL, '02 BP 837 PARAKOU TEL 97893277 /95486594  ', NULL, '2036-02-05', NULL, 'M', '42443', NULL, NULL, '2016-03-14', '2016-07-14', 30000000, '007', '408', 30000000, 0, 'A', NULL, 'ETABLIS', '408'),
(170, '010MTB1160710002', '0101001520501228058', 'DJISSOU DOSSA JESOUG', NULL, 'TOKPOTA Z. P/NOVO  97947165 BENIN', NULL, '1980-12-13', 'M', 'M', '42440', NULL, NULL, '2016-03-11', '2023-03-11', 3190000, '010', '690', 3190000, 0, 'A', NULL, 'FCTIONAIRE', '690'),
(171, '010MTB1160740001', '0101001520501512040', 'DAMITONKOU ODILE', NULL, 'GUEVIE DJEGANTO P/N  97144682 BENIN', NULL, '1986-01-08', 'F', 'M', '42443', NULL, NULL, '2016-03-14', '2021-03-14', 2180000, '010', '690', 2180000, 0, 'A', NULL, 'FCTIONAIRE', '690'),
(172, '012STB1160670001', '0101201510037521017', 'STE YULIN SARL', NULL, 'VEHOU C SB TEL 66 45 76 55 BOHICON BENIN', NULL, '2036-02-05', NULL, 'M', '42436', NULL, NULL, '2016-03-07', '2016-07-07', 52200000, '012', '146-INT', 52200000, 0, 'A', NULL, 'COMMERCANT', '146-INT'),
(173, '013MTB1160760003', '0101301520651479043', 'AGBAKOU BIDOSSESSI F', NULL, 'HEZONHO BOHICON BP 460 BOHICON TEL: 96147368 BENIN', NULL, '1985-02-27', 'F', 'M', '42445', NULL, NULL, '2016-03-16', '2023-03-16', 1360000, '013', '725', 1360000, 0, 'A', NULL, 'ENSEIGNANT', '725'),
(174, '013MTB1160680002', '0101301520018364045', 'BADJI ARNAUD MARIUS', NULL, 'HEZONHO BOHICON M/S KPOHOUEGBE TEL: 95-40-64-56  BENIN', NULL, '1974-01-16', 'M', 'M', '42437', NULL, NULL, '2016-03-08', '2023-03-08', 4158000, '013', '383', 4158000, 0, 'A', NULL, 'ENSEIGNANT', '383'),
(175, '013MTB1160640002', '0101301520654805041', 'DOVONOU OLGA', NULL, 'BP  22964762069 HEZONHO BOHICON', NULL, '1983-02-11', 'F', 'M', '42433', NULL, NULL, '2016-03-04', '2023-03-04', 3025000, '013', '725', 3025000, 0, 'A', NULL, 'ENSEIGNANT', '725'),
(176, '017STB1160740004', '0101701510901974027', 'QUALITY CORPORATE', NULL, 'COTONOU   COTONOU', NULL, '2036-02-05', NULL, 'M', '42443', NULL, NULL, '2016-03-14', '2017-03-14', 2681090, '017', '428', 2681090, 0, 'A', NULL, 'SOCIETE', '428');

-- --------------------------------------------------------

--
-- Structure de la table `typepret`
--

CREATE TABLE IF NOT EXISTS `typepret` (
  `idtypepret` int(20) NOT NULL AUTO_INCREMENT,
  `idbanque` int(40) NOT NULL,
  `libelle` varchar(20) NOT NULL DEFAULT 'Classique',
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtypepret`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `typepret`
--

INSERT INTO `typepret` (`idtypepret`, `idbanque`, `libelle`, `etat`) VALUES
(1, 23, 'Classique', 0),
(6, 27, 'Classique', 0),
(11, 28, 'Classique', 0);

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
  `idnomgroup` int(40) NOT NULL,
  `idbanque` int(40) DEFAULT NULL,
  `idagence` int(40) DEFAULT NULL,
  `droit` varchar(100) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

--
-- Contenu de la table `user_auth`
--

INSERT INTO `user_auth` (`uid`, `pseudo`, `name`, `surname`, `sexe`, `phone`, `fonction`, `email`, `password`, `etat`, `lastconnect`, `created`, `idnomgroup`, `idbanque`, `idagence`, `droit`, `action`) VALUES
(17, 'Gael', 'Gael', 'Amoussouvi', 'M', 69699588, 'Travail', 'gael@yahoo.fr', '$2a$10$db1a01017f53d72861f17ucz1nufv1RLX9H4ZRqMLLJGCZsGdRAsK', 'Actif', '2016-03-31 20:28:00', '2016-01-05 09:17:19', 2, 28, 20, 'banque', 'modification'),
(33, 'michel', 'DJOSSOU', 'MICHEL', 'M', 65000411, 'AGENT', 'mdjoss@saham.com', '$2a$10$3c5c94b1aae6cbe36b15bOABZr1qnAK9L7d5inco3zzYU1nXXXIO.', 'Actif', '2016-03-30 18:04:00', '2016-03-22 09:58:36', 2, 28, 19, 'banque', NULL),
(35, 'SMELENE', 'SESSOU', 'MELENE', 'F', 94952060, 'AGENT', 'smelene@gmail.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 25, 'banque', 'modification'),
(40, 'ISMAEL', 'PATTEY', 'ISMAEL', 'M', 65000408, 'AGENT', 'ismael.pattey@sahamassurance.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 21, 'banque', 'modification'),
(41, 'HERVE', 'HOUNKANRIN', 'HERVE', 'M', 96120534, 'AGENT', 'rinvher@yahoo.fr', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 28, 25, 'banque', 'modification'),
(42, 'MDJOSSOU', 'DJOSSOU', 'DJOSSOU', 'M', 97415230, 'AGENT', 'michel.djossou@sahamsurance.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 19, 'banque', 'modification'),
(43, 'BADJAGAN', 'ADJAGAN', 'BRICE', 'M', 67753464, 'AGENT', 'badjagan@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 38, 'banque', 'modification'),
(44, 'MALAO', 'ALAO', 'MALKATH', 'M', 61339442, 'AGENT', 'malao@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 24, 'banque', 'modification'),
(45, 'FADOUGAN', 'ADOUGAN', 'FIDELIA', 'M', 97728771, 'AGENT', 'fadougan@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 38, 'banque', 'modification'),
(46, 'NSIDIBE', 'SIDIBE', 'NADIATOU', 'F', 97883238, 'AGENT', 'nsidibe@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 28, 'banque', 'modification'),
(47, 'RGUEDEGBE', 'GUEDEGBE', 'A. ROMEO', 'M', 97470213, 'AGENT', 'rguedegbe@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 24, 'banque', 'modification'),
(48, 'MKOUCHOKEHO', 'KOUCHOKEHO', 'MARCELLIN', 'M', 96038007, 'AGENT', 'mkouchokeho@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 32, 'banque', 'modification'),
(49, 'ARMEL', 'ASSOGBA', 'ARMEL', 'M', 66628850, 'AGENT', 'aassogba@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 40, 'banque', 'modification'),
(50, 'SAMOUSSOU', 'AMOUSSOU', 'SYLVAIN', 'M', 97272437, 'AGENT', 'samoussou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 25, 'banque', 'modification'),
(51, 'SKUSHINA', 'KUSHINA', 'SUNDAY', 'M', 67066670, 'AGENT', 'skushina@daimondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 30, 'banque', 'modification'),
(52, 'IDOSSOU', 'DOSSOU', 'ISABELLE', 'F', 97638495, 'AGENT', 'idossou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 19, 'banque', 'modification'),
(53, 'FIDELIA', 'ADOUGAN', 'FIDELIA', 'F', 97728771, 'AGENT', 'fadougan@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 38, 'banque', 'modification'),
(54, 'PNJOKU', 'NJOKU', 'PRINCE CHINEDU', 'M', 66148417, 'AGENT', 'pnjoku2@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 30, 'banque', 'modification'),
(55, 'ERIC', 'AHANNOUTIN', 'ERIC', 'M', 96969825, 'AGENT', 'eahannoutin@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 29, 'banque', 'modification'),
(56, 'HOUETO', 'HOUETO', 'SOCRATE', 'M', 96130045, 'AGENT', 'shoueto@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 29, 'banque', 'modification'),
(57, 'OEZE2', 'EZE', 'OGECHI', 'M', 97777688, 'AGENT', 'oeze2@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 22, 'banque', 'modification'),
(58, 'OUOROU', 'OUOROU', 'ABDEL KABIR', 'M', 96003078, 'AGENT', 'aourou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 26, 'banque', 'modification'),
(59, 'ATOLLO', 'TOLLO', 'ARSENE', 'M', 97000000, 'AGENT', 'atollo@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 28, 'banque', 'modification'),
(60, 'ST?PHANE', 'NONTONWANOU', 'STEPHANE', 'M', 97614256, 'AGENT', 'snontonwanou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 36, 'banque', 'modification'),
(61, 'EOLERU', 'OLERU', 'ELSIE', 'M', 62314978, 'AGENT', 'eoleru@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 38, 'banque', 'modification'),
(62, 'CBOTON', 'BOTON', 'CORNEILLE', 'M', 96722262, 'AGENT', 'cboton@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 28, 'banque', 'modification'),
(63, 'NDAOUDOU', 'DAOUDOU', 'NATHAN', 'M', 97833579, 'AGENT', 'ndaoudou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 33, 'banque', 'modification'),
(64, 'NOFOEGBU', 'OFOEGBU', 'COLETTE', 'F', 97073616, 'AGENT', 'nofoegbu@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 21, 'banque', 'modification'),
(65, 'ADOUKLOUI', 'DOUKLOUI', 'ANNE', 'F', 61564456, 'AGENT', 'adoukloui@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 22, 'banque', 'modification'),
(66, 'BDJOSSOU', 'DJOSSOU', 'BERENGER', 'M', 96550360, 'AGENT', 'bdjossou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 20, 'banque', 'modification'),
(67, 'ASALAMI', 'SALAMI', 'ABDEL HAFEZ', 'M', 97652953, 'AGENT', 'asalami@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 25, 'banque', 'modification'),
(68, 'BFELIHO', 'FELIHO', 'BRICE', 'M', 96146283, 'AGENT', 'bfeliho@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 35, 'banque', 'modification'),
(69, 'FAGBOGLO', 'AGBOGLO', 'FREDERIC', 'M', 97919138, 'AGENT', 'fagboglo@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 22, 'banque', 'modification'),
(70, 'DADJOMAI', 'ADJOMAI', 'DERRICK TODOME', 'M', 96003905, 'AGENT', 'dadjomai@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 31, 'banque', 'modification'),
(71, 'HAFEZ', 'SALAMI', 'ABDEL HAFEZ', 'M', 97826550, 'AGENT', 'asalami@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 25, 'banque', 'modification'),
(72, 'AMOUSSOU', 'AMOUSSOU', 'SYLVAIN', 'M', 97272437, 'AGENT', 'samoussou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 25, 'banque', 'modification'),
(73, 'UBIDE', 'BIDE', 'ULRICH', 'M', 67755520, 'AGENT', 'ubide@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 20, 'banque', 'modification'),
(74, 'RAGOINON', 'AGOINON', 'GUY ROGER', 'M', 96149226, 'AGENT', 'gagoinon@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 34, 'banque', 'modification'),
(75, 'SATTADE', 'ATTADE', 'SYLVESTRE', 'M', 97073751, 'AGENT', 'sattade@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 32, 'banque', 'modification'),
(76, 'MBA', 'MBA', 'GEORGES', 'M', 97594041, 'AGENT', 'gmba@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 40, 'banque', 'modification'),
(77, 'ENOCK', 'ASSOGBA', 'ENOCK SEGLA', 'M', 97330247, 'AGENT', 'sassogba@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 27, 'banque', 'modification'),
(78, 'FOLOWO', 'OLOWO', 'FULGENCE', 'M', 97072281, 'AGENT', 'folowo@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 30, 'banque', 'modification'),
(79, 'STEPHANE', 'NONTONWANOU', 'STEPHANE', 'M', 97614256, 'AGENT', 'snontonwanou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 36, 'banque', 'modification'),
(80, 'CONYEWUCHI', 'ONYEWUCHI', 'CHIKWENDU', 'M', 96554306, 'AGENT', 'conyewuchi@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 38, 'banque', 'modification'),
(81, 'IKLOTOE', 'KLOTOE', 'INNOCENTIA', 'F', 62787212, 'AGENT', 'iklotoe@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 28, 'banque', 'modification'),
(82, 'FHOUAGA', 'HOUAGA', 'FRANCINE', 'F', 97652480, 'AGENT', 'fhouaga@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 28, 'banque', 'modification'),
(83, 'PKOUGBLENOU', 'KOUGBLENOU', 'PEGGY', 'M', 97379541, 'AGENT', 'pkougblenou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 21, 'banque', 'modification'),
(84, 'GHOUNNONTIIN', 'HOUNNONTIN', 'GREATH', 'M', 96351373, 'AGENT', 'ghounnontin@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 40, 'banque', 'modification'),
(85, 'CATOUVOEFOUN', 'ATOUVOEFOUN', 'CYBELE', 'M', 61011942, 'AGENT', 'catouvoefoun@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 33, 'banque', 'modification'),
(86, 'BDEGBOE', 'DEGBOE', 'A. BRICE WILFRIED', 'M', 97135927, 'AGENT', 'bdegboe@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 28, 'banque', 'modification'),
(87, 'PHOUESSOU', 'HOUESSOU', 'PATRICE', 'M', 97588018, 'AGENT', 'phouessou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 21, 'banque', 'modification'),
(88, 'OEZE', 'EZE', 'OGECHI', 'M', 97777688, 'AGENT', 'oeze2@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 22, 'banque', 'modification'),
(89, 'NADIATOU', 'SIDIBE', 'NADIATOU', 'F', 97883238, 'AGENT', 'nsidibe@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 28, 'banque', 'modification'),
(90, 'LATOUNDJI', 'LATOUNDJI', 'YASMINATH', 'F', 97888194, 'AGENT', 'ylatoundji@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 36, 'banque', 'modification'),
(91, 'PEGGY', 'KOUGBLENOU', 'PEGGY', 'M', 97379541, 'AGENT', 'pkougblenou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 21, 'banque', 'modification'),
(92, 'ELAVAGBE', 'lavagbe', 'ELISABETH', 'F', 96730949, 'AGENT', 'elavagbe@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 24, 'banque', 'modification'),
(93, 'ETAMADAHO', 'TAMADAHO', 'EDGUARD', 'M', 64686060, 'AGENT', 'etamdaho@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 39, 'banque', 'modification'),
(94, 'EAHOMAGNON', 'AHOMAGNON', 'EUDES', 'M', 96130478, 'AGENT', 'eahomagnon@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 20, 'banque', 'modification'),
(95, 'CTCHOKPONHOUE', 'TCHOKPONHOUE', 'CHRISTIAN', 'M', 66412358, 'AGENT', 'ctchokponhoue@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 19, 'banque', 'modification'),
(96, 'AOUOROU', 'OUOROU', 'ABDEL KABIR', 'M', 96003078, 'AGENT', 'aouorou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 26, 'banque', 'modification'),
(97, 'AAKOGBEKAN', 'AKOGBEKAN', 'ARMEL', 'M', 97333560, 'AGENT', 'aakogbekan@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 23, 'banque', 'modification'),
(98, 'HDAHAGBETO', 'DAHAGBETO', 'HERMANE MAHOUGNON', 'M', 65000446, 'AGENT', 'manedh@yahoo.fr', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 38, 'banque', 'modification'),
(99, 'ICODJO', 'CODJO', 'IGOR', 'M', 97196411, 'AGENT', 'icodjo@diamondbank.com', '$2a$10$850b419d7c232600b9c09eFAh5HUhDYxO5L3qh.UhPlPnxVJWaGT6', 'Actif', '2016-03-31 16:20:00', '0000-00-00 00:00:00', 35, 28, 19, 'banque', 'modification'),
(100, 'CANDIDE', 'AZONHOUMON DANSI', 'CANDIDE', 'M', 97464878, 'AGENT', 'cazonhoumon@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 38, 'banque', 'modification'),
(101, 'CHRISTIAN3', 'TCHOKPONHOUE', 'CHRISTIAN', 'M', 66412358, 'AGENT', 'ctchokponhoue@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 19, 'banque', 'modification'),
(102, 'GAGOINON', 'AGOINON', 'GUY ROGER', 'M', 96149226, 'AGENT', 'gagoinon@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 21, 'banque', 'modification'),
(103, 'MALKATH', 'ALAO', 'MALKATH', 'M', 61339442, 'AGENT', 'malao@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 24, 'banque', 'modification'),
(104, 'AOLOUDE', 'OLOUDE', 'AMOUDATH', 'F', 97048277, 'AGENT', 'aoloude@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 32, 'banque', 'modification'),
(105, 'YBAWA', 'BAWA', 'YASMINE', 'F', 97342222, 'AGENT', 'ybawa@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 40, 'banque', 'modification'),
(106, 'GMBA', 'MBA', 'GEORGE', 'M', 97594041, 'AGENT', 'gmba@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 40, 'banque', 'modification'),
(107, 'GHOUNNONTIN', 'HOUNNONTIN', 'GREATH', 'M', 96351373, 'AGENT', 'ghounnontin@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 40, 'banque', 'modification'),
(108, 'YLATOUNDJI', 'LATOUNDJI', 'YASMINATH', 'F', 97888194, 'AGENT', 'ylatoundji@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 36, 'banque', 'modification'),
(109, 'EAKPOVO', 'AKPOVO AHOSSI', 'ELVIRE', 'F', 95050441, 'AGENT', 'eakpovo@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 25, 'banque', 'modification'),
(110, 'DSEKLOKA', 'SEKLOKA', 'DIANE', 'F', 97681570, 'AGENT', 'dsekloka@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 25, 'banque', 'modification'),
(111, 'VHOUANSOU', 'HOUANSOU', 'VIRGINIE', 'F', 97583192, 'AGENT', 'vhounsou@diamondbank.co', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 20, 'banque', 'modification'),
(112, 'ELOKO', 'LOKO AKPAKPA', 'ERIC', 'M', 97214381, 'AGENT', 'eloko@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 25, 'banque', 'modification'),
(113, 'OPOGNON', 'POGNON', 'OSSEINE ARMEL E.', 'M', 95942949, 'AGENT', 'opognon@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 36, 'banque', 'modification'),
(114, 'AYEBOUROU', 'YEBOUROU', 'ALIDA G. E.', 'F', 66362000, 'AGENT', 'ayebourou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 23, 'banque', 'modification'),
(115, 'CAZONHOUMON', 'AZONHOUMON DANSI', 'CANDIDE', 'M', 97464878, 'AGENT', 'cazonhoumon@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 38, 'banque', 'modification'),
(116, 'JDOSSOU', 'DOSSOU', 'JEAN-MARC', 'M', 97165749, 'AGENT', 'jdossou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 36, 'banque', 'modification'),
(117, 'EDANSOU', 'DANSOU', 'EDMOND GODONOU', 'M', 97136641, 'AGENT', 'edansou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 23, 'banque', 'modification'),
(118, 'FWONGLA', 'WONGLA', 'FLORA', 'M', 97819696, 'AGENT', 'fwongla@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 28, 'banque', 'modification'),
(119, 'AGLELE', 'GLELE', 'ARIELLE', 'F', 97374849, 'AGENT', 'aglele@diamonbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 28, 'banque', 'modification'),
(120, 'GEORGE', 'MBA', 'GEORGE', 'M', 97594041, 'AGENT', 'gmba@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 40, 'banque', 'modification'),
(121, 'TODOME', 'ADJOMAI', 'DERRICK TODOME', 'M', 96003905, 'AGENT', 'dadjomai@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 31, 'banque', 'modification'),
(122, 'ABDEL', 'SALAMI', 'ABDEL HAFEZ', 'M', 97826550, 'AGENT', 'asalami@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 25, 'banque', 'modification'),
(123, 'NMOUSSA', 'MOUSSA BORO', 'NAZIROU', 'M', 67733480, 'AGENT', 'nmoussa@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 27, 'banque', 'modification'),
(124, 'ELSIE', 'OLERU', 'UGOCHI ELSIE', 'M', 62314978, 'AGENT', 'eoleru@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 38, 'banque', 'modification'),
(125, 'SINA', 'SAMIR', 'SINA', 'M', 97125326, 'AGENT', 'asina@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 27, 'banque', 'modification'),
(126, 'TFANOU', 'FANOU', 'THOMAS', 'M', 97729292, 'AGENT', 'tfanou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 25, 'banque', 'modification'),
(127, 'LIZ', 'LAVAGBE', 'ELISABETH', 'F', 96730949, 'AGENT', 'elavagbe@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 24, 'banque', 'modification'),
(128, 'NBOKOSSA', 'BOKOSSA', 'NADINE CHIMENE M.', 'M', 97123496, 'AGENT', 'nbokossa@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 38, 'banque', 'modification'),
(129, 'MHOUNGBEDJI', 'HOUNGBEDJI', 'PIERRETTE', 'F', 96697026, 'AGENT', 'phoungbedji@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 33, 'banque', 'modification'),
(130, 'CAIDOMEHOU', 'AHIDOMEHOU', 'CRISTEL', 'M', 97539656, 'AGENT', 'caidomehou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 20, 'banque', 'modification'),
(131, 'INNOCENTIA', 'KLOTOE', 'INNOCENTIA', 'F', 62787212, 'AGENT', 'iklotoe@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 28, 'banque', 'modification'),
(132, 'FTOKPO', 'TOKPO', 'FREDEMICH', 'M', 95522880, 'AGENT', 'ftokpo@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 23, 'banque', 'modification'),
(133, 'MARCELLIN', 'KOUCHOKEHO', 'MARCELLIN', 'M', 96038007, 'AGENT', 'mkouchokeho@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 32, 'banque', 'modification'),
(134, 'CDEGBOE', 'DEGBOE', 'CENTURION', 'M', 96585006, 'AGENT', 'cdegboe@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 36, 'banque', 'modification'),
(135, 'DERRICK', 'ADJOMAI', 'DERRICK', 'M', 96003905, 'AGENT', 'dadjomai@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 31, 'banque', 'modification'),
(136, 'ALAO', 'ALAO', 'MALKATH', 'M', 97534360, 'AGENT', 'malao@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 24, 'banque', 'modification'),
(137, 'MARYSE', 'TOHOU', 'MARYSE', 'M', 67224343, 'AGENT', 'mtohou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 35, 'banque', 'modification'),
(138, 'PSENOU', 'SENOU', 'PAMPHILE', 'M', 97171314, 'AGENT', 'psenou@diamondbank.com', 'saham', 'Actif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 28, 39, 'banque', 'modification');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
