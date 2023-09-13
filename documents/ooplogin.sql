-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 15 juil. 2023 à 11:10
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ooplogin`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `commande_id` int NOT NULL AUTO_INCREMENT,
  `users_id` int NOT NULL,
  `commande_date` datetime DEFAULT NULL,
  `delivery_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `delivery_address` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `delivery_phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`commande_id`),
  KEY `fk_user1` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`commande_id`, `users_id`, `commande_date`, `delivery_name`, `delivery_address`, `delivery_phone`) VALUES
(66, 59, '2023-07-10 19:57:38', 'toto', 'paris', '123'),
(67, 59, '2023-07-10 20:05:16', 'toto', 'paris', '123'),
(68, 59, '2023-07-10 20:07:34', 'Amen Radhouan AMMARI', '229 Rue de l\'ardoux, BP266  Bâ', '0603644188'),
(69, 59, '2023-07-11 14:46:19', 'Amen Radhouan AMMARI', '229 Rue de l\'ardoux, BP266  Bâ', '0603644188'),
(70, 59, '2023-07-11 15:23:48', 'dsfdf', 'gdsfgdf', '23423'),
(71, 59, '2023-07-11 15:29:27', 'dsfdf', 'gdsfgdf', '23423'),
(72, 59, '2023-07-11 15:34:53', 'Amen Radhouan AMMARI', '229 Rue de l\'ardoux, BP266  Bâ', '0603644188'),
(73, 59, '2023-07-11 15:36:41', 'Amen Radhouan AMMARI', '229 Rue de l\'ardoux, BP266  Bâ', '0603644188'),
(74, 59, '2023-07-11 17:38:30', 'ammari', '229 Rue de l\'ardoux, BP266  Bâ', '0603644188'),
(75, 66, '2023-07-12 14:02:07', 'rzerzr', 'zztzrz', '468461'),
(76, 66, '2023-07-12 14:02:28', 'rzerzr', 'zztzrz', '468461'),
(77, 66, '2023-07-12 14:03:19', 'asdas', 'asqdasd', '1111'),
(78, 66, '2023-07-12 14:10:07', 'asdasge', 'asqdasdege', '1111768'),
(79, 66, '2023-07-12 20:31:56', 'toto', 'titi', '123'),
(80, 66, '2023-07-13 08:56:47', 'ere', 'ere', '68461'),
(81, 68, '2023-07-14 19:23:33', 'fefe', 'fef', '55225'),
(82, 74, '2023-07-15 08:31:09', 'titi', 'sqsverf', '6846468');

-- --------------------------------------------------------

--
-- Structure de la table `details_command`
--

DROP TABLE IF EXISTS `details_command`;
CREATE TABLE IF NOT EXISTS `details_command` (
  `command_id` int NOT NULL,
  `option_id` int NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`command_id`,`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `details_command`
--

INSERT INTO `details_command` (`command_id`, `option_id`, `price`) VALUES
(67, 13, 4.5),
(68, 13, 4.5),
(68, 2, 11),
(69, 7, 5),
(70, 7, 5),
(71, 7, 5),
(72, 7, 5),
(73, 7, 5),
(73, 4, 7),
(74, 7, 5),
(78, 1, 8),
(79, 9, 12),
(79, 8, 7.5),
(80, 1, 8),
(81, 34, 50),
(82, 7, 5);

-- --------------------------------------------------------

--
-- Structure de la table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `Username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `Pass` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `Phonenumber` int NOT NULL,
  `Age` int NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `position` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employee`
--

