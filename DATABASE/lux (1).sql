-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 19 Décembre 2017 à 12:39
-- Version du serveur :  10.1.8-MariaDB
-- Version de PHP :  5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lux`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `art_id` int(11) NOT NULL,
  `art_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `art_price` float NOT NULL,
  `art_description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `art_categorie` varchar(50) CHARACTER SET utf8 NOT NULL,
  `art_picture` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `art_sold` int(1) NOT NULL,
  `art_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `art_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`art_id`, `art_title`, `art_price`, `art_description`, `art_categorie`, `art_picture`, `art_sold`, `art_timestamp`, `art_user_id`) VALUES
(1, 'dd', 10, 'ddd', 'Informatique', '', 0, '2017-12-18 14:07:56', 0),
(2, 'yrtgytrubty', 34, 'bÃ¨yrinÃ¨Â§no', 'Informatique', '', 0, '2017-12-18 14:08:23', 0),
(3, 'YRB6', 66, '67I76', 'Informatique', '', 0, '2017-12-19 11:10:16', 0);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `cat_id` int(11) NOT NULL,
  `cat_name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `cat_picture` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cat_description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `cat_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `cat_art_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `label` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `label`) VALUES
(1, 'ROLE_USER'),
(2, 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `usr_id` int(11) NOT NULL,
  `usr_firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `usr_lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `usr_birthday` date NOT NULL,
  `usr_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usr_telephone` int(30) NOT NULL,
  `usr_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `usr_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usr_number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `usr_street` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `usr_city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usr_zip` int(8) NOT NULL,
  `usr_country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usr_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`usr_id`, `usr_firstname`, `usr_lastname`, `usr_birthday`, `usr_email`, `usr_telephone`, `usr_name`, `usr_password`, `usr_number`, `usr_street`, `usr_city`, `usr_zip`, `usr_country`, `usr_update`) VALUES
(1, 'Michel', 'Ginsbach', '1965-12-05', 'sputniklu@gmail.com', 123456789, 'michel', 'michel', '109', 'rue Victor Hugo', 'Esch Alzette', 4141, 'Luxembourg', '2017-12-13 13:18:44'),
(2, 'Pierre', 'Muller', '1975-12-20', 'pierre@gmail.com', 321456, 'pierre', 'pierre', '32', 'rue Schrobigen', 'Luxembourg', 4158, 'Luxembourg', '2017-12-13 13:20:09'),
(3, 'Laureen', 'FranÃ§ois', '0000-00-00', 'francois.laureen@gmail.com', 621740573, 'Pixel', 'silex', '17', 'am flouer', 'Steinheim', 6587, 'Luxembourg', '2017-12-19 10:51:11'),
(4, 'Laureen', 'FranÃ§ois', '0000-00-00', 'francois.laureen@gmail.com', 621740573, 'Pixel', 'silex', '17', 'am flouer', 'Steinheim', 6587, 'Luxembourg', '2017-12-19 10:51:27');

-- --------------------------------------------------------

--
-- Structure de la table `users_roles`
--

CREATE TABLE `users_roles` (
  `use_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users_roles`
--

INSERT INTO `users_roles` (`use_id`, `role_id`) VALUES
(1, 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`art_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`usr_id`);

--
-- Index pour la table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`use_id`,`role_id`),
  ADD KEY `user_id` (`use_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
