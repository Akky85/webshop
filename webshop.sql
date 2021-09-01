-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Júl 22. 12:21
-- Kiszolgáló verziója: 10.3.15-MariaDB
-- PHP verzió: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `webshop`
--
CREATE DATABASE IF NOT EXISTS `webshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `webshop`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `adatok`
--

CREATE TABLE `adatok` (
  `id` int(9) NOT NULL,
  `user` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `pwd` varchar(100) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `adatok`
--

INSERT INTO `adatok` (`id`, `user`, `email`, `pwd`) VALUES
(1, 'oktató', '', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(3, 'peti', '', '8c829ee6a1ac6ffdbcf8bc0ad72b73795fff34e8'),
(4, 'tesztfiok', '', '8cb2237d0679ca88db6464eac60da96345513964'),
(5, 'oktató', '', '20eabe5d64b0e216796e834f52d61fd0b70332fc');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `id` int(9) NOT NULL,
  `admin` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `pwd` varchar(100) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `admin`
--

INSERT INTO `admin` (`id`, `admin`, `pwd`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoriak`
--

CREATE TABLE `kategoriak` (
  `id` int(2) NOT NULL,
  `katnev` varchar(255) NOT NULL,
  `katsorrend` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `kategoriak`
--

INSERT INTO `kategoriak` (`id`, `katnev`, `katsorrend`) VALUES
(1, 'Számítógép', 1),
(2, 'HP Notebook', 2),
(3, 'Dell Notebook', 3),
(4, 'Asus Notebook', 4),
(5, 'Lenovo Notebook', 5),
(6, 'Apple Notebook', 6),
(7, 'Toshiba Notebook', 7);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendelesek`
--

CREATE TABLE `rendelesek` (
  `id` int(5) NOT NULL,
  `vevoid` int(4) NOT NULL,
  `szallitas` varchar(20) NOT NULL,
  `fizmod` varchar(50) NOT NULL,
  `datum` date NOT NULL,
  `statusz` varchar(50) NOT NULL,
  `bosszeg` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `rendelesek`
--

INSERT INTO `rendelesek` (`id`, `vevoid`, `szallitas`, `fizmod`, `datum`, `statusz`, `bosszeg`) VALUES
(1, 1, 'gls', 'obk', '2020-07-22', 'függőben', '4001900'),
(2, 2, 'gls', 'obk', '2020-07-22', 'függőben', '550000'),
(3, 3, 'gls', 'obk', '2020-07-22', 'függőben', '151900'),
(4, 4, 'posta-utanvet', 'atutalas', '2020-07-22', 'függőben', '550000');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rend_term`
--

CREATE TABLE `rend_term` (
  `id` int(5) NOT NULL,
  `rendelesid` int(5) NOT NULL,
  `termekid` int(5) NOT NULL,
  `db` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `rend_term`
--

INSERT INTO `rend_term` (`id`, `rendelesid`, `termekid`, `db`) VALUES
(1, 1, 4, 1),
(2, 1, 3, 2),
(3, 1, 2, 2),
(4, 1, 1, 3),
(5, 2, 3, 1),
(6, 3, 4, 1),
(7, 4, 3, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tajekoztato`
--

CREATE TABLE `tajekoztato` (
  `id` int(2) NOT NULL,
  `cim` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `content` mediumtext COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tajekoztato`
--

INSERT INTO `tajekoztato` (`id`, `cim`, `content`) VALUES
(2, 'Vásárlói tájékoztató', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean velit sem, commodo vel erat id, feugiat dictum odio. Nulla aliquet ligula ac odio congue, ultricies bibendum ligula dignissim. Mauris vel magna finibus purus posuere dignissim eu sed ante. Vestibulum eget lacinia lectus, nec porta elit. Sed luctus, dolor eu sodales dapibus, magna erat blandit erat, et consectetur felis ante ut nulla. Proin ullamcorper mattis vulputate. Ut ac leo id lorem rutrum congue sit amet sit amet est. Fusce gravida sapien vitae ligula blandit pretium. Phasellus fermentum ullamcorper condimentum. Nam eget pellentesque erat. Integer vitae nunc vel nulla commodo viverra sed vitae tortor. Phasellus nec varius eros, eu efficitur metus. Fusce bibendum tortor a enim bibendum, non elementum turpis posuere. Aliquam tristique enim eget metus aliquet volutpat. Vestibulum a condimentum felis, quis consectetur neque.</p>\r\n<p>&nbsp;</p>\r\n<p>Praesent facilisis volutpat tortor, id finibus sem pretium in. Vivamus feugiat tristique lorem a rutrum. Aenean dolor ante, pretium nec tellus quis, accumsan laoreet nunc. Curabitur faucibus faucibus arcu, sed fermentum turpis vehicula id. In in eros purus. Fusce euismod diam in urna tempus consectetur. Ut nec tincidunt risus. Integer vitae lectus turpis. Nunc nunc erat, ultricies id erat at, mollis porttitor est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam condimentum sem id ante volutpat, non condimentum enim porttitor. Quisque elementum libero vitae bibendum euismod. Mauris luctus laoreet nulla sed venenatis. Donec eget imperdiet ex. Donec nunc sem, cursus gravida nisi sed, dapibus egestas urna. Fusce ullamcorper, ex vitae dapibus pellentesque, lacus mauris blandit magna, vitae congue nisl nunc sit amet mi.</p>\r\n<p>&nbsp;</p>\r\n<p>Donec rutrum lacinia fermentum. Nunc ut blandit ante. Aliquam venenatis lacus vel mauris semper venenatis. Vestibulum vel dignissim ante. Phasellus ut turpis non augue elementum ultrices. Curabitur consectetur, orci id molestie dictum, metus dui elementum orci, vitae ultrices elit nibh sed magna. Nullam interdum, urna et pretium volutpat, dui ante lacinia sem, sed pretium mauris magna in dolor. Quisque tincidunt lectus quis velit pellentesque interdum. Mauris vitae ultrices metus, eu consequat purus. Curabitur facilisis lorem lacinia eros viverra, in lobortis eros luctus.</p>\r\n<p>&nbsp;</p>\r\n<p>Cras congue nulla eu nisl laoreet ultricies. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec ultricies urna a aliquet auctor. In at laoreet felis. Aliquam nibh erat, dignissim et commodo faucibus, accumsan eget magna. Curabitur sit amet rhoncus justo. Vivamus eget risus tincidunt, fermentum neque a, rutrum dui. Praesent fermentum sem lacus, nec efficitur quam sollicitudin et. Integer eu mi purus. Ut quis enim sit amet arcu suscipit malesuada non at odio. Maecenas consectetur facilisis tortor, vel molestie diam tempus eu. In hac habitasse platea dictumst. Integer sit amet lobortis mauris. Fusce ut ultrices urna.</p>');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termekek`
--

CREATE TABLE `termekek` (
  `id` int(5) NOT NULL,
  `kategoria` varchar(100) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `cikkszam` decimal(10,0) NOT NULL,
  `ar` decimal(10,0) NOT NULL,
  `rleiras` varchar(255) NOT NULL,
  `hleiras` mediumtext NOT NULL,
  `kep` varchar(255) NOT NULL,
  `keszlet` int(3) NOT NULL,
  `aktiv` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `termekek`
--

INSERT INTO `termekek` (`id`, `kategoria`, `nev`, `cikkszam`, `ar`, `rleiras`, `hleiras`, `kep`, `keszlet`, `aktiv`) VALUES
(1, '4', 'Asus TUF 15', '1', '350000', 'Asus TUF 15', 'Asus TUF 15', 'img/termek1.jpg', 31, 1),
(2, '6', 'Macbook Pro 16', '2', '850000', 'Macbook Pro 16', 'Macbook Pro 16', 'img/termek2.jpg', 5, 1),
(3, '3', 'Dell XPS 15', '3', '550000', 'Dell XPS 15', 'Dell XPS 15', 'img/termek3.jpg', 51, 1),
(4, '5', 'Lenovo IdeaPad S145', '4', '151900', 'Lenovo IdeaPad S145', 'Lenovo IdeaPad S145\r\nLenovo IdeaPad S145\r\nLenovo IdeaPad S145', 'img/termek4.jpg', 10, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vevok`
--

CREATE TABLE `vevok` (
  `id` int(4) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `cim` varchar(255) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `szcim` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `vevok`
--

INSERT INTO `vevok` (`id`, `nev`, `email`, `cim`, `telefon`, `pw`, `szcim`) VALUES
(1, 'Szabó Péter', 'szabo.p992@gmail.com', '', '06902345678', '', '4028 Debrecen, Szigligeti u.12'),
(2, 'Szabó Péter', 'szabo.p992@gmail.com', '', '06902345678', '', '4028 Debrecen, Szigligeti u.12'),
(3, 'Szabó Péter', 'szabo.p992@gmail.com', '', '06302713471', '', '4028 Debrecen, Szigligeti u.12'),
(4, 'user1', 'szabo.p992@gmail.com', '', '06902345678', '', '4028 Debrecen, Szigligeti u.12');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `adatok`
--
ALTER TABLE `adatok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `rendelesek`
--
ALTER TABLE `rendelesek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `rend_term`
--
ALTER TABLE `rend_term`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `termekek`
--
ALTER TABLE `termekek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `vevok`
--
ALTER TABLE `vevok`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `adatok`
--
ALTER TABLE `adatok`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `rendelesek`
--
ALTER TABLE `rendelesek`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `rend_term`
--
ALTER TABLE `rend_term`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `termekek`
--
ALTER TABLE `termekek`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `vevok`
--
ALTER TABLE `vevok`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
