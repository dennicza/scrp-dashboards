-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Хост: ashost.mysql.ukraine.com.ua
-- Час створення: Бер 15 2018 р., 01:25
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
  `id_comp` varchar(90) NOT NULL,
  `url` varchar(256) NOT NULL,
  `dt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `all_goods`
--

INSERT INTO `all_goods` (`id`, `name`, `article`, `id_comp`, `url`, `dt`) VALUES
(1, 'Инфракрасный обогреватель UFO Star 2400 + ножка', NULL, '55000000077', 'https://url55000000077.com', '0000-00-00 00:00:00'),
(2, 'Стиральная машина Samsung WF60F1R0E2WDUA', NULL, '55000000077', 'https://url55000000077.com', '0000-00-00 00:00:00'),
(3, 'Утюг Philips GC1028/20', NULL, '55000000077', 'https://url55000000077.com', '0000-00-00 00:00:00'),
(4, 'Ноутбук HP 15-bs546ur (2KH07EA)', NULL, '55000000077', 'https://url55000000077.com', '0000-00-00 00:00:00'),
(5, 'Телевизор SAMSUNG 40MU6103 (UE40MU6103UXUA)', NULL, '55000000077', 'https://url55000000077.com', '0000-00-00 00:00:00'),
(6, 'Инфракрасный обогреватель UFO Star 2400 + ножка', NULL, '71700000034', 'https://url71700000034.com', '0000-00-00 00:00:00'),
(7, 'Samsung WW80K6210TW', NULL, '71700000034', 'https://url71700000034.com', '0000-00-00 00:00:00'),
(8, 'Утюг Philips GC1028/20', NULL, '71700000034', 'https://url71700000034.com', '0000-00-00 00:00:00'),
(9, 'Ноутбук HP 15-bs546ur (2KH07EA)', NULL, '71700000034', 'https://url71700000034.com', '0000-00-00 00:00:00'),
(10, 'Samsung UE40MU6103UXUA', NULL, '71700000034', 'https://url71700000034.com', '0000-00-00 00:00:00'),
(11, 'Инфракрасный обогреватель UFO Star 2400 + ножка', NULL, '55000000058', 'https://url55000000058.com', '0000-00-00 00:00:00'),
(12, 'Стиральная машина узкая SAMSUNG WF60F1R0E2WDUA', NULL, '55000000058', 'https://url55000000058.com', '0000-00-00 00:00:00'),
(13, 'Утюг Philips EasySpeed GC1028/20', NULL, '55000000058', 'https://url55000000058.com', '0000-00-00 00:00:00'),
(14, 'Ноутбук HP 15-bs546ur (2KH07EA) Black', NULL, '55000000058', 'https://url55000000058.com', '0000-00-00 00:00:00'),
(15, 'Телевизор Samsung UE40MU6103UXUA', NULL, '55000000058', 'https://url55000000058.com', '0000-00-00 00:00:00'),
(16, 'Обогреватель инфракрасный UFO City 1700 + телескопическая ножка', NULL, '65000001032', 'https://url65000001032.com', '0000-00-00 00:00:00'),
(17, 'Стиральная машина Samsung WF60F1R0E2WDUA', NULL, '65000001032', 'https://url65000001032.com', '0000-00-00 00:00:00'),
(18, 'Утюг Philips EasySpeed GC1028/20', NULL, '65000001032', 'https://url65000001032.com', '0000-00-00 00:00:00'),
(19, 'Ноутбук HP 15-bs546ur (2KH07EA) Black', NULL, '65000001032', 'https://url65000001032.com', '0000-00-00 00:00:00'),
(20, 'Телевизор Samsung UE40MU6103UXUA', NULL, '65000001032', 'https://url65000001032.com', '0000-00-00 00:00:00'),
(21, 'Инфракрасный обогреватель UFO Star 2400 + телескопическая ножка UTS/UA', NULL, '45002000030', 'https://url45002000030.com', '0000-00-00 00:00:00'),
(22, 'Стиральная машина SAMSUNG WF60F1R0E2WDUA', NULL, '45002000030', 'https://url45002000030.com', '0000-00-00 00:00:00'),
(23, 'Утюг PHILIPS EasySpeed GC1028/20', NULL, '45002000030', 'https://url45002000030.com', '0000-00-00 00:00:00'),
(24, 'Ноутбук HP 15-bs546ur (2KH07EA)', NULL, '45002000030', 'https://url45002000030.com', '0000-00-00 00:00:00'),
(25, 'Телевизор SAMSUNG UE40MU6103UXUA', NULL, '45002000030', 'https://url45002000030.com', '0000-00-00 00:00:00'),
(26, 'Обогреватель UFO City/17 в комплекте с ножкой', NULL, '70200000004', 'https://url70200000004.com', '0000-00-00 00:00:00'),
(27, 'Стиральная машина LG FH0B8LD7', NULL, '70200000004', 'https://url70200000004.com', '0000-00-00 00:00:00'),
(28, 'Утюг PHILIPS GC 1028/20', NULL, '70200000004', 'https://url70200000004.com', '0000-00-00 00:00:00'),
(29, 'Ноутбук HP 15-bs546ur Black (2KH07EA)', NULL, '70200000004', 'https://url70200000004.com', '0000-00-00 00:00:00'),
(30, 'Телевизор SAMSUNG UE40MU6103UXUA', NULL, '70200000004', 'https://url70200000004.com', '0000-00-00 00:00:00'),
(31, 'Huawei Y7 2017 2/16GB Grey (51091RVG)', NULL, '47000000045', 'https://url47000000045.com', '0000-00-00 00:00:00'),
(32, 'Samsung UE40MU6103UXUA', NULL, '47000000045', 'https://url47000000045.com', '0000-00-00 00:00:00');

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
(1, 4294967295, '65000001191', 30111174, 'Обігрівач інфрачервоний UFO STAR 2400 ', 0, 1, 1),
(2, 4294967295, '61000060108', 31044392, 'Машина пральна SAMSUNG WF60F1R0E2WDUA', 0, 1, 1),
(3, 4294967295, '61000060109', 31009581, 'Праска PHILIPS GC1028/20 (2000Вт./кер.)', 0, 1, 1),
(4, 4294967295, '61000060110', 31225499, 'Ноутбук 15.6\" HP 15-bs546ur (2KH07EA) Black', 0, 1, 1),
(5, 4294967295, '65000003301', 31253800, 'Телевізор 40\" Samsung UE40MU6103UXUA', 0, 1, 1),
(6, 4294967295, '65000001191', 30111174, 'Обігрівач інфрачервоний UFO STAR 2400 ', 0, 1, 1),
(7, 4294967295, '61000060108', 31044139, 'Машина пральна SAMSUNG WW80K6210TW/UA', 0, 1, 1),
(8, 4294967295, '61000060109', 31009581, 'Праска PHILIPS GC1028/20 (2000Вт./кер.)', 0, 1, 1),
(9, 4294967295, '61000060110', 31225499, 'Ноутбук 15.6\" HP 15-bs546ur (2KH07EA) Black', 0, 1, 1),
(10, 4294967295, '65000003301', 31253800, 'Телевізор 40\" Samsung UE40MU6103UXUA', 0, 1, 1),
(11, 4294967295, '65000001191', 30111174, 'Обігрівач інфрачервоний UFO STAR 2400 ', 0, 1, 1),
(12, 4294967295, '61000060108', 31044392, 'Машина пральна SAMSUNG WF60F1R0E2WDUA', 0, 1, 1),
(13, 4294967295, '61000060109', 31009581, 'Праска PHILIPS GC1028/20 (2000Вт./кер.)', 0, 1, 1),
(14, 4294967295, '61000060110', 31225499, 'Ноутбук 15.6\" HP 15-bs546ur (2KH07EA) Black', 0, 1, 1),
(15, 4294967295, '65000003301', 31253800, 'Телевізор 40\" Samsung UE40MU6103UXUA', 0, 1, 1),
(16, 4294967295, '65000001191', 30111216, 'Обігрівач інфрачервоний UFO City 1700 Class (1700 Вт)', 0, 1, 1),
(17, 4294967295, '61000060108', 31044392, 'Машина пральна SAMSUNG WF60F1R0E2WDUA', 0, 1, 1),
(18, 4294967295, '61000060109', 31009581, 'Праска PHILIPS GC1028/20 (2000Вт./кер.)', 0, 1, 1),
(19, 4294967295, '61000060110', 31225499, 'Ноутбук 15.6\" HP 15-bs546ur (2KH07EA) Black', 0, 1, 1),
(20, 4294967295, '65000003301', 31253800, 'Телевізор 40\" Samsung UE40MU6103UXUA', 0, 1, 1),
(21, 4294967295, '65000001191', 30111174, 'Обігрівач інфрачервоний UFO STAR 2400 ', 0, 1, 1),
(22, 4294967295, '61000060108', 31044392, 'Машина пральна SAMSUNG WF60F1R0E2WDUA', 0, 1, 1),
(23, 4294967295, '61000060109', 31009581, 'Праска PHILIPS GC1028/20 (2000Вт./кер.)', 0, 1, 1),
(24, 4294967295, '61000060110', 31225499, 'Ноутбук 15.6\" HP 15-bs546ur (2KH07EA) Black', 0, 1, 1),
(25, 4294967295, '65000003301', 31253800, 'Телевізор 40\" Samsung UE40MU6103UXUA', 0, 1, 1),
(26, 4294967295, '65000001191', 30111216, 'Обігрівач інфрачервоний UFO City 1700 Class (1700 Вт)', 0, 1, 1),
(27, 4294967295, '61000060108', 31044344, 'Машина пральна LG FH0B8LD7', 0, 1, 1),
(28, 4294967295, '61000060109', 31009581, 'Праска PHILIPS GC1028/20 (2000Вт./кер.)', 0, 1, 1),
(29, 4294967295, '61000060110', 31225499, 'Ноутбук 15.6\" HP 15-bs546ur (2KH07EA) Black', 0, 1, 1),
(30, 4294967295, '65000003301', 31253800, 'Телевізор 40\" Samsung UE40MU6103UXUA', 0, 1, 1),
(31, 4294967295, '61000060110', 31238738, 'Смартфон Huawei Y7 2017 (grey)', 0, 1, 1),
(32, 4294967295, '65000003301', 31253800, 'Телевізор 40\" Samsung UE40MU6103UXUA', 0, 1, 1);

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
(1, 'Відділ 310', 310);

-- --------------------------------------------------------

--
-- Структура таблиці `competitors`
--

CREATE TABLE `competitors` (
  `article` varchar(90) NOT NULL,
  `name` varchar(128) NOT NULL,
  `url` varchar(256) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `dt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `competitors`
