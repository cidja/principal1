-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `bd`;
CREATE TABLE `bd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serie` text NOT NULL,
  `titre` text NOT NULL,
  `scenario` text NOT NULL,
  `dessin` text NOT NULL,
  `album_numero` int(11) NOT NULL,
  `genre` text NOT NULL,
  `remarques` text NOT NULL,
  `img_couv` varchar(200) NOT NULL,
  `date_ajout` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `bd` (`id`, `serie`, `titre`, `scenario`, `dessin`, `album_numero`, `genre`, `remarques`, `img_couv`, `date_ajout`) VALUES
(1,	'Leonard',	'Flagrant génie ',	'Turk et de Groot',	'',	19,	'humour',	'très rigolo',	'http://chezminette87.c.h.pic.centerblog.net/slmcipmb.jpg',	'2019-02-09 21:07:16'),
(2,	'Boule et Bill',	'A l\'abordage',	'Christophe Cazenove',	'Laurent Verron',	33,	'Humour',	'pas lu',	'https://static.fnac-static.com/multimedia/FR/Images_Produits/FR/fnac.com/Visual_Principal_340/4/8/1/9782505009184/tsp20120919095836/A-l-abordage.jpg',	'2019-02-16 16:21:27'),
(6,	'Léonard',	'La guerre des génies',	'Turk',	'De groot',	10,	'Humour',	'au top une grande histoire mais toujours aussi drôle avec beaucoup de gags ',	'http://i.skyrock.net/6294/94246294/pics/3274875454_1_2_7Zka0rNO.jpg',	'2019-02-27 21:03:43');

