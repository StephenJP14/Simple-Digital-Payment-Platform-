-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 08:54 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `merchant_name` varchar(255) DEFAULT NULL,
  `merchant_id` int NOT NULL
);

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`merchant_name`, `merchant_id`) VALUES
('Bank Central Asia', 1),
('Bank Negara Indonesia', 2),
('Bank Mandiri', 3),
('Bank Republik Indonesia', 4);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int NOT NULL,
  `role_name` varchar(100) DEFAULT NULL
);

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `t_id` int NOT NULL,
  `sender_user_id` int DEFAULT NULL,
  `sender_merchant_id` int DEFAULT NULL,
  `receiver` int DEFAULT NULL,
  `t_timestamp` timestamp NULL DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `t_info` varchar(255) DEFAULT NULL
);

--
-- Triggers `transaction`
--
DELIMITER $$
CREATE TRIGGER `update_balance` AFTER INSERT ON `transaction` FOR EACH ROW BEGIN
    IF NEW.sender_user_id IS NOT NULL THEN
        -- If the sender is a user, deduct from their balance
        UPDATE user
        SET balance = balance - NEW.amount
        WHERE user_id = NEW.sender_user_id;
    END IF;
    
    -- Always add the amount to the receiver's balance
    UPDATE user
    SET balance = balance + NEW.amount
    WHERE user_id = NEW.receiver;
    
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` int NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_joined` date NOT NULL,
  `role_id` int DEFAULT NULL,
  `user_balance` int DEFAULT '0'
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`merchant_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `sender_user_id` (`sender_user_id`),
  ADD KEY `sender_merchant_id` (`sender_merchant_id`),
  ADD KEY `receiver` (`receiver`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `merchant_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `t_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
