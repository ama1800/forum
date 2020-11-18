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


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `forum`;

-- Listage de la structure de la table forum. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `verouillage` int(11) DEFAULT NULL,
  `nomcategorie` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.categorie : ~3 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id`, `verouillage`, `nomcategorie`) VALUES
	(1, 0, 'satellite');
INSERT INTO `categorie` (`id`, `verouillage`, `nomcategorie`) VALUES
	(2, 0, 'tnt');
INSERT INTO `categorie` (`id`, `verouillage`, `nomcategorie`) VALUES
	(3, 1, 'cable');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table forum. message
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `sujet_id` int(11) NOT NULL,
  `titremessage` text,
  `datecreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reponse` longtext,
  PRIMARY KEY (`id_message`),
  KEY `FK_POSTER` (`utilisateur_id`),
  KEY `FK_REPONDRE` (`sujet_id`),
  CONSTRAINT `FK_POSTER` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`),
  CONSTRAINT `FK_REPONDRE` FOREIGN KEY (`sujet_id`) REFERENCES `sujet` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.message : ~15 rows (environ)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(3, 1, 10, 'nouvelle frequence', '2020-10-08 09:53:42', '            changement de frequence de chaine x passe en 15200            ');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(4, 3, 10, 'test', '2020-10-14 11:05:00', 'test test         ');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(6, 5, 2, 'ça roule...!', '2020-10-14 16:17:46', 'oui je confirme!');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(8, 4, 4, 'avec un chariot', '2020-10-07 21:57:37', 'est s possible?');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(9, 1, 10, 'ce ci n&#39;est pas un test ', '2020-10-07 21:57:37', 'Attention attention ... c&#39;est sérieux!!      ');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(10, 23, 13, 'ceci n\'est plus un test', '2020-10-25 14:40:06', 'oui ça marchera incha Allah..');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(12, 1, 10, 'test3', '2020-10-25 14:42:21', '            cette fois il faut que ça marche alhamdo lillAllah            ');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(13, 1, 12, 'test', '2020-10-25 15:43:49', 'abdollah me derange je ne peut pas travail tranquillement. je ne sais pas quoi faire avec lui, en effet il n&#39;ecoute pas wak wak wak wak');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(14, 1, 10, 'test', '2020-10-25 15:49:40', 'ok ok comme ça marche ecrivant un message lisible    ');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(15, 1, 10, 'ça arrive ', '2020-10-25 23:00:15', 'il faut s&#39;y attendre la vie n&#39;est pas toujours roses, y a l&#39;automne aussi!?');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(16, 1, 14, 'premier message', '2020-10-26 10:41:42', 'kolo mollo tokki rien');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(17, 1, 14, 'test token', '2020-10-26 15:05:00', 'c&#39;est ça passe c&#39;est que ça marche');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(18, 27, 10, 'je suis la', '2020-10-31 00:11:59', '            oui moi aussi');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(19, 1, 10, 'test pagination', '2020-11-01 21:47:31', 'test pagination            ');
INSERT INTO `message` (`id_message`, `utilisateur_id`, `sujet_id`, `titremessage`, `datecreation`, `reponse`) VALUES
	(20, 1, 10, '2éme test', '2020-11-01 21:48:57', 'test pagination acte 2            ');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;

-- Listage de la structure de la table forum. sujet
CREATE TABLE IF NOT EXISTS `sujet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `titresujet` longtext NOT NULL,
  `datecreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contenu` text NOT NULL,
  `verrouillage` tinyint(4) NOT NULL DEFAULT '0',
  `resolution` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_CONTENIR` (`categorie_id`),
  KEY `FK_CREER` (`utilisateur_id`),
  CONSTRAINT `FK_CONTENIR` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  CONSTRAINT `FK_CREER` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.sujet : ~9 rows (environ)
