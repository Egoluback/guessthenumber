-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 25 2019 г., 09:44
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `gameguess`
--

-- --------------------------------------------------------

--
-- Структура таблицы `saves`
--

CREATE TABLE IF NOT EXISTS `saves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `countCells` int(11) NOT NULL,
  `speed` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `saves`
--

INSERT INTO `saves` (`id`, `username`, `value`, `countCells`, `speed`) VALUES
(12, 'Test123', 2, 2, 1),
(13, 'Test123', 2, 4, 2),
(14, 'Test123', 5, 6, 1.2),
(15, 'Test123', 2, 4, 2),
(16, 'Test123', 3, 4, 1.33333);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(6, 'Name', 'e3431a8e0adbf96fd140103dc6f63a3f8fa343ab'),
(7, 'Tester', '3d591e6cd6f877366a6d7fc7595179b99727738d'),
(8, 'geser', 'e3431a8e0adbf96fd140103dc6f63a3f8fa343ab'),
(9, 'Login', 'e3431a8e0adbf96fd140103dc6f63a3f8fa343ab'),
(10, 'hello', 'e3431a8e0adbf96fd140103dc6f63a3f8fa343ab'),
(11, 'test', 'e3431a8e0adbf96fd140103dc6f63a3f8fa343ab'),
(12, 'name', 'e3431a8e0adbf96fd140103dc6f63a3f8fa343ab'),
(13, 'Some person', '4a2ee7a9c5ee818937f4827893ac3059eadc2378'),
(14, 'Test123', 'e3431a8e0adbf96fd140103dc6f63a3f8fa343ab');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
