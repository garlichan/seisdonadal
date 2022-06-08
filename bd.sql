/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Carmen
 * Created: 27-ene-2022
 */

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2020 a las 20:30:09
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seis do nadal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`) VALUES
(1, 'admin'),
(2, 'profesor'),
(3, 'padre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(90) NULL,
  `direccion` varchar(90) NULL,
  `correo` varchar(90) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `direccion`, `correo`, `password`, `rol`) VALUES
(1, 'Dani', 'Simons Álvarez', 'Florida 125', 'danisimons7@gmail.com', '$2y$10$5bBT3hLOX7MDt52Ld7tPNObh/RJILkuQ4G1l67XkiSZ4JRQy4BWFC', 1),
(2, 'Angeles', 'Rey Sánchez', 'Avenida Castelao 85', 'resache@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(3, 'Adrián', 'Álvarez Pereira', 'Florida 94', 'adrianpereira01@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC',2),
(4, 'Amal', 'Fernández Zidouh', 'Castrelos 129', 'amalfernadez7@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(5, 'Aroa', 'Pazos Nogueira', 'Zaragoza 26', 'arowita@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(6, 'Andrés', 'López Gómez', 'Avda. A Madroa 12', 'wolfy@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(7, 'Alejandra', 'Hung García', 'Camí dels Fondos', 'alephu@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(8, 'Violeta', 'Rodríguez Villar', 'Eijo Garay 68', 'virovi8@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(9, 'Javier', 'García Rey', 'Avda. Castelao 85', 'dorequit@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(10, 'Enrique', 'García Román', 'Avda. Castelao 85', 'enrique66@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(11, 'Carla', 'García García', 'Avda. Castelao 68', 'carlagarcia@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(12, 'Sarai', 'García Otero', 'Travesia do tobal 16', 'saraiigarcia@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(13, 'Gabriel', 'García Camacho', 'Balaídos 2', 'garciacamacho04@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(14, 'Bruno', 'Rey Rojas', 'Ameixoada 6', 'brunopuravida@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(15, 'Manuel', 'Rey Rodríguez', 'Agrelo 2', 'manuelrey@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC', 2),
(16, 'Guillermo', 'Álvarez Sampedro', 'Estrada Pola Vía 21', 'guilleas1998@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC',2),
(17, 'Adrián', 'Sabugueiro Meseguer', 'Torrecedeira 16', 'sabugueiro.adrian@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC',2),
(18, 'Carmen', 'García Rey', 'Avenida Castelao 85', 'carmelaguay.cg@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC',3),
(19, 'Ruth', 'Arce Fernández', 'Avenida Redondela 14', 'ruth2001@gmail.com', '$2y$10$AJFWRGbH9VTwNiear55y3e8dp5ZqqQg2B8/aMzfVIr/CYgXPoeoNC',3);



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `id_aula` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `disponibilidad` boolean NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --
-- -- Volcado de datos para la tabla `aulas`
-- --
-- 
INSERT INTO `aulas` (`id_aula`, `nombre`) VALUES
(1, 'musica'),
(2, 'informatica'),
(3, 'biblioteca'),
(4, 'bibliolab'),
(5, 'multisensorial'),
(6, 'rosalia'),
(7, 'gimnasio'),
(8, 'patio de columnas');

-- -- --------------------------------------------------------


--
-- Estructura de tabla para la tabla `reservas_aula_profesor`
--

CREATE TABLE `reservas_aula_profesor` (
  `id_reserva` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `fecha` varchar(25) NOT NULL,
  `hora` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -- --------------------------------------------------------
-- --
-- -- Volcado de datos para la tabla `reservas_aula_profesor`
-- --
-- 
INSERT INTO `reservas_aula_profesor` (`id_reserva`,`id_aula`,`id_profesor`, `fecha`,`hora`) VALUES
(2, 4, 2, '8 de Junio','12:20-13:10');



-- --------------------------------------------------------
-- 
-- --
-- -- Estructura de tabla para la tabla `actividades_extraescolares`
-- --
-- 
CREATE TABLE `actividades_extraescolares` (
  `id_actividad` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `horario` varchar(255) NOT NULL,
  `precio` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- 
-- -- --------------------------------------------------------
-- --
-- -- Volcado de datos para la tabla `actividades_extraescolares`
-- --
-- 
INSERT INTO `actividades_extraescolares` (`id_actividad`, `nombre`, `horario`,`precio`) VALUES
(1, 'ballet', 'Martes de 17:00 a 18:00', 15),
(2, 'gimnasia ritmica','Miércoles y Viernes de 17:00 a 18:00', 16),
(3, 'baile moderno','Lunes de 16:30 a 17:30', 14),
(4, 'baloncesto', 'Martes y Jueves de 16:00 a 17:00', 15),
(5, 'balonmano','Lunes y Miércoles de 18:35 a 19:45', 16),
(6, 'kungfu','Martes y Jueves de 15:45 a 16:45',20),
(7, 'teatro','Miércoles de 15:45 a 16:45',15),
(8, 'pintura creativa','Jueves de 15:45 a 17:15',15),
(9, 'comic','Miércoles 15:45 a 16:45',14),
(10, 'inglés','Viernes de 17:00 a 18:00',20);

-- -- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_actividad_padre`
--

CREATE TABLE `reservas_actividad_padre` (
  `id_reserva_actividad` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `id_padre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- -- --------------------------------------------------------
-- --
-- -- Volcado de datos para la tabla `reservas_actividad_padre`
-- --
-- 
INSERT INTO `reservas_actividad_padre` (`id_reserva_actividad`,`id_actividad`,`id_padre`) VALUES
(1, 2, 18),
(7, 9, 19);

-- --------------------------------------------------------
-- 
-- --
-- --Alter tables
-- --

ALTER TABLE `roles`
ADD PRIMARY KEY (`id_rol`);

ALTER TABLE `usuarios`
ADD PRIMARY KEY (`id_usuario`),
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `rol_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`id_rol`),
ADD `ultima_modificacion` varchar(50) NULL DEFAULT NULL AFTER `password`;

ALTER TABLE `aulas`
ADD PRIMARY KEY (`id_aula`);

ALTER TABLE `reservas_aula_profesor`
ADD PRIMARY KEY(`id_reserva`),
MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `usuarios` (`id_usuario`),
ADD CONSTRAINT `aula_ibfk_1` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id_aula`);

ALTER TABLE `actividades_extraescolares`
ADD PRIMARY KEY (`id_actividad`);

ALTER TABLE `reservas_actividad_padre`
ADD PRIMARY KEY(`id_reserva_actividad`),
MODIFY `id_reserva_actividad` int(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `usuario_padre_ibfk_1` FOREIGN KEY (`id_padre`) REFERENCES `usuarios` (`id_usuario`),
ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividades_extraescolares` (`id_actividad`);