-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 10 2022 г., 21:47
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `j29604rf_freetas`
--

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--
-- Создание: Окт 08 2022 г., 11:47
-- Последнее обновление: Окт 08 2022 г., 11:50
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `url` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `pos` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `icon` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`id`, `parent_id`, `url`, `title`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `pos`, `status`, `icon`) VALUES
(1, 0, 'html-verstka', 'HTML-верстка', 'HTML-верстка', 'HTML-верстка - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: HTML-верстка (верстальщик)', 'HTML-верстка, верстальщик', 0, 1, 'fa-solid fa-file-lines'),
(2, 0, 'veb-programmirovanie', 'Веб-программирование', 'Веб-программирование', 'Веб-программирование - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Веб-программирование', 'Веб-программирование', 0, 1, 'fa-regular fa-file-code'),
(3, 0, 'internet-magaziny', 'Интернет-магазины', 'Интернет-магазины', 'Интернет-магазины - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Интернет-магазины', 'Интернет-магазины', 0, 1, 'fa-solid fa-cart-shopping'),
(4, 0, 'sajty-pod-klyuch', 'Сайты «под ключ»', 'Сайты «под ключ»', 'Сайты «под ключ» - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Сайты «под ключ»', 'Сайты «под ключ»', 0, 1, 'fa-solid fa-key'),
(5, 0, 'sistemy-upravleniya', 'Системы управления (CMS)', 'Системы управления (CMS)', 'Системы управления (CMS) - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Системы управления (CMS)', 'Системы управления (CMS)', 0, 1, 'fa-sharp fa-solid fa-gears'),
(6, 0, 'testirovanie-sajtov', 'Тестирование сайтов', 'Тестирование сайтов', 'Тестирование сайтов - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Тестирование сайтов', 'Тестирование сайтов', 0, 1, 'fa-sharp fa-solid fa-bugs'),
(7, 0, 'dizajn-sajtov', 'Дизайн сайтов', 'Дизайн сайтов', 'Дизайн сайтов - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Дизайн сайтов', 'Дизайн сайтов', 0, 1, 'fa-solid fa-palette'),
(8, 0, 'administrirovanie-sajtov', 'Администрирование сайтов', 'Администрирование сайтов', 'Администрирование сайтов - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Администрирование сайтов', 'Администрирование сайтов', 0, 1, 'fa-solid fa-user-secret'),
(9, 0, 'kontent-menedzher', 'Контент-менеджер', 'Контент-менеджер', 'Контент-менеджер - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Контент-менеджер', 'Контент-менеджер', 0, 1, 'fa-solid fa-pencil'),
(10, 0, 'prodvizhenie-sajtov', 'Продвижение сайтов (SEO)', 'Продвижение сайтов (SEO)', 'Продвижение сайтов (SEO) - Бесплатные фриланс заказы - Удаленная работа', 'Фриланс работа: Продвижение сайтов (SEO)', 'Продвижение сайтов (SEO)', 0, 1, 'fa-sharp fa-solid fa-arrow-trend-up');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--
-- Создание: Сен 21 2022 г., 07:46
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `response_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `project_id`, `response_id`, `from_user_id`, `to_user_id`, `message`, `status`, `create_date`) VALUES
(1, 1, 1, 1, 2, 'Когда сможете приступить к работе?', 0, '2022-10-02 17:02:16'),
(2, 1, 1, 2, 2, 'Уже приступил', 0, '2022-10-08 10:15:10');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--
-- Создание: Сен 21 2022 г., 07:46
--

DROP TABLE IF EXISTS `migration`;
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
-- Создание: Сен 21 2022 г., 07:46
--

DROP TABLE IF EXISTS `profile`;
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
-- Структура таблицы `profile_rating`
--
-- Создание: Окт 08 2022 г., 07:06
--

DROP TABLE IF EXISTS `profile_rating`;
CREATE TABLE `profile_rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--
-- Создание: Сен 26 2022 г., 13:18
-- Последнее обновление: Окт 10 2022 г., 12:51
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `url` varchar(500) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `create_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `responses` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `created_by_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `category_id`, `url`, `title`, `description`, `create_date`, `end_date`, `price`, `responses`, `views`, `created_by_id`, `worker_id`, `status`) VALUES
(1, 1, 'dorabotat-verstku', 'Доработать верстку', 'Нужен человек, который быстро доделает верстку нескольких страниц на сайте. Сайт написан на wordpress. Максимальный бюджет указан в заявке.', '2022-09-21 15:17:13', '2022-10-08 10:49:12', '15.00', 2, 0, 1, 2, 2),
(2, 7, 'narisovat-banner-2', 'Нарисовать баннер', 'Нужно нарисовать баннер для сайта автомобильной тематики. Баннер нужен на главную страницу сайта. В дальнейшем нужна будет верстка с адаптивом. Рассмотрю все предложения.', '2022-09-26 09:51:45', '2022-10-08 10:49:24', '10.00', 2, 0, 1, 3, 2),
(3, 4, 'sozdanie-proekta-3', 'Создание проекта', 'Создание проекта. Хотим собрать команду людей способных работать в команде для написания сайтов под ключ. Т.е ищем верстальника, программиста,дизайнера и контент менеджера. Оставляйте заявки с указанием ваших контактных данных для связи', '2022-09-26 13:05:26', '2022-09-26 13:05:26', '25.00', 0, 0, 1, 0, 0),
(69, 1, 'isprait-verstku-na-sajte-69', 'Испраить верстку на сайте', 'Исправить верстку на одностраничном сайте. Проектов много - возможно длительное сотрудничество. Присылайте заявки и сроки - когда можетет приступить к работе', '2022-10-01 15:40:47', '2022-10-01 15:40:47', '5.00', 0, 0, 1, 0, 0),
(70, 10, 'nastroit-kontekstnuyu-i-tovarnuyu-reklamu-70', 'Настроить контекстную и товарную рекламу', 'Нужно настроить контекстную и товарную рекламу Goоgle для сайта', '2022-10-02 16:14:52', '2022-10-02 16:14:52', '10.00', 0, 0, 1, 0, 0),
(71, 9, 'perevod-teksta-na-sajte-s-anglijskogo-na-russkij-71', 'Перевод текста на сайте с английского на русский', 'Сайт строительной тематики находится в разработке. Необходимо сделать перевод с английсокго на русский. Перевод нужен для текстов на сайте и технических характеристик продаваемой аппаратуры. Обращаться людям с техническим навыком английского. Стоимость указана за одну страницу перевода', '2022-10-02 16:16:42', '2022-10-02 16:16:42', '8.00', 1, 0, 1, 2, 1),
(72, 8, 'administrator-sajta-72', 'Администратор сайта', 'Ищу администраторадля сайта книжной продукции. Требования в работе:\r\n- ответсвенность,\r\n- наличие 2 часа свободного времени в день,\r\n- работа только по будням,\r\n- умение пользоваться wordpress (добавление контента).\r\nУказана зарплата за месяц', '2022-10-02 16:20:02', '2022-10-02 16:20:02', '100.00', 1, 0, 1, 0, 0),
(73, 5, 'natyazhka-shablona-na-wordpress-73', 'Натяжка шаблона на wordpress', 'Имеется готовая верстка. \r\nНужно только натянуть верстку и настроить необходимые параметры. \r\nСайт из15 страниц', '2022-10-02 16:23:42', '2022-10-08 10:49:57', '30.00', 1, 0, 1, 3, 2),
(74, 6, 'protestirovat-sajt-na-nalichie-oshibok-74', 'Протестировать сайт на наличие ошибок', 'Пhотестировать сайт на наличие ошибок.\r\nСделать полный анализ сайта, включая анализ на баги.\r\n\r\nПроверить сайт правильное отображение и работу на телефонах и планшетах.\r\nПроверка кабинета пользователя и отправка email.\r\n\r\nПо результатам проверки подготовить комплексный отчет по найденым ошибкам\r\n', '2022-10-02 16:27:17', '2022-10-02 16:27:17', '75.00', 1, 0, 1, 2, 1),
(75, 2, 'parser-novostej-php-75', 'Парсер новостей PHP', 'Создать парсер новостей. Парсер должен быть написан на языке php c использованием библиотеки curl. Нужно спарсить и сохранить в ехеll таблицу. Также настроить, чтобы данные новости появлялись на сайте через определенное время по несколько штук.', '2022-10-05 13:36:12', '2022-10-05 13:36:12', '75.00', 1, 0, 1, 0, 0),
(76, 4, 'sajt-salona-krasoty-76', 'Сайт салона красоты', 'Сайт салона красоты под ключ.\r\nТип сайта информационный -  разделы и категории по выполняемым работам.\r\n- Главная страница\r\n- Волосы\r\n- Ногти\r\n- Брови \r\n- Депиляция\r\n- Портфолио\r\n- Оборудование\r\n- Цены\r\nСайт можно написать на любой CMS - главное чтобы было удобно. Делайте ваши предложения - обсудим. \r\nМакета сайта нету. Можно воспользоваться готовыми вариантами.\r\n', '2022-10-05 13:40:32', '2022-10-05 13:40:32', '120.00', 2, 0, 1, 0, 0),
(77, 3, 'internet-magazin-na-joomla-77', 'Интернет магазин на Joomla', 'Доработать интернет магазин.  Сайт по продаже электроники - доработать функционал по интернет магазину. Подключить оплату через Paypal. Добавить варианты доставки.', '2022-10-06 19:42:53', '2022-10-06 19:42:53', '115.00', 2, 0, 1, 4, 1),
(78, 1, 'verstka-maketov-figma-dlya-sajta-78', 'Верстка макетов Figma для сайта', 'Задача - верстка макетов для сайта\r\n\r\n    Всего  нужно 15 страниц верстки без javascript\r\n    Сверстать нужно адаптивно: 1440px - desktop, 375px - mobile\r\n    На другой ширине экрана: полная резина (весь сайт пропорционально меняет размер) в зависимости от ширины браузера\r\n    JS не требуется, только верстка\r\n    Макеты в Figma, поступают частями поэтапно в течение месяца (по 1/3 примерно). После каждого этапа - оплата.\r\n\r\nСрок: 2-4 недели\r\n\r\nПроект большой. Верстку необходимо сделать как следует, чтобы с кодом верстки было удобно работать и дорабатывать.\r\n\r\nВажно:\r\nНеобходим сильный и опытный верстальщик.', '2022-10-07 10:59:45', '2022-10-07 10:59:45', '150.00', 2, 0, 1, 0, 0),
(79, 3, 'internet-magazin-detskoj-odezhdy--79', 'Интернет магазин детской одежды ', 'Нужно сделать интернет магазин с нуля по продаже детской одежды. Основные этапы: Выбрать платформу интернет-магазина - рассмотрим все варианты (плюсы и минусы) Выбрать дизайн сайта и сделать верстку Помочь выбрать и зарегистрировать доменное имя Помочь выбрать хостинг где будет размещаться ваш сайт Разместить, открытие интернет-магазина, настройка Наполнить товарами интернет-магазина От исполнителей принимаем и рассматриваем все возможные предложения. Срок выполнения до 6 недель. Оплата поэтапно - по мере выполнения', '2022-10-07 15:29:48', '2022-10-07 15:29:48', '350.00', 2, 0, 1, 0, 0),
(80, 2, 'nastroit-oplatu-paypal-80', 'Настроить оплату PayPal', 'Настроить оплату PayPal в интернет магазине. Магазин написан на yii2 advanced. Ошибка проверки платежа paypal: \r\nGot Http response code 500 when accessing https://api.sandbox.paypal.com/v1/payments/payment/PAY-*********************/execute.\r\nНужно устранить эту ошибку. Исполнителю дам доступы к логам сервера и коду сайта', '2022-10-08 09:35:03', '2022-10-08 09:45:17', '35.00', 2, 0, 1, 0, 0),
(81, 2, 'regulyarnoe-vyrazhenie-81', 'Регулярное выражение', 'Подобрать регулярное выражение для обрезки окончания слов в поиске сайта. На данный момент на сайте работает поиск - ищет только целые слова. Нужно как-то усовершенствовать поиск выдачи более обширного результата.\r\nСайт написан на самописной CMS', '2022-10-08 09:39:33', '2022-10-08 09:39:33', '25.00', 3, 0, 1, 0, 0),
(82, 1, 'verstka-lendinga-82', 'Верстка лендинга', 'Верстка лендинга по psd макету.\r\nНужно сделать адаптивную верстку и подключить js для баннеров. Настроить отправку писем на кнопке ЗАКАЗАТЬ ЗВОНОК. Подключить карту google', '2022-10-08 09:46:10', '2022-10-08 09:46:10', '70.00', 3, 0, 1, 0, 0),
(83, 1, 'bootstrap-verstka-83', 'Bootstrap верстка', 'Адаптивная верстка сайта bootstrap.\r\nВсего 6 страниц. Нужно чтобы было всплывающее меню bootstrap, которое будет сворачиваться в мобильной версии и отображаться по книку на значок. Использовать bootstrap 3.', '2022-10-08 13:42:29', '2022-10-08 13:42:29', '60.00', 0, 0, 1, 0, 0),
(84, 4, 'sajt-pod-klyuch-dlya-avto-masterskoj-84', 'Сайт под ключ для авто мастерской', 'Сайт под ключ для авто мастерской.  Нужен стандартный сайт визитка из нескольких страниц. Выполнить на любой удобной cms. Нужно чтобы администратор сайта сам смог добавлять фотографии и редактировать прайс лист по ремонту. Прайс лист должен быть представлен просто таблицей. Желательно чтобы была возможность заливки прайс листов в виде exell через сайт. \r\nСрок выполнения две недели. Верстки нет. ', '2022-10-09 19:13:07', '2022-10-09 19:13:07', '160.00', 0, 0, 1, 0, 0),
(85, 1, 'verstalshhik-85', 'Верстальщик', 'Верстальщик. собрать из двух скачанных сайтов один заменив цвета и мб блоки местами. Чтобы получился третий сайт. Поставить текстолайт. ', '2022-10-09 19:35:47', '2022-10-09 19:35:47', '50.00', 0, 0, 1, 0, 0),
(86, 2, 'bot-dlya-torgovli-na-kriptovalyutnoj-birzhe-86', 'Бот для торговли на криптовалютной бирже', 'Необходимо доработать бота, который написан на яп python, и добавить новые биржи. Бот в автоматическом режиме торгует на криптовалютной бирже по постам из твиттера.\r\nБот открывает сделки:\r\n- по ключевым словам;\r\n- по картинкам, где есть ключевые слова;\r\n- по картинкам, где изображены определённые объекты;\r\n\r\nОтклики оставляйте только в том случае, если имеете опыт работы с искусственным интеллектом и криптобиржами.\r\nК отклику сразу добавляйте портфолио разработанных вами подобного рода проектов!\r\nО цене договоримся после ознакомления с ТЗ. ', '2022-10-09 19:37:31', '2022-10-09 19:37:31', '500.00', 0, 0, 1, 0, 0),
(87, 8, 'administrator-telegramm-kanala-87', 'Администратор телеграмм канала', 'Нужен администратор телеграмм канала. Требование к кандидату: необходимо постоянно в течении всего рабочего дня с 8 утра до 6 вечера быть на связи и отслеживать сообщения пользователей в чате. Оплата один раз в месяц.', '2022-10-09 19:40:00', '2022-10-09 19:40:00', '300.00', 0, 0, 1, 0, 0),
(88, 6, 'provesti-audit-sajta-88', 'Провести аудит сайта', 'Провести аудит сайта по производительности и дать рекомендации по улучшению', '2022-10-09 19:42:14', '2022-10-09 19:42:14', '60.00', 0, 0, 1, 0, 0),
(89, 9, 'napisat-teksty-derevoobrabotka-89', 'Написать тексты деревообработка', 'Написать статьи по деревообработке для сайта-блога строительной тематики. Нужно десять статей с качественными изображениями.', '2022-10-09 20:01:02', '2022-10-09 20:01:02', '30.00', 0, 0, 1, 0, 0),
(90, 7, 'dizajn-shablona-pisem-90', 'Дизайн шаблона писем', 'Разработать дизайн шаблона писем, который будет в себя включать шапку и подвал сайта. Т.е должен быть похож на действующий сайт.', '2022-10-10 15:49:27', '2022-10-10 15:49:27', '15.00', 0, 0, 2, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `responses`
--
-- Создание: Сен 21 2022 г., 07:46
--

DROP TABLE IF EXISTS `responses`;
CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,0) NOT NULL,
  `project_id` int(11) NOT NULL,
  `response` text NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `responses`
