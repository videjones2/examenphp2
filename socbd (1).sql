-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2023 a las 10:28:34
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `socbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` varchar(20) NOT NULL,
  `solicitante` varchar(18) DEFAULT NULL,
  `empresa` varchar(30) DEFAULT NULL,
  `comprobante_ingresos` text DEFAULT NULL,
  `salario_n` int(11) DEFAULT NULL,
  `tipo_empleo` text DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` varchar(11) NOT NULL,
  `solicitante` varchar(18) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `destino` varchar(18) DEFAULT NULL,
  `monto` int(5) DEFAULT NULL,
  `plazo` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes`
--

CREATE TABLE `solicitantes` (
  `curp` varchar(18) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellidos` varchar(20) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `estado` varchar(40) DEFAULT NULL,
  `codigo_postal` int(5) DEFAULT NULL,
  `domicilio` text DEFAULT NULL,
  `fecha_registrado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitante` (`solicitante`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitante` (`solicitante`);

--
-- Indices de la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  ADD PRIMARY KEY (`curp`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_ibfk_1` FOREIGN KEY (`solicitante`) REFERENCES `solicitantes` (`curp`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`solicitante`) REFERENCES `solicitantes` (`curp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
