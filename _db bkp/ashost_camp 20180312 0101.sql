-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Хост: ashost.mysql.ukraine.com.ua
-- Час створення: Бер 12 2018 р., 01:00
-- Версія сервера: 5.6.27-75.0-log
-- Версія PHP: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `ashost_camp`
--

-- --------------------------------------------------------

--
-- Структура таблиці `all_goods`
--

CREATE TABLE `all_goods` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `article` varchar(128) DEFAULT NULL,
  `url` varchar(256) NOT NULL,
  `competitor_id` int(11) UNSIGNED NOT NULL,
  `dt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `all_goods`
--

INSERT INTO `all_goods` (`id`, `name`, `article`, `url`, `competitor_id`, `dt`) VALUES
(1, 'Red Penguin Автошампунь для ручной мойки 1л (XB50407)', NULL, 'https://hotline.ua/auto-avtoshampuni/red-penguin-avtoshampun-dlya-ruchnoj-mojki-1l-xb50407/prices/', 1, '2018-02-21 12:35:17'),
(2, 'Red Penguin Автошампунь для ручной мойки 1л (XB50407)', NULL, 'https://hotline.ua/auto-avtoshampuni/red-penguin-avtoshampun-dlya-ruchnoj-mojki-1l-xb50407/prices/', 2, '2018-02-21 12:35:18'),
(3, 'Red Penguin Автошампунь для ручной мойки 1л (XB50407)', NULL, 'https://hotline.ua/auto-avtoshampuni/red-penguin-avtoshampun-dlya-ruchnoj-mojki-1l-xb50407/prices/', 3, '2018-02-21 12:35:18'),
(4, 'Red Penguin Автошампунь для ручной мойки 1л (XB50407)', NULL, 'https://hotline.ua/auto-avtoshampuni/red-penguin-avtoshampun-dlya-ruchnoj-mojki-1l-xb50407/prices/', 4, '2018-02-21 12:35:18'),
(5, 'Grass 113120', NULL, 'https://hotline.ua/auto-avtoshampuni/grass-113120/prices/', 5, '2018-02-21 12:35:25'),
(6, 'Grass 113120', NULL, 'https://hotline.ua/auto-avtoshampuni/grass-113120/prices/', 6, '2018-02-21 12:35:26'),
(7, 'Atas Dimer 5 кг', NULL, 'https://hotline.ua/auto-avtoshampuni/atas-dimer-5-kg/prices/', 3, '2018-02-21 12:35:32'),
(8, 'Grass 800001', NULL, 'https://hotline.ua/auto-avtoshampuni/grass-800001/prices/', 6, '2018-02-21 12:35:38'),
(9, 'Turtle Wax Шампунь-концентрат ZIP WAX 500мл', NULL, 'https://hotline.ua/auto-avtoshampuni/turtle_wax_shampun-koncentrat_zip_wax_75tw_473_ml/prices/', 2, '2018-02-21 12:35:45'),
(10, 'Turtle Wax Шампунь-концентрат ZIP WAX 500мл', NULL, 'https://hotline.ua/auto-avtoshampuni/turtle_wax_shampun-koncentrat_zip_wax_75tw_473_ml/prices/', 5, '2018-02-21 12:35:45'),
(11, 'Turtle Wax Шампунь-концентрат ZIP WAX 500мл', NULL, 'https://hotline.ua/auto-avtoshampuni/turtle_wax_shampun-koncentrat_zip_wax_75tw_473_ml/prices/', 7, '2018-02-21 12:35:45'),
(12, 'Turtle Wax Hot Wax с воском (500мл)', NULL, 'https://hotline.ua/auto-avtoshampuni/turtle-wax-hot-wax-s-voskom-500ml/prices/', 2, '2018-02-21 12:35:51'),
(13, 'Turtle Wax Hot Wax с воском (500мл)', NULL, 'https://hotline.ua/auto-avtoshampuni/turtle-wax-hot-wax-s-voskom-500ml/prices/', 7, '2018-02-21 12:35:51'),
(14, 'Turtle Wax Hot Wax с воском (500мл)', NULL, 'https://hotline.ua/auto-avtoshampuni/turtle-wax-hot-wax-s-voskom-500ml/prices/', 8, '2018-02-21 12:35:51');

-- --------------------------------------------------------

--
-- Структура таблиці `bindings`
--

CREATE TABLE `bindings` (
  `id` int(10) UNSIGNED NOT NULL,
  `comp_id` int(10) UNSIGNED NOT NULL,
  `id_department` varchar(90) NOT NULL,
  `g_inner_id` int(10) UNSIGNED DEFAULT NULL,
  `g_inner_name` text,
  `g_comp_id` int(10) UNSIGNED NOT NULL,
  `ident` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `bindings`
--

INSERT INTO `bindings` (`id`, `comp_id`, `id_department`, `g_inner_id`, `g_inner_name`, `g_comp_id`, `ident`, `is_active`) VALUES
(1, 4, 'avto uhod', 777, 'Пінгвін', 4, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `branches`
--

CREATE TABLE `branches` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` smallint(5) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `branches`
--

