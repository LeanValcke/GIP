-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 21, 2020 at 10:41 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gip2020`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbestelbons`
--

CREATE TABLE `tblbestelbons` (
  `id` int(11) NOT NULL,
  `tblklant_KlantID` int(11) NOT NULL,
  `besteldatum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `korting_totaal` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblbestelbons`
--

INSERT INTO `tblbestelbons` (`id`, `tblklant_KlantID`, `besteldatum`, `status`, `korting_totaal`) VALUES
(131, 8, '2020-05-21 22:39:34', 1, '6.00');

-- --------------------------------------------------------

--
-- Table structure for table `tblbestelbons_tblproduct`
--

CREATE TABLE `tblbestelbons_tblproduct` (
  `id` int(11) NOT NULL,
  `tblbestelbons_id` int(11) NOT NULL,
  `tblproduct_ProductID` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `eenheidsprijs` decimal(10,2) NOT NULL,
  `korting` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblbestelbons_tblproduct`
--

INSERT INTO `tblbestelbons_tblproduct` (`id`, `tblbestelbons_id`, `tblproduct_ProductID`, `aantal`, `eenheidsprijs`, `korting`) VALUES
(67, 131, 40, 3, '40.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `tblbestelling`
--

CREATE TABLE `tblbestelling` (
  `BonID` int(11) NOT NULL,
  `Aantal` int(11) DEFAULT NULL,
  `Datum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblbestellingproduct`
--

CREATE TABLE `tblbestellingproduct` (
  `BonID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Merchnaam` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Prijs` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblbestelstatus`
--

CREATE TABLE `tblbestelstatus` (
  `id` int(11) NOT NULL,
  `status` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblbestelstatus`
--

INSERT INTO `tblbestelstatus` (`id`, `status`) VALUES
(1, 'Nieuw'),
(2, 'In behandeling'),
(3, 'Voltooid'),
(4, 'Geannuleerd'),
(5, 'Onbekend');

-- --------------------------------------------------------

--
-- Table structure for table `tblgameafdeling`
--

CREATE TABLE `tblgameafdeling` (
  `GameID` int(11) NOT NULL,
  `Gamenaam` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Beschrijving` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblgameafdeling`
--

INSERT INTO `tblgameafdeling` (`GameID`, `Gamenaam`, `Beschrijving`, `foto`) VALUES
(1, 'Fortnite', 'Jij en meer dan 100 spelers vechten om als laatste over te blijven. Verken een grote, vernietigbare wereld waar geen twee games ooit hetzelfde zijn. Ervaar Battle Royale op een nieuwe en unieke manier in elke beperkte tijdmodus.', 'hero-slider/fortnite.png'),
(2, 'Overwatch', 'Ga de strijd aan op toekomstige slagvelden en kies je held uit een reeks soldaten, wetenschappers, avonturiers en schepsels van allerlei pluimage. Manipuleer de tijd, tart de zwaartekracht en ontketen ijzingwekkende krachten en wapens.', 'hero-slider/overwatch.png'),
(3, 'GTA V', 'Werk je omhoog in de criminele wereld van Los Santos en Blaine County, maak voortdurend keuzes en speel op nieuwe manieren in de ultieme online ervaring.', 'hero-slider/gta.png'),
(4, 'Minecraft', 'Minecraft is een Open World-game. Het kan gespeeld worden in de modus singleplayer of de modus multiplayer. Bij dit spel kan men in een uitgestrekt gebied kubusvormige objecten plaatsen op een rooster.', 'hero-slider/minecraft.png'),
(5, 'CS:GO', 'Counter-Strike: Global Offensive is een first-person shooter game. Deze videogame zorgt voor een competitieve community. Zo werkt het spel met een rangsysteem. De speler kan een hogere rang halen door games te winnen tegen andere spelers', 'hero-slider/csgo.png'),
(6, 'Assassins Creed', 'Assassin\'s Creed is een actie-avontuur videogame. Maak geschiedenis als de legendarische Assassin', 'hero-slider/assassinscreed.png'),
(7, 'Watch Dogs 2', 'Hacken is jouw wapen in de gigantische en dynamische open wereld van Watch Dogs 2. Ontdek een gigantische open wereld met ontzettend veel verschillende speelwijzen.', 'hero-slider/watchdogs.png'),
(8, 'Call of Duty: BO', 'Call of Duty: Black Ops legt de lat hoog voor de multiplayer-modus met tactische gameplay en keuze uit verschillende personages, samen met de drie zombies ervaringen, het grootste aanbod dat ooit bij een lancering is uitgebracht.', 'hero-slider/callofduty.jpg'),
(9, 'Mortal Kombat', 'Mortal Kombat X is een legendarische, veelgeprezen vechtgame. Het spel combineert een cinematische weergave met geheel nieuwe gameplay voor de meest brute Kombat ervaring ooit.', 'hero-slider/mortal.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblklant`
--

CREATE TABLE `tblklant` (
  `KlantID` int(11) NOT NULL,
  `Naam` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telefoonnummer` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Adres` mediumtext COLLATE utf8_unicode_ci,
  `Gemeente` mediumtext COLLATE utf8_unicode_ci,
  `Postcode` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0',
  `Gebruikersnaam` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Wachtwoord` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblklant`
--

INSERT INTO `tblklant` (`KlantID`, `Naam`, `Telefoonnummer`, `Adres`, `Gemeente`, `Postcode`, `Admin`, `Gebruikersnaam`, `Wachtwoord`, `Email`) VALUES
(1, 'Alexander Perneel', '0488 44 23 22', 'gistelstraat 8', 'Ingelmunster', '8400', 1, 'Alexandraa', '$2y$10$.pqzHvJ27.oBiJJhzUm9A.szu0kuGHVm5yke9vY/Y4q096oIb7qOq', 'Alewanderiscool@gmail.com'),
(2, 'Estelle Duhoux', '0497 535 828', 'Merelstraat 35', 'Bredene', '8450', 1, 'estie', '$2y$10$eOT4iNdKXEDjBLvd6LRKseajSpjJWbIIHRTfjiH2/duLIkkCedJcO', 'estelle.duhoux@hotmail.be'),
(3, 'Lean Valcke', '0494651441', 'Aalscholverstraat 800', 'Bredene', '8450', 1, 'Leonardo', '$2y$10$97o4aylQ/AWauw.GE/8.a.H0L47b4SUrsis.2f0MQeHEWAh/cJnIq', 'leanvalcke@hotmail.com'),
(7, 'z z', 'z', 'z', 'zz', 'z', 0, 'z', '$2y$10$cZZj5eZaqev7hQVGu1PSuOjuiGEEEBg5jqCTPedIf7MMi02HgIK9a', 'oke.be'),
(8, 'Nicolas Ramoudt', '1234856789', 'Teststraat', 'Oostende', '8400', 1, 'smoetje', '$2y$10$TB61kAX96sk6P7nUqCacw.vQ51HvFgGaSEMi8cMidXQJef9JCshCW', 'test@smoetje.eu'),
(9, 'jef klak', '123456798', 'Kwakstraat', 'Brugge', '8000', 0, 'jefklak', '$2y$10$pmENwGCkmKFZZ1dy9Dr89.7e/l1GsHD1UeS8IKaAUx82zD0TLeANC', 'jefklak@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblleveringsadressen`
--

CREATE TABLE `tblleveringsadressen` (
  `id` int(11) NOT NULL,
  `tblbestelbons_id` int(11) NOT NULL,
  `naam` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adres1` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adres2` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `land` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gemeente` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `betaalmethode` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `naamkaart` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kaartnr` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vervaldatum` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cvc` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblleveringsadressen`
--

INSERT INTO `tblleveringsadressen` (`id`, `tblbestelbons_id`, `naam`, `adres1`, `adres2`, `land`, `gemeente`, `postcode`, `betaalmethode`, `naamkaart`, `kaartnr`, `vervaldatum`, `cvc`) VALUES
(13, 131, 'Nicolas Ramoudt', 'Teststraat', '', 'België', 'Oostende', '8400', 'visible', 'Jan Smets', '1234 1234', '06/22', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tblmaat`
--

CREATE TABLE `tblmaat` (
  `ProductID` int(100) NOT NULL,
  `Maat` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblmaat`
--

INSERT INTO `tblmaat` (`ProductID`, `Maat`) VALUES
(1, 'L'),
(1, 'M'),
(1, 'S'),
(5, 'L'),
(5, 'M'),
(5, 'S'),
(11, 'L'),
(11, 'M'),
(11, 'S'),
(21, 'L'),
(21, 'M'),
(21, 'S'),
(23, 'L'),
(23, 'M'),
(23, 'S'),
(24, 'L'),
(24, 'M'),
(24, 'S'),
(25, 'L'),
(25, 'M'),
(25, 'S'),
(27, 'L'),
(27, 'M'),
(27, 'S'),
(29, 'L'),
(29, 'M'),
(29, 'S'),
(30, 'L'),
(30, 'M'),
(30, 'S'),
(31, 'L'),
(31, 'M'),
(31, 'S'),
(32, 'L'),
(32, 'M'),
(32, 'S'),
(34, 'L'),
(34, 'M'),
(34, 'S'),
(35, 'L'),
(35, 'M'),
(35, 'S'),
(37, 'L'),
(37, 'M'),
(37, 'S'),
(40, 'L'),
(40, 'M'),
(40, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `ProductID` int(11) NOT NULL,
  `ProductPrijs` decimal(10,0) DEFAULT NULL,
  `ProductAantal` int(11) DEFAULT NULL,
  `Gamenaam` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Merchnaam` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `GameID` int(11) NOT NULL,
  `foto` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Beschrijving` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`ProductID`, `ProductPrijs`, `ProductAantal`, `Gamenaam`, `Merchnaam`, `GameID`, `foto`, `Beschrijving`) VALUES
(3, '10', 10, 'xxx', 'GTA V Game', 3, 'merch/bion1.jpg', 'Werk je omhoog in de criminele wereld van Los Santos en Blaine County, maak voortdurend keuzes en speel op nieuwe manieren in de ultieme online ervaring.'),
(4, '50', 10, 'Minecraft', 'Minecraft Game', 4, 'merch/MinecraftGame.jpg', 'Minecraft is een Open World-game. Het kan gespeeld worden in de modus singleplayer of de modus multiplayer. Bij dit spel kan men in een uitgestrekt gebied kubusvormige objecten plaatsen op een rooster.'),
(6, '15', 5, 'Assassins Creed', 'Assassins Creed Game', 6, 'merch/AssasinsCreedGame.jpg', 'Assassin\'s Creed is een actie-avontuur videogame. Maak geschiedenis als de legendarische Assassin.'),
(7, '30', 30, 'Watch Dogs 2', 'Watch Dogs 2 Game', 7, 'merch/WatchDogs2Game.jpg', 'Hacken is jouw wapen in de gigantische en dynamische open wereld van Watch Dogs 2. Ontdek een gigantische open wereld met ontzettend veel verschillende speelwijzen.'),
(8, '25', 10, 'Call of Duty: Black ops', 'COD Game', 8, 'merch/CODGame.jpg', 'Call of Duty: Black Ops legt de lat hoog voor de multiplayer-modus met tactische gameplay en keuze uit verschillende personages. Samen met de drie zombies ervaringen, het grootste aanbod dat ooit bij een lancering is uitgebracht.'),
(9, '25', 25, 'Mortal Kombat', 'Mortal Combat Game', 9, 'merch/MortalKombatGame.jpg', 'Mortal Kombat X is een legendarische, veelgeprezen vechtgame. Het spel combineert een cinematische weergave met geheel nieuwe gameplay voor de meest brute Kombat ervaring ooit.'),
(10, '12', 10, 'Fortnite', 'Fortnite Boekentas', 1, 'merch/FortniteDansBoekentas.jpg', 'Wil je graag naar school gaan met een nieuwe Fortnite boekentas? Dan kan deze boekentas jou misschien overtuigen! Deze boekentas bevat 1 compartiment en een voorzak.'),
(11, '30', 5, 'Fortnite', 'Fortnite T-shirt ', 1, 'merch/FortniteTshirtRood.jpg', 'Dit kan jouw nieuwe Fortnite t-shirt zijn! Deze t-shirt is enkel beschikbaar in het rood en bestaat uit 100% katoen.'),
(21, '25', 10, 'Overwatch', 'Overwatch T-shirt ', 2, 'merch/OverwatchTshirtZwart.jpg', 'Dit kan jouw nieuwe Overwatch t-shirt zijn! Deze t-shirt is enkel beschikbaar in het zwart en bestaat uit 100% katoen.'),
(22, '20', 10, 'Overwatch', 'Brigitte Funkopop', 2, 'merch/OverwatchBrigitteFunkopop.jpg', 'Deze leuke Overwatch Bridgitte Funko Pop figuur is ongeveer 9 cm groot en komt verpakt in een window display box.\n'),
(23, '40', 20, 'GTA V', 'GTA V Trui ', 3, 'merch/GTAVTrui.jpg', 'Dit kan jouw nieuwe GTA V trui zijn! Deze trui is enkel beschikbaar in het zwart. Deze trui bevat een kap en een zak aan de voorkant. De trui bestaat volledig uit katoen.'),
(24, '15', 30, 'GTA V', 'GTA V T-shirt', 3, 'merch/GTAVshirt.jpg', 'Heb jij altijd al een t-shirt gewild van GTA V? Dan kan deze t-shirt jou misschien overtuigen!'),
(25, '25', 15, 'Minecraft', 'Minecraft T-shirt ', 4, 'merch/MinecraftTshirtGroen.jpg', 'Sta jij bekend als de persoon die veel dood gaat in Minecraft? Dan is deze t-shirt perfect voor jou! Deze t-shirt bestaat uit 100% katoen en is enkel beschikbaar in het groen.'),
(26, '15', 15, 'Minecraft', 'Minecraft Muts ', 4, 'merch/MinecraftMutsGroen.jpg', 'De nieuwe warme Minecraft muts beschermt je tegen koud weer en wind. Niemand heeft zo een muts als jij.'),
(27, '15', 25, 'CSGO', 'CSGO Tanktop ', 5, 'merch/CSGOTanktopZwart.jpg', 'Dit kan jouw nieuwe CS:GO tanktop zijn! Deze tanktop is enkel beschikbaar in het zwart en bestaat uit 100% katoen.'),
(28, '3', 40, 'CSGO', 'CSGO Armband ', 5, 'merch/CSGOArmband.png', 'Heb jij altijd al een armband gewild dat is gebaseerd op CS:GO. Dan kan deze armband jou misschien overtuigen!'),
(29, '50', 10, 'Assassins Creed', 'Assassins Creed Jas Blauw', 6, 'merch/AssassinsCreedJasBlauw.jpg', 'Dit kan jouw nieuwe Assassin\'s Creed jas zijn! Deze jas is enkel beschikbaar in het zwart met blauw en bestaat uit 60% katoen en 40% polyester.'),
(30, '45', 30, 'Assassins Creed', 'Assassins Creed Jas Grijs', 6, 'merch/AssassinsCreedJasZwart.jpg', 'Dit kan jouw nieuwe Assassin\'s Creed jas zijn! Deze jas is enkel beschikbaar in het grijs met donkergrijs en gouden details en bestaat uit 60% katoen en 40% polyester.\n'),
(31, '50', 50, 'Watch Dogs 2', 'Watch Dogs 2 Trui Zwart', 7, 'merch/WatchDogs2Truizwart.jpg', 'Dit kan jouw nieuwe Watch Dogs trui zijn! Deze trui bevat een kap en een zak aan de voorkant. De trui bestaat uit 100% katoen.\n'),
(32, '55', 10, 'Watch Dogs 2', 'Watch Dogs 2 Trui', 7, 'merch/WatchDogs2Trui.jpg', 'Dit kan jouw nieuwe Watch Dogs trui zijn! Deze trui bevat geen kap en bestaat uit 100% katoen.'),
(33, '15', 20, 'Call of Duty: Black ops', 'COD Mok ', 8, 'merch/CODMokZwart.jpg', 'Heb jij altijd al een mok gewild van Call of Duty? Dan kan deze mok jou misschien overtuigen!'),
(34, '25', 20, 'Call of Duty: Black ops', 'COD T-shirt ', 8, 'merch/CODTshirtZwart.jpg', 'Dit kan jouw nieuwe Call of Duty t-shirt zijn! Deze t-shirt is enkel beschikbaar in het zwart en bestaat uit 100% katoen.'),
(35, '25', 20, 'Mortal Kombat', 'Mortal Kombat T-shirt', 9, 'merch/MortalKombattshirtgeel.jpg', 'Dit kan jouw nieuwe Mortal Kombat t-shirt zijn! Deze t-shirt is enkel beschikbaar in het geel met zwarte en grijze details. Deze t-shirt bestaat uit 100% katoen.\n'),
(36, '15', 20, 'Mortal Kombat', 'Mortal Kombat Mok ', 9, 'merch/MortalKombatmokzwart.jpg', 'Heb jij altijd al een mok gewild van Mortal Kombat X? Dan kan deze mok jou misschien overtuigen!'),
(37, '45', 150, 'Fortnite', 'Fortnite Trui ', 1, 'merch/fortnitetrui.png', 'Dit kan jouw nieuwe Fortnite trui zijn! Deze trui is enkel beschikbaar in het zwart en bevat het bekende Fortnite logo in het wit. Deze trui bevat ook een kap en een zak aan de voorkant. De trui bestaat volledig uit katoen.'),
(38, '5', 150, 'Overwatch', 'Overwatch Dagboek', 2, 'merch/OverwatchDagboek.png', 'Schrijf al je geheimen en dagelijkse belevenissen in dit leuke dagboekje van Overwatch! Op de cover van jouw toekomstige dagboek vind je alle helden uit Overwatch!'),
(39, '15', 169, 'Overwatch', 'Junkrat Funkopop', 2, 'merch/OverwatchJunkrat.png', 'Deze leuke Overwatch Junkrat Funko Pop figuur is ongeveer 9 cm groot en komt verpakt in een window display box.'),
(40, '40', 21, 'Overwatch', 'Overwatch Trui', 2, 'merch/OverwatchMercyTrui.png', 'Met deze stijlvolle trui kun je je vrienden laten zien wat je favoriete held is in het populaire online spel. Deze trui is niet alleen in dezelfde kleur als het personage, maar het is ook versierd met de kenmerken van Mercy. Ook bevat deze trui een kap en een zak aan de voorkant.'),
(41, '13', 120, 'Fortnite', 'Fortnite Muts', 1, 'merch/FortniteMuts.png', 'De nieuwe warme Fortnite muts beschermt je tegen koud weer en wind. Niemand heeft zo een muts als jij.\r\n'),
(42, '15', 20, 'Fortnite', 'Drift Funkopop', 1, 'merch/FortniteDrift.png', 'Deze leuke Fortnite Drift Funko Pop figuur is ongeveer 9 cm groot en komt verpakt in een window display box.'),
(43, '100', 20, 'niemand', 'niemand2', 3, 'dummy', 'The_quick_brown_fox_jumps'),
(44, '100', 20, 'niemand', 'niemand2', 3, 'dummy', 'The_quick_brown_fox_jumps'),
(45, '100', 20, 'niemand', 'niemand2', 3, 'dummy', 'The_quick_brown_fox_jumps'),
(46, '100', 20, 'niemand', 'niemand2', 3, 'dummy', 'The_quick_brown_fox_jumps'),
(47, '100', 20, 'niemand', 'niemand2', 3, 'dummy', 'The_quick_brown_fox_jumps'),
(49, '100', 20, 'niemand', 'niemand2', 3, 'dummy', 'The_quick_brown_fox_jumps'),
(50, '100', 20, 'niemand', 'niemand2', 3, 'dummy', 'The_quick_brown_fox_jumps'),
(51, '100', 20, 'niemand', 'niemand2', 3, 'dummy', 'The_quick_brown_fox_jumps'),
(55, '10', 10, 'Biepenzwiep', 'qmskldjfmk', 2, 'no-image-available.png', 'q sdqsd f'),
(56, '14', 2, 'aperitief', 'qsdqsdf', 3, 'merch/bion1.jpg', 'qsdfe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbestelbons`
--
ALTER TABLE `tblbestelbons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbestelbons_tblproduct`
--
ALTER TABLE `tblbestelbons_tblproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbestelling`
--
ALTER TABLE `tblbestelling`
  ADD PRIMARY KEY (`BonID`),
  ADD KEY `KlantID` (`Aantal`);

--
-- Indexes for table `tblbestellingproduct`
--
ALTER TABLE `tblbestellingproduct`
  ADD PRIMARY KEY (`BonID`,`ProductID`),
  ADD KEY `Product` (`ProductID`);

--
-- Indexes for table `tblbestelstatus`
--
ALTER TABLE `tblbestelstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblgameafdeling`
--
ALTER TABLE `tblgameafdeling`
  ADD PRIMARY KEY (`GameID`);

--
-- Indexes for table `tblklant`
--
ALTER TABLE `tblklant`
  ADD PRIMARY KEY (`KlantID`);

--
-- Indexes for table `tblleveringsadressen`
--
ALTER TABLE `tblleveringsadressen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmaat`
--
ALTER TABLE `tblmaat`
  ADD UNIQUE KEY `ProductID` (`ProductID`,`Maat`) USING BTREE;

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbestelbons`
--
ALTER TABLE `tblbestelbons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `tblbestelbons_tblproduct`
--
ALTER TABLE `tblbestelbons_tblproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tblbestelstatus`
--
ALTER TABLE `tblbestelstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblgameafdeling`
--
ALTER TABLE `tblgameafdeling`
  MODIFY `GameID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblklant`
--
ALTER TABLE `tblklant`
  MODIFY `KlantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblleveringsadressen`
--
ALTER TABLE `tblleveringsadressen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbestelling`
--
ALTER TABLE `tblbestelling`
  ADD CONSTRAINT `bonlink` FOREIGN KEY (`BonID`) REFERENCES `tblbestellingproduct` (`BonID`);

--
-- Constraints for table `tblbestellingproduct`
--
ALTER TABLE `tblbestellingproduct`
  ADD CONSTRAINT `Bon` FOREIGN KEY (`BonID`) REFERENCES `tblbestelling` (`BonID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
