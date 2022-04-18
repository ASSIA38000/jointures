-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 18 avr. 2022 à 15:13
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test-mcd`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES
(1, 'livres'),
(2, 'pc');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_commentaire` varchar(255) NOT NULL,
  PRIMARY KEY (`id_commentaire`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `contenu_commentaire`) VALUES
(1, 'produit non conforme'),
(2, 'nombreux retours --> ne plus commander');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fournisseur` varchar(255) NOT NULL,
  `tel_fournisseur` int(20) NOT NULL,
  `mail_fournisseur` varchar(255) NOT NULL,
  `ville_fournisseur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_fournisseur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id_fournisseur`, `nom_fournisseur`, `tel_fournisseur`, `mail_fournisseur`, `ville_fournisseur`) VALUES
(1, 'prune', 61548978, 'prune@citron.com', 'Grenoble'),
(2, 'rummy', 978745878, 'brunette@aol.fr', 'Crolles'),
(3, 'farinn', 978745878, 'sheriff@aol.com', 'Grenoble');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(255) NOT NULL,
  `description_produit` text NOT NULL,
  `prix_produit` float(6,2) NOT NULL,
  `stock_produit` tinyint(1) NOT NULL,
  `image_produit` varchar(255) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `vendeur_id` int(11) NOT NULL,
  `commentaire_id` int(11) NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `categorie_id` (`categorie_id`),
  KEY `fournisseur_id` (`vendeur_id`),
  KEY `commentaire_id` (`commentaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom_produit`, `description_produit`, `prix_produit`, `stock_produit`, `image_produit`, `categorie_id`, `vendeur_id`, `commentaire_id`) VALUES
(1, 'C# 10 and .NET 6', 'Modern Cross-Platform Development: Build apps, websites, and services with ASP.NET Core 6, Blazor, and EF Core 6 using Visual Studio 2022 and Visual Studio Code, 6th Edition', 47.43, 1, '..\\assets\\img\\livre-1.png', 1, 2, 1),
(2, 'Programmer en langage C', 'Cours et exercices corrigés. Broché – Livre grand format', 18.00, 1, '..\\assets\\img\\livre-2.png', 2, 1, 1),
(3, 'C# 10 and .NET 6', 'Modern Cross-Platform Development: Build apps, websites, and services with ASP.NET Core 6, Blazor, and EF Core 6 using Visual Studio 2022 and Visual Studio Code, 6th Edition', 47.43, 1, '..\\assets\\img\\livre-1.png', 1, 2, 2),
(4, 'Programmer en langage C', 'Cours et exercices corrigés. Broché – Livre grand format', 18.00, 1, '..\\assets\\img\\livre-2.png', 2, 3, 1),
(5, 'Algorithmique - Techniques fondamentales de programmation', 'Exemples en Python (nombreux exercices corrigés) - BTS, DUT informatique (2e édition) Broché – Livre grand format', 29.90, 1, '..\\assets\\img\\livre-3.png', 1, 1, 2),
(6, 'C# 11 and .NET 7', 'Modern Cross-Platform Development: Build apps, websites, and services with ASP.NET Core 6, Blazor, and EF Core 6 using Visual Studio 2022 and Visual Studio Code, 1st Edition!!!', 250.00, 1, '..\\assets\\img\\livre-1.png', 1, 1, 2),
(7, 'Algorithmique - Techniques fondamentales de programmation', 'Exemples en Python (nombreux exercices corrigés) - BTS, DUT informatique (2e édition) Broché – Livre grand format', 29.90, 1, '..\\assets\\img\\livre-3.png', 2, 3, 1),
(8, 'C# 11 and .NET 7', 'Modern Cross-Platform Development: Build apps, websites, and services with ASP.NET Core 6, Blazor, and EF Core 6 using Visual Studio 2022 and Visual Studio Code, 1st Edition!!!', 250.00, 1, '..\\assets\\img\\livre-1.png', 2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vendeurs`
--

DROP TABLE IF EXISTS `vendeurs`;
CREATE TABLE IF NOT EXISTS `vendeurs` (
  `id_vendeur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_vendeur` varchar(255) NOT NULL,
  `tel_vendeur` int(20) NOT NULL,
  `mail_vendeur` varchar(255) NOT NULL,
  `ville_vendeur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_vendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeurs`
--

INSERT INTO `vendeurs` (`id_vendeur`, `nom_vendeur`, `tel_vendeur`, `mail_vendeur`, `ville_vendeur`) VALUES
(1, 'prune', 61548978, 'prune@citron.com', 'Grenoble'),
(2, 'rummy', 978745878, 'brunette@aol.fr', 'Crolles'),
(3, 'farinn', 978745878, 'sheriff@aol.com', 'Grenoble');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`vendeur_id`) REFERENCES `fournisseurs` (`id_fournisseur`),
  ADD CONSTRAINT `produits_ibfk_3` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaires` (`id_commentaire`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