INSERT INTO `branches` (`id`, `name`, `code`) VALUES
(1, 'Авто', 100),
(2, 'Дім', 200),
(3, 'Сад та город', 300);

-- --------------------------------------------------------

--
-- Структура таблиці `competitors`
--

CREATE TABLE `competitors` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `article` varchar(90) NOT NULL,
  `url` varchar(256) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `dt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `competitors`
--

INSERT INTO `competitors` (`id`, `name`, `article`, `url`, `is_active`, `dt`) VALUES
(1, 'hotline | XADO', 'hado', 'https://hotline.ua/hado', 1, '2018-03-11 15:51:14'),
(2, 'hotline | АВТОКЛАД', 'avtoklad', 'https://hotline.ua/avtoklad', 1, '2018-03-11 16:21:23'),
(3, 'hotline | База Автозвука', 'avtozvuk', 'https://hotline.ua/avtozvuk', 1, '2018-03-11 15:51:31'),
(4, 'hotline | АВТОРАДОСТИ', 'avtoradosti', 'https://hotline.ua/avtoradosti', 1, '2018-03-11 15:51:36'),
(5, 'hotline | UCAR.NET.UA', 'ucar', 'https://hotline.ua/ucar', 1, '2018-03-11 15:51:44'),
(6, 'hotline | АвтоХімік', 'avtohimic', 'https://hotline.ua/avtohimic', 1, '2018-03-11 15:51:50'),
(7, 'hotline | АТЛ', 'atl', 'https://hotline.ua/atl', 1, '2018-03-11 15:51:54'),
(8, 'hotline | Новая Линия', 'nl', 'https://hotline.ua/nl', 1, '2018-03-11 16:23:29');

-- --------------------------------------------------------

--
-- Структура таблиці `departments`
--

CREATE TABLE `departments` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `article` varchar(90) NOT NULL,
  `branch_id` int(11) UNSIGNED NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `departments`
--

INSERT INTO `departments` (`id`, `name`, `article`, `branch_id`, `is_deleted`) VALUES
(1, 'Автоуход', 'avto uhod', 1, 0),
(2, 'Авто запчасти', 'avto zapchasti', 1, 0),
(3, 'Авто разное', 'avto pribludy', 1, 0),
(4, 'Мебель', 'furniture', 2, 0),
(5, 'Ремонт', 'remont', 2, 0),
(6, 'Отделка', 'otdelka', 2, 0),
(7, 'Зима', 'winter', 3, 0),
(8, 'Весна', 'spring', 3, 0),
(9, 'Лето', 'summer', 3, 0),
(10, 'Осень', 'autumn', 3, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `monitoring`
--

CREATE TABLE `monitoring` (
  `id` int(10) UNSIGNED NOT NULL,
  `competitor_id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `frequency` tinyint(3) UNSIGNED NOT NULL,
  `week_day` tinyint(3) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `dt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `results`
--

CREATE TABLE `results` (
  `id` int(10) UNSIGNED NOT NULL,
  `monitoring_id` int(10) UNSIGNED NOT NULL,
  `binding_id` int(10) UNSIGNED NOT NULL,
  `competitor_price` int(10) UNSIGNED DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL,
  `is_promo` tinyint(1) NOT NULL,
  `identity` tinyint(1) NOT NULL,
  `dt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `stat`
--

CREATE TABLE `stat` (
  `id` int(10) UNSIGNED NOT NULL,
  `monitoring_id` int(10) UNSIGNED NOT NULL,
  `active_amount` int(10) UNSIGNED NOT NULL,
  `result_amount` int(10) UNSIGNED NOT NULL,
  `dt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `all_goods`
--
ALTER TABLE `all_goods`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `bindings`
--
ALTER TABLE `bindings`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `article` (`code`);

--
-- Індекси таблиці `competitors`
--
ALTER TABLE `competitors`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `article` (`article`);

--
-- Індекси таблиці `monitoring`
--
ALTER TABLE `monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `stat`
--
ALTER TABLE `stat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `all_goods`
--
ALTER TABLE `all_goods`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблиці `bindings`
--
ALTER TABLE `bindings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблиці `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `competitors`
--
ALTER TABLE `competitors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблиці `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблиці `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `stat`
--
ALTER TABLE `stat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
