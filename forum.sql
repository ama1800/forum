-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour cinema
CREATE DATABASE IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cinema`;

-- Listage de la structure de la table cinema. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_acteur` varchar(50) NOT NULL,
  `prenom_acteur` varchar(50) NOT NULL,
  `sexe` char(50) NOT NULL DEFAULT '',
  `date_naissance` date NOT NULL,
  PRIMARY KEY (`id_acteur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.acteur : ~10 rows (environ)
/*!40000 ALTER TABLE `acteur` DISABLE KEYS */;
INSERT INTO `acteur` (`id_acteur`, `nom_acteur`, `prenom_acteur`, `sexe`, `date_naissance`) VALUES
	(1, 'jolie', 'jaquline', 'femme', '1948-09-15');
INSERT INTO `acteur` (`id_acteur`, `nom_acteur`, `prenom_acteur`, `sexe`, `date_naissance`) VALUES
	(2, 'mourad', 'skirch', 'homme', '1999-12-15');
INSERT INTO `acteur` (`id_acteur`, `nom_acteur`, `prenom_acteur`, `sexe`, `date_naissance`) VALUES
	(3, 'mathieu', 'guirin', 'homme', '1975-10-02');
INSERT INTO `acteur` (`id_acteur`, `nom_acteur`, `prenom_acteur`, `sexe`, `date_naissance`) VALUES
	(4, 'nasser', 'belkebch', 'homme', '1960-10-28');
INSERT INTO `acteur` (`id_acteur`, `nom_acteur`, `prenom_acteur`, `sexe`, `date_naissance`) VALUES
	(5, 'nora', 'touzi', 'femme', '1978-05-11');
INSERT INTO `acteur` (`id_acteur`, `nom_acteur`, `prenom_acteur`, `sexe`, `date_naissance`) VALUES
	(6, 'tomo', 'lkrrak', 'femme', '1989-05-18');
INSERT INTO `acteur` (`id_acteur`, `nom_acteur`, `prenom_acteur`, `sexe`, `date_naissance`) VALUES
	(7, 'soho', 'kawazaki', 'homme', '2005-01-09');
INSERT INTO `acteur` (`id_acteur`, `nom_acteur`, `prenom_acteur`, `sexe`, `date_naissance`) VALUES
	(8, 'nouri', 'chourri', 'homme', '1955-01-01');
INSERT INTO `acteur` (`id_acteur`, `nom_acteur`, `prenom_acteur`, `sexe`, `date_naissance`) VALUES
	(9, 'tayfoun', 'bolabi', 'homme', '2003-09-12');
INSERT INTO `acteur` (`id_acteur`, `nom_acteur`, `prenom_acteur`, `sexe`, `date_naissance`) VALUES
	(10, 'kaloucha', 'bowalia', 'femme', '2000-09-12');
/*!40000 ALTER TABLE `acteur` ENABLE KEYS */;

-- Listage de la structure de la table cinema. appartient
CREATE TABLE IF NOT EXISTS `appartient` (
  `id_genre` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  PRIMARY KEY (`id_genre`,`id_film`),
  KEY `appartient_Film0_FK` (`id_film`),
  CONSTRAINT `appartient_Film0_FK` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `appartient_Genre_FK` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.appartient : ~12 rows (environ)
/*!40000 ALTER TABLE `appartient` DISABLE KEYS */;
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(2, 1);
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(8, 2);
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(2, 3);
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(1, 4);
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(6, 4);
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(1, 5);
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(4, 5);
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(2, 6);
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(7, 7);
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(8, 8);
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(3, 9);
INSERT INTO `appartient` (`id_genre`, `id_film`) VALUES
	(4, 10);
/*!40000 ALTER TABLE `appartient` ENABLE KEYS */;

-- Listage de la structure de la table cinema. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `id_film` int(11) NOT NULL,
  `id_acteur` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  PRIMARY KEY (`id_film`,`id_acteur`,`id_role`),
  KEY `casting_Acteur0_FK` (`id_acteur`),
  KEY `casting_Role1_FK` (`id_role`),
  CONSTRAINT `casting_Acteur0_FK` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `casting_Film_FK` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `casting_Role1_FK` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.casting : ~18 rows (environ)
/*!40000 ALTER TABLE `casting` DISABLE KEYS */;
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 4);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(8, 1, 11);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 2, 3);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(4, 2, 9);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(2, 3, 1);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(4, 3, 9);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(3, 4, 1);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(3, 4, 2);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 5, 5);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(5, 5, 3);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 7, 13);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(4, 7, 9);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(7, 7, 14);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(2, 8, 6);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(5, 8, 13);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(4, 10, 5);
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(5, 10, 10);
/*!40000 ALTER TABLE `casting` ENABLE KEYS */;

-- Listage de la structure de la table cinema. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `annee` year(4) NOT NULL,
  `note` int(5) NOT NULL,
  `synopsis` text NOT NULL,
  `affiche` varchar(255) NOT NULL,
  `id_real` int(11) NOT NULL,
  `duree` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`id_film`),
  KEY `Film_Realisateur_FK` (`id_real`),
  CONSTRAINT `Film_Realisateur_FK` FOREIGN KEY (`id_real`) REFERENCES `realisateur` (`id_real`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.film : ~10 rows (environ)
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` (`id_film`, `titre`, `annee`, `note`, `synopsis`, `affiche`, `id_real`, `duree`) VALUES
	(1, 'couco', '2003', 3, 'matin ensolille des coucou qui saut par tout', 'https://www.premiere.fr/sites/default/files/styles/scale_crop_336x486/public/plurimedia_import/7_1324475.jpg', 5, '01:55:00');
INSERT INTO `film` (`id_film`, `titre`, `annee`, `note`, `synopsis`, `affiche`, `id_real`, `duree`) VALUES
	(2, 'matuzami', '2015', 2, 'matuzami jeune partie en vacance il decide d\'y rester', 'https://media.senscritique.com/media/000019174841/325/L_Appel_de_la_foret.jpg', 5, '02:30:00');
INSERT INTO `film` (`id_film`, `titre`, `annee`, `note`, `synopsis`, `affiche`, `id_real`, `duree`) VALUES
	(3, 'foot', '2020', 4, 'match de foot qui provoque une guerre mondile qui s\'achéve lorsque l\'arbitre l\'a decider', 'https://img-4.linternaute.com/nJJJieUhKc0YjlMSVWkAY8_nItU=/405x540/d7d61959cda54f8aa45d4ef495fc202e/ccmcms-linternaute/186953.jpg', 10, '02:20:00');
INSERT INTO `film` (`id_film`, `titre`, `annee`, `note`, `synopsis`, `affiche`, `id_real`, `duree`) VALUES
	(4, 'jungle', '2018', 4, 'la vie mouvementer en jungle ou le plus fort devore le faible', 'https://fr.web.img5.acsta.net/pictures/19/12/04/15/26/0979818.jpg', 1, '01:50:00');
INSERT INTO `film` (`id_film`, `titre`, `annee`, `note`, `synopsis`, `affiche`, `id_real`, `duree`) VALUES
	(5, 'samuel passe lui la sauce', '2012', 2, 'un pere de famille essaye d\'apprendre a ces enfants les bonnes maniere. mais ..', 'https://www.france.tv/image/vignette_3x4/346/461/7/m/i/d5f5fcfc-phpu5gim7.jpg', 1, '01:45:00');
INSERT INTO `film` (`id_film`, `titre`, `annee`, `note`, `synopsis`, `affiche`, `id_real`, `duree`) VALUES
	(6, 'loli', '2019', 4, 'loli jeune femme qui se marie, et realise commen sa vie va mieux jusqu\'ou...', 'https://fr.web.img5.acsta.net/pictures/20/01/23/09/02/1428612.jpg', 2, '02:25:00');
INSERT INTO `film` (`id_film`, `titre`, `annee`, `note`, `synopsis`, `affiche`, `id_real`, `duree`) VALUES
	(7, 'rue droite', '2001', 4, 'rue longue plein de monde et d\'evenements surpprises', 'https://media.senscritique.com/media/000018630904/source_big/Once_Upon_a_Time_in_Hollywood.jpg', 13, '02:25:00');
INSERT INTO `film` (`id_film`, `titre`, `annee`, `note`, `synopsis`, `affiche`, `id_real`, `duree`) VALUES
	(8, 'un matin', '1955', 4, 'histoire d\'amour qui voit le jour un matin sombre', 'https://www.mariefrance.fr/wp-content/uploads/sites/5/2018/08/will-hunting-286x410.jpg', 12, '02:25:00');
INSERT INTO `film` (`id_film`, `titre`, `annee`, `note`, `synopsis`, `affiche`, `id_real`, `duree`) VALUES
	(9, 'envoyer par php', '2012', 5, 'apres un combat achaarrné.. php a finalement ceder et le film et ajouter avec succe', 'https://kevinfolio.com/img/php.jpg', 4, '02:33:00');
INSERT INTO `film` (`id_film`, `titre`, `annee`, `note`, `synopsis`, `affiche`, `id_real`, `duree`) VALUES
	(10, 'casser les oeufs', '2020', 4, 'deux œufs qui se battent. Du coup se termine en omelette.', 'https://www.cchobby.fr/media/catalog/product/cache/8/image/9df78eab33525d08d6e5fb8d27136e95/v/1/v15282.jpg', 13, '01:55:00');
/*!40000 ALTER TABLE `film` ENABLE KEYS */;

-- Listage de la structure de la table cinema. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `nom_genre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_genre`),
  UNIQUE KEY `nom_genre` (`nom_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.genre : ~10 rows (environ)
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(1, 'Action');
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(4, 'Animation');
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(8, 'aventure');
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(12, 'Classic');
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(7, 'comedie');
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(2, 'Drame');
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(3, 'famille');
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(5, 'Fiction');
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(9, 'histoire');
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(6, 'Suspense');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Listage de la structure de la table cinema. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_real` int(11) NOT NULL AUTO_INCREMENT,
  `nom_realisateur` varchar(50) NOT NULL,
  `prenom_realisateur` varchar(50) NOT NULL,
  PRIMARY KEY (`id_real`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.realisateur : ~12 rows (environ)
/*!40000 ALTER TABLE `realisateur` DISABLE KEYS */;
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(1, 'kommi', 'jommi');
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(2, 'mathias', 'zombiz');
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(3, 'Nattan', 'Chorer');
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(4, 'serio', 'serge');
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(5, 'coustco', 'manuel');
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(6, 'rico', 'lorent');
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(7, 'myrie', 'renisse');
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(9, 'passo', 'jarisse');
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(10, 'toto', 'roland');
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(11, 'mourad', 'skirch');
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(12, 'nora', 'touzi');
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(13, 'kaloucha', 'bowalia');
INSERT INTO `realisateur` (`id_real`, `nom_realisateur`, `prenom_realisateur`) VALUES
	(14, 'Mattata', 'Hakona');
/*!40000 ALTER TABLE `realisateur` ENABLE KEYS */;

-- Listage de la structure de la table cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.role : ~13 rows (environ)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(1, 'cowbow');
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(2, 'Policier');
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(3, 'jean marque');
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(4, 'jolie jannette');
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(5, 'directrice');
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(6, 'le voleur');
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(8, 'batman');
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(9, 'superman');
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(10, 'battwomen');
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(11, 'tariq');
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(13, 'fontome');
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(14, 'boxeur');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Listage de la structure de la table cinema. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `psuedo` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `psuedo` (`psuedo`,`email`),
  KEY `email` (`email`,`psuedo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.user : ~7 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `psuedo`, `password`, `email`, `nom`, `prenom`) VALUES
	(1, 'ama1800', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'ama12@exemple.fr', 'hamed', 'ahmed');
INSERT INTO `user` (`id_user`, `psuedo`, `password`, `email`, `nom`, `prenom`) VALUES
	(2, 'ama1801', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'cool@boul.tr', 'kolli', 'ahmed');
INSERT INTO `user` (`id_user`, `psuedo`, `password`, `email`, `nom`, `prenom`) VALUES
	(3, '1802', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'cool11@boul.tr', 'amo', 'timo');
INSERT INTO `user` (`id_user`, `psuedo`, `password`, `email`, `nom`, `prenom`) VALUES
	(4, 'ama1800', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'cool@boul.tr', 'hamed', 'ahmed');
INSERT INTO `user` (`id_user`, `psuedo`, `password`, `email`, `nom`, `prenom`) VALUES
	(5, 'ama1800', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'cool@boul.tr', 'hamed', 'ahmed');
INSERT INTO `user` (`id_user`, `psuedo`, `password`, `email`, `nom`, `prenom`) VALUES
	(6, 'ama1802', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ama1@exemple.fr', 'amott', 'ahmed');
INSERT INTO `user` (`id_user`, `psuedo`, `password`, `email`, `nom`, `prenom`) VALUES
	(7, 'ama1800', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'ama1800@exemple.fr', 'hamed', 'ahmed');
INSERT INTO `user` (`id_user`, `psuedo`, `password`, `email`, `nom`, `prenom`) VALUES
	(8, 'ama1801', '25f9e794323b453885f5181f1b624d0b', 'ama10@exemple.fr', 'hamed', 'ahmed');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
