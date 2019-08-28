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

-- Exportiere Struktur von Tabelle Timesheet.zeit
DROP TABLE IF EXISTS `zeit`;
CREATE TABLE IF NOT EXISTS `zeit` (
  `zeitId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `projektId` int(11) NOT NULL,
  `kw` int(11) NOT NULL,
  `datum` date NOT NULL,
  `start` time NOT NULL,
  `stop` time NOT NULL,
  `pause` time DEFAULT NULL,
  `beschreibung` tinytext NOT NULL,
  PRIMARY KEY (`zeitId`),
  KEY `FK_zeit_user` (`userId`),
  KEY `FK_zeit_projekt` (`projektId`),
  CONSTRAINT `FK_zeit_projekt` FOREIGN KEY (`projektId`) REFERENCES `projekt` (`projektId`),
  CONSTRAINT `FK_zeit_user` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle Timesheet.zeit: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `zeit` DISABLE KEYS */;
/*!40000 ALTER TABLE `zeit` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
