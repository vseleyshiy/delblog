-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: MySQL-8.2
-- Generation Time: Jun 02, 2025 at 01:36 PM
-- Server version: 8.2.0
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) DEFAULT NULL,
  `owner` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `image`, `owner`) VALUES
(1, 'Собака!', '<p>Собаки умеют пользоваться общественным транспортом, чтобы передвигаться по городу на большие расстояния. Замечали, как они ездят на автобусах, троллейбусах и трамваях и даже пользуются метро.</p><p>Селекционеры вывели множество пород собак. Генетические различия между ними гораздо больше, чем между людьми.</p><p>Ошейники с шипами изобрели в Древнем мире. Первоначально их делали, не для устрашения, а для защиты охотничьих собак от диких животных.</p>', '2025-05-30 07:39:15', '1.jpg', 11),
(2, 'Что такое Python?', '<p>Python — это высокоуровневый язык программирования, отличающийся эффективностью, простотой и универсальностью использования. Он широко применяется в разработке веб-приложений и прикладного программного обеспечения, а также в машинном обучении и обработке больших данных. За счет простого и интуитивно понятного синтаксиса является одним из распространенных языков для обучения программированию.</p><p>Веб-разработка. Многие крупные интернет-компании, такие как Google, Facebook*, программируют на Python свои самые известные проекты, например, Instagram*, YouTube, Dropbox и т.д. Этот язык позволяет вести веб-разработку на стороне сервера, потому что его обширная библиотека включает множество решений как раз для реализации сложных серверных функций. За счет своей простоты использования Python широко применяется небольшими командами и одиночными разработчиками для создания сайтов, десктопных и мобильных веб-приложений.</p>', '2025-05-30 08:09:21', NULL, 11),
(4, 'from admin', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\&amp;#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2025-06-01 07:08:52', '3.png', 11),
(5, 'Petya\\&amp;#039;s post', 'It\\&amp;#039;s a sakura black-white', '2025-06-02 04:23:46', '4.png', 13),
(8, 'DelBlog - За этим блогом будущее!', 'DelBlog (ДелБлог) - выпускной проект, который был сделан, и вот он тут, да...', '2025-06-02 08:35:16', NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`) VALUES
(11, 'admin', 'a@a.com', '$2y$10$alri0WL6dCUrRofmUfpdLOXd7GhYW3AvQ0k7BCwSPmmlQ5BS22cki', 1),
(13, 'petya volk', 'u@u.com', '$2y$10$YmLXrg/BiugWVoD/zft7FO2c6HtuMRJQqk3WYN/wuBhl6p.qx/eMC', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
