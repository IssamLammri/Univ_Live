-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 04, 2018 at 06:28 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pfe`
--

-- --------------------------------------------------------

--
-- Table structure for table `annee`
--

DROP TABLE IF EXISTS `annee`;
CREATE TABLE IF NOT EXISTS `annee` (
  `ID_ANNE` int(50) NOT NULL AUTO_INCREMENT,
  `ANNEE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NOMBRE_SEMSTRE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_ANNE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `chef_departement`
--

DROP TABLE IF EXISTS `chef_departement`;
CREATE TABLE IF NOT EXISTS `chef_departement` (
  `CODE_CHEF_DEPT` int(50) NOT NULL AUTO_INCREMENT,
  `CODE_DEPT` int(11) NOT NULL,
  `PSEUDO` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PASSWORD` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NOM_CHEF` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PRENOM_CHEF` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SPECIALITE_CHEF` int(11) DEFAULT NULL,
  `GRADE_CHEF` int(50) DEFAULT NULL,
  `EMAIL_CHEF` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `TELE_CHEF` bigint(20) DEFAULT NULL,
  `IMAGE_CHEF` text COLLATE utf8_bin,
  `ETAT` varchar(50) COLLATE utf8_bin DEFAULT 'Chef Departement',
  PRIMARY KEY (`CODE_CHEF_DEPT`),
  UNIQUE KEY `PSEUDO` (`PSEUDO`),
  KEY `FK_ADMINISTRE2` (`CODE_DEPT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `commentaiire`
--

DROP TABLE IF EXISTS `commentaiire`;
CREATE TABLE IF NOT EXISTS `commentaiire` (
  `code_comment` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_FIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `UDER` int(11) DEFAULT NULL,
  `TYPE` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Date_comment` date NOT NULL,
  `time_comment` time DEFAULT NULL,
  PRIMARY KEY (`code_comment`),
  KEY `CODE_FIL` (`CODE_FIL`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `commentaiire`
--

INSERT INTO `commentaiire` (`code_comment`, `CODE_FIL`, `comment`, `UDER`, `TYPE`, `Date_comment`, `time_comment`) VALUES
(1, 'F2', 'aa', 2, 'CORDFIL', '2018-03-27', '02:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `commentaiireens`
--

DROP TABLE IF EXISTS `commentaiireens`;
CREATE TABLE IF NOT EXISTS `commentaiireens` (
  `code_comment` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_MAT` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `UDER` int(11) DEFAULT NULL,
  `TYPE` varchar(50) CHARACTER SET utf8 DEFAULT 'ENS',
  `Date_comment` date NOT NULL,
  `time_comment` time DEFAULT NULL,
  PRIMARY KEY (`code_comment`),
  KEY `CODE_MAT` (`CODE_MAT`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `commentaiireens`
--

INSERT INTO `commentaiireens` (`code_comment`, `CODE_MAT`, `comment`, `UDER`, `TYPE`, `Date_comment`, `time_comment`) VALUES
(1, 46, 'bonjour', 15, 'ENS', '2017-04-28', '12:27:15'),
(2, 46, '<script>window.alert(« test »)</script>', 15, 'ENS', '2017-05-02', '10:18:26'),
(3, 48, 'aa', 15, 'ENS', '2018-03-30', '01:23:31'),
(4, 47, 'matière 1', 15, 'ENS', '2018-03-30', '11:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `commentaiirereply`
--

DROP TABLE IF EXISTS `commentaiirereply`;
CREATE TABLE IF NOT EXISTS `commentaiirereply` (
  `code_reply` int(11) NOT NULL AUTO_INCREMENT,
  `code_comment` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `UDER` int(11) DEFAULT NULL,
  `TYPE` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Date_comment` date NOT NULL,
  `time_comment` time DEFAULT NULL,
  PRIMARY KEY (`code_reply`),
  KEY `code_comment` (`code_comment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `commentaiirereplyens`
--

DROP TABLE IF EXISTS `commentaiirereplyens`;
CREATE TABLE IF NOT EXISTS `commentaiirereplyens` (
  `code_reply` int(11) NOT NULL AUTO_INCREMENT,
  `code_comment` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `UDER` int(11) DEFAULT NULL,
  `TYPE` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Date_comment` date NOT NULL,
  `time_comment` time DEFAULT NULL,
  PRIMARY KEY (`code_reply`),
  KEY `code_comment` (`code_comment`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `commentaiirereplyens`
--

INSERT INTO `commentaiirereplyens` (`code_reply`, `code_comment`, `comment`, `UDER`, `TYPE`, `Date_comment`, `time_comment`) VALUES
(1, 1, 'haha', 15, 'ENS', '2017-04-28', '12:27:39'),
(2, 1, 'aaaa', 15, 'ENS', '2017-04-28', '12:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `commentlikedislike`
--

DROP TABLE IF EXISTS `commentlikedislike`;
CREATE TABLE IF NOT EXISTS `commentlikedislike` (
  `code_comment` int(11) NOT NULL,
  `UDER` int(11) NOT NULL,
  `TYPE` varchar(50) CHARACTER SET latin1 NOT NULL,
  `INDICE` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`code_comment`,`UDER`,`TYPE`),
  KEY `code_comment` (`code_comment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `commentlikedislike`
--

INSERT INTO `commentlikedislike` (`code_comment`, `UDER`, `TYPE`, `INDICE`) VALUES
(1, 2, 'CORDFIL', 2);

-- --------------------------------------------------------

--
-- Table structure for table `commentlikedislikeens`
--

DROP TABLE IF EXISTS `commentlikedislikeens`;
CREATE TABLE IF NOT EXISTS `commentlikedislikeens` (
  `code_comment` int(11) NOT NULL,
  `UDER` int(11) NOT NULL,
  `TYPE` varchar(50) CHARACTER SET latin1 NOT NULL,
  `INDICE` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`code_comment`,`UDER`,`TYPE`),
  KEY `code_comment` (`code_comment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `commentlikedislikeens`
--

INSERT INTO `commentlikedislikeens` (`code_comment`, `UDER`, `TYPE`, `INDICE`) VALUES
(1, 15, 'ENS', 0),
(3, 15, 'ENS', 2);

-- --------------------------------------------------------

--
-- Table structure for table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `CODE_COMP` int(10) NOT NULL AUTO_INCREMENT,
  `CODE_DOMAINE` int(11) DEFAULT NULL,
  `COMPETNECE` text COLLATE utf8_bin,
  `source_comp` enum('Académique','Annonces') COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`CODE_COMP`),
  UNIQUE KEY `keykey` (`COMPETNECE`(255)),
  KEY `CODE_DOMAINE` (`CODE_DOMAINE`)
) ENGINE=InnoDB AUTO_INCREMENT=1026 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `competence`
--

INSERT INTO `competence` (`CODE_COMP`, `CODE_DOMAINE`, `COMPETNECE`, `source_comp`) VALUES
(3, 1, 'Maîtriser le fonctionnement de l’Internet et de ses services, concevoir et développer des sites et des Web services', 'Académique'),
(4, 1, 'Culture d’entreprise, mathématiques, communications et langues', 'Académique'),
(5, 5, 'capable de gérer et communiquer', 'Académique'),
(6, 5, 'De communiquer avec son environnement en français', 'Académique'),
(7, 5, 'De communiquer avec son environnement en anglais', 'Académique'),
(8, 6, 'De Maîtriser les compétences liées à la gestion de projet', 'Académique'),
(9, 2, 'De comprendre l\'environnement de l\'entreprise et de ses spécificités métiers', 'Académique'),
(10, 6, 'Capable de rigueur et de méthodologie dans le travail', 'Académique'),
(12, 5, 'Capable de gérer le stress face à la pression', 'Académique'),
(15, 6, 'capable de gérer une équipe', 'Annonces'),
(16, 1, 'savoir les différents langages de programmation', 'Annonces'),
(20, 1, 'avoir l\'esprit de la programmation', 'Annonces'),
(21, 1, 'avoir l\'esprit de travailler en équipe', 'Annonces'),
(22, 1, 'capable d\'adapter facilement ', 'Annonces'),
(23, 1, 'Avoir le sens de l’engagement', 'Annonces'),
(24, 1, 'développement sur carte autonome Raspberry et doit également développer des compétences d\'automatisme industriels.', 'Annonces'),
(25, 22, 'Maitrise des composants véhicules.', 'Annonces'),
(26, 1, 'Connaissances en microinformatique', 'Annonces'),
(28, 5, 'Sens de l’organisation et conscience professionnelle.', 'Annonces'),
(29, 22, 'Avoir une base de connaissance en conception mécanique.', 'Annonces'),
(30, 17, 'Sécurité et environnement', 'Annonces'),
(31, 22, 'DUT ou équivalent en mécanique/fabrication mécanique/électromécanique.', 'Annonces'),
(98, 1, 'Respect des standards méthodologiques', 'Annonces'),
(99, 1, 'Planification des étapes d\'un plan d\'action', 'Annonces'),
(100, 5, 'Prospecter et conseiller les clients', 'Annonces'),
(101, 1, 'Vendre des produits informatiques afin d’atteindre les objectifs commerciaux fixés par la direction commerciale', 'Annonces'),
(102, 1, 'Aisance avec les outils informatique, organisation, rigeur, curiosité, dynamisme et esprit d\'équipe sont les atouts indispensables', 'Annonces'),
(103, 2, 'Comptabilité française est un atout', 'Annonces'),
(104, 7, 'Maitrise des bases informatiques (logiciels et applications bureautique)', 'Annonces'),
(105, 5, 'Très bonne aptitude à communiquer en berbère', 'Annonces'),
(106, 5, 'Dynamisme et sens de l’initiative', 'Annonces'),
(107, 1, 'MAITRISE DU BUREAUTIQUE', 'Annonces'),
(108, 1, 'SAISIE DES DOSSIERS ET CLASSEMENT.', 'Annonces'),
(109, 17, 'Bac +2 en Secrétariat', 'Annonces'),
(110, 6, 'Adaptation à la diversité des milieux d’enquête', 'Annonces'),
(111, 1, 'Compétences informatiques : Word, Powerpoint ,Photoshop, Indesign , Apple Keynote.', 'Annonces'),
(112, 1, 'Windows Server, PHP, HTML, develeppement web, windows XP,', 'Annonces'),
(113, 1, 'Windows Server , PHP , HTML , developpement , windows XP', 'Annonces'),
(114, 1, 'Autocad', 'Annonces'),
(115, 1, 'Compétences: Maitrise outil informatique, bon relationnel, Sens de l\'organisation', 'Annonces'),
(116, 7, 'Avoir au minimum un BAC+2 dans l’une des disciplines suivantes Economie Gestion Marketing Commerce Comptabilité ou Informatique', 'Annonces'),
(117, 1, 'base de données informatiques SAP SAGE NAVISION EXCEL FRANÇAIS ANGLAIS QUALITÉS: RIGUEUR ASSIDUITE PRECISION ACCUEIL COMMERCIAL AU TELEPHONE', 'Annonces'),
(118, 1, 'Compétences informatiques et de codage', 'Annonces'),
(119, 6, 'Compétences en gestion du temps et du projet', 'Annonces'),
(133, 6, 'Précision et attention aux détails.', 'Annonces'),
(134, 6, 'Approche professionnelle du temps, des couts et des détails.', 'Annonces'),
(135, 5, 'Maitrise parfaite de l’anglais.', 'Annonces'),
(136, 5, 'Compétences de communication verbales et écrites au téléphone et au clavier.', 'Annonces'),
(137, 1, 'topaz bureautique', 'Annonces'),
(138, 1, 'test unitaire et recette technique', 'Annonces'),
(139, 1, 'gestion des bases de données', 'Annonces'),
(140, 5, 'rédaction des documents techniques', 'Annonces'),
(141, 1, 'Etre titulaire d\'un diplôme de technicien ou technicien spécialisé en informatique', 'Annonces'),
(142, 5, 'Accueil téléphonique et physique des clients ', 'Annonces'),
(143, 11, 'Traiter les commandes des clients (création, traitement, suivi des nouvelles expéditions, facturation...)', 'Annonces'),
(144, 11, 'Suivre la clientèle (gérer les demandes d\'information, gérer les réclamations, faire le suivi commercial par téléphone auprès des clients...)', 'Annonces'),
(145, 11, 'Traiter les factures (relance, recouvrement ...)', 'Annonces'),
(146, 11, 'Etablir des devis pour certains clients', 'Annonces'),
(147, 11, 'Administrer la base clients', 'Annonces'),
(148, 1, 'Maitrise de l\'outil informatique', 'Annonces'),
(149, 11, 'La candidate doit faire la prospection commerciale par téléphone et prendre des RDV pour notre commercial', 'Annonces'),
(150, 11, 'Etudier les dossiers de fabrication et participer à la définition des méthodes de fabrication', 'Annonces'),
(151, 22, 'Vous avez un diplôme de mécanicien.', 'Annonces'),
(152, 6, 'Vous justifiez ans d’une expérience de 4 à 5 années dans le domaine technique (notamment dans les techniques de fabrication des produits électroménagers et la gestion des couts.', 'Annonces'),
(153, 6, 'Vous maitrisez les outils de l’informatique de gestion.', 'Annonces'),
(154, 5, 'Vous maitrisez la langue anglaise.', 'Annonces'),
(155, 6, 'GESTION ET MANUTENTION DES archives des dossiers de la mutuelle', 'Annonces'),
(156, 6, 'CANDIDAT MOTIVE POUR LE POSTE/ DISPONIBLE ET ORGANISE', 'Annonces'),
(157, 5, 'AYANT UNE BASE EN COMMUNICATION ECRITE', 'Annonces'),
(158, 1, 'MANIOPULANT INFORMATIQUE', 'Annonces'),
(159, 17, 'LAUREAT DE BAC OU PLUS', 'Annonces'),
(160, 17, 'CANDIDAT MOTIVE POUR LE POSTE / DISPONIBLE ET ORGANISE', 'Annonces'),
(161, 5, 'AYANT UNE BESE DE COMMUNICATION ECRITE', 'Annonces'),
(162, 1, 'MANIPULANT LOUTIL INFORMATIQUE', 'Annonces'),
(163, 17, 'CANDIDAT LAUREAT DE BAC OU PLUS', 'Annonces'),
(164, 17, 'MOTIVE POUR LE POSTE/ ORGANISE ET DISPONIBLE', 'Annonces'),
(165, 5, 'AYANT UNE BASE DE COMMUNICATION ECRITE', 'Annonces'),
(166, 1, 'MANIPULANT INFORMATIQUE', 'Annonces'),
(167, 6, 'Gestion des Eses ou Inf de Gestion', 'Annonces'),
(168, 7, 'TITULAIRE D\'UN DIPLOME EN L\'UNE DE CES SPECIALITES: GESTION DES ENTREPRISES  INFORMATIQUE DE GESTION ou COMPTABILITE.', 'Annonces'),
(169, 11, 'secrétaire d\'assurance', 'Annonces'),
(170, 1, 'Formation : Technicien spécialisé ,Développement Informatique', 'Annonces'),
(171, 17, 'Expérience professionnelle : (6 mois  1 an)', 'Annonces'),
(172, 19, 'Un Vrais Sens De Responsabilité et De Travail en Groupe ', 'Annonces'),
(173, 1, 'bonne connaissances des outils informatiques', 'Annonces'),
(174, 5, 'Formation supérieure (Bac+4 min) en Communication .', 'Annonces'),
(175, 17, 'Expérience minimum de 18 mois dans un poste similaire.', 'Annonces'),
(748, 5, 'Pratique courante du Français et Anglais tant à l’écrit qu’à l’oral (certifications à l’appui)', 'Annonces'),
(749, 1, 'Maintenance du parc informatique (instalation, mise à jour des logiciels), suivie et developpement du site web, sauvegarde des donnés', 'Annonces'),
(750, 17, 'Experience dans le domaine du métier', 'Annonces'),
(751, 1, 'Bonne maitrise de l\'outil informatique', 'Annonces'),
(752, 5, 'Trés bonne presentation.', 'Annonces'),
(753, 17, 'Diplôme technicien ', 'Annonces'),
(754, 18, 'Mener des missions d’audits de sécurité technique des SI selon les standards et référentiels qu’OWASP, OSSTMM, CISCAT, ISO 27001 ', 'Annonces'),
(755, 18, 'Ingénieur ou Master en sécurité SI.', 'Annonces'),
(756, 18, 'Au minimum 1 année d’expérience justifiée en audits techniques de la sécurité des SI dans l’accompagnement à la mise en place des recommandations.', 'Annonces'),
(757, 1, 'Une expérience dans l’audit de l’équipement SWIFT.', 'Annonces'),
(758, 18, 'Des connaissances dans l’implémentation de référentiels de sécurité tel qu’OWASP, OSSTMM, CISCAT, ISO 27001, et PCIDSS.', 'Annonces'),
(759, 24, 'Des connaissances dans la réalisation des tests d’intrusion, audit de configuration, audit d’architecture, audit mobile et revue de code sécuritaire', 'Annonces'),
(760, 23, 'Vous avez un diplôme ou un Master en SI spécialité réseau et télécommunication (d’un établissement public ou d’un établissement privé agrée).', 'Annonces'),
(761, 23, 'Vous êtes certifié Cisco CCNA.', 'Annonces'),
(762, 23, 'Vous avez 5 années d’expérience justifiées au minimum en audits techniques de la sécurité des SI et dans l’accompagnement à la mise en place des recommandations.', 'Annonces'),
(763, 7, 'Vous avez un Bac+5 en ingénierie d’affaires ou équivalent.', 'Annonces'),
(764, 19, 'Vous êtes doté des qualités : Écoute active, organisé, rigoureux, créatif, dynamique, autonome, aisance relationnelle. Vous avez un Bac+5 en ingénierie d’affaires ou équivalent.', 'Annonces'),
(765, 19, 'Vous êtes doté des qualités : Écoute active, organisé, rigoureux, créatif, dynamique, autonome, aisance relationnelle.', 'Annonces'),
(766, 17, 'Expérience professionnelle : (3 ans  5 ans)', 'Annonces'),
(767, 1, 'DISCIPLINE  TRAVAIL EN EQUIPE  SÉRIEUSE  CONNAISSANCE DE TRAVAIL d\'aSSISTANTE ET AUSSI L\'INFORMATIQUE', 'Annonces'),
(768, 12, 'RECEPTION ASSISTANTE MEDICALE ', 'Annonces'),
(769, 5, 'Une bonne communication', 'Annonces'),
(770, 1, 'une bonne maitrise de l\'outil informatique', 'Annonces'),
(771, 11, 'Une bonne gestion des appels telephoniques', 'Annonces'),
(772, 11, 'Une bonne gestion des taches de secretariat', 'Annonces'),
(773, 1, 'Dessinateur DAO Technicien topographe.', 'Annonces'),
(774, 1, 'développeur de bac+3 et plus bonne maîtrise des environnements Visual Studio, .Net MVC, et Sql Serveur bonne maîtrise des langages : C#, PHP, JS, CSS', 'Annonces'),
(775, 11, 'Mission: Saisie  Classement  Appels Téléphoniques', 'Annonces'),
(776, 1, 'technicien informaticien pour maintenance informatique.', 'Annonces'),
(777, 1, 'Etre titulaire d\'un diplôme de technicien ou technicien spécialisé en informatique, porogrammation ou équivalent avec des connainssance en gestion commerciale ', 'Annonces'),
(778, 1, '\"Accueil téléphonique et physique des clients,Bonne maîtrise du français, Grand sens de communication et d\'initiative, Avec une bonne maîtrise des outils informatiques\"', 'Annonces'),
(779, 11, 'La candidate doit faire la prospection commerciale par téléphone et prendre des RDV pour notre commercial, elle doit également gérer le classement et recevoir les appels.', 'Annonces'),
(780, 7, 'Le poste peut évoluer en commerciale Terrain avec commission si satisfaction', 'Annonces'),
(781, 6, 'ORGANISE ET DISPONIBLE', 'Annonces'),
(782, 1, '\"Vous souhaitez participer au développement d\'un service récent et en pleine expansion', 'Annonces'),
(783, 17, 'Vous êtes autonome et force de proposition, et avez le sens de l\'organisation', 'Annonces'),
(784, 5, 'Une bonne maîtrise du français écrit est indispensable', 'Annonces'),
(785, 17, 'Vous êtes persévérant et dynamique, à la fois travailler en autonomie et en équipe, tout en vous adaptant à vos interlocuteurs', 'Annonces'),
(786, 1, 'travail en equipe, analyse des données, technique, informatique, experience exigé dans le domaine (traitemant de poisson)', 'Annonces'),
(810, 1, 'Écrire un programme informatique', 'Annonces'),
(811, 1, 'Apporter un soutien technique', 'Annonces'),
(812, 1, 'Des connaissances sans cesse à jour', 'Annonces'),
(813, 17, 'Rigueur et autonomie', 'Annonces'),
(814, 20, 'Formation en Réseau informatique Bac+3 ou plus.', 'Annonces'),
(815, 20, 'Bonne maitrise de la langue française.', 'Annonces'),
(816, 20, 'De formation Ingénieur en Réseaux et services mobiles.', 'Annonces'),
(817, 1, 'Maitrise de l’informatique, des systèmes d’exploitation (linux en particulier) et des outils de développement (Python/Django/GIT).', 'Annonces'),
(818, 1, 'Formation ODDO.', 'Annonces'),
(819, 11, 'Télécommunication (Serveur VOIP)', 'Annonces'),
(820, 17, 'Connaissances du marché de la région de l’afrique Subsaharienne.', 'Annonces'),
(821, 5, 'MAITRISANT L\'ANGLAIS ET LE FRANCAIS', 'Annonces'),
(822, 1, 'MAITRISANT l\'aDMINISTRATION RESEAU+PROTOCOLES ET BASE DE DONNEES.', 'Annonces'),
(823, 17, 'JUSTIFIANT d\'UNE EXPERIENCE PROBANTE DANS UN POSTE SIMILAIRE.', 'Annonces'),
(824, 1, 'Formation : titulaire d’un diplôme en ingénierie informatique et développement.', 'Annonces'),
(825, 17, 'Expérience : jouissant d’une expérience minimale de deux ans dans un poste similaire.', 'Annonces'),
(826, 1, 'Avoir un diplôme d’ingénieur d’état en informatique.', 'Annonces'),
(827, 6, 'Avoir une expérience dans la gestion de l’ERP ADCI ( les stages sont pris en considération).', 'Annonces'),
(828, 5, 'Avoir une bonne maitrise des langues : Anglais et Français.', 'Annonces'),
(829, 5, 'Vous avez une bonne maîtrise de la langue française, aussi bien à l’oral qu’à l’écrit', 'Annonces'),
(830, 1, 'Vous maîtrisez parfaitement l’outil informatique et l’internet,', 'Annonces'),
(831, 11, 'Vous avez un bon relationnel, une grande capacité d’écoute, et vous êtes doté(e) d’un excellent sens du service.', 'Annonces'),
(832, 11, 'Une première expérience dans un centre d’appel serait souhaitable.', 'Annonces'),
(833, 11, 'Assurer un service de qualité à travers l’outil téléphonique ou le courrier électronique en concordance avec la charte de traitement des requêtes client et les procédures de traitement des appels  email SMS lettre fax etc ,)', 'Annonces'),
(834, 5, 'Une parfaite maîtrise de la langue néerlandaise et une très bonne communication orale et écrite (Niveau natif).', 'Annonces'),
(835, 7, 'Un sens du diagnostic et de l\'analyse,', 'Annonces'),
(836, 1, 'Des connaissances en informatique', 'Annonces'),
(837, 11, 'Capacité à identifier rapidement les besoins clients.', 'Annonces'),
(838, 11, 'Approche client et forte capacité à convaincre.', 'Annonces'),
(839, 7, 'Une bonne fibre commerciale, de l’empathie, un sens d\'écoute et de la persuasion.', 'Annonces'),
(840, 11, 'Une précédente expérience en techniques d’assistance client et de vente sera un atout.', 'Annonces'),
(841, 17, 'Une personnalité motivée et enthousiaste.', 'Annonces'),
(842, 17, 'Vous êtes un technicien graphique.', 'Annonces'),
(843, 17, 'Vous justifiez d’une expérience de 2 années dans un poste similaire.', 'Annonces'),
(844, 17, 'la connaissance approfondie des spécificités des produits et des caractéristiques de l\'environnement d\'exploitation.', 'Annonces'),
(845, 1, 'Bien maîtriser les logiciels : Illustrator, Photoshop et les outils Microsoft Office', 'Annonces'),
(846, 1, 'Le candidat doit avoir un baccalaureat au minimum , notion en comptablité,outil informatique', 'Annonces'),
(847, 1, '(BAC + 5 ou plus) en systèmes réseau, et développement informatique.', 'Annonces'),
(848, 17, 'Au moins 10 mois d’expérience dans les domaines ', 'Annonces'),
(849, 1, 'Développement Web et applications', 'Annonces'),
(850, 20, 'Réseau Informatique – Télécom (centre d’appel).', 'Annonces'),
(851, 1, 'Avec GOAUTODIAL, ELASTIX, VOIPSWITCH.', 'Annonces'),
(852, 5, ' Maitrise parfaite du Français parlé et écrit', 'Annonces'),
(853, 5, 'Pratique assez courante de l’anglais parlé et écrit.', 'Annonces'),
(854, 7, 'COMMERCIAL TERRAIN DANS LE DOMAINE DU MATERIEL INFORMATIQUE BUREAUTIQUE ET FOURNITURES GENERALES DE BUREAU', 'Annonces'),
(855, 17, 'Résérvation', 'Annonces'),
(856, 7, 'Marketing hotelier', 'Annonces'),
(857, 1, 'Travail administrative (outil informatique)', 'Annonces'),
(858, 5, 'maîtrise du francais', 'Annonces'),
(859, 5, 'maîtrise de l\'anglais', 'Annonces'),
(860, 6, 'BAC+4 ou plus en gestion/économie', 'Annonces'),
(861, 1, 'Bonne maitrise de l\'outil informatique,', 'Annonces'),
(862, 6, 'Connaissances en management des entreprises, notamment en gestion des marchés', 'Annonces'),
(863, 17, 'Expérience de 2 ans dans un poste similaire.', 'Annonces'),
(864, 11, 'Accueil, orientation du client et vente des services de la Sté auprès de la clintèle, ainsi que les activités de gestion des guichets.', 'Annonces'),
(865, 11, 'saisie des entrées EXPEDITEUR et DESTINATAIRE sur l\'application.', 'Annonces'),
(866, 17, 'Gérer les recettes.', 'Annonces'),
(867, 7, 'Licence ou bac +2 en économie,gestion,droit,marketing,commerce,comptabilité ou informatique', 'Annonces'),
(868, 17, 'Expérience minimum 2 ans dans le domaine de recouvrement est souhaitable', 'Annonces'),
(869, 5, 'Français parfait à l\'écrit et l\'oral', 'Annonces'),
(870, 1, 'Bonne maitrise de l\'outil informatique(excell,word...) et courier éléctroniques', 'Annonces'),
(871, 5, 'Avoir le sens de communication,fibre commerciale et aisance relationnelle', 'Annonces'),
(872, 17, 'Esprit d\'initiative,autonomie,et dynamisme', 'Annonces'),
(873, 5, 'connaissance en matière du droit d\'auteur ainsi le domaine artistique et litèraire', 'Annonces'),
(874, 5, 'Vous êtes parfaitement bilingue : Néerlandais, Anglais.', 'Annonces'),
(875, 1, 'Vous avez de bonnes connaissances en informatique.', 'Annonces'),
(876, 5, 'Vous avez des connaissances de la culture et l’environnement néerlandais', 'Annonces'),
(877, 11, 'Vous êtes orienté service client, disponible et vous avez l’esprit d’équipe.', 'Annonces'),
(878, 17, 'Le profil souhaité est, soit une personne ayant déjà travaillé dans le domaine des assurances, soit une personne ayant un minimum de connaissances du droit.', 'Annonces'),
(880, 21, 'Le Cabinet est à même, pour une personne ayant la capacité de comprendre et d’apprendre, d’assurer une formation spécifique en interne.', 'Annonces'),
(881, 1, 'Gestion, installation et maintenance du matériel informatique (postes informatiques, périphériques)', 'Annonces'),
(882, 20, 'Administration et exploitation de quelques serveurs', 'Annonces'),
(883, 1, 'Aide à la gestion, installation et maintenance des logiciels', 'Annonces'),
(884, 1, 'Assistance et support technique (matériel et logiciel) auprès des utilisateurs', 'Annonces'),
(885, 1, 'Gestion des sauvegardes sur les applications et serveurs internes', 'Annonces'),
(886, 1, 'Présentation des ressources informatiques aux nouveaux utilisateurs', 'Annonces'),
(887, 1, 'Sensibilisation des utilisateurs sur la sécurité informatique et sur les règles de bonnes pratiques', 'Annonces'),
(888, 1, 'Aide à la gestion de la téléphonie sur IP, assistance aux utilisateurs et maintenance des installations', 'Annonces'),
(889, 1, 'Gestion et maintenance des installations de vidéoprojection et de visioconférence', 'Annonces'),
(890, 1, 'Assistance et support technique auprès des utilisateurs pour l’utilisation des installations de vidéo projection et de visioconférence.', 'Annonces'),
(891, 11, 'Conseiller le consommateur sur les produits et les services via les différents moyens (téléphone', 'Annonces'),
(892, 11, 'Offrir un soutien aux utilisateurs et leur fournir l’information requise sur les outils informatiques.', 'Annonces'),
(893, 1, 'Assurer le fonctionnement des outils informatiques et s’occuper de leur entretien.', 'Annonces'),
(894, 1, 'Signaler les anomalies ou les pannes dans le fonctionnement des équipements, apporter les solutions requises à une utilisation optimale.', 'Annonces'),
(895, 5, 'Tenir un journal de bord présentant un éventail de solutions et de conseils pour l’utilisation des outils informatiques.', 'Annonces'),
(896, 1, 'Assurer un service de qualité pour toutes les opérations informatiques.', 'Annonces'),
(897, 5, 'Vous êtes lauréate d’une école de journalisme', 'Annonces'),
(898, 17, 'Vous justifiez d’une expérience de2 ans', 'Annonces'),
(899, 6, 'BAC +2 à 4 en gestion des entreprises', 'Annonces'),
(900, 5, 'Français courant à l’oral et plus à l’écrit', 'Annonces'),
(901, 5, 'Bonne présentation aisance relationnelle', 'Annonces'),
(902, 17, 'Expérience de 2 ans minimum dans un poste similaire', 'Annonces'),
(903, 1, 'Maîtrise de l\'outil informatique (Wordexcelpower point....)', 'Annonces'),
(904, 7, 'Vous avez un Bac+5 d’une grande école de commerce spécialisé en Achats et Logistique ou en Commerce International ou équivalent', 'Annonces'),
(905, 17, 'Assurer le rebond commercial et atteindre l’objectif mensuel des ventes additionnelles', 'Annonces'),
(906, 5, 'Vous êtes parfaitement Trilingue : français, anglais, Espagnol (oral et écrit)', 'Annonces'),
(907, 1, 'Vous maitrisez le développement informatique vous permettant la mise en place des outils indispensables au reporting de vos activités.', 'Annonces'),
(908, 11, 'Supérviseur d\'une équipe', 'Annonces'),
(909, 11, 'Gestion d\'une équipe de travail', 'Annonces'),
(910, 6, 'éxpérience éxigé dans le domaine de gestion d\'une équipe', 'Annonces'),
(911, 6, 'porogrammation ou équivalent avec des connainssance en gestion commerciale ', 'Annonces'),
(912, 5, 'Bonne maîtrise du français', 'Annonces'),
(913, 11, 'elle doit également gérer le classement et recevoir les appels', 'Annonces'),
(914, 11, 'Traduire les éléments du cahier des charges en objectifs de production', 'Annonces'),
(915, 17, 'Le poste peut évoluer en commerciale Terrain avec commission si satisfaction Profile', 'Annonces'),
(916, 17, 'être résidant à la province de Taroudant', 'Annonces'),
(917, 17, 'Avoir une expérience professionnelle d\'un an au minimum dans un poste similaire', 'Annonces'),
(918, 5, 'Bonne présentation ', 'Annonces'),
(919, 5, 'la langue allemende est souhaitable', 'Annonces'),
(920, 7, 'Excellent sens commercial ', 'Annonces'),
(921, 5, 'Bon niveau de français à l\'écrit (rédaction des emails) et à l\'orale ', 'Annonces'),
(922, 5, 'Résoudre les problèmes techniques des abonnés  ', 'Annonces'),
(923, 1, 'Bonne maîtrise des outils informatique et bureautique', 'Annonces'),
(924, 5, 'Aisance relationnelle', 'Annonces'),
(925, 17, 'Lieu de résidence Ain Sebaa ou Sidi Bernoussi', 'Annonces'),
(926, 1, 'Maitrise de l\'outil informatique (AUTOCAD excel )', 'Annonces'),
(927, 1, 'Mener des missions d’audit de sécurité SWIFT', 'Annonces'),
(928, 1, 'Assurer les tâches de secrétariat ', 'Annonces'),
(929, 11, 'Accompagner les clients dans la mise en place des recommandations sécuritaires suite aux différents audits menés', 'Annonces'),
(930, 11, 'Capacité de lire les plans.', 'Annonces'),
(931, 20, 'Accompagner les clients dans leurs démarches de gestion des risques de sécurité des SI', 'Annonces'),
(932, 6, 'Participer à des missions d’étude et d’intégration de solutions de sécurité technique', 'Annonces'),
(933, 1, 'Accompagner les clients dans le développement sécuritaire et le déploiement de leurs applications critiques', 'Annonces'),
(934, 1, 'maîtrise de l\'outil informatique notamment la saisie', 'Annonces'),
(935, 1, 'Avoir une expérience dans le domaine de microfincance', 'Annonces'),
(936, 17, 'sens de responsabilité', 'Annonces'),
(937, 17, 'esprit d\'équipe', 'Annonces'),
(938, 17, 'Facturation ', 'Annonces'),
(939, 6, 'Gestion d\'approvisionnement ', 'Annonces'),
(940, 11, 'Technique De Secretariat ', 'Annonces'),
(941, 25, 'Gestion De Ressources Humaines  ', 'Annonces'),
(942, 5, 'Communication, Organisation Administrative  Réception  Communication Téléphoniques  Classement  ', 'Annonces'),
(943, 11, 'Suivi Des Situations Clients et Fournisseurs ', 'Annonces'),
(944, 11, 'Suivi Des Mouvements De La Banque Élaboration Des Devis, Des Bons De Commande, Des Bons De Livraison', 'Annonces'),
(945, 11, 'Gérer La Caisse Bonne maîtrise de l\'Outil Informatique et Aussi De l\'indispensable des Logiciels', 'Annonces'),
(946, 11, 'Déterminer les plans de charge : besoins en matières premières, pièces de soustraitance', 'Annonces'),
(947, 5, 'Grand sens de communication et d\'initiative', 'Annonces'),
(948, 1, 'Fixer les objectifs de production et contrôler le processus de fabrication', 'Annonces'),
(949, 1, 'Avec une bonne maîtrise des outils informatiques. Aisance relationnelle. ', 'Annonces'),
(950, 7, 'Suivre la réalisation des investissements selon le budget défini', 'Annonces'),
(951, 7, 'Garantir les couts, les délais d’intervention et contrôler la qualité de la production', 'Annonces'),
(955, 8, 'Déléguer aux subalternes', 'Annonces'),
(956, 8, 'Résoudre des problèmes', 'Annonces'),
(957, 8, 'Rédiger des documents et rapports', 'Annonces'),
(959, 8, 'Commander des fournitures', 'Annonces'),
(960, 8, 'Établir des procédures', 'Annonces'),
(961, 8, 'Calculer des sommes', 'Annonces'),
(962, 5, 'Négocier et arbitrer', 'Annonces'),
(963, 5, 'Établir des relations et former des réseaux', 'Annonces'),
(964, 5, 'Enseigner et former', 'Annonces'),
(965, 5, 'Communiquer de façon professionnelle', 'Annonces'),
(966, 5, 'Fournir des services-conseils et des consultations', 'Annonces'),
(967, 5, 'Promouvoir et vendre', 'Annonces'),
(968, 5, 'Interviewer', 'Annonces'),
(969, 6, 'Élaborer des stratégies', 'Annonces'),
(970, 6, 'Diriger et motiver', 'Annonces'),
(971, 6, 'Affecter et contrôler des ressources', 'Annonces'),
(972, 6, 'Évaluer', 'Annonces'),
(973, 6, 'Coordonner et organiser', 'Annonces'),
(974, 6, 'Recruter et embaucher', 'Annonces'),
(975, 6, 'Superviser', 'Annonces'),
(976, 9, 'Gérer de l’information', 'Annonces'),
(977, 9, 'Traiter de l’information', 'Annonces'),
(978, 10, 'Prévoir les résultats', 'Annonces'),
(979, 10, 'Rechercher et enquêter', 'Annonces'),
(980, 10, 'Planifier', 'Annonces'),
(981, 10, 'Examiner et diagnostiquer', 'Annonces'),
(982, 10, 'Analyser des renseignements', 'Annonces'),
(983, 10, 'Inspecter et faire des essais', 'Annonces'),
(984, 11, 'Accueillir de la clientèle et bien l’écouter', 'Annonces'),
(985, 11, 'Évaluer les besoins et suggérer des produits et services adaptés', 'Annonces'),
(986, 11, 'Sensibiliser les clients au traitement et à l’entretien de la marchandise', 'Annonces'),
(987, 11, 'Tenir la caisse (en espèces, cartes de débit et de crédit) et régler les retours', 'Annonces'),
(988, 12, 'Fournir des services de counseling et de soutien moral', 'Annonces'),
(989, 12, 'Traiter des personnes ou des animaux', 'Annonces'),
(990, 12, 'Fournir des services de protection et d’application de la loi', 'Annonces'),
(991, 12, 'Fournir des services à des tiers', 'Annonces'),
(992, 12, 'Préparer et servir des repas', 'Annonces'),
(993, 12, 'Fournir des services de soins quotidiens', 'Annonces'),
(994, 12, 'Fournir des services de nettoyage et d’entretien ménager', 'Annonces'),
(995, 13, 'Trier', 'Annonces'),
(996, 13, 'Charger ou décharger', 'Annonces'),
(997, 13, 'Bâtir ou construire', 'Annonces'),
(998, 13, 'Installer de l’infrastructure intérieure', 'Annonces'),
(999, 13, 'Faire la finition intérieure ou extérieur des immeubles', 'Annonces'),
(1000, 13, 'Restaurer et réparer', 'Annonces'),
(1001, 14, 'Installer et configurer une infrastructure technique', 'Annonces'),
(1002, 14, 'Mettre au point et reprogrammer des systèmes techniques', 'Annonces'),
(1003, 14, 'Utiliser des instruments et du matériel spécialisés', 'Annonces'),
(1004, 15, 'Identifier les besoins des clients', 'Annonces'),
(1005, 15, 'Planifier et concevoir de grands ouvrages', 'Annonces'),
(1006, 15, 'Élaborer des devis et des méthodes de construction', 'Annonces'),
(1007, 15, 'Évaluer des matériaux de construction', 'Annonces'),
(1008, 15, 'Étudier, interpréter et approuver des travaux d’arpentage et des ouvrages', 'Annonces'),
(1009, 15, 'Surveiller des chantiers', 'Annonces'),
(1010, 15, 'Préparer des documents contractuels', 'Annonces'),
(1011, 16, 'Concevoir', 'Annonces'),
(1012, 16, 'Rédiger', 'Annonces'),
(1015, 1, 'avoir l\'esprit de programmation', 'Académique'),
(1025, 1, 'test', 'Académique');

-- --------------------------------------------------------

--
-- Table structure for table `compfiliere`
--

DROP TABLE IF EXISTS `compfiliere`;
CREATE TABLE IF NOT EXISTS `compfiliere` (
  `CODE_FIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `CODE_COMP` int(11) NOT NULL,
  `taux` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CODE_FIL`,`CODE_COMP`),
  UNIQUE KEY `CODE_COMP` (`CODE_COMP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `compfiliere`
--

INSERT INTO `compfiliere` (`CODE_FIL`, `CODE_COMP`, `taux`) VALUES
('F1', 1, 0),
('F1', 2, 0),
('F1', 3, 0),
('F1', 4, 0),
('F2', 5, 0),
('F2', 6, 0),
('F2', 7, 0),
('F2', 8, 0),
('F2', 9, 0),
('F2', 10, 0),
('F2', 12, 0),
('F2', 879, 0);

-- --------------------------------------------------------

--
-- Table structure for table `compmatiere`
--

DROP TABLE IF EXISTS `compmatiere`;
CREATE TABLE IF NOT EXISTS `compmatiere` (
  `CODE_MAT` int(11) NOT NULL,
  `CODE_COMP` int(11) NOT NULL,
  `taux` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CODE_MAT`,`CODE_COMP`),
  KEY `CODE_COMP` (`CODE_COMP`),
  KEY `CODE_MAT` (`CODE_MAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `compmatiere`
--

INSERT INTO `compmatiere` (`CODE_MAT`, `CODE_COMP`, `taux`, `type`) VALUES
(1, 1, 63, 0),
(1, 2, 0, 0),
(1, 3, 32, 0),
(1, 4, 0, 0),
(2, 1, 0, 0),
(2, 2, 0, 0),
(2, 3, 0, 0),
(2, 4, 0, 0),
(4, 1, 0, 0),
(4, 2, 0, 0),
(4, 3, 0, 0),
(4, 4, 0, 0),
(5, 1, 0, 0),
(5, 2, 0, 0),
(5, 3, 0, 0),
(5, 4, 0, 0),
(6, 1, 0, 0),
(6, 2, 0, 0),
(6, 3, 0, 0),
(6, 4, 0, 0),
(7, 1, 0, 0),
(7, 2, 0, 0),
(7, 3, 0, 0),
(7, 4, 0, 0),
(8, 1, 0, 0),
(8, 2, 0, 0),
(8, 3, 0, 0),
(8, 4, 0, 0),
(9, 1, 0, 0),
(9, 2, 0, 0),
(9, 3, 0, 0),
(9, 4, 0, 0),
(10, 1, 0, 0),
(10, 2, 0, 0),
(10, 3, 0, 0),
(10, 4, 0, 0),
(11, 1, 0, 0),
(11, 2, 0, 0),
(11, 3, 0, 0),
(11, 4, 0, 0),
(12, 1, 0, 0),
(12, 2, 0, 0),
(12, 3, 0, 0),
(12, 4, 0, 0),
(13, 1, 0, 0),
(13, 2, 0, 0),
(13, 3, 0, 0),
(13, 4, 0, 0),
(14, 1, 0, 0),
(14, 2, 0, 0),
(14, 3, 0, 0),
(14, 4, 0, 0),
(15, 1, 0, 0),
(15, 2, 0, 0),
(15, 3, 0, 0),
(15, 4, 0, 0),
(16, 1, 0, 0),
(16, 2, 0, 0),
(16, 3, 0, 0),
(16, 4, 0, 0),
(17, 1, 0, 0),
(17, 2, 0, 0),
(17, 3, 0, 0),
(17, 4, 0, 0),
(18, 1, 0, 0),
(18, 2, 0, 0),
(18, 3, 0, 0),
(18, 4, 0, 0),
(19, 1, 0, 0),
(19, 2, 0, 0),
(19, 3, 0, 0),
(19, 4, 0, 0),
(20, 1, 0, 0),
(20, 2, 0, 0),
(20, 3, 0, 0),
(20, 4, 0, 0),
(21, 1, 0, 0),
(21, 2, 0, 0),
(21, 3, 0, 0),
(21, 4, 0, 0),
(22, 1, 0, 0),
(22, 2, 0, 0),
(22, 3, 0, 0),
(22, 4, 0, 0),
(23, 1, 0, 0),
(23, 2, 0, 0),
(23, 3, 0, 0),
(23, 4, 0, 0),
(24, 1, 0, 0),
(24, 2, 0, 0),
(24, 3, 0, 0),
(24, 4, 0, 0),
(25, 1, 0, 0),
(25, 2, 0, 0),
(25, 3, 0, 0),
(25, 4, 0, 0),
(26, 1, 0, 0),
(26, 2, 0, 0),
(26, 3, 0, 0),
(26, 4, 0, 0),
(27, 1, 0, 0),
(27, 2, 0, 0),
(27, 3, 0, 0),
(27, 4, 0, 0),
(28, 1, 0, 0),
(28, 2, 0, 0),
(28, 3, 0, 0),
(28, 4, 0, 0),
(29, 1, 0, 0),
(29, 2, 0, 0),
(29, 3, 0, 0),
(29, 4, 0, 0),
(30, 1, 0, 0),
(30, 2, 0, 0),
(30, 3, 0, 0),
(30, 4, 0, 0),
(31, 1, 0, 0),
(31, 2, 0, 0),
(31, 3, 0, 0),
(31, 4, 0, 0),
(32, 1, 0, 0),
(32, 2, 0, 0),
(32, 3, 0, 0),
(32, 4, 0, 0),
(33, 1, 0, 0),
(33, 2, 0, 0),
(33, 3, 0, 0),
(33, 4, 0, 0),
(34, 1, 0, 0),
(34, 2, 0, 0),
(34, 3, 0, 0),
(34, 4, 0, 0),
(35, 1, 0, 0),
(35, 2, 0, 0),
(35, 3, 0, 0),
(35, 4, 0, 0),
(36, 1, 0, 0),
(36, 2, 0, 0),
(36, 3, 0, 0),
(36, 4, 0, 0),
(37, 1, 0, 0),
(37, 2, 0, 0),
(37, 3, 0, 0),
(37, 4, 0, 0),
(38, 12, 0, 0),
(38, 879, 0, 0),
(39, 12, 0, 0),
(39, 879, 0, 0),
(40, 12, 0, 0),
(40, 879, 0, 0),
(41, 12, 0, 0),
(41, 879, 0, 0),
(42, 12, 0, 0),
(42, 879, 0, 0),
(43, 12, 0, 0),
(43, 879, 0, 0),
(44, 12, 0, 0),
(44, 879, 0, 0),
(45, 12, 0, 0),
(45, 879, 0, 0),
(46, 12, 0, 0),
(46, 13, 0, 1),
(46, 879, 0, 0),
(47, 12, 65, 0),
(47, 879, 0, 0),
(47, 1025, 29, 1),
(48, 12, 0, 0),
(48, 879, 0, 0),
(49, 12, 0, 0),
(49, 879, 0, 0),
(50, 12, 0, 0),
(50, 879, 0, 0),
(51, 12, 0, 0),
(51, 879, 0, 0),
(52, 12, 0, 0),
(52, 879, 0, 0),
(53, 12, 0, 0),
(53, 879, 0, 0),
(54, 12, 0, 0),
(54, 879, 0, 0),
(55, 12, 0, 0),
(55, 879, 0, 0),
(56, 12, 0, 0),
(56, 879, 0, 0),
(57, 12, 0, 0),
(57, 879, 0, 0),
(58, 12, 0, 0),
(58, 879, 0, 0),
(59, 12, 0, 0),
(59, 879, 0, 0),
(60, 12, 0, 0),
(60, 879, 0, 0),
(61, 12, 0, 0),
(61, 879, 0, 0),
(62, 12, 0, 0),
(62, 879, 0, 0),
(63, 12, 0, 0),
(63, 879, 0, 0),
(64, 12, 0, 0),
(64, 879, 0, 0),
(65, 12, 0, 0),
(65, 879, 0, 0),
(66, 12, 0, 0),
(66, 879, 0, 0),
(67, 12, 0, 0),
(67, 879, 0, 0),
(68, 12, 0, 0),
(68, 879, 0, 0),
(69, 12, 0, 0),
(69, 879, 0, 0),
(70, 12, 0, 0),
(70, 879, 0, 0),
(71, 12, 0, 0),
(71, 879, 0, 0),
(72, 12, 0, 0),
(72, 879, 0, 0),
(73, 12, 0, 0),
(73, 879, 0, 0),
(74, 12, 0, 0),
(74, 879, 0, 0),
(75, 12, 0, 0),
(75, 879, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `compmodule`
--

DROP TABLE IF EXISTS `compmodule`;
CREATE TABLE IF NOT EXISTS `compmodule` (
  `CODE_MODU` varchar(50) COLLATE utf8_bin NOT NULL,
  `CODE_COMP` int(11) NOT NULL,
  `taux` int(11) NOT NULL,
  PRIMARY KEY (`CODE_MODU`,`CODE_COMP`),
  KEY `CODE_MODU` (`CODE_MODU`),
  KEY `CODE_COMP` (`CODE_COMP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `compmodule`
--

INSERT INTO `compmodule` (`CODE_MODU`, `CODE_COMP`, `taux`) VALUES
('F1MD1', 1, 32),
('F1MD1', 2, 0),
('F1MD1', 3, 16),
('F1MD1', 4, 0),
('F1MD10', 1, 0),
('F1MD10', 2, 0),
('F1MD10', 3, 0),
('F1MD10', 4, 0),
('F1MD11', 1, 0),
('F1MD11', 2, 0),
('F1MD11', 3, 0),
('F1MD11', 4, 0),
('F1MD12', 1, 0),
('F1MD12', 2, 0),
('F1MD12', 3, 0),
('F1MD12', 4, 0),
('F1MD13', 1, 0),
('F1MD13', 2, 0),
('F1MD13', 3, 0),
('F1MD13', 4, 0),
('F1MD14', 1, 0),
('F1MD14', 2, 0),
('F1MD14', 3, 0),
('F1MD14', 4, 0),
('F1MD15', 1, 0),
('F1MD15', 2, 0),
('F1MD15', 3, 0),
('F1MD15', 4, 0),
('F1MD16', 1, 0),
('F1MD16', 2, 0),
('F1MD16', 3, 0),
('F1MD16', 4, 0),
('F1MD2', 1, 0),
('F1MD2', 2, 0),
('F1MD2', 3, 0),
('F1MD2', 4, 0),
('F1MD3', 1, 0),
('F1MD3', 2, 0),
('F1MD3', 3, 0),
('F1MD3', 4, 0),
('F1MD4', 1, 0),
('F1MD4', 2, 0),
('F1MD4', 3, 0),
('F1MD4', 4, 0),
('F1MD5', 1, 0),
('F1MD5', 2, 0),
('F1MD5', 3, 0),
('F1MD5', 4, 0),
('F1MD6', 1, 0),
('F1MD6', 2, 0),
('F1MD6', 3, 0),
('F1MD6', 4, 0),
('F1MD7', 1, 0),
('F1MD7', 2, 0),
('F1MD7', 3, 0),
('F1MD7', 4, 0),
('F1MD8', 1, 0),
('F1MD8', 2, 0),
('F1MD8', 3, 0),
('F1MD8', 4, 0),
('F1MD9', 1, 0),
('F1MD9', 2, 0),
('F1MD9', 3, 0),
('F1MD9', 4, 0),
('F2MD1', 12, 0),
('F2MD10', 12, 0),
('F2MD11', 12, 0),
('F2MD12', 12, 0),
('F2MD13', 12, 0),
('F2MD14', 12, 0),
('F2MD15', 12, 0),
('F2MD16', 12, 0),
('F2MD2', 12, 0),
('F2MD3', 12, 0),
('F2MD4', 12, 0),
('F2MD5', 12, 0),
('F2MD6', 12, 0),
('F2MD7', 12, 0),
('F2MD8', 12, 0),
('F2MD9', 12, 0);

--
-- Triggers `compmodule`
--
DROP TRIGGER IF EXISTS `contacts_after_delete`;
DELIMITER $$
CREATE TRIGGER `contacts_after_delete` AFTER DELETE ON `compmodule` FOR EACH ROW BEGIN

  DELETE FROM compmodule1
  WHERE CODE_MODU = OLD.CODE_MODU
  and CODE_COMP = OLD.CODE_COMP ; 
   
   

END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `contacts_after_insert`;
DELIMITER $$
CREATE TRIGGER `contacts_after_insert` AFTER INSERT ON `compmodule` FOR EACH ROW BEGIN
INSERT INTO `compmodule1`(`CODE_MODU`, `CODE_COMP`, `taux`,`type`) VALUES (NEW.CODE_MODU,NEW.CODE_COMP,new.taux,0);
   

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `compmodule1`
--

DROP TABLE IF EXISTS `compmodule1`;
CREATE TABLE IF NOT EXISTS `compmodule1` (
  `CODE_MODU` varchar(50) COLLATE utf8_bin NOT NULL,
  `CODE_COMP` int(11) NOT NULL,
  `taux` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CODE_MODU`,`CODE_COMP`),
  KEY `f6` (`CODE_COMP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `compmodule1`
--

INSERT INTO `compmodule1` (`CODE_MODU`, `CODE_COMP`, `taux`, `type`) VALUES
('F1MD1', 1, 0, 0),
('F1MD1', 2, 0, 0),
('F1MD1', 3, 0, 0),
('F1MD1', 4, 0, 0),
('F1MD10', 1, 0, 0),
('F1MD10', 2, 0, 0),
('F1MD10', 3, 0, 0),
('F1MD10', 4, 0, 0),
('F1MD11', 1, 0, 0),
('F1MD11', 2, 0, 0),
('F1MD11', 3, 0, 0),
('F1MD11', 4, 0, 0),
('F1MD12', 1, 0, 0),
('F1MD12', 2, 0, 0),
('F1MD12', 3, 0, 0),
('F1MD12', 4, 0, 0),
('F1MD13', 1, 0, 0),
('F1MD13', 2, 0, 0),
('F1MD13', 3, 0, 0),
('F1MD13', 4, 0, 0),
('F1MD14', 1, 0, 0),
('F1MD14', 2, 0, 0),
('F1MD14', 3, 0, 0),
('F1MD14', 4, 0, 0),
('F1MD15', 1, 0, 0),
('F1MD15', 2, 0, 0),
('F1MD15', 3, 0, 0),
('F1MD15', 4, 0, 0),
('F1MD16', 1, 0, 0),
('F1MD16', 2, 0, 0),
('F1MD16', 3, 0, 0),
('F1MD16', 4, 0, 0),
('F1MD2', 1, 0, 0),
('F1MD2', 2, 0, 0),
('F1MD2', 3, 0, 0),
('F1MD2', 4, 0, 0),
('F1MD3', 1, 0, 0),
('F1MD3', 2, 0, 0),
('F1MD3', 3, 0, 0),
('F1MD3', 4, 0, 0),
('F1MD4', 1, 0, 0),
('F1MD4', 2, 0, 0),
('F1MD4', 3, 0, 0),
('F1MD4', 4, 0, 0),
('F1MD5', 1, 0, 0),
('F1MD5', 2, 0, 0),
('F1MD5', 3, 0, 0),
('F1MD5', 4, 0, 0),
('F1MD6', 1, 0, 0),
('F1MD6', 2, 0, 0),
('F1MD6', 3, 0, 0),
('F1MD6', 4, 0, 0),
('F1MD7', 1, 0, 0),
('F1MD7', 2, 0, 0),
('F1MD7', 3, 0, 0),
('F1MD7', 4, 0, 0),
('F1MD8', 1, 0, 0),
('F1MD8', 2, 0, 0),
('F1MD8', 3, 0, 0),
('F1MD8', 4, 0, 0),
('F1MD9', 1, 0, 0),
('F1MD9', 2, 0, 0),
('F1MD9', 3, 0, 0),
('F1MD9', 4, 0, 0),
('F2MD1', 12, 0, 0),
('F2MD10', 12, 0, 0),
('F2MD11', 12, 0, 0),
('F2MD12', 12, 0, 0),
('F2MD13', 12, 0, 0),
('F2MD14', 12, 0, 0),
('F2MD15', 12, 0, 0),
('F2MD16', 12, 2, 0),
('F2MD16', 1015, 47, 1),
('F2MD2', 12, 0, 0),
('F2MD3', 12, 0, 0),
('F2MD4', 12, 0, 0),
('F2MD5', 12, 0, 0),
('F2MD6', 12, 0, 0),
('F2MD7', 12, 0, 0),
('F2MD8', 12, 0, 0),
('F2MD9', 12, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `compsemestre`
--

DROP TABLE IF EXISTS `compsemestre`;
CREATE TABLE IF NOT EXISTS `compsemestre` (
  `ID_SEMSTRE` varchar(11) COLLATE utf8_bin NOT NULL,
  `CODE_COMP` int(11) NOT NULL,
  `taux` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_SEMSTRE`,`CODE_COMP`),
  KEY `f8` (`CODE_COMP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `coordonateur_filiere`
--

DROP TABLE IF EXISTS `coordonateur_filiere`;
CREATE TABLE IF NOT EXISTS `coordonateur_filiere` (
  `CODE_COR_FIL` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_ETA` int(11) DEFAULT '1',
  `CODE_DEPT` int(11) DEFAULT '1',
  `PSEUDO` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PASSWORD` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NOM_COR_FIL` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PRENOM_COR_FIL` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SPCIALITE_COR_FIL` int(11) DEFAULT '1',
  `GRADE_COR_FIL` int(11) DEFAULT '1',
  `EMAIL_COR_FIL` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `TELE_COR_FIL` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `IMAGE_COR_FIL` text COLLATE utf8_bin,
  `ETAT` varchar(50) COLLATE utf8_bin DEFAULT 'coordonateur filiere',
  PRIMARY KEY (`CODE_COR_FIL`),
  UNIQUE KEY `PSEUDO` (`PSEUDO`),
  KEY `FK_ASSEMBLER` (`CODE_DEPT`),
  KEY `FK_DISPOSE` (`CODE_ETA`),
  KEY `CODE_ETA` (`CODE_ETA`),
  KEY `CODE_DEPT` (`CODE_DEPT`),
  KEY `GRADE_COR_FIL` (`GRADE_COR_FIL`),
  KEY `f11` (`SPCIALITE_COR_FIL`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `coordonateur_filiere`
--

INSERT INTO `coordonateur_filiere` (`CODE_COR_FIL`, `CODE_ETA`, `CODE_DEPT`, `PSEUDO`, `PASSWORD`, `NOM_COR_FIL`, `PRENOM_COR_FIL`, `SPCIALITE_COR_FIL`, `GRADE_COR_FIL`, `EMAIL_COR_FIL`, `TELE_COR_FIL`, `IMAGE_COR_FIL`, `ETAT`) VALUES
(1, 1, 1, 'MOUNIR', 'MOUNIR', 'MOUNIR', 'Ilham', 10, 3, NULL, NULL, 'M.jpg', 'coordonateur filiere'),
(2, 2, 2, 'Guerouate', 'Guerouate', 'Guerouate', 'Fatima', 3, 1, 'guerouate@gmail.com', '0661202086', 'photo3.jpg', 'coordonateur filiere');

-- --------------------------------------------------------

--
-- Table structure for table `coordonateur_module`
--

DROP TABLE IF EXISTS `coordonateur_module`;
CREATE TABLE IF NOT EXISTS `coordonateur_module` (
  `CODE_COR_MODU` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_DEPT` int(11) DEFAULT '1',
  `PSEUDO` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PASSWORD` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NOM_COR_MODU` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PRENOM_COR_MODU` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SPECIALITE_COR_MODU` int(11) DEFAULT '1',
  `GRADE_COR_MODU` int(11) DEFAULT '1',
  `CODE_ETA` int(11) DEFAULT NULL,
  `EMAIL_COR_MODU` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `TELE_COR_MODU` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `IMAGE_COR_MODU` text COLLATE utf8_bin,
  `ETAT` varchar(50) COLLATE utf8_bin DEFAULT 'Coordonnateur Module',
  PRIMARY KEY (`CODE_COR_MODU`),
  UNIQUE KEY `PSEUDO` (`PSEUDO`),
  KEY `FK_APPARTIENT` (`CODE_DEPT`),
  KEY `CODE_DEPT` (`CODE_DEPT`),
  KEY `SPECIALITE_COR_MODU` (`SPECIALITE_COR_MODU`),
  KEY `CODE_ETA` (`CODE_ETA`),
  KEY `GRADE_COR_MODU` (`GRADE_COR_MODU`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `coordonateur_module`
--

INSERT INTO `coordonateur_module` (`CODE_COR_MODU`, `CODE_DEPT`, `PSEUDO`, `PASSWORD`, `NOM_COR_MODU`, `PRENOM_COR_MODU`, `SPECIALITE_COR_MODU`, `GRADE_COR_MODU`, `CODE_ETA`, `EMAIL_COR_MODU`, `TELE_COR_MODU`, `IMAGE_COR_MODU`, `ETAT`) VALUES
(1, 1, 'BAYAR', 'BAYAR', 'BAYAR', 'ABDELOUAHAD', 1, 2, 1, NULL, NULL, NULL, 'Coordonnateur Module'),
(2, 1, 'MOUNIR', 'MOUNIR', 'MOUNIR', 'Ilham', 1, 2, 1, NULL, NULL, NULL, 'Coordonnateur Module'),
(3, 1, 'SUREAU', 'SUREAU', 'SUREAU', 'ODILE', 1, 2, 1, NULL, NULL, NULL, 'Coordonnateur Module'),
(4, 1, 'BELAFKIH', 'BELAFKIH', 'BELAFKIH', 'KHALID', 1, 2, 1, NULL, NULL, NULL, 'Coordonnateur Module'),
(5, 1, 'EL AIMANI', 'EL AIMANI', 'EL AIMANI', 'LAILA', 1, 2, 1, NULL, NULL, NULL, 'Coordonnateur Module'),
(6, 1, 'SOULMANI', 'SOULMANI', 'SOULMANI', 'ABDELLAH', 1, 2, 1, NULL, NULL, NULL, 'Coordonnateur Module'),
(7, 1, 'BOULAHOUAL', 'BOULAHOUAL', 'BOULAHOUAL', 'AHMED', 1, 2, 1, NULL, NULL, NULL, 'Coordonnateur Module'),
(8, 2, 'Bousdig', 'Bousdig', 'Bousdig', 'Khadija', 12, 4, 2, NULL, NULL, NULL, 'Coordonnateur Module'),
(9, 2, 'Benazza', 'Benazza', 'Benazza', 'hafida', 8, 4, 2, NULL, NULL, NULL, 'Coordonnateur Module'),
(10, 2, 'Elhaziti', 'Elhaziti', 'Elhaziti', 'Mohamad', 8, 4, 2, NULL, NULL, NULL, 'Coordonnateur Module'),
(11, 2, 'Lasfar', 'Lasfar', 'Lasfar', 'Ali', 3, 4, 2, '', '', NULL, 'Coordonnateur Module'),
(12, 2, 'Guerouate', 'Guerouate', 'Guerouate', 'Fatima', 3, 4, 2, '', '', 'G.jpg', 'Coordonnateur Module'),
(13, 2, 'Badaoui', 'Badaoui', 'Badaoui', 'Ahmed', 8, 4, 2, NULL, NULL, NULL, 'Coordonnateur Module'),
(14, 2, 'Lefdaoui', 'Lefdaoui', 'Lefdaoui', 'youssef', 3, 4, 2, '', '', NULL, 'Coordonnateur Module'),
(15, 2, 'Berbiche', 'Berbiche', 'Berbiche', 'Naouale', 3, 1, 2, NULL, NULL, 'B.png', 'Coordonnateur Module'),
(16, 2, 'Nabil', 'Nabil', 'Nabil', 'Aissam', 3, 1, 2, NULL, NULL, NULL, 'Coordonnateur Module');

-- --------------------------------------------------------

--
-- Table structure for table `debouche_formation`
--

DROP TABLE IF EXISTS `debouche_formation`;
CREATE TABLE IF NOT EXISTS `debouche_formation` (
  `CODE_DEBOUCHE_FOR` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_DOMAINE` int(11) DEFAULT NULL,
  `DEBOUCHE_FOR` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`CODE_DEBOUCHE_FOR`),
  UNIQUE KEY `DEBOUCHE_FOR` (`DEBOUCHE_FOR`),
  UNIQUE KEY `DEBOUCHE_FOR_2` (`DEBOUCHE_FOR`),
  KEY `CODE_DOMAINE` (`CODE_DOMAINE`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `debouche_formation`
--

INSERT INTO `debouche_formation` (`CODE_DEBOUCHE_FOR`, `CODE_DOMAINE`, `DEBOUCHE_FOR`) VALUES
(1, 30, 'Gestion de systèmes et réseaux informatiques'),
(2, 30, 'Développement et implémentation des systèmes d’information'),
(3, 30, 'Intégration de grandes Ecoles d’Ingénieurs nationales'),
(4, 30, 'Intégration des Licences en Sciences et Techniques au sein des FSTs'),
(5, 30, 'Intégration des Licences professionnels au sein des FS et dans les EST'),
(6, 30, 'Intégration d’Universités étrangers.'),
(7, 1, 'aa'),
(8, 1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `decipline_filiere`
--

DROP TABLE IF EXISTS `decipline_filiere`;
CREATE TABLE IF NOT EXISTS `decipline_filiere` (
  `CODE_decipline_FIL` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_FIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `decipline_FIL` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`CODE_decipline_FIL`),
  UNIQUE KEY `CODE_FIL_2` (`CODE_FIL`,`decipline_FIL`),
  KEY `CODE_FIL` (`CODE_FIL`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `decipline_filiere`
--

INSERT INTO `decipline_filiere` (`CODE_decipline_FIL`, `CODE_FIL`, `decipline_FIL`) VALUES
(3, 'F1', 'Sciences Humaines, Arts, Langues et Littérature'),
(2, 'F1', 'Sciences Juridiques, Economiques et de Gestion'),
(1, 'F1', 'Sciences et Techniques'),
(4, 'F2', 'Informatique');

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `CODE_DEPT` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_ETA` int(11) DEFAULT NULL,
  `NOM_DEPT` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`CODE_DEPT`),
  UNIQUE KEY `CODE_ETA` (`CODE_ETA`,`NOM_DEPT`),
  KEY `FK_CONSTITUER` (`CODE_ETA`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`CODE_DEPT`, `CODE_ETA`, `NOM_DEPT`) VALUES
(5, 1, 'Génie Industriel & Maintenance\n'),
(18, 1, 'GENIE INDUSTRIEL & MAINTENANCE'),
(17, 1, 'informatique'),
(1, 1, 'Techniques de Management'),
(2, 2, 'Informatique'),
(3, 3, 'Génie Informatique'),
(14, 18, 'informatique'),
(15, 18, 'technique de communication'),
(16, 20, 'technique de communication'),
(19, 22, 'informatique');

-- --------------------------------------------------------

--
-- Table structure for table `didactiques`
--

DROP TABLE IF EXISTS `didactiques`;
CREATE TABLE IF NOT EXISTS `didactiques` (
  `CODE_DIDACTIQUE_MODU` int(11) NOT NULL AUTO_INCREMENT,
  `DIDACTIQUE_MODU` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`CODE_DIDACTIQUE_MODU`),
  UNIQUE KEY `DIDACTIQUE_MODU` (`DIDACTIQUE_MODU`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `didactiques`
--

INSERT INTO `didactiques` (`CODE_DIDACTIQUE_MODU`, `DIDACTIQUE_MODU`) VALUES
(10, 'Cassettes vidéo, Magnétoscope, TV, Magnétophone, Caméscope'),
(28, 'Centre informatique'),
(13, 'Cours, travaux dirigés'),
(16, 'Cours, travaux dirigés et pratiques'),
(17, 'Cours, travaux dirigés et pratiques vidéo projecteur, tableau blanc interactif, des ordinateurs, un logiciel de programmation, logiciel de suivie des étudiants  '),
(18, 'Cours, travaux dirigés et travaux pratiques '),
(4, 'Distribuer des polycopiés de chaque élément de module.'),
(1, 'Définir les objectifs à atteindre au début de chaque séance de cours et TD'),
(3, 'Illustrer les cours par des Travaux Pratiques.'),
(2, 'Illustrer les cours par des exercices et diriger les étudiants pour la correction.'),
(27, 'Les différents logiciels cités dans les activités pratiques'),
(22, 'Logiciel MS-Access, logiciel Power AMC'),
(30, 'Logiciels du développement Web'),
(35, 'Magnétoscope, TV, Cassettes vidéo, Magnétophone'),
(6, 'Manuels de cours'),
(38, 'Outils multimédia.'),
(24, 'Polycopiés des Cours, travaux dirigés '),
(29, 'Polycopiés des Cours, travaux dirigés et travaux pratiques '),
(15, 'Polycopiés du cours et TD'),
(11, 'Projecteur multimédia'),
(34, 'Revues spécialisées'),
(8, 'Revues spécialisées en Langues Française'),
(9, 'Rétroprojecteurs'),
(21, 'Salle TP '),
(36, 'Salle audio-visuel.'),
(26, 'Salle informatique'),
(23, 'Supports informatiques'),
(5, 'Séminaires et visite d\'entreprises, d\'expositions et de salons'),
(14, 'Tableau Mural'),
(20, 'Tableau interactif'),
(19, 'Tableau mural'),
(7, 'Tableau mural, Tableau blanc interactif'),
(12, 'Terrain du sport multidisciplinaire'),
(25, 'Vidéo-projecteur'),
(37, 'Vidéoprojecteurs.'),
(32, '	Analyseurs de trames réseaux'),
(31, '	Simulateur de routage'),
(33, '	Utilisation de Routeurs et Switch');

-- --------------------------------------------------------

--
-- Table structure for table `diplomes`
--

DROP TABLE IF EXISTS `diplomes`;
CREATE TABLE IF NOT EXISTS `diplomes` (
  `CODE_DIPLOME` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` int(11) NOT NULL,
  `NOM_DIPLOME` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`CODE_DIPLOME`),
  UNIQUE KEY `TYPE_2` (`TYPE`,`NOM_DIPLOME`),
  KEY `TYPE` (`TYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `diplomes`
--

INSERT INTO `diplomes` (`CODE_DIPLOME`, `TYPE`, `NOM_DIPLOME`) VALUES
(10, 1, 'Arts Appliqués'),
(7, 1, 'Sciences agronomiques'),
(12, 1, 'Sciences de la Chariaâ'),
(1, 1, 'Sciences de la Vie et de la Terre'),
(13, 1, 'Sciences de Langue Arabe'),
(5, 1, 'Sciences Economiques'),
(8, 1, 'Sciences et Technologies Electriques'),
(9, 1, 'Sciences et Technologies Mécaniques'),
(11, 1, 'Sciences Humaines'),
(3, 1, 'Sciences Maths A'),
(4, 1, 'Sciences Maths B'),
(2, 1, 'Sciences Physiques et Chimiques'),
(6, 1, 'Techniques de Gestion et de Comptabilité');

-- --------------------------------------------------------

--
-- Table structure for table `domaine`
--

DROP TABLE IF EXISTS `domaine`;
CREATE TABLE IF NOT EXISTS `domaine` (
  `CODE_DOMAINE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_DOMAINE` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`CODE_DOMAINE`),
  UNIQUE KEY `NOM_DOMAINE` (`NOM_DOMAINE`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `domaine`
--

INSERT INTO `domaine` (`CODE_DOMAINE`, `NOM_DOMAINE`) VALUES
(8, 'Admin et bureautique'),
(10, 'Analyse'),
(21, 'Automobile'),
(23, 'AUTRES'),
(5, 'COMMUNICATION'),
(24, 'developpement Mobile'),
(17, 'Developpement personnel'),
(3, 'ECONOMIE'),
(16, 'Expression artistique'),
(7, 'FINANCE ET COMPTABILITE'),
(15, 'Génie civil'),
(6, 'GESTION'),
(9, 'Gestion de l’information'),
(25, 'Gestion des ressrouces Humains'),
(1, 'INFORMATIQUE'),
(2, 'MANAGEMENT'),
(13, 'Manutention de produits et de matériaux'),
(22, 'mécanique'),
(19, 'NIVEAU PROFIL'),
(20, 'Réseau Informatique'),
(4, 'SCIENCE'),
(18, 'sécurité informatique'),
(11, 'Service à la clientèle'),
(12, 'Soins de santé'),
(14, 'Technologie,équipement et machines');

-- --------------------------------------------------------

--
-- Table structure for table `effectifs`
--

DROP TABLE IF EXISTS `effectifs`;
CREATE TABLE IF NOT EXISTS `effectifs` (
  `CODE_EFFECTIF` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_FIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `EFFECTIF` bigint(20) DEFAULT NULL,
  `promotion` int(11) NOT NULL,
  `ID_ANNE` int(50) NOT NULL,
  `option_FILIERE` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CODE_EFFECTIF`),
  KEY `FK_AVOIR` (`CODE_FIL`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `effectifs`
--

INSERT INTO `effectifs` (`CODE_EFFECTIF`, `CODE_FIL`, `EFFECTIF`, `promotion`, `ID_ANNE`, `option_FILIERE`) VALUES
(1, 'F1', 80, 1, 1, 0),
(2, 'F1', 80, 2, 2, 0),
(3, 'F1', 80, 3, 3, 0),
(4, 'F1', 90, 4, 4, 0),
(5, 'F2', 40, 1, 1, 0),
(6, 'F2', 40, 2, 2, 0),
(7, 'F2', 40, 3, 3, 0),
(8, 'F2', 40, 4, 4, 0),
(9, 'F3', 80, 1, 0, 0),
(10, 'F3', 80, 2, 0, 0),
(11, 'F3', 80, 3, 0, 0),
(12, 'F3', 90, 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `CODE_ENS` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_DEPT` int(11) NOT NULL DEFAULT '1',
  `PSEUDO` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PASSWORD` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NOM_ENS` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PRENOM_ENS` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SPECIALTE_ENS` int(11) DEFAULT '1',
  `GRADE_ENS` int(11) DEFAULT '1',
  `EMAIL_ENS` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `TELE_ENS` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `IMAGE_ENS` text COLLATE utf8_bin,
  `ETAT` varchar(50) COLLATE utf8_bin DEFAULT 'enseignant',
  PRIMARY KEY (`CODE_ENS`),
  UNIQUE KEY `PSEUDO` (`PSEUDO`),
  KEY `CODE_DEPT` (`CODE_DEPT`),
  KEY `SPECIALTE_ENS` (`SPECIALTE_ENS`),
  KEY `GRADE_ENS` (`GRADE_ENS`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`CODE_ENS`, `CODE_DEPT`, `PSEUDO`, `PASSWORD`, `NOM_ENS`, `PRENOM_ENS`, `SPECIALTE_ENS`, `GRADE_ENS`, `EMAIL_ENS`, `TELE_ENS`, `IMAGE_ENS`, `ETAT`) VALUES
(1, 1, 'BAYAR', 'BAYAR', 'BAYAR', 'ABDELOUAHAD', 10, 3, NULL, NULL, NULL, 'enseignant'),
(2, 1, 'MOUNIR', 'MOUNIR', 'MOUNIR', 'Ilham', 10, 3, NULL, NULL, NULL, 'enseignant'),
(4, 1, 'SUREAU', 'SUREAU', 'SUREAU', 'ODILE', 10, 3, NULL, NULL, NULL, 'enseignant'),
(5, 1, 'BELAFKIH', 'BELAFKIH', 'BELAFKIH', 'KHALID', 10, 3, NULL, NULL, NULL, 'enseignant'),
(6, 1, 'EL AIMANI', 'EL AIMANI', 'EL AIMANI', 'LAILA', 10, 3, NULL, NULL, NULL, 'enseignant'),
(7, 1, 'amridib', 'amridib', 'amridib', 'amridib', 1, 2, NULL, NULL, NULL, 'enseignant'),
(8, 2, 'Bousdig', 'Bousdig', 'Bousdig', 'Khadija', 12, 1, NULL, NULL, NULL, 'enseignant'),
(9, 2, 'Mekouar ', 'Mekouar', 'Mekouar ', 'Meryem', 12, 1, NULL, NULL, NULL, 'enseignant'),
(10, 2, 'Benazza', 'Benazza', 'Benazza', 'Hafida', 8, 1, NULL, NULL, NULL, 'enseignant'),
(13, 2, 'Sbihi', 'Sbihi', 'Sbihi', 'Mohamad', 9, 1, '', '', NULL, 'enseignant'),
(14, 2, 'Elhaziti', 'Elhaziti', 'Elhaziti', 'Mohamad', 9, 1, NULL, NULL, NULL, 'enseignant'),
(15, 2, 'Guerouate', 'Guerouate', 'Guerouate', 'Fatima', 8, 1, NULL, NULL, 'G.jpg', 'enseignant'),
(16, 2, 'Lasfar', 'Lasfar', 'Lasfar', 'Ali', 8, 1, NULL, NULL, NULL, 'enseignant'),
(17, 2, 'Oumsis', 'Oumsis', 'Oumsis', 'Mohamad', 8, 1, NULL, NULL, NULL, 'enseignant'),
(18, 2, 'Badaoui', 'Badaoui', 'Badaoui', 'Mohamad', 8, 1, NULL, NULL, NULL, 'enseignant'),
(22, 2, 'Nabil', 'Nabil', 'Nabil', 'Aissam', 8, 1, NULL, NULL, NULL, 'enseignant'),
(23, 2, 'Berbiche', 'Berbiche', 'Berbiche', 'Naouale', 8, 1, NULL, NULL, NULL, 'enseignant'),
(24, 2, 'Lefdaoui', 'Lefdaoui', 'Lefdaoui', 'youssef', 8, 1, NULL, NULL, NULL, 'enseignant'),
(25, 2, 'Affifi', 'Affifi', 'Affifi', 'salma', 4, 1, '', '', NULL, 'enseignant'),
(27, 2, 'ElOuali', 'ElOuali', 'ElOuali', 'Ahmed', 3, 1, NULL, NULL, NULL, 'enseignant'),
(28, 2, 'Moumade', 'Moumade', 'Moumade', 'Jamila', 3, 1, NULL, NULL, NULL, 'enseignant'),
(29, 2, 'Kouzer', 'Kouzer', 'Kouzer', 'Ali', 3, 1, NULL, NULL, NULL, 'enseignant');

-- --------------------------------------------------------

--
-- Table structure for table `enseigneer`
--

DROP TABLE IF EXISTS `enseigneer`;
CREATE TABLE IF NOT EXISTS `enseigneer` (
  `CODE_ENS` int(11) NOT NULL,
  `CODE_INTERVENTION` int(11) NOT NULL DEFAULT '1',
  `CODE_MAT` int(50) NOT NULL,
  PRIMARY KEY (`CODE_ENS`,`CODE_INTERVENTION`,`CODE_MAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `enseigneer`
--

INSERT INTO `enseigneer` (`CODE_ENS`, `CODE_INTERVENTION`, `CODE_MAT`) VALUES
(7, 0, 1),
(15, 1, 47),
(15, 1, 48),
(15, 2, 47),
(15, 2, 48),
(15, 3, 47),
(15, 4, 47);

-- --------------------------------------------------------

--
-- Table structure for table `enseigner`
--

DROP TABLE IF EXISTS `enseigner`;
CREATE TABLE IF NOT EXISTS `enseigner` (
  `CODE_ENS` int(11) NOT NULL,
  `CODE_MAT` int(11) NOT NULL,
  PRIMARY KEY (`CODE_ENS`,`CODE_MAT`),
  KEY `FK_ENSEIGNER2` (`CODE_MAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `CODE_ETA` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_UNIVERSITE` int(11) DEFAULT NULL,
  `NOM_ETA` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`CODE_ETA`),
  UNIQUE KEY `CODE_UNIVERSITE` (`CODE_UNIVERSITE`,`NOM_ETA`),
  KEY `FK_DERIGE` (`CODE_UNIVERSITE`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `etablissement`
--

INSERT INTO `etablissement` (`CODE_ETA`, `CODE_UNIVERSITE`, `NOM_ETA`) VALUES
(18, 1, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - Essaouira'),
(1, 1, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - SAFI '),
(2, 2, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - SALE'),
(3, 3, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - OUJDA'),
(14, 4, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - Béni Mellal'),
(23, 5, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - Agadir'),
(15, 5, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - Guelmim'),
(17, 5, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - Laâyoune'),
(16, 6, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - Khénifra'),
(21, 6, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - Meknès'),
(19, 7, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - Berrechid'),
(20, 8, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - Fès'),
(22, 9, 'ECOLE SUPÉRIEURE DE TECHNOLOGIE - Casablanca');

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `CODE_FIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `CODE_DEPT` int(11) DEFAULT '1',
  `CODE_COR_FIL` int(11) DEFAULT '1',
  `NOM_FIL` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `OBJECTIFS_FORMATION` text COLLATE utf8_bin,
  `CONDITION_D_ACCEES` text COLLATE utf8_bin,
  `ACCES_PAR_PASSERELLE` text COLLATE utf8_bin,
  `NATURE_DIPLOME` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Date_Debut` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Date_fin` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `MOTS_CLES` text COLLATE utf8_bin,
  `ETAT` varchar(50) COLLATE utf8_bin DEFAULT 'Encore d''accréditation',
  `Progre` int(11) DEFAULT '0',
  `avancement` int(11) DEFAULT '0',
  `SPICIALITE_DIPLOME` varchar(50) COLLATE utf8_bin DEFAULT '',
  `Statut_fil` int(255) NOT NULL DEFAULT '1',
  PRIMARY KEY (`CODE_FIL`),
  UNIQUE KEY `CODE_DEPT` (`CODE_DEPT`,`NOM_FIL`),
  KEY `FK_AFFILIER` (`CODE_DEPT`),
  KEY `FK_SUPERVISE` (`CODE_COR_FIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`CODE_FIL`, `CODE_DEPT`, `CODE_COR_FIL`, `NOM_FIL`, `OBJECTIFS_FORMATION`, `CONDITION_D_ACCEES`, `ACCES_PAR_PASSERELLE`, `NATURE_DIPLOME`, `Date_Debut`, `Date_fin`, `MOTS_CLES`, `ETAT`, `Progre`, `avancement`, `SPICIALITE_DIPLOME`, `Statut_fil`) VALUES
('F1', 1, 1, 'Génie Informatique', '  Les techniciens supérieurs issus de cette formation doivent être capables de participer à la conception, à la réalisation et à la mise en oeuvre de systèmes informatiques qui répondent aux besoins des utilisateurs. Pour assumer ces responsabilités, les lauréats de cette formation doivent être compétents sur le plan technologique, posséder une bonne culture générale et se montrer aptes à la communication.\r\nL’enseignement proposé est :\r\n- fondamental, pour acquérir des connaissances, des concepts de base et des méthodes de travail,\r\n- appliqué, pour faciliter l\'apprentissage de ces concepts et déployer des savoir-faire professionnels,\r\n- évolutif, pour intégrer les progrès technologiques et les exigences du monde professionnel,\r\n- ouvert, pour développer les facultés de communication indispensables aux informaticiens dans l\'exercice de leur métier', '    La sélection se fait sur étude de dossier sur la base des notes obtenues à l’examen national du baccalauréat (cf. : note ministérielle organisant l’accès aux EST et aux établissements préparant et délivrant le DUT)', '  L’accès aux formations de DUT peut se faire également en S3 sur étude de dossier pour les étudiants issus d’autres établissements d’enseignement supérieur, satisfaisant aux pré-requis précisés dans le descriptif de la filière', 'Bac+2', '', '', NULL, 'En cours d\'accréditation', 0, 49, 'Administration des Systèmes de Réseaux (ASR)', 1),
('F2', 2, 2, 'Génie Logiciel', '  Cette formation au Diplôme Universitaire de Technologie spécialisé « Génie Logiciel » est : \r\ndestinée aux étudiants qui désirent maîtriser les composantes théoriques et pratiques du génie\r\nlogiciel. Le parcours Génie Logiciel permet d’acquérir une connaissance approfondie des\r\ntechniques et méthodes de conception, de réalisation, de mise en oeuvre et de maintenance de\r\nlogiciels. Elle s\'appuie sur les aspects fondamentaux de ces domaines comme la connaissance\r\net la pratique des langages de programmation, les techniques de mise en oeuvre d\'applications\r\nclassiques ou distribuées, les tactiques de conduite de projets, et cela en intégrant toutes les\r\nconnaissances théoriques nécessaires comme la logique, l\'analyse de complexité, ou les\r\nméthodes formelles de spécification et de vérification\r\nLa formation DUT en Génie logiciel assure 4 volets d’apprentissage :\r\n- Fondamental, pour acquérir des connaissances, des concepts de base et des méthodes de\r\ntravail\r\n- Appliqué, pour faciliter l\'apprentissage de ces concepts et déployer des savoir-faire\r\nprofessionnels\r\n- Evolutif, pour intégrer les progrès technologiques et les exigences du monde\r\nprofessionnel\r\n- Ouvert, pour développer les facultés de communication indispensables aux informaticiens\r\ndans l\'exercice de leur métier.', '      La sélection des candidats se fait par type de baccalauréat et sur la base des résultats\r\nobtenus au baccalauréat national. Pour chaque type de baccalauréat, un seuil d’admissibilité\r\npour les listes d’attente est fixé chaque année en fonction du nombre de candidats et de\r\nleurs moyennes    ', ' L’accès aux formations de DUT peut se faire également en S3, Selon la capacité d’accueil\r\nde la filière, sur étude de dossier pour les étudiants issus d’autres filières ou autres\r\nétablissements d’enseignement supérieur, satisfaisant aux prérequis précisés dans le\r\ndescriptif de la filière.    ', '2', '2017-04-04', '2021-04-02', NULL, 'En cours d\'accréditation', 0, 52, 'Informatique', 1);

-- --------------------------------------------------------

--
-- Table structure for table `filiere_demandes`
--

DROP TABLE IF EXISTS `filiere_demandes`;
CREATE TABLE IF NOT EXISTS `filiere_demandes` (
  `CODE_FIL` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `CODE_CORD_DEM` int(11) NOT NULL,
  PRIMARY KEY (`CODE_FIL`,`CODE_CORD_DEM`),
  KEY `e7` (`CODE_CORD_DEM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filiere_demandes`
--

INSERT INTO `filiere_demandes` (`CODE_FIL`, `CODE_CORD_DEM`) VALUES
('F1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `filiere_diplomes`
--

DROP TABLE IF EXISTS `filiere_diplomes`;
CREATE TABLE IF NOT EXISTS `filiere_diplomes` (
  `CODE_DIPLOME` int(11) NOT NULL,
  `CODE_FIL` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`CODE_DIPLOME`,`CODE_FIL`),
  KEY `f31` (`CODE_FIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `filiere_diplomes`
--

INSERT INTO `filiere_diplomes` (`CODE_DIPLOME`, `CODE_FIL`) VALUES
(1, 'F1'),
(2, 'F1'),
(7, 'F1'),
(2, 'F2'),
(3, 'F2'),
(4, 'F2'),
(5, 'F2');

-- --------------------------------------------------------

--
-- Table structure for table `filiere_motcles`
--

DROP TABLE IF EXISTS `filiere_motcles`;
CREATE TABLE IF NOT EXISTS `filiere_motcles` (
  `CODE_FIL` varchar(50) NOT NULL,
  `CODE_MOTCLE` int(11) NOT NULL,
  PRIMARY KEY (`CODE_FIL`,`CODE_MOTCLE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filiere_motcles`
--

INSERT INTO `filiere_motcles` (`CODE_FIL`, `CODE_MOTCLE`) VALUES
('F2', 1),
('F2', 2),
('F2', 3),
('F2', 4);

-- --------------------------------------------------------

--
-- Table structure for table `filiere_partagee`
--

DROP TABLE IF EXISTS `filiere_partagee`;
CREATE TABLE IF NOT EXISTS `filiere_partagee` (
  `CODE_FIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `CODE_CORF_v` int(11) NOT NULL,
  `CODE_CORF_C` int(11) NOT NULL,
  PRIMARY KEY (`CODE_FIL`,`CODE_CORF_v`,`CODE_CORF_C`),
  KEY `f33` (`CODE_CORF_v`),
  KEY `f34` (`CODE_CORF_C`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `filiere_partagee`
--

INSERT INTO `filiere_partagee` (`CODE_FIL`, `CODE_CORF_v`, `CODE_CORF_C`) VALUES
('F1', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `filiere_prerequis`
--

DROP TABLE IF EXISTS `filiere_prerequis`;
CREATE TABLE IF NOT EXISTS `filiere_prerequis` (
  `CODE_Prerequis` int(11) NOT NULL,
  `CODE_FIL` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`CODE_Prerequis`,`CODE_FIL`),
  KEY `f40` (`CODE_FIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `formation_debouche`
--

DROP TABLE IF EXISTS `formation_debouche`;
CREATE TABLE IF NOT EXISTS `formation_debouche` (
  `CODE_FIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `CODE_DEBOUCHE_FOR` int(11) NOT NULL,
  PRIMARY KEY (`CODE_FIL`,`CODE_DEBOUCHE_FOR`),
  KEY `FK_QUALIFIE2` (`CODE_DEBOUCHE_FOR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `formation_debouche`
--

INSERT INTO `formation_debouche` (`CODE_FIL`, `CODE_DEBOUCHE_FOR`) VALUES
('F1', 1),
('F1', 2),
('F2', 3),
('F2', 4),
('F2', 5),
('F2', 6);

-- --------------------------------------------------------

--
-- Table structure for table `grade_crm`
--

DROP TABLE IF EXISTS `grade_crm`;
CREATE TABLE IF NOT EXISTS `grade_crm` (
  `CODE_GRAD` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_GRAD` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`CODE_GRAD`),
  UNIQUE KEY `NOM_GRAD` (`NOM_GRAD`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `grade_crm`
--

INSERT INTO `grade_crm` (`CODE_GRAD`, `NOM_GRAD`) VALUES
(2, 'Administrateur 2ème grade'),
(1, 'PA '),
(4, 'PESQ'),
(5, 'PH'),
(3, 'Prof 2ème cycle'),
(6, 'Professeur de l’enseignement secondaire qualifiant');

-- --------------------------------------------------------

--
-- Table structure for table `intervient`
--

DROP TABLE IF EXISTS `intervient`;
CREATE TABLE IF NOT EXISTS `intervient` (
  `CODE_ENS` int(11) NOT NULL,
  `CODE_MAT` int(50) NOT NULL,
  PRIMARY KEY (`CODE_ENS`,`CODE_MAT`),
  KEY `FK_INTERVIENT3` (`CODE_MAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `intervient`
--

INSERT INTO `intervient` (`CODE_ENS`, `CODE_MAT`) VALUES
(15, 47),
(15, 48),
(15, 58),
(23, 59),
(23, 60);

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `CODE_MAT` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_MODU` varchar(50) COLLATE utf8_bin NOT NULL,
  `NOM_MAT` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `DESCRIPTION_MAT` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SEPCIALITE_MAT` int(11) DEFAULT '1',
  `VOLUME_HORAIRE_MAT` int(11) DEFAULT '0',
  `VOLUME_COURS_MAT` int(11) DEFAULT '0',
  `VOLUME_TD_MAT` int(11) DEFAULT '0',
  `VOLUME_TP_MAT` int(11) DEFAULT '0',
  `VOLUME_AP_MAT` int(11) DEFAULT '0',
  `ACTIVITE_PRATIQUE` varchar(50) COLLATE utf8_bin DEFAULT '0',
  `avancement` int(11) DEFAULT '0',
  `type_cour` int(11) DEFAULT '1',
  PRIMARY KEY (`CODE_MAT`),
  UNIQUE KEY `CODE_MODU` (`CODE_MODU`,`NOM_MAT`),
  KEY `FK_POSSEDE` (`CODE_MODU`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `matiere`
--

INSERT INTO `matiere` (`CODE_MAT`, `CODE_MODU`, `NOM_MAT`, `DESCRIPTION_MAT`, `SEPCIALITE_MAT`, `VOLUME_HORAIRE_MAT`, `VOLUME_COURS_MAT`, `VOLUME_TD_MAT`, `VOLUME_TP_MAT`, `VOLUME_AP_MAT`, `ACTIVITE_PRATIQUE`, `avancement`, `type_cour`) VALUES
(1, 'F1MD1', 'Algorithmique', NULL, 1, 36, 30, 0, 28, 0, '0', 0, 1),
(2, 'F1MD1', 'Langage de programmation C', NULL, 1, 54, 26, 0, 28, 0, '0', 0, 1),
(4, 'F1MD2', 'Automatismes logiques', NULL, 1, 36, 0, 0, 0, 0, '0', 0, 1),
(5, 'F1MD2', 'Architecture des ordinateurs', NULL, 1, 54, 0, 0, 0, 0, '0', 0, 1),
(6, 'F1MD3', 'Analyse', NULL, 1, 40, 0, 0, 0, 0, '0', 0, 1),
(7, 'F1MD3', 'Algèbre', NULL, 1, 34, 0, 0, 0, 0, '0', 0, 1),
(8, 'F1MD3', 'Probabilités', NULL, 1, 26, 0, 0, 0, 0, '0', 0, 1),
(9, 'F1MD4', 'Français', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(10, 'F1MD4', 'TEC', NULL, 1, 20, 0, 0, 0, 0, '0', 0, 1),
(11, 'F1MD4', 'Anglais', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(12, 'F1MD5', 'Analyse et conception des systèmes d’information', NULL, 1, 40, 0, 0, 0, 0, '0', 0, 1),
(13, 'F1MD5', 'Implémentation sous un SGBD', NULL, 1, 24, 0, 0, 0, 0, '0', 0, 1),
(14, 'F1MD6', 'Analyse numérique', NULL, 1, 50, 0, 0, 0, 0, '0', 0, 1),
(15, 'F1MD6', 'Cryptologie', NULL, 1, 40, 0, 0, 0, 0, '0', 0, 1),
(16, 'F1MD7', 'Structures de données', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(17, 'F1MD7', 'Théorie de graphe', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(18, 'F1MD7', 'Programmation C', NULL, 1, 40, 0, 0, 0, 0, '0', 0, 1),
(19, 'F1MD8', 'TEC 2 ', NULL, 1, 20, 0, 0, 0, 0, '0', 0, 1),
(20, 'F1MD8', 'Anglais 2', NULL, 1, 20, 0, 0, 0, 0, '0', 0, 1),
(21, 'F1MD8', 'Comptabilité, gestion ', NULL, 1, 40, 0, 0, 0, 0, '0', 0, 1),
(22, 'F1MD9', 'Programmation orientée objet en C++', NULL, 1, 50, 0, 0, 0, 0, '0', 0, 1),
(23, 'F1MD9', 'Langage Java', NULL, 1, 50, 0, 0, 0, 0, '0', 0, 1),
(24, 'F1MD10', 'Bases de données objet : f', NULL, 1, 38, 0, 0, 0, 0, '0', 0, 1),
(25, 'F1MD10', 'SGBD Posgresql (Oracle)', NULL, 1, 24, 0, 0, 0, 0, '0', 0, 1),
(26, 'F1MD10', 'Technologie WEB', NULL, 1, 28, 0, 0, 0, 0, '0', 0, 1),
(27, 'F1MD11', 'Systèmes d’exploitation', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(28, 'F1MD12', 'Réseaux informatiques', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(29, 'F1MD13', 'Administration d’un environnement', NULL, 1, 34, 0, 0, 0, 0, '0', 0, 1),
(30, 'F1MD13', 'Administration sous LINUX', NULL, 1, 20, 0, 0, 0, 0, '0', 0, 1),
(31, 'F1MD13', 'Systèmes Télécom', NULL, 1, 46, 0, 0, 0, 0, '0', 0, 1),
(32, 'F1MD14', 'Tec 3', NULL, 1, 20, 0, 0, 0, 0, '0', 0, 1),
(33, 'F1MD14', 'Anglais 3', NULL, 1, 20, 0, 0, 0, 0, '0', 0, 1),
(34, 'F1MD14', 'Management de la qualité et gestion des projets', NULL, 1, 40, 0, 0, 0, 0, '0', 0, 1),
(35, 'F1MD15', 'Stage d’Initiation', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(36, 'F1MD15', 'Stage Technique', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(37, 'F1MD16', 'PFE', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(38, 'F2MD1', 'renforcement liguistique :', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(39, 'F2MD1', 'mad (motricite activite de developpement)', NULL, 1, 10, 0, 0, 0, 0, '0', 0, 1),
(40, 'F2MD1', 'TEC', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(41, 'F2MD2', 'Analyse', NULL, 1, 40, 0, 0, 0, 0, '0', 0, 1),
(42, 'F2MD2', 'Algèbre', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(43, 'F2MD2', 'Probabilités et Statistique', NULL, 1, 20, 0, 0, 0, 0, '0', 0, 1),
(44, 'F2MD3', 'Électronique numérique', NULL, 1, 40, 0, 0, 0, 0, '0', 0, 1),
(45, 'F2MD3', 'Architecture d’ordinateur', NULL, 1, 40, 0, 0, 0, 0, '0', 0, 1),
(46, 'F2MD4', 'Algorithmique', NULL, 1, 44, 0, 0, 0, 0, '0', 0, 1),
(47, 'F2MD5', 'Structures de données', NULL, 1, 70, 4, 0, 0, 0, '0', 26, 1),
(48, 'F2MD5', 'Pratique de la Prog. OO Java', 'matière de spécialité ', 1, 40, 10, 10, 10, 5, '0', 59, 1),
(49, 'F2MD6', 'Introduction au Système d\'exploitation Unix', NULL, 1, 50, 0, 0, 0, 0, '0', 0, 1),
(50, 'F2MD6', 'Introduction aux réseaux informatiques', NULL, 1, 50, 0, 0, 0, 0, '0', 0, 1),
(51, 'F2MD7', 'Analyse et Conception des Systèmes d’Info.', NULL, 1, 50, 0, 0, 0, 0, '0', 0, 1),
(52, 'F2MD7', 'Bases de Données Relationnelles', NULL, 1, 50, 0, 0, 0, 0, '0', 0, 1),
(53, 'F2MD8', 'Renforcement linguistique', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(54, 'F2MD8', 'Anglais', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(55, 'F2MD8', 'TEC2', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(56, 'F2MD9', 'Recherche opérationnelle', NULL, 1, 50, 0, 0, 0, 0, '0', 0, 1),
(57, 'F2MD9', 'Analyse Numérique', NULL, 1, 50, 0, 0, 0, 0, '0', 0, 1),
(58, 'F2MD10', 'Modélisation UML', NULL, 1, 30, 0, 0, 0, 0, '0', 77, 1),
(59, 'F2MD10', 'AGL', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(60, 'F2MD10', 'Gestion projet', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(61, 'F2MD11', 'SQL Oracl', NULL, 1, 40, 20, 10, 10, 0, '0', 0, 1),
(62, 'F2MD11', 'PL SQL', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(63, 'F2MD11', 'Administration BD', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(64, 'F2MD12', 'PHP Mysql', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(65, 'F2MD12', 'XML', NULL, 1, 40, 0, 0, 0, 0, '0', 0, 1),
(66, 'F2MD12', 'Java avancé', NULL, 1, 30, 0, 0, 0, 0, '0', 0, 1),
(67, 'F2MD13', 'Programmation Réseaux', NULL, 1, 50, 0, 0, 0, 0, '0', 0, 1),
(68, 'F2MD13', 'Réseaux locaux', NULL, 1, 50, 0, 0, 0, 0, '0', 0, 1),
(69, 'F2MD14', 'Méthodologie de travail personnel', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(70, 'F2MD14', 'PAVA', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(71, 'F2MD14', 'Organisation d\'entreprise', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(72, 'F2MD15', 'Projet de fin d\'études', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(73, 'F2MD16', 'Stage d’initiation', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(74, 'F2MD16', 'Stage de fin d’etudes', NULL, 1, 90, 0, 0, 0, 0, '0', 0, 1),
(75, 'F2MD4', 'Programmation C', NULL, 1, 46, 0, 0, 0, 0, '0', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `matiere_demandees`
--

DROP TABLE IF EXISTS `matiere_demandees`;
CREATE TABLE IF NOT EXISTS `matiere_demandees` (
  `CODE_ENS` int(11) NOT NULL,
  `CODE_MAT` int(50) NOT NULL,
  PRIMARY KEY (`CODE_ENS`,`CODE_MAT`),
  KEY `f89` (`CODE_MAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `matiere_enregistrées`
--

DROP TABLE IF EXISTS `matiere_enregistrées`;
CREATE TABLE IF NOT EXISTS `matiere_enregistrées` (
  `CODE_MAT` int(11) NOT NULL,
  `CODE_ENS` int(11) NOT NULL,
  PRIMARY KEY (`CODE_MAT`,`CODE_ENS`),
  KEY `f50` (`CODE_ENS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `matiere_enregistrées`
--

INSERT INTO `matiere_enregistrées` (`CODE_MAT`, `CODE_ENS`) VALUES
(61, 15);

-- --------------------------------------------------------

--
-- Table structure for table `matiere_partagee`
--

DROP TABLE IF EXISTS `matiere_partagee`;
CREATE TABLE IF NOT EXISTS `matiere_partagee` (
  `CODE_MAT` int(11) NOT NULL DEFAULT '0',
  `CODE_ENS_v` int(11) NOT NULL DEFAULT '0',
  `CODE_ENS_C` int(11) DEFAULT NULL,
  PRIMARY KEY (`CODE_MAT`,`CODE_ENS_v`),
  KEY `CODE_ENS_C` (`CODE_ENS_C`),
  KEY `f53` (`CODE_ENS_v`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `matiere_partagee`
--

INSERT INTO `matiere_partagee` (`CODE_MAT`, `CODE_ENS_v`, `CODE_ENS_C`) VALUES
(59, 15, 23);

-- --------------------------------------------------------

--
-- Table structure for table `mat_pre`
--

DROP TABLE IF EXISTS `mat_pre`;
CREATE TABLE IF NOT EXISTS `mat_pre` (
  `CODE_MAT` int(11) NOT NULL,
  `code_pre` int(11) NOT NULL,
  PRIMARY KEY (`CODE_MAT`,`code_pre`),
  KEY `f69` (`code_pre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `CODE_MODU` varchar(50) COLLATE utf8_bin NOT NULL,
  `CODE_COR_MODU` int(11) DEFAULT NULL,
  `CODE_FIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `ID_SEMSTRE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NOM_MODU` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `VOLUME_HORAIRE_MODU` int(11) DEFAULT '0',
  `VOLUME_COURS_MODU` int(11) DEFAULT '0',
  `VOLUME_TD_MODU` int(11) DEFAULT '0',
  `VOLUME_TP_MODU` int(11) DEFAULT '0',
  `VOLUME_AP_MODU` int(11) DEFAULT '0',
  `Evaluation_connaissances` int(11) DEFAULT '0',
  `PENDERATION` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `avancement` int(11) DEFAULT '0',
  PRIMARY KEY (`CODE_MODU`),
  UNIQUE KEY `CODE_FIL` (`CODE_FIL`,`NOM_MODU`),
  KEY `FK_COMPOSER` (`CODE_FIL`),
  KEY `FK_FORMEE` (`ID_SEMSTRE`),
  KEY `FK_GERE` (`CODE_COR_MODU`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`CODE_MODU`, `CODE_COR_MODU`, `CODE_FIL`, `ID_SEMSTRE`, `NOM_MODU`, `VOLUME_HORAIRE_MODU`, `VOLUME_COURS_MODU`, `VOLUME_TD_MODU`, `VOLUME_TP_MODU`, `VOLUME_AP_MODU`, `Evaluation_connaissances`, `PENDERATION`, `avancement`) VALUES
('F1MD1', 1, 'F1', 'S1', 'Algorithmique et bases de la programmation', 90, 56, 0, 56, 0, 0, '0', 0),
('F1MD10', 2, 'F1', 'S3', 'Bases de données avancées et Technologie Web', 90, 0, 0, 0, 0, 0, '0', 0),
('F1MD11', 5, 'F1', 'S3', 'Systèmes d’exploitation', 90, 0, 0, 0, 0, 0, '0', 0),
('F1MD12', 5, 'F1', 'S3', 'Réseaux informatiques', 90, 0, 0, 0, 0, 0, '0', 0),
('F1MD13', 5, 'F1', 'S4', 'Administration des systèmes de réseaux informatique', 100, 0, 0, 0, 0, 0, '0', 0),
('F1MD14', 2, 'F1', 'S4', 'Communication et Management', 80, 0, 0, 0, 0, 0, '0', 0),
('F1MD15', 5, 'F1', 'S4', 'Stages en entreprises', 80, 0, 0, 0, 0, 0, '0', 0),
('F1MD16', 2, 'F1', 'S4', 'Projet de fin d’études', 90, 0, 0, 0, 0, 0, '0', 0),
('F1MD2', 6, 'F1', 'S1', 'Architecture des ordinateurs', 90, 0, 0, 0, 0, 0, '0', 0),
('F1MD3', 2, 'F1', 'S1', 'Mathématiques', 100, 0, 0, 0, 0, 0, '0', 0),
('F1MD4', 3, 'F1', 'S1', 'Langues et TEC', 80, 0, 0, 0, 0, 0, '0', 0),
('F1MD5', 2, 'F1', 'S2', 'Systèmes d’information & bases de données', 90, 0, 0, 0, 0, 0, '0', 0),
('F1MD6', 2, 'F1', 'S2', 'Mathématiques appliquées à l’informatique', 90, 0, 0, 0, 0, 0, '0', 0),
('F1MD7', 1, 'F1', 'S2', 'Algorithmique & structures des données', 100, 0, 0, 0, 0, 0, '0', 0),
('F1MD8', 4, 'F1', 'S2', 'Communication & gestion de l’entreprise', 80, 0, 0, 0, 0, 0, '0', 0),
('F1MD9', 1, 'F1', 'S3', 'Programmation orientée objet', 90, 0, 0, 0, 0, 0, '0', 0),
('F2MD1', 8, 'F2', 'S1', 'langues et techniques d’expression', 100, 0, 0, 0, 0, 0, '0', 50),
('F2MD10', 15, 'F2', 'S3', 'genie logiciel', 100, 0, 0, 0, 0, 0, '0', 12),
('F2MD11', 14, 'F2', 'S3', 'base de donnees avancee', 100, 0, 0, 0, 0, 0, '0', 50),
('F2MD12', 11, 'F2', 'S3', 'developpement web', 100, 0, 0, 0, 0, 0, '0', 50),
('F2MD13', 13, 'F2', 'S4', 'réseaux locaux ', 90, 0, 0, 0, 0, 0, '0', 50),
('F2MD14', 8, 'F2', 'S4', 'pava', 80, 0, 0, 0, 0, 0, '0', 50),
('F2MD15', 14, 'F2', 'S4', 'projet de fin d’études', 100, 0, 0, 0, 0, 0, '0', 5),
('F2MD16', 12, 'F2', 'S4', 'stage de fin d\'etudes', 100, 0, 0, 0, 0, 0, '0', 25),
('F2MD2', 9, 'F2', 'S1', 'mathematiques i', 90, 0, 0, 0, 0, 0, '0', 50),
('F2MD3', 10, 'F2', 'S1', 'Architecture des ordinateurs', 80, 0, 0, 0, 0, 0, '0', 5),
('F2MD4', 11, 'F2', 'S1', 'algorithmique et programmation', 90, 0, 0, 0, 0, 0, '0', 50),
('F2MD5', 12, 'F2', 'S2', 'Programmation orienté objet', 100, 14, 10, 10, 5, 0, '0', 25),
('F2MD6', 11, 'F2', 'S2', 'systemes d’exploitation et reseaux informatique', 90, 0, 0, 0, 0, 0, '0', 0),
('F2MD7', 13, 'F2', 'S2', 'systemes d’information et bases de donnees', 90, 0, 0, 0, 0, 0, '0', 50),
('F2MD8', 8, 'F2', 'S2', 'langues et techniques  communication', 90, 0, 0, 0, 0, 0, '0', 50),
('F2MD9', 16, 'F2', 'S3', 'recherche operationnelle et analyse de donnees', 90, 0, 0, 0, 0, 0, '0', 5);

-- --------------------------------------------------------

--
-- Table structure for table `modules_partages`
--

DROP TABLE IF EXISTS `modules_partages`;
CREATE TABLE IF NOT EXISTS `modules_partages` (
  `CODE_MODU` varchar(50) COLLATE utf8_bin NOT NULL,
  `CODE_CORM_v` int(11) NOT NULL,
  `CODE_CORM_C` int(11) NOT NULL,
  PRIMARY KEY (`CODE_MODU`,`CODE_CORM_v`,`CODE_CORM_C`),
  KEY `f71` (`CODE_CORM_v`),
  KEY `f72` (`CODE_CORM_C`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `modules_partages`
--

INSERT INTO `modules_partages` (`CODE_MODU`, `CODE_CORM_v`, `CODE_CORM_C`) VALUES
('F2MD5', 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `module_didactique`
--

DROP TABLE IF EXISTS `module_didactique`;
CREATE TABLE IF NOT EXISTS `module_didactique` (
  `CODE_MODU` varchar(50) COLLATE utf8_bin NOT NULL,
  `CODE_DIDACTIQUE_MODU` int(11) NOT NULL,
  PRIMARY KEY (`CODE_MODU`,`CODE_DIDACTIQUE_MODU`),
  KEY `FK_DEPEND2` (`CODE_DIDACTIQUE_MODU`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `module_didactique`
--

INSERT INTO `module_didactique` (`CODE_MODU`, `CODE_DIDACTIQUE_MODU`) VALUES
('F1MD1', 1),
('F1MD11', 1),
('F1MD13', 1),
('F1MD1', 2),
('F1MD13', 2),
('F1MD1', 3),
('F1MD11', 3),
('F1MD13', 3),
('F1MD1', 4),
('F1MD11', 4),
('F1MD13', 4),
('F1MD11', 5),
('F1MD13', 5),
('F2MD1', 6),
('F2MD1', 7),
('F2MD8', 7),
('F2MD1', 8),
('F2MD1', 9),
('F2MD11', 9),
('F2MD8', 9),
('F2MD16', 10),
('F2MD1', 11),
('F2MD11', 11),
('F2MD12', 11),
('F2MD5', 11),
('F2MD6', 11),
('F2MD8', 11),
('F2MD9', 11),
('F2MD1', 12),
('F2MD2', 13),
('F2MD11', 14),
('F2MD12', 14),
('F2MD2', 14),
('F2MD6', 14),
('F2MD7', 14),
('F2MD9', 14),
('F2MD2', 15),
('F2MD3', 16),
('F2MD4', 17),
('F2MD5', 18),
('F2MD6', 18),
('F2MD7', 18),
('F2MD14', 19),
('F2MD5', 19),
('F2MD10', 20),
('F2MD12', 20),
('F2MD5', 20),
('F2MD6', 20),
('F2MD7', 20),
('F2MD12', 21),
('F2MD5', 21),
('F2MD6', 21),
('F2MD7', 21),
('F2MD7', 22),
('F2MD8', 23),
('F2MD9', 24),
('F2MD10', 25),
('F2MD10', 26),
('F2MD10', 27),
('F2MD11', 28),
('F2MD12', 29),
('F2MD14', 29),
('F2MD12', 30),
('F2MD13', 31),
('F2MD13', 32),
('F2MD13', 33),
('F2MD14', 34),
('F2MD14', 35),
('F2MD14', 36),
('F2MD15', 37),
('F2MD16', 37),
('F2MD15', 38),
('F2MD16', 38);

-- --------------------------------------------------------

--
-- Table structure for table `module_prerequis`
--

DROP TABLE IF EXISTS `module_prerequis`;
CREATE TABLE IF NOT EXISTS `module_prerequis` (
  `CODE_MODU` varchar(50) COLLATE utf8_bin NOT NULL,
  `code_pre` int(11) NOT NULL,
  PRIMARY KEY (`CODE_MODU`,`code_pre`),
  KEY `f57` (`code_pre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `module_prerequis`
--

INSERT INTO `module_prerequis` (`CODE_MODU`, `code_pre`) VALUES
('F2MD16', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mot_cle`
--

DROP TABLE IF EXISTS `mot_cle`;
CREATE TABLE IF NOT EXISTS `mot_cle` (
  `CODE_MOTCLE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_MOTCLE` varchar(200) NOT NULL,
  PRIMARY KEY (`CODE_MOTCLE`),
  UNIQUE KEY `NOM_MOTCLE` (`NOM_MOTCLE`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mot_cle`
--

INSERT INTO `mot_cle` (`CODE_MOTCLE`, `NOM_MOTCLE`) VALUES
(1, 'Informatique'),
(2, 'Génie logiciel'),
(3, 'Réseaux informatiques'),
(4, 'Systèmes d’exploitation'),
(5, 'Systèmes d’information'),
(6, 'Bases de données'),
(7, 'Technologies WEB');

-- --------------------------------------------------------

--
-- Table structure for table `objectifs`
--

DROP TABLE IF EXISTS `objectifs`;
CREATE TABLE IF NOT EXISTS `objectifs` (
  `CODE_OBJECTIF_MODU` int(11) NOT NULL AUTO_INCREMENT,
  `OBJECTIFS_MODU` text COLLATE utf8_bin,
  PRIMARY KEY (`CODE_OBJECTIF_MODU`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `objectifs`
--

INSERT INTO `objectifs` (`CODE_OBJECTIF_MODU`, `OBJECTIFS_MODU`) VALUES
(1, 'Apprendre à l’étudiant les différentes étapes nécessaires pour analyser un problème informatique et concevoir un algorithme pour le résoudre'),
(2, 'Ecrire et utiliser des structures de données complexes, et des algorithmes non triviaux.'),
(3, 'Réfléchir de façon abstraite, en distinguant spécification et implémentation et en s\'aidant de formalismes adéquats (pseudo-code).'),
(4, 'Maîtriser les techniques de programmation.'),
(5, 'Maîtriser le modèle de programmation fonctionnelle dans lequel l\'objet de base est une fonction.'),
(6, 'Comprendre les principaux concepts de la programmation modulaire.'),
(7, 'Comprendre les méthodes de codage et de représentation de l’information et les traitements associés'),
(8, 'Comprendre le fonctionnement des circuits combinatoires et séquentiels associés au traitement des données'),
(9, 'Comprendre la structure et l’organisation de la mémoire, du processeur et des périphériques et savoir les identifier'),
(10, 'Comprendre le fonctionnement de l’ordinateur et maîtriser la programmation assembleur (programmation en langage d’assemblage et techniques d’interfaçage).'),
(11, 'familiariser les étudiants avec les bases de la communication'),
(12, 'développer les capacités de communication en anglais'),
(13, 'connaître l\'environnement économique général, micro et macroéconomique'),
(14, 'connaître la structure et l\'organisation des entreprises et des administrations'),
(15, 'prendre conscience de l\'importance particulière de l\'informatique et de ses implications économiques et sociales'),
(16, 'connaître l’organisation d’une comptabilité de gestion'),
(17, 'connaître les méthodes de calcul de coûts'),
(18, 'connaître les principes, méthodes et outils du contrôle de gestion'),
(19, 'connaître les principes et méthodes d’élaboration des budgets et du contrôle budgétaire'),
(20, 'préparer l’étudiant à la vie active'),
(21, 'Apprendre à résoudre un problème en adoptant une approche orientée objet'),
(22, 'Implémenter une solution orientée objet en C++ ou en Java'),
(23, 'Maîtriser les fondements, les concepts et la manipulation des bases de données objet'),
(24, 'Support du modèle objet dans Postgresql (Oracle)'),
(25, 'Etude pratiques sous Postgresql (Oracle)'),
(26, 'Introduire les mécanismes de navigateur et serveur Web.'),
(27, 'Apprendre les scripts des deux cotés client et serveur.'),
(28, 'Pouvoir développer des applications Web avec bases de données.'),
(29, 'donner aux étudiants une bonne connaissance du fonctionnement interne des logiciels d\'exploitation'),
(30, 'familiariser les étudiants avec les bases du parallélisme des systèmes d\'exploitation'),
(31, 'Introduire les notions de base sur la sécurité d’un système'),
(32, 'Administration réseaux : Installer, configurer, administrer et dépanner un réseau informatique à l’aide de différents systèmes d’exploitation (Windows Server 200x, Linux...)'),
(33, 'Connaître les principes fondamentaux des communications numériques'),
(34, 'Décrire les systèmes de transmission sur divers supports (câbles, fibres optiques, radio fixe et mobile.'),
(35, 'Donner les notions essentielles sur les réseaux de télécom (RTC, ADSL, RNIS, Frame Relay, GSM, UMTS)'),
(36, 'comprendre et gérer tous types de situations de communication formelle et informelle'),
(37, 'maîtriser la rédaction des rapports'),
(38, 'apprendre à rédiger et à présenter les documents pour l\'insertion professionnelle'),
(39, 'interpréter des données et des documents en anglais'),
(40, 'initier aux éléments de management de projet'),
(41, 'initier aux fondement et outils du management de la qualité'),
(42, 'manager un Projet ou participer à la gestion d\'un Projet'),
(43, 'planifier et assurer le suivi d\'un projet'),
(44, 'Gérer  la pratique physique, découvrir des formes ludiques permettant l’épanouissement et le divertissement.'),
(45, 'Développement des compétences psychomotrices, cognitives et socio-affectives'),
(46, 'Connaissances théoriques et pratiques des Activités Physiques et Sportives, du matériel, des équipements et des infrastructures sportives.'),
(47, 'se confronter à l’application et à la construction de règles et de fonctionnement collectif.   '),
(48, 'Renforcement du niveau de la langue française'),
(49, 'Initiation aux techniques de communication orale et écrite  en vue de mieux communiquer, de préparer un exposé oral et de rédiger un rapport technique '),
(50, 'Renforcement du niveau de la langue anglaise'),
(51, 'Ce module vise à donner à l’étudiant les bases principales des mathématiques d’un parcours scientifique tout en tenant compte des besoins spécifiques à l’informatique. Il permettra à l’étudiant d’avoir les connaissances mathématiques requises à même de développer  son aptitude à l\'expression et raisonnement logique.'),
(52, 'Les objectifs de ce module consistent à apporter les connaissances de base du fonctionnement interne des systèmes informatiques, des techniques d’interfaçage, des liaisons avec les périphériques, et à montrer les liens avec les autres disciplines : réseaux, systèmes d’exploitation, systèmes industriels'),
(53, 'Implémenter les principaux algorithmes liés aux structures de données'),
(54, 'Maîtriser les bases du langage de programmation orienté objet JAVA.'),
(55, 'Savoir résoudre un problème et formuler sa solution sur JAVA.'),
(56, 'Reconnaître la qualité d\'une solution.'),
(57, 'Donner aux étudiants une bonne connaissance du fonctionnement interne des logiciels système d’exploitation et les familiariser avec les bases du parallélisme des systèmes d’exploitation'),
(58, 'Former des techniciens supérieurs pouvant assurer la fonction d\'administrateur réseau dans une PME, ou être membre qualifié d\'un service informatique dans un organisme plus important (Faculté, Ecole, Entreprise …).'),
(59, 'Comprendre le fonctionnement du protocole TCP/IP et, d\'identifier le rôle de chaque composant de la pile TCP/IP afin de pouvoir détecter et corriger une anomalie réseau'),
(60, 'Apprendre à concevoir une application informatique au sein d\'une entreprise :'),
(61, 'qui répond effectivement aux besoins des utilisateurs '),
(62, 'en prévoyant à l\'avance ses fonctionnalités principales '),
(63, 'en vérifiant qu\'elle fait bien ce qui avait été prévu'),
(64, 'qui présente certaines qualités : capable d\'évoluer, sécurisée, documentée...'),
(65, 'Favoriser les capacités d’évolution personnelle des étudiants'),
(66, 'Développer leur culture générale'),
(67, 'Les préparer par des exercices systématiques aux diverses formes d’expression et de communication requise pour un informaticien'),
(68, 'Meilleure gestion de l’activité physique et découverte d’activités ludiques'),
(69, 'S\'initier au monde professionnel à travers le stage d\'initiation'),
(70, 'Comprendre l’approche algorithmique pour résoudre certains problèmes mathématiques dont les solutions existent et difficilement atteignable.  Acquérir les notions de somme infinie numérique et somme infinie de fonction. Résolution des problèmes de programmation linéaire par la méthode de Simplexe. Acquérir les notions de bases en théorie des graphes et optimisations des flots dans un réseau.'),
(71, 'Apprendre à modéliser les objets du monde réel en utilisant les modèles de l\'UML. Cette modélisation permettra  de bâtir une conception saine, indépendante des langages et d\'obtenir ainsi des systèmes plus faciles à maintenir. '),
(72, 'Etre capable d\'appliquer les concepts orientés objet à tous les stades du cycle de développement logiciel.'),
(73, 'Comprendre le processus de développement logiciel qui fournit la base pour une production organisée des logiciels de qualité.'),
(74, 'Apprendre à formuler le problème en utilisant les outils adéquats de manière à réaliser un cahier de charge'),
(75, 'Apprendre à distinguer l\'analyse du domaine de l\'analyse de l\'application et comprendre l\'interrelation entre elles.'),
(76, 'Manipuler, tester et comparer les outils qui entrent en jeu dans le processus logiciel.'),
(77, 'Création et  suppression d’objets : tables, vues, séquences, index.'),
(78, 'Définition des sous-programmes : procédures et fonctions.'),
(79, '- Paquetages fournis par Oracle : DBMS_SQL et EXECUTE IMMEDIATE, DBMS_OUTPUT, DBMS_PIPE, DBMS_ALERT, UTL_FILE, DBMS_LOB, DBMS_AQ'),
(80, 'Être capable de maîtriser les nouvelles techniques de mise en page Web associées à la programmation en PHP '),
(81, 'MySql XML et en Java  pour créer des sites marchands, des pages d\'administration'),
(82, 'Développer des applications client-serveur'),
(83, 'Configurer un réseau local pour un ensemble de postes informatiques, dans un environnement hétérogène (Windows, Linux) et assurer l’interconnexion avec le monde extérieur.'),
(84, 'Administrer au quotidien les serveurs rattachés au réseau informatique pour garantir, en permanence, leur disponibilité et leur sécurité.'),
(85, 'Interpréter des données et des documents'),
(86, 'Préparer l’étudiant à la vie active'),
(87, 'Développer le sens de travail d’équipe avec différents intervenants et utilisateurs'),
(88, 'Etre capable de positionner une entreprise dans son environnement juridique'),
(89, 'Le but du PFE est de permettre aux étudiants-techniciens de dernière année d’évoluer d’un stade d’assimilation des connaissances à un mode d’intégration du savoir, du savoir-faire et de maîtrise des connaissances.'),
(90, 'Permettre aux étudiants de réaliser un travail de synthèse, développer l\'esprit d\'initiative et le travail en groupe, renforcer la recherche bibliographique et l\'utilisation des moyens de communication (diapositives, rapports, fichiers techniques, dossiers techniques, etc..). '),
(91, 'le stage d’initiation permet aux étudiants de s\'initier au monde professionnel.'),
(92, 'Le stage de fin d’étude correspond à une période temporaire de mise en situation en milieu professionnel - dans les locaux de l\'entreprise - au cours de laquelle l\'étudiant acquiert des compétences professionnelles qui mettent en œuvre les acquis de sa formation en vue de l\'obtention de DUT en Génie logiciel.'),
(93, 'Le stage  permet à l’étudiant de mettre en pratique les outils théoriques et méthodologiques acquis au cours de sa formation, d\'identifier ses compétences et de conforter son objectif professionnel. Le stage a ainsi pour but de le préparer à l\'entrée dans la vie active notamment par une meilleure connaissance du monde professionnel et des activités professionnelles qui s\'y conduisent.  '),
(94, 'Apporter aux élèves de première année une formation de base en algorithmique et programmation, en mettant bien l\'accent sur ce dernier aspect. A l\'issue du cours, tous les élèves doivent être capables de comprendre et d\'utiliser par eux-mêmes, pour des applications simples, un langage de programmation'),
(95, 'zzz'),
(96, 'zz');

-- --------------------------------------------------------

--
-- Table structure for table `objectifs_modules`
--

DROP TABLE IF EXISTS `objectifs_modules`;
CREATE TABLE IF NOT EXISTS `objectifs_modules` (
  `CODE_MODU` varchar(50) COLLATE utf8_bin NOT NULL,
  `CODE_OBJECTIF_MODU` int(11) NOT NULL,
  PRIMARY KEY (`CODE_MODU`,`CODE_OBJECTIF_MODU`),
  KEY `fk_obj` (`CODE_OBJECTIF_MODU`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `objectifs_modules`
--

INSERT INTO `objectifs_modules` (`CODE_MODU`, `CODE_OBJECTIF_MODU`) VALUES
('F1MD1', 1),
('F2MD16', 1),
('F1MD1', 2),
('F1MD1', 3),
('F1MD1', 4),
('F1MD1', 5),
('F1MD1', 6),
('F1MD2', 7),
('F1MD2', 8),
('F1MD2', 9),
('F1MD2', 10),
('F1MD8', 11),
('F1MD8', 12),
('F1MD8', 13),
('F1MD8', 14),
('F1MD8', 15),
('F1MD8', 16),
('F1MD8', 17),
('F1MD8', 18),
('F1MD8', 19),
('F1MD8', 20),
('F1MD9', 21),
('F1MD9', 22),
('F1MD10', 23),
('F1MD10', 24),
('F1MD10', 25),
('F1MD10', 26),
('F1MD10', 27),
('F1MD10', 28),
('F1MD11', 29),
('F1MD11', 30),
('F1MD11', 31),
('F1MD13', 32),
('F1MD13', 33),
('F1MD13', 34),
('F1MD13', 35),
('F1MD14', 36),
('F1MD14', 37),
('F1MD14', 38),
('F1MD14', 39),
('F1MD14', 40),
('F1MD14', 41),
('F1MD14', 42),
('F1MD14', 43),
('F2MD1', 44),
('F2MD1', 45),
('F2MD1', 46),
('F2MD1', 47),
('F2MD1', 48),
('F2MD1', 49),
('F2MD1', 50),
('F2MD2', 51),
('F2MD3', 52),
('F2MD5', 53),
('F2MD5', 54),
('F2MD5', 55),
('F2MD5', 56),
('F2MD6', 57),
('F2MD6', 58),
('F2MD6', 59),
('F2MD7', 60),
('F2MD7', 61),
('F2MD7', 62),
('F2MD7', 63),
('F2MD7', 64),
('F2MD8', 65),
('F2MD8', 66),
('F2MD8', 67),
('F2MD8', 68),
('F2MD8', 69),
('F2MD9', 70),
('F2MD10', 71),
('F2MD10', 72),
('F2MD10', 73),
('F2MD10', 74),
('F2MD10', 75),
('F2MD10', 76),
('F2MD11', 77),
('F2MD11', 78),
('F2MD11', 79),
('F2MD12', 80),
('F2MD12', 81),
('F2MD13', 82),
('F2MD13', 83),
('F2MD13', 84),
('F2MD14', 85),
('F2MD14', 86),
('F2MD14', 87),
('F2MD14', 88),
('F2MD15', 89),
('F2MD15', 90),
('F2MD16', 91),
('F2MD16', 92),
('F2MD4', 94);

-- --------------------------------------------------------

--
-- Table structure for table `option_filiere`
--

DROP TABLE IF EXISTS `option_filiere`;
CREATE TABLE IF NOT EXISTS `option_filiere` (
  `CODE_OPTION_FIL` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_FIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `OPTION_FIL` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`CODE_OPTION_FIL`),
  UNIQUE KEY `CODE_FIL` (`CODE_FIL`,`OPTION_FIL`),
  KEY `FK_PARTAGE` (`CODE_FIL`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `option_filiere`
--

INSERT INTO `option_filiere` (`CODE_OPTION_FIL`, `CODE_FIL`, `OPTION_FIL`) VALUES
(1, 'F1', 'Administration des Systèmes de Réseaux (ASR)'),
(3, 'F2', 'informatique');

-- --------------------------------------------------------

--
-- Table structure for table `prerequis`
--

DROP TABLE IF EXISTS `prerequis`;
CREATE TABLE IF NOT EXISTS `prerequis` (
  `code_pre` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_DOMAINE` int(11) NOT NULL,
  `prerequis` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`code_pre`),
  KEY `code_pre` (`code_pre`),
  KEY `CODE_DOMAINE` (`CODE_DOMAINE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `prerequis`
--

INSERT INTO `prerequis` (`code_pre`, `CODE_DOMAINE`, `prerequis`) VALUES
(1, 1, 'test'),
(2, 1, 'TECHNOLOGIE DU WEB');

-- --------------------------------------------------------

--
-- Table structure for table `secteur_activite`
--

DROP TABLE IF EXISTS `secteur_activite`;
CREATE TABLE IF NOT EXISTS `secteur_activite` (
  `CODE_SECTEUR` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_SECTEUR` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`CODE_SECTEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `secteur_activite`
--

INSERT INTO `secteur_activite` (`CODE_SECTEUR`, `NOM_SECTEUR`) VALUES
(1, ' Aéronautique / Spatial'),
(2, ' Agence pub / Marketing Direct'),
(3, ' Agriculture / Environnement '),
(4, ' Agroalimentaire'),
(5, ' Ameublement / Décoration'),
(6, ' Assurance / Courtage'),
(7, ' Audiovisuel'),
(8, ' Automobile / Motos / Cycles'),
(9, ' Autres Industries'),
(10, ' Autres services'),
(11, ' Banque / Finance'),
(12, ' BTP / Génie Civil'),
(13, ' Call Center / Web Center'),
(14, ' Chimie / Parachimie / Peintures'),
(15, ' Communication / Evénementiel'),
(16, ' Comptabilité / Audit'),
(17, ' Conseil / Etudes'),
(18, ' Cosmétique / Parfumerie / Luxe'),
(19, ' Distribution'),
(20, ' Edition / Imprimerie'),
(21, ' Education / Formation'),
(22, ' Electro-mécanique / Mécanique'),
(23, ' Electronique'),
(24, ' Energie'),
(25, ' Extraction / Mines'),
(26, ' Ferroviaire'),
(27, ' Hôtellerie / Restauration'),
(28, ' Immobilier / Promoteur / Agence'),
(29, ' Import / Export / Négoce'),
(30, ' Informatique'),
(31, ' Internet / Multimédia'),
(32, ' Juridique / Cabinet d’avocats'),
(33, ' Matériel Médical / Parapharmacie'),
(34, ' Métallurgie / Sidérurgie'),
(35, ' Nettoyage / Sécurité / Gardiennage'),
(36, ' Offshoring / Nearshoring'),
(37, ' Papier / Carton'),
(38, ' Pétrole / Gaz'),
(39, ' Pharmacie / Santé'),
(40, ' Plasturgie'),
(41, ' Presse'),
(42, ' Recrutement / Intérim'),
(43, ' Service public / Administration'),
(44, ' Tabac'),
(45, ' Telecom'),
(46, ' Textile / Cuir'),
(47, ' Tourisme / Voyage / Loisirs '),
(48, ' Transport / Messagerie / Logistique');

-- --------------------------------------------------------

--
-- Table structure for table `semstre`
--

DROP TABLE IF EXISTS `semstre`;
CREATE TABLE IF NOT EXISTS `semstre` (
  `ID_SEMSTRE` varchar(50) COLLATE utf8_bin NOT NULL,
  `ID_ANNE` varchar(50) COLLATE utf8_bin NOT NULL,
  `NB_SEMAINE_MAX` int(11) DEFAULT NULL,
  `NB_SEMAINE_MIN` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_SEMSTRE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `specialite_crm`
--

DROP TABLE IF EXISTS `specialite_crm`;
CREATE TABLE IF NOT EXISTS `specialite_crm` (
  `CODE_SPEC` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_SPEC` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`CODE_SPEC`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `specialite_crm`
--

INSERT INTO `specialite_crm` (`CODE_SPEC`, `NOM_SPEC`) VALUES
(1, 'Français - Anglais'),
(2, 'Sciences de gestion'),
(3, 'INFORMATIQUE'),
(4, 'Management logistique'),
(5, 'TEC'),
(6, 'Génie Minéral – Mines'),
(7, 'Techniques de gestion'),
(8, 'MATHEMATIQUE'),
(9, 'INFORMATIQUE INDUSTRIELLE'),
(10, 'MATHEMATIQUES & INFORMATIQUE'),
(11, 'LANGUES'),
(12, 'COMMUNICATION'),
(13, 'GENIE MINERAL');

-- --------------------------------------------------------

--
-- Table structure for table `super_utilisateur`
--

DROP TABLE IF EXISTS `super_utilisateur`;
CREATE TABLE IF NOT EXISTS `super_utilisateur` (
  `CODE_SUPER_UTILISATEUR` varchar(50) COLLATE utf8_bin NOT NULL,
  `PSEUDO` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PASSWORD` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`CODE_SUPER_UTILISATEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `super_utilisateur`
--

INSERT INTO `super_utilisateur` (`CODE_SUPER_UTILISATEUR`, `PSEUDO`, `PASSWORD`) VALUES
('1', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `type_diplome`
--

DROP TABLE IF EXISTS `type_diplome`;
CREATE TABLE IF NOT EXISTS `type_diplome` (
  `CODE_TYPE_DIPLOME` int(11) NOT NULL,
  `NOM_TYPE_DIPLOME` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`CODE_TYPE_DIPLOME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `type_diplome`
--

INSERT INTO `type_diplome` (`CODE_TYPE_DIPLOME`, `NOM_TYPE_DIPLOME`) VALUES
(1, 'Baccalauréat'),
(2, 'Diplôme Universitaire De Technologique'),
(3, 'licence professionnelle');

-- --------------------------------------------------------

--
-- Table structure for table `type_d_intervention`
--

DROP TABLE IF EXISTS `type_d_intervention`;
CREATE TABLE IF NOT EXISTS `type_d_intervention` (
  `CODE_INTERVENTION` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE_INTERVENTION` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`CODE_INTERVENTION`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `type_d_intervention`
--

INSERT INTO `type_d_intervention` (`CODE_INTERVENTION`, `TYPE_INTERVENTION`) VALUES
(1, 'Cours'),
(2, 'TD'),
(3, 'TP'),
(4, 'Encadrement');

-- --------------------------------------------------------

--
-- Table structure for table `universite`
--

DROP TABLE IF EXISTS `universite`;
CREATE TABLE IF NOT EXISTS `universite` (
  `CODE_UNIVERSITE` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_VILLE` int(11) DEFAULT NULL,
  `NOM_UNIVERSITE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`CODE_UNIVERSITE`),
  KEY `CODE_VILLE` (`CODE_VILLE`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `universite`
--

INSERT INTO `universite` (`CODE_UNIVERSITE`, `CODE_VILLE`, `NOM_UNIVERSITE`) VALUES
(1, 1, 'Université Cadi Ayyad '),
(2, 2, 'Université Mohammed V Agdal Rabat'),
(3, 3, 'Université Mohammed Premier'),
(4, 4, 'Université Sultan Moulay Slimane'),
(5, 5, 'Université Ibn Zohr '),
(6, 6, 'Université Moulay Ismaïl  '),
(7, 7, 'Université HASSAN Premier '),
(8, 8, 'Université Sidi Mohamed Ben Abdelah '),
(9, 9, 'Université Hassan II Casablanca');

-- --------------------------------------------------------

--
-- Table structure for table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `CODE_VILLE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_VILLE` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`CODE_VILLE`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ville`
--

INSERT INTO `ville` (`CODE_VILLE`, `NOM_VILLE`) VALUES
(1, 'Marrakesh'),
(2, 'Rabat'),
(3, 'Oujda'),
(4, 'Béni Mellal'),
(5, 'Agadir'),
(6, 'Meknès'),
(7, 'Settat'),
(8, 'Fès'),
(9, 'Casablanca ');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaiire`
--
ALTER TABLE `commentaiire`
  ADD CONSTRAINT `fk_commentaiire_filiere` FOREIGN KEY (`CODE_FIL`) REFERENCES `filiere` (`CODE_FIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commentaiireens`
--
ALTER TABLE `commentaiireens`
  ADD CONSTRAINT `fk_commentaiireens_CODE_MAT` FOREIGN KEY (`CODE_MAT`) REFERENCES `matiere` (`CODE_MAT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commentaiirereply`
--
ALTER TABLE `commentaiirereply`
  ADD CONSTRAINT `fk_commentaiirereply_code_comment	` FOREIGN KEY (`code_comment`) REFERENCES `commentaiire` (`code_comment`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commentaiirereplyens`
--
ALTER TABLE `commentaiirereplyens`
  ADD CONSTRAINT `fk_commentaiirereplyens_code_comment` FOREIGN KEY (`code_comment`) REFERENCES `commentaiireens` (`code_comment`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commentlikedislike`
--
ALTER TABLE `commentlikedislike`
  ADD CONSTRAINT `fk_commentlikedislike_code_comment` FOREIGN KEY (`code_comment`) REFERENCES `commentaiire` (`code_comment`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commentlikedislikeens`
--
ALTER TABLE `commentlikedislikeens`
  ADD CONSTRAINT `fk_commentlikedislikeens_code_comment` FOREIGN KEY (`code_comment`) REFERENCES `commentaiireens` (`code_comment`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `competence`
--
ALTER TABLE `competence`
  ADD CONSTRAINT `fk_competence_CODE_DOMAINE` FOREIGN KEY (`CODE_DOMAINE`) REFERENCES `domaine` (`CODE_DOMAINE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filiere_diplomes`
--
ALTER TABLE `filiere_diplomes`
  ADD CONSTRAINT `bbbb` FOREIGN KEY (`CODE_FIL`) REFERENCES `filiere` (`CODE_FIL`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ggg` FOREIGN KEY (`CODE_DIPLOME`) REFERENCES `diplomes` (`CODE_DIPLOME`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
