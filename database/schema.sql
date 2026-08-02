-- Database Schema for Nomadenstuff E-Commerce System

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `address` TEXT DEFAULT NULL,
  `is_active` TINYINT(1) DEFAULT 1,
  `date_register` INT(11) NOT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `role` VARCHAR(50) DEFAULT 'member',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) DEFAULT 'admin',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_category` INT(11) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `price` INT(11) NOT NULL,
  `is_available` TINYINT(1) DEFAULT 1,
  `image` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `type` ENUM('L','W','U') DEFAULT 'U',
  `size` VARCHAR(50) DEFAULT NULL,
  `color` VARCHAR(50) DEFAULT NULL,
  `delete` TINYINT(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`slug`),
  KEY `idx_product_category` (`id_category`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_user` INT(11) NOT NULL,
  `id_product` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `sub_total` INT(11) NOT NULL,
  `message` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cart_user` (`id_user`),
  KEY `idx_cart_product` (`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_user` INT(11) NOT NULL,
  `date` DATE NOT NULL,
  `invoice` VARCHAR(100) NOT NULL,
  `diskon_persen` FLOAT DEFAULT 0,
  `diskon` INT(11) DEFAULT 0,
  `total` INT(11) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `address` TEXT NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `province` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `courier` VARCHAR(50) NOT NULL,
  `cost_courier` INT(11) NOT NULL,
  `waybill` VARCHAR(100) DEFAULT NULL,
  `status` ENUM('waiting','paid','process','done','cancel') DEFAULT 'waiting',
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_unique` (`invoice`),
  KEY `idx_orders_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_orders` INT(11) NOT NULL,
  `id_product` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `sub_total` INT(11) NOT NULL,
  `message` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_order_detail_orders` (`id_orders`),
  KEY `idx_order_detail_product` (`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `order_confirm`;
CREATE TABLE `order_confirm` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_orders` INT(11) NOT NULL,
  `account_name` VARCHAR(255) NOT NULL,
  `nominal` INT(11) NOT NULL,
  `note` TEXT DEFAULT NULL,
  `image` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_order_confirm_orders` (`id_orders`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `slider`;
CREATE TABLE `slider` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `sequence` INT(11) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
