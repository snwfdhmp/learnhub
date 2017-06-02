SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `chapitres` (
  `id_chapitre` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL,
  `nom` char(50) NOT NULL,
  `rang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `chapitres` (`id_chapitre`, `id_matiere`, `nom`, `rang`) VALUES
(1, 1, 'Nombres complexes', 1),
(2, 1, 'Etude de fonctions', 3),
(3, 1, 'Trigonométrie', 2),
(6, 1, 'Matrices', 9),
(7, 1, 'Espaces vectoriels', 7),
(8, 1, 'Applications linéaires', 8),
(9, 25, 'Front-End', 1),
(10, 25, 'Back-End', 2),
(11, 3, 'Conjugaison', 100),
(12, 3, 'Conjugaison', 100),
(13, 28, 'Divisions', 100);

CREATE TABLE `comments` (
  `id_com` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `note` int(11) NOT NULL DEFAULT '0',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(32) NOT NULL DEFAULT 'primary',
  `likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `connexions` (
  `id_connexion` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `last_ip` char(20) NOT NULL,
  `last_ping` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `session_cookie` char(168) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `connexions` (`id_connexion`, `id_user`, `last_ip`, `last_ping`, `session_cookie`) VALUES
(16, 15, '::1', '2017-06-02 22:58:24', '54be02c7c9bbdc23d7b2c7a7e386192b8cf06e1082f4c5588005b10590373be0a6b300d0c9a429f6d1c96b8cee16f110f2974518e5155a4f4c2548c9709ca7c8');

CREATE TABLE `documents` (
  `id_doc` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `id_chapitre` int(11) NOT NULL,
  `doc_type` int(11) NOT NULL,
  `nom` char(50) NOT NULL,
  `url` char(200) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vues` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `documents` (`id_doc`, `id_auteur`, `id_chapitre`, `doc_type`, `nom`, `url`, `date_creation`, `vues`) VALUES
(3, 2, 1, 1, 'Cours de Maths', 'files/9264192f2bcb37fd879c2e5e17349df3', '2017-05-06 00:11:33', 44),
(4, 5, 7, 2, 'Exercice de marketing', 'files/bf2e1547727a8b198834e448cfc0577f', '2017-05-04 08:09:21', 5),
(5, 2, 7, 1, 'Démo', 'files/59142c0760cc7320a740044e6914a5db', '2017-05-01 15:11:43', 0),
(6, 2, 8, 1, 'Coucou', 'files/cabe0afb78111d8603272c5a8582536d', '2017-05-04 18:24:43', 0),
(7, 2, 1, 2, 'exos', 'files/4f45e316bdb8c811004888e27a574ce5', '2017-05-02 13:49:40', 125),
(8, 2, 6, 1, 'Cours de matrices', 'files/36508ae91d9eb1b86778ef0e7e9ed311', '2017-04-18 21:05:14', 0),
(9, 10, 1, 2, 'Exercice Complexes', 'files/384aa8b78c697ca18114d1fe90cb1771', '2017-05-15 18:49:47', 2),
(10, 2, 9, 1, 'Cours Front-End (PDF)', 'files/088028101493247d606e0074eeae3da4', '2017-05-18 15:36:16', 8),
(11, 2, 3, 2, 'Exercice', 'files/3cbce4302f68970147242bd7c0dad1bd', '2017-05-18 15:37:28', 0),
(12, 13, 1, 2, 'Exercice maths', 'files/f357fd5b6a67733b1ccfe4a455841128', '2017-05-18 16:30:16', 44),
(13, 13, 1, 3, 'Annale', 'files/1018c351800448b0d57948830762670a', '2017-05-18 20:53:15', 1),
(14, 3, 1, 1, 'stock.txt', 'files/stock.txt', '2017-05-18 22:52:18', 11),
(15, 3, 1, 1, 'calc.c', 'files/calc.c', '2017-05-18 22:52:18', 76),
(18, 2, 1, 1, 'TD n°91', 'files/dabbf4c0c5fa84b35901e80e9006ed85', '2017-05-19 01:02:57', 137),
(19, 2, 1, 2, 'Exercice TD', 'files/a315aaad72e51b8030ff9d9716246fb6', '2017-05-19 01:03:41', 3),
(20, 2, 2, 3, 'Annale DS', 'files/6af5fa5d84c83438c6091af1b6db27ee', '2017-05-20 21:29:24', 1);

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `type_ref` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `id_ref` int(11) NOT NULL,
  `valeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `likes` (`id_like`, `type_ref`, `id_auteur`, `id_ref`, `valeur`) VALUES
(6, 1, 2, 18, 1),
(7, 1, 2, 3, 1),
(8, 0, 2, 21, 1),
(9, 1, 2, 4, -1),
(10, 0, 2, 13, 1),
(11, 1, 2, 7, 1),
(12, 0, 2, 23, 1),
(13, 0, 2, 27, 1),
(14, 0, 2, 28, 1),
(15, 0, 2, 25, 1),
(16, 0, 2, 31, 1),
(17, 0, 2, 32, 1),
(18, 0, 2, 41, 1),
(19, 0, 2, 42, 1),
(20, 1, 2, 19, 1),
(21, 0, 2, 46, 1),
(22, 0, 2, 49, 1),
(23, 0, 2, 52, 1),
(24, 0, 2, 53, 1),
(25, 0, 2, 54, 1),
(26, 0, 2, 55, 1),
(27, 0, 2, 56, 1),
(28, 0, 2, 57, 1),
(29, 0, 2, 58, 1),
(30, 1, 2, 14, 1),
(31, 1, 2, 15, 1),
(32, 0, 2, 40, -1),
(33, 0, 2, 59, -1),
(34, 0, 2, 71, 1),
(35, 0, 2, 69, 1),
(36, 0, 2, 67, 1),
(37, 0, 2, 66, 1),
(38, 0, 2, 65, 1),
(39, 0, 2, 64, 1),
(40, 0, 2, 63, 1),
(41, 0, 2, 62, 1),
(42, 0, 2, 61, 1),
(43, 0, 2, 60, 1),
(44, 0, 2, 45, 1),
(45, 0, 2, 68, 1),
(46, 0, 2, 70, 1),
(47, 0, 98, 78, 1),
(48, 1, 98, 10, 1),
(49, 1, 15, 18, 1);

CREATE TABLE `matieres` (
  `id_matiere` int(11) NOT NULL,
  `nom_matiere` char(50) NOT NULL,
  `diminutif` char(8) NOT NULL,
  `promo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `matieres` (`id_matiere`, `nom_matiere`, `diminutif`, `promo`) VALUES
(1, 'Maths : Algèbre et Analyse', 'MATHS', 1),
(2, 'Mécanique', 'MECA', 1),
(3, 'Anglais', 'LV1', 2),
(4, 'Structures de Données et Algorithmes', 'SDA', 1),
(5, 'Structures de Données et Algorithmes', 'SDA', 2),
(6, 'Création d\'entreprise', 'CREA', 4),
(7, 'Physique', 'PHY', 6),
(8, 'Intelligence Artificielle', 'IA', 6),
(9, 'Intelligence Artificielle', 'IA', 4),
(10, 'Intelligence Artificielle', 'IA', 3),
(11, 'Marketing', 'MARKET', 1),
(12, 'Electricité Générale', 'ELG', 1),
(13, 'Initiation aux Systèmes d\'Exploitation et Réseaux', 'ISER', 1),
(14, 'Programmation Orienté Objet', 'POO', 2),
(15, 'Electronique', 'ENI', 1),
(16, 'Analyse Numérique', 'ANM', 1),
(17, 'Probabilités', 'PROBA', 1),
(18, 'Initiation aux Architectures Réseaux', 'IAR', 1),
(19, 'Electronique', 'ENI', 2),
(20, 'Algèbre et Analyse Numérique', 'MATHS', 2),
(21, 'Electricité Générale', 'ELG', 2),
(22, 'Web 2', 'WEB', 2),
(23, 'Mini Projet Informatique', 'MPI', 1),
(24, 'Système d\'Information et Applications', 'SIA', 1),
(25, 'Web Dynamique et Statique', 'WEB', 1),
(26, 'Mini-projet Multimédia', 'MPM', 1),
(27, 'Communication', 'COM', 1),
(28, 'Maths', 'MATHS', 3);

CREATE TABLE `promos` (
  `id_promo` int(11) NOT NULL,
  `nom` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `promos` (`id_promo`, `nom`) VALUES
(1, 'LE1'),
(2, 'LE2'),
(3, 'LE3'),
(4, 'LE4'),
(5, 'LE5'),
(6, 'LA1'),
(7, 'LA2'),
(8, 'LA3'),
(9, 'Admin'),
(10, 'Personnel'),
(11, 'Secrétariat'),
(12, 'Enseignants');

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `value` text NOT NULL,
  `id_owner` int(11) NOT NULL,
  `used` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tokens` (`id`, `type`, `id_user`, `value`, `id_owner`, `used`) VALUES
(56, 0, 92, 'bba693c188c132df8a4db9bd2e53528590d7715695dde84f89e3d8945b5bf8c653c856f87064f62fb0251001419a7a82', 15, 1),
(57, 0, 93, '45a5d5849994c2393ee6b43da5051f7ec24c0d645acc0f522cd528c4dd522877300a3f6b759762549c78db0c8bb0c543', 15, 0),
(61, 0, 97, 'ee97849480bf0bffdae0f41d06d3f73ae5f225f3899fa8e78eaef5176a77eee792c4ced14793d65c1899c2f046bf7653', 15, 0);

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `prenom` char(50) NOT NULL,
  `nom` char(50) NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL,
  `url_pdp` int(11) DEFAULT NULL,
  `promo` int(11) DEFAULT NULL,
  `pseudo_cas` char(40) DEFAULT NULL,
  `permissions` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id_user`, `prenom`, `nom`, `pass`, `email`, `url_pdp`, `promo`, `pseudo_cas`, `permissions`) VALUES
(1, 'Martin', 'Joly', '$2y$10$LGd7x8.QgFxvHYYVNV8JLupkEq39DQckZqfbyC.U2Zlu4QyjkRvje', 'email@martin.fr', NULL, NULL, NULL, 0),
(2, 'Martin', 'Joly', '$2y$10$zwYtqqxfNs630XcKa9YfGu60Mu.yFSBCkvlO1Fj6WT5g9/oVHM9AK', 'admin@martin.fr', NULL, 1, NULL, 1),
(3, 'Riad', 'Zoubiri', '$2y$10$mNFvzuQ.9w1KN7UHFpRzKulrQCeC1llevrDM7yv1F8spz4M0kOBpK', 'riad.zoubiri@maroc.fr', NULL, 1, NULL, 0),
(4, 'Ayman', 'Oussama', 'Sample', 'ayman.ou@gmail.com', NULL, 1, NULL, 0),
(5, 'Estelle', 'Remy', '$2y$10$4MHlf8yvDT9NLznExQmaOuHJTHSynsV6/kXAS4Wio4TLLsHvQTJGu', 'estelle.remy@ig2i.centralelille.fr', NULL, 1, NULL, 0),
(6, 'Rémi', 'Lefort', '$2y$10$v7n4JYuqx4qKzT/DbjzeMu4EuxNE69QuAdGHXWBPExfqIK5KHundy', 'remi.lefort@ig2i.fr', NULL, 3, NULL, 0),
(8, 'Rémi', 'Lefort', '$2y$10$8l6SzaY5xy.e8GMm0XJWPujDHZI3E5heZavBOSB6rS4N/KIwtgUKa', 'remi@ig2i.fr', NULL, 3, NULL, 0),
(9, 'Léandre', 'Carpentier', '$2y$10$v1E1Y/CKQZ.7HOa9rz.TDOqr7XCjFKa6ojZT/dMgviF3RLDJjkqjq', 'leandre@ig2i.fr', NULL, 1, NULL, 0),
(10, 'Hadrien', 'Belcourt', '$2y$10$QxNCjELfmld3h06JIcX4AOpzwVnqeX9A.6p5EkHFTlb9E/WLLqWy6', 'gtgtgtgtgtgtgtgtgt@gmail.com', NULL, 1, NULL, 0),
(11, 'Riad', 'Zoubiri', '$2y$10$AeveJmx1Pma3l2y3e8csTuhzWksTYDKvpuncusinnLkTnONeKWq3G', 'riadzoubiri@outlook.com', NULL, 1, NULL, 0),
(12, 'Thomas', 'Martin', '$2y$10$GbHZ0lTQ8EqnE87TVM683u8f3ASxBNTr8Mvjtx978NmB4Zh0zmmtK', 'thomas9896@hotmail.fr', NULL, 1, NULL, 0),
(13, 'Julien', 'Lammens', '$2y$10$Gko9agiPpMoe4wMODHXWSOPlzKmL/n0szILqSja6u.RRB0IIwBgOu', 'julammens@gmail.com', NULL, 1, NULL, 0),
(14, 'Test', 'Test', '$2y$10$YgNUE4yMYz2zQdKxCzboT.U90TWywv2A3iGy0jkzQxrUagAdKayOq', 'martin@martine.fr', NULL, 1, NULL, 0),
(15, 'Admin', 'L2', '$2y$10$NW7eaVAXagEBEKDxxHFpG.KPYNJY1/Mjwm6JwvGzPpb3aFjJADxkO', 'admin@l2.fr', NULL, 2, NULL, 1),
(82, 'test5', 'add', '$2y$10$1gWjxbjsIS96kYq1Vo5TiOJhBpwVV0JIr/QvsLxMLPO7ytEYxF0C2', 'add@gmail.com', NULL, 1, NULL, 0),
(86, 'Théo', 'Gaillard', '$2y$10$g2dlIjs4uV2Sj7gKjTZwlO69J6dMpcgZBKZgb/1YMBOGGQCxaAGle', 'theo.gaillard@ig2i.fr', NULL, 1, NULL, 0),
(89, 'Allan', 'Corriere', 'Not initialized.', 'allan.corriere@ig2i.centralelille.fr', NULL, 1, NULL, 0),
(90, 'Hugo', 'Maisonneuve', 'Not initialized.', 'hugo.maisonneuve@ig2i.centralelille.fr', NULL, 1, NULL, 0),
(91, 'annouck', 'masson', 'Not initialized.', 'annouckmasson@gmail.com', NULL, 1, NULL, 0),
(92, 'Axel', 'Masse', '$2y$10$SZfiq5ELIJKk/YgAR6l.2OhTlktGXpT3RGklz9VSQYFyC8Zlp3yLS', 'axelmasse@ig2i.fr', NULL, 1, NULL, 0),
(93, 'Timothée', 'Malaquin', 'Not initialized.', 'timalak@gmail.com', NULL, 1, NULL, 0),
(94, 'Landry', 'Monga', 'Not initialized.', 'landry@gmail.com', NULL, 1, NULL, 0),
(95, 'Paul', 'Klak', 'Not initialized.', 'paulklak@ig2i.fr', NULL, 1, NULL, 0),
(97, 'Monprenom', 'Monnom', 'Not initialized.', 'martin.joly@ig2i.centralelille.fr', NULL, 1, NULL, 0),
(98, 'Test', 'Mail', '$2y$10$iTOa1xQFV/6e/McAtSNnCOJLMxpikRL0pk4Oe9XsjdDbk2uOc3skm', 'martin.joly@ig2i.ec-lille.fr', NULL, 1, NULL, 0);

CREATE TABLE `vues` (
  `id_vue` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `vues` (`id_vue`, `id_doc`, `id_user`, `count`) VALUES
(9, 7, 13, 1),
(10, 9, 13, 1),
(11, 3, 13, 1),
(12, 12, 13, 3),
(13, 13, 13, 1),
(14, 14, 13, 1),
(15, 15, 13, 2),
(16, 15, 11, 1),
(17, 15, 2, 71),
(18, 14, 2, 9),
(19, 16, 2, 1),
(20, 7, 2, 119),
(21, 18, 2, 74),
(22, 19, 2, 3),
(23, 3, 2, 35),
(24, 12, 2, 4),
(25, 20, 2, 1),
(26, 4, 2, 5),
(27, 18, 15, 28),
(28, 15, 15, 1),
(29, 14, 15, 1),
(30, 3, 15, 2),
(31, 18, 98, 35),
(32, 12, 98, 5),
(33, 10, 98, 8);


ALTER TABLE `chapitres`
  ADD PRIMARY KEY (`id_chapitre`);

ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_com`);

ALTER TABLE `connexions`
  ADD PRIMARY KEY (`id_connexion`);

ALTER TABLE `documents`
  ADD PRIMARY KEY (`id_doc`);

ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`);

ALTER TABLE `matieres`
  ADD PRIMARY KEY (`id_matiere`);

ALTER TABLE `promos`
  ADD PRIMARY KEY (`id_promo`);

ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

ALTER TABLE `vues`
  ADD PRIMARY KEY (`id_vue`);


ALTER TABLE `chapitres`
  MODIFY `id_chapitre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
ALTER TABLE `comments`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
ALTER TABLE `connexions`
  MODIFY `id_connexion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
ALTER TABLE `documents`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
ALTER TABLE `matieres`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
ALTER TABLE `promos`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
ALTER TABLE `vues`
  MODIFY `id_vue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;