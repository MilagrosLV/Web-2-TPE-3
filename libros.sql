-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2023 a las 22:45:27
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libros`
--
CREATE DATABASE IF NOT EXISTS `libros` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `libros`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sugerencias`
--

CREATE TABLE `sugerencias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `genero` int(12) NOT NULL,
  `descripción` text NOT NULL,
  `prioridad` int(12) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sugerencias`
--

INSERT INTO `sugerencias` (`id`, `titulo`, `genero`, `descripción`, `prioridad`) VALUES
(12, 'fvgbhnjmk,.', 1, 'xdfghjklñ{', 1),
(13, 'vbnm,', 2, 'vbnm,.<-', 1),
(14, 'cvbnm,.', 3, 'cvbnm,.-', 1),
(15, 'cvbnm,.', 1, 'cvbnm,.-', 2),
(16, 'vbnm,.-', 1, 'vbnm,.-', 3),
(17, ' fghjklñ<', 2, 'oiuyt', 2, 1),
(18, '345678', 2, '98765', 3),
(19, '3456789', 3, 'sdfghjklñ', 3),
(20, 'jnhbgvcx', 3, '09876', 2),
(21, 'aaaaaaaaaaaaaaaaaaaaaaaaaa', 2, 'bbbbbbbbbbbbb', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