/*!40000 ALTER TABLE `sujet` DISABLE KEYS */;
INSERT INTO `sujet` (`id`, `utilisateur_id`, `categorie_id`, `titresujet`, `datecreation`, `contenu`, `verrouillage`, `resolution`) VALUES
	(1, 1, 1, 'nouvelle mise a jour x', '2020-10-07 21:52:21', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat', 0, 0);
INSERT INTO `sujet` (`id`, `utilisateur_id`, `categorie_id`, `titresujet`, `datecreation`, `contenu`, `verrouillage`, `resolution`) VALUES
	(2, 1, 1, 'frequences hotbird', '2020-10-07 21:55:00', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', 0, 1);
INSERT INTO `sujet` (`id`, `utilisateur_id`, `categorie_id`, `titresujet`, `datecreation`, `contenu`, `verrouillage`, `resolution`) VALUES
	(3, 3, 1, 'peut on recevoir astra 19 au sud de mali?', '2020-10-07 21:54:44', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 1, 1);
INSERT INTO `sujet` (`id`, `utilisateur_id`, `categorie_id`, `titresujet`, `datecreation`, `contenu`, `verrouillage`, `resolution`) VALUES
	(4, 1, 3, 'Bouquet free', '2020-10-07 21:55:17', 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains', 0, 0);
INSERT INTO `sujet` (`id`, `utilisateur_id`, `categorie_id`, `titresujet`, `datecreation`, `contenu`, `verrouillage`, `resolution`) VALUES
	(10, 5, 1, 'technosat bloquer sur Boot', '2020-10-08 09:34:55', ' On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains', 0, 0);
INSERT INTO `sujet` (`id`, `utilisateur_id`, `categorie_id`, `titresujet`, `datecreation`, `contenu`, `verrouillage`, `resolution`) VALUES
	(11, 1, 2, 'mamamai', '2020-10-25 02:32:39', ' lorem ipsum polikum rimum kitamum', 0, 0);
INSERT INTO `sujet` (`id`, `utilisateur_id`, `categorie_id`, `titresujet`, `datecreation`, `contenu`, `verrouillage`, `resolution`) VALUES
	(12, 1, 2, 'mise a jour', '2020-10-25 03:54:23', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et ', 0, 0);
INSERT INTO `sujet` (`id`, `utilisateur_id`, `categorie_id`, `titresujet`, `datecreation`, `contenu`, `verrouillage`, `resolution`) VALUES
	(13, 5, 3, 'mamamai', '2020-10-25 04:28:30', ' lorem ipsum polikum rimum kitamum', 0, 0);
INSERT INTO `sujet` (`id`, `utilisateur_id`, `categorie_id`, `titresujet`, `datecreation`, `contenu`, `verrouillage`, `resolution`) VALUES
	(14, 1, 3, 'çà pourrais', '2020-10-26 10:40:58', '                        je ne sais pas pourquoi!!        test token                ', 0, 0);
INSERT INTO `sujet` (`id`, `utilisateur_id`, `categorie_id`, `titresujet`, `datecreation`, `contenu`, `verrouillage`, `resolution`) VALUES
	(15, 1, 3, 'ceci pour tester pagination', '2020-10-30 20:50:01', 'ceci pour tester pagination, ça marche mais y a un probleme quel categorie a choisir', 0, 0);
INSERT INTO `sujet` (`id`, `utilisateur_id`, `categorie_id`, `titresujet`, `datecreation`, `contenu`, `verrouillage`, `resolution`) VALUES
	(16, 1, 3, 'encore un test', '2020-10-30 20:55:03', 'oui oui forum under construction!!!', 0, 0);
/*!40000 ALTER TABLE `sujet` ENABLE KEYS */;

-- Listage de la structure de la table forum. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `psuedo` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `datenaissance` date DEFAULT NULL,
  `dateadhesion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` int(11) NOT NULL DEFAULT '5',
  `avatar` varchar(255) NOT NULL,
  `pays` varchar(50) NOT NULL DEFAULT 'france',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.utilisateur : ~11 rows (environ)
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` (`id`, `psuedo`, `email`, `password`, `nom`, `prenom`, `datenaissance`, `dateadhesion`, `role`, `avatar`, `pays`) VALUES
	(1, 'ama1800', 'Ama1800@exemple.com', '$2y$10$4gkmEJVcYUgLeOj9iz5ZlucnWql1knfFkZKBxPr/X/gq2zu7Nj9FC', 'ait', 'ahmed', '1979-10-07', '2017-10-07 00:00:00', 1, 'logo.png', 'maroc');
INSERT INTO `utilisateur` (`id`, `psuedo`, `email`, `password`, `nom`, `prenom`, `datenaissance`, `dateadhesion`, `role`, `avatar`, `pays`) VALUES
	(3, 'cooly', 'cool@mail.fr', '$2y$10$gx1q66BcpdjXTiYK1CqRh.BcRsm/Mo.HuqBVeYp6baocb3uAiCUIO', 'llllll', 'molllu', '2000-10-18', '2020-10-17 00:00:00', 5, 'https://cdn3.iconfinder.com/data/icons/avatars-15/64/_Ninja-2-256.png', 'france');
INSERT INTO `utilisateur` (`id`, `psuedo`, `email`, `password`, `nom`, `prenom`, `datenaissance`, `dateadhesion`, `role`, `avatar`, `pays`) VALUES
	(4, 'johndoe', 'test@mail.com', '$2y$10$B/ImR.AANb4QlmW.p3jwmeN.vNTZuFVBrsSDEN6bh/GJLbiKQ70GG', '', '', '1988-03-25', '2005-05-03 00:00:00', 2, 'https://thumbs.dreamstime.com/z/user-sign-icon-person-symbol-human-avatar-rich-man-84519083.jpg', 'italie');
INSERT INTO `utilisateur` (`id`, `psuedo`, `email`, `password`, `nom`, `prenom`, `datenaissance`, `dateadhesion`, `role`, `avatar`, `pays`) VALUES
	(5, 'mathieu', 'mail@mail.fr', '$2y$10$F0aZUl1sz9.MEdzvBiZY8.Xp8A1.MmRkkKsMNwIpeiAmI8.xVbztu', 'mott', 'math', '2001-08-25', '2011-11-27 00:00:00', 4, 'https://cdn3.iconfinder.com/data/icons/avatars-15/64/_Ninja-2-256.png', 'france');
INSERT INTO `utilisateur` (`id`, `psuedo`, `email`, `password`, `nom`, `prenom`, `datenaissance`, `dateadhesion`, `role`, `avatar`, `pays`) VALUES
	(20, 'ama1803', 'molli@hotlolo.com1', '$2y$10$17HPjGbfDECvORNN/I2jcOxgLENG1QNQngmIc6ysuoouGdE//2N3u', 'qqqqqqq', 'qqqqqqqq', '2000-02-02', '2020-10-25 01:30:12', 5, 'https://cdn3.iconfinder.com/data/icons/avatars-15/64/_Ninja-2-256.png', 'france');
INSERT INTO `utilisateur` (`id`, `psuedo`, `email`, `password`, `nom`, `prenom`, `datenaissance`, `dateadhesion`, `role`, `avatar`, `pays`) VALUES
	(22, 'ama1804', 'ama1800@exemple.com1', '$2y$10$AZIsjeoXE5B.6qnaPqXJcOULBO5KUeZGv9uvykbtpLxgbjB5wYXZa', 'rotti', 'mayo', '2000-02-01', '2020-10-25 01:30:14', 5, 'https://cdn3.iconfinder.com/data/icons/avatars-15/64/_Ninja-2-256.png', 'france');
INSERT INTO `utilisateur` (`id`, `psuedo`, `email`, `password`, `nom`, `prenom`, `datenaissance`, `dateadhesion`, `role`, `avatar`, `pays`) VALUES
	(23, 'Abdollah', 'abdollah@test.fr', '$2y$10$vIyI5QGRzuVLXejaQ4Oj.eRy.uK/dAEyV6q9TLEO8EVhRMWjvn4uS', 'ait', 'abdollah', '2016-10-15', '2020-10-25 13:10:22', 3, 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse2.mm.bing.net%2Fth%3Fid%3DOIP.-uY5mrhkpTMrVuapqL2nDAHaHW%26pid%3DApi&f=1', 'france');
INSERT INTO `utilisateur` (`id`, `psuedo`, `email`, `password`, `nom`, `prenom`, `datenaissance`, `dateadhesion`, `role`, `avatar`, `pays`) VALUES
	(24, 'salma', 'salma@test.fr', '$2y$10$J5O9gjA4YK4ReSrfb.5.6uWZZ4cXW.TU0H92GG7zrw/er8RmXK8DC', 'ait', 'salma', '2015-06-28', '2020-10-25 13:13:13', 2, 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.ytimg.com%2Fvi%2Fjp1U0NargtQ%2Fmaxresdefault.jpg&f=1&nofb=1', 'france');
INSERT INTO `utilisateur` (`id`, `psuedo`, `email`, `password`, `nom`, `prenom`, `datenaissance`, `dateadhesion`, `role`, `avatar`, `pays`) VALUES
	(25, 'mala', 'mala@moi.fr', '$2y$10$xw91IUqlUNOXZ5ttS14Hzu/sLJIkTaDlL333r4LPmWRUC0USPNTvK', 'toi', 'moi', '1999-01-01', '2020-10-26 14:01:48', 4, 'https://thumbs.dreamstime.com/z/user-sign-icon-person-symbol-human-avatar-rich-man-84519083.jpg', 'france');
INSERT INTO `utilisateur` (`id`, `psuedo`, `email`, `password`, `nom`, `prenom`, `datenaissance`, `dateadhesion`, `role`, `avatar`, `pays`) VALUES
	(26, 'powerZ', 'marouane@test.fr', '$2y$10$KBy4mSphMrQQTvERAwUfDeEcYeyNBzXlsKVXVM.hbGQ/yH5L1fh82', 'kommiche', 'marouane', '2000-01-01', '2020-10-26 14:30:45', 4, 'logo1.png', 'france');
INSERT INTO `utilisateur` (`id`, `psuedo`, `email`, `password`, `nom`, `prenom`, `datenaissance`, `dateadhesion`, `role`, `avatar`, `pays`) VALUES
	(27, 'lion67', 'motama@test.de', '$2y$10$qOhMRb4BvnbAXFh2oyVjz.6HX03fqb0XigkG02TBeKU36F3WP1edC', 'darmien', 'lyon', '2000-01-01', '2020-10-26 15:08:47', 3, 'https://thumbs.dreamstime.com/z/user-sign-icon-person-symbol-human-avatar-rich-man-84519083.jpg', 'france');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
