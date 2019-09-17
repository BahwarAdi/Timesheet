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

-- Exportiere Daten aus Tabelle Timesheet.zeit: ~-1 rows (ungefähr)
DELETE FROM `zeit`;
/*!40000 ALTER TABLE `zeit` DISABLE KEYS */;
INSERT INTO `zeit` (`zeitId`, `userId`, `projektId`, `kw`, `datum`, `start`, `stop`, `pause`, `beschreibung`) VALUES
	(10, 6, 1, 1, '2019-08-29', '07:00:00', '18:00:00', '00:15:00', 'anfrue entgegennehmen'),
	(14, 6, 3, 1, '2019-09-04', '15:00:00', '22:00:00', NULL, 'Nop hab nix getan'),
	(15, 6, 2, 1, '2019-09-02', '15:00:00', '16:00:00', NULL, 'Ich hab geschlafen'),
	(18, 4, 1, 1, '2019-09-10', '10:00:00', '22:00:00', NULL, 'shdh'),
	(19, 4, 3, 1, '2019-09-09', '08:00:00', '15:00:00', NULL, 'nddn'),
	(20, 4, 2, 0, '2019-11-10', '14:16:32', '18:16:34', NULL, 'thh');
/*!40000 ALTER TABLE `zeit` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
