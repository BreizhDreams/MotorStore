-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 29 mars 2023 à 09:31
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
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` datetime NOT NULL,
  `advantage_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_ht` double NOT NULL,
  `command_date` datetime NOT NULL,
  `command_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
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
('DoctrineMigrations\\Version20230328151508', '2023-03-28 15:15:16', 124);

-- --------------------------------------------------------

--
-- Structure de la table `fidelity_card`
--

DROP TABLE IF EXISTS `fidelity_card`;
CREATE TABLE IF NOT EXISTS `fidelity_card` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_ttc` double NOT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_category_vo_id` int DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04ADA2C6564C` (`category_vo_id`),
  KEY `IDX_D34A04AD110CD012` (`brand_vo_id`),
  KEY `IDX_D34A04ADC3620458` (`sub_category_vo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `category_vo_id`, `brand_vo_id`, `designation`, `prix_ttc`, `photo_url`, `sub_category_vo_id`, `slug`) VALUES
(1, 1, 2, 'EXO-390 CHICA II', 10990, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_dca7352bb0ca4db74bf1b469161d65eb_dca7352.JPEG', 1, 'exo-390-chica-ii'),
(2, 1, 2, 'EXO-R1 AIR Fabio Monster Replica', 52990, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/None/main/fabior1air_10d246d.jpg', 1, 'exo-r1-air-fabio-monster-replica'),
(3, 1, 3, 'SKWAL 2 NOXXYS', 29999, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_088f5afb850b47e1deca5b01ab56ce12_088f5af.JPEG', 1, 'skwal-2-noxxys'),
(4, 1, 3, 'RIDILL NELUM', 19999, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_f2c721b853d3be8937e2421b7565dd30_f2c721b.JPEG', 1, 'ridill-nelum'),
(5, 1, 4, 'FF353 RAPID HAPPY DREAMS', 10999, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_048c1d941bda3fec3be707aeed2a2529_048c1d9.JPEG', 1, 'ff353-rapid-happy-dreams'),
(6, 1, 2, 'EXO-1400 CARBON AIR Legione', 43950, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_601d10e610f1a245b3daaceec2b7c26c_601d10e.JPEG', 1, 'exo-1400-carbon-air-legione'),
(7, 1, 2, 'EXO-R1 AIR VICTORY', 39990, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_8c74803e86a6bfa95ac3fd0c01db6ff8_8c74803.JPEG', 1, 'exo-r1-air-victory'),
(8, 1, 1, 'NEOTEC II MM93 COLLECTION 2-WAY TC-5', 75900, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_b91aa81e75d20c23c4795899e897dcaf_b91aa81.JPEG', 2, 'neotec-ii-mm93-collection-2-way-tc-5'),
(9, 1, 1, 'NEOTEC II WINSOME TC-1', 72900, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_35833d323270ff34b0e5f3c1cbf87aca_35833d3.JPEG', 2, 'neotec-ii-winsome-tc-1'),
(10, 1, 1, 'NEOTEC II JAUNT TC-1', 72900, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_f4b50418dac26aa1c591f1547d4582c2_f4b5041.JPEG', 2, 'neotec-ii-jaunt-tc-1'),
(11, 1, 2, 'EXO-TECH EVO CARBON GENUS', 49900, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_21644826ccc6597cc53a7e50cb729bf6_2164482.JPEG', 2, 'exo-tech-evo-carbon-genus'),
(12, 1, 4, 'FF901 ADVANT X CARBON FUTURE', 49900, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_153df85c076ad489cbcaa2513377f8d2_153df85.JPEG', 2, 'ff901-advant-x-carbon-future'),
(13, 1, 3, 'EVO GT SEAN', 47900, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_9fcd04dfd7dcf9f0640355689f4e7923_9fcd04d.JPEG', 2, 'evo-gt-sean'),
(14, 1, 2, 'COVERT-X WALL', 29900, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_e4a7634ff23e76e947b93c8091384230_e4a7634.JPEG', 3, 'covert-x-wall'),
(15, 1, 1, 'J-CRUISE 2 AGLERO NOIR ROUGE', 59900, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_0c458f7cfdff9b316ea4fb2ce91ffb51_0c458f7.JPEG', 3, 'j-cruise-2-aglero-noir-rouge'),
(16, 1, 1, 'J-CRUISE 2 AGLERO NOIR JAUNE', 59900, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_a8ef7612f87258116e689f7002e7cb94_a8ef761.JPEG', 3, 'j-cruise-2-aglero-noir-jaune'),
(17, 1, 5, 'FREEWAY CLASSIC SKULL', 39900, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_15fc49ca3d1d28960b0b929c24f1a363_15fc49c.JPEG', 3, 'freeway-classic-skull'),
(18, 1, 6, 'K-5 JET ROSSI MISANO 2015', 57900, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_4709a712cb326e890596e8397880b66d_4709a71.JPEG', 3, 'k-5-jet-rossi-misano-2015'),
(20, 2, 10, 'JACKAL', 47900, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_673e57ded5fb85345b60278b1cfd0c89_673e57d.JPEG', 4, 'jackal'),
(21, 2, 7, 'ATEM V4', 140000, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_4ea141f87bfa8e64a12c49a390b6cfac_4ea141f.JPEG', 4, 'atem-v4'),
(22, 2, 7, 'ATEM V4 2P', 120099, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_9bdde9c7f934b060d551aaf0761dc19c_9bdde9c.JPEG', 4, 'atem-v4-2p'),
(23, 2, 10, 'VORTEX 3', 89999, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_669352640d0fe7662a0a871a28a79505_6693526.JPEG', 4, 'vortex-3'),
(24, 2, 9, 'TOSA 1 PCS PERF', 105095, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_21572a741a71c5bb8fb41156649c6239_21572a7.JPEG', 4, 'tosa-1-pcs-perf'),
(25, 2, 9, 'LAGUNA SECA 5 PERF', 139995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_79c2c448cfa782e0b860d8ab2b126beb_79c2c44.JPEG', 4, 'laguna-seca-5-perf'),
(26, 2, 9, 'SUPER SPEED 4', 79995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_550ac2b2ca1f765156861357e8482100_550ac2b.JPEG', 5, 'super-speed-4'),
(27, 2, 7, 'FUSION', 74995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_0d4b46a775bf8eedddcc895f6db8cb86_0d4b46a.JPEG', 5, 'fusion'),
(28, 2, 7, 'ATEM V4', 69995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_3a8f373be8b6ecaf645a4dbb45db4a3c_3a8f373.JPEG', 5, 'atem-v4'),
(29, 2, 9, 'AVRO 4', 64995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_a1f81f83ab8dbae7b5249d4c060de043_a1f81f8.JPEG', 5, 'avro-4'),
(30, 2, 7, 'MISSILE V2 IGNITION', 59995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_6258bc1856f337fe7f80eeed36f144dd_6258bc1.JPEG', 5, 'missile-v2-ignition'),
(31, 2, 7, 'MISSILE V2', 55995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_7f25df7124a50d0ac51ec7b91a47d952_7f25df7.JPEG', 5, 'missile-v2'),
(32, 2, 10, 'VORTEX 3 JKT', 46999, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_0da850bea8575f5e73e59504b9f7939d_0da850b.JPEG', 5, 'vortex-3-jkt'),
(33, 2, 8, 'ATOMIC', 39995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_7737c922160c07eaf67850ffbd193fb1_7737c92.JPEG', 5, 'atomic'),
(34, 2, 9, 'CARVE MASTER 3 GORE-TEX', 59995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_3e135d5f90a1a89e4ae182f38953eafa_3e135d5.JPEG', 6, 'carve-master-3-gore-tex'),
(35, 2, 9, 'RACING 3 D-DRY®', 42995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_1251da0c24e389e89ab4ac7b4ba40437_1251da0.JPEG', 6, 'racing-3-d-dryr'),
(36, 2, 7, 'T-GP R V2 WATERPROOF NOIRE', 34995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_caed4b12950d3c49852b4914dc55d605_caed4b1.JPEG', 6, 't-gp-r-v2-waterproof-noire'),
(37, 2, 7, 'T-GP R V2 WATERPROOF NOIRE-ROUGE', 34995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_51b00014b257ec4aa23c616004a8992a_51b0001.JPEG', 6, 't-gp-r-v2-waterproof-noire-rouge'),
(38, 2, 10, 'BLASTER', 31999, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_1c6d236e9bda08f2102fef2857ef5cdc_1c6d236.JPEG', 6, 'blaster'),
(39, 2, 9, 'HYDRAFLUX 2 AIR D-DRY®', 29995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_c13fd5a1ae5ea7bc5db030c63c066417_c13fd5a.JPEG', 6, 'hydraflux-2-air-d-dryr'),
(40, 3, 7, 'SP X AIR CARBON V2', 13495, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_32d089616749746b13c06e28140bae0d_32d0896.JPEG', 7, 'sp-x-air-carbon-v2'),
(41, 3, 7, 'HONDA SP-8 V3', 11995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_f49a3c0a763593652c2565981e9999d6_f49a3c0.JPEG', 7, 'honda-sp-8-v3'),
(42, 3, 10, 'GP5 AIR', 10499, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_de349ab56a372fa1693b95735eb0397b_de349ab.JPEG', 7, 'gp5-air'),
(43, 3, 7, 'HALO', 10995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_cc446566ec48d48fa9409a35aa5a0fd9_cc44656.JPEG', 7, 'halo'),
(44, 3, 9, 'X-MOTO UNISEX', 9495, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_e6f7b066eb22945246ad15611c06028b_e6f7b06.JPEG', 7, 'x-moto-unisex'),
(45, 3, 10, 'RS REPLICA', 39995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_b6da265502dff089b896250d980093bf_b6da265.JPEG', 7, 'rs-replica'),
(46, 3, 7, 'AMT-10 Air HDRY', 19995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_a53efa7513102f298cdba9d06c087f7a_a53efa7.JPEG', 7, 'amt-10-air-hdry'),
(47, 3, 7, 'ANDES V3 DRYSTAR', 11995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_b40d11fdd85a8544d0a4a306bdbef4b4_b40d11f.JPEG', 9, 'andes-v3-drystar'),
(48, 3, 9, 'CARBON 3 SHORT', 12995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_99b0c533608bf33064ee3aece5400509_99b0c53.JPEG', 9, 'carbon-3-short'),
(49, 3, 8, 'RAZZER', 9499, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_502f9d89c9a8665c5ac051289b197d4c_502f9d8.JPEG', 9, 'razzer'),
(50, 3, 7, 'SMX Z DRYSTAR', 8995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_3f0232a8cd92ddc9eebbba565e34ea4d_3f0232a.JPEG', 9, 'smx-z-drystar'),
(51, 3, 9, 'STEEL-PRO IN', 33995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_e97a0912da5135c4d8b82e5d11087b57_e97a091.JPEG', 9, 'steel-pro-in'),
(52, 3, 8, 'ZAYANE GTX', 13995, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_4f522f7a7ebe586f7900fa4f33609bef_4f522f7.JPEG', 9, 'zayane-gtx'),
(53, 3, 7, 'Celer V2', 12495, 'https://d1kvfoyrif6wzg.cloudfront.net/assets/images/82/main/none_1deba4d928696a8ae263b508d2b740a0_1deba4d.JPEG', 9, 'celer-v2');

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
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649EC8630E3` (`fidelity_card_vo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `fidelity_card_vo_id`, `email`, `roles`, `password`, `last_name`, `first_name`, `address`, `zip_code`, `city`, `tel_number`, `birth_date`) VALUES
(1, NULL, 'fbesnard.ledantec@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$.lhUy28AjnAch0TlM6cTY.JtvLS1bE12dOqF/KMnTFE1AcL97Bjdq', 'BESNARD', 'François', '23 Rue joseph lesbleiz', '22300', 'Ploubezre', '0665198741', '1996-12-09'),
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
