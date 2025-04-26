-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 02:00 PM
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
-- Database: `blogpost`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `content`, `author_id`, `date_posted`) VALUES
(14, 'mica', 'mica', 125, '2025-04-26 03:28:39'),
(15, 'mica and bush', 'hello', 125, '2025-04-26 09:23:42'),
(16, 'dasd', 'adsad', 125, '2025-04-26 11:22:27'),
(17, 'dasd', 'dasd', 125, '2025-04-26 11:27:07'),
(18, 'dasfdd', 'dfad', 125, '2025-04-26 11:27:51'),
(19, 'dasd', 'dasdasf', 125, '2025-04-26 11:30:01'),
(20, 'dasda', 'ddasda', 125, '2025-04-26 11:34:22'),
(21, 'fgafad', 'fsdfsafa', 125, '2025-04-26 11:34:41'),
(22, 'hagadgdadf', 'afagag', 125, '2025-04-26 11:45:06'),
(23, 'hagadgdadf', 'afagag', 125, '2025-04-26 11:45:10'),
(24, 'dasd', 'asdasdaf', 125, '2025-04-26 11:56:59'),
(25, 'hadghafgda', 'gadgagd', 125, '2025-04-26 11:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'axcee', 'cabusas', 'axcee', '12345678', NULL, NULL),
(123, 'axcee', 'cabusas', 'axcee', 'axcee123', NULL, NULL),
(124, 'axcee', 'cabusas', 'axcee1', '$2y$10$4k5O.QlEsP9Fu2wkzjbduettNeZRQskXbGDK/33vYqGNqw9nDYYrG', NULL, NULL),
(125, 'Admin', 'Admin', 'Admin', '$2y$10$FzNXvHmRqmCsxvpFXkh/x.4UXUNeJ9hBtNsaU8xSI3PZgCW7z.aRy', '2025-04-26 02:18:05', '2025-04-26 02:18:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
