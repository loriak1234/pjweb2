-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 20, 2022 lúc 06:24 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gracefuldb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Hoang Khang', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pd_name` varchar(100) NOT NULL,
  `pd_price` varchar(50) NOT NULL,
  `pd_img` varchar(255) NOT NULL,
  `pd_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `pd_name`, `pd_price`, `pd_img`, `pd_qty`) VALUES
(1, 3, 'Flexible Bag ', '250', 'Flexible Bumbag 0.png', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Backpacks'),
(2, 'Bags'),
(3, 'Tote Bags');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image_detail`
--

CREATE TABLE `image_detail` (
  `image_ID` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img_detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `image_detail`
--

INSERT INTO `image_detail` (`image_ID`, `product_id`, `img_detail`) VALUES
(17, 1, 'Anthem Leather Bag-3.png'),
(18, 1, 'Anthem Leather Bag-1.png'),
(19, 1, 'Anthem Leather Bag-2.png'),
(20, 2, 'Duffle Bag 1.png'),
(21, 2, 'Duffle Bag 2.png'),
(22, 2, 'Duffle Bag 3.png'),
(23, 3, 'Flexible Bumbag 1.png'),
(24, 3, 'Flexible Bumbag 2.png'),
(25, 3, 'Flexible Bumbag 3.png'),
(26, 4, 'Journal Cross Bag 1.png'),
(27, 4, 'Journal Cross Bag 2.png'),
(28, 4, 'Journal Cross Bag 3.png'),
(29, 5, 'Avail Backpack 1.png'),
(30, 5, 'Avail Backpack 2.png'),
(31, 5, 'Avail Backpack 3.png'),
(32, 6, 'ECLIPSE LEATHER BACKPACK 1.png'),
(33, 6, 'ECLIPSE LEATHER BACKPACK 2.png'),
(34, 6, 'ECLIPSE LEATHER BACKPACK 3.png'),
(35, 7, 'Flexible Plastic Backpack 1.png'),
(36, 7, 'Flexible Plastic Backpack 2.png'),
(37, 7, 'Flexible Plastic Backpack 3.png'),
(38, 8, 'Icon Tartan Backpack 1.png'),
(39, 8, 'Icon Tartan Backpack 2.png'),
(40, 8, 'Icon Tartan Backpack 3.png'),
(41, 9, 'Lollipop Backpack 1.png'),
(42, 9, 'Lollipop Backpack 2.png'),
(43, 9, 'Lollipop Backpack 3.png'),
(44, 10, 'Anthem Leather Tote Bag 1.png'),
(45, 10, 'Anthem Leather Tote Bag 2.png'),
(46, 10, 'Anthem Leather Tote Bag 3.png'),
(47, 11, 'Black Tote Bag 1.png'),
(48, 11, 'Black Tote Bag 2.png'),
(49, 12, 'ECLIPSE LEATHER TOTE BAG 2.png'),
(50, 12, 'ECLIPSE LEATHER TOTE BAG 3.png'),
(51, 12, 'ECLIPSE LEATHER TOTE BAG 4.png'),
(52, 13, 'Journal Tote Bag 1.png'),
(53, 13, 'Journal Tote Bag 2.png'),
(54, 13, 'Journal Tote Bag 3.png'),
(55, 14, 'Meshy Cross Bag1.png'),
(56, 14, 'Meshy Cross Bag2.png'),
(57, 14, 'Meshy Cross Bag3.png'),
(58, 15, 'Messenger Bag2.png'),
(59, 15, 'Messenger Bag3.png'),
(60, 15, 'Messenger Bag4.png'),
(61, 16, 'Pouch Bag1.png'),
(62, 16, 'Pouch Bag2.png'),
(63, 16, 'Pouch Bag3.png'),
(64, 17, 'Flapped Backpack1.png'),
(65, 17, 'Flapped Backpack2.png'),
(66, 17, 'Flapped Backpack3.png'),
(67, 18, 'Nomadic Backpack1.png'),
(68, 18, 'Nomadic Backpack2.png'),
(69, 18, 'Nomadic Backpack3.png'),
(70, 19, ''),
(71, 19, 'Printed Mini Backpack2.png'),
(72, 19, 'Printed Mini Backpack3.png'),
(73, 20, ''),
(74, 20, 'ECLIPSE LEATHER CROCERY BAG 2.png'),
(75, 20, 'ECLIPSE LEATHER CROCERY BAG 3.png'),
(76, 21, ''),
(77, 21, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` varchar(50) NOT NULL,
  `invoice_code` varchar(50) NOT NULL,
  `note` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `user_id`, `product_id`, `quantity`, `total_price`, `invoice_code`, `note`, `date`, `status`) VALUES
(1, 1, 1, 3, '830', '4538', 'Before weekend, thanks', '2022-05-20 16:19:17', 0),
(2, 1, 2, 1, '830', '4538', 'Before weekend, thanks', '2022-05-20 16:19:17', 0),
(3, 1, 19, 1, '498.9', '8496', '', '2022-05-20 16:09:21', 0),
(4, 1, 3, 1, '498.9', '8496', '', '2022-05-20 16:09:21', 0),
(5, 1, 13, 1, '867.4', '883', 'Call before shipping, please', '2022-05-20 16:09:48', 0),
(6, 1, 10, 1, '867.4', '883', 'Call before shipping, please', '2022-05-20 16:09:48', 0),
(7, 1, 11, 1, '867.4', '883', 'Call before shipping, please', '2022-05-20 16:09:48', 0),
(8, 2, 9, 1, '1836.5', '8993', 'Please ship within working hours', '2022-05-20 16:15:36', 0),
(9, 2, 18, 5, '1836.5', '8993', 'Please ship within working hours', '2022-05-20 16:15:36', 0),
(10, 2, 8, 1, '665', '1725', 'Please dont ship in the morning', '2022-05-20 16:19:20', 1),
(11, 2, 3, 1, '665', '1725', 'Please dont ship in the morning', '2022-05-20 16:19:20', 1),
(12, 2, 20, 1, '225', '6146', 'Ship after 2pm please', '2022-05-20 16:18:33', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `product_material` varchar(255) NOT NULL,
  `product_active` int(11) NOT NULL,
  `product_description` varchar(355) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `product_name`, `product_price`, `product_quantity`, `product_image`, `product_material`, `product_active`, `product_description`) VALUES
(1, 2, 'Anthem Leather Bag', '200', 50, 'Anthem Leather Bag.png', '<br>- Main fabric: waterproof PU coated polyester <br>- Water slide lining fabric', 1, '- Interior design includes 1 large main compartment, 2 small side compartments <br>\r\n- Dimensions: 30 x 38 x 8 cm\r\n'),
(2, 2, 'Duffle Bag ', '150', 120, 'Duffle Bag 0.png', '<br>- Main fabric: waterproof PU coated polyester <br>- Water slide lining fabric', 1, '- Interior design includes 1 large main compartment, 2 small side compartments <br>\n- Dimensions: 30 x 38 x 8 cm\n'),
(3, 2, 'Flexible Bag ', '250', 200, 'Flexible Bumbag 0.png', '<br>- Main fabric: waterproof PU coated polyester <br> - Water slide lining fabric', 1, '- Interior design includes 1 large main compartment, 2 small side compartments <br>\n- Dimensions: 30 x 38 x 8 cm\n'),
(4, 2, 'Journal Cross Bag ', '230', 300, 'Journal Cross Bag 0.png', '<br>- Main fabric: waterproof PU coated polyester <br> - Water slide lining fabric', 1, '- Interior design includes 1 large main compartment, 2 small side compartments <br>\n- Dimensions: 30 x 38 x 8 cm\n'),
(5, 1, 'Avail Backpack ', '300', 150, 'Avail Backpack 0.png', '<br> - Main fabric: Water-repellent PU coated polyester fabric <br> - Lining fabric: water slide', 1, 'Design includes: <br>\r\n- Inside: 1 large main compartment, 1 laptop shockproof compartment and 1 small auxiliary compartment <br>\r\n- Outside: 3 front side pockets + 1 round accessory pocket with hook <br>\r\nFoam padded strap with anti-fatigue function when wearing <br>\r\nDimensions: 40 x 28 x 15 (cm)'),
(6, 1, 'ECLIPSE LEATHER BACKPACK ', '350', 200, 'ECLIPSE LEATHER BACKPACK 0.png', '- Main fabric: Water-repellent PU coated polyester fabric <br> - Lining fabric: water slide <br>', 1, 'Design includes: <br>\n- Inside: 1 large main compartment, 1 laptop shockproof compartment and 1 small auxiliary compartment <br>\n- Outside: 3 front side pockets + 1 round accessory pocket with hook <br>\nFoam padded strap with anti-fatigue function when wearing <br>\nDimensions: 40 x 28 x 15 (cm)'),
(7, 1, 'Flexible Plastic Backpack ', '300', 120, 'Flexible Plastic Backpack 0.png', '- Main fabric: Water-repellent PU coated polyester fabric <br> - Lining fabric: water slide <br>', 1, 'Design includes: <br>\n- Inside: 1 large main compartment, 1 laptop shockproof compartment and 1 small auxiliary compartment <br>\n- Outside: 3 front side pockets + 1 round accessory pocket with hook <br>\nFoam padded strap with anti-fatigue function when wearing <br>\nDimensions: 40 x 28 x 15 (cm)'),
(8, 1, 'Icon Tartan Backpack ', '350', 260, 'Icon Tartan Backpack 0.png', '- Main fabric: Water-repellent PU coated polyester fabric <br> - Lining fabric: water slide <br>', 1, 'Design includes: <br>\n- Inside: 1 large main compartment, 1 laptop shockproof compartment and 1 small auxiliary compartment <br>\n- Outside: 3 front side pockets + 1 round accessory pocket with hook <br>\nFoam padded strap with anti-fatigue function when wearing <br>\nDimensions: 40 x 28 x 15 (cm)'),
(9, 1, 'Lollipop Backpack ', '170', 199, 'Lollipop Backpack 0.png', '- Main fabric: Water-repellent PU coated polyester fabric <br> - Lining fabric: water slide <br>', 1, 'Design includes: <br>\n- Inside: 1 large main compartment, 1 laptop shockproof compartment and 1 small auxiliary compartment <br>\n- Outside: 3 front side pockets + 1 round accessory pocket with hook <br>\nFoam padded strap with anti-fatigue function when wearing <br>\nDimensions: 40 x 28 x 15 (cm)'),
(10, 3, 'Anthem Leather Tote Bag ', '259', 453, 'Anthem Leather Tote Bag 0.png', '<br>- High quality PU leather material <br>\n- Lining fabric: water slide<br>', 1, '- Dimensions: 38x42 cm'),
(11, 3, 'Black Tote Bag ', '156', 123, 'Black Tote Bag 0.png', '<br>- High quality PU leather material <br>\n- Lining fabric: water slide<br>', 1, '- Dimensions: 38x42 cm'),
(12, 3, 'ECLIPSE LEATHER TOTE BAG ', '321', 528, 'ECLIPSE LEATHER TOTE BAG 1.png', '<br>- High quality PU leather material <br>\n- Lining fabric: water slide<br>', 1, '- Dimensions: 38x42 cm'),
(13, 3, 'Journal Tote Bag ', '369', 123, 'Journal Tote Bag 0.png', '<br>- High quality PU leather material <br>\n- Lining fabric: water slide<br>', 1, '- Dimensions: 38x42 cm'),
(14, 2, 'Meshy Cross Bag', '180', 423, 'Meshy Cross Bag.png', '<br>- Main fabric: waterproof PU coated polyester <br>- Water slide lining fabric', 1, '- Interior design includes 1 large main compartment, 2 small side compartments <br>\n- Dimensions: 30 x 38 x 8 cm\n'),
(15, 2, 'Messenger Bag', '199', 495, 'Messenger Bag.png', '<br>- Main fabric: waterproof PU coated polyester <br>- Water slide lining fabric', 1, '- Interior design includes 1 large main compartment, 2 small side compartments <br>\n- Dimensions: 30 x 38 x 8 cm\n'),
(16, 2, 'Pouch Bag', '230', 423, 'Pouch Bag.png', '<br>- Main fabric: waterproof PU coated polyester <br>- Water slide lining fabric', 1, '- Interior design includes 1 large main compartment, 2 small side compartments <br>\n- Dimensions: 30 x 38 x 8 cm\n'),
(17, 1, 'Flapped Backpack', '200', 351, 'Flapped Backpack.png', '- Main fabric: Water-repellent PU coated polyester fabric <br> - Lining fabric: water slide <br>', 1, 'Design includes: <br>\n- Inside: 1 large main compartment, 1 laptop shockproof compartment and 1 small auxiliary compartment <br>\n- Outside: 3 front side pockets + 1 round accessory pocket with hook <br>\nFoam padded strap with anti-fatigue function when wearing <br>\nDimensions: 40 x 28 x 15 (cm)'),
(18, 1, 'Nomadic Backpack', '299', 100, 'Nomadic Backpack.png', '- Main fabric: Water-repellent PU coated polyester fabric <br> - Lining fabric: water slide <br>', 1, 'Design includes: <br>\n- Inside: 1 large main compartment, 1 laptop shockproof compartment and 1 small auxiliary compartment <br>\n- Outside: 3 front side pockets + 1 round accessory pocket with hook <br>\nFoam padded strap with anti-fatigue function when wearing <br>\nDimensions: 40 x 28 x 15 (cm)'),
(19, 1, 'Printed Mini Backpack', '199', 220, 'Printed Mini Backpack.png', '- Main fabric: Water-repellent PU coated polyester fabric <br> - Lining fabric: water slide <br>', 1, 'Design includes: <br>\n- Inside: 1 large main compartment, 1 laptop shockproof compartment and 1 small auxiliary compartment <br>\n- Outside: 3 front side pockets + 1 round accessory pocket with hook <br>\nFoam padded strap with anti-fatigue function when wearing <br>\nDimensions: 40 x 28 x 15 (cm)'),
(20, 2, 'ECLIPSE LEATHER CROCERY BAG ', '200', 222, 'ECLIPSE LEATHER CROCERY BAG.png', '<br>- Main fabric: waterproof PU coated polyester <br>- Water slide lining fabric', 1, '- Interior design includes 1 large main compartment, 2 small side compartments <br>\n- Dimensions: 30 x 38 x 8 cm\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `transaction_code` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `user_id`, `product_id`, `quantity`, `total_price`, `transaction_code`, `date`, `status`) VALUES
(1, 1, 1, 3, '830', 4538, '2022-05-20 16:19:17', 0),
(2, 1, 2, 1, '830', 4538, '2022-05-20 16:19:17', 0),
(3, 1, 19, 1, '498.9', 8496, '2022-05-20 16:09:21', 0),
(4, 1, 3, 1, '498.9', 8496, '2022-05-20 16:09:21', 0),
(5, 1, 13, 1, '867.4', 883, '2022-05-20 16:09:48', 0),
(6, 1, 10, 1, '867.4', 883, '2022-05-20 16:09:48', 0),
(7, 1, 11, 1, '867.4', 883, '2022-05-20 16:09:48', 0),
(8, 2, 9, 1, '1836.5', 8993, '2022-05-20 16:15:36', 0),
(9, 2, 18, 5, '1836.5', 8993, '2022-05-20 16:15:36', 0),
(10, 2, 8, 1, '665', 1725, '2022-05-20 16:19:20', 1),
(11, 2, 3, 1, '665', 1725, '2022-05-20 16:19:20', 1),
(12, 2, 20, 1, '225', 6146, '2022-05-20 16:18:33', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `phone`, `email`, `address`, `password`, `active`) VALUES
(1, 'Tan Phat', '091382910', 'phat@gmail.com', 'Ha Noi', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'Nhut Hoang', '0911342984', 'Nhut@gmail.com', 'Ha Noi', 'e10adc3949ba59abbe56e057f20f883e', 1),
(3, 'Khang Nguyen', '091382910', 'Khang@gmail.com', 'TPHCM', 'e10adc3949ba59abbe56e057f20f883e', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `image_detail`
--
ALTER TABLE `image_detail`
  ADD PRIMARY KEY (`image_ID`);

--
-- Chỉ mục cho bảng `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `image_detail`
--
ALTER TABLE `image_detail`
  MODIFY `image_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT cho bảng `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
