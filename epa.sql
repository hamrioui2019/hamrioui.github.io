-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 21 avr. 2020 à 18:23
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `epa`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE IF NOT EXISTS `adherent` (
  `id_user` int(250) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `numtel` int(10) DEFAULT NULL,
  `pays_origine` varchar(255) NOT NULL,
  `sexe` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `dateCotisation` date DEFAULT NULL,
  `dateInscription` datetime NOT NULL,
  `choix_paiement` varchar(255) NOT NULL,
  `valide` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id_user`, `nom`, `prenom`, `date_naissance`, `email`, `numtel`, `pays_origine`, `sexe`, `password`, `dateCotisation`, `dateInscription`, `choix_paiement`, `valide`) VALUES
(22, 'test', 't', '2000-03-03', 'test@gmail.fr', 12345768, 'Algerie', 'F', '0a5b3913cbc9a9092311630e869b4442', '2020-04-16', '2020-04-09 00:00:00', 'cheque', 1),
(21, 'bbbb', 'aaaz', '1999-04-03', 'aaze@gmail.com', 12344444, 'AZE', 'F', '0a5b3913cbc9a9092311630e869b4442', '2020-04-16', '2020-04-09 00:00:00', 'prelevement', 1),
(20, 'aaaa', 'aaaz', '1999-04-03', 'aze@gmail.com', 12344444, 'AZE', 'F', '0a5b3913cbc9a9092311630e869b4442', '2020-04-19', '2020-04-09 00:00:00', 'cheque', 1),
(19, 'aa', 'bb', '1996-01-12', 'aee@gmail.fr', 12222222, 'BB', 'M', '202cb962ac59075b964b07152d234b70', NULL, '2020-04-09 00:00:00', 'prelevement', 1),
(18, 'aa', 'bb', '1996-01-12', 'ee@gmail.fr', 12222222, 'BB', 'M', '0a5b3913cbc9a9092311630e869b4442', NULL, '2020-04-09 00:00:00', 'prelevement', 0),
(15, 'ooo', 'odile', '1234-01-01', 'odile_hamrioui@yahoo.fr', 662230786, 'AZR', 'F', '971179a4d5937b486d476ae5de648624', NULL, '2020-04-06 00:00:00', 'cheque', 1),
(24, 'testt', 'testt', '1991-04-04', 'ooo@hotmail.fr', 123456780, 'algerie', 'M', '0a5b3913cbc9a9092311630e869b4442', NULL, '2020-04-13 00:00:00', 'cheque', 0),
(25, 'change', 'BLA', '1999-01-01', 'od@gmail.fr', 12345678, 'Malawi', 'M', '0a5b3913cbc9a9092311630e869b4442', NULL, '2020-04-15 00:00:00', 'prelevement', 1);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `num_avis` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `avis` varchar(255) NOT NULL,
  `date_avis` date NOT NULL,
  PRIMARY KEY (`num_avis`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`num_avis`, `email`, `avis`, `date_avis`) VALUES
(1, 'oi@ht.fr', 'merci pour m\'avoir ajouter', '0000-00-00'),
(2, 'hello@gmail.com', 'hello there ', '2020-04-13'),
(3, 'vendredi@hotmail.fr', 'dhghgfkhgdsh', '2020-04-15');

-- --------------------------------------------------------

--
-- Structure de la table `conseiladmin`
--

DROP TABLE IF EXISTS `conseiladmin`;
CREATE TABLE IF NOT EXISTS `conseiladmin` (
  `id_ca` int(11) NOT NULL AUTO_INCREMENT,
  `nomCA` varchar(255) NOT NULL,
  `prenomCA` varchar(255) NOT NULL,
  `date_naissanceCA` date NOT NULL,
  `emailCA` varchar(255) NOT NULL,
  `passworCA` varchar(255) NOT NULL,
  `numTEL` int(11) DEFAULT NULL,
  `typeCA` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `demande_resiliation`
--

DROP TABLE IF EXISTS `demande_resiliation`;
CREATE TABLE IF NOT EXISTS `demande_resiliation` (
  `id_res` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `traite` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_res`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `demande_resiliation`
--

INSERT INTO `demande_resiliation` (`id_res`, `id_user`, `nom`, `prenom`, `traite`) VALUES
(6, 25, 'test', 'bli', 1);

-- --------------------------------------------------------

--
-- Structure de la table `docpdf`
--

DROP TABLE IF EXISTS `docpdf`;
CREATE TABLE IF NOT EXISTS `docpdf` (
  `idFile` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `dateInsert` datetime DEFAULT NULL,
  PRIMARY KEY (`idFile`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `docpdf`
--

INSERT INTO `docpdf` (`idFile`, `id_user`, `name`, `file_url`, `dateInsert`) VALUES
(46, 25, 'Javascript-objects.pdf', 'doc/Javascript-objects.pdf', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `doc_paiement`
--

DROP TABLE IF EXISTS `doc_paiement`;
CREATE TABLE IF NOT EXISTS `doc_paiement` (
  `id_paiement` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_paiement`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `doc_paiement`
--

INSERT INTO `doc_paiement` (`id_paiement`, `id_user`, `name`, `file_url`) VALUES
(17, 25, 'Cours_HTML_CSS.pdf', 'doc/Cours_HTML_CSS.pdf'),
(16, 25, 'Cours_HTML_CSS.pdf', 'doc/Cours_HTML_CSS.pdf'),
(15, 25, 'Cours_HTML_CSS.pdf', 'doc/Cours_HTML_CSS.pdf'),
(14, 25, 'Cours_HTML_CSS.pdf', 'doc/Cours_HTML_CSS.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `doc_resiliation`
--

DROP TABLE IF EXISTS `doc_resiliation`;
CREATE TABLE IF NOT EXISTS `doc_resiliation` (
  `id_docu` int(11) NOT NULL AUTO_INCREMENT,
  `id_res` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_docu`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `doc_resiliation`
--

INSERT INTO `doc_resiliation` (`id_docu`, `id_res`, `name`, `file_url`) VALUES
(2, 5, 'FICHE TD 5 RESPONSABILITE EN DROIT MIAGE 1.pdf', 'doc/FICHE TD 5 RESPONSABILITE EN DROIT MIAGE 1.pdf'),
(3, 5, 'Cours_HTML_CSS.pdf', 'doc/Cours_HTML_CSS.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `doc_reunion`
--

DROP TABLE IF EXISTS `doc_reunion`;
CREATE TABLE IF NOT EXISTS `doc_reunion` (
  `id_doc` int(11) NOT NULL AUTO_INCREMENT,
  `id_reunion` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_doc`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `doc_reunion`
--

INSERT INTO `doc_reunion` (`id_doc`, `id_reunion`, `name`, `file_url`) VALUES
(20, 2, 'Intro_Javascript.pdf', 'doc/Intro_Javascript.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `id_forum` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(255) NOT NULL,
  PRIMARY KEY (`id_forum`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum`
--

INSERT INTO `forum` (`id_forum`, `theme`) VALUES
(2, 'Accueil des étudiants en France');

-- --------------------------------------------------------

--
-- Structure de la table `forum_reponses`
--

DROP TABLE IF EXISTS `forum_reponses`;
CREATE TABLE IF NOT EXISTS `forum_reponses` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  `date_reponse` datetime DEFAULT NULL,
  `forum_sujet` int(6) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_reponses`
--

INSERT INTO `forum_reponses` (`id`, `message`, `date_reponse`, `forum_sujet`, `mail`, `pseudo`) VALUES
(26, 'je réponds ', '2020-04-21 11:20:11', 1, 'odile_hamrioui@yahoo.fr', 'moi'),
(27, 'nbnbn,b,n', '2020-04-21 11:25:26', 1, 'hh@gmail.com', 'bbb'),
(28, 'vfhgfhf', '2020-04-21 12:02:48', 7, 'odile@gmail.fr', 'moi');

-- --------------------------------------------------------

--
-- Structure de la table `forum_sujets`
--

DROP TABLE IF EXISTS `forum_sujets`;
CREATE TABLE IF NOT EXISTS `forum_sujets` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `date_ajout` datetime DEFAULT NULL,
  `id_theme` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_sujets`
--

INSERT INTO `forum_sujets` (`id`, `titre`, `message`, `mail`, `pseudo`, `date_ajout`, `id_theme`) VALUES
(1, 'je teste', 'je teste si ça marche', 'od@gmail.fr', 'change', '2020-04-21 00:00:00', 4),
(2, 'je teste', 'je teste si ça marche', 'od@gmail.fr', 'change', '2020-04-21 00:00:00', 4),
(3, 'je teste', 'je teste si ça marche', 'od@gmail.fr', 'change', '2020-04-21 00:00:00', 4),
(4, 'je teste', 'je teste si ça marche', 'od@gmail.fr', 'change', '2020-04-21 00:00:00', 4),
(5, 'utiliser un titre', 'Mon teste !', 'od@gmail.fr', 'change', '2020-04-21 00:00:00', 4),
(6, 'ccccc', 'voici un text', 'od@gmail.fr', 'change', '2020-04-21 00:00:00', 9),
(7, 'mon titre est odile', 'teste de texte', 'od@gmail.fr', 'change', '2020-04-21 00:00:00', 10);

-- --------------------------------------------------------

--
-- Structure de la table `links`
--

DROP TABLE IF EXISTS `links`;
CREATE TABLE IF NOT EXISTS `links` (
  `id_li` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_li`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membrebureau`
--

DROP TABLE IF EXISTS `membrebureau`;
CREATE TABLE IF NOT EXISTS `membrebureau` (
  `id_membre` int(11) NOT NULL AUTO_INCREMENT,
  `nomM` varchar(255) NOT NULL,
  `prenomM` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(10) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membrebureau`
--

INSERT INTO `membrebureau` (`id_membre`, `nomM`, `prenomM`, `date_naissance`, `email`, `password`, `phone`, `adresse`) VALUES
(1, 'Brunel Lobrichon', 'Geneviève', '1900-04-30', 'presidente@epa.fr', 'epa', 1234567891, NULL),
(2, 'Chan', 'Louisette', '1900-04-30', 'secretaire@epa.fr', 'chanlouisette', 1111111111, NULL),
(3, 'Goungounga', 'Hélène', '1900-04-30', 'compta@epa.fr', 'goungoungahelene', 222222222, NULL),
(4, 'Atangana', 'Symphorien', '1900-04-30', 'accueil_etudiant@epa.fr', 'atanganasymphorien', 333333333, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messageadherent`
--

DROP TABLE IF EXISTS `messageadherent`;
CREATE TABLE IF NOT EXISTS `messageadherent` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `message` varchar(400) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_message`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messageadherent`
--

INSERT INTO `messageadherent` (`id_message`, `id_user`, `objet`, `message`, `date`) VALUES
(7, 25, 'Message de bienvenue', 'Bonjour, \r\nmerci de nous avoir rejoint\r\ncordialement, \r\nLouisette Chan		              		', '2020-04-16');

-- --------------------------------------------------------

--
-- Structure de la table `messagemembre`
--

DROP TABLE IF EXISTS `messagemembre`;
CREATE TABLE IF NOT EXISTS `messagemembre` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `message` varchar(400) NOT NULL,
  `datemes` date NOT NULL,
  PRIMARY KEY (`id_message`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messagemembre`
--

INSERT INTO `messagemembre` (`id_message`, `id_membre`, `objet`, `message`, `datemes`) VALUES
(42, 3, 'gg', 'Cordialement, La Présidente - EPA\r\n		              		', '0000-00-00'),
(41, 2, 'gg', 'Cordialement, La Présidente - EPA\r\n		              		', '0000-00-00'),
(40, 2, 'nayaa', 'Cordialement, La Présidente - EPA\r\n		              		', '0000-00-00'),
(39, 2, 'REUNION D URGENCE ', 'Cordialement, La Présidente - EPA\r\n		              	jgjfjjv	', '0000-00-00'),
(38, 4, 'vjvjj', 'jhjhjhj Cordialement, La Présidente - EPA\r\n		              		', '0000-00-00'),
(37, 3, 'vjvjj', 'jhjhjhj Cordialement, La Présidente - EPA\r\n		              		', '0000-00-00'),
(36, 2, 'vjvjj', 'jhjhjhj Cordialement, La Présidente - EPA\r\n		              		', '0000-00-00'),
(35, 2, 'ggg', 'gCordialement, La Présidente - EPA\r\n		              		', '0000-00-00'),
(43, 4, 'gg', 'Cordialement, La Présidente - EPA\r\n		              		', '0000-00-00'),
(44, 2, 'DNF', 'Cordialement, La Présidente - EPA\r\n		              		', '0000-00-00'),
(45, 3, 'DNF', 'Cordialement, La Présidente - EPA\r\n		              		', '0000-00-00'),
(46, 4, 'DNF', 'Cordialement, La Présidente - EPA\r\n		              		', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `messages_entre_adherent`
--

DROP TABLE IF EXISTS `messages_entre_adherent`;
CREATE TABLE IF NOT EXISTS `messages_entre_adherent` (
  `id_mes` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datemessage` date NOT NULL,
  PRIMARY KEY (`id_mes`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages_entre_adherent`
--

INSERT INTO `messages_entre_adherent` (`id_mes`, `id_user`, `objet`, `message`, `datemessage`) VALUES
(1, 23, 'Bonjour', 'ce ci est un test', '2020-04-16'),
(2, 25, 'fdfhdfhnncncnc', 'Merci de préciser votre nom et prenom à la fin de votre message\r\n		              		', '2020-04-16');

-- --------------------------------------------------------

--
-- Structure de la table `notification_paiement`
--

DROP TABLE IF EXISTS `notification_paiement`;
CREATE TABLE IF NOT EXISTS `notification_paiement` (
  `id_not` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `date_note` int(11) NOT NULL,
  PRIMARY KEY (`id_not`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notification_reunion`
--

DROP TABLE IF EXISTS `notification_reunion`;
CREATE TABLE IF NOT EXISTS `notification_reunion` (
  `id_notif` int(11) NOT NULL AUTO_INCREMENT,
  `id_reunion` int(11) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `date_notification` date NOT NULL,
  PRIMARY KEY (`id_notif`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `notification_reunion`
--

INSERT INTO `notification_reunion` (`id_notif`, `id_reunion`, `notification`, `date_notification`) VALUES
(1, 2, 'Nouvelle notification', '2020-04-15'),
(2, 2, 'Nouvelle notification', '2020-04-15'),
(3, 2, 'Nouvelle notification', '2020-04-15'),
(4, 2, 'Nouvelle notification', '2020-04-15'),
(5, 2, 'Nouvelle notification', '2020-04-15'),
(6, 2, 'Nouvelle notification', '2020-04-15'),
(7, 2, 'Nouvelle notification', '2020-04-15'),
(8, 2, 'Nouvelle notification', '2020-04-15'),
(9, 2, 'Nouvelle notification', '2020-04-15'),
(10, 2, 'Nouvelle notification', '2020-04-15'),
(11, 2, 'Nouvelle notification', '2020-04-15'),
(12, 2, 'Nouvelle notification', '2020-04-15'),
(13, 2, 'Nouvelle notification', '2020-04-15'),
(14, 2, 'Nouvelle notification', '2020-04-15'),
(15, 2, 'Nouvelle notification', '2020-04-15');

-- --------------------------------------------------------

--
-- Structure de la table `ordredujour`
--

DROP TABLE IF EXISTS `ordredujour`;
CREATE TABLE IF NOT EXISTS `ordredujour` (
  `id_ordre` int(11) NOT NULL AUTO_INCREMENT,
  `ordre` varchar(255) NOT NULL,
  `date_ordre` date NOT NULL,
  PRIMARY KEY (`id_ordre`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ordredujour`
--

INSERT INTO `ordredujour` (`id_ordre`, `ordre`, `date_ordre`) VALUES
(8, 'je viens de rentrer', '2020-04-19'),
(7, 'je viens de rentrer', '2020-04-19'),
(6, 'je viens de rentrer', '2020-04-19');

-- --------------------------------------------------------

--
-- Structure de la table `reunion`
--

DROP TABLE IF EXISTS `reunion`;
CREATE TABLE IF NOT EXISTS `reunion` (
  `id_reunion` int(11) NOT NULL AUTO_INCREMENT,
  `lieu` varchar(255) NOT NULL,
  `dat` date NOT NULL,
  `objet` varchar(255) NOT NULL,
  `diffuse` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_reunion`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reunion`
--

INSERT INTO `reunion` (`id_reunion`, `lieu`, `dat`, `objet`, `diffuse`) VALUES
(2, 'PARIS', '2021-02-02', 'nayaa', 1),
(3, 'PARIS', '2020-05-15', 'reunion kan ', 1),
(4, 'PARIS', '2021-02-01', 'voici un objet', 0);

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT,
  `nomTheme` varchar(255) NOT NULL,
  PRIMARY KEY (`id_theme`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`id_theme`, `nomTheme`) VALUES
(9, 'nouveau theme'),
(10, 'theme 0'),
(4, 'Action Sociale et solidaire');

-- --------------------------------------------------------

--
-- Structure de la table `theme_abonne`
--

DROP TABLE IF EXISTS `theme_abonne`;
CREATE TABLE IF NOT EXISTS `theme_abonne` (
  `id_ab` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nomTheme` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ab`)
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theme_abonne`
--

INSERT INTO `theme_abonne` (`id_ab`, `id_user`, `nomTheme`) VALUES
(130, 25, 'Action Sociale et solidaire'),
(131, 25, 'nouveau theme'),
(129, 25, 'Education'),
(128, 25, 'Santé et Mutuelle'),
(127, 25, 'Accueil des étudiants en France'),
(126, 24, 'Action Sociale et solidaire'),
(125, 24, 'Education');

-- --------------------------------------------------------

--
-- Structure de la table `traitement_resiliation`
--

DROP TABLE IF EXISTS `traitement_resiliation`;
CREATE TABLE IF NOT EXISTS `traitement_resiliation` (
  `id_trait` int(11) NOT NULL AUTO_INCREMENT,
  `id_res` int(11) NOT NULL,
  `message` text NOT NULL,
  `objet` varchar(255) NOT NULL,
  `datetrait` date NOT NULL,
  PRIMARY KEY (`id_trait`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `traitement_resiliation`
--

INSERT INTO `traitement_resiliation` (`id_trait`, `id_res`, `message`, `objet`, `datetrait`) VALUES
(4, 6, 'vshkjkjfjfjfj\r\n\r\nEntrez votre texte', 'xkjdkjdkj', '2020-04-19'),
(3, 5, 'fhjhjfhfbhjEntrez votre texte', 'isjkkf', '2020-04-16');

-- --------------------------------------------------------

--
-- Structure de la table `volontaire`
--

DROP TABLE IF EXISTS `volontaire`;
CREATE TABLE IF NOT EXISTS `volontaire` (
  `id_vol` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `date_vol` date NOT NULL,
  PRIMARY KEY (`id_vol`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `volontaire`
--

INSERT INTO `volontaire` (`id_vol`, `id_user`, `date_vol`) VALUES
(8, 23, '2020-04-16'),
(7, 24, '2020-04-16'),
(6, 25, '2020-04-16'),
(5, 23, '2020-04-16'),
(9, 22, '2020-04-16'),
(10, 22, '2020-04-16');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
