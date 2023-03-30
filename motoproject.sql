-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 30 mars 2023 à 10:15
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(11, 'Furygan', 'furygan');

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
(1, 'Casque', 'Le casque moto est incontestablement l’équipement le plus important. Chez Moto-Axxe, nous savons que chaque motard à des besoins spécifiques, c’est pour cela que nous vous proposons une large gamme de casques. Vous recherchez un casque pour vous accompagn', 'casque'),
(2, 'Veste', 'Vous êtes à la recherche d’un blouson, d’une veste ou d’une combinaison ? Du blouson cuir au blouson textile en passant par la veste et la combinaison, chez Moto-Axxe nous avons ce que vous recherchez ! Que ce soit pour une utilisation touring, route, urb', 'veste'),
(3, 'Gants', 'Les gants moto sont le seul équipement obligatoire en plus du casque. Lors d\'un impact, ce sont probablement vos mains qui seront touchées en premier alors mieux vaut bien choisir vos gants! Moto-Axxe propose une large gamme pour que vous trouviez les gan', 'gants'),
(4, 'Pantalon', 'Le pantalon moto est souvent le dernier équipement dans lequel nous pensons à investir. Pourtant, lors d’une glissade, tout le côté latéral est touché. Alors il est important d’opter pour un pantalon hautement résistant à l’abrasion et aux déchirures. 3 t', 'pantalon'),
(5, 'Chaussures', 'La vente de chaussures moto progresse en France. Et ce n\'est pas vraiment surprenant. Aujourd’hui, les codes esthétiques du secteur de la moto se rapprochent de plus en plus de ceux du prêt à porter. Il en devient même difficile de faire la différence ent', 'chaussures'),
(6, 'Protections', 'Compétiteurs, pilotes sur piste, en position d’attaque sur votre moto vous aurez envie de prendre le point de corde en appui sur les genoux avec les protections sliders, d’enrhumer votre adversaire, mais attention à la gamelle, à la sortie de piste où un', 'protections');

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
-- Structure de la table `command`
--

DROP TABLE IF EXISTS `command`;
CREATE TABLE IF NOT EXISTS `command` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_vo_id` int NOT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_ht` double NOT NULL,
  `command_date` datetime NOT NULL,
  `command_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8ECAEAD4A837E25D` (`user_vo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `command_product`
--

DROP TABLE IF EXISTS `command_product`;
CREATE TABLE IF NOT EXISTS `command_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `command_vo_id` int NOT NULL,
  `product_vo_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3C20574ED95D4C36` (`command_vo_id`),
  KEY `IDX_3C20574EEBA96259` (`product_vo_id`)
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
('DoctrineMigrations\\Version20230329105347', '2023-03-29 10:54:05', 46);

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
  `details` varchar(800) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04ADA2C6564C` (`category_vo_id`),
  KEY `IDX_D34A04AD110CD012` (`brand_vo_id`),
  KEY `IDX_D34A04ADC3620458` (`sub_category_vo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `category_vo_id`, `brand_vo_id`, `designation`, `prix_ttc`, `photo_url`, `sub_category_vo_id`, `slug`, `details`) VALUES
