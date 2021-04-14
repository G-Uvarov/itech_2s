-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 05 2021 г., 14:44
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `laboratorium1`
--
CREATE DATABASE IF NOT EXISTS `laboratorium1` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `laboratorium1`;

-- --------------------------------------------------------

--
-- Структура таблицы `computer`
--

CREATE TABLE `computer` (
  `id_computer` int(10) NOT NULL,
  `netname` varchar(120) COLLATE latin1_general_ci NOT NULL,
  `motherboard` varchar(120) COLLATE latin1_general_ci NOT NULL,
  `ram_capacity` int(11) NOT NULL,
  `hdd_capacity` int(11) NOT NULL,
  `monitor` varchar(120) COLLATE latin1_general_ci NOT NULL,
  `vendor` varchar(120) COLLATE latin1_general_ci NOT NULL,
  `guarantee` date NOT NULL,
  `fid_processor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Дамп данных таблицы `computer`
--

INSERT INTO `computer` (`id_computer`, `netname`, `motherboard`, `ram_capacity`, `hdd_capacity`, `monitor`, `vendor`, `guarantee`, `fid_processor`) VALUES
(1, 'Peter', 'OP85FRT', 1000, 120000, 'Ret', 'Tosiba', '2021-04-15', 1),
(2, 'Alice', 'UY89JBH', 1200, 200000, 'Oled', 'Appl', '2021-03-17', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `computer_software`
--

CREATE TABLE `computer_software` (
  `fid_computer` int(11) NOT NULL,
  `fid_software` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Дамп данных таблицы `computer_software`
--

INSERT INTO `computer_software` (`fid_computer`, `fid_software`) VALUES
(1, 1),
(1, 3),
(1, 4),
(2, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `processor`
--

CREATE TABLE `processor` (
  `id_processor` int(10) NOT NULL,
  `name` varchar(120) COLLATE latin1_general_ci NOT NULL,
  `frequency` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Дамп данных таблицы `processor`
--

INSERT INTO `processor` (`id_processor`, `name`, `frequency`) VALUES
(1, 'Celeron', 3600),
(2, 'i3', 4000);

-- --------------------------------------------------------

--
-- Структура таблицы `software`
--

CREATE TABLE `software` (
  `id_software` int(10) NOT NULL,
  `name` varchar(120) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Дамп данных таблицы `software`
--

INSERT INTO `software` (`id_software`, `name`) VALUES
(1, 'Windows'),
(2, 'Linux'),
(3, 'Adobe Photoshop'),
(4, 'Microsoft PowerPoint');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `computer`
--
ALTER TABLE `computer`
  ADD PRIMARY KEY (`id_computer`) USING BTREE,
  ADD KEY `fid_processor` (`fid_processor`);

--
-- Индексы таблицы `computer_software`
--
ALTER TABLE `computer_software`
  ADD PRIMARY KEY (`fid_computer`,`fid_software`),
  ADD KEY `fid_software` (`fid_software`);

--
-- Индексы таблицы `processor`
--
ALTER TABLE `processor`
  ADD PRIMARY KEY (`id_processor`) USING BTREE;

--
-- Индексы таблицы `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id_software`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `computer`
--
ALTER TABLE `computer`
  MODIFY `id_computer` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `processor`
--
ALTER TABLE `processor`
  MODIFY `id_processor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `software`
--
ALTER TABLE `software`
  MODIFY `id_software` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `computer`
--
ALTER TABLE `computer`
  ADD CONSTRAINT `computer_ibfk_1` FOREIGN KEY (`fid_processor`) REFERENCES `processor` (`id_processor`);

--
-- Ограничения внешнего ключа таблицы `computer_software`
--
ALTER TABLE `computer_software`
  ADD CONSTRAINT `computer_software_ibfk_1` FOREIGN KEY (`fid_computer`) REFERENCES `computer` (`id_computer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `computer_software_ibfk_2` FOREIGN KEY (`fid_software`) REFERENCES `software` (`id_software`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
