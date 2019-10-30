-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le :  mer. 30 oct. 2019 à 12:46
-- Version du serveur :  8.0.18
-- Version de PHP :  7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dm_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Actualité'),
(2, 'Divertissement'),
(3, 'Nouveauté');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text,
  `idPost` int(11) DEFAULT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `idPost`, `idUser`) VALUES
(3, 'Quand est-ce aura lieu la grève ?', 1, 3),
(4, 'Le mardi et mercredi à partir de 9h', 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `imagePath` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `idCategory` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `imagePath`, `title`, `content`, `idCategory`, `idUser`) VALUES
(1, '1/greve.jpg', 'Grève des groupes communautaires', 'Alors que 1200 groupes communautaires dans l’ensemble du Québec suspendent leurs activités pour dénoncer leur sous-financement, le ministre Gaétan Barrette assure que leur financement « a toujours été au rendez-vous » et n’a pas été réduit, au contraire.\r\n\r\nCes groupes communautaires font la grève ou suspendent des activités, mardi et mercredi, certains également lundi, afin de protester contre ce qu’ils appellent leur sous-financement chronique, dans un contexte où la clientèle desservie, elle, s’accroît.\r\n\r\nIl s’agit de groupes de défense des droits, comme ceux qui défendent les chômeurs, les personnes assistées sociales ou les locataires, de même que des groupes en santé et services sociaux, comme les maisons d’hébergement ou les organismes qui viennent en aide aux personnes itinérantes. Il peut s’agir aussi de banques alimentaires ou de refuges — mais ceux-ci ne peuvent fermer leurs portes, même temporairement, comme d’autre organismes qui feront la grève.', 1, 7),
(2, '2/soirée entreprise.jpeg', 'Soirée organisé par la communauté', 'La communauté à annoncé que la première soirée organisé par la communauté aura lieu dans quelques jours. \r\nIls offriront des activités musicales et artistiques. Un buffet sera à disposition de tous les invités.\r\nUn comité de pilotage avec des chefs d\'entreprise a été mis en place et a proposé des thèmes de réflexion liés aux ressources humaines, susceptibles d\'intéresser le plus grand nombre d\'acteurs économiques. Ainsi, une première soirée a été organisée le 26 avril dernier, au théâtre de Villefranche, sur le sujet du recrutement. Elle a débouché sur la mise en place d\'un atelier de formation avec une dizaine d\'entreprises souhaitant un accompagnement pour l\'embauche de collaborateurs.\r\n\r\nLes participants à cette soirée ont aussi répondu à un questionnaire afin d\'identifier leurs attentes pour retenir le thème d\'une deuxième rencontre. Il en est ressorti le souhait d\'aborder le thème des «nouveaux modes de management au service de la performance d\'entreprise». Ce qui sera fait jeudi 13 septembre.\r\n\r\nPour cette première soirée, a été invité Jean-Lou Fourquet, conférencier formateur à la performance managériale. Cofondateur de la Scop Palanca et de la conciergerie de quartier «Allô Bernard», il expérimente le management au quotidien au sein de sa structure et il facilite l\'expérimentation des entreprises qu\'il accompagne.', 2, 3),
(3, '3/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(4, '4/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 1, 7),
(5, '5/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(7, '7/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(8, '8/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(9, '9/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(10, '10/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(11, '11/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(13, '13/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(14, '14/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(15, '15/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(16, '16/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(17, '17/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(18, '18/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(19, '19/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(20, '20/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7),
(21, '21/Achat_communautaire.jpg', 'Ouverture du blog communautaire', 'Comme expliqué dans l’article annonçant la création du nouveau site, l’intégralité du code source est désormais publiquement disponible sur Github. Cela signifie que vous pouvez lancer une copie du site chez vous et contribuer, par l’intermédiaire des pull requests, à son amélioration.\r\n\r\nNous avons d’ailleurs quelques “soucis” qui ne demandent qu’à être résolus ;).\r\n\r\nMais après tout, pourquoi se limiter à du code, pourquoi ne pas aussi apporter votre pierre à l’édifice en terme de contenu? Nous essayons déjà de trouver des moyens de vous faire participer lors de nos live: il y a les sondages Strawpoll bien sûr, il y a aussi la prise en compte de vos questions et commentaires sur le canal Discord, mais nous pouvons faire mieux. Comme expliqué dans le dernier SECHebdo, nous essayerons de donner un temps d’antenne rapide (entre 5 et 10 minutes sans compter nos nombreuses questions :) ) à un auditeur volontaire pour nous présenter un fait d’actualité, dès que cela sera possible.\r\n\r\nJe rappelle les règles si vous souhaitez y participer:\r\n\r\nVenez nous en parler en amont sur notre Discord;\r\nIl faut que le sujet soit en lien direct avec les thématiques du Comptoir (cybersécurité, protection de la vie privée, etc.);\r\nVous devez nous fournir quelques sources que nous mettrons dans le post accompagnant la publication du SECHebdo sur le site;\r\nVous devez faire l’effort de préparer un minimum votre prise de parole avant l’enregistrement, histoire de cadrer ce que vous voulez dire et essayer de tenir en 5 à 10 minutes maximum. Croyez moi, ça parait simple comme ça, mais en live, plus rien ne va, et on a tendance à doubler le temps prévu initialement.', 3, 7);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Admin', '$2y$10$65TyxWJYWbJY53gedNnv7O9qERRTu8g1j596NLiSGZu/gof4.c7jq'),
(3, 'Myckensy', '$2y$10$nnAAESkb2eF.RoIb59PJrukRQ/x5LCLCmrlx85FiAJA.hB7GUAFES'),
(7, 'Joshua', '$2y$10$FUSdB.Ok7PhSg.S1flQU6OZn5vAZyUwKuFv9hIXNX8/DCSU3Xi.iO'),
(8, 'Kylewan', '$2y$10$b8FCOX1dm8ekytmcEnvV8uS9AIZ0lt.Vwsj161BZaOQYGWTmr145y');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPost` (`idPost`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCategory` (`idCategory`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
