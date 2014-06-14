-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2014 at 03:15 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `HOME24-TEST`
--

-- --------------------------------------------------------

--
-- Table structure for table `mart`
--

CREATE TABLE IF NOT EXISTS `mart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `productID` int(10) unsigned NOT NULL,
  `customerID` varchar(255) NOT NULL,
  `quantity` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_product` (`productID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=138 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `productID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productCode` char(3) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `price` decimal(7,2) NOT NULL DEFAULT '99999.99',
  `image` varchar(80) NOT NULL,
  `thumbnail` varchar(80) NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productCode`, `name`, `description`, `price`, `image`, `thumbnail`) VALUES
(4, 'ADP', 'Alpha Dual Power', 'The Alpha Dual Power Sofa is covered in Vaquero Heavyweight Synthetic Suede to be ultra durable without the hefty price tag. Deeply cushioned backs, seats, and track arms ensure that you''ll be surrounded with comfort. No matter which side you choose, each outside seat on the sofa will smoothly recline with a touch of a button. ', 1099.00, 'adp.jpg', 'th_adp.jpg'),
(5, 'BPR', 'Bonanza II Power Reclining', 'The Bonanza II Power Reclining Sofa is the swiss pocket knife of sofas. Leggett & Platt mechanisms allow you to recline with the touch of a button. The soft, chocolate fabric with brass nail-head trim works in any decor or color scheme. 100% hardwood and plywood frames make up a solid support for 2.0 high-density foam and no-sag suspension with "seat zone" support. ', 799.00, 'bpr.jpg', 'th_bpr.jpg'),
(6, 'MZW', 'Mazatlan Wall', 'Bring the sun''s rays inside your home with the blazing Mazatlan Wall Mirror. The crafted metal frame fans out around the mirror for a modern look that no guest can help but comment on.', 236.00, 'mzw.jpg', 'th_mzw.jpg'),
(7, 'YFB', 'Youthful Bed', 'Youthful and fun, this comforter set is made of 100% cotton for ultimate comfort. Neutral gray combines with vibrant blue in this vivid geometric bedding set that is as stylish as it is comfortable. Available in 2 Pc. twin, and 3 Pc. full/queen sets. ', 349.00, 'ybf.jpg', 'th_ybf.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mart`
--
ALTER TABLE `mart`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
