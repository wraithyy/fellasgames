-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 26. lis 2019, 00:13
-- Verze serveru: 10.4.6-MariaDB
-- Verze PHP: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `clgf`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `contestant`
--

CREATE TABLE `contestant` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nick` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `contestant`
--

INSERT INTO `contestant` (`id`, `firstname`, `lastname`, `nick`, `gender`) VALUES
(2, 'Pepa', 'Kvapil', 'Pepé', 'm'),
(3, 'Daniel', 'Pohořalý', 'Danny', 'm'),
(4, 'Daniel', 'Pohořalý', 'Dannyyyy', 'f'),
(5, 'Jakub', 'Khun', 'Kuba', 'm'),
(6, 'Michaela', 'Mašková', 'Mášaqq', 'f'),
(7, '', '', '', '');

-- --------------------------------------------------------

--
-- Struktura tabulky `in_category`
--

CREATE TABLE `in_category` (
  `id_category` int(11) NOT NULL,
  `id_contestant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `judges`
--

CREATE TABLE `judges` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nick` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `judges`
--

INSERT INTO `judges` (`id`, `firstname`, `lastname`, `nick`) VALUES
(1, 'Martin', 'Boček', 'Bočíno');

-- --------------------------------------------------------

--
-- Struktura tabulky `points`
--

CREATE TABLE `points` (
  `position` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `points`
--

INSERT INTO `points` (`position`, `points`) VALUES
(1, 100),
(2, 95),
(3, 90),
(4, 85),
(5, 80),
(6, 75),
(7, 70),
(8, 65),
(9, 60),
(10, 55),
(11, 50),
(12, 48),
(13, 46),
(14, 44),
(15, 42),
(16, 40),
(17, 38),
(18, 36),
(19, 34),
(20, 32),
(21, 30),
(22, 28),
(23, 26),
(24, 24),
(25, 22),
(26, 20),
(27, 18),
(28, 16),
(29, 14),
(30, 12),
(31, 10),
(32, 8),
(33, 6),
(34, 4),
(35, 2),
(36, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `id_contestant` int(11) NOT NULL,
  `id_workout` int(11) NOT NULL,
  `result` float NOT NULL,
  `id_judge` int(11) NOT NULL,
  `rx` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `result`
--

INSERT INTO `result` (`id`, `id_contestant`, `id_workout`, `result`, `id_judge`, `rx`) VALUES
(4, 3, 2, 50, 0, 0),
(5, 2, 3, 60, 0, 0),
(10, 5, 2, 50, 0, 1),
(11, 2, 2, 200, 0, 1),
(12, 2, 1, 0, 0, 0),
(13, 3, 2, 200, 0, 1),
(14, 2, 2, 200, 0, 1),
(15, 2, 2, 456456, 0, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `workout`
--

CREATE TABLE `workout` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `byTime` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `workout`
--

INSERT INTO `workout` (`id`, `name`, `description`, `byTime`) VALUES
(1, 'cindy', 'nějaký kokotiny', 0),
(2, 'Grace', '30x clean', 0),
(3, 'Murph', 'vsichni vedi', 1),
(4, 'Lano', 'Leze se', 1);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `contestant`
--
ALTER TABLE `contestant`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `judges`
--
ALTER TABLE `judges`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`position`);

--
-- Klíče pro tabulku `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `workout`
--
ALTER TABLE `workout`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `contestant`
--
ALTER TABLE `contestant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `judges`
--
ALTER TABLE `judges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pro tabulku `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `workout`
--
ALTER TABLE `workout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
