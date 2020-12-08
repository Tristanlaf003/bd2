-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 08 déc. 2020 à 00:04
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mini_facebook`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Verification_mots_censures` ()  SELECT mot FROM censures$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `censures`
--

CREATE TABLE `censures` (
  `id` int(11) NOT NULL,
  `mot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `censures`
--

INSERT INTO `censures` (`id`, `mot`) VALUES
(1, 'tabarnak'),
(2, 'calise'),
(3, 'putin'),
(4, 'salope'),
(5, 'crise');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `commentaire` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_commentaire` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `publication_id`, `utilisateur_id`, `commentaire`, `date_commentaire`) VALUES
(55, 39, 16, 'Nice', '2020-12-07 17:49:18'),
(56, 38, 16, 'C\'est des patates', '2020-12-07 17:49:31'),
(57, 30, 16, 'J\'adore moi aussi les petites patates', '2020-12-07 17:49:48'),
(58, 29, 16, 'C\'est mon activité favorite!!!!!', '2020-12-07 17:50:02'),
(59, 32, 7, 'fefeffefe', '2020-12-07 17:51:31'),
(60, 32, 7, 'grwgerghehgaejirodpgjdearoipfgjodiafgjhdiafpgjhdoifjgdoifjgoidfjgoidfjgiodfjgifogg', '2020-12-07 17:51:37'),
(61, 32, 7, 'gwergerokigherioughedrioughedriopughediurphgiuepdrhgiupedrhgpiuerhgiuerdhgiuedrhgiuerhgiureh', '2020-12-07 17:51:43'),
(62, 32, 7, 'fg', '2020-12-07 17:51:48'),
(63, 32, 7, 'Covid-19', '2020-12-07 17:51:54'),
(64, 43, 9, 'Trop cool!!!!!!!!!!!', '2020-12-07 17:55:45'),
(72, 41, 20, 'J\'aime l\'art plastique', '2020-12-07 18:48:25'),
(73, 41, 20, 'Cool!!', '2020-12-07 18:48:34');

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

CREATE TABLE `publications` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `legende` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_publication` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categorie` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `publications`
--

