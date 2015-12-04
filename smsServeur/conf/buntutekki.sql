-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 08 Octobre 2015 à 22:46
-- Version du serveur: 5.5.44
-- Version de PHP: 5.5.29-1+deb.sury.org~precise+3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `buntutekki`
--

-- --------------------------------------------------------

--
-- Structure de la table `action_automatique`
--

CREATE TABLE IF NOT EXISTS `action_automatique` (
  `action_id` int(11) NOT NULL AUTO_INCREMENT,
  `action_objet` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `action_description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `action_date` varchar(9) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `action_automatique`
--

INSERT INTO `action_automatique` (`action_id`, `action_objet`, `action_description`, `action_date`) VALUES
(1, 'mise à 0 champ mensualité', 'Mise à jour de la mensualité de tous les clients et pour tous les services à 0. ', '05 00:00:');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', ''),
(2, 'abdoulaye', 'kamstelecom', ''),
(4, 'bassirou', 'passer', '');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `client_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_UID` varchar(10) COLLATE utf8_bin NOT NULL,
  `client_numTel` varchar(15) COLLATE utf8_bin NOT NULL,
  `client_dateInsc` datetime NOT NULL,
  `client_extCouv` varchar(50) COLLATE utf8_bin NOT NULL,
  `client_UFR` varchar(50) COLLATE utf8_bin NOT NULL,
  `client_adrMac` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_UID` (`client_UID`),
  UNIQUE KEY `client_numTel` (`client_numTel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`client_id`, `client_UID`, `client_numTel`, `client_dateInsc`, `client_extCouv`, `client_UFR`, `client_adrMac`) VALUES
(2, '00002DK', '14', '2015-10-03 23:55:32', '', '', ''),
(10, '00010TH', '15', '2015-10-04 17:27:52', '', '', ''),
(12, '00012DK', '773675372', '2015-10-07 15:35:35', '', '', ''),
(13, '00013DK', '+22177381', '2015-10-07 15:51:31', '', '', ''),
(14, '00014SL', '773675377', '2015-10-08 00:34:40', '', '', ''),
(15, '00015SL', '773675378', '2015-10-08 00:39:37', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `historique_paiement`
--

CREATE TABLE IF NOT EXISTS `historique_paiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inscription_id` int(11) NOT NULL,
  `mois` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `annee` varchar(4) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_paiement` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inscription_id` (`inscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE IF NOT EXISTS `inscription` (
  `inscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_UID` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `service_titre` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_insc` datetime NOT NULL,
  `mensualite` enum('1','0') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `code_paiement` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '44T1M9',
  PRIMARY KEY (`inscription_id`),
  KEY `client_UID` (`client_UID`),
  KEY `service_titre` (`service_titre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `journal_sms`
--

CREATE TABLE IF NOT EXISTS `journal_sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objet` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `expediteur` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `destinataire` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `contenu` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_sms` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `journal_sms`
--

INSERT INTO `journal_sms` (`id`, `objet`, `expediteur`, `destinataire`, `contenu`, `date_sms`) VALUES
(5, 'confirmation inscription', 'serveur', '00007DK(15)', 'Bonjour, ALIENTECH vous remercie de votre intÃ©rÃªt pour ses services. Votre UID est00007DK. Pour finaliser votre inscription au service S1, merci dâ€™envoyer S1 INSCR 00007DK au 24248. Cout du SMS 490 F.', '2015-10-04 15:19:02'),
(6, 'inscription à ALIENTECH', 'serveur', 'inconnue:15', 'INSCR DK', '2015-10-04 15:27:31'),
(7, 'confirmation inscription', 'serveur', '00008DK:15', 'Bonjour, ALIENTECH vous remercie de votre intérêt pour ses services. Votre UID est00008DK. Pour finaliser votre inscription au service S1, merci d’envoyer S1 INSCR 00008DK au 24248. Cout du SMS 490 F.', '2015-10-04 15:27:31'),
(8, 'inscription au service S1', '00008DK:15', 'serveur', 'S1 CONF 00008DK', '2015-10-04 15:30:00'),
(9, 'confirmation inscription', 'serveur', '00008DK:15', 'Inscription au service S1 reussie. Pour payer votre mensualite, veuillez envoyer S1 MENS 00008DK au 24248. Cout du SMS 490 F.', '2015-10-04 15:30:01'),
(10, 'mensualité', '00008DK:15', 'serveur', 'S1 MENS 00008DK', '2015-10-04 16:24:46'),
(11, 'confirmation mensualite', 'serveur', '00008DK:15', 'Paiement non-autorisé : mensualité en cours de validité.', '2015-10-04 16:24:46'),
(12, 'mensualité', '00008DK:15', 'serveur', 'S1 MENS 00008DK', '2015-10-04 16:25:54'),
(13, 'confirmation mensualite', 'serveur', '00008DK:15', 'Paiement autorisé, veuillez envoyer S1 PM 44T1M9 00008DK au 24248 pour effectuer le paiement', '2015-10-04 16:25:54'),
(14, 'paiement', '00008DK:15', 'serveur', 'S1 PM 44T1M9 00008DK', '2015-10-04 16:26:46'),
(15, 'confirmation inscription', 'serveur', '00008DK(15)', 'Paiment réaliser avec succes. Merci pour votre fidelité à ALIENTECH', '2015-10-04 16:26:46'),
(16, 'paiement', '00008DK:15', 'serveur', 'S1 PM 44T1M9 00008DK', '2015-10-04 16:28:04'),
(17, 'confirmation inscription', 'serveur', '00008DK(15)', 'Paiment réaliser avec succes. Merci pour votre fidelité à ALIENTECH', '2015-10-04 16:28:04'),
(18, 'inscription à ALIENTECH', 'inconnue:15', 'serveur', 'S1 TH', '2015-10-04 17:27:36'),
(19, 'confirmation inscription', 'serveur', '00009TH:15', 'Bonjour, ALIENTECH vous remercie de votre intérêt pour ses services. Votre UID est00009TH. Pour finaliser votre inscription au service S1, merci d’envoyer S1 INSCR 00009TH au 24248. Cout du SMS 490 F.', '2015-10-04 17:27:37'),
(20, 'inscription à ALIENTECH', 'inconnue:15', 'serveur', 'S4 TH', '2015-10-04 17:27:52'),
(21, 'confirmation inscription', 'serveur', '00010TH:15', 'Bonjour, ALIENTECH vous remercie de votre intérêt pour ses services. Votre UID est00010TH. Pour finaliser votre inscription au service S1, merci d’envoyer S1 INSCR 00010TH au 24248. Cout du SMS 490 F.', '2015-10-04 17:27:52'),
(22, 'inscription au service S4', '00010TH:15', 'serveur', 'S4 CONF 00010TH', '2015-10-04 17:39:06'),
(23, 'confirmation inscription', 'serveur', '00010TH:15', 'Inscription au service S4 réussie. Pour payer votre mensualité, veuillez envoyer S4 MENS 00010TH au 24248. Cout du SMS 490 F.', '2015-10-04 17:39:06'),
(24, 'inscription à ALIENTECH', 'inconnue:773675372', 'serveur', 'S1 DK', '2015-10-07 15:33:26'),
(25, 'confirmation inscription', 'serveur', '00011DK:773675372', 'Bonjour, ALIENTECH vous remercie de votre intérêt pour ses services. Votre UID est00011DK. Pour finaliser votre inscription au service S1, merci d’envoyer S1 INSCR 00011DK au 24248. Cout du SMS 490 F.', '2015-10-07 15:33:28'),
(26, 'inscription à ALIENTECH', 'inconnue:773675372', 'serveur', 'S1 DK', '2015-10-07 15:35:35'),
(27, 'confirmation inscription', 'serveur', '00012DK:773675372', 'Bonjour, ALIENTECH vous remercie de votre intérêt pour ses services. Votre UID est00012DK. Pour finaliser votre inscription au service S1, merci d’envoyer S1 INSCR 00012DK au 24248. Cout du SMS 490 F.', '2015-10-07 15:35:35'),
(28, 'erreur', 'inconnue:+221773813426', 'serveur', 'S2 sl', '2015-10-07 15:49:27'),
(29, 'inscription à ALIENTECH', 'inconnue:+221773813426', 'serveur', 'S1 DK', '2015-10-07 15:51:31'),
(30, 'confirmation inscription', 'serveur', '00013DK:+221773813426', 'Bonjour, ALIENTECH vous remercie de votre intérêt pour ses services. Votre UID est00013DK. Pour finaliser votre inscription au service S1, merci d’envoyer S1 INSCR 00013DK au 24248. Cout du SMS 490 F.', '2015-10-07 15:51:31'),
(31, 'inscription à ALIENTECH', 'inconnue:773675377', 'serveur', 'S1 SL', '2015-10-08 00:34:39'),
(32, 'confirmation inscription', 'serveur', '00014SL:773675377', 'Bonjour, ALIENTECH vous remercie de votre intérêt pour ses services. Votre UID est00014SL. Pour finaliser votre inscription au service S1, merci d’envoyer S1 INSCR 00014SL au 24248. Cout du SMS 490 F.', '2015-10-08 00:34:40'),
(33, 'inscription à ALIENTECH', 'inconnue:773675378', 'serveur', 'S1 SL', '2015-10-08 00:39:37'),
(34, 'confirmation inscription', 'serveur', '00015SL:773675378', 'Bonjour, ALIENTECH vous remercie de votre intérêt pour ses services. Votre UID est00015SL. Pour finaliser votre inscription au service S1, merci d’envoyer S1 INSCR 00015SL au 24248. Cout du SMS 490 F.', '2015-10-08 00:39:37');

-- --------------------------------------------------------

--
-- Structure de la table `message_systeme`
--

CREATE TABLE IF NOT EXISTS `message_systeme` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `ms_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ms_message` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ms_motcle` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ms_id`),
  UNIQUE KEY `ms_motcle` (`ms_motcle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_titre` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `service_nom` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `service_description` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `service_numero` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`service_id`),
  UNIQUE KEY `service_titre` (`service_titre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`service_id`, `service_titre`, `service_nom`, `service_description`, `service_numero`) VALUES
(1, 'S1', 'Niou Dém', 'Vous recevez quotidiennement par SMS l’équivalent ', ''),
(2, 'S2', 'So coool', 'Votre PC et internet sont des mines de trucs cool ', ''),
(3, 'S3', 'Prog du jour', 'Recevez quotidiennement par SMS la présentation d’', ''),
(4, 'S4', 'Cpasdiable', 'Recevez quotidiennement par SMS un tutoriel pour r', '');

-- --------------------------------------------------------

--
-- Structure de la table `sms_envoie`
--

CREATE TABLE IF NOT EXISTS `sms_envoie` (
  `id_smsEnvoie` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_smsEnvoie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sms_reception`
--

CREATE TABLE IF NOT EXISTS `sms_reception` (
  `id_smsRecu` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_smsRecu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tutoriel`
--

CREATE TABLE IF NOT EXISTS `tutoriel` (
  `tutoriel_id` int(11) NOT NULL AUTO_INCREMENT,
  `tutoriel_entete` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tutoriel_contenu` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `service_titre` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tutoriel_date` datetime NOT NULL,
  `tutoriel_auteur` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`tutoriel_id`),
  KEY `service_titre` (`service_titre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `historique_paiement`
--
ALTER TABLE `historique_paiement`
  ADD CONSTRAINT `historique_paiement_ibfk_1` FOREIGN KEY (`inscription_id`) REFERENCES `inscription` (`inscription_id`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`client_UID`) REFERENCES `client` (`client_UID`),
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`service_titre`) REFERENCES `service` (`service_titre`);

--
-- Contraintes pour la table `tutoriel`
--
ALTER TABLE `tutoriel`
  ADD CONSTRAINT `tutoriel_ibfk_1` FOREIGN KEY (`service_titre`) REFERENCES `service` (`service_titre`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
