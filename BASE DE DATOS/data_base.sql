-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2022 a las 01:57:09
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `data_base`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasciente`
--

CREATE TABLE `pasciente` (
  `id` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `fecha_nacimiemto` date NOT NULL,
  `edad` int(11) NOT NULL,
  `temperatura` double NOT NULL,
  `precion_arterial` varchar(7) NOT NULL,
  `pulso` int(11) NOT NULL,
  `frecuencia_respiratoria` int(11) NOT NULL,
  `saturacion` int(11) NOT NULL,
  `peso` double NOT NULL,
  `talla` double NOT NULL,
  `imc` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pasciente`
--

INSERT INTO `pasciente` (`id`, `cedula`, `nombres`, `fecha_nacimiemto`, `edad`, `temperatura`, `precion_arterial`, `pulso`, `frecuencia_respiratoria`, `saturacion`, `peso`, `talla`, `imc`) VALUES
(1, '0401657451', 'SDFG', '2000-02-26', 22, 12, '12', 3, 12, 2, 12.5, 2, 5000),
(2, '0401695994', 'BAYARDO', '1991-02-26', 31, 12, '12', 12, 12, 2, 36.6, 12, 12.5),
(3, '2450145101', 'QWQW', '0012-12-12', 2009, 12, '12', 12, 12, 12, 12, 12, 833.333),
(4, '343434', 'QWQWQWQ', '1991-02-26', 31, 26.3, '12', 14, 20, 18, 20.3, 19.5, 512.821),
(5, '1521014815', 'BAYARDO JESUS CHANDI', '2008-02-26', 14, 25.3, '50', 10, 20, 20, 150.3, 1.75, 5714.286);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `usuario`, `password`, `estado`) VALUES
(1, 'admin', 'admin', 'admin', '$2a$07$asxx54ahjppf45sd87a5auRajNP0zeqOkB9Qda.dSiTb2/n.wAC/2', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pasciente`
--
ALTER TABLE `pasciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pasciente`
--
ALTER TABLE `pasciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