--

INSERT INTO `competitors` (`article`, `name`, `url`, `is_active`, `dt`) VALUES
('55000000077', 'MOYO', 'https://www.moyo.ua/', 1, '0000-00-00 00:00:00'),
('71700000034', 'Алло', 'https://allo.ua/', 1, '0000-00-00 00:00:00'),
('55000000058', 'Розетка', 'https://rozetka.com.ua/', 1, '0000-00-00 00:00:00'),
('65000001032', 'Comfy', 'https://comfy.ua/', 1, '0000-00-00 00:00:00'),
('45002000030', 'Фокстрот', 'http://www.foxtrot.com.ua', 1, '0000-00-00 00:00:00'),
('70200000004', 'Ельдорадо', 'https://eldorado.ua', 1, '0000-00-00 00:00:00'),
('47000000045', 'Цитрус', 'https://www.citrus.ua/', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблиці `departments`
--

CREATE TABLE `departments` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `article` varchar(90) NOT NULL,
  `id_branch` smallint(5) UNSIGNED NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `departments`
--

INSERT INTO `departments` (`id`, `name`, `article`, `id_branch`, `is_deleted`) VALUES
(1, 'Кліматичні системи', '65000001191', 310, 0),
(2, 'Велика побутова техніка', '61000060108', 310, 0),
(3, 'Дрібна побутова техніка', '61000060109', 310, 0),
(4, 'Споживча електроніка', '61000060110', 310, 0),
(5, 'Зображення та звук', '65000003301', 310, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `monitoring`
--

CREATE TABLE `monitoring` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_comp` varchar(90) NOT NULL,
  `id_dep` varchar(90) NOT NULL,
  `frequency` tinyint(3) UNSIGNED NOT NULL,
  `week_day` tinyint(3) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `dt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `monitoring`
--

INSERT INTO `monitoring` (`id`, `id_comp`, `id_dep`, `frequency`, `week_day`, `is_active`, `dt`) VALUES
(1, 'avtoklad', 'avto zapchasti', 2, 1, 1, '2018-03-13 02:41:24'),
(2, 'ucar', 'furniture', 1, 3, 1, '2018-03-13 02:40:46'),
(3, 'spring', 'avto zapchasti', 3, 4, 1, '2018-03-13 02:41:15'),
(4, 'ucar', 'avto zapchasti', 2, 2, 1, '2018-03-13 02:41:18'),
(5, 'avtoklad', 'furniture', 4, 3, 1, '2018-03-13 02:41:35');

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
  ADD PRIMARY KEY (`article`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблиці `bindings`
--
ALTER TABLE `bindings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблиці `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблиці `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблиці `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
