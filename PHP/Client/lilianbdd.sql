-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 01 avr. 2024 à 09:41
-- Version du serveur : 5.7.36
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user1_id` (`user1_id`),
  KEY `user2_id` (`user2_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id`, `user1_id`, `user2_id`) VALUES
(6, 1, 3),
(5, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'pablo', '$2y$10$46mDS9S0NpnlJ6/k81tnWuMuMOitJ6r4ASfppd/RZ0wX4vlQL0IDC'),
(2, 'test', '$2y$10$KOPXjhCbu..bD2qJY3iWQemOySyUyUZG8sacIVawdbAZ.ycX1hPy6'),
(3, 'salut', '$2y$10$2ZU6F6RavI4viOm5L3ass.4LhK7W0tetrCOtnI/PVuNGymjGkLXSW'),
(4, '123456789', '$2y$10$4tdM.b0MM9wHXZedkp1oROYEAKstJJzyFKdyqREUVqrFAwoQkUIVe'),
(5, 'salut123456789', '$2y$10$l787CoOYIOUNdZc2h.v6POdnSC3JezYHtddn7LHsnM105ZZm6NPa2');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `receiver_id`, `message`, `timestamp`) VALUES
(27, 5, 2, 1, 'vervr', '2024-04-01 07:12:00'),
(26, 5, 2, 1, 'vrevrv', '2024-04-01 07:11:58'),
(25, 5, 2, 1, 'vervev', '2024-04-01 07:11:56'),
(24, 5, 2, 1, 'regvv', '2024-04-01 07:11:54'),
(23, 5, 2, 1, 'zgvzrrv', '2024-04-01 07:11:45'),
(22, 5, 2, 1, 'qervr\r\nrqver\r\n\r\nrv', '2024-04-01 07:02:39'),
(21, 5, 2, 1, 'test4\r\n', '2024-04-01 07:02:30'),
(20, 5, 1, 2, 'test3', '2024-04-01 07:01:18'),
(19, 6, 1, 3, 'vqzrvq', '2024-04-01 07:01:12'),
(18, 6, 1, 3, 'sqvr', '2024-04-01 07:00:00'),
(17, 5, 2, 1, 'test2', '2024-04-01 06:53:37'),
(16, 5, 1, 2, 'test1', '2024-04-01 06:52:39'),
(28, 5, 2, 1, 'erver', '2024-04-01 07:12:02'),
(29, 5, 2, 1, 'bonjour', '2024-04-01 07:15:43'),
(30, 5, 2, 1, 'ererb', '2024-04-01 07:29:19'),
(31, 5, 2, 1, 'beberbbbr', '2024-04-01 07:29:21');

-- --------------------------------------------------------

--
-- Structure de la table `serveurs_messages`
--

DROP TABLE IF EXISTS `serveurs_messages`;
CREATE TABLE IF NOT EXISTS `serveurs_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `other_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_users` (`user_id`,`other_user_id`),
  KEY `other_user_id` (`other_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `serveurs_messages`
--

INSERT INTO `serveurs_messages` (`id`, `user_id`, `other_user_id`) VALUES
(9, 1, 1),
(8, 1, 2),
(7, 1, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
