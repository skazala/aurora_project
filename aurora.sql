-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Лип 14 2022 р., 13:35
-- Версія сервера: 10.4.19-MariaDB
-- Версія PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `aurora`
--

-- --------------------------------------------------------

--
-- Структура таблиці `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(5, 'Beverages'),
(4, 'Dairy'),
(1, 'Fruits'),
(3, 'Sweets'),
(2, 'Veggies');

-- --------------------------------------------------------

--
-- Структура таблиці `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` tinytext NOT NULL,
  `status` varchar(25) NOT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `status`, `category`) VALUES
(28, 'Bananas', 'Sweet yellow bananas from Turkey', 'In Stock', 'Fruits'),
(30, 'Cucumbers', 'Crispy green cucumbers from the organic fields', 'In Stock', 'Veggies'),
(31, 'Mineral water', 'Refreshing sparkling drink from the forest spring', 'Low', 'Beverages'),
(32, 'Dark Chocolate', 'Delicious chocolate from Switzerland', 'Out of Stock', 'Sweets'),
(33, 'Funny cats', 'Lovely little creatures', 'Low', '');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `hashed_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `login`, `hashed_password`) VALUES
(1, 'aurora', '$2y$10$K/.yJGurfBwUhB2RcwVLguc8pPKVVjnWHWcins0SwmAq0Murt1iKa'),
(2, 'aurora2', '$2y$10$Tlf0gBmKSpNSH6v6OjS8MeVRLE4gTj0IU4Wskn6MuflilrDpNXcqa'),
(3, 'toaaaaa', '$2y$10$soGepzTj818LLy.SIYxr..7MolGdvT2Jeq0pVgY6mwliOFSlb/rUK');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Індекси таблиці `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблиці `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
