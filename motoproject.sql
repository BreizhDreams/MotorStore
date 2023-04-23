-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 23 avr. 2023 à 12:41
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `motoproject`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_vo_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D4E6F81A837E25D` (`user_vo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `address`
--

INSERT INTO `address` (`id`, `user_vo_id`, `name`, `first_name`, `last_name`, `company`, `address`, `postal_code`, `city`, `country`, `phone`) VALUES
(4, 1, 'Maison', 'François', 'BESNARD', NULL, '3 Rue des Epinais', '22600', 'La Motte', 'FR', '0665198741'),
(5, 1, 'Orange', 'François', 'BESNARD', 'Orange', '2 Avenue Pierre Marzin', '22300', 'Lannion', 'FR', '0000000000'),
(6, 1, 'Ploubezre', 'François', 'BESNARD', NULL, '23 Rue Joseph Lesbleiz', '22300', 'Ploubezre', 'FR', '0123456789'),
(8, 2, 'Maison', '12', '12', '12', '12', '1', '212', 'AF', '212'),
(9, 2, 'Entreprise', '12', '12', '12121', '12', '1', '21212212', 'AF', '12121212'),
(10, 2, 'Orange', 'Coucou', 'Coucou', 'Coucou', 'Coucou', '22600', 'Coucou', 'FR', 'Coucou');

-- --------------------------------------------------------

--
-- Structure de la table `advantage`
--

