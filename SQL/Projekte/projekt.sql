-- --------------------------------------------------------
-- Host:                         localhost
-- Server Version:               5.5.62-0+deb8u1 - (Debian)
-- Server Betriebssystem:        debian-linux-gnu
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Exportiere Datenbank Struktur für Timesheet
CREATE DATABASE IF NOT EXISTS `Timesheet` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `Timesheet`;

-- Exportiere Struktur von Tabelle Timesheet.projekt
CREATE TABLE IF NOT EXISTS `projekt` (
  `projektId` int(11) NOT NULL AUTO_INCREMENT,
  `projektname` varchar(50) NOT NULL,
  `beschreibung` tinytext NOT NULL,
  `archiviert` tinytext NOT NULL,
  PRIMARY KEY (`projektId`),
  UNIQUE KEY `Schlüssel 2` (`projektname`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle Timesheet.projekt: ~3 rows (ungefähr)
/*!40000 ALTER TABLE `projekt` DISABLE KEYS */;
INSERT INTO `projekt` (`projektId`, `projektname`, `beschreibung`, `archiviert`) VALUES
	(1, 'TestProjekt', 'ein TestProjekt', 'false'),
	(2, 'Telefon', 'telefon in session', 'false'),
	(3, 'Salat', 'Salat Jonglieren', 'true');
/*!40000 ALTER TABLE `projekt` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