INSERT INTO `employee` (`Username`, `Pass`, `Phonenumber`, `Age`, `email`, `gender`, `position`) VALUES
('', '', 0, 0, '', '', ''),
('derbel', '77786', 2147483647, 25, 'rr@gmail.com', 'male', 'Delivery'),
('gdg', 'tertet', 5858, 55, 'yuii', 'male', 'Waiter'),
('jjjjjjj', 'jjjjjjjj', 65466, 6846, 'jjj@jjj.com', 'male', 'Delivery'),
('jykyk', 'ukikuk_', 78383, 55, '258jh,h@joj.kp', 'male', 'Delivery'),
('toto', 'toto', 2147483647, 55, 'jhuyibi@gmail.com', 'male', 'Delivery'),
('tttttttttttttt', 'tttt', 6565, 55, 'tt@tt.tt', 'male', 'Coffee'),
('Wassim', 'Londres2', 603644188, 25, 'ejddid@live.com', 'male', 'Cleaning');

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `productid` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productid` (`productid`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `options`
--

INSERT INTO `options` (`id`, `name`, `price`, `productid`) VALUES
(1, 'Medium', 8, 2),
(2, 'Large', 11, 2),
(3, 'Chocolate', 6, 15),
(4, 'Noisette', 7, 15),
(5, 'Caramel', 5.5, 15),
(6, 'Basic', 7.5, 1),
(7, 'Basic', 5, 3),
(8, 'Basic', 7.5, 4),
(9, 'Basic', 12, 5),
(10, 'Basic', 9, 6),
(11, 'Basic', 9, 7),
(12, 'Basic', 12, 8),
(13, 'Basic', 4.5, 9),
(14, 'Basic', 19.99, 10),
(15, 'Basic', 4.99, 11),
(16, 'Basic', 3.99, 12),
(17, 'Basic', 9.5, 13),
(18, 'Basic', 5.5, 14),
(19, 'Basic', 19.99, 16),
(20, 'Basic', 18, 17),
(21, 'Basic', 6, 18),
(34, 'Basic', 50, 19);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(35) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `product_image` longtext COLLATE utf8mb4_general_ci,
  `product_description` longtext COLLATE utf8mb4_general_ci,
  `product_type` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_image`, `product_description`, `product_type`) VALUES
(1, 'Iced Coffee', './images/Iced-coffee.jpg', 'Iced coffee is a coffee beverage served cold. It is prepared by brewing coffee normally and then serving it over ice or in cold milk.', 'Drink'),
(2, 'Frappucino', './images/Frappu.jpg', 'Frappuccino is a line of blended iced coffee drinks sold by Koofi. It may consists of coffee or crème base, blended with ice and ingredients such as flavored syrups and usually topped with whipped cream and or spices.It may also include blended Koofi refreshers.', 'Drink'),
(3, 'Coffea Arabica', './images/Arabica.jpg', 'Coffea arabica, also known as the Arabic coffee, is a species of flowering plant in the coffee and madder family Rubiaceae. It is believed to be the first species of coffee to have been cultivated and is currently the dominant cultivar, representing about 60% of global production.', 'Drink'),
(4, 'Caramel Coffee', './images/Caramel-co.jpg', 'What is caramel coffee made of? Caramel coffee is a drink made from brewed coffee, caramel sauce, milk, and whipped cream. The coffee is typically brewed with a French press or pour over brewer like the Chemex.', 'Drink'),
(5, 'Strawberry juice', './images/Strawberry-juice.jpg', 'Strawberry Juice is a refreshing fresh fruit juice that is full of vitamin C and antioxidants and lot of invigorating flavor.', 'Drink'),
(6, 'Americano', './images/Americano.jpg', 'Caffè Americano is a type of coffee drink prepared by diluting an espresso with hot water, giving it a similar strength to, but different flavor from, traditionally brewed coffee. Its strength varies with the number of shots of espresso and amount of water added.', 'Drink'),
(7, 'Espresso', './images/Espresso.jpg', 'Espresso is a coffee-brewing method of Italian origin, in which a small amount of nearly boiling water is forced under 9–10 bars of pressure through finely-ground coffee beans.', 'Drink'),
(8, 'Mango Juice', './images/Mango.jpg', 'Mango juice is a beverage made from the extracted juice of mango fruit, typically with added sweeteners or other fruit juices, and it has a sweet, tangy, and refreshing taste.', 'Drink'),
(9, 'Hot-Tea', './images/T.jpg', 'Hot teas are warm beverages made by steeping tea leaves or herbs in hot water, offering a variety of flavors and potential health benefits. They are cherished for their comforting warmth and rich aroma.', 'Drink'),
(10, 'German Cake', './images/img5.jpg', 'German chocolate cake, originally German\'s chocolate cake, is a layered chocolate cake filled and topped with a coconut-pecan frosting.', 'Cakes and Cookies'),
(11, 'Chocolate Donuts', './images/img6.jpg', 'Moist and fluffy baked chocolate donuts full of chocolate flavor. Covered in a thick, chocolate glaze, these are perfect for any chocoholic.', 'Cakes and Cookies'),
(12, 'Chocolate cake', './images/Choc.jpg', 'Chocolate cake or chocolate gâteau is a cake flavored with melted chocolate, cocoa powder, or both.', 'Cakes and Cookies'),
(13, 'Our Cookies', './images/img8.jpg', 'A cookie, or a biscuit, is a baked or cooked snack or dessert that is typically small, flat and sweet. It usually contains flour, sugar, egg, and some type of oil, fat, or butter. It may include other ingredients such as raisins, oats, chocolate chips, nuts, etc..', 'Cakes and Cookies'),
(14, 'Red Velvet Cake', './images/red-velvet.jpg', 'Red velvet cake is traditionally a red, crimson, or scarlet-colored layer cake, layered with ermine icing. Traditional recipes do not use food coloring, with the red color due to non-Dutched, anthocyanin-rich cocoa.', 'Cakes and Cookies'),
(15, 'Cupcake', './images/CUpcakes.jpg', 'A cupcake is a small cake designed to serve one person, which may be baked in a small thin paper or aluminum cup. As with larger cakes, frosting and other cake decorations such as fruit and candy may be applied.', 'Cakes and Cookies'),
(16, 'Black Forest Cake', './images/Black-forest', 'Black Forest gâteau or Black Forest cake is a chocolate sponge cake with a rich cherry filling based on the German dessert Schwarzwälder Kirschtorte, literally \"Black Forest Cherry-torte\". Typically, Black Forest gateau consists of several layers of chocolate sponge cake sandwiched with whipped cream and cherries.', 'Cakes and Cookies'),
(17, 'Genoise Sponge Cake', './images/Genoise-sponge.jpg', 'Genoise sponge (also called Genoese or Genovese cake) is a classic European sponge cake that\'s incredibly fluffy and light-as-air! Slice into layers and add any filling of your choice to create a delicious layer cake!', 'Cakes and Cookies'),
(18, 'Pancakes', './images/Pancakes.jpg', 'A pancake is a flat cake, often thin and round, prepared from a starch-based batter that may contain eggs, milk and butter and cooked on a hot surface such as a griddle or frying pan, often frying with oil or butter.', 'Cakes and Cookies');

