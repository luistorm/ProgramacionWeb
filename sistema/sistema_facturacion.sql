-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2017 a las 15:54:05
-- Versión del servidor: 5.7.9
-- Versión de PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `cod_cli` int(11) NOT NULL AUTO_INCREMENT,
  `ide_cli` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `nom_cli` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `dir_cli` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `tel_cli` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `est_cli` char(1) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`cod_cli`),
  UNIQUE KEY `ide_cli` (`ide_cli`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cod_cli`, `ide_cli`, `nom_cli`, `dir_cli`, `tel_cli`, `est_cli`) VALUES
(1, '26807614', 'Luis Torres', 'Nueva Direccion', '04147325347', 'A'),
(3, '10151138', 'Carol Manjarres', 'Santa Teresa', '04141234568', 'A'),
(4, '12345678', 'Pedro Perez', 'Algun Lugar', '04121234567', 'I'),
(5, '5145478', 'Empresa Para Prueba', 'Algun Lugar en el mundo', '415641', 'A'),
(6, '987654321', 'Pedro Perez', 'dkns', '8643234', 'A'),
(7, '45463215', 'Maria Perez', 'wdbd', '4514', 'I'),
(8, '123', 'dfgfd', 'fdgdfg', '5646', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

DROP TABLE IF EXISTS `detalle_factura`;
CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `num_fac` int(11) NOT NULL,
  `cod_pro` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `can_pro` float NOT NULL,
  `pre_pro` float NOT NULL,
  `imp_pro` float NOT NULL,
  `tot_det` float NOT NULL,
  PRIMARY KEY (`num_fac`,`cod_pro`),
  KEY `cod_pro` (`cod_pro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`num_fac`, `cod_pro`, `can_pro`, `pre_pro`, `imp_pro`, `tot_det`) VALUES
(14, 'P001', 100, 15.32, 0.12, 1532),
(15, 'P001', 10, 15.32, 0.12, 153.2),
(15, 'P002', 10, 89123, 0.12, 891230),
(15, 'P003', 50, 8127, 0.12, 406350),
(15, 'P004', 30, 15.38, 0.12, 461.4),
(16, 'P001', 10, 15.32, 0.12, 153.2),
(16, 'P002', 20, 89123, 0.12, 1782460),
(16, 'P003', 50, 8127, 0.12, 406350),
(17, 'P001', 50, 15.32, 0.12, 766),
(17, 'P003', 400, 8127, 0.12, 3250800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `num_fac` int(11) NOT NULL AUTO_INCREMENT,
  `fec_fac` date NOT NULL,
  `cli_fac` int(11) NOT NULL,
  `for_fac` varchar(4) COLLATE utf8_spanish2_ci NOT NULL,
  `imp_fac` float NOT NULL,
  `tot_fac` float NOT NULL,
  `est_fac` char(1) COLLATE utf8_spanish2_ci NOT NULL,
  `bas_fac` float NOT NULL,
  PRIMARY KEY (`num_fac`),
  KEY `cli_fac` (`cli_fac`),
  KEY `for_fac` (`for_fac`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`num_fac`, `fec_fac`, `cli_fac`, `for_fac`, `imp_fac`, `tot_fac`, `est_fac`, `bas_fac`) VALUES
(3, '2017-02-01', 1, 'F001', 0.12, 171.584, 'A', 153.2),
(4, '2017-02-01', 1, 'F001', 0.12, 171.584, 'A', 153.2),
(5, '2017-02-01', 1, 'F001', 0.12, 0, 'A', 0),
(6, '2017-02-01', 1, 'F001', 0.12, 0, 'A', 0),
(7, '2017-02-01', 1, 'F001', 0.12, 171.584, 'A', 153.2),
(8, '2017-02-01', 1, 'F001', 0.12, 171.584, 'A', 153.2),
(9, '2017-02-01', 1, 'F001', 0.12, 171.584, 'A', 153.2),
(10, '2017-02-01', 1, 'F001', 0.12, 171.584, 'A', 153.2),
(11, '2017-02-01', 1, 'F001', 0.12, 171.584, 'A', 153.2),
(12, '2017-02-01', 1, 'F001', 0.12, 1996360, 'A', 1782460),
(13, '2017-02-02', 1, 'F001', 0.12, 12161900, 'A', 10858800),
(14, '2017-02-02', 1, 'F001', 0.12, 12161900, 'A', 10858800),
(15, '2017-02-02', 1, 'F001', 0.12, 171.584, 'A', 153.2),
(16, '2017-02-02', 3, 'F001', 0.12, 2451640, 'A', 2188960),
(17, '2017-02-02', 3, 'F002', 0.12, 3641750, 'A', 3251570);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

DROP TABLE IF EXISTS `forma_pago`;
CREATE TABLE IF NOT EXISTS `forma_pago` (
  `cod_for` varchar(4) COLLATE utf8_spanish2_ci NOT NULL,
  `nom_for` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `est_for` char(1) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`cod_for`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`cod_for`, `nom_for`, `est_for`) VALUES
('F001', 'Debito', 'A'),
('F002', 'Credito', 'I'),
('F003', 'Efectivo', 'A'),
('F004', 'Cheque', 'A'),
('F005', 'Transferencia', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `cod_pro` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `nom_pro` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `pre_pro` float NOT NULL,
  `exi_pro` float NOT NULL,
  `est_pro` char(1) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`cod_pro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`cod_pro`, `nom_pro`, `pre_pro`, `exi_pro`, `est_pro`) VALUES
('P001', 'Salsa de Tomate', 15.32, 5000, 'A'),
('P002', 'Mayonesa', 89123, 60, 'A'),
('P003', 'Jamon', 8127, 987, 'A'),
('P004', 'Queso', 15.38, 40, 'A');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`num_fac`) REFERENCES `factura` (`num_fac`),
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`cod_pro`) REFERENCES `producto` (`cod_pro`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`cli_fac`) REFERENCES `cliente` (`cod_cli`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`for_fac`) REFERENCES `forma_pago` (`cod_for`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
