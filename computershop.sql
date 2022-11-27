-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 27, 2022 at 05:40 AM
-- Server version: 8.0.21
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `computershop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `pbarcode` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(100,2) NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pbarcode`, `name`, `price`, `quantity`, `image`) VALUES
(3, 6, '972134435535', 'Lenovo Legion H500 Pro 7.1 Headset', 99.00, 1, 'lenovo-headset.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `barcode` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `specifications` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `manufacturingDate` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `tradePrice` double(100,2) NOT NULL,
  `retailPrice` double(100,2) NOT NULL,
  `quantity` int NOT NULL,
  `warrantyAvailability` tinyint(1) NOT NULL,
  PRIMARY KEY (`barcode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`barcode`, `name`, `specifications`, `type`, `manufacturingDate`, `image`, `tradePrice`, `retailPrice`, `quantity`, `warrantyAvailability`) VALUES
('242354354562', 'HP Laptop 15s-eq1557AU', 'SCREEN SIZE: 15.6\",\r\nCOLOUR: Pale gold cover and base, natural silver keyboard,\r\nAMD Athlon™ Silver processor,\r\nWindows 11 Home,\r\n15.6\" diagonal, HD (1366 x 768), micro-edge, BrightView, 220 nits, 45% NTSC,\r\nAMD Radeon™ Graphics,\r\n4 GB DDR4-2400 MHz RAM (1 x 4 GB)', 'Laptop', '2022-10-03', 'hp-com.jpg', 62.00, 100.00, 14, 1),
('345890148508', 'HP USB-C to RJ45 Adapter', '- Easily connect to your network through your notebook or tablet’s USB-C™ power-in port with the HP USB-C™ to RJ45 Adapter.\r\n- Dimensions (cm) : 18 x 2.1 x 1.7\r\n- Weight : 71.4 g\r\n- With 1 Year Limited Warranty', 'Laptop', '2021-11-12', '51lOBwR3k6L.jpg', 50.00, 21.00, 10, 1),
('678340643680', 'HP 150 Wired Mouse', 'Works on almost any surface with astounding accuracy,\r\nClick real quick,\r\nElegant ergonomic design,\r\nAmbidextrous,\r\nWith 1 Year Limited Warranty', 'Mouse', '2021-12-23', 'hp-mouse.png', 50.00, 5.00, 10, 1),
('075325678908', 'HyperX Alloy Core RGB - Gaming Keyboard ', '- RGB Backlighting\r\n- Quiet, responsive keys\r\n- Durable, solid frame', 'Keyboard', '2021-10-02', 'keyboard.jpg', 50.00, 50.00, 10, 1),
('647907226787', 'Lenovo Select 14-inch Sleeve', 'Quality storage solution fit for any style-conscious on-the-go professional. Store your laptop, power bank, mouse, and other compact accessories securely inside the main laptop compartment and the extra zippered accessories pocket. Keep your items safe from the unexpected with a water-resistant polyester exterior and padded internal compartments.', 'Others', '2022-02-27', 'lenovo-bag.jpg', 50.00, 11.00, 6, 0),
('972134435535', 'Lenovo Legion H500 Pro 7.1 Headset', 'Ultimate tool for pro gamers, with the stylishness of the Legion series design language. Immerse yourself completely in your favourite action game, music or movie, with superb driverless 7.1 surround sound and dedicated audio profiles. Stay engaged for hours, thanks to the ergonomic design of the construction and ear cups. (3.5mm or USB connection for multi-platform)', 'Accessories', '2022-01-12', 'lenovo-headset.png', 50.00, 99.00, 12, 1),
('876654456789', 'HP 950 4K Webcam', '6.7 x 4.5 x 6.57 cm,\r\n0.11 kg,\r\nINCLUDED:\r\n1 Year Warranty', 'Others', '2022-10-03', 'hp-webcam.png', 50.00, 100.00, 13, 1),
('764323444432', 'HyperX FURY S - Gaming Mouse Pad - Cloth (L)', 'Optimised for precision\r\nSeamless anti-fray stitching\r\nDensely woven and textured surface for optimal precision\r\nComfort and stability\r\nWith 2 Year Warranty\r\n', 'Accessories', '2022-05-24', 'mousepad.jpg', 50.00, 22.00, 17, 1),
('990008432156', 'HP Pen', 'Customizable buttons\r\nWith up to 18 months of battery life\r\nDimensions (mm) : 138 x 9.5 x 9.5\r\nWeight : 0.016 kg\r\nWith 1 Year Limited Warranty', 'Accessories', '2022-02-16', 'hppen.jpeg', 50.00, 31.00, 8, 1),
('086524544512', 'HP V22v FHD Monitor', '21.5\" FHD (1920 x 1080 @ 60 Hz)\r\nFlat VA with Edge-lit\r\n1 VGA, 1 HDMI 1.4 (with HDCP support)\r\nTilt Stand\r\nAnti-glare, Low blue light mode\r\n3 Years On-site Warranty', 'Monitor', '2022-09-27', 'monitor.jpg', 50.00, 75.00, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(11) DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(2, 'user', 'user@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'user'),
(1, 'admin', 'admin@gmail.com', 'a4fd8e6fa9fbf9a6f2c99e7b70aa9ef2', 'admin'),
(3, 'abc', 'yy@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'user'),
(5, 'Lisa', 'lisa16@gmail.com', '7e9d2765a722aa496fafadbcb5f8cfc7', 'user'),
(6, 'test', 'test@gmail.com', 'ae2b1fca515949e5d54fb22b8ed95575', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `pbarcode` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(100,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pbarcode`, `name`, `price`, `image`) VALUES
(5, 6, '345890148508', 'HP USB-C to RJ45 Adapter', 96.00, '51lOBwR3k6L.jpg'),
(6, 6, '242354354562', 'HP Laptop 15s-eq1557AU', 100.00, 'hp-com.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
