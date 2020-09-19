-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 19 2020 г., 11:07
-- Версия сервера: 10.3.23-MariaDB-0+deb10u1
-- Версия PHP: 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `account`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bills`
--

INSERT INTO `bills` (`id`, `number`, `status`, `date`, `discount`) VALUES
(7, 55, 1, '2020-09-01', 55),
(8, 55, 1, '2019-05-05', 55),
(11, 44, 1, '2020-09-04', 44),
(13, 444, 0, '0444-04-04', 44),
(15, 1, 0, '2020-09-17', 15),
(16, 55, 1, '2020-09-30', 0),
(17, 66, 0, '2020-09-05', 45),
(18, 999, 1, '2020-09-04', 21);

-- --------------------------------------------------------

--
-- Структура таблицы `bill_composition`
--

CREATE TABLE `bill_composition` (
  `id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `sum` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bill_composition`
--

INSERT INTO `bill_composition` (`id`, `bill_id`, `sum`, `quantity`, `name`) VALUES
(6, 7, 443, 32, 'test'),
(8, 7, 122, 122, '455hhgh'),
(11, 15, 1000, 7, 'Почта России'),
(13, 8, 155, 4, 'test');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bill_composition`
--
ALTER TABLE `bill_composition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_composition_ibfk_1` (`bill_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `bill_composition`
--
ALTER TABLE `bill_composition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bill_composition`
--
ALTER TABLE `bill_composition`
  ADD CONSTRAINT `bill_composition_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
