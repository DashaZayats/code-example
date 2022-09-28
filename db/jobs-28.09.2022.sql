-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 28 2022 г., 12:15
-- Версия сервера: 10.4.24-MariaDB
-- Версия PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `freetask`
--

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `url` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `pos` int(9) UNSIGNED NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`id`, `parent_id`, `url`, `title`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `pos`, `status`) VALUES
(1, 0, 'html-verstka', 'HTML-верстка', 'HTML-верстка', 'HTML-верстка - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: HTML-верстка (верстальщик)', 'HTML-верстка, верстальщик', 0, 1),
(2, 0, 'veb-programmirovanie', 'Веб-программирование', 'Веб-программирование', 'Веб-программирование - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Веб-программирование', 'Веб-программирование', 0, 1),
(3, 0, 'internet-magaziny', 'Интернет-магазины', 'Интернет-магазины', 'Интернет-магазины - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Интернет-магазины', 'Интернет-магазины', 0, 1),
(4, 0, 'sajty-pod-klyuch', 'Сайты «под ключ»', 'Сайты «под ключ»', 'Сайты «под ключ» - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Сайты «под ключ»', 'Сайты «под ключ»', 0, 1),
(5, 0, 'sistemy-upravleniya', 'Системы управления (CMS)', 'Системы управления (CMS)', 'Системы управления (CMS) - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Системы управления (CMS)', 'Системы управления (CMS)', 0, 1),
(6, 0, 'testirovanie-sajtov', 'Тестирование сайтов', 'Тестирование сайтов', 'Тестирование сайтов - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Тестирование сайтов', 'Тестирование сайтов', 0, 1),
(7, 0, 'dizajn-sajtov', 'Дизайн сайтов', 'Дизайн сайтов', 'Дизайн сайтов - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Дизайн сайтов', 'Дизайн сайтов', 0, 1),
(8, 0, 'administrirovanie-sajtov', 'Администрирование сайтов', 'Администрирование сайтов', 'Администрирование сайтов - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Администрирование сайтов', 'Администрирование сайтов', 0, 1),
(9, 0, 'kontent-menedzher', 'Контент-менеджер', 'Контент-менеджер', 'Контент-менеджер - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Контент-менеджер', 'Контент-менеджер', 0, 1),
(10, 0, 'prodvizhenie-sajtov', 'Продвижение сайтов (SEO)', 'Продвижение сайтов (SEO)', 'Продвижение сайтов (SEO) - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Продвижение сайтов (SEO)', 'Продвижение сайтов (SEO)', 0, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
