-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 10:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `giftshope`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(25) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  `admin_email_id` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_password`, `admin_email_id`, `created_at`) VALUES
(1, 'Humayu Mistry', 'humayu@123', 'humayu@gmail.com', '2024-12-12 09:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('ordered','not ordered','removed') DEFAULT 'not ordered',
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `product_id`, `product_name`, `product_price`, `quantity`, `created_at`, `status`, `category_id`) VALUES
(1, 2, 4, 'Blender', 89.99, 3, '2024-12-12 14:06:15', 'removed', 4),
(2, 2, 13, ',ncackn', 400.00, 1, '2024-12-16 06:31:30', 'removed', 12),
(3, 2, 3, 'Novel', 19.99, 5, '2024-12-16 06:31:42', 'removed', 3),
(4, 2, 9, ',ncackn', 600.00, 1, '2024-12-16 06:32:55', 'removed', 8),
(5, 2, 19, 'lKCamll', 410.00, 1, '2024-12-16 06:34:03', 'ordered', 17),
(6, 2, 8, 'jcjSKJchkjHk', 300.00, 1, '2024-12-16 07:10:10', 'ordered', 6),
(7, 2, 3, 'Novel', 19.99, 1, '2024-12-16 07:10:26', 'ordered', 3),
(8, 2, 6, 'nrkjfnwfr', 500.00, 1, '2024-12-16 07:14:23', 'ordered', 1),
(9, 2, 12, 'LKMDLd', 522.00, 1, '2024-12-16 07:14:32', 'ordered', 11),
(10, 2, 5, 'Soccer Ball', 29.99, 1, '2024-12-16 07:14:56', 'ordered', 5),
(11, 2, 8, 'jcjSKJchkjHk', 300.00, 1, '2024-12-16 07:18:03', 'ordered', 6),
(12, 2, 3, 'Novel', 19.99, 1, '2024-12-16 07:46:53', 'removed', 3),
(13, 2, 8, 'jcjSKJchkjHk', 300.00, 1, '2024-12-16 07:47:15', 'removed', 6),
(14, 2, 8, 'jcjSKJchkjHk', 300.00, 1, '2024-12-16 08:05:45', 'ordered', 6),
(15, 2, 3, 'Novel', 19.99, 1, '2024-12-16 08:05:53', 'ordered', 3),
(16, 2, 3, 'Novel', 19.99, 5, '2024-12-16 08:35:31', 'ordered', 3),
(17, 2, 3, 'Novel', 19.99, 4, '2024-12-16 09:48:13', 'ordered', 3),
(18, 2, 4, 'Blender', 89.99, 16, '2024-12-16 09:59:01', 'ordered', 4),
(19, 2, 4, 'Blender', 89.99, 1, '2024-12-16 10:42:12', 'ordered', 4),
(20, 2, 3, 'Novel', 19.99, 5, '2024-12-16 11:02:51', 'ordered', 3),
(21, 2, 4, 'Blender', 89.99, 45, '2024-12-16 11:03:22', 'ordered', 4),
(22, 2, 14, 'akfmla', 655.00, 24, '2024-12-16 11:08:08', 'ordered', 1),
(23, 2, 6, 'nrkjfnwfr', 500.00, 2, '2024-12-16 11:10:38', 'ordered', 1),
(24, 2, 14, 'akfmla', 655.00, 1, '2024-12-16 11:23:46', 'removed', 1),
(25, 2, 8, 'jcjSKJchkjHk', 300.00, 1, '2024-12-16 12:07:55', 'ordered', 6),
(26, 2, 15, 'lkzmvklzd', 565.00, 3, '2024-12-16 12:08:02', 'removed', 14),
(27, 2, 4, 'Blender', 89.99, 5, '2024-12-16 13:21:01', 'ordered', 4),
(28, 2, 6, 'nrkjfnwfr', 500.00, 2, '2024-12-16 13:25:14', 'ordered', 1),
(29, 2, 9, ',ncackn', 600.00, 3, '2024-12-16 13:25:34', 'ordered', 8),
(30, 2, 6, 'nrkjfnwfr', 500.00, 2, '2024-12-16 13:28:02', 'ordered', 1),
(31, 2, 12, 'LKMDLd', 522.00, 2, '2024-12-16 13:28:11', 'ordered', 11),
(32, 2, 6, 'nrkjfnwfr', 500.00, 1, '2024-12-16 13:33:29', 'ordered', 1),
(33, 2, 5, 'Soccer Ball', 29.99, 3, '2024-12-16 13:33:36', 'ordered', 5),
(34, 2, 14, 'akfmla', 655.00, 1, '2024-12-21 07:05:29', 'ordered', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_id` int(11) NOT NULL,
  `Category_name` varchar(255) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Status` enum('Active','Inactive') NOT NULL,
  `Add_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_id`, `Category_name`, `Image`, `Status`, `Add_date`) VALUES
(1, 'Electronics', 'category_product_image/big1.jpg', 'Active', '2024-12-12 19:18:24'),
(2, 'Clothing', 'category_product_image/preloader.gif', 'Active', '2024-12-12 19:18:24'),
(3, 'Books', 'category_product_image/shuffle_2.jpg', 'Active', '2024-12-12 19:18:24'),
(4, 'Home Appliances', 'category_product_image/shuffle_4.jpg', 'Active', '2024-12-12 19:18:24'),
(5, 'Sports', 'category_product_image/big1.jpg', 'Active', '2024-12-12 19:18:24'),
(6, 'lkskgnskdnkn', 'category_product_image/category_1734026989_Screenshot 2024-06-16 160957.png', 'Active', '2024-12-12 23:39:49'),
(7, 'snfalaf', 'category_product_image/category_1734027530_IMG-20241128-WA0004[1].jpg', 'Inactive', '2024-12-12 23:48:50'),
(8, 'nanana', '\ncategory_product_image/category_1734027636_Screenshot 2024-03-20 192800.png', 'Active', '2024-12-12 23:50:36'),
(9, 'snfalaf', 'category_product_image/category_1734028127_Screenshot 2024-03-19 195635.png', 'Active', '2024-12-12 23:58:47'),
(10, 'mklDML', 'category_product_image/category_1734028501_Screenshot 2024-03-28 151647.png', 'Active', '2024-12-13 00:05:01'),
(11, 'lKDMLkndLDAK', 'category_product_image/category_1734028969_Screenshot 2024-03-23 005740.png', 'Active', '2024-12-13 00:12:49'),
(12, 'nanana', 'category_product_image/category_1734029148_Screenshot 2024-03-19 195606.png', 'Active', '2024-12-13 00:15:48'),
(13, 'mamammaama', 'category_product_image/category_1734029506_Screenshot 2024-08-03 094847.png', 'Inactive', '2024-12-13 00:21:46'),
(14, 'lsjmlskn', 'category_product_image/category_1734277945_Screenshot 2024-10-26 152534.png', 'Active', '2024-12-15 21:22:25'),
(15, ';slfk;l;', 'category_product_image/category_1734278678_Screenshot 2024-07-19 185536.png', 'Active', '2024-12-15 21:34:38'),
(16, 'lkFNcl', 'category_product_image/category_1734280175_Screenshot 2024-03-17 175955.png', 'Active', '2024-12-15 21:59:35'),
(17, 'LMdla', 'category_product_image/category_1734280310_Screenshot 2024-03-18 191341.png', 'Active', '2024-12-15 22:01:50'),
(18, ';alktg;e', 'category_product_image/category_1734281280_Screenshot 2024-03-19 230732.png', 'Active', '2024-12-15 22:18:00'),
(19, 'afls', 'category_product_image/category_1734281315_Screenshot 2024-03-23 085205.png', 'Active', '2024-12-15 22:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `address` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `phone`, `email`, `password`, `date_of_birth`, `gender`, `address`, `status`) VALUES
(1, 'Neel Patel', 9313516451, 'neel@gmail.com', '$2y$10$xMW14GuXEAEJPoA/N3UmMeB7UGHnYTugZxiaEKGJQS8HJbWLuJLgi', '2024-12-10', 'Male', 'nfl', 'inactive'),
(2, 'Henil Mistry', 8153080621, 'mistryh763@gmail.com', '$2y$10$p/oPOaoEFGjds9Vn/2jUXOq3JsTl2VrMD2Kqz3fgUUUXejfHtOwSm', '2004-04-27', 'Male', 'kjfkjnef', 'inactive'),
(3, 'Jack Tandel', 7894561235, 'jack@gmail.com', '$2y$10$p/oPOaoEFGjds9Vn/2jUXOq3JsTl2VrMD2Kqz3fgUUUXejfHtOwSm', '2024-12-03', 'Male', 'ac nalca', 'inactive'),
(4, 'Samarth Sorathia', 9513546984, 'samsorathia3184@gmail.com', '$2y$10$Jfuvtv9StGsgayJldNnnqe2V1fhCEu7eLpD5YmPYrt7VLC5dFhbKq', '2024-12-10', 'Male', 'kfjqwef', 'active'),
(5, 'Zed Patel', 7412589630, 'zed@gmail.com', '$2y$10$MHSzKH58q/HsYBeVWey1O.TRHivQKZM3zC2p5gJt8sBVBZikjw1tu', '2024-12-01', 'Male', 'mwqqmq;flmmqwmf[q\'wf;qf', 'active'),
(6, 'Veer Patel', 7894561235, 'veer@gmail.com', '$2y$10$p/oPOaoEFGjds9Vn/2jUXOq3JsTl2VrMD2Kqz3fgUUUXejfHtOwSm', '2024-12-02', 'Male', 'dnjwfkjkwjfnjnfnaklfnwkfw', 'active'),
(11, 'Smit Tandel', 7894561235, 'smith@gmail.com', '$2y$10$p/oPOaoEFGjds9Vn/2jUXOq3JsTl2VrMD2Kqz3fgUUUXejfHtOwSm', '2024-12-09', 'Male', 'cmjbcjBKCJBKjbckjbJKCNKJbcjbKJCBJKc', 'active'),
(12, 'John Doe', 1234567890, 'john.doe@example.com', 'hashed_password_here', '1990-01-01', 'Male', '123 Main St, City, Country', 'active'),
(13, 'Jane Smith', 2345678901, 'jane.smith@example.com', 'hashed_password_here', '1985-05-15', 'Female', '456 Oak Rd, Town, State', 'active'),
(14, 'Alice Johnson', 3456789012, 'alice.johnson@example.com', 'hashed_password_here', '1992-08-22', 'Female', '789 Pine Ln, Village, Country', 'active'),
(15, 'Bob Brown', 4567890123, 'bob.brown@example.com', 'hashed_password_here', '1988-11-30', 'Male', '101 Maple Ave, City, State', 'active'),
(16, 'Charlie Davis', 5678901234, 'charlie.davis@example.com', 'hashed_password_here', '1995-03-10', 'Male', '202 Birch Blvd, Town, Country', 'active'),
(17, 'Emily Martinez', 6789012345, 'emily.martinez@example.com', 'hashed_password_here', '1990-07-25', 'Female', '303 Cedar St, City, State', 'active'),
(18, 'David Wilson', 7890123456, 'david.wilson@example.com', 'hashed_password_here', '1987-12-05', 'Male', '404 Elm Rd, Village, State', 'active'),
(19, 'Sophia Lee', 8901234567, 'sophia.lee@example.com', 'hashed_password_here', '1993-06-17', 'Female', '505 Redwood Dr, Town, Country', 'active'),
(20, 'Michael Clark', 9012345678, 'michael.clark@example.com', 'hashed_password_here', '1984-09-13', 'Male', '606 Spruce Ct, City, State', 'active'),
(21, 'Olivia King', 1122334455, 'olivia.king@example.com', 'hashed_password_here', '1991-01-21', 'Female', '707 Walnut Ave, Village, Country', 'active'),
(22, 'James Harris', 2233445566, 'james.harris@example.com', 'hashed_password_here', '1989-04-30', 'Male', '808 Ash Blvd, City, State', 'active'),
(23, 'Isabella Walker', 3344556677, 'isabella.walker@example.com', 'hashed_password_here', '1994-11-02', 'Female', '909 Fir St, Village, Country', 'active'),
(24, 'Lucas Allen', 4455667788, 'lucas.allen@example.com', 'hashed_password_here', '1996-12-12', 'Male', '1010 Willow Dr, Town, State', 'active'),
(25, 'Mia Scott', 5566778899, 'mia.scott@example.com', 'hashed_password_here', '1983-08-25', 'Female', '1111 Maple Blvd, City, Country', 'active'),
(26, 'Benjamin Young', 6677889900, 'benjamin.young@example.com', 'hashed_password_here', '1992-02-14', 'Male', '1212 Oak St, Village, State', 'active'),
(27, 'Amelia Adams', 7788990011, 'amelia.adams@example.com', 'hashed_password_here', '1986-06-30', 'Female', '1313 Pine Ln, City, Country', 'active'),
(28, 'Ethan Perez', 8899001122, 'ethan.perez@example.com', 'hashed_password_here', '1998-05-05', 'Male', '1414 Birch Rd, Town, State', 'active'),
(29, 'Charlotte Rodriguez', 9900112233, 'charlotte.rodriguez@example.com', 'hashed_password_here', '1993-09-07', 'Female', '1515 Cedar Blvd, Village, State', 'active'),
(30, 'William Hall', 1011122334, 'william.hall@example.com', 'hashed_password_here', '1982-12-19', 'Male', '1616 Redwood Dr, City, Country', 'active'),
(31, 'Amelia Evans', 2122233445, 'amelia.evans@example.com', 'hashed_password_here', '1990-03-23', 'Female', '1717 Elm St, Village, Country', 'active'),
(32, 'Aayesh Sha', 9513546984, 'aayesh@gmail.com', '$2y$10$nCPkStDzCW4/86ATzHBeFuKVeqFNVrnOS2o4xSNQkaBLZa4uthy3G', '2024-12-08', 'Male', 'Patel Street Bunder Road Bilimora', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `deliverypersonnel`
--

CREATE TABLE `deliverypersonnel` (
  `DeliveryPersonnelID` int(11) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Gender` enum('Male','Female','Other') NOT NULL,
  `DateOfBirth` date NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `VehicleType` enum('Bike','Car','Van','Other') NOT NULL,
  `VehicleNumber` varchar(20) DEFAULT NULL,
  `DateOfJoining` date NOT NULL,
  `Status` enum('Active','Inactive') DEFAULT 'Active',
  `AssignedArea` varchar(100) DEFAULT NULL,
  `EmergencyContact` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliverypersonnel`
--

INSERT INTO `deliverypersonnel` (`DeliveryPersonnelID`, `FullName`, `Password`, `Gender`, `DateOfBirth`, `PhoneNumber`, `Email`, `Address`, `VehicleType`, `VehicleNumber`, `DateOfJoining`, `Status`, `AssignedArea`, `EmergencyContact`) VALUES
(1, 'Nanne Saha', '$2y$10$p/oPOaoEFGjds9Vn/2jUXOq3JsTl2VrMD2Kqz3fgUUUXejfHtOwSm', 'Female', '2024-12-01', '7894567891', 'nanne@gmail.com', 'kNC lkcn alkvna lsks LKA ', 'Bike', 'GJ 12 CC 0001', '2024-12-16', 'Active', 'Bilimora', '9856471235');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customerName` varchar(25) NOT NULL,
  `order_email` varchar(30) NOT NULL,
  `order_phone` bigint(11) NOT NULL,
  `order_address` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('order_completed','order_canceled','order_shipped') NOT NULL DEFAULT 'order_shipped',
  `DeliveryPersonnelID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cart_id`, `customer_id`, `customerName`, `order_email`, `order_phone`, `order_address`, `category_id`, `product_id`, `quantity`, `total_price`, `order_date`, `status`, `DeliveryPersonnelID`) VALUES
