/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : shop

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-06-23 16:44:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `associated_product`
-- ----------------------------
DROP TABLE IF EXISTS `associated_product`;
CREATE TABLE `associated_product` (
  `associated_product_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `associated_product_simple_product_id` bigint(20) DEFAULT NULL,
  `associated_product_configurable_product_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`associated_product_id`),
  KEY `associated_product_simple_product_id` (`associated_product_simple_product_id`),
  KEY `associated_product_configurable_product_id` (`associated_product_configurable_product_id`),
  CONSTRAINT `associated_product_configurable_product_id` FOREIGN KEY (`associated_product_configurable_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `associated_product_simple_product_id` FOREIGN KEY (`associated_product_simple_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of associated_product
-- ----------------------------
INSERT INTO `associated_product` VALUES ('1', '15', '25');
INSERT INTO `associated_product` VALUES ('2', '21', '25');
INSERT INTO `associated_product` VALUES ('3', '22', '25');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_desc` tinytext NOT NULL,
  `c_icon` varchar(255) NOT NULL,
  `c_group` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '1>', 'Jhila1', 'Dhakaya Birani', '', '0');
INSERT INTO `category` VALUES ('2', '2>', 'Jhila2', 'Dhakaya Birani', '', '0');
INSERT INTO `category` VALUES ('3', '3>', 'Jhila3', 'Dhakaya Birani', '', '0');
INSERT INTO `category` VALUES ('4', '3>4>', 'Jhila 2.1', 'Dhakaya Birani', '', '0');
INSERT INTO `category` VALUES ('5', '3>4>5>', 'Jhila 2.1.1', 'Dhakaya Birani', '', '0');
INSERT INTO `category` VALUES ('6', '3>6>', 'Jhila 2.2', 'Dhakaya Birani', '', '0');
INSERT INTO `category` VALUES ('7', '3>7>', 'Jhila 3.1', 'Dhakaya Birani', '', '0');

-- ----------------------------
-- Table structure for `customer`
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('2', 'Kahmudur Pahman', '01670603331', 'N40, Baily height', 'Komudin', 'Shantinagar', '6531401f9a6807306651b87e44c05751', '', '1');
INSERT INTO `customer` VALUES ('4', 'Pissing Patel', '01670603330', 'N400, Baily height', 'aam tola', 'Malibaag', '144288547b7e555d22ee8519b7a6280c', null, '1');
INSERT INTO `customer` VALUES ('5', 'Rasel John', '016706033', '45, Musada', 'Khepu Para', 'Baily Road', '508df4cb2f4d8f80519256258cfb975f', null, '1');
INSERT INTO `customer` VALUES ('6', 'Khalid Man', '016706033111', '126, Tika Tuli', 'Badda road', 'Malibaag', 'e10adc3949ba59abbe56e057f20f883e', 'nahid@acmaa.com', '1');
INSERT INTO `customer` VALUES ('7', 'Half Man', '0167', '1/2, Dhaka', 'Bhuter Goli', 'Malibaag', 'e10adc3949ba59abbe56e057f20f883e', 'nhd@nhd.com', '1');
INSERT INTO `customer` VALUES ('8', 'Mahmudur Rahman', '01670603332', 'N4, Baily height', 'Baily Road', 'Baily Road', 'e10adc3949ba59abbe56e057f20f883e', 'nahidacm@gmail.com', '1');

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
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
  KEY `order_vs_customer_id` (`order_customer_id`),
  CONSTRAINT `order_vs_customer_id` FOREIGN KEY (`order_customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('1', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', null, null);
INSERT INTO `order` VALUES ('2', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', null, null);
INSERT INTO `order` VALUES ('3', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', null, null);
INSERT INTO `order` VALUES ('4', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', null, null);
INSERT INTO `order` VALUES ('5', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', null, null);
INSERT INTO `order` VALUES ('6', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', null, null);
INSERT INTO `order` VALUES ('7', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', null, null);
INSERT INTO `order` VALUES ('8', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', null, null);
INSERT INTO `order` VALUES ('9', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', null, null);
INSERT INTO `order` VALUES ('10', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', null, null);
INSERT INTO `order` VALUES ('11', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '0000-00-00 00:00:00', null, null);
INSERT INTO `order` VALUES ('12', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'complete', '2013-06-02 12:09:30', null, null);
INSERT INTO `order` VALUES ('13', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '2013-06-02 19:39:16', null, null);
INSERT INTO `order` VALUES ('14', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '2013-06-02 20:10:52', null, null);
INSERT INTO `order` VALUES ('15', '6', 'Khalid Man', '016706033111', '126, Tika Tuli,Badda road,Malibaag', 'new', '2013-06-02 20:17:24', null, null);
INSERT INTO `order` VALUES ('16', '7', 'Half Man', '0167', '1/2, Dhaka,Bhuter Goli,Malibaag', 'processing', '2013-06-05 20:44:32', null, null);
INSERT INTO `order` VALUES ('17', '8', 'Mahmudur Rahman', '01670603332', 'N4, Baily height,Baily Road,Baily Road', 'new', '2013-06-20 00:33:33', null, null);

-- ----------------------------
-- Table structure for `order_item`
-- ----------------------------
DROP TABLE IF EXISTS `order_item`;
CREATE TABLE `order_item` (
  `order_item_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_item_order_id` bigint(20) DEFAULT NULL,
  `order_item_product_sku` varchar(255) DEFAULT NULL,
  `order_item_name` varchar(1023) DEFAULT NULL,
  `order_item_price` float DEFAULT NULL,
  `order_item_quantity` int(11) DEFAULT NULL,
  `order_item_options` varchar(2047) DEFAULT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id_vs_order_item` (`order_item_order_id`),
  KEY `order_id_vs_product_sku` (`order_item_product_sku`),
  CONSTRAINT `order_id_vs_order_item` FOREIGN KEY (`order_item_order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_id_vs_product_sku` FOREIGN KEY (`order_item_product_sku`) REFERENCES `product` (`product_sku`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_item
-- ----------------------------
INSERT INTO `order_item` VALUES ('1', '5', '1', 'Sokal Ghum', '14', '1', '');
INSERT INTO `order_item` VALUES ('2', '5', '21', 'Bikal ghum aseaad', '5', '2', '');
INSERT INTO `order_item` VALUES ('3', '6', '1', 'Sokal Ghum', '14', '1', '');
INSERT INTO `order_item` VALUES ('4', '6', '21', 'Bikal ghum aseaad', '5', '2', '');
INSERT INTO `order_item` VALUES ('5', '7', '1', 'Sokal Ghum', '14', '3', '');
INSERT INTO `order_item` VALUES ('6', '7', '21', 'Bikal ghum aseaad', '5', '2', '');
INSERT INTO `order_item` VALUES ('7', '7', '123123', 'Pkundi', '23', '3', '');
INSERT INTO `order_item` VALUES ('8', '8', '343', 'Another', '12', '5', '');
INSERT INTO `order_item` VALUES ('9', '8', '123123', 'Pkundi', '23', '2', '');
INSERT INTO `order_item` VALUES ('10', '9', '21', 'Bikal ghum aseaad', '5', '4', '');
INSERT INTO `order_item` VALUES ('11', '9', '343', 'Another', '12', '2', '');
INSERT INTO `order_item` VALUES ('12', '10', '21', 'Bikal ghum aseaad', '5', '3', '');
INSERT INTO `order_item` VALUES ('13', '11', '21', 'Bikal ghum aseaad', '5', '3', '');
INSERT INTO `order_item` VALUES ('14', '12', '21', 'Bikal ghum aseaad', '5', '4', '');
INSERT INTO `order_item` VALUES ('15', '13', '21', 'Bikal ghum aseaad', '5', '2', '');
INSERT INTO `order_item` VALUES ('16', '13', '343', 'Another', '12', '4', '');
INSERT INTO `order_item` VALUES ('17', '14', '21', 'Bikal ghum aseaad', '5', '5', '');
INSERT INTO `order_item` VALUES ('18', '14', '1', 'Sokal Ghum', '14', '2', '');
INSERT INTO `order_item` VALUES ('19', '15', 'NITUN', 'Bikkhoto', '765', '1', '');
INSERT INTO `order_item` VALUES ('20', '16', '1', 'Sokal Ghum', '14', '1', '');
INSERT INTO `order_item` VALUES ('21', '16', '21', 'Bikal ghum aseaad', '5', '1', '');
INSERT INTO `order_item` VALUES ('22', '16', '343', 'Another', '12', '1', '');
INSERT INTO `order_item` VALUES ('23', '16', '123123', 'Pkundi', '23', '3', '');
INSERT INTO `order_item` VALUES ('24', '17', '1', 'Sokal Ghum', '14', '1', '');
INSERT INTO `order_item` VALUES ('25', '17', '123123', 'Pkundi', '23', '1', '');

-- ----------------------------
-- Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `product_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(1023) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` float NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_sku` varchar(255) NOT NULL,
  `product_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = simple product, 2 = configurable product',
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_sku` (`product_sku`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('15', 'Sokal Ghum', 'It was a shocking bad wound,\" began the whale-surgeon; \"and, taking my advice, Captain Boomer here, stood our old Sammy—\" \"Samuel Enderby is the name of my ship,\" interrupted the one-armed captain, addressing Ahab; \"go on, boy.\" \"Stood our old Sammy', '14', '180', '1', '1');
INSERT INTO `product` VALUES ('16', 'Bikal ghum aseaad', 'Dorothy was thinking so earnestly as they walked along that she did not notice when the Scarecrow stumbled into a hole and rolled over to the side of the road.  Indeed he was obliged to call to her to help him up again. \"Why didn\'t you walk around the hole?\" asked the Tin Woodman. \"I don\'t know enough,\" replied the Scarecrow cheerfully.  \"My head is stuffed with straw, you know, and that is why I am going to Oz to ask him for some brains.\" \"Oh,', '5', '-24', '21', '1');
INSERT INTO `product` VALUES ('19', 'Another', '\"We are lost, for they will surely tear us to pieces with their sharp claws.  But stand close behind me, and I will fight them as long as I am alive.\" \"Wait a minute!\" called the Scarecrow.  He had been thinking what was best to be done, and now he asked the Woodman to chop away the end of the tree that rested on their side of the ditch.', '12', '333', '343', '1');
INSERT INTO `product` VALUES ('21', 'Bikal ghum', '\'Fifteenth,\' said the March Hare. \'Sixteenth,\' added the Dormouse. \'Write that down,\' the King said to the jury, and the jury eagerly  wrote down all three dates on their slates, and then added them up, and  reduced the answer to shillings', '23', '45', '23111', '1');
INSERT INTO `product` VALUES ('22', 'Pkundi', 'I gave a cry of astonishment.  I saw and thought nothing of the other four Martian monsters; my attention was riveted upon the nearer incident.  Simultaneously two other shells burst in the', '23', '25', '123123', '1');
INSERT INTO `product` VALUES ('23', 'Bikkhoto', 'Suddenly he became alertly tense. Sound, sight, and odor had given him  a simultaneous warning. His hand went back to the old man, touching  him, and the pair stood still. Ahead, at one side of the top', '765', '20', 'NITUN', '1');
INSERT INTO `product` VALUES ('24', 'Vui Paisi', '\"No, my head is quite empty,\" answered the Woodman.  \"But once I had brains, and a heart also; so, having tried them both, I should much rather have a', '12', '4', '34332435345', '1');
INSERT INTO `product` VALUES ('25', 'Bondhu', 'Mone pore sei din', '23', '45', '23451', '2');

-- ----------------------------
-- Table structure for `product_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `product_attribute`;
CREATE TABLE `product_attribute` (
  `product_attribute_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_attribute_name` varchar(128) DEFAULT NULL,
  `product_attribute_value` text,
  `product_attribute_product_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`product_attribute_id`),
  KEY `product_attribute_vs_product_id_map` (`product_attribute_product_id`),
  CONSTRAINT `product_attribute_vs_product_id_map` FOREIGN KEY (`product_attribute_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_attribute
-- ----------------------------

-- ----------------------------
-- Table structure for `product_category_map`
-- ----------------------------
DROP TABLE IF EXISTS `product_category_map`;
CREATE TABLE `product_category_map` (
  `product_category_map_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_category_map_product_id` bigint(20) DEFAULT NULL,
  `product_category_map_category_id` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`product_category_map_id`),
  KEY `product_category_map_product_id` (`product_category_map_product_id`),
  KEY `product_category_map_category_id` (`product_category_map_category_id`),
  CONSTRAINT `product_category_map_category_id` FOREIGN KEY (`product_category_map_category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_category_map_product_id` FOREIGN KEY (`product_category_map_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_category_map
-- ----------------------------
INSERT INTO `product_category_map` VALUES ('40', '15', '1');
INSERT INTO `product_category_map` VALUES ('41', '15', '4');
INSERT INTO `product_category_map` VALUES ('42', '15', '6');
INSERT INTO `product_category_map` VALUES ('43', '16', '3');
INSERT INTO `product_category_map` VALUES ('44', '16', '6');
INSERT INTO `product_category_map` VALUES ('48', '19', '3');
INSERT INTO `product_category_map` VALUES ('49', '19', '4');
INSERT INTO `product_category_map` VALUES ('50', '19', '5');
INSERT INTO `product_category_map` VALUES ('51', '19', '7');
INSERT INTO `product_category_map` VALUES ('52', '21', '2');
INSERT INTO `product_category_map` VALUES ('53', '21', '5');
INSERT INTO `product_category_map` VALUES ('55', '23', '1');
INSERT INTO `product_category_map` VALUES ('56', '23', '7');
INSERT INTO `product_category_map` VALUES ('57', '24', '2');
INSERT INTO `product_category_map` VALUES ('58', '24', '5');
INSERT INTO `product_category_map` VALUES ('59', '24', '7');
INSERT INTO `product_category_map` VALUES ('63', '22', '3');
INSERT INTO `product_category_map` VALUES ('64', '25', '1');
INSERT INTO `product_category_map` VALUES ('65', '25', '5');

-- ----------------------------
-- Table structure for `product_images`
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `product_image_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_image_product_id` bigint(20) DEFAULT NULL,
  `product_image_path` varchar(1023) DEFAULT NULL,
  PRIMARY KEY (`product_image_id`),
  KEY `product_vs_product_image_map` (`product_image_product_id`),
  CONSTRAINT `product_vs_product_image_map` FOREIGN KEY (`product_image_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES ('5', '15', 'uploads/product_images/Chrysanthemum4.jpg');
INSERT INTO `product_images` VALUES ('6', '16', 'uploads/product_images/Desert3.jpg');
INSERT INTO `product_images` VALUES ('8', '19', 'uploads/product_images/Jellyfish2.jpg');
INSERT INTO `product_images` VALUES ('9', '21', 'uploads/product_images/Koala.jpg');
INSERT INTO `product_images` VALUES ('11', '23', 'uploads/product_images/Penguins5.jpg');
INSERT INTO `product_images` VALUES ('12', '24', 'uploads/product_images/Tulips6.jpg');
INSERT INTO `product_images` VALUES ('14', '22', 'uploads/product_images/Lighthouse2.jpg');
INSERT INTO `product_images` VALUES ('15', '25', 'uploads/product_images/Penguins3.jpg');
