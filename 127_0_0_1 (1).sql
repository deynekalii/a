-- 
-- Database: `restoran_db`
--
CREATE DATABASE IF NOT EXISTS `restoran_db` DEFAULT CHARACTER SET utf8mb4 COLLATE=utf8mb4_general_ci;
USE `restoran_db`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--
INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'TATLILAR'),
(4, 'Pideler'),
(5, 'Kahvaltı'),
(6, 'Çorbalar'),
(7, 'Tavaş Güveci'),
(8, 'Lahmacun'),
(10, 'İçecekler'),
(11, '1,5 PİDELER');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `status` varchar(16) NOT NULL DEFAULT 'Açık',
  `created_at` datetime DEFAULT current_timestamp(),
  `payment_type` varchar(20) DEFAULT NULL,
  `closed_by` int(11) DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--
INSERT INTO `orders` (`id`, `table_id`, `status`, `created_at`, `payment_type`, `closed_by`, `closed_at`) VALUES
(1, 2, 'Açık', '2025-06-23 19:19:22', NULL, NULL, NULL),
(2, 4, 'Açık', '2025-06-23 19:30:49', NULL, NULL, NULL),
(3, 1, 'Açık', '2025-06-23 19:31:11', NULL, NULL, NULL),
(4, 6, 'Kapalı', '2025-06-23 19:44:21', 'Nakit', 1, '2025-06-23 21:16:07'),
(5, 7, 'Kapalı', '2025-06-23 21:11:10', 'Kredi Kartı', 1, '2025-06-23 21:18:13'),
(6, 6, 'Kapalı', '2025-06-23 21:21:13', 'Nakit', 1, '2025-06-23 21:48:59'),
(7, 7, 'Kapalı', '2025-06-23 21:48:42', 'Kredi Kartı', 1, '2025-06-24 00:00:40'),
(8, 6, 'Kapalı', '2025-06-23 21:50:58', 'Nakit', 1, '2025-06-24 00:00:37'),
(9, 6, 'Kapalı', '2025-06-24 00:10:38', 'Nakit', 1, '2025-06-26 18:01:59'),
(10, 7, 'Açık', '2025-06-24 00:44:00', NULL, NULL, NULL),
(11, 8, 'Kapalı', '2025-06-24 00:56:14', 'Nakit', 1, '2025-06-24 02:46:58'),
(12, 9, 'Kapalı', '2025-06-24 02:18:02', 'Nakit', 1, '2025-06-24 02:46:46'),
(13, 10, 'Kapalı', '2025-06-24 02:37:42', 'Nakit', 1, '2025-06-24 02:42:46'),
(14, 10, 'Kapalı', '2025-06-24 02:42:48', 'Nakit', 1, '2025-06-24 02:46:43'),
(15, 8, 'Açık', '2025-06-24 02:47:11', NULL, NULL, NULL),
(16, 9, 'Kapalı', '2025-06-24 02:50:15', 'Nakit', 1, '2025-06-26 18:06:28'),
(17, 13, 'Kapalı', '2025-06-24 02:54:43', 'Nakit', 1, '2025-06-26 18:06:35'),
(18, 6, 'Kapalı', '2025-06-26 18:08:13', 'Nakit', 1, '2025-06-26 18:16:52'),
(19, 6, 'Kapalı', '2025-06-26 18:16:54', 'Kredi Kartı', 1, '2025-06-26 18:17:58'),
(20, 10, 'Açık', '2025-06-26 23:38:17', NULL, NULL, NULL),
(21, 6, 'Kapalı', '2025-06-26 23:39:18', 'Nakit', 1, '2025-06-27 01:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `qty`) VALUES
(1, 1, 3, 2),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 2, 3, 3),
(5, 3, 2, 3),
(6, 4, 45, 1),
(7, 4, 42, 4),
(8, 4, 42, 1),
(9, 4, 42, 1),
(10, 4, 42, 4),
(11, 5, 42, 1),
(12, 5, 42, 1),
(13, 5, 52, 1),
(14, 5, 45, 1),
(15, 6, 42, 1),
(16, 3, 45, 1),
(17, 3, 53, 5),
(18, 6, 42, 3),
(19, 6, 42, 3),
(20, 6, 53, 2),
(21, 7, 53, 1),
(22, 7, 53, 1),
(23, 8, 53, 1),
(32, 11, 54, 6),
(33, 11, 42, 7),
(34, 11, 3, 12),
(35, 11, 2, 3),
(36, 11, 45, 12),
(37, 11, 52, 1),
(46, 13, 52, 2),
(47, 13, 53, 1),
(48, 13, 3, 2),
(49, 13, 2, 3),
(50, 13, 45, 4),
(51, 13, 42, 1),
(52, 13, 54, 2),
(60, 15, 42, 2),
(61, 15, 45, 3),
(62, 15, 54, 5),
(63, 15, 2, 2),
(64, 15, 3, 2),
(65, 15, 53, 3),
(66, 15, 52, 4),
(74, 17, 42, 2),
(75, 17, 45, 1),
(76, 17, 54, 1),
(77, 17, 2, 1),
(78, 17, 3, 1),
(79, 17, 53, 1),
(80, 17, 52, 1),
(81, 9, 42, 1),
(82, 9, 45, 1),
(83, 9, 54, 1),
(84, 9, 3, 3),
(85, 9, 53, 1),
(86, 10, 54, 1),
(87, 10, 2, 1),
(88, 10, 3, 1),
(89, 10, 52, 2),
(90, 18, 42, 2),
(91, 18, 45, 1),
(92, 18, 2, 4),
(93, 18, 54, 2),
(94, 18, 52, 1),
(95, 18, 53, 1),
(96, 19, 54, 2),
(97, 19, 2, 1),
(98, 19, 3, 1),
(99, 19, 53, 1),
(100, 20, 42, 4),
(101, 20, 45, 1),
(102, 20, 54, 2),
(103, 20, 2, 3),
(104, 20, 3, 1),
(105, 20, 52, 2),
(106, 21, 52, 3),
(107, 21, 3, 5),
(108, 21, 2, 5),
(109, 21, 54, 3),
(110, 21, 45, 5),
(111, 21, 42, 3),
(112, 21, 53, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--
INSERT INTO `products` (`id`, `name`, `category_id`, `price`) VALUES
(2, 'KIYMALI', 4, 200.00),
(3, 'Kola', 10, 40.00),
(42, 'AYRAN', 10, 30.00),
(45, 'GAZOZ', 10, 40.00),
(52, 'SPESİAL BALLI', 2, 300.00),
(53, 'MERCİMEK', 6, 120.00),
(54, 'kelle paça', 6, 180.00);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--
CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `status` varchar(16) NOT NULL DEFAULT 'Boş',
  `group_name` varchar(32) DEFAULT 'İç Mekan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--
INSERT INTO `tables` (`id`, `name`, `status`, `group_name`) VALUES
(1, 'Masa 1', 'Dolu', 'İç Mekan'),
(2, 'Masa 2', 'Boş', 'İç Mekan'),
(3, 'Masa 3', 'Boş', 'İç Mekan'),
(4, 'Masa 4', 'Boş', 'İç Mekan'),
(5, 'Masa 5', 'Boş', 'İç Mekan'),
(6, 'MASA 1 DIŞ', 'Boş', 'Dış Cephe'),
(7, 'MASA 2 DIŞ', 'Dolu', 'Dış Cephe'),
(8, 'MASA 3 DIŞ', 'Dolu', 'Dış Cephe'),
(9, 'MASA 4 DIŞ', 'Boş', 'Dış Cephe'),
(10, 'MASA 5 DIŞ', 'Dolu', 'Dış Cephe'),
(11, 'MASA 6 DIŞ', 'Boş', 'Dış Cephe'),
(12, 'MASA 7 DIŞ', 'Boş', 'Dış Cephe'),
(13, 'MASA 8 DIŞ', 'Boş', 'Dış Cephe'),
(14, 'MASA 9 DIŞ', 'Boş', 'Dış Cephe'),
(15, 'MASA 10 DIŞ', 'Boş', 'Dış Cephe'),
(16, 'MASA 11 DIŞ', 'Boş', 'Dış Cephe'),
(17, 'MASA 12 DIŞ', 'Boş', 'Dış Cephe'),
(18, 'MASA 6', 'Boş', 'İç Mekan'),
(19, 'MASA 7', 'Boş', 'İç Mekan'),
(20, 'MASA 8', 'Boş', 'İç Mekan'),
(21, 'MASA 9', 'Boş', 'İç Mekan'),
(22, 'MASA 10', 'Boş', 'İç Mekan'),
(23, 'MASA 11', 'Boş', 'İç Mekan'),
(24, 'MASA 12', 'Boş', 'İç Mekan'),
(25, 'MASA 13', 'Boş', 'İç Mekan'),
(26, 'MASA14', 'Boş', 'İç Mekan'),
(27, 'MASA 15', 'Boş', 'İç Mekan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(16) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--
INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$0OZD8iLUO3dJoAIy6awEZu4H5pSd03XvvP.3DveO74k15.TOcf4bW', 'admin'),
(2, 'GARSON', '$2y$10$WDhbKYB.LxVzKf5nwmkMs.ErH7XdhUqwXIViIFhiIySvswCDPhx7S', 'personel'),
(5, 'mehmet', '$2y$10$3plRsb3HQYrPxMJ.iXbEC.0FJCqkelW7Qyqa9c1wVFs5nuDTJEB6C', 'admin');

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_id` (`table_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);