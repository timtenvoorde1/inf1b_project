-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 jan 2019 om 13:58
-- Serverversie: 10.1.35-MariaDB
-- PHP-versie: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plenairwebapp`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admins`
--

CREATE TABLE `admins` (
  `AdminNR` int(4) NOT NULL,
  `Naam` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `admins`
--

INSERT INTO `admins` (`AdminNR`, `Naam`, `Email`, `Password`) VALUES
(1, 'Raymond Blankenstijn', 'raymond.blankenstijn@stenden.com', 'wachtwoord');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `agenda`
--

CREATE TABLE `agenda` (
  `AgendaNR` int(4) NOT NULL,
  `Cohort` char(9) NOT NULL,
  `Schooljaar` int(4) NOT NULL,
  `Periode` int(1) NOT NULL,
  `WeekPeriode` int(2) NOT NULL,
  `Tekst` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `feedback/suggestie`
--

CREATE TABLE `feedback/suggestie` (
  `ID` int(4) NOT NULL,
  `Tekst` text NOT NULL,
  `Datum` date NOT NULL,
  `Cohort` char(9) NOT NULL,
  `Schooljaar` int(4) NOT NULL,
  `Periode` int(1) NOT NULL,
  `Module` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groepsindeling`
--

CREATE TABLE `groepsindeling` (
  `ID` int(4) NOT NULL,
  `Cohort` char(9) NOT NULL,
  `Schooljaar` int(4) NOT NULL,
  `Periode` int(1) NOT NULL,
  `ImagePath` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `notulen`
--

CREATE TABLE `notulen` (
  `AgendaNR` int(4) NOT NULL,
  `LeerlingNR` int(11) NOT NULL,
  `Tekst` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `LeerlingNR` int(11) NOT NULL,
  `Naam` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Cohort` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`LeerlingNR`, `Naam`, `Email`, `Password`, `Cohort`) VALUES
(4520459, 'Nick ten Caat', 'nick.ten.caat@nhlstenden.com', 'Test123', '2018/2019'),
(4547012, 'Maurice Hoekstra', 'maurice.hoekstra@nhlstenden.com', 'Test123', '2018/2019'),
(4552830, 'Johan RIkse', 'johan.rikse@nhlstenden.com', 'Test123', '2018/2019'),
(4580443, 'Twan Verdel', 'twan.verdel@nhlstenden.com', 'Test123', '2018/2019'),
(4604474, 'Thijs van der Wall', 'thijs.van.der.wall@nhlstenden.com', 'Test123', '2018/2019');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminNR`);

--
-- Indexen voor tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`AgendaNR`);

--
-- Indexen voor tabel `feedback/suggestie`
--
ALTER TABLE `feedback/suggestie`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `groepsindeling`
--
ALTER TABLE `groepsindeling`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `notulen`
--
ALTER TABLE `notulen`
  ADD KEY `AgendaNR` (`AgendaNR`),
  ADD KEY `LeerlingNR` (`LeerlingNR`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`LeerlingNR`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminNR` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `AgendaNR` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `feedback/suggestie`
--
ALTER TABLE `feedback/suggestie`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `groepsindeling`
--
ALTER TABLE `groepsindeling`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `notulen`
--
ALTER TABLE `notulen`
  ADD CONSTRAINT `AgendaNR` FOREIGN KEY (`AgendaNR`) REFERENCES `agenda` (`AgendaNR`),
  ADD CONSTRAINT `LeerlingNR` FOREIGN KEY (`LeerlingNR`) REFERENCES `users` (`LeerlingNR`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
