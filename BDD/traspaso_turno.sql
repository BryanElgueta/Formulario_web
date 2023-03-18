-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2023 a las 23:05:13
-- Versión del servidor: 8.0.32
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `traspaso_turno`
--
CREATE DATABASE IF NOT EXISTS `traspaso_turno` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `traspaso_turno`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario_traspaso`
--

DROP TABLE IF EXISTS `formulario_traspaso`;
CREATE TABLE `formulario_traspaso` (
  `id_formulario` int NOT NULL COMMENT 'ID de formulario guardado.',
  `id_usuario` int NOT NULL COMMENT 'ID del usuario',
  `nombre` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre de usuario',
  `apellido` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Apellido de usuario',
  `fecha` date NOT NULL COMMENT 'Fecha del cambio de turno',
  `colaborador_turno` varchar(70) NOT NULL COMMENT 'Colaborador de turno',
  `tipo_turno` varchar(70) NOT NULL COMMENT 'Tipo de turno',
  `comentario_turnoactual` text NOT NULL COMMENT 'Comentarios del turno actual',
  `comentario_turnoanterior` text NOT NULL COMMENT 'Comentarios del turno anterior',
  `incidentegrave` text NOT NULL COMMENT 'Comentario incidente grave'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='formulario de correo, la información se respalda aquí';

--
-- Volcado de datos para la tabla `formulario_traspaso`
--

INSERT INTO `formulario_traspaso` (`id_formulario`, `id_usuario`, `nombre`, `apellido`, `fecha`, `colaborador_turno`, `tipo_turno`, `comentario_turnoactual`, `comentario_turnoanterior`, `incidentegrave`) VALUES
(7, 5, 'Equipo ', 'informatica', '2023-03-15', 'Miguel Marambio', 'Turno Intermedio', 'Se detecta en turno intermedio problemas con pc mesanninne\r\nSe reconfigura estación de reproceso en cartón freezer y paletizado fresco\r\nse levantan ticket mencionados en grupo de trabajo: 876400, 876311\r\nse validan nuevos permisos para Servidor ADP', 'Roberto deja operando raf 32.49 y 32.43 para reproceso', 'SIN COMENTARIOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `usuario_id` int NOT NULL COMMENT 'ID de usuarios',
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Email de usuario',
  `nombre` varchar(15) NOT NULL COMMENT 'Nombre de usuario',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Contraseña de usuario',
  `apellido` varchar(15) NOT NULL COMMENT 'Apellido de usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`usuario_id`, `email`, `nombre`, `password`, `apellido`) VALUES
(4, 'bryansecu3@outlook.com', 'Brayan', '$2y$10$H/l7I7pCtMsIGD95.s7WCuGREblS1gK00Bfs2aKAlh74NhODrNdX2', 'Elgueta'),
(5, 'informaticapsv@agrosuper.com', 'Equipo ', '$2y$10$LAuE4PhbpyjLPLOTlj2r.ODM6r2Soqp6iaes.ko0vQ/.W3ag4WuAe', 'informatica');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `formulario_traspaso`
--
ALTER TABLE `formulario_traspaso`
  ADD PRIMARY KEY (`id_formulario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `formulario_traspaso`
--
ALTER TABLE `formulario_traspaso`
  MODIFY `id_formulario` int NOT NULL AUTO_INCREMENT COMMENT 'ID de formulario guardado.', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `usuario_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID de usuarios', AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `formulario_traspaso`
--
ALTER TABLE `formulario_traspaso`
  ADD CONSTRAINT `formulario_traspaso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`usuario_id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
