-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2023 at 04:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(75) NOT NULL,
  `moblie` varchar(15) NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `password`, `email`, `moblie`, `role`, `status`) VALUES
(1, 'admin', 'admin', '', '', 1, 1),
(2, 'khan', 'khan', 'khan@email.com', '03245342', 0, 1),
(4, 'ahmad', 'ahmad', 'ahmad@gmail.com', '2342342', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(75) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `brand_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`, `cat_id`, `brand_status`) VALUES
(1, 'Adidas', 21, 1),
(3, 'Panasonic', 23, 1),
(4, 'DELL', 23, 1),
(5, 'Infinix', 23, 1),
(7, 'Adidas', 22, 1),
(8, 'Woodee', 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categries`
--

CREATE TABLE `categries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categries`
--

INSERT INTO `categries` (`id`, `name`, `status`) VALUES
(21, 'Men', 1),
(22, 'Women', 1),
(23, 'Electronics', 1),
(24, 'Furtinure', 1);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `color`, `status`) VALUES
(1, 'red', 1),
(2, 'blue', 1),
(3, 'brown', 1),
(4, 'purple', 1),
(5, 'green', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mob_number` varchar(15) NOT NULL,
  `msg` text NOT NULL,
  `status` int(11) NOT NULL,
  `at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `user_name`, `email`, `mob_number`, `msg`, `status`, `at`) VALUES
(25, 'kamran', 'kamran@gamil.com', '0458974357', 'aaaaaaaaaaaaaaaaaaaaaa', 1, ' 11-Mar-2023 06:36:22'),
(27, 'fdg', 'kahn@gmail.com', '4', 'fffffffffffffff', 1, ' 11-Mar-2023 06:44:23'),
(28, 'fsd', 'kahn@gmail.com', 'fsd', 'dsff', 1, ' 11-Mar-2023 07:13:40'),
(29, 'xzxc', 'khan@gmail.com', 'x3', '3', 1, ' 11-Jul-2023 04:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `o_id` int(11) NOT NULL,
  `user_email` varchar(70) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(70) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `tatal_amount` float NOT NULL,
  `payment_type` varchar(70) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `order_status` int(11) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`o_id`, `user_email`, `country`, `city`, `phone`, `address`, `postal_code`, `tatal_amount`, `payment_type`, `payment_status`, `order_status`, `date`) VALUES
(1, 'khan@gmail.com', 'pakistan', 'pashawer', ' 45345', 'tangi (tahsil)', 3434, 40333, 'bank', ' pinding', 1, '02-Apr-2023 09:44:48'),
(2, 'khan@gmail.com', 'pakistan', 'pashawer', ' 34343', 'tangi (tahsil)', 454, 444, 'COD', ' success', 0, '02-Apr-2023 10:01:02'),
(3, 'khan@gmail.com', 'pakistan', 'pashawer', ' 090909', 'tangi (tahsil)', 555, 0, 'COD', ' success', 0, '02-Apr-2023 11:03:19'),
(4, 'khan@gmail.com', 'pakistan', 'pashawer', ' 45444', 'tangi (tahsil)', 444, 0, 'COD', ' success', 0, '02-Apr-2023 11:07:24'),
(5, 'khan@gmail.com', 'pakistan', 'pashawer', ' 45444', 'tangi (tahsil)', 444, 0, 'COD', ' success', 0, '02-Apr-2023 11:07:36'),
(6, 'khan@gmail.com', '00000', '0000', ' 0000', '00000', 0, 2400, 'COD', ' success', 0, '02-Apr-2023 11:14:26'),
(7, 'khan@gmail.com', '3', '3', ' 3', '3', 3, 1644, 'COD', ' success', 0, '11-Jul-2023 09:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_products_details`
--

CREATE TABLE `order_products_details` (
  `id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qtity` int(11) NOT NULL,
  `p_attr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_products_details`
--

INSERT INTO `order_products_details` (`id`, `o_id`, `p_id`, `qtity`, `p_attr_id`) VALUES
(1, 1, 21, 2, 30),
(2, 1, 27, 2, 16),
(3, 1, 30, 1, 20),
(4, 1, 30, 1, 21),
(5, 1, 30, 1, 19),
(6, 2, 87, 1, 9),
(7, 3, 27, 6, 16),
(8, 3, 26, 1, 27),
(9, 4, 26, 1, 25),
(10, 6, 26, 2, 28),
(11, 7, 21, 1, 30),
(12, 7, 87, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(0, 'Pinding'),
(1, 'Processing'),
(2, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `P_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `P_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(100) NOT NULL,
  `views` int(11) NOT NULL,
  `P_status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`P_id`, `cat_id`, `sub_cat_id`, `brand_id`, `P_name`, `description`, `img`, `views`, `P_status`, `admin_id`) VALUES
(21, 21, 2, 1, 'Printed Men Round Neck Blue T-Shirt', 'Get extra 5.0% off (price inclusive of discount) 10% Instant Discount on Federal Bank Debit Cards 10% Instant Discount on Bank Of Baroda Credit Cards', '6765872-fashion_07.jpg', 24, 1, 1),
(22, 23, 7, 3, 'Advace Panasonic Screen With Full Features', 'm ipsum dolor sit amet consectetur adipisicing elit. Dolores tenetur facilis necessitatibus aliquam veniam ullam reiciendis repudiandae fugiat ipsum culpa inventore velit, quasi minus beatae accusantium dolore. Placeat aperiam consequuntur dolore, vero consectetur sequi quos aspernatur odit excepturi! Dolorem laborum numquam ut error officia nemo voluptate aspernatur cupiditate excepturi quis!', '7136344-digital_09.jpg', 24, 1, 1),
(26, 21, 2, 1, 'Printed Round Neck Blue', 'Printed Men Round Neck Blue T-ShirtPrinted Men Round Neck Blue T-ShirtPrinted Men Round Neck Blue T-ShirtPrinted Men Round Neck Blue T-ShirtPrinted Men Round Neck Blue T-Shirt', '7543034-fashion_09.jpg', 21, 1, 1),
(27, 23, 9, 4, 'Lenovo Ideapad Flex 5 Core i3 10th Gen - (4 GB/256', 'Carry It Along 2 in 1 Laptop 14 inch Full HD LED Backlit Glossy IPS Touch Display (16:9 Aspect Ratio, 250 nits Brightness, Stylus Support) Light Laptop without Optical Disk Drive Shipping charges are calculated based on the number of units, distance and delivery date. For Plus customers, shipping charges are free. For non-Plus customers, if the total value of FAssured items is more than Rs.500, shipping charges are free. If the total value of FAssured items is less than Rs.500, shipping charges = Rs.40 per unit * For faster delivery, shipping charges will be applicable.', '3814281-digital_04.jpg', 15, 1, 1),
(29, 23, 9, 4, 'Laptop Upto 256 GB 16.56 cm (6.52 inch) HD+ Displa', '3 GB RAM | 32 GB ROM | Expandable Upto 256 GB 16.56 cm (6.52 inch) HD+ Display 12MP + 2MP | 5MP Front Camera 5000 mAh Battery Helio G70 Processor', '7232348-digital_14.jpg', 3, 1, 1),
(30, 23, 10, 5, 'Carry It Along 2 in 1 Laptop 14 inch Full HD LED ', 'Carry It Along 2 in 1 Laptop 14 inch Full HD LED Backlit Glossy IPS Touch Display (16:9 Aspect Ratio, 250 nits Brightness, Stylus Support) Light Laptop without Optical Disk Drive Shipping charges are calculated based on the number of units, distance and delivery date. For Plus customers, shipping charges are free. For non-Plus customers, if the total value of FAssured items is more than Rs.500, shipping charges are free. If the total value of FAssured items is less than Rs.500, shipping charges = Rs.40 per unit * For faster delivery, shipping charges will be applicable.', '3805552-digital_02.jpg', 8, 1, 2),
(87, 22, 4, 7, 'Advace Panasonic Screen With Full Features', 'ertertet', '7897615-download.jpg', 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `p_att_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`p_att_id`, `product_id`, `color_id`, `size_id`, `product_price`, `qty`) VALUES
(1, 78, 2, 1, 4334, 43434),
(4, 79, 2, 1, 5, 5),
(5, 85, 2, 1, 4, 4),
(6, 85, 3, 2, 3, 4),
(7, 85, 3, 4, 55, 55),
(8, 86, 2, 2, 0, 5),
(9, 87, 2, 1, 444, 44),
(12, 30, 2, 2, 10000, 3),
(14, 29, 2, 0, 33000, 33),
(16, 27, 2, 2, 699, 5),
(19, 30, 2, 4, 2000, 6),
(20, 30, 4, 3, 12000, 8),
(21, 30, 1, 4, 15, 5),
(22, 29, 7, 0, 20000, 5),
(23, 29, 5, 0, 40000, 2),
(24, 29, 3, 0, 50000, 6),
(25, 26, 0, 3, 1600, 4),
(26, 26, 0, 2, 1500, 2),
(27, 26, 0, 4, 2000, 1),
(28, 26, 0, 1, 1200, 7),
(29, 26, 0, 3, 1600, 4),
(30, 21, 0, 0, 1200, 3),
(31, 21, 0, 0, 1200, 3),
(32, 22, 1, 1, 45, 5),
(33, 22, 2, 4, 43, 55),
(34, 22, 1, 2, 45, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_imgs`
--

CREATE TABLE `product_imgs` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `p_img` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_imgs`
--

INSERT INTO `product_imgs` (`id`, `pid`, `p_img`) VALUES
(2, 65, '3258-organics_spa_3.jpg'),
(3, 66, '7697-furniture_07.jpg'),
(8, 0, '2713-1598963343double-10.jpeg'),
(9, 0, '4884-1598963343double-10.jpeg'),
(26, 30, '483165-1598962160galaxy-a20s.jpeg'),
(27, 30, '819863-1598962665realme-c3.jpeg'),
(30, 30, '4062-1598962854lenovo.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `r_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `u_email` varchar(67) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` int(11) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`r_id`, `p_id`, `u_email`, `rating`, `comment`, `status`, `date`) VALUES
(1, 21, 'khan@gmail.com', 3, 'dsfsdf', 1, '26-Mar-2023 05:03:13'),
(2, 21, 'khan@gmail.com', 3, 'dff', 1, '26-Mar-2023 05:03:50'),
(3, 21, 'khan@gmail.com', 4, 'dfdsfsd', 1, '26-Mar-2023 05:03:46'),
(4, 21, 'khan@gmail.com', 5, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi in autem consequatur dolorum pariatur cupiditate molestiae tenetur nam dicta quasi animi unde, dolore ducimus facere quod praesentium eveniet explicabo? Sint.', 1, '26-Mar-2023 06:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `size` varchar(30) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `size`, `status`) VALUES
(1, 'S', 1),
(2, 'M', 1),
(3, 'X', 1),
(4, 'XXL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categries`
--

CREATE TABLE `sub_categries` (
  `sub_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sub_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categries`
--

INSERT INTO `sub_categries` (`sub_id`, `cat_id`, `title`, `sub_status`) VALUES
(2, 21, 'T-shirts', 1),
(3, 21, 'Caps', 1),
(4, 22, 'Saree', 1),
(5, 21, 'Watches', 1),
(6, 23, 'Camera', 1),
(7, 23, 'Screen', 1),
(9, 23, 'Laptops', 1),
(10, 23, 'Mobiles', 1),
(12, 24, 'Beds', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `created_at`, `updated_at`) VALUES
(8, 'admin', 'admin', 'admin@gmail.com', ' 14-Mar-2023 11:25:59', '14-Mar-2023 11:25:59'),
(9, 'khan', 'khan', 'khan@gmail.com', ' 14-Mar-2023 11:26:49', '14-Mar-2023 11:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `w_id` int(11) NOT NULL,
  `user_email` varchar(75) NOT NULL,
  `P_id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`w_id`, `user_email`, `P_id`, `date`) VALUES
(15, 'khan@gmail.com', 22, '23-Mar-2023 08:48:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categries`
--
ALTER TABLE `categries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `order_products_details`
--
ALTER TABLE `order_products_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`P_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`p_att_id`);

--
-- Indexes for table `product_imgs`
--
ALTER TABLE `product_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categries`
--
ALTER TABLE `sub_categries`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`w_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categries`
--
ALTER TABLE `categries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_products_details`
--
ALTER TABLE `order_products_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `P_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `p_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_imgs`
--
ALTER TABLE `product_imgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categries`
--
ALTER TABLE `sub_categries`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