-- --------------------------------------------------------

--
-- Structure de la table `rates`
--

DROP TABLE IF EXISTS `rates`;
CREATE TABLE IF NOT EXISTS `rates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rates`
--

INSERT INTO `rates` (`id`, `name`, `phone`, `email`, `comment`) VALUES
(1, 'efe', '6584984+9', 'feff@gmail.com', 'ezfzfgfeg'),
(2, 'ggd', '66676', 'ghdt@gmail.com', 'ryryry');

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `users_id` int NOT NULL,
  `review_date` date DEFAULT NULL,
  `review_content` longtext COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `fk_user2` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int NOT NULL AUTO_INCREMENT,
  `users_uid` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `users_pwd` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `users_email` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `users_tel` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `users_address` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`users_id`, `users_uid`, `users_pwd`, `users_email`, `users_tel`, `users_address`, `role`) VALUES
(59, 'Clement', '$2y$10$kVvst1j50DQ1MVJ/a.F28OzWU/Gv4J/i/2/1bXI8x2ZLE0gcLFvzS', 'clementchangeux@gmail.com', '2147483647', '22, Rue de la république', 'user'),
(61, 'Radhouan33', '$2y$10$LCciyeI5owVpT.16W6LZ7e6DXX.ixNoxiQhriUtf2mVM5YnYpxUjG', 'radhwana@gmail.com', '33', '229 Rue de l\'ardoux, BP266  Bâtiment C', 'user'),
(66, 'Radhouan96', '$2y$10$vNP5q92RxEuQVroIH20LN.lspOu/V8GDiZpZ/KyhSKqV7rMb49rFO', 'rr96@gmail.com', '66464', 'rgegeg', 'user'),
(68, 'Kyufi', '$2y$10$cf8DoIC/iErb9t1a9A7PaO3NDKFXzdQ3iWgbvs/fgJvu3UU/YOYfy', 'Kyfi614@gmail.com', '0603644188', '21 boulevard raymon pointcaré', 'admin'),
(72, 'aaaa', '$2y$10$D.XUbrU8ySayHdknD0vywe1MgeS3n.IuwZKtg8SdfKkm5sZN0dnkq', 'aaa@aa.com', '5554', 'aaaaaffe', 'user'),
(73, 'blabla', '$2y$10$L2KL2aGUItY8MmaA7vNogu4/oodrzBGBwO3Zjail0b.URsRm.lCze', 'blabla@bla.com', '52552', 'rhrhrhrh', 'user'),
(74, 'titi', '$2y$10$Ccpaz4m/Uxz4tIErDrhUDuFO6GC7VrRc9pGMXSses0CK868pRzN2C', 'titi@gmail.com', '689465165416', 'svxfgvqsrfve', 'user');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_user1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Contraintes pour la table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_user2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
