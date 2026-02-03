-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 09, 2025 at 07:05 AM
-- Server version: 8.0.42
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ictmj`
--

-- --------------------------------------------------------

--
-- Table structure for table `pastpapers`
--

DROP TABLE IF EXISTS `pastpapers`;
CREATE TABLE IF NOT EXISTS `pastpapers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `year` year NOT NULL,
  `level` enum('O/L','A/L') NOT NULL,
  `description` text,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pastpapers`
--

INSERT INTO `pastpapers` (`id`, `title`, `year`, `level`, `description`, `file_path`, `created_at`) VALUES
(1, 'ICT 2024 - Paper I', '2024', 'O/L', 'Theory paper with marking scheme included', 'uploads/papers/ICT-2024-Paper1.pdf', '2025-10-05 05:50:43'),
(2, 'ICT 2024 - Paper II', '2024', 'O/L', 'Practical paper with marking scheme', 'uploads/papers/ICT-2024-Paper2.pdf', '2025-10-05 05:50:43'),
(3, 'ICT 2023 - Paper I', '2023', 'O/L', 'Theory paper with marking scheme included', 'uploads/papers/ICT-2023-Paper1.pdf', '2025-10-05 05:50:43'),
(4, 'ICT 2023 - Paper I', '2024', 'A/L', 'Theory paper with marking scheme included', 'uploads/papers/ICT-2023-Paper1.pdf', '2025-10-05 05:50:43'),
(5, 'ICT-2021', '2021', 'A/L', 'TEST DOC', 'uploads/papers/68e20fbc8b85b-Assignment 1.pdf', '2025-10-05 06:27:08'),
(6, 'TEST', '2055', 'O/L', 'test', 'uploads/papers/68e210915267f-Assignment 1.pdf', '2025-10-05 06:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `plan` varchar(100) NOT NULL,
  `status` enum('active','inactive','cancelled') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `phone` varchar(15) NOT NULL,
  `district` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `phone`, `district`) VALUES
(1, 'MAX', 'pathumn071@gmail.com', '$2y$10$w6zjc27zrb4mA8in.9jmVumOleX4Q3tt6g/IZTkvUs2M/DF3MX/3m', '2025-10-05 05:20:19', '0719158514', 'Kegalle'),
(2, 'kusum rajapaksha', 'kusum@gmail.com', '$2y$10$8L2D5ARPRigPsCmE5/l3neU9jOh6tUKdkAd5cBvYUzz7ZsJNn4vWe', '2025-10-06 08:34:00', '0123489567', 'Batticaloa'),
(3, 'madu', 'maduka@gmail.com', '$2y$10$AmcFHoku34l2OGrQT0ckbuu8FeLSkLX2upZ7Hxns3iZsuPAZx942q', '2025-10-09 03:28:25', '154976592', 'Hambantota'),
(4, 'Gothami Abewardana', 'maduabewardana98@gmail.com', '$2y$10$4fxxCT2ABiExfi0ADVlwU./kJl91c1I/mTuS7jW4v4sTCQOrvhRLm', '2025-10-09 05:09:17', '+94 775 673 773', 'Ratnapura');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `url` varchar(2556) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `year` year NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `category`, `url`, `created_at`, `year`) VALUES
(1, 'TEST', 'O/L', 'https://youtu.be/Xrma7eq6QNQ', '2025-10-05 07:02:37', '2025'),
(2, 'TEST 2', 'A/L', 'https://youtu.be/CtFDbDDcT24', '2025-10-05 07:23:22', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `video_access`
--

DROP TABLE IF EXISTS `video_access`;
CREATE TABLE IF NOT EXISTS `video_access` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `district` varchar(50) NOT NULL DEFAULT '',
  `video_id` text,
  `accessed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `video_access`
--

INSERT INTO `video_access` (`id`, `student_id`, `name`, `email`, `district`, `video_id`, `accessed_at`) VALUES
(1, 3, 'madu', 'maduka@gmail.com', '', '[\"video10\",\"video14\",\"video5\"]', '2025-10-09 05:41:51'),
(2, 4, 'Gothami Abewardana', 'maduabewardana98@gmail.com', 'Ratnapura', '[\"video10\",\"video1\",\"video15\",\"video4\",\"video12\",\"video6\"]', '2025-10-09 05:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `waitlist`
--

DROP TABLE IF EXISTS `waitlist`;
CREATE TABLE IF NOT EXISTS `waitlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `waitlist`
--

INSERT INTO `waitlist` (`id`, `email`) VALUES
(1, 'isurika@gmail.com'),
(2, 'monarawila98@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `video_access`
--
ALTER TABLE `video_access`
  ADD CONSTRAINT `video_access_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