--

INSERT INTO `responses` (`id`, `create_date`, `price`, `project_id`, `response`, `status`, `user_id`) VALUES
(1, '2022-09-22 18:43:50', '10', 1, 'Сделаю за 10', 0, 2),
(2, '2022-10-08 10:16:00', '70', 82, 'Сделаю быстро и качественно', 0, 2),
(3, '2022-10-08 10:32:29', '20', 81, 'Регулярное выражение за 20', 0, 2),
(4, '2022-10-08 10:32:49', '15', 80, 'Настроить оплату PayPal', 0, 2),
(5, '2022-10-08 10:33:06', '300', 79, 'Интернет магазин детской одежды ', 0, 2),
(6, '2022-10-08 10:33:26', '100', 77, 'Интернет магазин на Joomla', 0, 2),
(7, '2022-10-08 10:33:41', '150', 76, 'Сайт салона красоты', 0, 2),
(8, '2022-10-08 10:34:01', '65', 74, 'Протестировать сайт на наличие ошибок', 0, 2),
(9, '2022-10-08 10:34:19', '100', 72, 'Администрирование сайтов', 0, 2),
(10, '2022-10-08 10:34:39', '10', 2, 'Нарисовать баннер', 0, 2),
(11, '2022-10-08 10:35:03', '10', 71, 'Перевод текста на сайте с английского на русский', 0, 2),
(12, '2022-10-08 10:35:37', '50', 82, 'Верстка лендинга', 0, 3),
(13, '2022-10-08 10:35:50', '10', 81, 'Регулярное выражение', 0, 3),
(14, '2022-10-08 10:36:06', '100', 79, 'Интернет магазин детской одежды', 0, 3),
(15, '2022-10-08 10:36:21', '140', 78, 'Верстка макетов Figma для сайта', 0, 3),
(16, '2022-10-08 10:36:41', '90', 76, 'Сайт салона красоты', 0, 3),
(17, '2022-10-08 10:36:58', '80', 75, 'Парсер новостей PHP', 0, 3),
(18, '2022-10-08 10:37:13', '30', 73, 'Натяжка шаблона на wordpress', 0, 3),
(19, '2022-10-08 10:37:28', '15', 1, 'Доработать верстку', 0, 3),
(20, '2022-10-08 10:37:47', '15', 2, 'Нарисовать баннер', 0, 3),
(21, '2022-10-08 10:38:19', '15', 82, 'Верстка лендинга', 0, 4),
(22, '2022-10-08 10:38:29', '15', 81, 'Регулярное выражение', 0, 4),
(23, '2022-10-08 10:38:40', '26', 80, 'Настроить оплату PayPal', 0, 4),
(24, '2022-10-08 10:38:54', '200', 78, 'Верстка макетов Figma для сайта', 0, 4),
(25, '2022-10-08 10:39:10', '100', 77, 'Интернет магазин на Joomla', 0, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `sef`
--
-- Создание: Сен 21 2022 г., 07:46
--

DROP TABLE IF EXISTS `sef`;
CREATE TABLE `sef` (
  `id` int(11) NOT NULL,
  `link` varchar(250) NOT NULL,
  `link_sef` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--
-- Создание: Окт 10 2022 г., 18:46
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `imageFile` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `price_per_hour` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `description`, `imageFile`, `price_per_hour`) VALUES
(1, '101kinolog@gmail.com', '8aKGpdCgXx5txBtYPcePOM8tA-6ItuDL', '$2y$13$D1yuSS6U83sFzNHF4/BS/e2VBT84AC74gnwMKioOHaYtCwapGBzqK', NULL, '101kinolog@gmail.com', 10, 1663576352, 1663576352, 'KngSmm6xgQmx2edonCK5pCdAe9BEFZbL_1663576352', '', '', '0'),
(2, '', 'ic7N8dEgur_qlsezvQTGgygc8mMSKjpB', '$2y$13$82hXWAGXwrSXemQA6c2WLuxfM1TEz3ErIBBVT6cz1iTqAgU8wFYq.', NULL, '101kinolog2@gmail.com', 10, 1663763027, 1663763027, 'M7zwz3zC5lF0Z1TWzRZWrwzOvYqWZhej_1663763027', '', '', '0'),
(3, '', 'G8colnhs6AQrGD4Q5-mILQmXf_QWjE-b', '$2y$13$vPPxndpFjcbAPUDhxvVuDOCCAoD8UNdjFrP.73HqbVh8QXh1QfI86', NULL, '101kinolog3@gmail.com', 10, 1663854327, 1663854327, 'tSdlHEtpSuogEbnBlk9BICDAc_FUvaQ1_1663854327', '', '', '0'),
(4, '', 'LZGU1x87uwXuMeVYXEi7FR8zC78MCxDG', '$2y$13$N7uytQvpjfv0gfesuz6UIO.Dcs/.8gBtRW1iCtdRhfdhGd0Aok0Ca', NULL, '101kinolog4@gmail.com', 10, 1663854590, 1663854590, 'a_WOy-UVr9bYTyJAYkxJR_g-gRxmdLLc_1663854590', '', '', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `user2`
--
-- Создание: Сен 21 2022 г., 07:46
--

DROP TABLE IF EXISTS `user2`;
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
-- Индексы таблицы `profile_rating`
--
ALTER TABLE `profile_rating`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `profile_rating`
--
ALTER TABLE `profile_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT для таблицы `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `sef`
--
ALTER TABLE `sef`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
