-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2025 at 04:03 AM
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
-- Database: `sportis`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `max_participants` int(11) NOT NULL,
  `event_time_start` datetime NOT NULL,
  `event_time_end` datetime DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `creator_id`, `field_id`, `max_participants`, `event_time_start`, `event_time_end`, `description`) VALUES
(1, 'Turneu tenis local', 1, 11, 10, '2025-06-16 00:00:00', '2025-06-16 03:03:00', 'nocturn'),
(2, 'Tenis', 1, 152, 10, '2025-06-14 03:36:00', '2025-06-14 07:36:00', 'Eveniment dedicat incepatorilor'),
(4, 'Maraton', 1, 33, 100, '2025-06-16 01:48:00', '2025-06-16 05:48:00', 'Maraton nocturn'),
(9, 'Street Fight Festival', 1, 198, 100, '2025-06-16 05:03:00', '2025-06-16 09:03:00', 'Eveniment cultural'),
(10, 'Eveniment', 2, 75, 20, '2025-06-16 02:35:00', '2025-06-16 05:36:00', 'Eveniment incognito'),
(11, 'Eveniment', 2, 75, 20, '2025-06-16 02:35:00', '2025-06-16 05:36:00', 'Eveniment incognito'),
(12, 'Eveniment', 2, 77, 9, '2025-06-16 02:39:00', '2025-06-16 04:39:00', 'test mai multe aparitii'),
(13, 'Eveniment', 2, 77, 9, '2025-06-16 02:39:00', '2025-06-16 04:39:00', 'test mai multe aparitii'),
(14, 'Eveniment', 2, 84, 22, '2025-06-16 02:51:00', '2025-06-16 05:47:00', 'asdasd'),
(15, 'TEst', 2, 84, 2, '2025-06-16 04:56:00', '2025-06-16 05:56:00', 'asd'),
(16, 'Eveni', 2, 174, 4, '2025-06-16 02:57:00', '2025-06-16 04:57:00', 'asd'),
(17, 'TEstsd', 2, 33, 4, '2025-06-16 02:59:00', '2025-06-16 06:59:00', 'asd'),
(18, 'Tenis', 1, 207, 22, '2025-06-16 11:36:00', '2025-06-16 14:37:00', 'aslkjdasjkd'),
(19, 'Even', 1, 75, 10, '2025-06-16 11:55:00', '2025-06-16 14:55:00', 'asdasd'),
(20, 'Ceva', 1, 28, 10, '2025-06-17 02:33:00', '2025-06-17 05:33:00', 'Descriere'),
(21, 'Alergare in parc', 1, 57, 20, '2025-06-21 04:09:00', '2025-06-21 08:09:00', 'Meeting organizat in parc');

-- --------------------------------------------------------

--
-- Table structure for table `event_participants`
--

CREATE TABLE `event_participants` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `join_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_tags`
--

CREATE TABLE `event_tags` (
  `event_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_tags`
--

INSERT INTO `event_tags` (`event_id`, `tag_id`) VALUES
(9, 3),
(11, 2),
(11, 3),
(11, 4),
(11, 5),
(11, 6),
(12, 7),
(17, 4),
(17, 7),
(18, 3),
(18, 4),
(18, 8),
(19, 3),
(20, 3),
(20, 4),
(20, 7),
(21, 9);

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`id`, `user_id`, `friend_id`, `status`, `created_at`) VALUES
(1, 1, 2, 'pending', '2025-06-20 14:21:21'),
(11, 8, 6, 'pending', '2025-06-21 01:36:14'),
(13, 9, 8, 'pending', '2025-06-21 01:50:14'),
(14, 9, 6, 'pending', '2025-06-21 01:50:19'),
(15, 9, 1, 'accepted', '2025-06-21 01:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `sports_fields`
--

CREATE TABLE `sports_fields` (
  `id` int(11) NOT NULL,
  `osm_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `lat` decimal(9,6) DEFAULT NULL,
  `lon` decimal(9,6) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sport` varchar(255) DEFAULT NULL,
  `surface` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sports_fields`
--


-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'Destindere'),
(2, 'Experti'),
(3, 'Gratuit'),
(5, 'In trend'),
(8, 'Incepatori'),
(9, 'Intalnire'),
(4, 'Nou'),
(7, 'test'),
(6, 'Unic');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `registration_date`) VALUES
(1, 'admin@admin', 'admin', '$2y$10$hzjCFNKdLSao42Za1ViaX.qv9Va3cUFuWZ1QmwWJpeBYVUegrxWM2', '2025-06-20 15:48:15'),
(2, 'incognito@sportis', 'incognito', '$2y$10$PcrEICy0sNd0yZEdLsvwEu1QiIBDs3wxcC7lgpLeSo3cUFmZ2pwAW', '2025-06-20 15:48:15'),
(6, 'student@student', 'student', '$2y$10$zMwB/fhkMfkrBxma3fzR9Ogrq4FcK91VGFW9OKj5Fa2Hl541kPf5O', '2025-06-20 15:04:40'),
(7, 'user@user', 'user1', '$2y$10$RZCBvCoBLhzyzBxvEzrLe.BPh6E2fN/nVCoAdEaRnn7Pqci5PpgbO', '2025-06-21 02:33:56'),
(8, 'user2@user', 'user2', '$2y$10$fUdbtObH43AVbgSZ8/tJPOtlvQEd1WisH1uE.GZiXrCzQpR31DHG.', '2025-06-21 02:34:14'),
(9, 'user3@user', 'user3', '$2y$10$HyAzBHVcKsAKeJokFR3gieV8wEWQCQVFoQwz3gZpJBceHrIm9rBSq', '2025-06-21 02:34:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `field_id` (`field_id`);

--
-- Indexes for table `event_participants`
--
ALTER TABLE `event_participants`
  ADD PRIMARY KEY (`event_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_tags`
--
ALTER TABLE `event_tags`
  ADD PRIMARY KEY (`event_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `sports_fields`
--
ALTER TABLE `sports_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sports_fields`
--
ALTER TABLE `sports_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `sports_fields` (`id`);

--
-- Constraints for table `event_participants`
--
ALTER TABLE `event_participants`
  ADD CONSTRAINT `event_participants_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_participants_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `event_tags`
--
ALTER TABLE `event_tags`
  ADD CONSTRAINT `event_tags_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friendships`
--
ALTER TABLE `friendships`
  ADD CONSTRAINT `friendships_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friendships_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
