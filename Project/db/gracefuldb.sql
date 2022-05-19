-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 19, 2022 lúc 04:37 AM
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
(1, 5, 2, 1, '2425', '9207', 'Call before ship pls', '2022-05-18 22:00:26', 1),
(2, 5, 7, 1, '85.3', '6257', 'Not weekend, thanks', '2022-05-18 20:51:29', 0),
(3, 5, 3, 1, '85.3', '6257', 'Not weekend, thanks', '2022-05-18 20:51:29', 0),
(4, 5, 3, 3, '80.9', '6716', 'abcxyz', '2022-05-18 20:51:56', 0),
(5, 5, 5, 1, '84.2', '3102', '', '2022-05-18 23:42:22', 0),
(6, 5, 7, 1, '84.2', '3102', '', '2022-05-18 23:42:22', 0);

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
  `product_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `product_name`, `product_price`, `product_quantity`, `product_image`, `product_material`, `product_active`, `product_description`) VALUES
(1, 2, 'bag1', '2999', 13, 'day.png', '4', 1, 'abc4'),
(2, 1, 'backpack2', '2200', 31, 'daychuyen.png', 'a', 1, 'abc'),
(3, 1, 'backpack3', '23', 3, 'day.png', '455', 1, 'abc'),
(4, 1, 'backpack4', '24', 3, 'day.png', '4', 1, 'abc'),
(5, 1, 'backpack5', '22', 3, 'ap1.png', 'abc', 1, 'abc45'),
(6, 1, 'backpack6', '23', 3, 'day.png', 'abcz', 1, 'abc'),
(7, 3, 'Tote1', '50', 10, 'lactay.png', 'ABC', 1, 'ABCXYZ'),
(9, 3, 'Tote3', '500', 10, 'lactay.png', 'asldksad', 1, 'tb01iasd'),
(11, 2, 'bag2', '259', 10, 'day.png', '2133', 1, 'bag1 sadsadsa');

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
(1, 5, 2, 1, '2425', 9207, '2022-05-18 22:00:26', 1),
(2, 5, 7, 1, '85.3', 6257, '2022-05-18 20:51:29', 0),
(3, 5, 3, 1, '85.3', 6257, '2022-05-18 20:51:29', 0),
(4, 5, 3, 3, '80.9', 6716, '2022-05-18 20:51:56', 0),
(5, 5, 5, 1, '84.2', 3102, '2022-05-18 23:42:22', 0),
(6, 5, 7, 1, '84.2', 3102, '2022-05-18 23:42:22', 0);

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
(3, 'Khang Tran', '091382910', 'Khang@gmail.com', 'Ha Noi', 'e10adc3949ba59abbe56e057f20f883e', 1),
(4, 'Kiet Phan', '091382910', 'Kiet@gmail.com', 'Ha Noi', 'e10adc3949ba59abbe56e057f20f883e', 1),
(5, 'Ngoc Nghia', '091382910', 'Nghia@gmail.com', 'Ha Noi', 'e10adc3949ba59abbe56e057f20f883e', 1);

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
  MODIFY `image_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
