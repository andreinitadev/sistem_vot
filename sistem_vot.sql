-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Gazdă: localhost:3306
-- Timp de generare: ian. 12, 2021 la 09:11 PM
-- Versiune server: 10.2.33-MariaDB-log-cll-lve
-- Versiune PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `tutunca1_sistem_vot`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `useri`
--

CREATE TABLE `useri` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `timpul_crearii` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `useri`
--

INSERT INTO `useri` (`id`, `user`, `parola`, `timpul_crearii`) VALUES
(1, 'user', '$2y$10$GwlSaL47ZxqKg1W5NpSKVeEy611KuhNJkCd/HDo0aS2FESfdpfVlO', '2020-12-02 18:48:09'),
(18, 'cont', '$2y$10$ONkVLr.IDVvm37clU6GLsuF.6T1bfpSVIVi7fadRMZffKvQjRAKJ2', '2020-12-03 22:28:28'),
(19, 'cobt123', '$2y$10$z4zcSKqEyWDabNd6S9IL2Oku/bGDrqKALcHDthrcUHvrGZdBaFwVm', '2020-12-15 08:26:08'),
(20, 'cont123', '$2y$10$JGU/mzL/ONUkAa1OmXz1suJWvHmx0kKCy.Cqd2S3zjbEDEkAnlrbq', '2020-12-19 18:25:10');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `voturi`
--

CREATE TABLE `voturi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `guest_ip` varchar(15) NOT NULL,
  `timpul_votarii` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `voturi`
--

INSERT INTO `voturi` (`id`, `user_id`, `guest_ip`, `timpul_votarii`) VALUES
(1, 1, '::1', '2020-12-03 16:58:20'),
(23, 1, '::1', '2020-12-03 23:39:25'),
(27, 18, '::1', '2020-12-04 21:32:36'),
(28, 1, '::1', '2020-12-04 22:58:19'),
(29, 19, '::1', '2020-12-15 08:26:15'),
(30, 1, '::1', '2020-12-16 19:04:36'),
(31, 1, '82.76.142.9', '2020-12-19 18:38:31'),
(32, 1, '82.76.142.9', '2020-12-21 16:06:31'),
(33, 20, '82.76.142.9', '2020-12-21 17:59:32');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `useri`
--
ALTER TABLE `useri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`user`);

--
-- Indexuri pentru tabele `voturi`
--
ALTER TABLE `voturi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user-id` (`user_id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `useri`
--
ALTER TABLE `useri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pentru tabele `voturi`
--
ALTER TABLE `voturi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `voturi`
--
ALTER TABLE `voturi`
  ADD CONSTRAINT `user-id` FOREIGN KEY (`user_id`) REFERENCES `useri` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