DROP TABLE IF EXISTS `livres_lus`;
CREATE TABLE `livres_lus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `auteur` text NOT NULL,
  `tome` text NOT NULL,
  `nb_pages` int(4) DEFAULT NULL,
  `debut` text NOT NULL,
  `fin` text NOT NULL,
  `remarques` text NOT NULL,
  `img` varchar(200) NOT NULL,
  `date_ajout` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `livres_lus` (`id`, `titre`, `auteur`, `tome`, `nb_pages`, `debut`, `fin`, `remarques`, `img`, `date_ajout`) VALUES
(2,	'Série drizt do urden',	'ra salvatore',	'3',	NULL,	'adolescence',	'',	'',	'',	'0000-00-00 00:00:00'),
(3,	'série diablo',	'',	'3',	NULL,	'adolescence',	'',	'',	'',	'0000-00-00 00:00:00'),
(4,	'Série Halo',	'',	'3',	NULL,	'adolescence',	'',	'',	'',	'0000-00-00 00:00:00'),
(5,	'1984',	'Georges Orwell',	'1',	NULL,	'adolescence',	'',	'',	'',	'0000-00-00 00:00:00'),
(6,	'No pasaran',	'',	'1',	NULL,	'adolescence',	'',	'',	'',	'0000-00-00 00:00:00'),
(7,	'la mort est mon métier',	'robert merle',	'1',	NULL,	'adolescence',	'',	'',	'https://lisez0.cdnstatics.com/usuaris/libros/fotos/9782221120/m_libros/9782221119518ORI.jpg',	'0000-00-00 00:00:00'),
(8,	'le secret de ji 3 tomes',	'pierre grimbert',	'3',	NULL,	'adolescence',	'Coup de cœur',	'',	'',	'0000-00-00 00:00:00'),
(9,	'les enfants de ji 3 tomes',	'pierre grimbert',	'3',	NULL,	'adolescence',	'',	'',	'',	'0000-00-00 00:00:00'),
(10,	'les heritiers de ji 3 tomes',	'pierre grimbert',	'3',	NULL,	'adolescence',	'',	'',	'',	'0000-00-00 00:00:00'),
(11,	'Warcraft 3 tomes',	'',	'3',	NULL,	'adolescence',	'',	'',	'',	'0000-00-00 00:00:00'),
(12,	'la semaine de 4 heures ',	'tim ferries',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(13,	'total recall',	'arnold schwarznegger',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(14,	'Les 7 habitudes qui font la différence',	'christian dubois',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(15,	'comment parler à tous le monde',	'leil lowdes',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(16,	'Elon Musk',	'Ashlee Vance',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(17,	'Le petit guide de la vie',	'Anthony Nevo',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(18,	'De zéro à un',	'Peter Thiel',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(19,	'ce que l’argent dit de vous',	'christian Junod',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(20,	'la quatrième révolution industrielle',	'Klauss shhwab',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(21,	'l’energie sexuelle masculine',	'Mantak chia',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(22,	'le marketing pour les nuls',	'',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(23,	'big data penser l’homme et le monde autrement',	'Gilles Babinet',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(24,	'Comment se faire des amis',	'dale carnegie',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(25,	'Le langage corporel en 30 minutes',	'remy roulier',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(26,	'le cycle des robots tome 1',	'isaac Asimov',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(27,	'38 idées pour gagner de l’argent ',	'Nicolas daudin',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(28,	'peter pan',	'James Matthew barrie',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(29,	'Le cycles de autre monde 5 tomes',	'maxime chattam',	'5',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(30,	'realisez votre site web avec html5 et css3 ',	'mathieu nebra',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(31,	'concevez votre site web avec php et mysql',	'mathieu nebra',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(32,	'Les 17 lois indispensables au succès financier ',	'christian dubois',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(33,	'prime time ',	'jay martel',	'1',	NULL,	'09/04/18',	'',	'',	'',	'0000-00-00 00:00:00'),
(34,	'le succès par la pensée constructive',	'napoléon hill',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(35,	'reflechissez et devenez riche',	'napoléon hill',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(36,	'l’art de demander ',	'patrick ras',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(37,	'la vie secrète des arbres',	'Peter wollhelem',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(38,	'la réponse',	'allan et barbara pease',	'1',	NULL,	'09/04/18',	'21/04/18',	'',	'',	'0000-00-00 00:00:00'),
(39,	'libérez votre cerveau',	'idriss aberkane',	'1',	NULL,	'21/04/18',	'29/04/18',	'',	'',	'0000-00-00 00:00:00'),
(40,	'farnam street',	'',	'1',	NULL,	'',	'',	'',	'',	'0000-00-00 00:00:00'),
(41,	'on m’a dit que c’était impossible',	'',	'1',	NULL,	'08/05/18',	'16/05/18',	'',	'',	'0000-00-00 00:00:00'),
(42,	'pouvoir illimité',	'tony robbins',	'1',	NULL,	'04/06/18',	'26/08/18',	'',	'',	'0000-00-00 00:00:00'),
(43,	'les hommes ne pensent qu’au sexe',	'allan et barbara pease',	'1',	NULL,	'16/06/18',	'30/06/18',	'',	'',	'0000-00-00 00:00:00'),
(44,	'la haute quête de dragonia',	'pierre grimbert',	'1',	NULL,	'30/07/18',	'03/08/18',	'',	'',	'0000-00-00 00:00:00'),
(45,	'amazon la machine à tout vendre',	'',	'1',	NULL,	'26/08/18',	'04/09/18',	'',	'',	'0000-00-00 00:00:00'),
(46,	'la franc maçonnerie pour les nuls',	'',	'1',	NULL,	'2018-09-05',	'2018-09-11',	'',	'https://images.ecosia.org/4evWzlvoFiX66So9o7v58K2cQDk=/0x390/smart/https%3A%2F%2Fpmcdn.priceminister.com%2Fphoto%2FHodapp-Christopher-La-Franc-Maconnerie-Pour-Les-Nuls-Livre-893542483_L.jpg',	'2019-01-28 20:15:32'),
(47,	'Les 7 habitudes de ceux qui réussissent',	'steven r covey',	'1',	NULL,	'2018-09-12',	'',	'',	'https://static.fnac-static.com/multimedia/FR/Images_Produits/FR/fnac.com/Visual_Principal_340/9/1/8/9782754000819/tsp20120928074705/Les-7-habitudes-de-ceux-qui-reuient-tout-ce-qu-ils-entreprennent.jpg',	'0000-00-00 00:00:00'),
(48,	'histoire de la franc maçonnerie',	'',	'1',	NULL,	'2018-10-08',	'2018-10-11',	'',	'https://static.fnac-static.com/multimedia/FR/Images_Produits/FR/fnac.com/Visual_Principal_340/3/2/6/9782213001623/tsp20121001193704/Histoire-de-la-franc-maconnerie-francaise-.jpg',	'0000-00-00 00:00:00'),
(49,	'les francs maçons et les templiers',	'',	'1',	NULL,	'2018-10-01',	'2018-10-07',	'',	'https://pictures.abebooks.com/DOMIFASOL/md/md20140467593.jpg',	'0000-00-00 00:00:00'),
(50,	'bill gates sa vie',	'Daniel Ichbiah',	'1',	NULL,	'2018-10-12',	'2018-10-26',	'Très bon livre qui montre bien les débuts de la multinational MICROSOFT',	'http://ichbiah.online.fr/images/gatesf.jpg',	'0000-00-00 00:00:00'),
(51,	'hu',	'David dolo',	'1',	NULL,	'2018-10-28',	'',	'Très (trop) étrange à mon goût et trop noir ',	'https://images-eu.ssl-images-amazon.com/images/I/41zmYnrkOwL._SX195_.jpg',	'2019-01-20 13:17:57'),
(52,	'blood sweat and pixel',	'Jason Schreier',	'1',	NULL,	'2018-10-30',	'',	'Montre bien l',	'https://images-na.ssl-images-amazon.com/images/I/51h3SnwJTkL._SX330_BO1,204,203,200_.jpg',	'0000-00-00 00:00:00'),
(53,	'une rencontre peut changer un vie',	'Anthony Nevo',	'1',	NULL,	'2018-11-17',	'2018-11-23',	'Un excellent livre qui nous donne de belles leçons de vie que l',	'https://static.fnac-static.com/multimedia/Images/FR/NR/d9/d0/9c/10277081/1540-1/tsp20180927092132/Ta-vie-t-appartient.jpg',	'2018-11-24 23:00:00'),
(54,	'Le moine et le vénérable ',	'christian jacq',	'1',	NULL,	'2018-11-23',	'2018-11-25',	'',	'https://images.ecosia.org/ZlT1sjk-0ux5mUdQZEjlWA5ii2k=/0x390/smart/https%3A%2F%2Flisez0.cdnstatics.com%2Fusuaris%2Flibros%2Ffotos%2F9782221120%2Fm_libros%2F9782221119518ORI.jpg',	'0000-00-00 00:00:00'),
(55,	'Le moine qui vendi sa ferrari',	'Robin S. Sharman',	'1',	NULL,	'2018-11-26',	'2018-12-03',	'Bon livre ce lit facilement ',	'https://images.ecosia.org/1Bfamlp9jZdC1FQKKFKfCGp7idU=/0x390/smart/http%3A%2F%2Fbilder.buecher.de%2Fprodukte%2F34%2F34686%2F34686422z.jpg',	'0000-00-00 00:00:00'),
(56,	'Où tu vas, tu es',	'',	'1',	NULL,	'2018-12-04',	'',	'A ne pas recommander aux gens qui pensent que la méditation est juste un ressenti. Ce livre est très dirigiste',	'https://images.ecosia.org/h9JaDJIHUhCL2HCdlF8YzjeqAxo=/0x390/smart/https%3A%2F%2Fmedia.senscritique.com%2Fmedia%2F000009200632%2F150%2FOu_tu_vas_tu_es.png',	'0000-00-00 00:00:00'),
(57,	'Les robots cycle 2',	'isaac Asimov',	'1',	NULL,	'2018-12-20',	'2019-01-01',	'Excellent !!!',	'https://media.senscritique.com/media/000006927608/source_big/Un_defile_de_robots_Le_Cycle_des_robots_tome_2.jpg',	'0000-00-00 00:00:00'),
(58,	'La prophétie des Andes',	'James Redfiled',	'1',	NULL,	'2019-01-02',	'2019-01-15',	'Bien mais très long sur l\'ensemble ',	'https://static.fnac-static.com/multimedia/Images/FR/NR/07/da/16/1497607/1540-1/tsp20180625155110/La-prophetie-des-Andes.jpg',	'2019-01-18 06:13:03'),
(75,	'Latitude zero ',	'Mike Horn',	'1',	NULL,	'2019-02-09',	'2019-02-18',	'Très bon livre haletant du début à la fin',	'http://www.partir-en-vtt.com/upload/articles/images/2/11/374/mike_horn.gif',	'2019-02-09 20:48:01'),
(81,	'J\'ai tout essayé',	'Isabelle Filiozat',	'1',	260,	'2019-02-25',	'2019-02-27',	'Très intérressant prodigue de bons conseils et explique bien comment un enfant voit le monde contrairement à nous ',	'https://static.fnac-static.com/multimedia/Images/FR/NR/e9/ee/40/4255465/1540-1/tsp20181228161154/J-ai-tout-eaye.jpg',	'2019-02-27 19:31:09'),
(73,	'Abraham Lincoln',	'Liliane Kerjan',	'1',	NULL,	'2019-01-22',	'2019-02-05',	'Très bon livre je le recommande la lecture est aisée et les propos de l',	'http://www.gallimard.fr/var/storage/images/product/21f/product_9782070461592_195x320.jpg',	'2019-02-01 14:43:36');

DROP TABLE IF EXISTS `test_id`;
CREATE TABLE `test_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `test_id` (`id`, `img`) VALUES
(1,	'blabla2');

-- 2019-02-28 19:33:25
