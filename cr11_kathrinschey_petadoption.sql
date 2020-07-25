-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Jul 2020 um 16:00
-- Server-Version: 10.4.13-MariaDB
-- PHP-Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr11_kathrinschey_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_kathrinschey_petadoption` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cr11_kathrinschey_petadoption`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE `animals` (
  `animal_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` text NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `age` int(20) NOT NULL,
  `hobbies` varchar(200) DEFAULT NULL,
  `typ` enum('sm','lg') NOT NULL,
  `fk_location_city` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`animal_id`, `name`, `img`, `description`, `age`, `hobbies`, `typ`, `fk_location_city`) VALUES
(4, 'Füsschen', 'fuess.jpg', 'Die Bengalkatze ist eine Rassekatze, die aus der Kreuzung der asiatischen Leopardenkatze – eine Wildkatze – mit einer kurzhaarigen Hauskatze hervorging.                                                ', 6, 'Vögel jagen, herumgetragen werden, gebürstet werden', 'sm', 'Burgenland'),
(5, 'Franz', 'mini.jpg', 'Für jemanden, der wenig Platz aber ein großes Herz für Tiere hat, sind Mini-Schildkröten womöglich eine gute Alternative zu größeren Exemplaren der gepanzerten Reptilienart.', 2, 'doof schauen, blattsalat essen und überall hin mitgenommen zu werden', 'sm', 'Burgenland'),
(6, 'Sissi', 'sissi.jpg', 'Der Kanarienvogel, auch Kanarie, süddeutsch und österreichisch Kanari, stammt vom Kanarengirlitz ab.                        ', 2, 'im Spiegel ansehen, Stangal knabbern und zwitschern.wir würden uns freuen adoptiert z werden.', 'sm', 'Wien'),
(7, 'Harald', 'harald.jpg', 'Die Krokodile sind eine Ordnung der amniotischen Landwirbeltiere. Heute werden etwa 25 Arten unterschieden, die sich auf 8 bis 9 Gattungen in den drei Familien der Echten Krokodile, der Alligatoren und der Gaviale verteilen.', 7, 'mit Herrchen/Frauchen spazieren gehen, Bauch kraulen lassen und einfach in der Sonne abhängen', 'lg', 'Wien'),
(9, 'Pauli', 'pauli.jpg', 'Der Bernhardiner oder St. Bernhardshund ist eine von der FCI anerkannte Schweizer Hunderasse.            ', 7, 'sabbern, essen, herumlaufen', 'sm', 'Burgenland'),
(10, 'Hugo', 'hugo.jpg', 'Die Elefanten sind eine Familie aus der Ordnung der Rüsseltiere. Die Familie stellt die größten gegenwärtig lebenden Landtiere und schließt außerdem die einzigen heute noch lebenden Vertreter der Ordnungsgruppe ein', 7, 'in die Ferne kucken', 'lg', 'Burgenland'),
(11, 'Barbara', 'barbara.jpg', 'Die Elefanten sind eine Familie aus der Ordnung der Rüsseltiere. Die Familie stellt die größten gegenwärtig lebenden Landtiere und schließt außerdem die einzigen heute noch lebenden Vertreter der Ordnungsgruppe ein.', 33, 'mit dem Rüssel Wasser herumspritzen', 'lg', 'Burgenland'),
(12, 'Sepp', 'sepp.jpg', 'Der Komodowaran oder Komododrache ist eine Echse aus der Gattung der Warane, deren Verbreitungsgebiet auf einige der Kleinen Sundainseln von Indonesien beschränkt ist.            ', 12, 'meine Runden ziehen und nach Beute ausschau halten', 'sm', 'Wien'),
(13, 'Carry', 'carry.jpg', 'Die Deutsche Dogge ist eine von der FCI anerkannte deutsche Hunderasse. Die Rasse ist der offizielle State Dog des US-Bundesstaats Pennsylvania.', 8, 'schlafen, streicheln lassen und auf meinem Lieblingskissen chillen', 'lg', 'Wien'),
(14, 'Ilse', 'ilse.jpg', 'Das Hausrind oder schlicht Rind ist die domestizierte Form des eurasischen Auerochsen. Es wurde zunächst wegen seines Fleisches, später auch wegen seiner Milch und Leistung als Zugtier domestiziert.', 10, 'grasen, in der Gegend herumschnuppern und mich streicheln lassen', 'lg', 'Burgenland'),
(18, 'Stinka', 'stinka.jpg', 'Er schaut gerne doof und frisst viel.', 4, 'schlafen, Fenster schauen und kuscheln.', 'sm', 'Wien'),
(19, 'Minki', 'haus.jpg', 'Normale HAuskatze', 2, 'mit Herrchen/Frauchen spazieren gehen, Bauch kraulen lassen und einfach in der Sonne abhängen', 'sm', 'Burgenland');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `locations`
--

CREATE TABLE `locations` (
  `loc_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `img` text NOT NULL,
  `adress` varchar(250) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `locations`
--

INSERT INTO `locations` (`loc_id`, `name`, `img`, `adress`, `city`, `zip`) VALUES
(1, 'Tierheim Vösendorf', 'voes.jpg', 'Triester Strasse 8', 'Vösendorf', 2331),
(2, 'Tierheim Baden', 'bad.jpg', 'Zubringerstraße 64', 'Traiskirchen', 2500),
(3, 'Tierhilfswerk Burgenland', 'burg.jpg', 'Ober-Henndorf 14', 'Burgenland', 8380),
(4, 'Tierhilfswerk Kathi', 'kat.jpg', 'Schlachthausgasse 41', 'Wien', 1030);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `status` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `userName`, `userEmail`, `userPass`, `status`) VALUES
(1, 'Susi', 'Susi@mail.at', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user'),
(2, 'Monika', 'monika@mail.at', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'admin'),
(3, 'Mausi', 'mausi@mail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user'),
(4, 'Alexander', 'alexander.aigner@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indizes für die Tabelle `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT für Tabelle `locations`
--
ALTER TABLE `locations`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
