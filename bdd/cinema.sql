-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinema
CREATE DATABASE IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema`;

-- Listage de la structure de table cinema. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_acteur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `acteur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.acteur : ~68 rows (environ)
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 6),
	(7, 7),
	(8, 8),
	(9, 9),
	(10, 10),
	(11, 11),
	(12, 12),
	(13, 13),
	(14, 18),
	(15, 19),
	(16, 20),
	(17, 21),
	(18, 22),
	(19, 23),
	(20, 24),
	(21, 25),
	(22, 26),
	(23, 27),
	(24, 28),
	(25, 32),
	(26, 33),
	(27, 34),
	(28, 35),
	(29, 36),
	(30, 37),
	(31, 38),
	(32, 39),
	(33, 40),
	(34, 41),
	(35, 42),
	(36, 43),
	(37, 44),
	(38, 45),
	(39, 46),
	(40, 47),
	(41, 48),
	(42, 49),
	(43, 50),
	(44, 51),
	(45, 52),
	(46, 53),
	(47, 54),
	(48, 55),
	(49, 56),
	(50, 57),
	(51, 58),
	(52, 59),
	(53, 60),
	(54, 61),
	(55, 62),
	(56, 63),
	(57, 64),
	(58, 65),
	(59, 66),
	(60, 67),
	(61, 68),
	(62, 69),
	(63, 70),
	(64, 71),
	(65, 72),
	(66, 73),
	(67, 74),
	(68, 75);

