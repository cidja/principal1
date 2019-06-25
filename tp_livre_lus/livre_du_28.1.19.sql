-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 28 jan. 2019 à 20:49
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `livre`
--

-- --------------------------------------------------------

--
-- Structure de la table `livres_lus`
--

DROP TABLE IF EXISTS `livres_lus`;
CREATE TABLE IF NOT EXISTS `livres_lus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `auteur` text NOT NULL,
  `tome` text NOT NULL,
  `debut` text NOT NULL,
  `fin` text NOT NULL,
  `remarques` text NOT NULL,
  `img` varchar(200) NOT NULL,
  `date_ajout` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livres_lus`
--

INSERT INTO `livres_lus` (`id`, `titre`, `auteur`, `tome`, `debut`, `fin`, `remarques`, `img`, `date_ajout`) VALUES
(2, 'Série drizt do urden', 'ra salvatore', '3', 'adolescence', '', '', '', '0000-00-00 00:00:00'),
(3, 'série diablo', '', '3', 'adolescence', '', '', '', '0000-00-00 00:00:00'),
(4, 'Série Halo', '', '3', 'adolescence', '', '', '', '0000-00-00 00:00:00'),
(5, '1984', 'Georges Orwell', '1', 'adolescence', '', '', '', '0000-00-00 00:00:00'),
(6, 'No pasaran', '', '1', 'adolescence', '', '', '', '0000-00-00 00:00:00'),
(7, 'la mort est mon métier', 'robert merle', '1', 'adolescence', '', '', '', '0000-00-00 00:00:00'),
(8, 'le secret de ji 3 tomes', 'pierre grimbert', '3', 'adolescence', 'Coup de cœur', '', '', '0000-00-00 00:00:00'),
(9, 'les enfants de ji 3 tomes', 'pierre grimbert', '3', 'adolescence', '', '', '', '0000-00-00 00:00:00'),
(10, 'les heritiers de ji 3 tomes', 'pierre grimbert', '3', 'adolescence', '', '', '', '0000-00-00 00:00:00'),
(11, 'Warcraft 3 tomes', '', '3', 'adolescence', '', '', '', '0000-00-00 00:00:00'),
(12, 'la semaine de 4 heures ', 'tim ferries', '1', '', '', '', '', '0000-00-00 00:00:00'),
(13, 'total recall', 'arnold schwarznegger', '1', '', '', '', '', '0000-00-00 00:00:00'),
(14, 'Les 7 habitudes qui font la différence', 'christian dubois', '1', '', '', '', '', '0000-00-00 00:00:00'),
(15, 'comment parler à tous le monde', 'leil lowdes', '1', '', '', '', '', '0000-00-00 00:00:00'),
(16, 'Elon Musk', 'Ashlee Vance', '1', '', '', '', '', '0000-00-00 00:00:00'),
(17, 'Le petit guide de la vie', 'Anthony Nevo', '1', '', '', '', '', '0000-00-00 00:00:00'),
(18, 'De zéro à un', 'Peter Thiel', '1', '', '', '', '', '0000-00-00 00:00:00'),
(19, 'ce que l’argent dit de vous', 'christian Junod', '1', '', '', '', '', '0000-00-00 00:00:00'),
(20, 'la quatrième révolution industrielle', 'Klauss shhwab', '1', '', '', '', '', '0000-00-00 00:00:00'),
(21, 'l’energie sexuelle masculine', 'Mantak chia', '1', '', '', '', '', '0000-00-00 00:00:00'),
(22, 'le marketing pour les nuls', '', '1', '', '', '', '', '0000-00-00 00:00:00'),
(23, 'big data penser l’homme et le monde autrement', 'Gilles Babinet', '1', '', '', '', '', '0000-00-00 00:00:00'),
(24, 'Comment se faire des amis', 'dale carnegie', '1', '', '', '', '', '0000-00-00 00:00:00'),
(25, 'Le langage corporel en 30 minutes', 'remy roulier', '1', '', '', '', '', '0000-00-00 00:00:00'),
(26, 'le cycle des robots tome 1', 'isaac Asimov', '1', '', '', '', '', '0000-00-00 00:00:00'),
(27, '38 idées pour gagner de l’argent ', 'Nicolas daudin', '1', '', '', '', '', '0000-00-00 00:00:00'),
(28, 'peter pan', 'James Matthew barrie', '1', '', '', '', '', '0000-00-00 00:00:00'),
(29, 'Le cycles de autre monde 5 tomes', 'maxime chattam', '5', '', '', '', '', '0000-00-00 00:00:00'),
(30, 'realisez votre site web avec html5 et css3 ', 'mathieu nebra', '1', '', '', '', '', '0000-00-00 00:00:00'),
(31, 'concevez votre site web avec php et mysql', 'mathieu nebra', '1', '', '', '', '', '0000-00-00 00:00:00'),
(32, 'Les 17 lois indispensables au succès financier ', 'christian dubois', '1', '', '', '', '', '0000-00-00 00:00:00'),
(33, 'prime time ', 'jay martel', '1', '09/04/18', '', '', '', '0000-00-00 00:00:00'),
(34, 'le succès par la pensée constructive', 'napoléon hill', '1', '', '', '', '', '0000-00-00 00:00:00'),
(35, 'reflechissez et devenez riche', 'napoléon hill', '1', '', '', '', '', '0000-00-00 00:00:00'),
(36, 'l’art de demander ', 'patrick ras', '1', '', '', '', '', '0000-00-00 00:00:00'),
(37, 'la vie secrète des arbres', 'Peter wollhelem', '1', '', '', '', '', '0000-00-00 00:00:00'),
(38, 'la réponse', 'allan et barbara pease', '1', '09/04/18', '21/04/18', '', '', '0000-00-00 00:00:00'),
(39, 'libérez votre cerveau', 'idriss aberkane', '1', '21/04/18', '29/04/18', '', '', '0000-00-00 00:00:00'),
(40, 'farnam street', '', '1', '', '', '', '', '0000-00-00 00:00:00'),
(41, 'on m’a dit que c’était impossible', '', '1', '08/05/18', '16/05/18', '', '', '0000-00-00 00:00:00'),
(42, 'pouvoir illimité', 'tony robbins', '1', '04/06/18', '26/08/18', '', '', '0000-00-00 00:00:00'),
(43, 'les hommes ne pensent qu’au sexe', 'allan et barbara pease', '1', '16/06/18', '30/06/18', '', '', '0000-00-00 00:00:00'),
(44, 'la haute quête de dragonia', 'pierre grimbert', '1', '30/07/18', '03/08/18', '', '', '0000-00-00 00:00:00'),
(45, 'amazon la machine à tout vendre', '', '1', '26/08/18', '04/09/18', '', '', '0000-00-00 00:00:00'),
(46, 'la franc maçonnerie pour les nuls', '', '1', '05/09/18', '11/09/18', '', 'https://images.ecosia.org/4evWzlvoFiX66So9o7v58K2cQDk=/0x390/smart/https%3A%2F%2Fpmcdn.priceminister.com%2Fphoto%2FHodapp-Christopher-La-Franc-Maconnerie-Pour-Les-Nuls-Livre-893542483_L.jpg', '2019-01-28 20:15:32'),
(47, 'Les 7 habitudes de ceux qui réussissent', 'steven r covey', '1', '12/09/18', 'pas fini ', '', '', '0000-00-00 00:00:00'),
(48, 'histoire de la franc maçonnerie', '', '1', '08/10/18', '11/10/18', '', '', '0000-00-00 00:00:00'),
(49, 'les francs maçons et les templiers', '', '1', '01/10/18', '07/10/18', '', '', '0000-00-00 00:00:00'),
(50, 'bill gates sa vie', '', '1', '12/10/18', '27/10/18', '', '', '0000-00-00 00:00:00'),
(51, 'hu', 'oui', '1', '28/10/18', 'pas fini ', '', 'blabla4', '2019-01-20 13:17:57'),
(52, 'blood sweat and pixel', '', '1', '30/10/18', 'pas fini ', '', '', '0000-00-00 00:00:00'),
(53, 'une rencontre peut changer un vie', 'Anthony Nevo', '1', '17/11/18', '23/11/18', '', '', '0000-00-00 00:00:00'),
(54, 'Le moine et le vénérable ', 'christian jacq', '1', '23/11/18', '25/11/18', '', '', '0000-00-00 00:00:00'),
(55, 'Le moine qui vendi sa ferrari', 'Robin S. Sharman', '1', '26/11/18', '03/12/18', '', 'https://images.ecosia.org/1Bfamlp9jZdC1FQKKFKfCGp7idU=/0x390/smart/http%3A%2F%2Fbilder.buecher.de%2Fprodukte%2F34%2F34686%2F34686422z.jpg', '0000-00-00 00:00:00'),
(56, 'Où tu vas, tu es', '', '1', '04/12/18', 'pas fini ', 'A ne pas recommander aux gens qui pensent que la méditation est juste un ressenti. Ce livre est très dirigiste', 'https://images.ecosia.org/h9JaDJIHUhCL2HCdlF8YzjeqAxo=/0x390/smart/https%3A%2F%2Fmedia.senscritique.com%2Fmedia%2F000009200632%2F150%2FOu_tu_vas_tu_es.png', '0000-00-00 00:00:00'),
(57, 'Les robots cycle 2', 'isaac Asimov', '1', '26/12/18', '01/01/19', 'Excellent !!!', 'https://media.senscritique.com/media/000006927608/source_big/Un_defile_de_robots_Le_Cycle_des_robots_tome_2.jpg', '0000-00-00 00:00:00'),
(58, 'La prophétie des Andes', 'James Redfiled', '1', '02/01/19', '15/01/19', 'Bien mais très long sur l\'histoire avec les militaires plutôt gentillés. C\'est hélas souvent le problème avec ce genre de livre de développement personnel a lire que si vous en avez déjà lus plusieurs dans le même style, sinon vous allez vous ennuyer ', 'https://static.fnac-static.com/multimedia/Images/FR/NR/07/da/16/1497607/1540-1/tsp20180625155110/La-prophetie-des-Andes.jpg', '2019-01-18 06:13:03'),
(68, 'Les misérables', 'Vitor Hugo', '1', '15/12/2015', '16/12/2018', 'très bon livre, renversant par son réalisme, nous pouvons presque toucher la misère', 'https://quaideslivres.fr/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/l/e/les-miserables-i-folio-livre-occasion-49012.jpg', '2019-01-24 20:56:02'),
(72, 'ho', 'auteur', 'tome', 'debut', 'fin', 'remarques', 'img', '2019-01-28 20:47:03');

-- --------------------------------------------------------

--
-- Structure de la table `test_id`
--

DROP TABLE IF EXISTS `test_id`;
CREATE TABLE IF NOT EXISTS `test_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `test_id`
--

INSERT INTO `test_id` (`id`, `img`) VALUES
(1, 'blabla2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
