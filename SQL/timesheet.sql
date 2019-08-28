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
DROP DATABASE IF EXISTS `Timesheet`;
CREATE DATABASE IF NOT EXISTS `Timesheet` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `Timesheet`;

-- Exportiere Struktur von Tabelle Timesheet.projekt
CREATE TABLE IF NOT EXISTS `projekt` (
  `projektId` int(11) NOT NULL AUTO_INCREMENT,
  `projektname` varchar(50) DEFAULT NULL,
  `beschreibung` tinytext,
  PRIMARY KEY (`projektId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle Timesheet.projekt: ~1 rows (ungefähr)
/*!40000 ALTER TABLE `projekt` DISABLE KEYS */;
INSERT INTO `projekt` (`projektId`, `projektname`, `beschreibung`) VALUES
	(1, 'TestProjekt', 'ein TestProjekt');
/*!40000 ALTER TABLE `projekt` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle Timesheet.user
CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `nachname` varchar(50) NOT NULL,
  `vorname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwort` varchar(50) NOT NULL,
  `typ` varchar(50) NOT NULL,
  `soll` time DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle Timesheet.user: ~2 rows (ungefähr)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`userId`, `nachname`, `vorname`, `email`, `passwort`, `typ`, `soll`) VALUES
	(1, 'admin', 'admin', 'testadmin@admin.com', '12345', 'admin', NULL),
	(2, 'Test', 'User', 'TestUser@test.com', '12345', 'user', '08:20:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle Timesheet.zeit
CREATE TABLE IF NOT EXISTS `zeit` (
  `zeitId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `projektId` int(11) NOT NULL,
  `kw` int(11) NOT NULL,
  `datum` date NOT NULL,
  `start` time NOT NULL,
  `stop` time NOT NULL,
  `pause` time DEFAULT NULL,
  PRIMARY KEY (`zeitId`),
  KEY `FK_zeit_user` (`userId`),
  KEY `FK_zeit_projekt` (`projektId`),
  CONSTRAINT `FK_zeit_user` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  CONSTRAINT `FK_zeit_projekt` FOREIGN KEY (`projektId`) REFERENCES `projekt` (`projektId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle Timesheet.zeit: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `zeit` DISABLE KEYS */;
/*!40000 ALTER TABLE `zeit` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;