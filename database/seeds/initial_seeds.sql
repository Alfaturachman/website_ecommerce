-- Initial Seed Data for Nomadenstuff E-Commerce System

-- 1. Default Administrator Account (username: admin, password: admin)
INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$0p2m9D4W1w1.Y7aOQ4Zk9.7A4aO7Z4O7Z4O7Z4O7Z4O7Z4O7Z4O7Z', 'admin')
ON DUPLICATE KEY UPDATE `id` = `id`;

-- 2. Initial Categories
INSERT INTO `category` (`id`, `title`, `slug`) VALUES
(1, 'Jaket & Outerwear', 'jaket-outerwear'),
(2, 'Sepatu & Sneakers', 'sepatu-sneakers'),
(3, 'T-Shirt & Kemeja', 't-shirt-kemeja'),
(4, 'Aksesoris & Tas', 'aksesoris-tas')
ON DUPLICATE KEY UPDATE `id` = `id`;

-- 3. Initial Sample Slider Banner
INSERT INTO `slider` (`id`, `title`, `sequence`, `image`) VALUES
(1, 'Promo Spesial Koleksi Terbaru', 1, 'banner-1.jpg'),
(2, 'Diskon Hingga 50% Cuci Gudang', 2, 'banner-2.jpg')
ON DUPLICATE KEY UPDATE `id` = `id`;
