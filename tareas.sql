-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2019 a las 11:41:49
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tareas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `detalle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla perfil del sistema';

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `detalle`) VALUES
(1, 'Sistemas'),
(2, 'Administrador'),
(3, 'Operador'),
(4, 'Auditor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `id` int(11) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` char(2) NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla de tareas' ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`id`, `fechaRegistro`, `titulo`, `descripcion`, `estado`, `fechaVencimiento`, `usuario`) VALUES
(1, '2019-03-25', 'Prueba app', 'està prueba se desarrolla con php y jquery', 'NO', '2019-03-31', 100),
(3, '2019-03-26', 'prueba 2', 'actualiza la tarea', 'SI', '2019-03-12', 101);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` int(11) NOT NULL,
  `perfil` varchar(30) NOT NULL,
  `numeroIdentificacion` int(11) NOT NULL,
  `primerNombre` varchar(35) NOT NULL,
  `segundoNombre` varchar(35) NOT NULL,
  `primerApellido` varchar(35) NOT NULL,
  `segundoApellido` varchar(35) NOT NULL,
  `clave` varchar(30) NOT NULL,
  `confirmaClave` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `fechaEstado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla de usuario' ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `perfil`, `numeroIdentificacion`, `primerNombre`, `segundoNombre`, `primerApellido`, `segundoApellido`, `clave`, `confirmaClave`, `estado`, `fechaEstado`) VALUES
(100, 'SISTEMAS', 1096194935, 'Elkin', ' ', 'Duran', 'Moreno', '123', '123', 'ACTIVO', '2019-03-22'),
(101, 'OPERADOR', 3423, 'libi', 'sarai', 'Duran', 'Garces', 'libi', 'libi', 'INACTIVO', '2019-03-25'),
(102, 'ADMON', 23456789, 'grace', 'nathaly', 'garces', 'vacino', 'grace', 'grace', 'Activo', '2019-03-25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