-- Listage de la structure de table cinema. appartenir
CREATE TABLE IF NOT EXISTS `appartenir` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `appartenir_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.appartenir : ~17 rows (environ)
INSERT INTO `appartenir` (`id_film`, `id_genre`) VALUES
	(2, 1),
	(3, 1),
	(5, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(2, 2),
	(4, 2),
	(6, 2),
	(1, 3),
	(7, 3),
	(10, 3),
	(3, 4),
	(5, 4),
	(10, 4),
	(4, 6),
	(1, 11);

-- Listage de la structure de table cinema. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `id_film` int NOT NULL,
  `id_acteur` int NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_acteur`,`id_role`),
  KEY `id_acteur` (`id_acteur`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `casting_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `casting_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `casting_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.casting : ~63 rows (environ)
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(3, 1, 1),
	(3, 2, 54),
	(5, 3, 1),
	(5, 4, 2),
	(5, 5, 9),
	(4, 7, 23),
	(4, 8, 22),
	(6, 8, 4),
	(4, 9, 24),
	(2, 10, 5),
	(4, 10, 25),
	(6, 11, 3),
	(7, 12, 47),
	(9, 12, 37),
	(1, 13, 20),
	(9, 13, 38),
	(1, 14, 13),
	(1, 15, 14),
	(1, 16, 15),
	(1, 17, 16),
	(1, 18, 17),
	(1, 19, 18),
	(1, 20, 19),
	(1, 21, 64),
	(4, 24, 21),
	(10, 25, 30),
	(10, 26, 31),
	(10, 27, 33),
	(10, 28, 32),
	(1, 29, 65),
	(1, 30, 62),
	(1, 31, 63),
	(2, 32, 59),
	(2, 33, 6),
	(2, 35, 7),
	(2, 36, 60),
	(3, 36, 58),
	(2, 37, 61),
	(2, 38, 59),
	(3, 40, 57),
	(3, 41, 56),
	(3, 42, 55),
	(4, 47, 28),
	(4, 48, 27),
	(4, 49, 26),
	(4, 50, 29),
	(5, 51, 53),
	(5, 52, 52),
	(5, 53, 54),
	(6, 54, 42),
	(6, 55, 44),
	(6, 56, 43),
	(7, 57, 45),
	(7, 58, 46),
	(7, 59, 48),
	(7, 60, 49),
	(7, 61, 50),
	(8, 63, 37),
	(8, 64, 35),
	(8, 65, 36),
	(9, 66, 39),
	(9, 67, 40),
	(9, 68, 41);

-- Listage de la structure de vue cinema. detail_acteur
-- Création d'une table temporaire pour palier aux erreurs de dépendances de VIEW
CREATE TABLE `detail_acteur` (
	`nom` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`prenom` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`id_personne` INT(10) NOT NULL,
	`id_acteur` INT(10) NOT NULL
) ENGINE=MyISAM;

-- Listage de la structure de vue cinema. detail_film
-- Création d'une table temporaire pour palier aux erreurs de dépendances de VIEW
CREATE TABLE `detail_film` (
	`id_film` INT(10) NOT NULL,
	`titre_film` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`release_date` VARCHAR(4) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`duree` VARCHAR(47) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`nom_realisateur` VARCHAR(101) NOT NULL COLLATE 'utf8mb4_0900_ai_ci'
) ENGINE=MyISAM;

-- Listage de la structure de table cinema. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL,
  `titre_film` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `annee_sortie` date DEFAULT NULL,
  `duree_film` int DEFAULT NULL,
  `synopsis` text,
  `note` float DEFAULT NULL,
  `affiche` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `wallpaper` varchar(255) DEFAULT NULL,
  `id_realisateur` int NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.film : ~10 rows (environ)
INSERT INTO `film` (`id_film`, `titre_film`, `annee_sortie`, `duree_film`, `synopsis`, `note`, `affiche`, `wallpaper`, `id_realisateur`) VALUES
	(1, 'Le Seigneur des anneaux : La communaut&eacute; de l&#039;anneau', '2001-01-19', 178, 'Un jeune et timide Hobbit, Frodon Sacquet, h&eacute;rite d&#039;un anneau magique. Bien loin d&#039;&ecirc;tre une simple babiole, il s&#039;agit d&#039;un instrument de pouvoir absolu qui permettrait &agrave; Sauron, le &quot;Seigneur des t&eacute;n&egrave;bres&quot;, de r&eacute;gner sur la Terre du Milieu et de r&eacute;duire en esclavage ses peuples. Frodon doit parvenir, avec l&#039;aide de la communaut&eacute; de l&#039;anneau, jusqu&#039;&agrave; la Montagne du Destin pour le d&eacute;truire.', 5, 'https://fr.web.img5.acsta.net/c_310_420/medias/nmedia/00/02/16/27/69218096_af.jpg', 'https://images5.alphacoders.com/614/614690.jpg', 4),
	(2, 'Interstellar', '2014-11-05', 169, 'Dans un proche futur, la Terre est devenue hostile pour l&#039;homme. Les temp&ecirc;tes de sable sont fr&eacute;quentes et il n&#039;y a plus que le ma&iuml;s qui peut &ecirc;tre cultiv&eacute;, en raison d&#039;un sol trop aride. Cooper est un pilote, recycl&eacute; en agriculteur, qui vit avec son fils et sa fille dans la ferme familiale.', 4, 'https://fr.web.img5.acsta.net/c_310_420/pictures/14/09/24/12/08/158828.jpg', 'https://images8.alphacoders.com/560/560736.jpg', 1),
	(3, 'Batman : the dark knight', '2023-06-01', 152, 'Batman est plus que jamais d&eacute;termin&eacute; &agrave; &eacute;radiquer le crime organis&eacute; qui s&egrave;me la terreur en ville. Epaul&eacute; par le lieutenant Jim Gordon et par le procureur de Gotham City, Harvey Dent, Batman voit son champ d&#039;action s&#039;&eacute;largir. La collaboration des trois hommes s&#039;av&egrave;re tr&egrave;s efficace et ne tarde pas &agrave; porter ses fruits jusqu&#039;&agrave; ce qu&#039;un criminel redoutable vienne plonger la ville de Gotham City dans le chaos.', 5, 'https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/18/63/97/89/18949761.jpg', 'https://wallpaperaccess.com/full/210228.jpg', 1),
	(4, 'Le loup de Wall Street', '2013-12-25', 179, 'Sa licence de courtier en poche, et les narines d&eacute;j&agrave; pleines de coca&iuml;ne, Jordan Belfort est pr&ecirc;t &agrave; conqu&eacute;rir Wall Street. Ce jour d&#039;octobre, un krach, le plus important depuis 1929, vient pi&eacute;tiner ses r&ecirc;ves de grandeur. C&#039;est finalement &agrave; Long Island qu&#039;il &eacute;choue et qu&#039;il monte sa propre affaire de courtage. Son cr&eacute;neau : le hors-cote. Sa m&eacute;thode : l&#039;arnaque. Son &eacute;quipe : des vendeurs ou des petits trafiquants.', 4, 'https://fr.web.img5.acsta.net/c_310_420/pictures/210/604/21060483_20131125114549726.jpg', 'https://images7.alphacoders.com/683/683330.jpg', 2),
	(5, 'Justice League : Snyder&#039;s Cut', '2021-03-18', 244, 'Bruce Wayne veut faire en sorte que le sacrifice ultime de Superman ne soit pas vain. Avec l&#039;aide de Diana Prince, il met en place un plan pour recruter une &eacute;quipe de m&eacute;tahumains afin de prot&eacute;ger le monde d&#039;une menace apocalyptique imminente. Or, la t&acirc;che s&#039;av&egrave;re plus difficile que Bruce ne l&#039;imaginait. En effet, chacune des recrues doit faire face aux d&eacute;mons de son pass&eacute; et doit les surpasser pour se rassembler et former une ligue de h&eacute;ros sans pr&eacute;c&eacute;dent.', 4, 'https://fr.web.img5.acsta.net/c_310_420/pictures/21/04/07/10/59/5550346.jpg', 'https://images5.alphacoders.com/721/721135.jpg', 5),
	(6, 'Titanic', '1998-01-07', 195, 'En 1997, l&#039;&eacute;pave du Titanic est l&#039;objet d&#039;une exploration fi&eacute;vreuse, men&eacute;e par des chercheurs de tr&eacute;sor en qu&ecirc;te d&#039;un diamant bleu qui se trouvait &agrave; bord. Frapp&eacute;e par un reportage t&eacute;l&eacute;vis&eacute;, l&#039;une des rescap&eacute;es du naufrage, &acirc;g&eacute;e de 102 ans, Rose DeWitt, se rend sur place et &eacute;voque ses souvenirs. 1912.', 5, 'https://fr.web.img6.acsta.net/c_310_420/pictures/23/01/10/16/06/0622119.jpg', 'https://wallpaperset.com/w/full/b/3/0/484177.jpg', 6),
	(7, 'Avatar', '2009-12-16', 162, 'Malgr&eacute; sa paralysie, Jake Sully, un ancien marine immobilis&eacute; dans un fauteuil roulant, est rest&eacute; un combattant au plus profond de son &ecirc;tre. Il est recrut&eacute; pour se rendre &agrave; des ann&eacute;es-lumi&egrave;re de la Terre, sur Pandora, o&ugrave; de puissants groupes industriels exploitent un minerai rarissime destin&eacute; &agrave; r&eacute;soudre la crise &eacute;nerg&eacute;tique sur Terre. Parce que l&#039;atmosph&egrave;re de Pandora est toxique pour les humains, ceux-ci ont cr&eacute;&eacute; le Programme Avatar, qui permet &agrave; des &quot; pilotes &quot; humains de lier leur esprit &agrave; un avatar, un corps biologique command&eacute; &agrave; distance, capable de survivre dans cette atmosph&egrave;re l&eacute;tale. Ces avatars sont des hybrides cr&eacute;&eacute;s g&eacute;n&eacute;tiquement en croisant l&#039;ADN humain avec celui des Na&#039;vi, les autochtones de Pandora.', 4, 'https://fr.web.img2.acsta.net/c_310_420/pictures/22/08/25/09/04/2146702.jpg', 'https://images2.alphacoders.com/758/75842.jpg', 6),
	(8, 'Terminator', '1985-04-24', 107, 'Un Terminator, robot d&#039;aspect humain, est envoy&eacute; d&#039;un futur o&ugrave; sa race livre aux hommes une guerre sans merci. Sa mission est de trouver et d&#039;&eacute;liminer Sarah Connor avant qu&#039;elle ne donne naissance &agrave; John, appel&eacute; &agrave; devenir le chef de la r&eacute;sistance. Cette derni&egrave;re envoie un de ses membres, Reese, aux trousses du cyborg.', 5, 'https://fr.web.img2.acsta.net/c_310_420/pictures/22/09/27/12/52/4744720.jpg', 'https://www.xtrafondos.com/en/descargar.php?id=9630&resolucion=1920x1080', 6),
	(9, 'Alien : Le 8e passager', '1979-09-12', 116, 'Durant le voyage de retour d&#039;un immense cargo spatial en mission commerciale de routine, ses passagers, cinq hommes et deux femmes plong&eacute;s en hibernation, sont tir&eacute;s de leur l&eacute;thargie dix mois plus t&ocirc;t que pr&eacute;vu par Mother, l&#039;ordinateur de bord. Ce dernier a en effet capt&eacute; dans le silence interplan&eacute;taire des signaux sonores, et suivant une certaine clause du contrat de navigation, les astronautes sont charg&eacute;s de prospecter tout indice de vie dans l&#039;espace.', 4, 'https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/18/35/14/60/18363837.jpg', 'https://images2.alphacoders.com/853/85302.jpg', 7),
	(10, 'Gladiator', '2000-06-20', 155, 'Le g&eacute;n&eacute;ral romain Maximus est le plus fid&egrave;le soutien de l&#039;empereur Marc Aur&egrave;le, qu&#039;il a conduit de victoire en victoire. Jaloux du prestige de Maximus, et plus encore de l&#039;amour que lui voue l&#039;empereur, le fils de Marc Aur&egrave;le, Commode, s&#039;arroge brutalement le pouvoir, puis ordonne l&#039;arrestation du g&eacute;n&eacute;ral et son ex&eacute;cution. Maximus &eacute;chappe &agrave; ses assassins, mais ne peut emp&ecirc;cher le massacre de sa famille. Captur&eacute; par un marchand d&#039;esclaves, il devient gladiateur et pr&eacute;pare sa vengeance.', 4, 'https://fr.web.img5.acsta.net/c_310_420/medias/nmedia/18/68/64/41/19254510.jpg', 'https://images5.alphacoders.com/681/thumb-1920-681188.jpg', 7);

-- Listage de la structure de table cinema. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL,
  `nom_genre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.genre : ~11 rows (environ)
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(1, 'Science-Fiction'),
	(2, 'Drame'),
	(3, 'Aventure'),
	(4, 'Action'),
	(5, 'Arts-Martiaux'),
	(6, 'Policier'),
	(7, 'Film musical'),
	(8, 'Western'),
	(9, 'Fantastique'),
	(10, 'Horreur'),
	(11, 'Medieval Fantastique');

-- Listage de la structure de table cinema. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.personne : ~75 rows (environ)
INSERT INTO `personne` (`id_personne`, `prenom`, `nom`, `sexe`, `date_naissance`, `image`) VALUES
	(1, 'Christian', 'Bale', 'M', '1974-01-30', 'https://fr.web.img6.acsta.net/c_310_420/pictures/19/01/22/16/22/0699464.jpg'),
	(2, 'Heath', 'Ledger', 'M', '1979-04-04', 'https://fr.web.img5.acsta.net/c_310_420/pictures/15/10/15/16/48/316438.jpg'),
	(3, 'Ben', 'Affleck', 'M', '1972-08-15', 'https://fr.web.img6.acsta.net/c_310_420/pictures/16/03/22/12/30/537408.jpg'),
	(4, 'Henry', 'Cavill', 'M', '1983-05-05', 'https://fr.web.img6.acsta.net/c_310_420/pictures/19/12/19/11/34/5830820.jpg'),
	(5, 'Gal', 'Gadot', 'F', '1985-04-30', 'https://fr.web.img2.acsta.net/c_310_420/pictures/16/03/22/12/38/275927.jpg'),
	(6, 'Scarlett', 'Johansson', 'F', '1984-11-22', NULL),
	(7, 'Margot', 'Robbie', 'F', '1990-07-02', 'https://fr.web.img5.acsta.net/c_310_420/pictures/20/01/31/14/13/5661728.jpg'),
	(8, 'Leonardo', 'DiCaprio', 'M', '1974-11-11', 'https://fr.web.img3.acsta.net/c_310_420/pictures/15/06/24/14/36/054680.jpg'),
	(9, 'Jonah', 'Hill', 'M', '1983-12-20', 'https://fr.web.img6.acsta.net/c_310_420/pictures/18/09/12/12/03/5412955.jpg'),
	(10, 'Matthew', 'McConaughey', 'M', '1969-11-04', 'https://fr.web.img2.acsta.net/c_310_420/pictures/16/03/02/17/16/573123.jpg'),
	(11, 'Kate', 'Winslet', 'F', '1975-10-05', 'https://fr.web.img3.acsta.net/c_310_420/pictures/15/09/15/10/01/065591.jpg'),
	(12, 'Sigourney', 'Weaver', 'F', '1949-10-08', 'https://fr.web.img2.acsta.net/c_310_420/pictures/15/07/27/13/14/152942.jpg'),
	(13, 'Ian', 'Holm', 'M', '1931-09-12', 'https://fr.web.img5.acsta.net/c_310_420/pictures/17/01/16/17/23/344698.jpg'),
	(14, 'Luc', 'Besson', 'M', '1959-03-18', 'https://fr.web.img4.acsta.net/c_310_420/pictures/17/07/18/16/33/061543.jpg'),
	(15, 'Christopher', 'Nolan', 'M', '1970-07-30', 'https://fr.web.img5.acsta.net/c_310_420/pictures/14/10/30/10/59/215487.jpg'),
	(16, 'Martin', 'Scorsese', 'M', '1942-11-17', 'https://fr.web.img6.acsta.net/c_310_420/pictures/19/09/09/12/00/5874736.jpg'),
	(17, 'Peter', 'Jackson', 'M', '1961-10-31', 'https://fr.web.img6.acsta.net/c_310_420/pictures/14/12/04/10/39/195496.jpg'),
	(18, 'Elijah', 'Wood', 'M', '1981-01-28', 'https://fr.web.img6.acsta.net/c_310_420/pictures/14/12/04/10/36/015552.jpg'),
	(19, 'Kate', 'Blanchett', 'F', '1969-05-14', 'https://fr.web.img2.acsta.net/c_310_420/pictures/15/05/18/11/27/326804.jpg'),
	(20, 'Ian', 'McKellen', 'M', '1939-05-25', 'https://fr.web.img2.acsta.net/c_310_420/pictures/14/12/04/10/40/127447.jpg'),
	(21, 'Orlando', 'Bloom', 'M', '1977-01-13', 'https://fr.web.img3.acsta.net/c_310_420/pictures/23/05/26/17/08/3032331.jpg'),
	(22, 'Liv', 'Tyler', 'F', '1977-07-01', 'https://fr.web.img4.acsta.net/c_310_420/pictures/19/08/30/10/22/5000319.jpg'),
	(23, 'Andy', 'Serkys', 'M', '1964-04-20', 'https://fr.web.img4.acsta.net/c_310_420/pictures/17/12/11/12/30/5609551.jpg'),
	(24, 'Sean', 'Bean', 'M', '1959-04-17', 'https://fr.web.img6.acsta.net/c_310_420/pictures/15/07/20/17/45/031961.jpg'),
	(25, 'Sean', 'Astin', 'M', '1971-02-25', 'https://fr.web.img2.acsta.net/c_310_420/pictures/16/07/22/17/26/392369.jpg'),
	(26, 'Christopher', 'Lee', 'M', '1922-05-27', 'https://fr.web.img3.acsta.net/c_310_420/medias/nmedia/18/35/25/23/19452616.jpg'),
	(27, 'Hugo', 'Weaving', 'M', '1960-04-04', NULL),
	(28, 'Rob', 'Reiner', 'M', '1947-03-06', 'https://fr.web.img6.acsta.net/c_310_420/pictures/17/02/01/14/27/168241.jpg'),
	(29, 'Zack', 'Snyder', 'M', '1966-03-01', 'https://fr.web.img2.acsta.net/c_310_420/pictures/16/03/23/09/34/047873.jpg'),
	(30, 'James', 'Cameron', 'M', '1954-08-16', 'https://fr.web.img6.acsta.net/c_310_420/pictures/22/12/07/15/19/3602099.jpg'),
	(31, 'Ridley', 'Scott', 'M', '1937-11-30', 'https://fr.web.img6.acsta.net/c_310_420/pictures/14/12/10/16/47/273365.jpg'),
	(32, 'Russel', 'Crowe', 'M', '1964-04-07', 'https://fr.web.img6.acsta.net/c_310_420/pictures/16/05/17/17/15/053871.jpg'),
	(33, 'Joaquin', 'Phoenix', 'M', '1974-10-28', 'https://fr.web.img3.acsta.net/c_310_420/pictures/19/10/23/11/18/1649761.jpg'),
	(34, 'Richard', 'Harris', 'M', '1930-10-01', 'https://fr.web.img3.acsta.net/c_310_420/medias/nmedia/18/35/24/74/18404420.jpg'),
	(35, 'Connie', 'Nielsen', 'M', '1965-07-03', 'https://fr.web.img6.acsta.net/c_310_420/pictures/16/03/29/14/51/281019.jpg'),
	(36, 'Viggo', 'Mortensen', 'M', '1958-10-20', 'https://fr.web.img6.acsta.net/c_310_420/pictures/19/01/16/15/12/2728586.jpg'),
	(37, 'Dominic', 'Monaghan', 'M', '1976-12-08', 'https://fr.web.img6.acsta.net/c_310_420/pictures/15/11/16/17/21/246752.jpg'),
	(38, 'Billy', 'Boyd', 'M', '1968-08-28', 'https://fr.web.img6.acsta.net/c_310_420/pictures/14/12/04/10/58/554189.jpg'),
	(39, 'Jessica', 'Chastain', 'F', '1977-03-24', 'https://fr.web.img6.acsta.net/c_310_420/pictures/16/05/13/10/55/131905.jpg'),
	(40, 'Anne', 'Hathaway', 'F', '1982-11-12', 'https://fr.web.img5.acsta.net/c_310_420/pictures/20/02/25/15/38/5978651.jpg'),
	(41, 'Timothée', 'Chalamet', 'M', '1995-12-27', NULL),
	(42, 'Matt', 'Damon', 'M', '1970-10-08', 'https://fr.web.img5.acsta.net/c_310_420/pictures/16/07/13/11/16/193188.jpg'),
	(43, 'Michael', 'Caine', 'M', '1933-03-14', 'https://fr.web.img3.acsta.net/c_310_420/pictures/15/05/20/14/58/214953.jpg'),
	(44, 'John', 'Lithgow', 'M', '1945-10-19', 'https://fr.web.img5.acsta.net/c_310_420/pictures/16/10/24/13/50/024460.jpg'),
	(45, 'Mackenzie', 'Foy', 'F', '2000-11-10', 'https://fr.web.img6.acsta.net/c_310_420/pictures/20/01/06/14/19/2152576.jpg'),
	(46, 'Ellen', 'Burstyn', 'F', '1932-12-07', NULL),
	(47, 'Morgan', 'Freeman', 'M', '1937-06-01', 'https://fr.web.img6.acsta.net/c_310_420/pictures/18/09/20/15/21/3966896.jpg'),
	(48, 'Aaron', 'Eckhart', 'M', '1968-03-12', 'https://fr.web.img2.acsta.net/c_310_420/pictures/16/01/28/10/38/041658.jpg'),
	(49, 'Gary', 'Oldman', 'M', '1958-03-21', 'https://fr.web.img3.acsta.net/c_310_420/pictures/16/03/18/16/03/398105.jpg'),
	(50, 'Cillian', 'Murphy', 'M', '1976-05-25', NULL),
	(51, 'Maggie', 'Gyllenhaal', 'F', '1977-11-16', 'https://fr.web.img2.acsta.net/c_310_420/pictures/15/10/21/10/48/401053.jpg'),
	(52, 'Katie', 'Holmes', 'F', '1978-12-18', NULL),
	(53, 'Liam', 'Neeson', 'M', '1952-06-07', NULL),
	(54, 'Jean', 'Dujardin', 'M', '1972-06-19', 'https://fr.web.img6.acsta.net/c_310_420/pictures/17/01/26/15/47/401446.jpg'),
	(55, 'Jon', 'Bernthal', 'M', '1976-09-20', 'https://fr.web.img3.acsta.net/c_310_420/pictures/15/08/10/16/47/000886.jpg'),
	(56, 'Jon', 'Favreau', 'M', '1966-10-19', 'https://fr.web.img3.acsta.net/c_310_420/pictures/15/09/18/12/27/315343.jpg'),
	(57, 'Kyle', 'Chandler', 'M', '1965-09-17', 'https://fr.web.img6.acsta.net/c_310_420/pictures/18/09/20/14/50/1532714.jpg'),
	(58, 'Ezra', 'Miller', 'M', '1992-09-30', 'https://fr.web.img3.acsta.net/c_310_420/pictures/16/11/15/14/35/069129.jpg'),
	(59, 'Amber', 'Heard', 'F', '1986-04-22', 'https://fr.web.img2.acsta.net/c_310_420/pictures/19/05/16/10/23/2923886.jpg'),
	(60, 'Jared', 'Leto', 'M', '1971-12-26', 'https://fr.web.img5.acsta.net/c_310_420/pictures/16/02/29/14/37/141208.jpg'),
	(61, 'Billy', 'Zane', 'M', '1966-02-24', 'https://fr.web.img4.acsta.net/c_310_420/pictures/16/12/21/15/36/341857.jpg'),
	(62, 'Bill', 'Paxton', 'M', '1955-05-17', 'https://fr.web.img6.acsta.net/c_310_420/pictures/17/05/30/12/13/269930.jpg'),
	(63, 'Kathy', 'Bates', 'F', '1948-06-28', 'https://fr.web.img2.acsta.net/c_310_420/pictures/20/02/10/16/56/5952598.jpg'),
	(64, 'Zoe', 'Saldana', 'F', '1978-06-19', 'https://fr.web.img2.acsta.net/c_310_420/pictures/18/05/04/11/38/3895826.jpg'),
	(65, 'Sam', 'Worthington', 'M', '1976-08-02', 'https://fr.web.img5.acsta.net/c_310_420/pictures/20/01/03/09/47/3048844.jpg'),
	(66, 'Michelle', 'Rodriguez', 'F', '1978-07-12', 'https://fr.web.img2.acsta.net/c_310_420/pictures/19/05/22/10/29/0914375.jpg'),
	(67, 'Joel David', 'Moore', 'M', '1977-09-25', 'https://fr.web.img4.acsta.net/c_310_420/pictures/17/08/02/15/03/321560.jpg'),
	(68, 'Stephen', 'Lang', 'M', '1952-07-11', 'https://fr.web.img2.acsta.net/c_310_420/pictures/18/12/17/12/00/0475555.jpg'),
	(69, 'Giovanni', 'Ribisi', 'M', '1974-12-17', NULL),
	(70, 'Arnold', 'Schwarzenegger', 'M', '1947-07-30', 'https://fr.web.img6.acsta.net/c_310_420/pictures/16/05/19/17/51/302269.jpg'),
	(71, 'Linda', 'Hamilton', 'F', '1956-09-26', 'https://fr.web.img5.acsta.net/c_310_420/pictures/19/10/22/16/44/0637500.jpg'),
	(72, 'Michael', 'Biehn', 'M', '1956-07-31', 'https://fr.web.img3.acsta.net/c_310_420/medias/nmedia/18/36/16/60/19634306.jpg'),
	(73, 'Tom', 'Skeritt', 'M', '1933-08-25', 'https://fr.web.img4.acsta.net/c_310_420/pictures/17/10/06/16/27/0021916.jpg'),
	(74, 'Veronica', 'Cartwright', 'F', '1949-04-20', 'https://fr.web.img4.acsta.net/c_310_420/pictures/17/08/09/15/00/014149.jpg'),
	(75, 'John', 'Hurt', 'M', '1940-01-22', 'https://fr.web.img6.acsta.net/c_310_420/pictures/15/11/20/16/48/078587.jpg');

-- Listage de la structure de table cinema. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `realisateur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.realisateur : ~7 rows (environ)
INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(3, 14),
	(1, 15),
	(2, 16),
	(4, 17),
	(5, 29),
	(6, 30),
	(7, 31);

-- Listage de la structure de table cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL,
  `nom_role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.role : ~64 rows (environ)
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(1, 'Batman'),
	(2, 'Superman'),
	(3, 'Rose dewitt Bukater'),
	(4, 'Jack Dawson'),
	(5, 'Joseph Cooper'),
	(6, 'Amelia Brand'),
	(7, 'Dr. Mann'),
	(8, 'Catwoman'),
	(9, 'Wonderwoman'),
	(11, 'Black Widow'),
	(12, 'Lucy'),
	(13, 'Frodon Sacquet'),
	(14, 'Galadriel'),
	(15, 'Gandalf'),
	(16, 'Legolas'),
	(17, 'Arwen'),
	(18, 'Gollum'),
	(19, 'Boromir'),
	(20, 'Bilbon Sacquet'),
	(21, 'Max Belfort'),
	(22, 'Jordan Belfort'),
	(23, 'Naomi Lapaglia'),
	(24, 'Donnie Azoff'),
	(25, 'Mark Hanna'),
	(26, 'Manny Riskin'),
	(27, 'Brad'),
	(28, 'Jean-Jacques Saurel'),
	(29, 'Patrick Denham'),
	(30, 'Maximus'),
	(31, 'Commode'),
	(32, 'Lucilla'),
	(33, 'Marc Aurèle'),
	(34, 'T-800'),
	(35, 'Sarah Connor'),
	(36, 'Kyle Reese'),
	(37, 'Ellen Ripley'),
	(38, 'Ash'),
	(39, 'Dallas'),
	(40, 'Lambert'),
	(41, 'Kane'),
	(42, 'Caledon Hockley'),
	(43, 'Molly Brown'),
	(44, 'Brock Lovett'),
	(45, 'Neytiri'),
	(46, 'Jake Sully'),
	(47, 'Grace'),
	(48, 'Trudy'),
	(49, 'Norman Spellman'),
	(50, 'Colonel Miles Quarritch'),
	(51, 'Parker Selfridge'),
	(52, 'Mera'),
	(53, 'Barry Allen, Flash'),
	(54, 'Le joker'),
	(55, 'James Gordon'),
	(56, 'Double-face'),
	(57, 'Lucius Fox'),
	(58, 'Alfred Pennyworth'),
	(59, 'Murphy Cooper'),
	(60, 'Professeur John Brand'),
	(61, 'Donald'),
	(62, 'Meriadoc Brandebouc'),
	(63, 'Peregrin Touque'),
	(64, 'Samsagace Gamegie'),
	(65, 'Aragorn');

-- Listage de la structure de vue cinema. detail_acteur
-- Suppression de la table temporaire et création finale de la structure d'une vue
DROP TABLE IF EXISTS `detail_acteur`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `detail_acteur` AS select `p`.`nom` AS `nom`,`p`.`prenom` AS `prenom`,`p`.`id_personne` AS `id_personne`,`a`.`id_acteur` AS `id_acteur` from (`personne` `p` join `acteur` `a` on((`a`.`id_personne` = `p`.`id_personne`)));

-- Listage de la structure de vue cinema. detail_film
-- Suppression de la table temporaire et création finale de la structure d'une vue
DROP TABLE IF EXISTS `detail_film`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `detail_film` AS select `f`.`id_film` AS `id_film`,`f`.`titre_film` AS `titre_film`,date_format(`f`.`annee_sortie`,'%Y') AS `release_date`,concat(cast((`f`.`duree_film` DIV 60) as float),'H',cast((`f`.`duree_film` % 60) as float)) AS `duree`,concat(`p`.`prenom`,' ',`p`.`nom`) AS `nom_realisateur` from ((`film` `f` join `realisateur` `r` on((`f`.`id_realisateur` = `r`.`id_realisateur`))) join `personne` `p` on((`r`.`id_personne` = `p`.`id_personne`)));

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
