
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-07-2017 a las 12:26:26
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `u877662646_est`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cochera`
--

CREATE TABLE IF NOT EXISTS `Cochera` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Piso` int(11) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL,
  `Reservada` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `Cochera`
--

INSERT INTO `Cochera` (`ID`, `Piso`, `Numero`, `Estado`, `Reservada`) VALUES
(1, 1, 1, 0, 1),
(2, 1, 2, 0, 1),
(3, 1, 3, 0, 1),
(4, 1, 4, 0, 0),
(5, 1, 5, 0, 0),
(6, 1, 6, 0, 0),
(7, 2, 1, 0, 0),
(8, 2, 2, 0, 0),
(9, 2, 3, 0, 0),
(10, 2, 4, 0, 0),
(11, 2, 5, 0, 0),
(12, 2, 6, 0, 0),
(13, 3, 1, 0, 0),
(14, 3, 2, 0, 0),
(15, 3, 3, 0, 0),
(16, 3, 4, 0, 0),
(17, 3, 5, 0, 0),
(18, 3, 6, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_usuarios`
--

CREATE TABLE IF NOT EXISTS `login_usuarios` (
  `ID_Usuario` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  KEY `FK_Usuario` (`ID_Usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `login_usuarios`
--

INSERT INTO `login_usuarios` (`ID_Usuario`, `Fecha`) VALUES
(1, '2017-06-04 01:47:23'),
(1, '2017-06-04 01:49:27'),
(1, '2017-06-04 01:49:32'),
(1, '2017-06-04 01:49:40'),
(1, '2017-06-04 01:50:14'),
(1, '2017-06-04 01:51:01'),
(1, '2017-06-04 01:51:38'),
(1, '2017-06-04 01:52:38'),
(1, '2017-06-04 12:36:43'),
(1, '2017-06-04 16:54:39'),
(1, '2017-06-04 17:31:27'),
(1, '2017-06-06 14:26:30'),
(11, '2017-06-06 18:01:44'),
(1, '2017-06-06 18:01:48'),
(1, '2017-06-06 18:02:16'),
(11, '2017-06-06 18:28:58'),
(1, '2017-06-06 18:34:30'),
(1, '2017-06-06 18:34:54'),
(11, '2017-06-06 18:38:53'),
(1, '2017-06-06 18:39:08'),
(1, '2017-06-06 18:39:30'),
(1, '2017-06-06 18:43:13'),
(1, '2017-06-06 19:29:56'),
(1, '2017-06-08 14:49:42'),
(18, '2017-06-08 20:20:44'),
(18, '2017-06-09 14:34:32'),
(18, '2017-06-13 13:04:02'),
(18, '2017-06-14 13:26:28'),
(18, '2017-06-14 14:37:33'),
(18, '2017-06-14 17:04:56'),
(18, '2017-06-17 14:32:27'),
(18, '2017-06-20 15:37:18'),
(1, '2017-06-20 18:09:00'),
(18, '2017-06-29 15:18:41'),
(12, '2017-06-29 15:59:08'),
(1, '2017-06-29 15:59:26'),
(18, '2017-06-29 15:59:50'),
(18, '2017-06-29 22:23:24'),
(18, '2017-06-29 22:23:25'),
(18, '2017-06-29 22:28:27'),
(1, '2017-06-29 20:04:52'),
(18, '2017-06-29 20:05:19'),
(18, '2017-06-29 20:05:19'),
(18, '2017-06-29 20:05:44'),
(18, '2017-06-30 13:28:29'),
(18, '2017-06-30 13:28:29'),
(18, '2017-06-30 13:28:43'),
(18, '2017-06-30 13:31:17'),
(18, '2017-07-02 15:33:23'),
(18, '2017-07-02 15:33:35'),
(18, '2017-07-02 15:52:27'),
(18, '2017-07-02 15:52:42'),
(18, '2017-07-02 16:31:20'),
(18, '2017-07-02 16:31:21'),
(18, '2017-07-02 18:03:42'),
(18, '2017-07-02 18:03:42'),
(18, '2017-07-02 18:33:10'),
(12, '2017-07-02 18:34:41'),
(11, '2017-07-02 18:35:15'),
(18, '2017-07-02 18:37:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Movimientos`
--

CREATE TABLE IF NOT EXISTS `Movimientos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Cochera` int(11) NOT NULL,
  `ID_Empleado` int(11) NOT NULL,
  `Patente` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Color` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Marca` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Fecha_Salida` datetime DEFAULT NULL,
  `Importe` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_CocheraMovimientos` (`ID_Cochera`),
  KEY `FK_UsuarioMovimientos` (`ID_Empleado`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `Movimientos`
--

INSERT INTO `Movimientos` (`ID`, `ID_Cochera`, `ID_Empleado`, `Patente`, `Color`, `Marca`, `Fecha_Ingreso`, `Fecha_Salida`, `Importe`) VALUES
(3, 6, 1, 'AAA 222', 'Toyota', 'Rojo', '2017-06-08 19:14:44', '2017-06-08 19:24:49', '10.00'),
(4, 6, 1, 'ABC 123', 'Toyota', 'Rojo', '2017-06-08 19:25:45', '2017-06-08 19:26:01', '10.00'),
(5, 6, 1, 'BBB 666', 'Mazda', 'Rojo', '2017-06-08 19:36:47', '2017-06-08 19:36:58', '10.00'),
(6, 6, 1, 'BBB 666', 'Mazda', 'Rojo', '2017-06-08 19:59:53', '2017-06-08 20:00:01', '10.00'),
(7, 6, 1, 'BBB666', 'Mazda', 'Rojo', '2017-06-20 15:43:36', '2017-06-20 17:22:10', '20.00'),
(8, 4, 18, 'ASD123', 'Ford', 'Rojo', '2017-06-20 15:51:17', '2017-06-20 17:19:13', '20.00'),
(9, 5, 18, 'CCC333', 'Mazda', 'Verde', '2017-06-20 15:55:26', '2017-06-20 17:21:06', '20.00'),
(10, 7, 18, 'DDD444', 'Fiat', 'Azul', '2017-06-20 15:57:24', '2017-06-20 17:24:50', '20.00'),
(11, 8, 18, 'FFF555', 'Ford', 'Violeta', '2017-06-20 15:57:58', '2017-06-20 17:25:14', '20.00'),
(12, 10, 18, 'BPH234', 'Mazda', 'Rojo', '2017-06-20 15:58:23', '2017-06-20 17:28:15', '20.00'),
(13, 4, 18, 'BPJ345', 'Ford', 'Verde', '2017-06-20 17:35:41', '2017-06-20 17:35:46', '10.00'),
(14, 14, 18, 'BPL345', 'Honda', 'Azul', '2017-06-20 17:37:44', '2017-06-20 17:37:52', '10.00'),
(15, 7, 18, 'HJU345', 'Ford', 'Verde', '2017-06-20 17:39:38', '2017-06-20 17:45:01', '10.00'),
(16, 4, 18, 'HGY456', 'Fiat', 'Azul', '2017-06-20 17:44:12', '2017-06-20 18:00:39', '10.00'),
(17, 5, 18, 'AAA456', 'Chevrolet', 'Azul', '2017-06-20 17:44:23', '2017-06-20 18:03:10', '10.00'),
(18, 4, 18, 'AAA123', 'ASD', 'Verde', '2017-06-20 18:03:24', '2017-06-20 18:04:05', '10.00'),
(19, 3, 18, 'BBB222', 'Ford', 'Rojo', '2017-06-20 18:03:31', '2017-06-20 18:08:01', '10.00'),
(20, 6, 18, 'CCC333', 'Fiat', 'Blanco', '2017-06-20 18:03:45', '2017-06-29 15:19:17', '1530.00'),
(21, 7, 18, 'FFF999', 'Chevrolet', 'Negro', '2017-06-20 18:03:58', '2017-06-29 15:27:33', '1530.00'),
(22, 4, 18, 'ABC345', 'Mazda', 'Azul', '2017-06-29 15:22:20', '2017-06-29 15:22:40', '10.00'),
(23, 5, 1, 'GTE465', 'Fiat', 'Amarillo', '2017-06-29 15:59:42', '2017-07-02 18:04:10', '680.00'),
(24, 3, 18, 'ABC123', 'Ford', 'Rojo', '2017-06-29 22:34:14', '2017-06-29 22:34:29', '10.00'),
(25, 4, 18, 'ABC123', 'Ford', 'Verde', '2017-07-02 18:09:54', '2017-07-02 18:10:03', '10.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE IF NOT EXISTS `Usuarios` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Password` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `DNI` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Rol` tinyint(4) NOT NULL,
  `Baja` tinyint(1) NOT NULL,
  `Fecha` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`ID`, `Usuario`, `Password`, `Nombre`, `Apellido`, `DNI`, `Rol`, `Baja`, `Fecha`) VALUES
(1, 'rodriguez', '12345', 'Alberto', 'Rodriguez', '45888777', 1, 0, '2017-06-03 00:00:00'),
(11, 'jlopez', 'asd', 'Jorge', 'Lopez', '15999888', 1, 0, '2017-06-06 17:29:34'),
(12, 'Hanzo', 'asd', 'Hans', 'Fubert', '45666778', 2, 0, '2017-06-06 20:03:38'),
(18, 'admin', '12345', 'Juan', 'Fernandez', '6666666', 2, 0, '2017-06-06 20:09:20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
