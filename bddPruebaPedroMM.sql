-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.24-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bdd_prueba_pedromm
DROP DATABASE IF EXISTS `bdd_prueba_pedromm`;
CREATE DATABASE IF NOT EXISTS `bdd_prueba_pedromm` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `bdd_prueba_pedromm`;

-- Volcando estructura para tabla bdd_prueba_pedromm.categoria
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `denominacion` (`denominacion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla bdd_prueba_pedromm.categoria: ~3 rows (aproximadamente)
INSERT INTO `categoria` (`id`, `denominacion`) VALUES
	(3, 'CSS'),
	(2, 'JavaScript'),
	(1, 'PHP');

-- Volcando estructura para tabla bdd_prueba_pedromm.tarea
DROP TABLE IF EXISTS `tarea`;
CREATE TABLE IF NOT EXISTS `tarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `denominacion` (`denominacion`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla bdd_prueba_pedromm.tarea: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bdd_prueba_pedromm.tarea_categoria
DROP TABLE IF EXISTS `tarea_categoria`;
CREATE TABLE IF NOT EXISTS `tarea_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTarea` int(11) NOT NULL DEFAULT 0,
  `idCategoria` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_tarea_categoria_categoria` (`idCategoria`),
  KEY `FK_tarea_categoria_tarea` (`idTarea`),
  CONSTRAINT `FK_tarea_categoria_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`id`),
  CONSTRAINT `FK_tarea_categoria_tarea` FOREIGN KEY (`idTarea`) REFERENCES `tarea` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla bdd_prueba_pedromm.tarea_categoria: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
