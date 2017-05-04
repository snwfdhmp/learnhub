-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Jeu 04 Mai 2017 à 11:06
-- Version du serveur :  5.6.28
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `ICS`
--

-- --------------------------------------------------------

--
-- Structure de la table `chapitres`
--

CREATE TABLE `chapitres` (
  `id_chapitre` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL,
  `nom` char(50) NOT NULL,
  `rang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `chapitres`
--

INSERT INTO `chapitres` (`id_chapitre`, `id_matiere`, `nom`, `rang`) VALUES
(1, 1, 'Nombres complexes', 1),
(2, 1, 'Etude de fonctions', 3),
(3, 1, 'Trigonométrie', 2),
(4, 1, 'Développements Limités', 5),
(5, 1, 'Equations différentielles', 6);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id_com` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id_com`, `id_auteur`, `id_doc`, `contenu`, `date_creation`) VALUES
(1, 2, 1, 'Super TD !', '2017-05-04'),
(3, 3, 1, 'Oui, j\'adore !', NULL),
(4, 4, 1, 'Cool !', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `connexions`
--

CREATE TABLE `connexions` (
  `id_connexion` int(11) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `last_ip` char(20) NOT NULL,
  `last_ping` char(30) NOT NULL,
  `session_cookie` char(168) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `connexions`
--

INSERT INTO `connexions` (`id_connexion`, `id_user`, `last_ip`, `last_ping`, `session_cookie`) VALUES
(878, 1, '::1', '1493039409', '61dc5d70a00929e4e2ce14f56ce4903009ccd0cf87d344c30583455ae9a03267db1fcaa8dc6ee85e28c6637feee0fccdbd986ab7d708e62010222e45831d2314'),
(879, 1, '::1', '1493039590', '01ea3b610bc161f8fdd50d07d98c30c9c463383c50ab56671ff32e92a4a2ab4cc4fe4b6d2d01263cdc9d98de71087597b3f5ba1b55fba196e78d47bc7b254745'),
(880, 1, '::1', '1493039648', 'ab488f95fb891bfb98754f331b270a0329c3edf73a63bc1e3744cda475aa09be74e4fec782f241f01ba8d63663bcfe95a9ad92c0858885882ed74cbc6f14ba10'),
(881, 2, '::1', '1493793981', '2a235d165dbf74824aa8f9df05c1c86371483f1b4f5b3784192afb7ad9214f5af20740c5226d7095e0684dd77eca88b800228cad7a06bab5843bcad1fd212261'),
(882, 2, '::1', '1493793990', 'c76b990ea5676b7d2a6a5059f2a1a8bc4b5ddbc3c7ae3922f4bb3aa2b38fed31868c386b2de93a9d5a18f898c6337b5522f819e8d1247e65224c6a73bc2f722c'),
(883, 2, '::1', '1493794136', '1d7436a2d0be5ba8da00ec321473b7a78db75939cf764291235d62f5c52fcfc40165cb1a3a0de0a00082d0c7416c7021be89e403784ec87e4a4562b06b8122ed'),
(884, 2, '::1', '1493794379', 'fdad24ed289c2bbf3d6cba461ece8931cffdc1c361c43f37b713301d9e3eaf862d5a1fed9e02e0f5fb023acbc427de3c789a35f10d1536e9c6b3d0b11f28a1a0'),
(885, 2, '::1', '1493795654', '29cb62261ae764cf09257245d23df28c92437e5b1be2981757438e8ed0fd7668442e29bd3de5b4677591be728ff3fb20101731545d5b520aee9044a5ad5e291a'),
(886, 2, '::1', '1493795667', '1edb426111209dd93d31202b289b09c0f95f7bd10d138c6fa2d7c02110e0695b2e110f2f3f241f6a5f3891f10ef434c31ce99aa1b6b3000ca31bcd1a05d1cd46'),
(887, 2, '::1', '1493795814', '49f2a0787e7fa017d7aef06e98c77bede5df01eed5bca2d0ca33af3ef0860cb7ef522c2662d882b4eb691f112a2056ffdf270a5cc8c15b78771ddc6778c87226'),
(888, 2, '::1', '1493795842', '11386cf70de627dd63ecbc2b7539e46218df7fbb667e6a05caaeb8859dca1d68d15cef2cbebd009a4e34bc298131fcea755f08b0a0bfb9f5a5424d90847a6a3d'),
(889, 2, '::1', '1493795862', '73caf588e6a582b9078c1f899623ac588b84fd420b2956ded070e6b3e2228284d2c9e71a3a43cd95678cd9f0c6be4414fbac66188215f530221424fb99135aa8'),
(890, 2, '::1', '1493795881', '1c81be3130cebb4046c818f04a4df4e69e43cff8ef917f7c5c2be5ec583a4730b5e100f184f9f6f4cba13539f68212eace58f9f413cc519b6703812c393513ec'),
(891, 2, '::1', '1493796006', '201caddd5f36680ff44447da572e722df925f18cd5f5d5efc5e4ca1b5a51d817f4b03ee9616b28d653328bbb19de1d3fd091eca2ceee435553563d5a9ade35da'),
(892, 2, '::1', '1493796037', 'dc73746f84685ba39ee2ab1fbaaebf1a6ca8265bcaac63409a076dfe14e86a154e45cb67bd2536a608573275ab9b3950dedf54ed6053327647f545afb846b3f2'),
(893, 2, '::1', '1493796110', '8b1169d97682006ba1b07bd4e067cbdcdb7cb982b4b50e788c0896508f60fdbfe2b62c153de7ff1b827719c97e3745e4e084f0bdc190f0531654074bc61a971b'),
(894, 2, '::1', '1493796134', '5f72ebcabb642c6fe68122ced274968635826c2821866cfffb7c443602164719333f345e627d31fec8212ad8d2d660b3c196166669651dae44c9ef78f37d12a9'),
(895, 2, '::1', '1493796335', 'f547583ff079691e4f9ede60e59c0daf34cd257985c5f2553311b393727af4dced4e6c6e684d817a95965e81fba9cdc470bc9b548f91c48504837059d8cc2e37'),
(896, 2, '::1', '1493796444', '3a9a58833463403bd1795ccb0db6567beacf55c920a8e1909e281f73d72617c4f7f609f77e2b5c109b2ac785f715eb3bcb468728f5ff048d21f6c4eca1304206'),
(897, 2, '::1', '1493796630', '0e727a0000a9aa603f87e2b54fd6002cec6c2fad2edc22890f142908a3095a62ed1f01f15fe26febc51007a310877fefeecf92aefcec653e082f839b05005d3d'),
(898, 2, '::1', '1493796822', '7e02d0fe138de3ef9ffc9266c26bea9a650c8ff64f2fa96102082c273fc41e60e5a9db0ae5aa3b74a5d758e4bd86709d4a37249299d5d3798b38b4f70a372711'),
(899, 2, '::1', '1493797163', 'e4c37a992a36c303d3ed934994afb6c151bf49870d4f69a2e7c0c54ef70bf533a52545039ba147538cba34d617f43ff999214c6382d461cba801e9cf151a9d70'),
(900, 2, '::1', '1493797203', 'ba3b97ef085f0ae64e4f0f248cc533d7ed3abb90f800f649583dd5a297ecd486ec519c85530b67b2a0547da214baa41b304ef3fe02edcebbd3e3e64068cf1606'),
(901, 2, '::1', '1493797234', 'cd2cd90d8ef93ec9a2a1e25151012bb33137420c8b80bd9f520b4abcb497d7455e84b94e790552f3bba73290435c58f29e3529ed4e4e79e399085df67dbd2fe5'),
(902, 2, '::1', '1493823442', '9ddd2929dac752665248c717b4a277d368f41fd5bd423b656a142eb7bfa3c48dc7062a5a36cb7207070f5c2209d653df8200245464f039a6eaf17f41041823a4'),
(903, 2, '::1', '1493823467', 'd2a6ceb02868ab70de73a5660d66bb3ece62b0c54aec0ab5fb1104572c75f2e5ce7344a869188d8fa32a06990bf926ae961277ed949346ff0344502bd3d88bcc'),
(904, 2, '::1', '1493823471', '224a791f608ab7ccfa0c6ef90a23aafa64d374e6d1f50128af7f8a3da3d676cfc4c1bef8fad63315420514efea3c864870290035ca69b99e920f46f8b6919a38'),
(905, 2, '::1', '1493823518', 'ffc67b6822fb920e53b0f19924504ff58ecf82ca6b0e4de56358d96863b3cead72d7a6737810ef480d6161531499f741465d25be37431785bcc637a204c24334'),
(906, 2, '::1', '1493823521', 'e682cc3a2cafd9920ebcb6d0c99a933ca260b67cb2e4d7c780af55800368499eff0a7583a59756d70abeaef463c0b552635ccda7c12fd6a0bed8c12bcdf026dc'),
(907, 2, '::1', '1493823523', '707aa301a5bc7edde6b0c568c1698f5958e3f295376a6fb41c82eaec21ed26dafcc5efd094b7e1d15201f6baa6e408e09d0883d8f218b5f5188a7ac34a13118b'),
(908, 2, '::1', '1493823536', '97e782582deae331a57fbd11f614ecff01e1dd877ad43f4e600535a1b1698354b857179de2714fe59a5aad618330e2024f8d9bf041767cd5bd0f78e000c9f50f'),
(909, 2, '::1', '1493823538', 'abf62faf472e24850671fa43487c72d41a3ff00a482ddd88550fd3a3c751541cb1fdd85aa6db545ad4c7238d72a7526933e3ac3a7b92c8ac80fde4595c12c144'),
(910, 2, '::1', '1493823547', '6af8ef9dfdcfbacd07f9b6c58a385d6115814a18f87d00937189b1490c328714ba4aef74996e91bd518c5ae1c6ba87680f7854b3a1ea487c37d0febf17f49dff'),
(911, 2, '::1', '1493823553', 'e0bbfd705ea9da5f1d6eb10a4144104ac00b8104286d811d0d5fac2bd20915d2e8291e75f5742b34a3e9f2608e96dbb386d410b66885887d44a2b8f15e228873'),
(912, 2, '::1', '1493823556', '94927846add47251e5b6f124e62b915eebc83a661b64e6349cb1e040e787e63f1eb29df13c87197ee774eb8fcca854a66f61770b8c40776dd858ce56d3071f32'),
(913, 2, '::1', '1493823628', '644b2ed2d8215d7f5e612359b53d01e02024d4b143e4cf91e3ab0c4794114755e7a1165c467b22d5f239aedf54420f5f46be3481be4591d1dc74d7d32635f032'),
(914, 2, '::1', '1493823631', '64506a300f4fd92f3a282b2ee6c4054134c0317767ae5f27930e377d273325bc48f2af794348783a037f9dcbdbee04510237f975c134d06b489e4a06f9015bc2'),
(915, 2, '::1', '1493823633', 'dd4ec8b2c49bca7fc18a7ee6acac4d2c38be114a127fe47f8a498921bde0437ed2d5aa00cbe0b81cf118605ca63f044441be4b416f1598c97b5978ddf5af856b'),
(916, 2, '::1', '1493823636', 'abdd0752c7257cc33a11fcea6c0a816751ef92920f7f0b4f59712684ec2dad66367c0a7331d1fbc166bd45048e47a60f61585f7cfb8bd6c16d05fabc65dc99e5'),
(917, 2, '::1', '1493823638', '2600dda52b5493ebc8e70e5be0b65db732f84f62e57b49657858d19d923c67912f7657189c4e15e57fc7fe9396b55bf14be902e28f2ef7c8d91ba5a553e2fa80'),
(918, 2, '::1', '1493823778', 'e453e27d93d0d6ea536ca22c99b2c3b03edd7947d60e3beb762fad3b05b39f60c780f645ee95e4e7a5b8f5f2d3b309859c340ee741b7e43a4278aa2d961f781b'),
(919, 2, '::1', '1493823873', '9041c65725d1c1b5decf4a1f1258b785c9ae5ac1ab1f9be952663eb9c91bcbfcb6c0e81994cd152d94fc5f616bc608b6f02dd5e3afc1b349a74b0382e9dc3ca1'),
(920, 2, '::1', '1493823876', 'd92d24f0f9e7081f6905861a5a3e36400e1d02b7d38718f1bcdd17074adc18dfbd780052b1ca3935ae74fb55a289f003f06b1ed324ff4f34a7529832437ca437'),
(921, 2, '::1', '1493824057', '5d26923ad7cb6a809dbf45cb2360d9f81f673ec50563bce9301c5bcbd44d693b1bf6216bf1221b04e89c942cb159fcb0d19480920c65e54b7f4e4f99e3c93fe1'),
(922, 2, '::1', '1493837058', 'ef3bdad8c207bef654043d8797054c166147a883e8f7ab05490b419caed08b59fef94f1eec6fa28ed7446ed27ba1b7b98b99751a7964b6e3e981f7c9cce9fc5d'),
(923, 2, '::1', '1493847506', 'dc657ff975858d561be724390957230b339d9ee3589eb1c84f55a585b83b19988471c73102d3f5db18a01cf552a5851f3b2a7f68a96084e7fa88b58dad6142cd'),
(924, 2, '::1', '1493850279', '6fa33f746604eeb9872c1fa8757b095ca8c1548dcc682daf37e91ed726fc954d92a734493f398a146ae18a714dcd1dfe51efb74ecb596979d0deaff8f34cbe36'),
(925, 2, '::1', '1493852927', '5de52fbe4afc2f00da394ef6cbd69dc56ddd0c861031af36c09290d2ff74420d301d9b5cc15306e292c2fdd8f5eb7de1cc3508059f9750bd422e8bf7931a8dac'),
(926, 2, '::1', '1493853515', '47660acdbb10e847b35ef3e55b4edc4e011d754a3719423e6da4ba1e354d1727af7269e21c9f7703b335d96580ea5dba11b2fd1d3ea37a0573b362599803f8d4'),
(927, 2, '::1', '1493878384', 'f0d482595440ff3985754d25330910193c46f83c30e6ba9376557177958b892894d89b1ad1342f1829c353c311d05b07ef33ba9faaf2a2991d36613419abd3e1'),
(928, 2, '::1', '1493882049', 'c74b7569d1ce57bae9336e3d0c8dc638dde46cf9e2a3953ed1cf25c76c9c2664e0d522a6f3084da0c4f486a0052da3815d5bf0f2e714c20af6e285c59b0d5852'),
(929, 2, '::1', '1493884159', 'c92e8ff863f211dc9f54a7ba632bd1ff904b2a193c40a38b62c37c842fe372e3a477437d910dc71a6431cc7c1c69e8f6d92111618bf080d932dead9a645b06aa'),
(930, 2, '::1', '1493887801', 'b6137972181228f0635fe7d27c9058d56f7fec712ca855598c3bca3fbf2640ffb8e60218a40d3fa4a7519baf0614b06e3d8e6627884cc2ffeee2d7b1480b5903');

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE `documents` (
  `id_doc` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `id_chapitre` int(11) NOT NULL,
  `doc_type` int(11) NOT NULL,
  `nom` char(50) NOT NULL,
  `url` char(200) NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `documents`
--

INSERT INTO `documents` (`id_doc`, `id_auteur`, `id_chapitre`, `doc_type`, `nom`, `url`, `date_creation`) VALUES
(1, 2, 1, 1, 'TD n°4 Nombres complexes', '#', '2017-05-03'),
(2, 2, 1, 1, 'TD n°3 Nombres complexes', '#', '2017-05-03');

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE `matieres` (
  `id_matiere` int(11) NOT NULL,
  `nom_matiere` char(50) NOT NULL,
  `diminutif` char(8) NOT NULL,
  `promo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `matieres`
--

INSERT INTO `matieres` (`id_matiere`, `nom_matiere`, `diminutif`, `promo`) VALUES
(1, 'Maths : Algèbre et Analyse', 'MATHS', 1),
(2, 'Mécanique', 'MECA', 1),
(3, 'Anglais', 'LV1', 2),
(4, 'Système de données et applications', 'SDA', 1),
(5, 'Système de données et applications', 'SDA', 2),
(6, 'Création d\'entreprise', 'CREA', 4),
(7, 'Physique', 'PHY', 6),
(8, 'Intelligence Artificielle', 'IA', 6),
(9, 'Intelligence Artificielle', 'IA', 4),
(10, 'Intelligence Artificielle', 'IA', 3),
(11, 'Marketing', 'MARKET', 1),
(12, 'Electricité Générale', 'ELG', 1),
(13, 'Initiation aux Systèmes d\'Exploitation et Réseaux', 'ISER', 1),
(14, 'Programmation Orienté Objet', 'POO', 2);

-- --------------------------------------------------------

--
-- Structure de la table `promos`
--

CREATE TABLE `promos` (
  `id_promo` int(11) NOT NULL,
  `nom` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `promos`
--

INSERT INTO `promos` (`id_promo`, `nom`) VALUES
(1, 'LE1'),
(2, 'LE2'),
(3, 'LE3'),
(4, 'LE4'),
(5, 'LE5'),
(6, 'LA1'),
(7, 'LA2'),
(8, 'LA3');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `recent connexions`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `recent connexions` (
);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `prenom` char(50) NOT NULL,
  `nom` char(50) NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL,
  `url_pdp` int(11) DEFAULT NULL,
  `promo` int(11) DEFAULT NULL,
  `pseudo_cas` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `prenom`, `nom`, `pass`, `email`, `url_pdp`, `promo`, `pseudo_cas`) VALUES
(1, 'Martin', 'Joly', '$2y$10$LGd7x8.QgFxvHYYVNV8JLupkEq39DQckZqfbyC.U2Zlu4QyjkRvje', 'email@martin.fr', NULL, NULL, NULL),
(2, 'Martin', 'Joly', '$2y$10$zwYtqqxfNs630XcKa9YfGu60Mu.yFSBCkvlO1Fj6WT5g9/oVHM9AK', 'admin@martin.fr', NULL, 1, NULL),
(3, 'Riad', 'Zoubiri', '$2y$10$mNFvzuQ.9w1KN7UHFpRzKulrQCeC1llevrDM7yv1F8spz4M0kOBpK', 'riad.zoubiri@maroc.fr', NULL, 1, NULL),
(4, 'Ayman', 'Oussama', 'Sample', 'ayman.ou@gmail.com', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la vue `recent connexions`
--
DROP TABLE IF EXISTS `recent connexions`;
-- utilisé(#1356 - View 'ics.recent connexions' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chapitres`
--
ALTER TABLE `chapitres`
  ADD PRIMARY KEY (`id_chapitre`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_com`);

--
-- Index pour la table `connexions`
--
ALTER TABLE `connexions`
  ADD PRIMARY KEY (`id_connexion`);

--
-- Index pour la table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id_doc`);

--
-- Index pour la table `matieres`
--
ALTER TABLE `matieres`
  ADD PRIMARY KEY (`id_matiere`);

--
-- Index pour la table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id_promo`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `chapitres`
--
ALTER TABLE `chapitres`
  MODIFY `id_chapitre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `connexions`
--
ALTER TABLE `connexions`
  MODIFY `id_connexion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=931;
--
-- AUTO_INCREMENT pour la table `documents`
--
ALTER TABLE `documents`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `matieres`
--
ALTER TABLE `matieres`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `promos`
--
ALTER TABLE `promos`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;