INSERT INTO `publications` (`id`, `utilisateur_id`, `photo`, `legende`, `date_publication`, `categorie`) VALUES
(29, 7, '1.jpg', 'Faire de la randonner', '2020-12-07 17:35:19', 'activite_et_loisir'),
(30, 7, '10.jpg', 'J\'adore les petites patates', '2020-12-07 17:35:51', 'gastronomie'),
(31, 7, '3.jpg', 'classe', '2020-12-07 17:40:31', 'vie_estudiantine'),
(32, 7, 'actualite_2.jpg', 'J\'adore', '2020-12-07 17:40:47', 'actualite'),
(33, 9, '3.jpg', 'Gaming', '2020-12-07 17:42:18', 'activite_et_loisir'),
(34, 9, '8.jpg', 'Pancake', '2020-12-07 17:43:26', 'gastronomie'),
(35, 9, '2.jpg', 'Après les cours', '2020-12-07 17:43:47', 'vie_estudiantine'),
(36, 9, 'actualite_1.jpg', 'Premier ministre du Québec', '2020-12-07 17:44:14', 'actualite'),
(37, 8, '12.jpg', 'Parc', '2020-12-07 17:44:46', 'activite_et_loisir'),
(38, 8, '4.jpg', 'WHAT!!!', '2020-12-07 17:45:08', 'gastronomie'),
(39, 8, '1.jpg', 'Dans la cours de l\'école', '2020-12-07 17:45:36', 'vie_estudiantine'),
(40, 8, 'simpson.gif', 'HOOOOOOOOOOOOOOOOOO!!!!!!!!!', '2020-12-07 17:45:55', 'actualite'),
(41, 16, '11.jpg', 'Art plastique', '2020-12-07 17:47:49', 'activite_et_loisir'),
(42, 16, '12.jpg', 'C\'est booooooonnnnnn!', '2020-12-07 17:48:06', 'gastronomie'),
(43, 16, 'musique.69725 (2016_09_03 21_04_29 UTC).gif', 'Écouter de la musique pendant les cours.', '2020-12-07 17:48:27', 'vie_estudiantine'),
(44, 16, '7de61d192a8259ca127d816ed15136e5 (2016_09_03 21_04_29 UTC).jpg', 'Découverte d\'une nouvelle planète.', '2020-12-07 17:48:58', 'actualite'),
(45, 7, 'gif-anime.gif', 'LA LA LA LA LA LA LA !!1', '2020-12-07 17:50:35', 'actualite'),
(46, 9, 'minecraft (2016_09_03 21_04_29 UTC).jpg', 'Minecraft', '2020-12-07 17:52:24', 'activite_et_loisir'),
(47, 9, 'homer.gif', 'Dormir', '2020-12-07 17:55:06', 'vie_estudiantine');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `prenom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mot_de_passe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre_de_jour` int(11) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `prenom`, `nom`, `date_naissance`, `email`, `mot_de_passe`, `date_inscription`, `nombre_de_jour`, `image`, `status`) VALUES
(7, 'Tristan', 'Lafontaine', '2020-11-01', 'tristanlaf003@gmail.com', '$2y$10$j0njvpdbafoayuDz1UYRIeLxBCsYfwW92AC0SGFkyQq4R5.wfrqy6', '2020-11-02 16:05:52', 35, 'signup_man.png', 0),
(8, 'Olivier', 'Grenier', '2020-06-01', 'olivier@gmail.com', '$2y$10$VERemXay8BnFeTDDBewkfeiXDhHRqHNnH7TtYsbj6.pEBJk8SZuwe', '2020-11-04 21:35:43', 33, 'signup_man.png', 0),
(9, 'Tristan', 'Lafontaine', '2020-11-02', 'trytry12@live.ca', '$2y$10$gFY.FBzwEvQ8VX/6blpBBO5X2bkwKQKoAM3Z5wDG23klrFN.4Rgqe', '2020-11-04 23:39:17', 33, 'signup_man.png', 0),
(11, 'Tristan', 'Lafontaine', '2020-11-03', 'lafontaine@gmail.com', '$2y$10$aA/PcudYvhwCtRUOB23kn.Y8HO1Xb2UXWyrrJRLsnhxIZfcVzk20i', '2020-11-05 21:28:08', 32, 'atl (2016_09_03 21_04_29 UTC).jpg', 0),
(13, 'Joel', 'Sander', '2020-11-16', 'joel.sande@gmail.com', '$2y$10$LFRg1cIXbt8FPO6NxLNGTO3R7Qa93zJKU2d0LWfgQGLfCpICVuC3O', '2020-11-16 15:34:07', 21, 'joel.jpg', 0),
(16, 'Thomas', 'Houle', '1999-06-14', 'thomas.houle@gmail.com', '$2y$10$mQjq1qsRf.Ift2b2SOYPIuZ9Cyupqgr5aCF/BAnX53pZlNugvUjWq', '2020-12-04 23:53:15', 3, 'tardigrade.jpg', 0),
(20, 'Tristan', 'Lafontaine', '2020-12-07', 'lafontaine.tristan@gmail.com', '$2y$10$sj1kP6KxfUAVumQMlT4XdO4Fr9GXiZ2gIA2OJ9JD5XplC/pDaE.xe', '2020-12-07 18:47:33', 0, 'homer.gif', 0);

--
-- Déclencheurs `utilisateurs`
--
DELIMITER $$
CREATE TRIGGER `nombre_de_jour` BEFORE UPDATE ON `utilisateurs` FOR EACH ROW BEGIN
	SET new.nombre_de_jour = (SELECT DATEDIFF(NOW(),OLD.date_inscription) FROM utilisateurs WHERE id = NEW.id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_afficher_publication`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_afficher_publication` (
`email` varchar(100)
,`commentaire` varchar(100)
,`date_commentaire` datetime
,`image` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_prenom_nom_email_utilisateur`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_prenom_nom_email_utilisateur` (
`prenom` varchar(100)
,`nom` varchar(100)
,`email` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure de la vue `v_afficher_publication`
--
DROP TABLE IF EXISTS `v_afficher_publication`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_afficher_publication`  AS  select `utilisateurs`.`email` AS `email`,`commentaires`.`commentaire` AS `commentaire`,`commentaires`.`date_commentaire` AS `date_commentaire`,`utilisateurs`.`image` AS `image` from (`commentaires` join `utilisateurs` on((`utilisateurs`.`id` = `commentaires`.`utilisateur_id`))) order by `commentaires`.`id` desc ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_prenom_nom_email_utilisateur`
--
DROP TABLE IF EXISTS `v_prenom_nom_email_utilisateur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_prenom_nom_email_utilisateur`  AS  select `utilisateurs`.`prenom` AS `prenom`,`utilisateurs`.`nom` AS `nom`,`utilisateurs`.`email` AS `email` from `utilisateurs` order by `utilisateurs`.`nom` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `censures`
--
ALTER TABLE `censures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateurs_id` (`utilisateur_id`),
  ADD KEY `publication_id` (`publication_id`);

--
-- Index pour la table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `censures`
--
ALTER TABLE `censures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT pour la table `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `publication_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `publications_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
