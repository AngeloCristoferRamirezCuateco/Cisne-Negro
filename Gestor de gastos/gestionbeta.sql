-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2024 a las 21:56:39
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestionbeta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto`
--

CREATE TABLE `gasto` (
  `idGasto` varchar(20) NOT NULL,
  `idUsuario` varchar(20) DEFAULT NULL,
  `tipoGasto` varchar(20) DEFAULT NULL,
  `fechaGasto` date DEFAULT NULL,
  `precioGasto` float(10,2) DEFAULT NULL,
  `nombreGasto` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gasto`
--

INSERT INTO `gasto` (`idGasto`, `idUsuario`, `tipoGasto`, `fechaGasto`, `precioGasto`, `nombreGasto`) VALUES
('QY3inEGZSqBHfIba9182', '31wqWoLTUxYAcauzBmHe', 'Vivienda', '2024-09-17', 600.00, 'Renta de casa'),
('uKPwsaX3MLiCbt94hEoQ', '31wqWoLTUxYAcauzBmHe', 'Ocio', '2024-09-17', 10000.00, 'Pley esteishon 5 pro'),
('VAN8wyfUDIZrv3qxKP5u', '31wqWoLTUxYAcauzBmHe', 'CuidadoP', '2024-09-23', 600.00, 'Crema de leche de wo'),
('YNBFHW6l5G1U2jgbt3T8', '31wqWoLTUxYAcauzBmHe', 'Deudas', '2024-09-18', 15000.00, 'Renta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` varchar(20) NOT NULL,
  `nombreUsuario` varchar(20) DEFAULT NULL,
  `apellidoPaterno` varchar(20) DEFAULT NULL,
  `apellidoMaterno` varchar(20) DEFAULT NULL,
  `correoUsuario` varchar(50) DEFAULT NULL,
  `passwordUsuario` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreUsuario`, `apellidoPaterno`, `apellidoMaterno`, `correoUsuario`, `passwordUsuario`) VALUES
('31wqWoLTUxYAcauzBmHe', 'Angelo Cristofer', 'Ramirez', 'Cuateco', 'utp0156992@alumno.utpuebla.edu.mx', 'root6615'),
('4QtZdPvhWpEfnV1LXSwa', 'asasa', 'asas', 'asas', 'asasa@asasas.com', '$2y$10$armYCIsOd'),
('vh7S4yTKeE2DsM0VuHYP', 'Carlos Vela', 'Gonsalez', 'Cruz', 'david@gmail.com', '$2y$10$Sf/1yXN5P');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD PRIMARY KEY (`idGasto`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD CONSTRAINT `gasto_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