(1, 5, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 12, 13, 1, 1489.00, '2024-12-16 06:56:56', '', NULL),
(2, 5, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 3, 3, 4, 1489.00, '2024-12-16 06:56:56', '', NULL),
(3, 5, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 8, 9, 1, 1489.00, '2024-12-16 06:56:56', '', NULL),
(4, 5, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 17, 19, 1, 1489.00, '2024-12-16 06:56:56', '', NULL),
(5, 7, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 6, 8, 1, 319.00, '2024-12-16 07:10:58', '', NULL),
(6, 7, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 3, 3, 1, 319.00, '2024-12-16 07:10:58', '', NULL),
(7, 6, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 6, 8, 1, 300.00, '2024-12-16 07:13:11', '', NULL),
(8, 10, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 1, 6, 1, 1051.00, '2024-12-16 07:16:56', '', NULL),
(9, 10, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 11, 12, 1, 1051.00, '2024-12-16 07:16:56', '', NULL),
(10, 10, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 5, 5, 1, 1051.00, '2024-12-16 07:16:56', '', NULL),
(11, 11, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 1, 6, 1, 1322.00, '2024-12-16 07:18:40', '', NULL),
(12, 11, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 11, 12, 1, 1322.00, '2024-12-16 07:18:40', '', NULL),
(13, 11, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 6, 8, 1, 1322.00, '2024-12-16 07:18:40', '', NULL),
(14, 9, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 1, 6, 1, 1022.00, '2024-12-16 07:31:43', '', NULL),
(15, 9, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 11, 12, 1, 1022.00, '2024-12-16 07:31:43', '', NULL),
(16, 8, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 1, 6, 1, 500.00, '2024-12-16 07:31:52', '', NULL),
(17, 12, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 3, 3, 1, 319.00, '2024-12-16 08:05:08', '', NULL),
(18, 13, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 6, 8, 1, 319.00, '2024-12-16 08:05:08', '', NULL),
(19, 14, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 6, 8, 1, 319.00, '2024-12-16 08:06:37', '', NULL),
(20, 15, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 3, 3, 1, 319.00, '2024-12-16 08:06:37', '', NULL),
(21, 14, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 6, 8, 1, 319.00, '2024-12-16 08:17:30', '', NULL),
(22, 15, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 3, 3, 1, 319.00, '2024-12-16 08:17:30', '', NULL),
(23, 16, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 3, 3, 5, 99.00, '2024-12-16 09:47:25', '', NULL),
(24, 17, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 3, 3, 4, 1.00, '2024-12-16 10:41:27', '', NULL),
(25, 18, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 4, 4, 16, 1.00, '2024-12-16 10:41:27', '', NULL),
(26, 19, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 4, 4, 1, 89.00, '2024-12-16 10:42:17', '', NULL),
(27, 20, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 3, 3, 5, 4.00, '2024-12-16 11:05:43', '', NULL),
(28, 21, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 4, 4, 45, 4.00, '2024-12-16 11:05:43', '', NULL),
(29, 22, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 1, 14, 24, 15.00, '2024-12-16 11:08:38', '', NULL),
(30, 23, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 1, 6, 2, 1.00, '2024-12-16 12:04:19', 'order_shipped', NULL),
(31, 25, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 6, 8, 1, 300.00, '2024-12-16 12:20:15', 'order_shipped', NULL),
(32, 27, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 4, 4, 5, 449.00, '2024-12-16 13:21:13', 'order_shipped', NULL),
(33, 28, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 1, 6, 2, 2.00, '2024-12-16 13:25:46', 'order_shipped', NULL),
(34, 29, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 8, 9, 3, 2.00, '2024-12-16 13:25:46', 'order_shipped', NULL),
(35, 30, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 1, 6, 2, 2.00, '2024-12-16 13:28:21', 'order_shipped', NULL),
(36, 31, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 11, 12, 2, 2.00, '2024-12-16 13:28:21', 'order_shipped', NULL),
(37, 33, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 5, 5, 3, 89.00, '2024-12-16 13:39:15', 'order_shipped', NULL),
(38, 32, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 1, 6, 1, 500.00, '2024-12-16 13:39:15', 'order_shipped', NULL),
(39, 34, 2, 'Henil Mistry', 'mistryh763@gmail.com', 8153080621, 'kjfkjnef', 1, 14, 1, 655.00, '2024-12-21 07:06:12', 'order_shipped', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_id` int(11) NOT NULL,
  `Product_name` varchar(25) NOT NULL,
  `Product_description` varchar(25) DEFAULT NULL,
  `Product_image` varchar(255) DEFAULT NULL,
  `Product_price` decimal(10,2) NOT NULL,
  `Category_id` int(11) DEFAULT NULL,
  `status` enum('available','unavailable') NOT NULL DEFAULT 'available',
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_id`, `Product_name`, `Product_description`, `Product_image`, `Product_price`, `Category_id`, `status`, `quantity`) VALUES
(3, 'Novel', 'Best-selling book', 'category_product_image/shuffle_2.jpg', 19.99, 3, 'unavailable', 0),
(4, 'Blender', 'High-speed blender', 'category_product_image/shuffle_4.jpg', 89.99, 4, 'available', 1),
(5, 'Soccer Ball', 'Official size', 'category_product_image/preloader.gif', 29.99, 5, 'available', 1),
(6, 'nrkjfnwfr', 'sjhcbsjcbs', 'category_product_image/shuffle_2.jpg', 500.00, 1, 'available', 0),
(8, 'jcjSKJchkjHk', 'klvh sfh jshf hjzhf shs;z', 'category_product_image/product_1734280310_Screenshot 2024-08-03 094847.png', 300.00, 6, 'available', 0),
(9, ',ncackn', 'kjnkjznkvzj', 'category_product_image/category_1734027636_Screenshot 2024-03-20 192800.png', 600.00, 8, 'available', 3),
(10, 'alkcmslakcma', 'lakncjces ', 'category_product_image/product_1734281315_Screenshot 2024-03-20 192800.png', 400.00, 9, 'available', 66),
(11, 'AKSNCA', 'landlaAakena', 'category_product_image/product_1734281315_Screenshot 2024-03-20 192800.png', 410.00, 10, 'available', 7),
(12, 'LKMDLd', 'KMDldad', 'category_product_image/product_1734280310_Screenshot 2024-03-20 192659.png', 522.00, 11, 'available', 3),
(13, ',ncackn', 'lakwlkaw', 'category_product_image/product_1734281315_Screenshot 2024-03-20 192800.png', 400.00, 12, 'available', 6),
(14, 'akfmla', 'lkMFLskfnz Ls', 'category_product_image/product_1734281315_Screenshot 2024-03-20 192800.png', 655.00, 1, 'available', 0),
(15, 'lkzmvklzd', 'lxk,msldsbsnk', 'category_product_image/product_1734277945_Screenshot 2024-10-26 152502.png', 565.00, 14, 'available', 5),
(16, ';lafmlazskvn', 'lknlkn', 'category_product_image/product_1734278678_Screenshot 2024-06-16 160957.png', 255.00, 15, 'available', 5),
(17, 'm,FNsSLak', 'lknalfnskn', 'category_product_image/product_1734280175_Screenshot 2024-06-16 160957.png', 600.00, 16, 'available', 5),
(18, 'kzfnslzk', 'lklKNF', 'category_product_image/product_1734280310_Screenshot 2024-03-19 230732.png', 200.00, 17, 'available', 0),
(19, 'lKCamll', 'kjCKZJ', 'category_product_image/product_1734280310_Screenshot 2024-03-20 192659.png', 410.00, 17, 'available', 0),
(20, 'lzfm;zslsmz', 'lk,fmvz;sl ;lsam; ;ald a;', 'category_product_image/product_1734280310_Screenshot 2024-08-03 094847.png', 130.00, 17, 'available', 0),
(21, ',KNsll', 'klanflsk', 'category_product_image/product_1734280310_Screenshot 2024-08-03 094847.png', 250.00, 17, 'available', 0),
(22, 'akfn', 'lkmzlsk', 'category_product_image/product_1734281315_Screenshot 2024-03-20 192800.png', 200.00, 18, 'available', 0),
(23, ',ndakl', 'lknslkn', 'category_product_image/product_1734281315_Screenshot 2024-03-20 192800.png', 123.00, 19, 'available', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `deliverypersonnel`
--
ALTER TABLE `deliverypersonnel`
  ADD PRIMARY KEY (`DeliveryPersonnelID`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `VehicleNumber` (`VehicleNumber`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `FK_DeliveryPersonnel` (`DeliveryPersonnelID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_id`),
  ADD KEY `fk_Category` (`Category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `deliverypersonnel`
--
ALTER TABLE `deliverypersonnel`
  MODIFY `DeliveryPersonnelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`Product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`Category_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_DeliveryPersonnel` FOREIGN KEY (`DeliveryPersonnelID`) REFERENCES `deliverypersonnel` (`DeliveryPersonnelID`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`Category_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `product` (`Product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_Category` FOREIGN KEY (`Category_id`) REFERENCES `category` (`Category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
