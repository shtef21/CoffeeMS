-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2023 at 07:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeems`
--
CREATE DATABASE IF NOT EXISTS `coffeems` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `coffeems`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_icon`) VALUES
(1, 'Coffee', 'fa-solid fa-mug-saucer'),
(2, 'Tea', 'fa-solid fa-mug-hot'),
(3, 'Espresso', 'fa-solid fa-whiskey-glass'),
(4, 'Smoothies', 'fa-solid fa-blender'),
(5, 'Pastries', 'fa-solid fa-bread-slice'),
(6, 'Milk', 'fa-solid fa-cow'),
(7, 'Flavorings', 'fa-solid fa-fill-drip'),
(8, 'Iced Drinks', 'fa-solid fa-snowflake');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_price` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `category_id`, `item_name`, `item_price`) VALUES
(1, 1, 'Espresso', '1.40'),
(2, 1, 'Cappuccino', '1.97'),
(3, 1, 'Latte', '1.77'),
(4, 1, 'Americano', '1.59'),
(5, 1, 'Mocha', '2.07'),
(6, 1, 'Macchiato', '1.70'),
(7, 2, 'Green Tea', '1.18'),
(8, 2, 'Earl Grey', '1.33'),
(9, 2, 'Chai Tea', '1.48'),
(10, 2, 'Herbal Tea', '1.12'),
(11, 3, 'Single Espresso', '1.13'),
(12, 3, 'Double Espresso', '1.43'),
(13, 4, 'Strawberry Banana Smoothie', '1.68'),
(14, 4, 'Mango Tango Smoothie', '1.59'),
(15, 5, 'Croissant', '0.84'),
(16, 5, 'Muffin', '1.03'),
(17, 5, 'Danish Pastry', '1.20'),
(18, 5, 'Scone', '0.99'),
(19, 6, 'Almond Milk', '0.35'),
(20, 6, 'Soy Milk', '0.42'),
(21, 6, 'Oat Milk', '0.39'),
(22, 7, 'Vanilla Syrup', '0.25'),
(23, 7, 'Caramel Syrup', '0.30'),
(24, 7, 'Hazelnut Syrup', '0.32'),
(25, 8, 'Iced Coffee', '1.63'),
(26, 8, 'Iced Tea', '1.39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

/*
  USERS (BCRYPT used for password hashing):
    username=admin, password=admin
    username=user,  password=user
*/
INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `role`) VALUES
(1, 'admin@example.com', 'admin', '$2y$10$R6PYLuS3mFOjG.2j3ab0zOW5x.iyP6JTXIw0FUtNdUDgVFVhaEBai', 2),
(2, 'user@example.com', 'user', '$2y$10$4zXi07aND5SlsDiyMtbgqeD8A/RAAcMGld7VFfzFpW4X5RBZAazd2', 1),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
