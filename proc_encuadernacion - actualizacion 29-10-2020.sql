-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2020 a las 23:26:06
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `henpapel_sitio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proc_encuadernacion`
--

CREATE TABLE `proc_encuadernacion` (
  `id_encuadernacion` int(10) UNSIGNED NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tiraje_minimo` int(10) UNSIGNED DEFAULT NULL,
  `tiraje_maximo` int(10) UNSIGNED DEFAULT NULL,
  `precio_unitario` decimal(10,2) UNSIGNED NOT NULL,
  `tipo_costo` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_tiraje` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proc_encuadernacion`
--

INSERT INTO `proc_encuadernacion` (`id_encuadernacion`, `status`, `nombre`, `tiraje_minimo`, `tiraje_maximo`, `precio_unitario`, `tipo_costo`, `nombre_tiraje`) VALUES
(1, 'A', 'Perforado para iman y puesta de iman', 1, 2000, '3.00', 'par', 'Perforado para iman y puesta de iman'),
(2, 'A', 'Perforado para iman y puesta de iman', 2001, 200000, '2.00', 'par', 'Perforado para iman y puesta de iman'),
(3, 'A', 'Despunte de esquinas para cajon', NULL, NULL, '2.00', 'cajon', NULL),
(4, 'A', 'Forrado de cajon', 1, 2000, '8.00', 'cajon', 'Forrado de cajon'),
(5, 'A', 'Arreglo de Forrado de cajon', NULL, NULL, '200.00', NULL, NULL),
(6, 'A', 'Encajada', NULL, NULL, '2.00', 'unidad', NULL),
(7, 'A', 'Empalme de cajon', 1, 2000, '3.00', 'unidad', 'Empalme de cajon'),
(8, 'A', 'Puesta de banco', 1, 2000, '2.00', 'unidad', 'Puesta de banco'),
(9, 'A', 'Domi', NULL, NULL, '2000.00', 'unidad', NULL),
(10, 'A', 'Forrado de cajon', 2001, 20000, '7.00', NULL, 'Forrado de cajon'),
(11, 'A', 'Empalme de cajon', 2001, 20000, '2.00', NULL, 'Empalme de cajon'),
(12, 'A', 'Puesta de banco', 2001, 20000, '1.00', NULL, 'Puesta de banco');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proc_encuadernacion`
--
ALTER TABLE `proc_encuadernacion`
  ADD PRIMARY KEY (`id_encuadernacion`),
  ADD KEY `idx_nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proc_encuadernacion`
--
ALTER TABLE `proc_encuadernacion`
  MODIFY `id_encuadernacion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
