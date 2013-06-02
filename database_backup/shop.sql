-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2013 at 06:11 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_desc` tinytext NOT NULL,
  `c_icon` varchar(255) NOT NULL,
  `c_group` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `position`, `c_name`, `c_desc`, `c_icon`, `c_group`) VALUES
(1, '1>', 'Jhila1', 'Dhakaya Birani', '', '0'),
(2, '2>', 'Jhila2', 'Dhakaya Birani', '', '0'),
(3, '3>', 'Jhila3', 'Dhakaya Birani', '', '0'),
(4, '3>4>', 'Jhila 2.1', 'Dhakaya Birani', '', '0'),
(5, '3>4>5>', 'Jhila 2.1.1', 'Dhakaya Birani', '', '0'),
(6, '3>6>', 'Jhila 2.2', 'Dhakaya Birani', '', '0'),
(7, '3>7>', 'Jhila 3.1', 'Dhakaya Birani', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(511) NOT NULL,
  `customer_mobile` varchar(31) NOT NULL,
  `customer_aadress_line_1` varchar(511) DEFAULT NULL,
  `customer_aadress_line_2` varchar(511) DEFAULT NULL,
  `customer_location` varchar(255) DEFAULT NULL,
  `customer_password` varchar(1023) NOT NULL,
  `customer_email` varchar(511) DEFAULT NULL,
  `customer_status` tinyint(4) DEFAULT '1' COMMENT 'customer_status code meaning\r\n0 means inactive\r\n1 means active',
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `Unique_Mobile_Number` (`customer_mobile`),
  UNIQUE KEY `Unique_Email` (`customer_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_mobile`, `customer_aadress_line_1`, `customer_aadress_line_2`, `customer_location`, `customer_password`, `customer_email`, `customer_status`) VALUES
(1, 'Mahmudur Rahman', '01670603332', 'N4, Baily height', 'admin', 'Shantinagar', 'e10adc3949ba59abbe56e057f20f883e', 'nahid@acm.com', 1),
(2, 'Kahmudur Pahman', '01670603331', 'N40, Baily height', 'Komudin', 'Shantinagar', '6531401f9a6807306651b87e44c05751', '', 1),
(4, 'Pissing Patel', '01670603330', 'N400, Baily height', 'aam tola', 'Malibaag', '144288547b7e555d22ee8519b7a6280c', NULL, 1),
(5, 'Rasel John', '016706033', '45, Musada', 'Khepu Para', 'Baily Road', '508df4cb2f4d8f80519256258cfb975f', NULL, 1),
(6, 'Khalid Man', '016706033111', '126, Tika Tuli', 'Badda road', 'Malibaag', 'e10adc3949ba59abbe56e057f20f883e', 'nahid@acmaa.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_customer_id` bigint(20) DEFAULT NULL,
  `order_customer_name` varchar(511) DEFAULT NULL,
  `order_customer_mobile` varchar(31) DEFAULT NULL,
  `order_shipping_address` varchar(2047) DEFAULT NULL,
  `order_status` varchar(127) DEFAULT NULL,
  `order_time` datetime DEFAULT NULL,
  `order_delivery_time` datetime DEFAULT NULL,
  `order_comment` varchar(1023) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `order_vs_customer_id` (`order_customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `order_customer_id`, `order_customer_name`, `order_customer_mobile`, `order_shipping_address`, `order_status`, `order_time`, `order_delivery_time`, `order_comment`) VALUES
(1, 6, 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', NULL, NULL),
(2, 6, 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', NULL, NULL),
(3, 6, 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', NULL, NULL),
(4, 6, 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', NULL, NULL),
(5, 6, 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', NULL, NULL),
(6, 6, 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', NULL, NULL),
(7, 6, 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', NULL, NULL),
(8, 6, 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', NULL, NULL),
(9, 6, 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', NULL, NULL),
(10, 6, 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', NULL, NULL),
(11, 6, 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', NULL, NULL),
(12, 6, 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '2013-06-02 12:09:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `order_item_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_item_order_id` bigint(20) DEFAULT NULL,
  `order_item_product_sku` varchar(255) DEFAULT NULL,
  `order_item_name` varchar(1023) DEFAULT NULL,
  `order_item_price` float DEFAULT NULL,
  `order_item_quantity` int(11) DEFAULT NULL,
  `order_item_options` varchar(2047) DEFAULT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id_vs_order_item` (`order_item_order_id`),
  KEY `order_id_vs_product_sku` (`order_item_product_sku`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_item_order_id`, `order_item_product_sku`, `order_item_name`, `order_item_price`, `order_item_quantity`, `order_item_options`) VALUES
(1, 5, '1', 'Sokal Ghum', 14, 1, ''),
(2, 5, '21', 'Bikal ghum aseaad', 5, 2, ''),
(3, 6, '1', 'Sokal Ghum', 14, 1, ''),
(4, 6, '21', 'Bikal ghum aseaad', 5, 2, ''),
(5, 7, '1', 'Sokal Ghum', 14, 3, ''),
(6, 7, '21', 'Bikal ghum aseaad', 5, 2, ''),
(7, 7, '123123', 'Pkundi', 23, 3, ''),
(8, 8, '343', 'Another', 12, 5, ''),
(9, 8, '123123', 'Pkundi', 23, 2, ''),
(10, 9, '21', 'Bikal ghum aseaad', 5, 4, ''),
(11, 9, '343', 'Another', 12, 2, ''),
(12, 10, '21', 'Bikal ghum aseaad', 5, 3, ''),
(13, 11, '21', 'Bikal ghum aseaad', 5, 3, ''),
(14, 12, '21', 'Bikal ghum aseaad', 5, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(1023) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` float NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_sku` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_sku` (`product_sku`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_price`, `product_stock`, `product_sku`) VALUES
(15, 'Sokal Ghum', 'It was a shocking bad wound," began the whale-surgeon; "and, taking my advice, Captain Boomer here, stood our old Sammy—" "Samuel Enderby is the name of my ship," interrupted the one-armed captain, addressing Ahab; "go on, boy." "Stood our old Sammy', 14, 184, '1'),
(16, 'Bikal ghum aseaad', 'Dorothy was thinking so earnestly as they walked along that she did not notice when the Scarecrow stumbled into a hole and rolled over to the side of the road.  Indeed he was obliged to call to her to help him up again. "Why didn''t you walk around the hole?" asked the Tin Woodman. "I don''t know enough," replied the Scarecrow cheerfully.  "My head is stuffed with straw, you know, and that is why I am going to Oz to ask him for some brains." "Oh,', 5, -16, '21'),
(19, 'Another', '"We are lost, for they will surely tear us to pieces with their sharp claws.  But stand close behind me, and I will fight them as long as I am alive." "Wait a minute!" called the Scarecrow.  He had been thinking what was best to be done, and now he asked the Woodman to chop away the end of the tree that rested on their side of the ditch.', 12, 338, '343'),
(21, 'Bikal ghum', '''Fifteenth,'' said the March Hare. ''Sixteenth,'' added the Dormouse. ''Write that down,'' the King said to the jury, and the jury eagerly  wrote down all three dates on their slates, and then added them up, and  reduced the answer to shillings', 23, 45, '23111'),
(22, 'Pkundi', 'I gave a cry of astonishment.  I saw and thought nothing of the other four Martian monsters; my attention was riveted upon the nearer incident.  Simultaneously two other shells burst in the', 23, 29, '123123'),
(23, 'Bikkhoto', 'Suddenly he became alertly tense. Sound, sight, and odor had given him  a simultaneous warning. His hand went back to the old man, touching  him, and the pair stood still. Ahead, at one side of the top', 765, 21, 'NITUN'),
(24, 'Vui Paisi', '"No, my head is quite empty," answered the Woodman.  "But once I had brains, and a heart also; so, having tried them both, I should much rather have a', 12, 4, '34332435345');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE IF NOT EXISTS `product_attribute` (
  `product_attribute_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_attribute_name` varchar(128) DEFAULT NULL,
  `product_attribute_value` text,
  `product_attribute_product_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`product_attribute_id`),
  KEY `product_attribute_vs_product_id_map` (`product_attribute_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_category_map`
--

CREATE TABLE IF NOT EXISTS `product_category_map` (
  `product_category_map_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_category_map_product_id` bigint(20) DEFAULT NULL,
  `product_category_map_category_id` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`product_category_map_id`),
  KEY `product_category_map_product_id` (`product_category_map_product_id`),
  KEY `product_category_map_category_id` (`product_category_map_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `product_category_map`
--

INSERT INTO `product_category_map` (`product_category_map_id`, `product_category_map_product_id`, `product_category_map_category_id`) VALUES
(40, 15, 1),
(41, 15, 4),
(42, 15, 6),
(43, 16, 3),
(44, 16, 6),
(48, 19, 3),
(49, 19, 4),
(50, 19, 5),
(51, 19, 7),
(52, 21, 2),
(53, 21, 5),
(55, 23, 1),
(56, 23, 7),
(57, 24, 2),
(58, 24, 5),
(59, 24, 7),
(63, 22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `product_image_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_image_product_id` bigint(20) DEFAULT NULL,
  `product_image_path` varchar(1023) DEFAULT NULL,
  PRIMARY KEY (`product_image_id`),
  KEY `product_vs_product_image_map` (`product_image_product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`product_image_id`, `product_image_product_id`, `product_image_path`) VALUES
(5, 15, 'uploads/product_images/Chrysanthemum4.jpg'),
(6, 16, 'uploads/product_images/Desert3.jpg'),
(8, 19, 'uploads/product_images/Jellyfish2.jpg'),
(9, 21, 'uploads/product_images/Koala.jpg'),
(11, 23, 'uploads/product_images/Penguins5.jpg'),
(12, 24, 'uploads/product_images/Tulips6.jpg'),
(14, 22, 'uploads/product_images/Lighthouse2.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_vs_customer_id` FOREIGN KEY (`order_customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_id_vs_order_item` FOREIGN KEY (`order_item_order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_id_vs_product_sku` FOREIGN KEY (`order_item_product_sku`) REFERENCES `product` (`product_sku`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `product_attribute_vs_product_id_map` FOREIGN KEY (`product_attribute_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_category_map`
--
ALTER TABLE `product_category_map`
  ADD CONSTRAINT `product_category_map_category_id` FOREIGN KEY (`product_category_map_category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_category_map_product_id` FOREIGN KEY (`product_category_map_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_vs_product_image_map` FOREIGN KEY (`product_image_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
