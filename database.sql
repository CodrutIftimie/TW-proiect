-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 14 Iun 2018 la 05:54
-- Versiune server: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id_c` int(11) NOT NULL AUTO_INCREMENT,
  `user_p` varchar(50) DEFAULT NULL,
  `com` varchar(45) NOT NULL,
  `id_produs` varchar(45) DEFAULT NULL,
  `created_t` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_c`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `comments`
--

INSERT INTO `comments` (`id_c`, `user_p`, `com`, `id_produs`, `created_t`) VALUES
(48, 'MisterOne', 'Misto', '12351', '2018-06-14 04:02:07'),
(49, 'CodrutIftimie', 'Interesant', '12351', '2018-06-14 04:02:07'),
(50, 'CodrutIftimie', 'Foarte delicios', '12355', '2018-06-14 04:02:07'),
(51, 'CodrutIftimie', 'Superbe!', '12352', '2018-06-14 04:07:38');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `emails`
--

DROP TABLE IF EXISTS `emails`;
CREATE TABLE IF NOT EXISTS `emails` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(100) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `message_sent` varchar(1000) NOT NULL,
  `date_sent` varchar(20) NOT NULL,
  PRIMARY KEY (`id_email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `emails`
--

INSERT INTO `emails` (`id_email`, `sender`, `receiver`, `message_sent`, `date_sent`) VALUES
(1, 'mihaiGeorge@gmail.com', 'adelin@gmail.com', 'This is my message for Adelin', '14/06/18'),
(2, 'MirceaP@yahoo.com', 'adelin@gmail.com', 'Great website!', '14/06/18'),
(3, 'georgeI@yahoo.com', 'adelin@gmail.com', 'Great work, I find your website really helpful!', '14/06/18'),
(4, 'paulC@gmail.com', 'codrut@gmail.com', 'Hello Codrut, I really dig the look of this website!', '14/06/18'),
(5, 'rickie@gmail.com', 'codrut@gmail.com', 'Hello Codrut!', '14/06/18'),
(6, 'hPaul@yahoo.com', 'leonard@gmail.com', 'Amazing job with the website, Leonard!', '14/06/18'),
(7, 'jimP@gmail.com', 'leonard@gmail.com', 'Hey there, your website was very helpful for me and I want to thank you for that!', '14/06/18');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `code` int(11) NOT NULL,
  `name_product` varchar(45) DEFAULT NULL,
  `product_url` varchar(100) NOT NULL,
  `ingredients` varchar(45) DEFAULT NULL,
  `packages` varchar(100) DEFAULT NULL,
  `grams_100` varchar(45) DEFAULT NULL,
  `instructions` mediumtext,
  `transport` varchar(100) DEFAULT NULL,
  `risks` varchar(100) DEFAULT NULL,
  `manufacturing_places` varchar(100) DEFAULT NULL,
  `valability` varchar(100) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `image1` varchar(10000) DEFAULT NULL,
  `image2` varchar(10000) DEFAULT NULL,
  `image3` varchar(10000) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `created_t` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categories` varchar(45) DEFAULT NULL,
  `in_stock` int(11) DEFAULT NULL,
  `creator` varchar(50) DEFAULT 'CodrutIftimie',
  `pending` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `products`
--

INSERT INTO `products` (`code`, `name_product`, `product_url`, `ingredients`, `packages`, `grams_100`, `instructions`, `transport`, `risks`, `manufacturing_places`, `valability`, `price`, `image1`, `image2`, `image3`, `country`, `created_t`, `categories`, `in_stock`, `creator`, `pending`) VALUES
(12351, 'Smantana', 'http://localhost/product.php?code=12351', 'tomatoes;fish', 'Cutie plastic', '100ml lapte 10g sare', 'Deschizi capacul mananci pui capacul si pui la frigider', 'Vehicul firma', 'Dureri intestinale', 'Braila', '11.10.2018', 45.13, 'https://www.pretistet.ro/wp-content/uploads/2014/07/Smantana-Albalact-12-900-gr-500x500.jpg', 'https://www.pretistet.ro/wp-content/uploads/2014/07/smantana_muller_375gr-480x480.jpg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSYypvWKDfjJwICVPyd8QfQJESwYsNgwsZjvxO04Nq2XIUKVzFK', 'polonia,Romania', '2018-06-13 23:40:33', NULL, 32, 'CodrutIftimie', 0),
(12352, 'Cereale', 'http://localhost/product.php?code=12352', 'tomatoes;fish;vegetables;', 'Punga', '90g scortisoara', 'Se pun in lapte', 'Fara', 'Intoxicare', 'Oradea', '08.12.2020', 5.30, 'https://www.nestle-cereals.com/ro/sites/g/files/qirczx421/f/styles/tablet_1024x576/public/product_gallery/pachet-cereale-mic-dejun-chocapic_0.png?itok=lhoIdCvp', 'https://www.ketal.com.bo/17243-large_default/cereal-nestle-chocapic-250gr.jpg', 'https://www.shopidoki.ro/img/produse/12229032N.jpg?t=1395765540', 'China,India', '2018-06-13 23:40:33', NULL, 21, 'CodrutIftimie', 0),
(12353, 'Peste congelat', 'http://localhost/product.php?code=12353', 'tomatoes;fish;vegetables;', 'Punga ', '20g sare,700g carne', 'Separati oasele si prajitii', 'Gratuit oriunde in romania', 'Intoxicare', 'Focsani', '28.07.2019', 12.00, 'https://roshop.uk/image/cache/Carne/macrou-congelat-negro-800x800.jpg', 'http://www.clubafaceri.ro/files/clients/50/99434/67/pungi-peste-congelat-3081779_big.jpg', 'http://www.negro2000.ro/images/products/file-de-crap.jpg', 'Germania,Romania', '2018-06-13 23:40:33', NULL, 44, 'AdelinPamint', 0),
(12354, 'Paste', 'http://localhost/product.php?code=12354', 'fruits;fish;vegetables;', 'Punga', '1,5kg paste', 'Fierbere', 'Fara', 'Ameteli', 'Bacau', '30.01.2022', 19.00, 'http://www.divainbucatarie.ro/wp-content/uploads/2014/03/pb-5.jpg', 'http://www.boromir.ro/images/retete/zoom/7/ro/taietei-de-casa-1.jpg', 'https://www.pretistet.ro/wp-content/uploads/2014/08/Fidea-Cuiburi-200g-Baneasa.jpg', 'Anglia', '2018-06-13 23:40:33', NULL, 214, 'AdelinPamint', 0),
(12355, 'Smantana', 'http://localhost/product.php?code=12355', 'tomatoes;', 'Cutie carton', '1L lichid', 'Incalzire si consumare', 'Curier', 'Bube rosii', 'Iasi', '18.08.2018', 9.00, 'http://www.cefacemimi.ro/wp-content/uploads/2012/07/lapte-dorna-uht.jpg', 'https://www.alimentaraonline.com/gallery/large/20/lapte-3-5-la-dorna-1l-3.jpg', 'http://www.admir.ro/1898-large_default/lapte-la-dorna-1l.jpg', 'Romania,Italia', '2018-06-13 23:40:33', NULL, 90, 'LeonardPester', 0),
(123450, 'Mustar de tecuci', 'http://localhost/product.php?code=123450', 'tomatoes;vegetables;', 'FRIGIDER', '10g sare,15g piper', 'None', 'Curier', 'None', 'Tecuci', '29.10.2019', 10.30, 'http://www.mustartecuci.ro/wp-content/uploads/2011/12/280iute-282x300.jpg', 'http://www.mustartecuci.ro/wp-content/uploads/2011/12/110g1-282x300.jpg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQI3B6HM38fjJ08TRSZLLdDoGVtBXgVE0pUqJFqvIUQ6M57_fKs', 'Romania,Franta', '2018-06-13 23:40:33', NULL, 24, 'LeonardPester', 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(30) NOT NULL,
  `user_sname` varchar(30) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_passw` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phonenr` int(15) DEFAULT NULL,
  `user_rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_sname`, `user_username`, `user_passw`, `user_email`, `user_phonenr`, `user_rank`) VALUES
(1, 'Adelin', 'Pamint', 'AdelinPamint', 'rootAdelin', 'adelin@gmail.com', 763927402, 1),
(2, 'Codrut', 'Iftimie', 'CodrutIftimie', 'rootCodrut', 'codrut@gmail.com', 762942942, 1),
(3, 'Leonard', 'Pester', 'LeonardPester', 'rootLeonard', 'leonard@gmail.com', 762951420, 1),
(4, 'Bodnar', 'Horatiu', 'BodnarHoratiu', 'horatiuBogdan', 'bogdanH@gmail.com', 782749263, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
