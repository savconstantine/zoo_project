-- -------------------------------------------------------------
-- TablePlus 3.12.5(365)
--
-- https://tableplus.com/
--
-- Database: zoo
-- Generation Time: 2021-03-24 20:33:46.0620
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `action`;
CREATE TABLE `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `action_animal_type`;
CREATE TABLE `action_animal_type` (
  `action_id` int(11) NOT NULL,
  `animal_type_id` int(11) NOT NULL,
  PRIMARY KEY (`action_id`,`animal_type_id`),
  KEY `IDX_B0219FD99D32F035` (`action_id`),
  KEY `IDX_B0219FD94A93E3A9` (`animal_type_id`),
  CONSTRAINT `FK_B0219FD94A93E3A9` FOREIGN KEY (`animal_type_id`) REFERENCES `animal_type` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B0219FD99D32F035` FOREIGN KEY (`action_id`) REFERENCES `action` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `animal`;
CREATE TABLE `animal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cage_id` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6AAB231F5A70E5B7` (`cage_id`),
  KEY `IDX_6AAB231FC54C8C93` (`type_id`),
  CONSTRAINT `FK_6AAB231F5A70E5B7` FOREIGN KEY (`cage_id`) REFERENCES `cage` (`id`),
  CONSTRAINT `FK_6AAB231FC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `animal_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `animal_type`;
CREATE TABLE `animal_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cage`;
CREATE TABLE `cage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `action` (`id`, `name`) VALUES
(1, 'питаться'),
(4, 'плавать'),
(5, 'рычать'),
(6, 'поливать себя хоботом'),
(8, 'летать');

INSERT INTO `action_animal_type` (`action_id`, `animal_type_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(4, 5),
(5, 1),
(8, 4);

INSERT INTO `animal` (`id`, `cage_id`, `type_id`, `name`) VALUES
(1, 1, 4, 'John Dorian'),
(2, 2, 1, 'Alex'),
(3, 4, 5, 'Dundee'),
(4, 4, 5, 'Гена'),
(5, NULL, 3, 'Dambo'),
(6, 2, 1, 'mufasa');

INSERT INTO `animal_type` (`id`, `name`) VALUES
(1, 'lion'),
(2, 'bear'),
(3, 'elephant'),
(4, 'eagle'),
(5, 'crocodile');

INSERT INTO `cage` (`id`, `name`) VALUES
(1, 'cage number 1'),
(2, 'cage number 2 edited'),
(3, 'cage number 3'),
(4, 'cage number 4');

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210324083104', '2021-03-24 08:31:08', 137);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;