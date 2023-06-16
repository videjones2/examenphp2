-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2023 a las 10:24:58
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

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `solicitante`, `empresa`, `comprobante_ingresos`, `salario_n`, `tipo_empleo`, `fecha_inicio`) VALUES
('Mf5N2aPyV4KQoYLnF097', 'LEDJ951027HDFLZS02', 'Bazinga SA de CV', 'Mensual', 25000, 'Telecomunicaciones', '2023-06-16'),
('PVmJ7tvj94XYhFKd2wRI', 'LEDJ951027HDFLZS02', 'Full counter', 'Mensual', 15000, 'Contabilidad', '2019-04-20');

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

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `solicitante`, `fecha_registro`, `destino`, `monto`, `plazo`) VALUES
('ITyvB5Hb9KW', 'LEDJ951027HDFLZS02', '2023-04-02', 'Tarjeta', 20000, 3);

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
-- Volcado de datos para la tabla `solicitantes`
--

INSERT INTO `solicitantes` (`curp`, `nombre`, `apellidos`, `fecha_nacimiento`, `sexo`, `correo`, `estado`, `codigo_postal`, `domicilio`, `fecha_registrado`) VALUES
('LEDJ951027HDFLZS02', 'Joshua Miguel', 'Leal Diaz', '1995-10-27', 'H', 'videjones2@gmail.com', 'Mexico', 56585, 'Calle Francisco Javier Mina Mz 2 LT 2, Los heroes', '2023-06-16 03:19:44');

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