DROP TABLE IF EXISTS `advantage`;
CREATE TABLE IF NOT EXISTS `advantage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `advantage_type_vo_id` int NOT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` datetime NOT NULL,
  `advantage_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_298E21A1FF70C14C` (`advantage_type_vo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `advantage_fidelity_card`
--

DROP TABLE IF EXISTS `advantage_fidelity_card`;
CREATE TABLE IF NOT EXISTS `advantage_fidelity_card` (
  `advantage_id` int NOT NULL,
  `fidelity_card_id` int NOT NULL,
  PRIMARY KEY (`advantage_id`,`fidelity_card_id`),
  KEY `IDX_6937E86C3864498A` (`advantage_id`),
  KEY `IDX_6937E86CCA4FE9A9` (`fidelity_card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `advantage_type`
--

DROP TABLE IF EXISTS `advantage_type`;
CREATE TABLE IF NOT EXISTS `advantage_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `advantage_type`
--

INSERT INTO `advantage_type` (`id`, `reference`, `designation`) VALUES
(1, 'REDUC', 'Code de Réduction');

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `brand`
--

INSERT INTO `brand` (`id`, `name`, `slug`) VALUES
(1, 'Shoei', 'shoei'),
(2, 'Scorpion', 'scorpion'),
(3, 'Shark', 'shark'),
(4, 'LS2', 'ls2'),
(5, 'Arai', 'arai'),
(6, 'AGV', 'agv'),
(7, 'Alpinestars', 'alpinestars'),
(8, 'Bering', 'bering'),
(9, 'Dainese', 'dainese'),
(10, 'Ixon', 'ixon'),
(11, 'Furygan', 'furygan'),
(12, 'TCX', 'tcx');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `designation`, `description`, `slug`) VALUES
(1, 'Casque', 'Le casque moto est incontestablement l’équipement le plus important. Chez MotorStore, nous savons que chaque motard à des besoins spécifiques, c’est pour cela que nous vous proposons une large gamme de casques. Vous recherchez un casque pour vous accompag', 'casque'),
(2, 'Veste', 'Vous êtes à la recherche d’un blouson, d’une veste ou d’une combinaison ? Du blouson cuir au blouson textile en passant par la veste et la combinaison, chez MotorStore nous avons ce que vous recherchez ! Que ce soit pour une utilisation touring, route, ur', 'veste'),
(3, 'Gants', 'Les gants moto sont le seul équipement obligatoire en plus du casque. Lors d\'un impact, ce sont probablement vos mains qui seront touchées en premier alors mieux vaut bien choisir vos gants! MotorStore propose une large gamme pour que vous trouviez les ga', 'gants'),
(4, 'Pantalon', 'Le pantalon moto est souvent le dernier équipement dans lequel nous pensons à investir. Pourtant, lors d’une glissade, tout le côté latéral est touché. Alors il est important d’opter pour un pantalon hautement résistant à l’abrasion et aux déchirures. 3 t', 'pantalon'),
(5, 'Chaussures', 'La vente de chaussures moto progresse en France. Et ce n\'est pas vraiment surprenant. Aujourd’hui, les codes esthétiques du secteur de la moto se rapprochent de plus en plus de ceux du prêt à porter. Il en devient même difficile de faire la différence ent', 'chaussures'),
(6, 'Protections', 'Compétiteurs, pilotes sur piste, en position d’attaque sur votre moto vous aurez envie de prendre le point de corde en appui sur les genoux avec les protections sliders, d’enrhumer votre adversaire, mais attention à la gamelle, à la sortie de piste où un ', 'protections');

-- --------------------------------------------------------

--
-- Structure de la table `category_advantage`
--

DROP TABLE IF EXISTS `category_advantage`;
CREATE TABLE IF NOT EXISTS `category_advantage` (
  `category_id` int NOT NULL,
  `advantage_id` int NOT NULL,
  PRIMARY KEY (`category_id`,`advantage_id`),
  KEY `IDX_EEEEF39112469DE2` (`category_id`),
  KEY `IDX_EEEEF3913864498A` (`advantage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230307174019', '2023-03-07 17:40:24', 1486),
('DoctrineMigrations\\Version20230313160034', '2023-03-13 16:00:50', 250),
('DoctrineMigrations\\Version20230314153101', '2023-03-14 15:31:26', 183),
('DoctrineMigrations\\Version20230328151508', '2023-03-28 15:15:16', 124),
('DoctrineMigrations\\Version20230329105347', '2023-03-29 10:54:05', 46),
('DoctrineMigrations\\Version20230404120152', '2023-04-04 12:03:00', 136),
('DoctrineMigrations\\Version20230420095126', '2023-04-20 09:51:42', 66),
('DoctrineMigrations\\Version20230420103038', '2023-04-20 10:30:46', 27),
('DoctrineMigrations\\Version20230420103540', '2023-04-20 10:35:47', 22),
('DoctrineMigrations\\Version20230420103804', '2023-04-20 10:38:11', 21),
('DoctrineMigrations\\Version20230420104327', '2023-04-20 10:43:38', 42),
('DoctrineMigrations\\Version20230420113947', '2023-04-20 11:39:51', 22),
('DoctrineMigrations\\Version20230420135720', '2023-04-20 13:57:27', 36),
('DoctrineMigrations\\Version20230420142215', '2023-04-20 14:22:24', 289),
('DoctrineMigrations\\Version20230420172009', '2023-04-20 17:20:13', 54),
('DoctrineMigrations\\Version20230421214635', '2023-04-21 21:46:46', 346),
('DoctrineMigrations\\Version20230423100951', '2023-04-23 10:09:56', 129);

-- --------------------------------------------------------

--
-- Structure de la table `fidelity_card`
--

DROP TABLE IF EXISTS `fidelity_card`;
CREATE TABLE IF NOT EXISTS `fidelity_card` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_points` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `header`
--

DROP TABLE IF EXISTS `header`;
CREATE TABLE IF NOT EXISTS `header` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btn_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `btn_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `header`
--

INSERT INTO `header` (`id`, `title`, `btn_title`, `content`, `btn_url`, `image_url`) VALUES
(1, 'Nos produits', 'Découvrir', 'Découvrez les produits des marques les plus grandes et les plus reconnus du monde de la moto.', '/products', 'road-trip-moto-ouest-americain-2.jpg'),
(2, 'Fideli\'Trip', 'Rejoindre', 'Rejoignez notre programme de Fidélité et bénéficiez d\'avantages exceptionnels sur vos prochaines commandes !', '/fidelity_card/show', 'ktmMoto.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_vo_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `transporter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transporter_price` double NOT NULL,
  `delivry` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F5299398A837E25D` (`user_vo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `user_vo_id`, `created_at`, `transporter_name`, `transporter_price`, `delivry`, `is_paid`, `reference`, `stripe_session_id`) VALUES
(25, 1, '2023-04-23 12:28:43', 'Collisimo', 1000, 'François BESNARD<br/>0665198741<br/>3 Rue des Epinais<br/>22600 La Motte<br/>FR', 1, '23042023_6445247b4545f', 'cs_test_b1TaX3JaxoHQ8w9QLqcaHV71ejcPSTZeq9eyNNZOosroj4cbjoJNuLSOe1'),
(26, 1, '2023-04-23 12:39:55', 'La Poste', 499, 'François BESNARD<br/>0665198741<br/>3 Rue des Epinais<br/>22600 La Motte<br/>FR', 1, '23042023_6445271bc5a2a', 'cs_test_b1nIAMTtMMa7MP9rHA9g4qN2vs4qngNjKM1AmiU6iykKs6GjrZsyULkuKE');

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_vo_id` int NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_845CA2C1C96B6DF8` (`order_vo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_details`
--

INSERT INTO `order_details` (`id`, `order_vo_id`, `product`, `quantity`, `price`, `total`) VALUES
(52, 25, 'EXO-R1 AIR Fabio Monster Replica', 1, 52990, 52990),
(53, 26, 'SMART JACKET', 1, 69995, 69995),
(54, 26, 'ATOMIC', 1, 39995, 39995);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_vo_id` int NOT NULL,
  `brand_vo_id` int NOT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_ttc` double NOT NULL,
  `photo_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_category_vo_id` int DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(800) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_best` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04ADA2C6564C` (`category_vo_id`),
  KEY `IDX_D34A04AD110CD012` (`brand_vo_id`),
  KEY `IDX_D34A04ADC3620458` (`sub_category_vo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `category_vo_id`, `brand_vo_id`, `designation`, `prix_ttc`, `photo_url`, `sub_category_vo_id`, `slug`, `details`, `is_best`) VALUES
(1, 1, 2, 'EXO-390 CHICA II', 10990, 'exo-390-chica-ii.jpg', 1, 'exo-390-chica-ii', 'Casque intégral, coque en polycarbonate. Écran prédisposé Pinlock MAXVISION®. Intérieur KwikWick2 anti-transpirant, hypoallergénique, démontable et lavable. Ventilations à l\'avant et à l\'arrière. Fermeture par boucle micrométrique. Homologation ECE 22.05.', 0),
(2, 1, 2, 'EXO-R1 AIR Fabio Monster Replica', 52990, 'fabior1air_10d246d.jpg', 1, 'exo-r1-air-fabio-monster-replica', 'Casque intégral en fibres multi-composites. Réplique du casque de Fabio Quartararo. Structure en Ultra TCT®. Intérieur en EPS. Fermeture de la jugulaire par boucle Double-D en titane. Livré avec un écran incolore de série avec support Tear Off, avec un écran fumé Maxvision avec support Tear Off, et avec un film Pinlock® anti-buée. Homologation ECE 22.05', 1),
(3, 1, 3, 'SKWAL 2 NOXXYS', 29999, 'none_088f5afb850b47e1deca5b01ab56ce12_088f5af.jpg', 1, 'skwal-2-noxxys', 'Casque intégral SHARK Skwal 2.Coque en résine thermoplastique injectée. Lentille antibuée Pinlock MaxVision® incluse. Écran pare-soleil labéllisé UV380 et traité anti-rayures. LED intégrées à batterie rechargeable. Fermeture par boucle micrométrique', 0),
(4, 1, 3, 'RIDILL NELUM', 19999, 'none_f2c721b853d3be8937e2421b7565dd30_f2c721b.jpg', 1, 'ridill-nelum', 'Casque intégral. Coque en résine thermoplastique injectée. Écran solaire interne. Écran anti-rayures et prédisposé lentille antibuée Pinlock. Intérieur démontable et lavable. Ventilations optimisées par simulation numérique. Fermeture par boucle micrométrique.', 0),
(5, 1, 4, 'FF353 RAPID HAPPY DREAMS', 10999, 'none_048c1d941bda3fec3be707aeed2a2529_048c1d9.jpg', 1, 'ff353-rapid-happy-dreams', 'Casque intégral. Coque en polycarbonate HPTT. 2 tailles de calotte. Écran traité anti-rayures et anti-UV. Prédisposé Pinlock. Intérieur respirant, démontable et lavable. Tissu hypoallergénique. Ventilations supérieures et mentonnières. Extracteur d\'air à l\'arrière. Boucle micrométrique. Certifié ECE 22.05 & DOT', 0),
(6, 1, 2, 'EXO-1400 CARBON AIR Legione', 43950, 'none_601d10e610f1a245b3daaceec2b7c26c_601d10e.jpg', 1, 'exo-1400-carbon-air-legione', 'Casque intégral en fibres de carbone. Structure en Ultra TCT®. Fermeture de la jugulaire par boucle Double-D en titane. Changement d\'écran en 10 secondes. Cache nez et cache menton amovibles. Homologation ECE 22.05', 0),
(7, 1, 2, 'EXO-R1 AIR VICTORY', 39990, 'none_8c74803e86a6bfa95ac3fd0c01db6ff8_8c74803.jpg', 1, 'exo-r1-air-victory', 'Casque intégral en fibres multi-composites. Structure en Ultra TCT®. Fermeture de la jugulaire par boucle Double-D en titane.', 0),
(8, 1, 1, 'NEOTEC II MM93 COLLECTION 2-WAY TC-5', 75900, 'none_b91aa81e75d20c23c4795899e897dcaf_b91aa81.jpg', 2, 'neotec-ii-mm93-collection-2-way-tc-5', 'Casque modulable. Coque en fibre AIM: superposition de couches de « fibre organique » et fibre multi-composite. 3 tailles de calotte. Écran solaire interne. Intérieur démontable et lavable. Livré avec une lentille antibuée Pinlock. Large ventilation supérieure et extracteur d\'air à l\'arrière. Double spoiler à l\'arrière. Boucle micrométrique. Double homologation: jet et intégral.', 0),
(9, 1, 1, 'NEOTEC II WINSOME TC-1', 72900, 'none_35833d323270ff34b0e5f3c1cbf87aca_35833d3.jpg', 2, 'neotec-ii-winsome-tc-1', 'Casque modulable. Coque en fibre AIM: superposition de couches de « fibre organique » et fibre multi-composite. 3 tailles de calotte. Écran solaire interne. Intérieur démontable et lavable. Livré avec une lentille antibuée Pinlock. Large ventilation supérieure et extracteur d\'air à l\'arrière. Double spoiler à l\'arrière. Boucle micrométrique. Double homologation: jet et intégral.', 0),
(10, 1, 1, 'NEOTEC II JAUNT TC-1', 72900, 'none_f4b50418dac26aa1c591f1547d4582c2_f4b5041.jpg', 2, 'neotec-ii-jaunt-tc-1', 'Casque modulable. Coque en fibre AIM: superposition de couches de « fibre organique » et fibre multi-composite. 3 tailles de calotte. Écran solaire interne. Intérieur démontable et lavable. Livré avec une lentille antibuée Pinlock. Large ventilation supérieure et extracteur d\'air à l\'arrière. Double spoiler à l\'arrière. Boucle micrométrique. Double homologation: jet et intégral.', 0),
(11, 1, 2, 'EXO-TECH EVO CARBON GENUS', 49900, 'none_21644826ccc6597cc53a7e50cb729bf6_2164482.jpg', 2, 'exo-tech-evo-carbon-genus', 'Casque modulable en fibres de carbone. 2 tailles de calotte. Livré avec un écran incolore. Lentille Pinlock MaxVision incluse. Écran interne solaire rétractable. Déflecteur de souffle. 3 aérations réglables. Ouverture de la mentonnière à 180°. Fermeture par boucle micrométrique. Double homologation ECE R22.06 P/J : intégral et jet.', 0),
(12, 1, 4, 'FF901 ADVANT X CARBON FUTURE', 49900, 'none_153df85c076ad489cbcaa2513377f8d2_153df85.jpg', 2, 'ff901-advant-x-carbon-future', 'Casque modulable. Coque en carbone, mentonnière en carbone. Fermeture de la jugulaire par boucle métallique micrométrique. Système de déclenchement d\'urgence. Sangle de menton renforcée. Patch de sécurité réfléchissant. EPS multi-densité. Tirette magnétique intelligente. Ventilation du menton à couverture métallique. Ventilation supérieure en métal. Orifices d\'évacuation ouverts et fermés. Tissu X-Static© Silver Liner. Doublure extra-confortable, amovible et lavable, respirante, hypoallergénique. Mousse découpée au laser. Système de double visière. Système d\'attache rapide. Écran résistant aux rayures et aux UV. Prêt pour lentille Max Vision Pinlock (inclus). Homologation 22.06', 0),
(13, 1, 3, 'EVO GT SEAN', 47900, 'none_9fcd04dfd7dcf9f0640355689f4e7923_9fcd04d.jpg', 2, 'evo-gt-sean', 'Casque moto modulable. Coque en résine thermoplastique injectée. 2 tailles de calotte. Boucle Micrométrique. Ecran incolore VZ 150 Max Vision de classe optique 1, assurant une qualité de vision incomparable, traité anti-rayure et antibuée. Auto-down qui permet la remontée automatique de l’écran lors de la manipulation de la mentonnière. ±1650g. Homologation ECE 22.05 \"P/J\"', 0),
(14, 1, 2, 'COVERT-X WALL', 29900, 'none_e4a7634ff23e76e947b93c8091384230_e4a7634.jpg', 3, 'covert-x-wall', 'Casque jet SCORPION Covert-X. Coque en fibres composites ultra légères. 2 tailles de calottes pour un ajustement morphologique optimal. Mousses de joues Kwikwick2® : très efficaces, hypoallergéniques, amovibles, lavables en machine, très douces et agréable au toucher.', 0),
(15, 1, 1, 'J-CRUISE 2 AGLERO NOIR ROUGE', 59900, 'none_0c458f7cfdff9b316ea4fb2ce91ffb51_0c458f7.jpg', 3, 'j-cruise-2-aglero-noir-rouge', 'Casque jet SHOEI J-Cruise 2. Coque en AIM: fibre de verre organique et fibres multi-composites. 4 tailles de calotte. Écran CJ-2 prédisposé à recevoir une lentille antibuée Pinlock®. Écran solaire interne. Fermeture par boucle micrométrique.', 0),
(16, 1, 1, 'J-CRUISE 2 AGLERO NOIR JAUNE', 59900, 'none_a8ef7612f87258116e689f7002e7cb94_a8ef761.jpg', 3, 'j-cruise-2-aglero-noir-jaune', 'Casque jet SHOEI J-Cruise 2. Coque en AIM: fibre de verre organique et fibres multi-composites. 4 tailles de calotte. Écran CJ-2 prédisposé à recevoir une lentille antibuée Pinlock®. Écran solaire interne. Fermeture par boucle micrométrique.', 0),
(17, 1, 5, 'FREEWAY CLASSIC SKULL', 39900, 'none_15fc49ca3d1d28960b0b929c24f1a363_15fc49c.jpg', 3, 'freeway-classic-skull', 'Coque en fibre. Intérieur unique en similicuir souple et doux. Calotin EPS multi densité. Oreillettes remplaçables et adaptables. Bande d\'attache pour sangle de lunettes. Boucle double D.', 0),
(18, 1, 6, 'K-5 JET ROSSI MISANO 2015', 57900, 'none_4709a712cb326e890596e8397880b66d_4709a71.jpg', 3, 'k-5-jet-rossi-misano-2015', 'Coque en fibre composite CAAF. 2 tailles de calotte. Écran pare-soleil intégré. Écran prédisposé PINLOCK®. Intérieur en tissu 3D Dry-Comfort avec traitement antibactérien entièrement amovible et lavable. Système de ventilation IVS. Boucle micrométrique.', 0),
(20, 2, 10, 'JACKAL', 47900, 'none-673e57ded5fb85345b60278b1cfd0c89-673e57d.jpg', 4, 'jackal', 'Combinaison en cuir de vachette épais et souple reconnu pour ses fortes capacités de résistance à l\'abrasion. Cuir flex sur les côtés, l\'arrière des manches et le bas du dos pour plus d\'aisance Inserts Stretch à l\'intérieur des manches, de l\'entrejambe et à l\'arrière du mollet pour plus de mobilité Doublure de confort Mesh amovible pour une circulation de l\'air accrue Protections coudes homologuées CE niveau 1 Protections épaules homologuées CE niveau 1 Protections genoux homologuées CE de niveau 1 Protections hanches homologuées CE de niveau 2 Emplacements pour Sliders coudes Sliders genoux Sport 2 amovibles, ajustables et remplaçables Rubber profilés aux épaules et genoux. Homologuée CE', 0),
(21, 2, 7, 'ATEM V4', 140000, 'none_4ea141f87bfa8e64a12c49a390b6cfac_4ea141f.jpg', 4, 'atem-v4', 'Combinaison cuir ALPINESTARS Atem V4. Construction en cuir de bovin et tissu stretch hautement résistant. Protections GP-R Alpinestars sur les épaules, les coudes et les genoux. Protections Nucleon Flex Racig sur les hanches. Sliders GP amovibles. Sliders coudes anatomiques.', 0),
(22, 2, 7, 'ATEM V4 2P', 120099, 'none_9bdde9c7f934b060d551aaf0761dc19c_9bdde9c.jpg', 4, 'atem-v4-2p', 'Combinaison cuir 2 pièces ALPINESTARS ATEM V4. Construction en cuir de vachette. Multiples soufflets d\'aisance. Protections GP-R Armor sur les épaules, les coudes et les genoux. Protections Nucléon Flex sur les hanches. Inserts en stretch polyamide HSRF.', 0),
(23, 2, 10, 'VORTEX 3', 89999, 'none_669352640d0fe7662a0a871a28a79505_6693526.jpg', 4, 'vortex-3', 'Combinaison en cuir et Nylon 4-way stretch doublé Lycra. Matière intérieure en soft mesh fixe et gilet Soft mesh amovible. Protections épaules, coudes, genoux BETAC type B niveau 1, utilisées en MotoGP. Protections Hanches YF C30 type B niveau 2 ventilées. Protection d’assemblage avant-bras et protection du zip poignet en matériaux polymère à haute résistance à l’abrasion. Renfort Mesh 3D avec contrefort 600D aux cuisses et au dos. Double couche de cuir à l’assise. Renfort cuir extérieur, intérieur cuisses. Protection moussée coccyx. Nouveaux ODA en polymère bi-densité aux épaules et genoux. Nouveaux sliders coudes ELBOW 2.0 amovibles et remplaçables, dérivés du MotoGP. Sliders genoux RACE 2.0 amovibles, remplaçables et ajustables en position, utilisés en MotoGP. Homologuée CE, classe AAA,', 0),
(24, 2, 9, 'TOSA 1 PCS PERF', 105095, 'none_21572a741a71c5bb8fb41156649c6239_21572a7.jpg', 4, 'tosa-1-pcs-perf', 'Combinaison de moto une pièce en cuir Tutu perforé et tissu bi-élastique. Doublure amovible en mesh et 3D Bubble. Perforation localisée pour une bonne ventilation. Zips d\'enfilage aux mollets. Bosse aérodynamique avec kit waterbag prêt à l\'emploi. Col élastique. Plaques remplaçables en aluminium sur les épaules. Protections en composites homologuées CE aux épaules, aux coudes et aux genoux. Protections Pro-Shape 2.0® homologuées CE aux hanches. Homologation CE.', 0),
(25, 2, 9, 'LAGUNA SECA 5 PERF', 139995, 'none_79c2c448cfa782e0b860d8ab2b126beb_79c2c44.jpg', 4, 'laguna-seca-5-perf', 'Combinaison une pièce en cuir de vache pleine fleur perforé. Doublure amovible en 3D-Bubble et mesh respirant. Housse de combinaison fournie. 1 poche intérieure. Bosse aérodynamique prévue pour accueillir la poche à eau du kit Waterbag pret à l\'emploi. Fermeture zippée avec agrafe en cuir sur le devant. Col confort. Zips d\'enfilage sur les mollets. Plaques en aluminium aux épaules. Sliders de genoux interchangeables. Protections en composites homologuées CE aux épaules, aux coudes et aux genoux. Protections Pro-Shape 2.0® homologuées CE aux hanches. Homologation CE.', 1),
(26, 2, 9, 'SUPER SPEED 4', 79995, 'none_550ac2b2ca1f765156861357e8482100_550ac2b.jpg', 5, 'super-speed-4', 'Blouson en cuir de vache D-Skin et tissu bi-élastique. Doublure 3D-Bubble et maille respirante. Aération sur les côtés. Pattes de serrage pression à la taille. Dos rallongé. Raccord pantalon. Aileron aérodynamique. 2 poches extérieures et 1 poche intérieure. Empiècements réfléchissants. Sliders remplaçable 2.0. Prédisposé à recevoir une dorsale et une protection pectorale. Plaque d’aluminium sur les épaules et les coudes. Protections homologuées CE aux épaules et aux coudes. Homologation CE.', 0),
(27, 2, 7, 'FUSION', 74995, 'none_0d4b46a775bf8eedddcc895f6db8cb86_0d4b46a.jpg', 5, 'fusion', 'Blouson moto racing homme en cuir de bovin avec double couche dans les zones exposées. Doublure intérieure amovible en maille traitée avec la technologue Polygiene Biostatic™ Stays Fresh. Corps, bras préformés. Multiples perforations pour l\'aération. Panneaux structurés MATRYX® sur l\'abdomen et le haut du dos pour la ventilation. Protections GP-R aux épaules, coudes. Inserts réfléchissants. Homologation CE comme EPI, classe AAA.', 0),
(28, 2, 7, 'ATEM V4', 69995, 'none_3a8f373be8b6ecaf645a4dbb45db4a3c_3a8f373.jpg', 5, 'atem-v4', 'Blouson cuir racing ALPINESTARS Atem V4. Construction en cuir de vachette. Tissu perforé optimisant la circulation du flux d\'air. Bosse dorsale aérodynamique. Protections sur les épaules et les coudes. Soufflets d\'aisance sur les épaules et les coudes.', 0),
(29, 2, 9, 'AVRO 4', 64995, 'none_a1f81f83ab8dbae7b5249d4c060de043_a1f81f8.jpg', 5, 'avro-4', 'Blouson en cuir bovin pleine fleur. Empiècements en tissu élastique. Doublure Nanofeel®. Doublure thermique amovible. Zips de ventilation. Homologation CE. Protections CE aux coudes et aux épaules. Poche pour dorsale (option). Coques thermoformées avec insert en aluminium. Détails réfléchissants.', 0),
(30, 2, 7, 'MISSILE V2 IGNITION', 59995, 'none_6258bc1856f337fe7f80eeed36f144dd_6258bc1.jpg', 5, 'missile-v2-ignition', 'Blouson moto en cuir de bovin premium \"Racing Grade\". Panneaux en cuir avec micro-perforations pour un flux d\'air optimisé. Empiècements Stretch. Panneaux innovants Matryx sur l\'abdomen, la poitrine et la bosse dorsale pour une circulation de l\'air optimisée et une résistance supérieure. Doublure de confort Mesh amovible. Protections épaules, coudes GP-R RACE homologuées CE. Sliders d\'épaules et de coudes DSF / TPU. Race Fit : coupe ajustée près du corps. Homologation CE EN17092-AAA.', 0),
(31, 2, 7, 'MISSILE V2', 55995, 'none_7f25df7124a50d0ac51ec7b91a47d952_7f25df7.jpg', 5, 'missile-v2', 'Blouson moto en cuir de bovin premium, 1.3mm (souplesse et résistance). Panneaux en tissu technique MATRYX®, situés sur le dos et l\'abdomen. Panneaux en polyamide HRSF très élastique pour une plus grande liberté de mouvement. Protections GP-R aux épaules, coudes, genoux et tibia avec certification CE. Sliders externes Dynamic Friction Shield (DFS) composés de TPU moulé à double densité. Protecteur de hanche Bio-Flex Race pour une protection optimale contre les impacts. Sport Fit : préformé pour un confort immédiat. Homologation CE EN17092-AAA.', 0),
(32, 2, 10, 'VORTEX 3 JKT', 46999, 'none_0da850bea8575f5e73e59504b9f7939d_0da850b.jpg', 5, 'vortex-3-jkt', 'Blouson racing. Matière extérieure en Cuir et Nylon 4-way stretch. Micro-perforations localisées pour une ventilation optimale. Matière intérieure en Soft mesh. Serrage velcro élastiqué aux hanches. Zip de connexion blouson/pantalon 270°. Boucle élastiquée pour un raccord ceinture. 2 poches extérieures. 1 poche intérieure mesh. 1 poche intérieure étanche. Nouveaux ODA en polymère bi-densité aux épaules. Nouvelles pièces de renfort moulées aux coudes. Nouvelle bosse aérodynamique issue du MotoGP. Protections épaules/coudes BETAC type B niveau 1 - utilisées en MotoGP. Empiècements réfléchissants biceps et bas du dos. Homologué CE, classe AAA.', 0),
(33, 2, 8, 'ATOMIC', 39995, 'none_7737c922160c07eaf67850ffbd193fb1_7737c92.jpg', 5, 'atomic', 'Blouson moto toutes saisons en cuir de vachette. Coupe Body Fit : ajustée, près du corps. Doublure fixe en textile 100% filet, maille issue de fibres recyclées. Doublure thermique intérieure amovible Shelltech Super. Réhausse col. Protections Omega homologuées CE-EN1621-1 Niveau 1 et amovibles aux coudes et aux épaules. Zip de raccordement blouson / pantalon. Poche portefeuille. 2 poches intérieures, 2 poches extérieures. Homologation CE et EPI.', 0),
(34, 2, 9, 'CARVE MASTER 3 GORE-TEX', 59995, 'none_3e135d5f90a1a89e4ae182f38953eafa_3e135d5.jpg', 6, 'carve-master-3-gore-tex', 'Veste moto homme textile toutes saisons Touring/Adventure. Tissu Mugello. Membrane Gore-Tex® imperméable et respirante. Doublure thermique amovible, col thermique amovible. Ventilations sur la poitrine et les manches et extracteurs dans le dos. Protections Pro-Armor aux coudes et aux épaules, homologuées CE niveau 2 type B. Coques de protections rigides en PU avec tissu 3D-Stone. Homologation CE comme EPI.', 0),
(35, 2, 9, 'RACING 3 D-DRY®', 42995, 'none_1251da0c24e389e89ab4ac7b4ba40437_1251da0.jpg', 6, 'racing-3-d-dryr', 'Blouson en tissu stretch imperméable. Doublure thermique amovible. Membrane D-Dry® étanche et respirante. Renfort en tissu Cordura. Protections CE amovibles aux coudes et aux épaules. Coques thermoformées aux épaules avec insert en aluminium. Détails réfléchissants.', 0),
(36, 2, 7, 'T-GP R V2 WATERPROOF NOIRE', 34995, 'none_caed4b12950d3c49852b4914dc55d605_caed4b1.jpg', 6, 't-gp-r-v2-waterproof-noire', 'Blouson polyvalent en tissu polyester intégrant des panneaux accordéon. Zips de ventilation. Membrane étanche fixe. Doublure thermique. Homologation CE. Sliders TPU externes sur les épaules. Protections CE aux épaules et aux coudes. Poches pour thorax et dorsale (options).', 0),
(37, 2, 7, 'T-GP R V2 WATERPROOF NOIRE-ROUGE', 34995, 'none_51b00014b257ec4aa23c616004a8992a_51b0001.jpg', 6, 't-gp-r-v2-waterproof-noire-rouge', 'Blouson polyvalent en tissu polyester intégrant des panneaux accordéon. Zips de ventilation. Membrane étanche fixe. Doublure thermique. Homologation CE. Sliders TPU externes sur les épaules. Protections CE aux épaules et aux coudes. Poches pour thorax et dorsale (options).', 0),
(38, 2, 10, 'BLASTER', 31999, 'none_1c6d236e9bda08f2102fef2857ef5cdc_1c6d236.jpg', 6, 'blaster', 'Blouson moto homme textile toutes saisons. Construction en polyester 600D et Ripstop. Renforts en polyester 1200D aux coudes et aux épaules. Doublure intérieure en polyester, doublure fixe étanche et respirante XDry. Doublure thermique amovible. Zips de ventilation. Soufflets d\'aisance en accordéon au niveau des coudes. Fermeture zippée sur le devant. Zips semi auto-lock. Coques de protections externes injectées bi-densité issues du MotoGP™ aux épaules. Protections aux coudes et aux épaules souples et ventilées IX-Proflex Seka-1 homologuées CE de niveau 1. Poches de protection en mesh 3D maximisant la circulation de l\'air. Homologation CE comme EPI.', 0),
(39, 2, 9, 'HYDRAFLUX 2 AIR D-DRY®', 29995, 'none_c13fd5a1ae5ea7bc5db030c63c066417_c13fd5a.jpg', 6, 'hydraflux-2-air-d-dryr', 'Blouson moto homme textile toutes saisons. Construction en polyester 600D et Ripstop. Renforts en polyester 1200D aux coudes et aux épaules. Doublure intérieure en polyester, doublure fixe étanche et respirante XDry. Doublure thermique amovible. Zips de ventilation. Soufflets d\'aisance en accordéon au niveau des coudes. Fermeture zippée sur le devant. Zips semi auto-lock. Coques de protections externes injectées bi-densité issues du MotoGP™ aux épaules. Protections aux coudes et aux épaules souples et ventilées IX-Proflex Seka-1 homologuées CE de niveau 1. Poches de protection en mesh 3D maximisant la circulation de l\'air. Homologation CE comme EPI.', 0),
(40, 3, 7, 'SP X AIR CARBON V2', 13495, 'none_32d089616749746b13c06e28140bae0d_32d0896.jpg', 7, 'sp-x-air-carbon-v2', 'Gants été. Homologation CE. Construction en cuir et textile. Cuir perforé pour une excellente circulation du flux d\'air. Soufflets d\'aisance offrant un maximum de flexibilité. Insert tactile. Articulations renforcées. Paume renforcée.', 0),
(41, 3, 7, 'HONDA SP-8 V3', 11995, 'none_f49a3c0a763593652c2565981e9999d6_f49a3c0.jpg', 7, 'honda-sp-8-v3', 'Gants en cuir de chèvre pleine fleur et cuir synthétique. Paume de main en suédé. Insert antidérapant dans la paume de la main. Doigts anatomiques préformés. Doigts et poignets perforés. Manchette longue. Pattes de serrage Velcro. Index tactile pour l\'utilisation du smartphone. Pont breveté entre l\'annulaire et le petit doigt. Protections métacarpienne SP double densité. Homologués CE Niveau 1.', 0),
(42, 3, 10, 'GP5 AIR', 10499, 'none_de349ab56a372fa1693b95735eb0397b_de349ab.jpg', 7, 'gp5-air', 'Gants été en cuir de chèvre et polyuréthane. Nombreuses perforations pour une bonne ventilation. Manchettes longues. Serrages aux poignets et aux manchettes. Cuir flex sur les articulations, les doigts et coutures retournées. Index tactile pour l’utilisation du smartphone. Coques aux articulations couvertes de cuir, sliders course, renfort paume et tranche. Anti- retournement entre l’annulaire et l’auriculaire. Homologation CE.', 0),
(43, 3, 7, 'HALO', 10995, 'none_cc446566ec48d48fa9409a35aa5a0fd9_cc44656.jpg', 7, 'halo', 'Gants été en cuir de chèvre, polyamide et aramide. Panneaux perforés sur les doigts. Tissu stretch sur le dos de la main. Manchette courte. Index et pouce tactiles pour l\'utilisation du smartphone. Pattes de serrage Velcro® aux poignets. Protections ergonomiques aux articulations en plastiques injecté et sans couture. Paume de main en caoutchouc antidérapant. Sliders sur le coté de la main. Homologués CE Niveau 1.', 0),
(44, 3, 9, 'X-MOTO UNISEX', 9495, 'none_e6f7b066eb22945246ad15611c06028b_e6f7b06.jpg', 7, 'x-moto-unisex', 'Gants en cuir de chèvre et tissu maillé. Homologation CE. Inserts souples. Tissu perforé, idéal lors des fortes chaleurs. Coque de protection sur les phalanges. Paume renforcée. Dainese Smart Touch permettant l\'utilisation des écrans tactiles.', 0),
(45, 3, 10, 'RS REPLICA', 39995, 'none_b6da265502dff089b896250d980093bf_b6da265.jpg', 7, 'rs-replica', 'Gants été en cuir de vachette perforé. Fourchettes de doigt en aramide Coton avec Fibres Dupont Kevlar réputé pour son extrême résistance Double coque de protection des articulations ultra-ventilée Renfort de la tranche Slider de paume injecté Pont petit doigt anti-retournement Manchette longue Patte de serrage Velcro aux poignets Poignet stretch avec strap Velcro Soufflets d\'aisance sur les doigts Grip poignée ergonomique. Homologués CE EN13594 Niveau 1KP', 0),
(46, 3, 7, 'AMT-10 Air HDRY', 19995, 'none_a53efa7513102f298cdba9d06c087f7a_a53efa7.jpg', 7, 'amt-10-air-hdry', 'Gants mi-saison en textile nyspan stretch. Totale imperméabilité grâce à l\'utilisation d\'une membrane laminée Hdry® comme sur-gants. Dessus des mains en Matryx®. Empiècements Rideknit®. Manchette courte. Pouce et index compatibles tactile. Paume en cuir de chèvre. Renforts Arshield sur la tranche. Protection métacarpienne surmoulée et sans coutures. Pont breveté Alpinestars entre l\'annulaire et le petit doigt. Homologation CE comme EPI niveau 2.', 0),
(47, 3, 7, 'ANDES V3 DRYSTAR', 11995, 'none_b40d11fdd85a8544d0a4a306bdbef4b4_b40d11f.jpg', 9, 'andes-v3-drystar', 'Gants textile Micro Ripstop. Paume en cuir de chèvre. Membrane Drystar® 100% imperméable et respirante. Protections phalanges en visco-élastique homologuées CE. Manchette longue. Homologués CE', 0),
(48, 3, 9, 'CARBON 3 SHORT', 12995, 'none_99b0c533608bf33064ee3aece5400509_99b0c53.jpg', 9, 'carbon-3-short', 'Gants DAINESE Carbon 3 Short. Construction en cuir de chèvre et de mouton et tissu spandex. Doigts pré-courbés. Système DCP sur l\'auriculaire. Serrage velcro. Coque carbone sur les phalanges. Multiples renforts sur les doigts. Paume renforcée.', 0),
(49, 3, 8, 'RAZZER', 9499, 'none_502f9d89c9a8665c5ac051289b197d4c_502f9d8.jpg', 9, 'razzer', 'Gants en cuir de Chèvre, néoprène. Coque de Protection Carbone. Renfort Paume. Sensor System. Serrage poignet. Manchette Courte. Doublure Polyester. Homologation EN 13594: 2015', 0),
(50, 3, 7, 'SMX Z DRYSTAR', 8995, 'none_3f0232a8cd92ddc9eebbba565e34ea4d_3f0232a.jpg', 9, 'smx-z-drystar', 'Gants route en cuir de chèvre pleine fleur. Technologie Drystar® étanche. Renforts sur la paume.', 0),
(51, 3, 9, 'STEEL-PRO IN', 33995, 'none_e97a0912da5135c4d8b82e5d11087b57_e97a091.jpg', 9, 'steel-pro-in', 'Gants en cuir de chèvre. Homologation CE. Soufflets d\'aisance sur les doigts et sur le dos de la main. Inserts élastiques apportant un maximum de souplesse. Coque de protection sur les phalanges. Paume renforcée. Coutures renforcées.', 0),
(52, 3, 8, 'ZAYANE GTX', 13995, 'none_4f522f7a7ebe586f7900fa4f33609bef_4f522f7.jpg', 9, 'zayane-gtx', 'Gants mi saison en Power Tech. Empiècements Softshell (coupe-vent et déperlants) Paume en cuir de chèvre et Amara. Membrane Gore-Tex imperméable, étanche et respirante. Coque de protection, paume renforcée, manchette courte. Homologation CE.', 0),
(53, 3, 7, 'Celer V2', 12495, 'none-1deba4d928696a8ae263b508d2b740a0-1deba4d.jpg', 9, 'celer-v2', 'Gants en cuir de chèvre pleine fleur. Empiècements perforés. Insert stretch entre le pouce et la paume. Compatible avec les écrans tactiles. Fermeture velcro. Homologation CE. Coque de protection rigide en PU sur les phalanges. Paume renforcée en cuir. Renforts en poly-textile.', 0),
(55, 3, 11, 'ZEUS', 7290, 'none-5833a84e976ce0bc8027d72758e009a2-5833a84.jpg', 10, 'zeus', 'Gants hiver en polyamide. Insert étanche et respirant. Doublure thermique ouatinée. Double serrage. Insert pour la manipulation aisée d\'écrans tactiles. Homologation CE EN 13594:2015. Coque de protection sur les phalanges. Renfort sur la paume. Détails réfléchissants.', 0),
(56, 3, 10, 'PRO RAGNAR', 10900, 'none-38a881e8fb3626774b39cd705a50b299-38a881e.jpg', 10, 'pro-ragnar', 'Gants hiver, en Cordura®, Ripstop et cuir de chèvre. Étanche et isolé avec de la Primaloft® Gold Cross Core™ et de la ouate. Doublure en micro polaire et fourrure polaire. Manchettes longues avec double pattes de serrage Velcro®. Manchettes intérieures additionnelle avec serrage Tanka anti-pluie. Inserts en stretch aux poignets. Index tactiles pour l’utilisation du smartphone. Raclette anti-pluie sur l’index gauche. Renfort anti-retournement sur l’annulaire et l’auriculaire. Coque pour les articulations IXON KNUCKLE-ADV_1 en TPU. Slider souple en TPR. Homologation CE Niveau 1.', 0),
(57, 3, 7, 'BOGOTA\' DRYSTAR', 11995, 'none-cc2e2b87b5466bb5a5de9fbcf681745d-cc2e2b8.jpg', 10, 'bogota-drystar', 'Gants hiver en softshell. Membrane en Drystar® imperméable et respirante. Doublure thermique en Primaloft®. Articulation sans couture pour un confort accru. Manchette longue. Paume renforcée en suédé. Pouce et index pour l’utilisation du smartphone. Pont de doigts empêchant le retournement doigts et la séparation lors d\'un choc. Coque de protections aux phalanges. Homologation CE Niveau 1.', 0),
(58, 3, 7, 'AMT-10 DRYSTAR XF WINTER', 15995, 'none-aa91a5fe350195e7ed69b3a76fcfb100-aa91a5f.jpg', 10, 'amt-10-drystar-xf-winter', 'Gants hiver en textile. Membrane laminée en Drystar® XF, respirante et étanche. Doublure thermique en Primaloft®. Articulations sans coutures pour plus de confort. Pouce et index pour l’utilisation du smartphone. Soufflet d’aisance. Insert en cuir de chèvre dans la paume et sur le dessus de la main. Coque de protections au niveau des phalanges. Homologation CE Niveau 1.', 0),
(59, 3, 10, 'PRO RAGNAR BLANC - NOIR', 10999, 'none-6ec4122c0e759afc5bc4950281227d8f-6ec4122.jpg', 10, 'pro-ragnar-blanc-noir', 'Gants hiver, en Cordura®, Ripstop et cuir de chèvre. Étanche et isolé avec de la Primaloft® Gold Cross Core™ et de la ouate. Doublure en micro polaire et fourrure polaire. Manchettes longues avec double pattes de serrage Velcro®. Manchettes intérieures additionnelle avec serrage Tanka anti-pluie. Inserts en stretch aux poignets. Index tactiles pour l’utilisation du smartphone. Raclette anti-pluie sur l’index gauche. Renfort anti-retournement sur l’annulaire et l’auriculaire. Coque pour les articulations IXON KNUCKLE-ADV_1 en TPU. Slider souple en TPR. Homologation CE Niveau 1.', 0),
(60, 3, 11, 'SPARROW 37.5®', 9390, 'none-939ea4338dc33782387ab1644b954c5f-939ea43.jpg', 10, 'sparrow-375r', 'Gants hiver FURYGAN Sparrow 37.5®.Homologués CE. Construction en cuir de chèvre et textile. Membrane étanche et respirante. Doublure thermique conçue pour la saison hivernale. Coques de protection D3O sur les phalanges. Paume renforcée.', 0),
(61, 3, 7, 'HT-5 HEAT TECH Drystar®', 27995, 'none-1b0104e525b58975ab0e9ba120d7dee2-1b0104e.jpg', 11, 'ht-5-heat-tech-drystarr', 'Gants moto chauffants homme en textile stretch, paume en cuir de chèvre. Isolation PrimaLoft® 80 g sur le dos de la main, membrane Drystar® 100% imperméable et respirante. Paume renforcée en cuir. Slider sur la paume. Coque de protection des phalanges. Renforts aux articulations. Bouton de contrôle externe combinant trois modes de réglage possibles. Batterie au lithium de 7,4 V. Index compatible tactile. Homologation CE au niveau CE 1 KP.', 0),
(62, 3, 10, 'IT-YUGA', 28999, 'none-4dc60f8a1b7d644d2f033f2658df0ca3-4dc60f8.jpg', 11, 'it-yuga', 'Gants chauffants en Cuir de chèvre et Softshell. Doublure en fourrure polaire et micro polaire. Imperméable et isolation en Primaloft® Gold Cross Core™. Manchettes longues. Pattes de serrage Velcro®. Étui en silicone pour le stockage des batteries. Serrage Tanka anti-pluie. Index tactile pour l’utilisation du smartphone. Raclette anti-pluie sur l’index gauche. Coque de protections aux articulations couverte de cuir. Homologation CE Niveau 1.', 0),
(63, 3, 7, 'HT-3 HEAT TECH Drystar®', 28995, 'none-424a938f24d4832bef1bf0bf1ea7d67a-424a938.jpg', 11, 'ht-3-heat-tech-drystarr', 'Gants moto hiver chauffants en Spandex et cuir de chèvre. Paume en cuir de chèvre (résistance à l\'abrasion et durabilité.) Isolation Thinsulate™ 100g 3M™ (chaleur et rétention efficace de la chaleur.) Membrane Drystar® 100% imperméable et respirante. Coque de protection des phalanges, renfort double couche sur la tranche de la main en cuir synthétique suédé, grip amélioré, serrage manchette par large bande velcro. Batterie au lithium de 7,4 V. Compatible avec les écrans tactiles. Homologation CE au niveau CE 1 KP.', 0),
(64, 3, 11, 'HEAT X KEVLAR®', 29990, 'none-94378d8e3f9e03013aa0c5490da215a1-94378d8.jpg', 11, 'heat-x-kevlarr', 'Gants moto chauffants en polyamide, softshell et cuir de chèvre. Doublure munie de la technologie 37.5® : thermorégulation du corps et évacuation de l\'humidité. Membrane étanche et respirante. Système chauffant à double fil enchâssé dans un tissage de fibres de Kevlar® et de carbone. Mode \"1-click\" (contrôle des deux gants). Capteur de température (auto-régulation). Indicateur de chauffe. Insert Furygan Science Sensitive pour utiliser ses écrans tactiles. Renfort paume. Homologation CE comme EPI niveau 1.', 0),
(65, 3, 10, 'IT-ASO', 31999, 'none-9595881a5631a3139c23e9227dd14dd6-9595881.jpg', 11, 'it-aso', 'Gants chauffants en cuir IXON IT-ASO. Construction en cuir de chèvre, Neoprène et softshell sur le dos. Insert étanche et respirant. Doublure chaude Primaloft One®. Isolant aluminium. Technologie chauffante intelligente Clim8. Livrés avec 2 batteries et 1 chargeur.', 0),
(66, 3, 8, 'BREVA', 23999, 'none-24de18ed3bb5615ebc61b62d50a3fd80-24de18e.jpg', 11, 'breva', 'Gants moto chauffants homme textile hiver en Softshell. Système chauffant B-Warm avec 4 niveaux. Membrane étanche. Doublure thermique Primaloft. Doublure interne en polyester. Grip renforcé. Manchette longue élastiquée. Poignet élastiqué muni de 2 pattes de serrage velcro. Coque de protection métacarpienne. Homologation CE comme EPI.', 0),
(67, 3, 11, 'HEAT GENESIS', 24990, 'none-3cd5f70f83a60d5384fd02bd4655da95-3cd5f70.jpg', 11, 'heat-genesis', 'Gants moto chauffants en polyamide, élasthanne et néoprène. Doublure thermique hiver \"Dual Lining\". Membrane étanche et respirante. Système chauffant intégré sur le dessus de la main, et sur les 5 doigts. 3 modes de chauffe (jusqu\'à 5) et personnalisables avec l\'application MyFury Connect. Application gratuite disponible sur IOS et Androïd. Bouton \"1click\" (contrôle des 2 gants). Insert Furygan Science Sensitive (écrans tactiles). Homologation CE comme EPI niveau 1.', 0),
(68, 4, 10, 'MIKE C C-SIZING', 19999, 'none-e8874347badb1b5907446ca94cb599bf-e887434.jpg', 12, 'mike-c-c-sizing', 'Jeans en Cordura® Denim alliant praticité et efficacité. Coupe Regular. Jambes préformées. Fermetures par zip et boutons. Élastique en bas des jambes. Matière très respirante. Homologation CE. Protections CE aux genoux et aux hanches.', 0),
(69, 4, 7, 'ARGON', 19995, 'none-c7e49ce0fb0dac0197e1de43ca5e5334-c7e49ce.jpg', 12, 'argon', 'Jeans denim Cordura® stretch, doublure en fibre d’aramide. Coupe slim. Fermeture et bouton et zip. Passants pour ceinture. Empiècements réfléchissants. Protections genoux Nucleon Flex Plus homologuées CE Niveau 1 et protections de hanches Bio Flex Plus homologuées CE Niveau 1.', 0),
(70, 4, 11, 'K11 X KEVLAR STRETCH GHOST', 19990, '6388-1-553777e.jpg', 12, 'k11-x-kevlar-stretch-ghost', 'Jeans moto pour homme. Matière extérieure ultra résistante conçue en partenariat avec Kevlar. Construction incorporant du stretch pour une aisance maximale. Nouvelle génération de protections D3O® offrant souplesse et une discrétion au quotidien. La coupe droite, straight, se veut confortable en toutes circonstances, et convenir à la majorité des morphologies. La coupe est droite sur l’ensemble des jambes sans se resserrer en bas, ce qui facilite le passage de bottes. Homologué CE EPI niveau AAA.', 0),
(71, 4, 7, 'COPPER PRO', 25995, '6388-1-553777e.jpg', 12, 'copper-pro', 'Jeans moto homme, fabriqué en tissu denim technique élastique Cordura® avec HDF (fibre haute densité). Coupe regular avec jambes légèrement préformée. Inserts en aramide (durabilité et résistance). Doublure intérieure au niveau des genoux. Protections ultra-souples Nucelon Flex Plus aux genoux certifiées CE EN1621-1 : 2012 Niveau 1. Protections de hanche Bio-Flex intégrés. Homologation CE Cat.II - prEN17092 Classe A.', 0),
(72, 4, 9, 'DENIM BLAST REGULAR', 20995, 'none-66e8245666529119c9cebea5a023a25c-66e8245.jpg', 12, 'denim-blast-regular', 'Jean en tissu élastique. Coupe regular. 4 poches extérieures. Prédisposé à recevoir les protections de hanches Pro-Shape 2.0 (option). Protections Pro-Shape 2.0 aux genoux, réglables en hauteur et amovible grâce a la fermeture extérieure. Homologation CE.', 0),
(73, 4, 9, 'DENIM STONE SLIM', 20995, 'none-c5f283ee46227967a85f51f9c6fdeff6-c5f283e.jpg', 12, 'denim-stone-slim', 'Jean en tissu élastique. Coupe slim. 4 poches extérieures. Prédisposé à recevoir les protections de hanches Pro-Shape 2.0 (option). Protections Pro-Shape 2.0 aux genoux, réglables en hauteur et amovible grâce a la fermeture extérieure. Homologation CE.', 0),
(74, 4, 9, 'MISANO', 54999, 'none-cfa2493d9ec0176458a48fd48d9880e3-cfa2493.jpg', 13, 'cuir-misano', 'Pantalon cuir. Homologation CE. Construction en cuir D-Skin 2.0 et insert stretch.Doublure Nanofeel® avec traitement aux ions d\'argent. Protections Pro-Shape homologuées CE sur les hanches. Sliders au niveau des genoux.', 0),
(75, 4, 10, 'VORTEX 2 PANT', 37999, '200201008-1027-2e4a4cd.jpg', 13, 'vortex-2-pant', 'Pantalon racing en cuir de vachette. Empiècements en tissu stretch. Doublure amovible en mesh 2D. Empiècements perforés. Zones en cuir flex. Taille élastiquée, fermeture zippée et pattes de serrage. Zip de raccordement au blouson. Coutures sécurisées. Protections CE aux genoux et aux hanches. Sliders aux genoux. Homologation CE.', 0),
(76, 4, 10, 'VORTEX 3 PT', 42999, 'none-e94d56fa082f2e5154ac0f9ede3d795a-e94d56f.jpg', 13, 'cuir-vortex-3-pt', 'Pantalon cuir racing. Matière extérieure en Cuir et Nylon 4-way stretch. Micro-perforations localisées pour une ventilation optimale. Matière intérieure en Soft mesh et Lycra fixe. Ajustements : Soufflet d’aisance zippé aux mollets. Nouveaux ODA en polymère bi-densité aux genoux. Sliders genoux RACE 2.0. Panneaux Nylon 4-way stretch à l’entrejambe et jambes pour l’ajustabilité et le l’aisance des mouvements. Inserts 4-way double couches sans coutures aux chevilles. Renfort en Mesh 3D aux cuisses. Airflow pocket en Mesh 3D des protections genoux et hanches pour une meilleure circulation de l’air entre le corps et la protection. Protections genoux BETAC type B niveau 1 - utilisées en MotoGP. Protection hanches YF C30 type B niveau 2 ventilées. Homologué CE, classe AAA.', 0),
(77, 4, 7, 'MISSILE V3', 44995, '3120522-10-af48aa4.jpg', 13, 'missile-v3', 'Pantalon en cuir de bovin pleine fleur d\'une épaisseur de 1.3mm. Larges panneaux en tissu stretch. Doublure fixe en Mesh. Protections genoux GP-R Lite Race Armor. Protections genoux réglables en hauteur par Velcro. Prédisposé à recevoir des protections de hanche Alpinestars. Livré avec des Sliders de genoux Sport. Fermeture par bouton pression et zip. Pattes d\'ajustement à la taille. Mollets zippés qui facilitent l\'enfilage et la mise en place des bottes. Soufflets d\'aisance. Jambes préformées. Zip de raccord pantalon / blouson. Comfort Fit. Homologation CE EN17092 - AA.', 0),
(78, 4, 10, 'VENDETTA PT EVO', 43999, 'none-26c63d251f54fbb4779c9f3a2692c4e1-26c63d2.jpg', 13, 'vendetta-pt-evo', 'Pantalon en cuir de bovin souple et épais. Panneaux en cuir de bovin micro-perforé pour un flux d\'air optimisé Renforts en cuir et en 3D Air Spacer Mesh pour plus de sécurité et une circulation de l\'air optimisée Cuir Flex au niveau du dos pour plus d\'aisance et de mobilité Inserts Stretch à l\'entrejambe et à l\'arrière des mollets Doublure de confort Mesh pour une circulation de l\'air accrue Protections genoux homologuées CE de niveau 1 Protections hanches homologuées CE de niveau 2 Sliders injectée bi-matière aux genoux issues du Moto-GP Sliders genoux Race 2.0 amovibles, ajustables et remplaçables Protection moussée au niveau du coccyx Homologué CE', 0),
(79, 4, 8, 'Type-R', 30999, 'none-8d58afebd1db113058338e1c745f0e75-8d58afe.jpg', 13, 'type-r', 'Pantalon en cuir de bovin. Empiècements en tissu stretch. Zip de raccordement. Soufflets d\'aisance aux genoux et dans le dos. Longs zips en bas des jambes. Homologation CE. Renforts tibia. Protections CE aux genoux et aux hanches. Sliders aux genoux.', 0),
(80, 4, 9, 'ALPHA PERF', 49995, 'none-df50f2d1810de7f8e737929077b0d575-df50f2d.jpg', 13, 'alpha-perf', 'Pantalon cuir DAINESE Alpha Perf. Construction en de vache pleine fleur D-skin 2.0. Inserts en tissu strech. Système de fixation blouson-pantalon. Microelastic 2.0. Ceinture réglable.Zip au mollet et système Boots-in. Protections genoux et hanches CE.', 0),
(81, 4, 9, 'CARVE MASTER 3 GORE-TEX', 44995, 'none-6831fcfd3e11fb06116e58c30e53ef1c-6831fcf.jpg', 14, 'carve-master-3-gore-tex', 'Pantalon textile toutes saisons Touring/Adventure en issu Mugello. Membrane Gore-Tex® imperméable et respirante. Doublure en tissu Sanitized®. Doublure thermique amovible. Prises d\'air sur les cuisses avec des zips. Tissu 3D-Stone™ résistant à l\'abrasion et aux déchirures. Protections Pro-Armor aux genoux, amovibles et homologuées CE niveau 2 EN 1621-1, réglables en hauteur. Zip de raccordement veste / pantalon. Homologation CE comme EPI.', 0),
(82, 4, 8, 'HURRICANE Gore-Tex®', 39999, 'none-92c59a2ea5167943e8fffc0348425159-92c59a2.jpg', 14, 'hurricane-gore-texr', 'Pantalon moto homme textile toutes saisons en tissu laminé Gore-Tex® et Stretch. Doublure fixe Mesh (ventilation). Doublure Shelltech Classic thermique amovible ouatinée. Système d\'aération ADS (Air Dynamic System) avec zips pour réguler le flux d\'air. Protections genoux et hanches OMEGA homologuées CE niveau 1. Homologation CE comme EPI.', 0),
(83, 4, 1, 'COMBAT TEX', 36999, 'none-bd971e3c814517f0e199479cde462c41-bd971e3.jpg', 14, 'combat-tex', 'Pantalon de moto avec grandes poches latérales, adapté à un usage quotidien, en tissu de protection doux Armalith avec protections rigides sur les genoux et protections souples Pro Shape 2.0 sur les hanches. Homologué CE Pantalon de protection moto certifié prEN 17092 (AAA)', 0),
(84, 4, 9, 'ROAD PRO GORE-TEX', 36995, 'none-29218f7371b87173a9782696b7b024ee-29218f7.jpg', 14, 'road-pro-gore-tex', 'Pantalon textile mi-saison, composition multi-panneaux en polyester. Membrane Gore-Tex® étanche et respirante. Protections amovibles Nucleon Flex Plus homologuées CE aux genoux. Compartiments aux hanches permettant d\'insérer les protections hanches Bioflex, offrant un complément de protection. (en option) Certifié CE.', 0),
(85, 4, 10, 'RAGNAR PT', 35995, 'none-27bb09f17cf3fe11928073e8b54dd2f2-27bb09f.jpg', 14, 'ragnar-pt', 'Pantalon textile Ripstop reconnu pour sa résistance Renforts en polyester 1200D aux genoux Empiècements stretch à l\'entrejambe et sur l\'intérieur du genoux jusqu\'à la cheville Doublure fixe de confort en polyester Membrane étanche et respirante X-Dry amovible par zip Doublure thermique amovible par zip Protections genoux IX-PROFLEX homologuées CE niveau 1 Protections hanches IX-PROFLEX homologuées CE niveau 2 Homologuées CE', 0),
(86, 4, 7, 'MONTEIRA DRYSTAR XF', 34995, 'none-e718eee8855eb4640bcc288ef6cfd8c9-e718eee.jpg', 14, 'monteira-drystar-xf', 'Pantalon toutes saisons en poly-tissu. Membrane Drystar®XF hautement respirable et traitement DWR. Doublure thermique amovible. Panneaux de ventilation. Renfort sur les zones de frottements. Inserts extensibles. Coupe ergonomique. 4 poches extérieures. Empiècements réfléchissants en bas des jambes. Protections Nucleon Flex Pro homologuées CE Niveau 2 aux hanches et aux genoux. Homologation CE Classe AA.', 0),
(87, 5, 9, 'YORK D-WP®', 18995, 'none-9d16c9b4c19d56282cfe0a126f35cfe1-9d16c9b.jpg', 15, 'york-d-wpr', 'Baskets DAINESE York D-WP®. Tige en cuir de vache suédé. Doublure en maille. Intérieur D-WP® étanche. Inserts rigides sur les malléoles. Insert de protection au niveau du sélecteur.', 0),
(88, 5, 7, 'AS-DSL AKIO', 19495, 'none-5a66fde53eb5281d3da1447e429104ad-5a66fde.jpg', 15, 'as-dsl-akio', 'Baskets, zones en cuir nubuck sur la tige. Tige pleine longueur en TPU. Protections contre les chocs avant et arrière pour une stabilité, une protection et une durabilité accrues. Chausson intérieur technique OrthoLite® amovible. Renfort sélecteur de vitesses. Insert interne en EVA entre les matériaux extérieurs et intérieurs. Disque de protection de la cheville en mousse PU à cellules ouvertes. Homologation CE EN13634:2017', 0),
(89, 5, 10, 'Bull Wp', 14995, 'none-344a52dcf53a1f262046bfd189b5f547-344a52d.jpg', 15, 'bull-wp', 'Baskets au look dynamique. Homologation CE. Système de fermeture ATOP. Renfort sélecteur, talon et bout de pied. Semelle Michelin® : adhérence, résistance à l\'abrasion, durabilité, confort. Semelle intérieure double densité.', 0),
(90, 5, 7, 'J-6 WATERPROOF', 17995, 'none-b1a52a02203b1066b39cc41b5b87a944-b1a52a0.jpg', 15, 'j-6-waterproof', 'Baskets combinant du cuir pleine fleur et du daim. Membrane 100% étanche. Languette supérieure et col en cuir. Homologation CE. Protection de la cheville et du talon. Renfort sur le bout du pied. Rembourrage sur le talon. Semelle intermédiaire renforcée.', 0),
(91, 5, 7, 'CHROME', 15995, 'none-0698ea769d07b6d399c2a050357a0308-0698ea7.jpg', 15, 'chrome', 'Baskets en daim. Fermeture élastique à action rapide et lacets. Semelle intérieure Ortholite et semelle extérieure en caoutchouc. Protections double densités aux chevilles. Renfort en TPU aux orteils et aux talons. Homologuées CE.', 0),
(92, 5, 8, 'SKYDECK', 14999, 'none-f032858e72472fcf26d93d8e0886564f-f032858.jpg', 15, 'skydeck', 'Baskets waterproof SKYDECK BERING. Construction en cuir de vachette offrant résistance à l\'abrasion. Membrane étanche. Zip latéral. Doublure en polyester. Homologués CE. Pointe et talon renforcés. Renfort sélecteur. Chaussure anti-écrasement transversal.', 0),
(93, 5, 7, 'SP-2', 25995, 'none-49d4f93821e11ea46269bedaf6a8d2a5-49d4f93.jpg', 15, 'sp-2', 'Chaussures en Softprene et Microfibre. Système de fermeture \"Boa Speed Lace\". Semelle intérieure Ortholite®, respirante. Semelle extérieure sport en caoutchouc. Languette pour faciliter l’enfilage. Perforations stratégiquement positionnées sur la tige pour une bonne circulation de l’air. Protections aux chevilles en TPU. Renfort en TPU aux orteils et aux talons. Empiècements réfléchissants à l’arrière. Homologation CE.', 0),
(94, 5, 9, 'METRACTIVE D-WP®', 19995, 'none-2e73f9473056e1a1f4a134eddbf87905-2e73f94.jpg', 15, 'metractive-d-wpr', 'Baskets en cuir pleine fleur. Intérieure D-WP® waterproof. Doublure en maille. Rabat à pression sur la languette. Fermeture par lacets. Protection de sélecteur de vitesses en PU. Semelle extérieure en caoutchouc Groundtrax®, conçue pour offrir un confort de marche supérieur. Semelle intérieure Ortholite® avec amorti prolongé et niveau de respirabilité élevé. Protections rigides au niveau de la malléole avec D-Foam souple sur le côté interne. Homologation CE.', 0),
(95, 5, 10, 'GREENWICH', 16999, 'none-8f476b144b09126b98bbe98d6392a395-8f476b1.jpg', 16, 'greenwich', 'Bottines en cuir style urbain IXON Greenwich. Homologation CE. Construction en cuir de vachette pleine fleur. Intérieur 100% Mesh polyester hautement respirant. Insert étanche et respirant. Renfort sur le talon, le sélecteur et le coup de pied.', 0),
(96, 5, 10, 'MUD WP', 17995, 'none-0e1f810edc3da096b778a3ba269d4a96-0e1f810.jpg', 16, 'mud-wp', 'Bottines MUD WP IXON. Construction en cuir de vachette pleine fleur offrant résistance à l\'abrasion et aux déchirures. Intérieur en polyester. Bottines étanches et respirantes. Homologuées CE. Protection malléole. Talon renforcé. Renfort sélecteur et coup de pied.', 0),
(97, 5, 9, 'DINAMICA D-WP', 20995, 'none-152f90f0d9d5fa93bfab75bf49864aaa-152f90f.jpg', 16, 'dinamica-d-wp', 'Chaussures homme en polyamide haute ténacité. Membrane intérieure imperméable, D-WP. Contrefort de talon en TPU. Talon renforcé en nylon. Renfort au niveau de la malléole en TPU. Protection de sélecteur en TPU. Inserts réfléchissants. Fermeture par zip à l\'arrière de la demi-botte afin de faciliter l\'enfilage. Inserts TPU à adhérence élevé. Semelle en caoutchouc. Articulations flexibles. Homologation CE - Cat II - EN 13634.', 0),
(98, 5, 9, 'SHELTON D-WP', 17090, 'none-661f4377b638ba7457e19a1c0eedb96e-661f437.jpg', 16, 'shelton-d-wp', 'Bottines. Homologation CE. Construction en cuir de vachette pleine fleur alliant confort et robustesse. Intérieur D-WP étanche. Renforts malléoles. Fermeture à lacets. Semelle en caoutchouc pour une bonne adhérence. Renfort au niveau du sélecteur.', 0),
(99, 5, 7, 'DISTINCT DRYSTAR', 19500, 'distinct-drystar-boots-black.jpg', 16, 'distinct-drystar', 'Bottines ALPINESTARS Distinct Drystar®. Tige principale en cuir pleine fleur. Membrane Drystar® étanche et respirante. Homologuées CE niveau 2. Renfort malléoles en PU. Talons renforcés.', 0),
(100, 5, 10, 'ROGUE STAR', 5040, 'none-7fb75bfeceab9979f17a17a593344d32-7fb75bf.jpg', 16, 'rogue-star', 'Chaussures IXON Rogue Star. Matière cuir de vachette pleine fleur. Languette anatomique profilée. Boucle à l\'arrière pour faciliter l\'enfilage. Semelle de propreté antibactérienne. Insert talon en mousse. Renfort bout de pied et talons.', 0),
(101, 5, 12, 'Zarco Replica', 19999, 'none-0dfa195b17002ef294281cad1c622d61-0dfa195.jpg', 17, 'zarco-replica', 'Bottes racing en microfibre perforée. Soufflet rembourré. Doublure AIR TECH respirante. Système Double Flex Control. Protection du tibia en PU avec prises d\'air. Protection du sélecteur. Sliders en magnésium. Boucle en aluminium, micro-réglable et interchangeable.', 0),
(102, 6, 10, 'Ix-Airbag U03', 39999, '01-gonfle-0e46a76.jpg', 19, 'ix-airbag-u03', 'Gilet Airbag électronique universel et discret qui se porte sous tous les blousons et les vestes. Intérieur respirant en tissu mesh 3D. Matière stretch sur les côtés. Homologation CE. Classé SRA 5 étoiles. Dorsale CE niveau 1. Protège le thorax, l\'abdomen, la colonne vertébrale, les cervicales et les clavicules. Abonnement à partir 12 euros/mois. *** Prix TTC sans l\'abonnement In&Motion. In&box non fourni, à commander chez In&motion au moment de l’adhésion, formule d\'adhésion obligatoire pour le fonctionnement de l\'airbag ***.', 0),
(103, 5, 9, 'AXIAL D1', 59995, 'none-08feca5cf846ba266c085a7ac6f5dbe7-08feca5.jpg', 17, 'axial-d1', 'Bottes. Homologation CE. Construction en tissu D-Stone™ et cuir de vachette. Inserts en stretch. Soufflet d\'aisance sur le coup de pied. Slider en magnésium amovible. Système D-Axial en fibre de carbone et d\'aramide. Renfort au niveau des malléoles. Renfort au niveau du sélecteur.', 1),
(104, 5, 7, 'SUPERTECH R', 52995, '2220021-1236-4b0661a.jpg', 17, 'supertech-r', 'Bottes racing en cuir et tissu mesh. Zone avant flexible redessinée fabriquée en TPU sur-injecté sur un tissu Mesh. Protège-tibia, sliders et attelle interne biomécanique. Microfibre élastique et flexible en accordéon sur le tendon d\'Achille. Guêtre supérieure en cuir synthétique de qualité supérieure renforcé PU. Homologation CE', 0),
(105, 5, 7, 'SUPERTECH R - BLANC', 52995, 'none-8b2afff80d68d5a7bc38615f4b7911cd-8b2afff.jpg', 17, 'supertech-r-blanc', 'Bottes moto en cuir et tissu mesh Noir blanc et rouge fluo. Renforts TPU souples et extensibles. Protège-tibia, sliders et attelle interne biomécanique. Homologuées CE', 0),
(106, 5, 7, 'enduro TECH 7 ENDURO DRYSTAR', 47995, 'none-0c965c6a6eb609e5db26858e63e4cf7b-0c965c6.jpg', 17, 'enduro-tech-7-enduro-drystar', 'Bottes moto enduro homme en cuir pleine fleur et revêtement PU. Membrane Drystar étanche et respirante. Fermeture par 4 crochets en aluminium à réglage mémorisé. Garniture en caoutchouc TPU. Semelle intérieure anatomique amovible. Semelle extérieure en caoutchouc double densité. Semelle et repose-pied remplaçables. Protection des orteils et des chevilles en TPU. Plaque protège-tibia en TPU. Plaque de protection du mollet anatomique. Protection de la malléole. Renfort au niveau du sélecteur. Homologation CE.', 0);
INSERT INTO `product` (`id`, `category_vo_id`, `brand_vo_id`, `designation`, `prix_ttc`, `photo_url`, `sub_category_vo_id`, `slug`, `details`, `is_best`) VALUES
(107, 5, 9, 'TORQUE 3 OUT', 39995, 'none-8d115cf3320d94bd79533ea338d87162-8d115cf.jpg', 17, 'torque-3-out', 'Bottes racing, construction de la tige en microfibre et tissu D-Stone. Fermeture éclair à l\'arrière. Système de laçage rapide. Soufflets d\'aisance pour un maximum de flexibilité. Système de ventilation optimisant la circulation du flux d\'air pour rester au frais et au sec. Sliders amovible en magnésium.Système D-Axial en TPU. Tibias, malléoles et sélécteur renforcée. Homologation CE.', 0),
(108, 5, 12, 'RT-RACE PRO AIR', 39999, 'none-0a502eb9fe119564dd904e32d0aaaba1-0a502eb.jpg', 17, 'rt-race-pro-air', 'Bottes en microfibre perforée, résistant à l’abrasion et ventilé. Doublure en Mesh respirant Air-Tech. Zone flex à l’arrière et rembourrée. Fermeture latérale externe avec zip, patte de serrage Velcro®, boucle en aluminium micro réglable et laçage. Semelle extérieure mélange Michelin® Burnout en caoutchouc. Semelle intérieure OrthoLite® offre un amorti et une bonne respirabilité. Protège sélecteur en TPU. Système anti torsion à la cheville. Sliders au talon et à la pointe du pied en magnésium interchangeable. Protection au tibia en PU. Homologation CE.', 0),
(109, 5, 10, 'KASSIUS', 19999, 'none-12fd1a3ea42ca2a48d22b1808d26df2a-12fd1a3.jpg', 17, 'kassius', 'Demi-bottes en cuir synthétique reconnu pour sa souplesse et sa résistance Empiècements Polyester 60d reconnu, grâce à son tissage, pour sa résistance Doublure de confort 100% Mesh pour une circulation de l\'air optimisée Membrane étanche et respirante Renforts malléole homologuées CE IPA Pointe renforcée Talon renforcé Renfort au niveau du sélecteur Tige haute Système d’ouverture/fermeture par crémaillère ATOP avec câble métal Zip latéral avec rabat afin de faciliter l\'enfilage Patte de serrage Velcro à la cheville Languette anatomique en Néoprène pour plus de souplesse Rigidité transversale afin d\'éviter l\'écrasement latéral Logos et empiècements réfléchissants Semelle en caoutchouc Homologuées CE', 0),
(110, 6, 11, 'D3O FULL BACK FURY', 3990, 'none-a4e35e9aa06da002473f07a478aa5a9a-a4e35e9.jpg', 18, 'd3o-full-back-fury', 'Dorsale 100% en POLYURETHANE D3O : matière souple et confortable, se durcissant en cas de choc. Homologation CE.', 0),
(111, 6, 7, 'NUCLEON KR-CELLi', 5495, 'none-fd05a43d62933cf96cc14a043131adcd-fd05a43.jpg', 18, 'nucleon-kr-celli', 'Dorsale ultralégère et performante en polymère et en tissu mesh ventilé. Structure unique conçue pour absorber l\'énergie et offrant une parfaite respirabilité. Plaque de protection ergonomique suivant les contours naturels du corps. Homologation CE selon la norme EN 1621-2:2014 niveau 1.', 0),
(112, 6, 9, 'PRO-ARMOR BACK SHORT', 15995, 'none-4e2eb09d7c0d16654e9ba1f71b81b7cd-4e2eb09.jpg', 18, 'pro-armor-back-short', 'Dorsale anatomique, construction thermoplastique. Structure perforée. Ceinture lombaire amovible et ajustable. Bretelles amovibles. Dorsale homologuée CE EN1621-2, niveau 2.', 0),
(113, 6, 9, 'MANIS D1 G2', 7595, 'none-dcaa527d7836f3c4b98a45b683c1fd9c-dcaa527.jpg', 18, 'manis-d1-g2', 'Protection dorsale. Plaques extérieures articulées avec contrôle de la mobilité, en polypropylène avec structure perforée. Intérieur perforé avec Crash Absorb. Protection rembourrée à l\'intérieur pour plus de confort. Étirement longitudinal. Flexion longitudinale. Torsion. Inclinaison latérale contrôlée avec tenseurs spéciales. Plaques extérieures perforées. Hauteur taille-épaule 46-51 cm. Homologation EN1621.2-2003 Niveau 2', 0),
(114, 6, 7, 'Nucleon Kr-3', 22495, 'none-ce4f4cffd70e9da1c726dae18b6ab786-ce4f4cf.jpg', 18, 'nucleon-kr-3', 'Dorsale en tissu élastique et ventilé. Construction robuste en polymère offrant flexibilité et légèreté. Renfort en mousse au niveau de la colonne vertébrale. Bretelles réglables et détachables. Rembourrage au niveau des épaules. Homologation selon la norme EN 1621-2:2014, niveau 2.', 0),
(115, 6, 10, 'Warden Comp', 7499, '604304007-1001-7ecdac1.jpg', 18, 'warden-comp', 'Dorsale souple et ergonomique qui s\'adaptera à votre colonne. Homologation CE, niveau 2. Mousse en polyuréthane. Perforations multiples offrant une ventilation optimale. Fournie avec ceinture et bretelles.', 0),
(116, 6, 8, 'C-Protect Air Sra 2*', 39990, '01-f9d6e7d.jpg', 18, 'c-protect-air-sra-2', 'Airbag en Softshell ajustable aux différentes morphologies. Soufflet d\'aisance. Une fois gonflé, l\'airbag protège le thorax, l\'abdomen et le dos allant des cervicales au coccyx. Homologation CE. Classé SRA 2 étoiles. Dorsale de niveau 1 intégrée. Matière réfléchissante.', 0),
(117, 6, 9, 'SMART JACKET', 69995, '1d20039-001-7d0de4a.jpg', 19, 'smart-jacket', 'Airbag DAINESE Smart Jacket. Technologie airbag D-air® utilisée en MotoGP™. Se porte sous n\'importe quel blouson. Équivaut à 7 dorsales. Sans câbles ni connexion avec la moto ou le scooter. + de 26h d\'autonomie. Réglementation DOLOMITICERT (2016/425) - Airbag arrière niveau 1 (EN 1621-4 CB L1) Règlement DOLOMITICERT (2016/425) - Airbag thoracique niveau 2 (EN 1621-4 L2)', 0),
(118, 6, 7, 'TECH-AIR 3 SYSTEM', 52995, 'none-2b6dbdbe835615c7d26c0f782c095cc9-2b6dbdb.jpg', 19, 'tech-air-3-system', 'Gilet Airbag, entièrement autonome, ne nécessite aucune connexion ou capteur externe sur la moto pour que le système fonctionne. Le système d\'airbag Tech-Air® 3 s\'active automatiquement via la fermeture à glissière magnétique. La conception compacte signifie que le système peut être rangé dans un sac à dos ou sous la selle lorsqu\'il n\'est pas utilisé. Un affichage LED sur la poitrine avant indique en permanence l\'état de fonctionnement de l\'airbag. La connectivité bluetooth Low Energy (BLE 5.0) avec l\'application Tech-Air® affiche l\'état du système, l\'état de la batterie et les données de conduite.', 0),
(119, 6, 9, 'Blouson Airbag SMART JACKET LS SPORT', 84995, 'none-822ede73887b1888efb9fb52cef95e74-822ede7.jpg', 19, 'blouson-airbag-smart-jacket-ls-sport', 'Blouson en tissu Mugello. Dotée du systéme airbag D-air®. Ceinture lombaire réglable. Zips d’aisances aux poignets. Structure ventilée. 2 poches extérieures. Empiècements réfléchissants. Protections homologuées CE Niveau 2, Pro Armor aux coudes, à la poitrine et aux épaules. Protections homologués CE Niveau 1 pour la dorsale. Homologation CE.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `product_advantage`
--

DROP TABLE IF EXISTS `product_advantage`;
CREATE TABLE IF NOT EXISTS `product_advantage` (
  `product_id` int NOT NULL,
  `advantage_id` int NOT NULL,
  PRIMARY KEY (`product_id`,`advantage_id`),
  KEY `IDX_472E972C4584665A` (`product_id`),
  KEY `IDX_472E972C3864498A` (`advantage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_vo_id` int NOT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BCE3F798A2C6564C` (`category_vo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `category_vo_id`, `designation`, `description`, `slug`) VALUES
(1, 1, 'Casque Intégrale', 'Le casque intégral est le casque le plus sécurisant de tous. C\'est également le plus connu et le plus vendu.', 'casque-integrale'),
(2, 1, 'Casque Modulable', 'Le casque modulable est le casque polyvalent par excellence. En ville, relevez la mentonnière. Vous prenez l\'autoroute ? Baissez la mentonnière! Si vous hésitez, c\'est l\'entre deux idéal.', 'casque-modulable'),
(3, 1, 'Casque Jet', 'Le casque jet est le casque urbain par excellence. Sa faible insonorisation vous permettra d’être attentif aux bruits environnementaux.', 'casque-jet'),
(4, 2, 'Combinaison Cuir', 'Le casque jet est le casque urbain par excellence. Sa faible insonorisation vous permettra d’être attentif aux Pour les amateurs de piste, la combinaison de moto est un équipement indispensable.environnementaux.', 'combinaison-cuir'),
(5, 2, 'Blouson Cuir', 'Bien plus qu’un vêtement, le blouson en cuir pour homme est un indispensable pour le motard. Cette veste spécifique, à l’allure parfois vintage, est un produit qui ne ressemble à aucun autre et dont il apparaît dun équipement indispensable.', 'blouson-cuir'),
(6, 2, 'Blouson Textile', 'Accessoire indispensable de tout motard qui se respecte, le blouson de moto offre différents avantages. Outre l’avantage de protéger des coups de soleil, du vent, de la pluie et autres intempéries, ils améliorent aussi l’esthétique grâce à un design très', 'blouson-textile'),
(7, 3, 'Gants été', 'Pour la saison estivale, on a souvent du mal à supporter ses gants moto! Le soleil tape, la chaleur du goudron remonte, on a tendance à transpirer, les gants collent! Pourtant, ils sont obligatoires!. Alors pourquoi ne pas opter pour des gants été ?', 'gants-ete'),
(9, 3, 'Gants mi-saison', 'Les gants idéals pour la mi-saison !', 'gants-mi-saison'),
(10, 3, 'Gants hiver', 'Les gants hiver sont adaptés à la saison hivernale, pour vous garder au chaud tout au long de votre trajet. Ils vous assurent une excellente protection contre le froid.', 'gants-hiver'),
(11, 3, 'Gants chauffants', 'La paire de gant idéals pour les personnes frileuses mais qui veulent rouler l\'hiver !', 'gants-chauffants'),
(12, 4, 'Jeans', 'Le jeans moto : le confort et le style par excellence. Digne d’un jeans issue du milieu du prêt à porter, les jeans moto sont renforcés et construit de manière à résister à l’abrasion', 'jeans'),
(13, 4, 'Pantalon Cuir', 'Le pantalon cuir : grâce à sa construction en cuir, il est le plus résistant de tous. Le cuir, matériau noble et vivant, lui confère de très bonnes caractéristiques techniques et de résistance à l’abrasion.', 'pantalon-cuir'),
(14, 4, 'Pantalon Textile', 'Le pantalon textile : il est le préféré des amateurs de touring et d’aventures. Il peut être équipé d’une doublure thermique, d’une doublure respirante, d’une membrane étanche…', 'pantalon-textile'),
(15, 5, 'Baskets', 'Les baskets moto sont un classique! Bien plus que de simples chaussures, elles protègent vos pieds des aléas météorologiques et des impacts.', 'baskets'),
(16, 5, 'Chaussures', 'Les chaussures moto sont principalement sont plus hautes qu’une basket mais plus basses qu’une botte. On les appelle bottines ou demi-bottes.', 'chaussures'),
(17, 5, 'Bottes', 'Les bottes moto sont les chaussures protégeant le mieux le pilote. Grâce à leur tige haute, elle protège également le tibia en plus des malléoles, du sélecteur, du talon et de la pointe du pied.', 'bottes'),
(18, 6, 'Dorsales', 'Les motards deviennent de plus en plus sensibles à leur sécurité. Pourtant, rares sont encore ceux qui s\'équipent d\'une protection dorsale. Pour un budget limité, cet accessoire de sécurité peut sérieusement limiter la casse en cas de chute, voire tout si', 'dorsales'),
(19, 6, 'Airbag', 'Loin d’être un gadget, l\'airbag moto s’est largement démocratisé ces dernières années. Fruit de longues années d’études, cet équipement de protection spécialement conçu pour la moto est un accessoire indispensable pour rouler en deux-roues.', 'airbag');

-- --------------------------------------------------------

--
-- Structure de la table `transporter`
--

DROP TABLE IF EXISTS `transporter`;
CREATE TABLE IF NOT EXISTS `transporter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transporter`
--

INSERT INTO `transporter` (`id`, `name`, `description`, `price`) VALUES
(1, 'Collisimo', 'Profitez d\'une livraison prémium avec un colis chez vous dans les 72 prochaines heures !', 1000),
(2, 'Chronopost', 'Profitez du seul transporteur au monde qui est capable de ne jamais réussir à vous livrer vos colis en temps et en heure !', 1500),
(3, 'La Poste', 'Par ce que voila quoi.', 499);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fidelity_card_vo_id` int DEFAULT NULL,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649EC8630E3` (`fidelity_card_vo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `fidelity_card_vo_id`, `email`, `roles`, `password`, `last_name`, `first_name`, `address`, `zip_code`, `city`, `tel_number`, `birth_date`) VALUES
(1, NULL, 'fbesnard.ledantec@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$vTiLceOER1nA4H7spaDZ3Ozm.fj8Yv8ZXsSY44C8jwaenMt0cPDVG', 'BESNARD', 'François', '23 Rue joseph lesbleiz', '22300', 'Ploubezre', '0665198741', '1996-12-09'),
(2, NULL, 'julesthivend@gmail.com', '[]', '$2y$13$H5MXNKf2ehmFilqKL.CwveT81MKpRNEVjkAk6MaVJrpa5QOpPgqa2', 'Thivend', 'Jules', 'COUCOU', '22300', 'COUCOU', '0123456789', '2001-01-01');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FK_D4E6F81A837E25D` FOREIGN KEY (`user_vo_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `advantage`
--
ALTER TABLE `advantage`
  ADD CONSTRAINT `FK_298E21A1FF70C14C` FOREIGN KEY (`advantage_type_vo_id`) REFERENCES `advantage_type` (`id`);

--
-- Contraintes pour la table `advantage_fidelity_card`
--
ALTER TABLE `advantage_fidelity_card`
  ADD CONSTRAINT `FK_6937E86C3864498A` FOREIGN KEY (`advantage_id`) REFERENCES `advantage` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6937E86CCA4FE9A9` FOREIGN KEY (`fidelity_card_id`) REFERENCES `fidelity_card` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `category_advantage`
--
ALTER TABLE `category_advantage`
  ADD CONSTRAINT `FK_EEEEF39112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EEEEF3913864498A` FOREIGN KEY (`advantage_id`) REFERENCES `advantage` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A837E25D` FOREIGN KEY (`user_vo_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_845CA2C1C96B6DF8` FOREIGN KEY (`order_vo_id`) REFERENCES `order` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD110CD012` FOREIGN KEY (`brand_vo_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `FK_D34A04ADA2C6564C` FOREIGN KEY (`category_vo_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_D34A04ADC3620458` FOREIGN KEY (`sub_category_vo_id`) REFERENCES `sub_category` (`id`);

--
-- Contraintes pour la table `product_advantage`
--
ALTER TABLE `product_advantage`
  ADD CONSTRAINT `FK_472E972C3864498A` FOREIGN KEY (`advantage_id`) REFERENCES `advantage` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_472E972C4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `FK_BCE3F798A2C6564C` FOREIGN KEY (`category_vo_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649EC8630E3` FOREIGN KEY (`fidelity_card_vo_id`) REFERENCES `fidelity_card` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
