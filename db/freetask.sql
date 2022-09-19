-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 19 2022 г., 14:19
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
(1, 0, 'html-verstka', 'HTML-верстка', 'HTML-верстка', 'HTML-верстка', 'HTML-верстка', 'HTML-верстка', 0, 1),
(2, 0, 'veb-programmirovanie', 'Веб-программирование', 'Веб-программирование', 'Веб-программирование', 'Веб-программирование', 'Веб-программирование', 0, 1),
(3, 0, 'internet-magaziny', 'Интернет-магазины', 'Интернет-магазины', 'Интернет-магазины', 'Интернет-магазины', 'Интернет-магазины', 0, 1),
(4, 0, 'sajty-pod-klyuch', 'Сайты «под ключ»', 'Сайты «под ключ»', 'Сайты «под ключ»', 'Сайты «под ключ»', 'Сайты «под ключ»', 0, 1),
(5, 0, 'sistemy-upravleniya', 'Системы управления (CMS)', 'Системы управления (CMS)', 'Системы управления (CMS)', 'Системы управления (CMS)', 'Системы управления (CMS)', 0, 1),
(6, 0, 'testirovanie-sajtov', 'Тестирование сайтов', 'Тестирование сайтов', 'Тестирование сайтов', 'Тестирование сайтов', 'Тестирование сайтов', 0, 1),
(7, 0, 'dizajn-sajtov', 'Дизайн сайтов', 'Дизайн сайтов', 'Дизайн сайтов', 'Дизайн сайтов', 'Дизайн сайтов', 0, 1),
(8, 0, 'administrirovanie-sajtov', 'Администрирование сайтов', 'Администрирование сайтов', 'Администрирование сайтов', 'Администрирование сайтов', 'Администрирование сайтов', 0, 1),
(9, 0, 'kontent-menedzher', 'Контент-менеджер', 'Контент-менеджер', 'Контент-менеджер', 'Контент-менеджер', 'Контент-менеджер', 0, 1),
(10, 0, 'prodvizhenie-sajtov', 'Продвижение сайтов (SEO)', 'Продвижение сайтов (SEO)', 'Продвижение сайтов (SEO)', 'Продвижение сайтов (SEO)', 'Продвижение сайтов (SEO)', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `response_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1663585350),
('m130524_201442_init', 1663585355),
('m190124_110200_add_verification_token_column_to_user_table', 1663585355);

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `imageFile` varchar(250) NOT NULL,
  `price_per_hour` decimal(10,0) NOT NULL,
  `type` enum('freelancer','employer') NOT NULL DEFAULT 'freelancer',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `profile`
--

INSERT INTO `profile` (`id`, `description`, `imageFile`, `price_per_hour`, `type`, `user_id`) VALUES
(1, 'Обо мне', '', '5', 'freelancer', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `url` varchar(500) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `create_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `responses` int(11) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_by_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `category_id`, `url`, `title`, `description`, `create_date`, `end_date`, `price`, `responses`, `views`, `created_by_id`, `worker_id`, `status`) VALUES
(20, 2, '', 'Сделать верстку HTML', 'Сделать верстку HTML c фотошоп', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 1, 0, 0, 0, 1),
(21, 1, '', 'Сделать верстку HTML 2', 'Сделать верстку HTML c фотошоп 2', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 1, 0, 0, 0, 3),
(22, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 2, 0, 0, 0, 1),
(23, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(24, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 1, 0, 0, 0, 1),
(25, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(26, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(27, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(28, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 2),
(29, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 3),
(30, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 2),
(31, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 2),
(32, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(33, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(34, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(35, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(36, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(37, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(38, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(39, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(40, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(41, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(42, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(43, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(44, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(45, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(46, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(47, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(48, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(49, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(50, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(51, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(52, 1, '', 'Сделать верстку HTML3', 'Сделать верстку HTML c фотошоп3', '2022-03-30 17:05:00', '2022-04-25 00:00:00', '50.00', 0, 0, 0, 0, 1),
(53, 8, '', 'Название проекта', 'Описание', '2022-04-12 20:44:19', '0000-00-00 00:00:00', '25.00', 0, 0, 1, 0, 0),
(54, 7, '', 'Нарисовть баннер', 'банер для сайта', '2022-04-12 21:14:06', '0000-00-00 00:00:00', '15.00', 2, 0, 1, 1, 1),
(55, 1, '', 'ggg', 'gggggg', '2022-04-12 21:13:53', '0000-00-00 00:00:00', '11.00', 0, 0, 2, 0, 1),
(56, 1, '', 'новый заказ', 'Создать проект для ппп', '2022-04-13 08:29:47', '0000-00-00 00:00:00', '23.00', 1, 0, 2, 0, 1),
(57, 1, '', 'Новый проект с датой', 'Смотрите новый проект с датой', '2022-04-13 07:44:00', '2022-04-13 07:44:00', '22.00', 0, 0, 1, 0, 1),
(58, 1, '', 'Создание проекта ', 'Создание проекта', '2022-04-13 08:52:26', '2022-04-13 08:52:26', '1.00', 1, 0, 1, 5, 1),
(59, 3, '', 'Интернет магазин', 'Необходимо сделать интернет магазин на базе Jommla\r\nНеобходимо сделать интернет магазин на базе Jommla\r\n\r\nНеобходимо сделать интернет магазин на базе Jommla\r\n', '2022-04-16 14:46:08', '2022-04-16 14:46:08', '250.00', 1, 0, 1, 5, 1),
(60, 10, '', 'Просто новый заказ', 'Этот заказ тестовый. На него будет много заявок. Просто самый тестовый заказ <a href=\"/\">Привет я ссылка</a>. Проверка тегов', '2022-05-03 07:47:23', '2022-05-03 07:47:23', '150.00', 0, 0, 1, 0, 0),
(61, 1, '', 'Новый заказ по имени', 'Новый заказ по имени описание', '2022-05-08 17:51:37', '2022-05-08 17:51:37', '15.00', 0, 0, 1, 0, 0),
(62, 1, '', 'новый рпипр', 'ав', '2022-05-08 17:54:04', '2022-05-08 17:54:04', '1555.00', 0, 0, 1, 0, 0),
(63, 1, '', 'Новый заказ привет', 'чччччч', '2022-05-08 17:58:20', '2022-05-08 17:58:20', '111.00', 0, 0, 1, 0, 0),
(64, 1, 'testirovanie-sajtov-dsgsdv', 'Тестирование сайтов  dsgsdv', 'gfddddddddddd', '2022-05-08 17:59:26', '2022-05-08 17:59:26', '55.00', 0, 0, 1, 0, 0),
(65, 1, 'novyj-zakaz-dlya-transkpcii', 'Новый заказ для транскпции', 'Новый заказ для транскпции', '2022-05-08 18:01:11', '2022-05-08 18:01:11', '1.00', 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `responses`
--

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `price` decimal(10,0) NOT NULL,
  `project_id` int(11) NOT NULL,
  `response` text NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sef`
--

CREATE TABLE `sef` (
  `id` int(11) NOT NULL,
  `link` varchar(250) NOT NULL,
  `link_sef` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, '101kinolog@gmail.com', '8aKGpdCgXx5txBtYPcePOM8tA-6ItuDL', '$2y$13$D1yuSS6U83sFzNHF4/BS/e2VBT84AC74gnwMKioOHaYtCwapGBzqK', NULL, '101kinolog@gmail.com', 10, 1663576352, 1663576352, 'KngSmm6xgQmx2edonCK5pCdAe9BEFZbL_1663576352');

-- --------------------------------------------------------

--
-- Структура таблицы `user2`
--

CREATE TABLE `user2` (
  `id` int(11) NOT NULL,
  `auth_key` varchar(250) NOT NULL,
  `created_at` int(11) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(250) NOT NULL,
  `facebook` varchar(250) NOT NULL,
  `imageFile` varchar(250) NOT NULL,
  `instagram` varchar(250) NOT NULL,
  `isq` varchar(250) NOT NULL,
  `linked_in` varchar(250) NOT NULL,
  `password_hash` varchar(250) NOT NULL,
  `password_reset_token` varchar(250) NOT NULL,
  `price_per_hour` decimal(10,2) NOT NULL,
  `site` varchar(250) NOT NULL,
  `skype` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `telegram` varchar(250) NOT NULL,
  `twitter` varchar(250) NOT NULL,
  `type` enum('freelancer','employer') NOT NULL DEFAULT 'freelancer',
  `updated_at` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `verification_token` varchar(250) DEFAULT NULL,
  `viber` varchar(250) NOT NULL,
  `whatsapp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user2`
--

INSERT INTO `user2` (`id`, `auth_key`, `created_at`, `description`, `email`, `facebook`, `imageFile`, `instagram`, `isq`, `linked_in`, `password_hash`, `password_reset_token`, `price_per_hour`, `site`, `skype`, `status`, `telegram`, `twitter`, `type`, `updated_at`, `username`, `verification_token`, `viber`, `whatsapp`) VALUES
(0, 'ATtYK6AxifDU4e-hzzzUNfyWR6G2Sb32', 1663576753, '', '101kinolog2@gmail.com', '', '', '', '', '', '$2y$13$wzeC3Zx4097wmQtln9JY9O77MoN0AYnCZgb/5WaJ4nSznBVixdxBy', '', '0.00', '', '', 10, '', '', 'freelancer', 1663576753, '', '7WZDhfMdh15HwIVgorqpS8FXCxCydnxn_1663576753', '', ''),
(1, 'SGV-c5oHnkD8GuBE3g0sslIyWAN8xepO', 1662816288, '', '101kinolog@gmail.com', '', '', '', '', '', '$2y$13$wzeC3Zx4097wmQtln9JY9O77MoN0AYnCZgb/5WaJ4nSznBVixdxBy', '', '0.00', '', '', 10, '', '', 'freelancer', 1662816288, '', '1m3ZjjIyG6FKjM_QrHDMFPM3oCOlQ_N2_1662816288', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sef`
--
ALTER TABLE `sef`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Индексы таблицы `user2`
--
ALTER TABLE `user2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT для таблицы `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sef`
--
ALTER TABLE `sef`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