(1, 1, 2, 'EXO-390 CHICA II', 10990, 'none_dca7352bb0ca4db74bf1b469161d65eb_dca7352.jpg', 1, 'exo-390-chica-ii', 'Casque intégral, coque en polycarbonate. Écran prédisposé Pinlock MAXVISION®. Intérieur KwikWick2 anti-transpirant, hypoallergénique, démontable et lavable. Ventilations à l\'avant et à l\'arrière. Fermeture par boucle micrométrique. Homologation ECE 22.05.'),
(2, 1, 2, 'EXO-R1 AIR Fabio Monster Replica', 52990, 'fabior1air_10d246d.jpg', 1, 'exo-r1-air-fabio-monster-replica', 'Casque intégral en fibres multi-composites. Réplique du casque de Fabio Quartararo. Structure en Ultra TCT®. Intérieur en EPS. Fermeture de la jugulaire par boucle Double-D en titane. Livré avec un écran incolore de série avec support Tear Off, avec un écran fumé Maxvision avec support Tear Off, et avec un film Pinlock® anti-buée. Homologation ECE 22.05'),
(3, 1, 3, 'SKWAL 2 NOXXYS', 29999, 'none_088f5afb850b47e1deca5b01ab56ce12_088f5af.jpg', 1, 'skwal-2-noxxys', 'Casque intégral SHARK Skwal 2.Coque en résine thermoplastique injectée. Lentille antibuée Pinlock MaxVision® incluse. Écran pare-soleil labéllisé UV380 et traité anti-rayures. LED intégrées à batterie rechargeable. Fermeture par boucle micrométrique'),
(4, 1, 3, 'RIDILL NELUM', 19999, 'none_f2c721b853d3be8937e2421b7565dd30_f2c721b.jpg', 1, 'ridill-nelum', 'Casque intégral. Coque en résine thermoplastique injectée. Écran solaire interne. Écran anti-rayures et prédisposé lentille antibuée Pinlock. Intérieur démontable et lavable. Ventilations optimisées par simulation numérique. Fermeture par boucle micrométrique.'),
(5, 1, 4, 'FF353 RAPID HAPPY DREAMS', 10999, 'none_048c1d941bda3fec3be707aeed2a2529_048c1d9.jpg', 1, 'ff353-rapid-happy-dreams', 'Casque intégral. Coque en polycarbonate HPTT. 2 tailles de calotte. Écran traité anti-rayures et anti-UV. Prédisposé Pinlock. Intérieur respirant, démontable et lavable. Tissu hypoallergénique. Ventilations supérieures et mentonnières. Extracteur d\'air à l\'arrière. Boucle micrométrique. Certifié ECE 22.05 & DOT'),
(6, 1, 2, 'EXO-1400 CARBON AIR Legione', 43950, 'none_601d10e610f1a245b3daaceec2b7c26c_601d10e.jpg', 1, 'exo-1400-carbon-air-legione', 'Casque intégral en fibres de carbone. Structure en Ultra TCT®. Fermeture de la jugulaire par boucle Double-D en titane. Changement d\'écran en 10 secondes. Cache nez et cache menton amovibles. Homologation ECE 22.05'),
(7, 1, 2, 'EXO-R1 AIR VICTORY', 39990, 'none_8c74803e86a6bfa95ac3fd0c01db6ff8_8c74803.jpg', 1, 'exo-r1-air-victory', 'Casque intégral en fibres multi-composites. Structure en Ultra TCT®. Fermeture de la jugulaire par boucle Double-D en titane.'),
(8, 1, 1, 'NEOTEC II MM93 COLLECTION 2-WAY TC-5', 75900, 'none_b91aa81e75d20c23c4795899e897dcaf_b91aa81.jpg', 2, 'neotec-ii-mm93-collection-2-way-tc-5', 'Casque modulable. Coque en fibre AIM: superposition de couches de « fibre organique » et fibre multi-composite. 3 tailles de calotte. Écran solaire interne. Intérieur démontable et lavable. Livré avec une lentille antibuée Pinlock. Large ventilation supérieure et extracteur d\'air à l\'arrière. Double spoiler à l\'arrière. Boucle micrométrique. Double homologation: jet et intégral.'),
(9, 1, 1, 'NEOTEC II WINSOME TC-1', 72900, 'none_35833d323270ff34b0e5f3c1cbf87aca_35833d3.jpg', 2, 'neotec-ii-winsome-tc-1', 'Casque modulable. Coque en fibre AIM: superposition de couches de « fibre organique » et fibre multi-composite. 3 tailles de calotte. Écran solaire interne. Intérieur démontable et lavable. Livré avec une lentille antibuée Pinlock. Large ventilation supérieure et extracteur d\'air à l\'arrière. Double spoiler à l\'arrière. Boucle micrométrique. Double homologation: jet et intégral.'),
(10, 1, 1, 'NEOTEC II JAUNT TC-1', 72900, 'none_f4b50418dac26aa1c591f1547d4582c2_f4b5041.jpg', 2, 'neotec-ii-jaunt-tc-1', 'Casque modulable. Coque en fibre AIM: superposition de couches de « fibre organique » et fibre multi-composite. 3 tailles de calotte. Écran solaire interne. Intérieur démontable et lavable. Livré avec une lentille antibuée Pinlock. Large ventilation supérieure et extracteur d\'air à l\'arrière. Double spoiler à l\'arrière. Boucle micrométrique. Double homologation: jet et intégral.'),
(11, 1, 2, 'EXO-TECH EVO CARBON GENUS', 49900, 'none_21644826ccc6597cc53a7e50cb729bf6_2164482.jpg', 2, 'exo-tech-evo-carbon-genus', 'Casque modulable en fibres de carbone. 2 tailles de calotte. Livré avec un écran incolore. Lentille Pinlock MaxVision incluse. Écran interne solaire rétractable. Déflecteur de souffle. 3 aérations réglables. Ouverture de la mentonnière à 180°. Fermeture par boucle micrométrique. Double homologation ECE R22.06 P/J : intégral et jet.'),
(12, 1, 4, 'FF901 ADVANT X CARBON FUTURE', 49900, 'none_153df85c076ad489cbcaa2513377f8d2_153df85.jpg', 2, 'ff901-advant-x-carbon-future', 'Casque modulable. Coque en carbone, mentonnière en carbone. Fermeture de la jugulaire par boucle métallique micrométrique. Système de déclenchement d\'urgence. Sangle de menton renforcée. Patch de sécurité réfléchissant. EPS multi-densité. Tirette magnétique intelligente. Ventilation du menton à couverture métallique. Ventilation supérieure en métal. Orifices d\'évacuation ouverts et fermés. Tissu X-Static© Silver Liner. Doublure extra-confortable, amovible et lavable, respirante, hypoallergénique. Mousse découpée au laser. Système de double visière. Système d\'attache rapide. Écran résistant aux rayures et aux UV. Prêt pour lentille Max Vision Pinlock (inclus). Homologation 22.06'),
(13, 1, 3, 'EVO GT SEAN', 47900, 'none_9fcd04dfd7dcf9f0640355689f4e7923_9fcd04d.jpg', 2, 'evo-gt-sean', 'Casque moto modulable. Coque en résine thermoplastique injectée. 2 tailles de calotte. Boucle Micrométrique. Ecran incolore VZ 150 Max Vision de classe optique 1, assurant une qualité de vision incomparable, traité anti-rayure et antibuée. Auto-down qui permet la remontée automatique de l’écran lors de la manipulation de la mentonnière. ±1650g. Homologation ECE 22.05 \"P/J\"'),
(14, 1, 2, 'COVERT-X WALL', 29900, 'none_e4a7634ff23e76e947b93c8091384230_e4a7634.jpg', 3, 'covert-x-wall', 'Casque jet SCORPION Covert-X. Coque en fibres composites ultra légères. 2 tailles de calottes pour un ajustement morphologique optimal. Mousses de joues Kwikwick2® : très efficaces, hypoallergéniques, amovibles, lavables en machine, très douces et agréable au toucher.'),
(15, 1, 1, 'J-CRUISE 2 AGLERO NOIR ROUGE', 59900, 'none_0c458f7cfdff9b316ea4fb2ce91ffb51_0c458f7.jpg', 3, 'j-cruise-2-aglero-noir-rouge', 'Casque jet SHOEI J-Cruise 2. Coque en AIM: fibre de verre organique et fibres multi-composites. 4 tailles de calotte. Écran CJ-2 prédisposé à recevoir une lentille antibuée Pinlock®. Écran solaire interne. Fermeture par boucle micrométrique.'),
(16, 1, 1, 'J-CRUISE 2 AGLERO NOIR JAUNE', 59900, 'none_a8ef7612f87258116e689f7002e7cb94_a8ef761.jpg', 3, 'j-cruise-2-aglero-noir-jaune', 'Casque jet SHOEI J-Cruise 2. Coque en AIM: fibre de verre organique et fibres multi-composites. 4 tailles de calotte. Écran CJ-2 prédisposé à recevoir une lentille antibuée Pinlock®. Écran solaire interne. Fermeture par boucle micrométrique.'),
(17, 1, 5, 'FREEWAY CLASSIC SKULL', 39900, 'none_15fc49ca3d1d28960b0b929c24f1a363_15fc49c.jpg', 3, 'freeway-classic-skull', 'Coque en fibre. Intérieur unique en similicuir souple et doux. Calotin EPS multi densité. Oreillettes remplaçables et adaptables. Bande d\'attache pour sangle de lunettes. Boucle double D.'),
(18, 1, 6, 'K-5 JET ROSSI MISANO 2015', 57900, 'none_4709a712cb326e890596e8397880b66d_4709a71.jpg', 3, 'k-5-jet-rossi-misano-2015', 'Coque en fibre composite CAAF. 2 tailles de calotte. Écran pare-soleil intégré. Écran prédisposé PINLOCK®. Intérieur en tissu 3D Dry-Comfort avec traitement antibactérien entièrement amovible et lavable. Système de ventilation IVS. Boucle micrométrique.'),
(20, 2, 10, 'JACKAL', 47900, 'none-673e57ded5fb85345b60278b1cfd0c89-673e57d-1680106285.jpg', 4, 'jackal', 'Combinaison en cuir de vachette épais et souple reconnu pour ses fortes capacités de résistance à l\'abrasion. Cuir flex sur les côtés, l\'arrière des manches et le bas du dos pour plus d\'aisance Inserts Stretch à l\'intérieur des manches, de l\'entrejambe et à l\'arrière du mollet pour plus de mobilité Doublure de confort Mesh amovible pour une circulation de l\'air accrue Protections coudes homologuées CE niveau 1 Protections épaules homologuées CE niveau 1 Protections genoux homologuées CE de niveau 1 Protections hanches homologuées CE de niveau 2 Emplacements pour Sliders coudes Sliders genoux Sport 2 amovibles, ajustables et remplaçables Rubber profilés aux épaules et genoux. Homologuée CE'),
(21, 2, 7, 'ATEM V4', 140000, 'none_4ea141f87bfa8e64a12c49a390b6cfac_4ea141f.jpg', 4, 'atem-v4', 'Combinaison cuir ALPINESTARS Atem V4. Construction en cuir de bovin et tissu stretch hautement résistant. Protections GP-R Alpinestars sur les épaules, les coudes et les genoux. Protections Nucleon Flex Racig sur les hanches. Sliders GP amovibles. Sliders coudes anatomiques.'),
(22, 2, 7, 'ATEM V4 2P', 120099, 'none_9bdde9c7f934b060d551aaf0761dc19c_9bdde9c.jpg', 4, 'atem-v4-2p', 'Combinaison cuir 2 pièces ALPINESTARS ATEM V4. Construction en cuir de vachette. Multiples soufflets d\'aisance. Protections GP-R Armor sur les épaules, les coudes et les genoux. Protections Nucléon Flex sur les hanches. Inserts en stretch polyamide HSRF.'),
(23, 2, 10, 'VORTEX 3', 89999, 'none_669352640d0fe7662a0a871a28a79505_6693526.jpg', 4, 'vortex-3', 'Combinaison en cuir et Nylon 4-way stretch doublé Lycra. Matière intérieure en soft mesh fixe et gilet Soft mesh amovible. Protections épaules, coudes, genoux BETAC type B niveau 1, utilisées en MotoGP. Protections Hanches YF C30 type B niveau 2 ventilées. Protection d’assemblage avant-bras et protection du zip poignet en matériaux polymère à haute résistance à l’abrasion. Renfort Mesh 3D avec contrefort 600D aux cuisses et au dos. Double couche de cuir à l’assise. Renfort cuir extérieur, intérieur cuisses. Protection moussée coccyx. Nouveaux ODA en polymère bi-densité aux épaules et genoux. Nouveaux sliders coudes ELBOW 2.0 amovibles et remplaçables, dérivés du MotoGP. Sliders genoux RACE 2.0 amovibles, remplaçables et ajustables en position, utilisés en MotoGP. Homologuée CE, classe AAA,'),
(24, 2, 9, 'TOSA 1 PCS PERF', 105095, 'none_21572a741a71c5bb8fb41156649c6239_21572a7.jpg', 4, 'tosa-1-pcs-perf', 'Combinaison de moto une pièce en cuir Tutu perforé et tissu bi-élastique. Doublure amovible en mesh et 3D Bubble. Perforation localisée pour une bonne ventilation. Zips d\'enfilage aux mollets. Bosse aérodynamique avec kit waterbag prêt à l\'emploi. Col élastique. Plaques remplaçables en aluminium sur les épaules. Protections en composites homologuées CE aux épaules, aux coudes et aux genoux. Protections Pro-Shape 2.0® homologuées CE aux hanches. Homologation CE.'),
(25, 2, 9, 'LAGUNA SECA 5 PERF', 139995, 'none_79c2c448cfa782e0b860d8ab2b126beb_79c2c44.jpg', 4, 'laguna-seca-5-perf', 'Combinaison une pièce en cuir de vache pleine fleur perforé. Doublure amovible en 3D-Bubble et mesh respirant. Housse de combinaison fournie. 1 poche intérieure. Bosse aérodynamique prévue pour accueillir la poche à eau du kit Waterbag pret à l\'emploi. Fermeture zippée avec agrafe en cuir sur le devant. Col confort. Zips d\'enfilage sur les mollets. Plaques en aluminium aux épaules. Sliders de genoux interchangeables. Protections en composites homologuées CE aux épaules, aux coudes et aux genoux. Protections Pro-Shape 2.0® homologuées CE aux hanches. Homologation CE.'),
(26, 2, 9, 'SUPER SPEED 4', 79995, 'none_550ac2b2ca1f765156861357e8482100_550ac2b.jpg', 5, 'super-speed-4', 'Blouson en cuir de vache D-Skin et tissu bi-élastique. Doublure 3D-Bubble et maille respirante. Aération sur les côtés. Pattes de serrage pression à la taille. Dos rallongé. Raccord pantalon. Aileron aérodynamique. 2 poches extérieures et 1 poche intérieure. Empiècements réfléchissants. Sliders remplaçable 2.0. Prédisposé à recevoir une dorsale et une protection pectorale. Plaque d’aluminium sur les épaules et les coudes. Protections homologuées CE aux épaules et aux coudes. Homologation CE.'),
(27, 2, 7, 'FUSION', 74995, 'none_0d4b46a775bf8eedddcc895f6db8cb86_0d4b46a.jpg', 5, 'fusion', 'Blouson moto racing homme en cuir de bovin avec double couche dans les zones exposées. Doublure intérieure amovible en maille traitée avec la technologue Polygiene Biostatic™ Stays Fresh. Corps, bras préformés. Multiples perforations pour l\'aération. Panneaux structurés MATRYX® sur l\'abdomen et le haut du dos pour la ventilation. Protections GP-R aux épaules, coudes. Inserts réfléchissants. Homologation CE comme EPI, classe AAA.'),
(28, 2, 7, 'ATEM V4', 69995, 'none_3a8f373be8b6ecaf645a4dbb45db4a3c_3a8f373.jpg', 5, 'atem-v4', 'Blouson cuir racing ALPINESTARS Atem V4. Construction en cuir de vachette. Tissu perforé optimisant la circulation du flux d\'air. Bosse dorsale aérodynamique. Protections sur les épaules et les coudes. Soufflets d\'aisance sur les épaules et les coudes.'),
(29, 2, 9, 'AVRO 4', 64995, 'none_a1f81f83ab8dbae7b5249d4c060de043_a1f81f8.jpg', 5, 'avro-4', 'Blouson en cuir bovin pleine fleur. Empiècements en tissu élastique. Doublure Nanofeel®. Doublure thermique amovible. Zips de ventilation. Homologation CE. Protections CE aux coudes et aux épaules. Poche pour dorsale (option). Coques thermoformées avec insert en aluminium. Détails réfléchissants.'),
(30, 2, 7, 'MISSILE V2 IGNITION', 59995, 'none_6258bc1856f337fe7f80eeed36f144dd_6258bc1.jpg', 5, 'missile-v2-ignition', 'Blouson moto en cuir de bovin premium \"Racing Grade\". Panneaux en cuir avec micro-perforations pour un flux d\'air optimisé. Empiècements Stretch. Panneaux innovants Matryx sur l\'abdomen, la poitrine et la bosse dorsale pour une circulation de l\'air optimisée et une résistance supérieure. Doublure de confort Mesh amovible. Protections épaules, coudes GP-R RACE homologuées CE. Sliders d\'épaules et de coudes DSF / TPU. Race Fit : coupe ajustée près du corps. Homologation CE EN17092-AAA.'),
(31, 2, 7, 'MISSILE V2', 55995, 'none_7f25df7124a50d0ac51ec7b91a47d952_7f25df7.jpg', 5, 'missile-v2', 'Blouson moto en cuir de bovin premium, 1.3mm (souplesse et résistance). Panneaux en tissu technique MATRYX®, situés sur le dos et l\'abdomen. Panneaux en polyamide HRSF très élastique pour une plus grande liberté de mouvement. Protections GP-R aux épaules, coudes, genoux et tibia avec certification CE. Sliders externes Dynamic Friction Shield (DFS) composés de TPU moulé à double densité. Protecteur de hanche Bio-Flex Race pour une protection optimale contre les impacts. Sport Fit : préformé pour un confort immédiat. Homologation CE EN17092-AAA.'),
(32, 2, 10, 'VORTEX 3 JKT', 46999, 'none_0da850bea8575f5e73e59504b9f7939d_0da850b.jpg', 5, 'vortex-3-jkt', 'Blouson racing. Matière extérieure en Cuir et Nylon 4-way stretch. Micro-perforations localisées pour une ventilation optimale. Matière intérieure en Soft mesh. Serrage velcro élastiqué aux hanches. Zip de connexion blouson/pantalon 270°. Boucle élastiquée pour un raccord ceinture. 2 poches extérieures. 1 poche intérieure mesh. 1 poche intérieure étanche. Nouveaux ODA en polymère bi-densité aux épaules. Nouvelles pièces de renfort moulées aux coudes. Nouvelle bosse aérodynamique issue du MotoGP. Protections épaules/coudes BETAC type B niveau 1 - utilisées en MotoGP. Empiècements réfléchissants biceps et bas du dos. Homologué CE, classe AAA.'),
(33, 2, 8, 'ATOMIC', 39995, 'none_7737c922160c07eaf67850ffbd193fb1_7737c92.jpg', 5, 'atomic', 'Blouson moto toutes saisons en cuir de vachette. Coupe Body Fit : ajustée, près du corps. Doublure fixe en textile 100% filet, maille issue de fibres recyclées. Doublure thermique intérieure amovible Shelltech Super. Réhausse col. Protections Omega homologuées CE-EN1621-1 Niveau 1 et amovibles aux coudes et aux épaules. Zip de raccordement blouson / pantalon. Poche portefeuille. 2 poches intérieures, 2 poches extérieures. Homologation CE et EPI.'),
(34, 2, 9, 'CARVE MASTER 3 GORE-TEX', 59995, 'none_3e135d5f90a1a89e4ae182f38953eafa_3e135d5.jpg', 6, 'carve-master-3-gore-tex', 'Veste moto homme textile toutes saisons Touring/Adventure. Tissu Mugello. Membrane Gore-Tex® imperméable et respirante. Doublure thermique amovible, col thermique amovible. Ventilations sur la poitrine et les manches et extracteurs dans le dos. Protections Pro-Armor aux coudes et aux épaules, homologuées CE niveau 2 type B. Coques de protections rigides en PU avec tissu 3D-Stone. Homologation CE comme EPI.'),
(35, 2, 9, 'RACING 3 D-DRY®', 42995, 'none_1251da0c24e389e89ab4ac7b4ba40437_1251da0.jpg', 6, 'racing-3-d-dryr', 'Blouson en tissu stretch imperméable. Doublure thermique amovible. Membrane D-Dry® étanche et respirante. Renfort en tissu Cordura. Protections CE amovibles aux coudes et aux épaules. Coques thermoformées aux épaules avec insert en aluminium. Détails réfléchissants.'),
(36, 2, 7, 'T-GP R V2 WATERPROOF NOIRE', 34995, 'none_caed4b12950d3c49852b4914dc55d605_caed4b1.jpg', 6, 't-gp-r-v2-waterproof-noire', 'Blouson polyvalent en tissu polyester intégrant des panneaux accordéon. Zips de ventilation. Membrane étanche fixe. Doublure thermique. Homologation CE. Sliders TPU externes sur les épaules. Protections CE aux épaules et aux coudes. Poches pour thorax et dorsale (options).'),
(37, 2, 7, 'T-GP R V2 WATERPROOF NOIRE-ROUGE', 34995, 'none_51b00014b257ec4aa23c616004a8992a_51b0001.jpg', 6, 't-gp-r-v2-waterproof-noire-rouge', 'Blouson polyvalent en tissu polyester intégrant des panneaux accordéon. Zips de ventilation. Membrane étanche fixe. Doublure thermique. Homologation CE. Sliders TPU externes sur les épaules. Protections CE aux épaules et aux coudes. Poches pour thorax et dorsale (options).'),
(38, 2, 10, 'BLASTER', 31999, 'none_1c6d236e9bda08f2102fef2857ef5cdc_1c6d236.jpg', 6, 'blaster', 'Blouson moto homme textile toutes saisons. Construction en polyester 600D et Ripstop. Renforts en polyester 1200D aux coudes et aux épaules. Doublure intérieure en polyester, doublure fixe étanche et respirante XDry. Doublure thermique amovible. Zips de ventilation. Soufflets d\'aisance en accordéon au niveau des coudes. Fermeture zippée sur le devant. Zips semi auto-lock. Coques de protections externes injectées bi-densité issues du MotoGP™ aux épaules. Protections aux coudes et aux épaules souples et ventilées IX-Proflex Seka-1 homologuées CE de niveau 1. Poches de protection en mesh 3D maximisant la circulation de l\'air. Homologation CE comme EPI.'),
(39, 2, 9, 'HYDRAFLUX 2 AIR D-DRY®', 29995, 'none_c13fd5a1ae5ea7bc5db030c63c066417_c13fd5a.jpg', 6, 'hydraflux-2-air-d-dryr', 'Blouson moto homme textile toutes saisons. Construction en polyester 600D et Ripstop. Renforts en polyester 1200D aux coudes et aux épaules. Doublure intérieure en polyester, doublure fixe étanche et respirante XDry. Doublure thermique amovible. Zips de ventilation. Soufflets d\'aisance en accordéon au niveau des coudes. Fermeture zippée sur le devant. Zips semi auto-lock. Coques de protections externes injectées bi-densité issues du MotoGP™ aux épaules. Protections aux coudes et aux épaules souples et ventilées IX-Proflex Seka-1 homologuées CE de niveau 1. Poches de protection en mesh 3D maximisant la circulation de l\'air. Homologation CE comme EPI.'),
(40, 3, 7, 'SP X AIR CARBON V2', 13495, 'none_32d089616749746b13c06e28140bae0d_32d0896.jpg', 7, 'sp-x-air-carbon-v2', 'Gants été. Homologation CE. Construction en cuir et textile. Cuir perforé pour une excellente circulation du flux d\'air. Soufflets d\'aisance offrant un maximum de flexibilité. Insert tactile. Articulations renforcées. Paume renforcée.'),
(41, 3, 7, 'HONDA SP-8 V3', 11995, 'none_f49a3c0a763593652c2565981e9999d6_f49a3c0.jpg', 7, 'honda-sp-8-v3', 'Gants en cuir de chèvre pleine fleur et cuir synthétique. Paume de main en suédé. Insert antidérapant dans la paume de la main. Doigts anatomiques préformés. Doigts et poignets perforés. Manchette longue. Pattes de serrage Velcro. Index tactile pour l\'utilisation du smartphone. Pont breveté entre l\'annulaire et le petit doigt. Protections métacarpienne SP double densité. Homologués CE Niveau 1.'),
(42, 3, 10, 'GP5 AIR', 10499, 'none_de349ab56a372fa1693b95735eb0397b_de349ab.jpg', 7, 'gp5-air', 'Gants été en cuir de chèvre et polyuréthane. Nombreuses perforations pour une bonne ventilation. Manchettes longues. Serrages aux poignets et aux manchettes. Cuir flex sur les articulations, les doigts et coutures retournées. Index tactile pour l’utilisation du smartphone. Coques aux articulations couvertes de cuir, sliders course, renfort paume et tranche. Anti- retournement entre l’annulaire et l’auriculaire. Homologation CE.'),
(43, 3, 7, 'HALO', 10995, 'none_cc446566ec48d48fa9409a35aa5a0fd9_cc44656.jpg', 7, 'halo', 'Gants été en cuir de chèvre, polyamide et aramide. Panneaux perforés sur les doigts. Tissu stretch sur le dos de la main. Manchette courte. Index et pouce tactiles pour l\'utilisation du smartphone. Pattes de serrage Velcro® aux poignets. Protections ergonomiques aux articulations en plastiques injecté et sans couture. Paume de main en caoutchouc antidérapant. Sliders sur le coté de la main. Homologués CE Niveau 1.'),
(44, 3, 9, 'X-MOTO UNISEX', 9495, 'none_e6f7b066eb22945246ad15611c06028b_e6f7b06.jpg', 7, 'x-moto-unisex', 'Gants en cuir de chèvre et tissu maillé. Homologation CE. Inserts souples. Tissu perforé, idéal lors des fortes chaleurs. Coque de protection sur les phalanges. Paume renforcée. Dainese Smart Touch permettant l\'utilisation des écrans tactiles.'),
(45, 3, 10, 'RS REPLICA', 39995, 'none_b6da265502dff089b896250d980093bf_b6da265.jpg', 7, 'rs-replica', 'Gants été en cuir de vachette perforé. Fourchettes de doigt en aramide Coton avec Fibres Dupont Kevlar réputé pour son extrême résistance Double coque de protection des articulations ultra-ventilée Renfort de la tranche Slider de paume injecté Pont petit doigt anti-retournement Manchette longue Patte de serrage Velcro aux poignets Poignet stretch avec strap Velcro Soufflets d\'aisance sur les doigts Grip poignée ergonomique. Homologués CE EN13594 Niveau 1KP'),
(46, 3, 7, 'AMT-10 Air HDRY', 19995, 'none_a53efa7513102f298cdba9d06c087f7a_a53efa7.jpg', 7, 'amt-10-air-hdry', 'Gants mi-saison en textile nyspan stretch. Totale imperméabilité grâce à l\'utilisation d\'une membrane laminée Hdry® comme sur-gants. Dessus des mains en Matryx®. Empiècements Rideknit®. Manchette courte. Pouce et index compatibles tactile. Paume en cuir de chèvre. Renforts Arshield sur la tranche. Protection métacarpienne surmoulée et sans coutures. Pont breveté Alpinestars entre l\'annulaire et le petit doigt. Homologation CE comme EPI niveau 2.'),
(47, 3, 7, 'ANDES V3 DRYSTAR', 11995, 'none_b40d11fdd85a8544d0a4a306bdbef4b4_b40d11f.jpg', 9, 'andes-v3-drystar', 'Gants textile Micro Ripstop. Paume en cuir de chèvre. Membrane Drystar® 100% imperméable et respirante. Protections phalanges en visco-élastique homologuées CE. Manchette longue. Homologués CE'),
(48, 3, 9, 'CARBON 3 SHORT', 12995, 'none_99b0c533608bf33064ee3aece5400509_99b0c53.jpg', 9, 'carbon-3-short', 'Gants DAINESE Carbon 3 Short. Construction en cuir de chèvre et de mouton et tissu spandex. Doigts pré-courbés. Système DCP sur l\'auriculaire. Serrage velcro. Coque carbone sur les phalanges. Multiples renforts sur les doigts. Paume renforcée.'),
(49, 3, 8, 'RAZZER', 9499, 'none_502f9d89c9a8665c5ac051289b197d4c_502f9d8.jpg', 9, 'razzer', 'Gants en cuir de Chèvre, néoprène. Coque de Protection Carbone. Renfort Paume. Sensor System. Serrage poignet. Manchette Courte. Doublure Polyester. Homologation EN 13594: 2015'),
(50, 3, 7, 'SMX Z DRYSTAR', 8995, 'none_3f0232a8cd92ddc9eebbba565e34ea4d_3f0232a.jpg', 9, 'smx-z-drystar', 'Gants route en cuir de chèvre pleine fleur. Technologie Drystar® étanche. Renforts sur la paume.'),
(51, 3, 9, 'STEEL-PRO IN', 33995, 'none_e97a0912da5135c4d8b82e5d11087b57_e97a091.jpg', 9, 'steel-pro-in', 'Gants en cuir de chèvre. Homologation CE. Soufflets d\'aisance sur les doigts et sur le dos de la main. Inserts élastiques apportant un maximum de souplesse. Coque de protection sur les phalanges. Paume renforcée. Coutures renforcées.'),
(52, 3, 8, 'ZAYANE GTX', 13995, 'none_4f522f7a7ebe586f7900fa4f33609bef_4f522f7.jpg', 9, 'zayane-gtx', 'Gants mi saison en Power Tech. Empiècements Softshell (coupe-vent et déperlants) Paume en cuir de chèvre et Amara. Membrane Gore-Tex imperméable, étanche et respirante. Coque de protection, paume renforcée, manchette courte. Homologation CE.'),
(53, 3, 7, 'Celer V2', 12495, 'none-1deba4d928696a8ae263b508d2b740a0-1deba4d-1680105864.jpg', 9, 'celer-v2', 'Gants en cuir de chèvre pleine fleur. Empiècements perforés. Insert stretch entre le pouce et la paume. Compatible avec les écrans tactiles. Fermeture velcro. Homologation CE. Coque de protection rigide en PU sur les phalanges. Paume renforcée en cuir. Renforts en poly-textile.');

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
-- Contraintes pour la table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `FK_8ECAEAD4A837E25D` FOREIGN KEY (`user_vo_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `command_product`
--
ALTER TABLE `command_product`
  ADD CONSTRAINT `FK_3C20574ED95D4C36` FOREIGN KEY (`command_vo_id`) REFERENCES `command` (`id`),
  ADD CONSTRAINT `FK_3C20574EEBA96259` FOREIGN KEY (`product_vo_id`) REFERENCES `product` (`id`);

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
