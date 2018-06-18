-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 23 2017 г., 08:55
-- Версия сервера: 5.5.40
-- Версия PHP: 5.4.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `admin_domaincatalog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dc_domain`
--

CREATE TABLE IF NOT EXISTS `dc_domain` (
`id` int(11) NOT NULL,
  `domain` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dc_domain`
--

INSERT INTO `dc_domain` (`id`, `domain`) VALUES
(20, ''),
(6, 'buyanxietydrugs.com'),
(7, 'dcwomenkickingass.tumblr.com'),
(9, 'dragonstack.com'),
(13, 'dsspain.com'),
(16, 'footfallcam.com'),
(11, 'francedrugstores.com'),
(18, 'genericlevitra.usa.com'),
(2, 'googler.ru'),
(15, 'Intuniv'),
(17, 'javabrains.io'),
(10, 'maturehairycunts.com'),
(5, 'nightline-delivers.com'),
(12, 'realitypi.net'),
(1, 'rembler.ru'),
(3, 'slo-indo'),
(19, 'softpicks.com.de'),
(4, 'toyawater.com');

-- --------------------------------------------------------

--
-- Структура таблицы `dc_domain_comment`
--

CREATE TABLE IF NOT EXISTS `dc_domain_comment` (
`id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dc_domain_comment`
--

INSERT INTO `dc_domain_comment` (`id`, `domain_id`, `name`, `comment`, `status`, `type`) VALUES
(1, 6, 'afasfa', 'f sf adg sdfgh dfh dgh', 0, 0),
(3, 6, 'sdfgsd', 'sd gdsgs dgdfh h h dhdfhfhhfh', 0, 0),
(4, 6, 'hgjhg', 'hjgfjghfjgh', 0, 0),
(5, 11, 'sdsd', 'type 1 goes here', 0, 0),
(6, 11, 'test 2', 'type 2 goes here', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `dc_domain_text`
--

CREATE TABLE IF NOT EXISTS `dc_domain_text` (
`id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `text_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dc_domain_text`
--

INSERT INTO `dc_domain_text` (`id`, `domain_id`, `text_id`) VALUES
(23, 4, 1),
(24, 4, 2),
(25, 4, 5),
(26, 12, 1),
(27, 12, 2),
(28, 12, 4),
(29, 10, 1),
(30, 10, 2),
(31, 10, 6),
(32, 18, 1),
(33, 18, 3),
(34, 18, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `dc_text`
--

CREATE TABLE IF NOT EXISTS `dc_text` (
`id` int(11) NOT NULL,
  `text` text NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dc_text`
--

INSERT INTO `dc_text` (`id`, `text`, `type`) VALUES
(1, 'Параметр encoding представляет собой символьную кодировку. Если он опущен, вместо него будет использовано значение внутренней кодировки.', 1),
(2, 'ВниманиеЭта функция может возвращать как boolean FALSE, так и не-boolean значение, которое приводится к FALSE. За более подробной информацией обратитесь к разделу Булев тип. Используйте оператор === для проверки значения, возвращаемого этой функцией.', 2),
(3, 'Speed of mb_strlen varies a lot according to specified character set.', 2),
(4, 'Возвращает количество символов в строке (string) str, имеющих кодировку символов encoding. Многобайтный символ вычисляется как 1. ', 3),
(5, 'Корректно выполняет substr() для многобайтовых кодировок, учитывая количество символов. Позиция отсчитывается от начала str. Позиция первого символа - 0, второго - 1 и т.д. ', 3),
(6, 'Если start не отрицательное, возвращенная строка начнется с позиции start от начала строки str, начальный символ имеет индекс 0. К примеру, в строке ''abcdef'', символ в позиции 0 - это ''a'', символ в позиции 2 - ''c'' и т.д. ', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dc_domain`
--
ALTER TABLE `dc_domain`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `domain` (`domain`);

--
-- Индексы таблицы `dc_domain_comment`
--
ALTER TABLE `dc_domain_comment`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dc_domain_text`
--
ALTER TABLE `dc_domain_text`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dc_text`
--
ALTER TABLE `dc_text`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dc_domain`
--
ALTER TABLE `dc_domain`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `dc_domain_comment`
--
ALTER TABLE `dc_domain_comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `dc_domain_text`
--
ALTER TABLE `dc_domain_text`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT для таблицы `dc_text`
--
ALTER TABLE `dc_text`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
