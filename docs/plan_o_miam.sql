-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 14 déc. 2022 à 11:26
-- Version du serveur :  10.3.37-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `plan'o'miam`
--

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`id`, `name`, `picture`) VALUES
(1, 'likin groupe', NULL);



--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `quantities`, `unit`) VALUES
(1, 'curry en poudre', 0.25, 'c.à.s'),
(2, 'vin blanc', 10, 'cl'),
(3, 'crème fraiche', 2.5, 'cl'),
(4, 'beurre', 12.5, 'g'),
(5, 'Persil', 0.5, 'g'),
(6, 'moules', 500, 'g'),
(7, 'échalote', 0.25, NULL),
(8, 'tomates', 0.25, 'kg'),
(9, 'poivrons verts et rouges', 116.5, 'g'),
(10, 'oignons émincés', 0.5, NULL),
(11, 'aîl', 0.5, 'gousse'),
(12, 'vin blanc', 3.5, 'cl'),
(13, 'bouquet garni', 1, NULL),
(14, 'huile d\'olive', 1, 'c.à.s'),
(15, 'sel', 0.25, 'pincée'),
(16, 'poivre', 0.25, 'pincée'),
(17, 'poulet', 150, 'g'),
(18, 'Courgette', 175, 'g'),
(19, 'bouillon de legume', 0.5, 'cube'),
(20, 'ail', 0.5, 'gousse'),
(21, 'eau', 0.25, 'l'),
(22, 'poivre', 1, 'pincée'),
(23, 'sel', 1, 'pincée'),
(24, 'Vache qui rit', 1.5, 'portion'),
(25, 'poireau', 1, NULL),
(26, 'Carotte', 1, NULL),
(27, 'Courgette', 0.5, NULL),
(28, 'Tomate', 0.5, NULL),
(29, 'Huile d\'olive', 5, 'ml'),
(30, 'Jus de citron', 2, 'ml'),
(31, 'Herbe de Provence', 1, 'pincée'),
(32, 'Pavé de saumon', 1, NULL);

--
-- Déchargement des données de la table `lunchs`
--

INSERT INTO `lunchs` (`id`, `date`, `time`) VALUES
(1, '2022-12-13 00:00:00', 'soir');

--
-- Déchargement des données de la table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `rating`, `picture`) VALUES
(1, 'Moules au curry', NULL, 'https://assets.afcdn.com/recipe/20200907/113854_w1000h667c1cx2880cy1920cxb5760cyb3840.webp'),
(2, 'Poulet Basquaise', NULL, 'https://assets.afcdn.com/recipe/20161116/7224_w1000h1500c1cx1972cy3850cxb3840cyb5760.webp'),
(3, 'Soupe de courgettes à la vache qui rit', NULL, 'https://assets.afcdn.com/recipe/20181017/82802_w1000h1333c1cx1824cy2431cxb3648cyb4863.webp'),
(4, 'Pave de saumon en papillotte', NULL, 'https://assets.afcdn.com/recipe/20180215/77570_w1000h750c1cx1024cy768cxb2048cyb1536.webp');


--
-- Déchargement des données de la table `steps`
--

INSERT INTO `steps` (`id`, `recipe_id`, `text`) VALUES
(1, 1, '1. Faire fondre le beurre et y faire rissoler l\'échalote hachée finement.'),
(2, 1, '2. Ajouter le vin et cuire 2 mn.'),
(3, 1, '3. Trier, rincer les moules. Les jeter dans la casserole, couvrir et laisser cuire 5 mn après le début de l\'ébullition.'),
(4, 1, '4. Egoutter les moules, filtrer le jus puis mélanger ce dernier avec la crème fraîche et le curry.'),
(5, 1, '5.Laisser réduire de moitié.'),
(6, 1, '6. Verser les moules et servir aussitôt.'),
(7, 2, 'Hacher l\'oignon et l\'ail. Couper les tomates en morceaux et détailler les poivrons en lanières.'),
(8, 2, 'Faire chauffer 4 cuillères à soupe d\'huile dans une cocotte. Y faire dorer les oignons, l\'ail et les poivron. Laisser cuire 5 min.'),
(9, 2, 'Ajouter les tomates à la cocotte, saler, poivrer. Couvrir et laisser mijoter 20 min.'),
(10, 2, 'Dans une sauteuse, faire dorer dans l\'huile d\'olive les morceaux de poulet salés et poivrés.'),
(11, 2, 'Lorsqu\'ils sont dorés, les ajouter aux légumes, couvrir, ajouter le bouquet garni et le vin blanc et c\'est parti pour 35 min de cuisson.'),
(12, 3, '1. Mettre à chauffer l\'eau, les cubes de bouillon, la vache qui rit, l\'ail écrasé, les courgettes coupées en morceaux avec la peau; sel et poivre.'),
(13, 3, '2. Laisser cuire environ 40 min (quand la courgette est tendre).'),
(14, 3, '3. Mixer le tout, et déguster!'),
(15, 4, '1. Faire préchauffer le four à 210°C pendant 10 min.'),
(16, 4, '2. Eplucher, laver et couper finement les légumes.'),
(17, 4, '3. Couper deux feuilles de papier sulfurisé.'),
(18, 4, '4. Déposer, sur chaque feuille, en couches successives :'),
(19, 4, '- 1 blanc de poireaux,'),
(20, 4, '- 1 carotte,'),
(21, 4, '- 1/2 courgette,'),
(22, 4, '- 1 pavé de saumon,'),
(23, 4, '- 1/2 tomate,'),
(24, 4, '- Herbe de provence et aromate'),
(25, 4, '5. Rabattre légèrement le papier sulfurisé et ajouter un filet d\'huile d\'olive et le jus de citron.'),
(26, NULL, '6. Fermer les papillotes en repliant le papier de chaque côté du rectangle comme pour en faire un bonbon.'),
(27, NULL, '7. Mettre au four pendant 20 min');

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`, `picture`) VALUES
(1, 'likin', '[\"ROLE_MANAGER\"]', '$2y$13$TsxvN28VzKpUJHCblFy8pOaIqm1KMVWvvw5pEiWNIh1o20gVg7m0.', 'likin@test.fr', NULL);


--
-- Déchargement des données de la table `recipes_ingredients`
--

INSERT INTO `recipes_ingredients` (`recipes_id`, `ingredients_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(3, 22),
(3, 23),
(3, 24),
(4, 25),
(4, 26),
(4, 27),
(4, 28),
(4, 29),
(4, 30),
(4, 31),
(4, 32);

--
-- Déchargement des données de la table `lunchs_groups`
--

INSERT INTO `lunchs_groups` (`lunchs_id`, `groups_id`) VALUES
(1, 1);

--
-- Déchargement des données de la table `lunchs_recipes`
--

INSERT INTO `lunchs_recipes` (`lunchs_id`, `recipes_id`) VALUES
(1, 2);

--
-- Déchargement des données de la table `groups_user`
--

INSERT INTO `groups_user` (`groups_id`, `user_id`) VALUES
(1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
