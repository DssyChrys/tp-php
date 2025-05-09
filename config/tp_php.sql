-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 09 mai 2025 à 04:33
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tp_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `binomes`
--

CREATE TABLE `binomes` (
  `id` int(11) NOT NULL,
  `etudiant_id` int(11) NOT NULL,
  `enseignant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

CREATE TABLE `enseignants` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `domaines` varchar(100) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignants`
--

INSERT INTO `enseignants` (`id`, `nom`, `domaines`, `role`) VALUES
(1, 'agbo', '[\"AL\",\"SI\"]', 'user'),
(2, 'samuel', '[\"SI\"]', 'user');

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `binome_id` int(11) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `nom`, `email`, `password`, `binome_id`, `role`) VALUES
(1, 'chrys', 'chrys@mail.test', '$2y$10$Z7UzKXrBAzBkReVpGnTtd.cGVqCLOEDLevoBFTgwRVzPLokB41Tx.', NULL, 'admin'),
(3, 'test', 'test@mail.test', '$2y$10$qiJVJUdLKeXjs94excAr2.5xnBeq2.opDMxd8/IkIfjarXM54ly1e', NULL, 'user'),
(4, 'test2', 'test2@mail.test', '$2y$10$aHG0TMoGZNUk82CL9FQjk.n.FrPx7l.H0Kam2O3Gue.JF0HvArtt.', NULL, 'user'),
(5, 'test3', 'test3@mail.test', '$2y$10$2Z4dzIP4qDFJX3VzbKbZQ.qqWcSJ/nsoNJxzIB11A8eAufg3Ldsa6', NULL, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id` int(11) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `etudiant_id` int(11) NOT NULL,
  `binome_id` int(11) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `enseignant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id`, `theme`, `etudiant_id`, `binome_id`, `filiere`, `enseignant_id`) VALUES
(1, 'digitalisation', 1, 5, 'src', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `binomes`
--
ALTER TABLE `binomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enseignant_id` (`enseignant_id`),
  ADD KEY `etudiant_id` (`etudiant_id`);

--
-- Index pour la table `enseignants`
--
ALTER TABLE `enseignants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `binome_id` (`binome_id`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etudiant_id` (`etudiant_id`),
  ADD KEY `binome_id` (`binome_id`),
  ADD KEY `fk_encadreur` (`enseignant_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `binomes`
--
ALTER TABLE `binomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enseignants`
--
ALTER TABLE `enseignants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `binomes`
--
ALTER TABLE `binomes`
  ADD CONSTRAINT `binomes_ibfk_1` FOREIGN KEY (`enseignant_id`) REFERENCES `enseignants` (`id`),
  ADD CONSTRAINT `binomes_ibfk_2` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`);

--
-- Contraintes pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD CONSTRAINT `etudiants_ibfk_1` FOREIGN KEY (`binome_id`) REFERENCES `binomes` (`id`);

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `fk_encadreur` FOREIGN KEY (`enseignant_id`) REFERENCES `enseignants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projets_ibfk_1` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`),
  ADD CONSTRAINT `projets_ibfk_2` FOREIGN KEY (`binome_id`) REFERENCES `etudiants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
