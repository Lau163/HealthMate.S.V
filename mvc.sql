-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-10-2023 a las 17:40:31
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
-- Base de datos: `mvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_sociedad` int(11) NOT NULL,
  `nombre_sociedad` varchar(150) NOT NULL,
  `nombre_sistema` varchar(150) NOT NULL,
  `descripcion_sistema` varchar(150) DEFAULT NULL,
  `servidor_correo` text NOT NULL,
  `puerto_servidor_correo` varchar(20) NOT NULL,
  `correo_soporte` varchar(100) NOT NULL,
  `password_correo` text NOT NULL,
  `correo_institucional` varchar(100) DEFAULT NULL,
  `ruta_logotipo` varchar(150) DEFAULT NULL,
  `ruta_icono` varchar(150) DEFAULT NULL,
  `dominio_sociedad` varchar(150) DEFAULT NULL,
  `estatus_sociedad` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_sociedad`, `nombre_sociedad`, `nombre_sistema`, `descripcion_sistema`, `servidor_correo`, `puerto_servidor_correo`, `correo_soporte`, `password_correo`, `correo_institucional`, `ruta_logotipo`, `ruta_icono`, `dominio_sociedad`, `estatus_sociedad`) VALUES
(1, 'Grupo Lahe Expert Meetings', 'GL-SISTEMA', 'Diseño de estructura MVC', 'mail.grupolahe.com', '465', '', '', NULL, 'public/img/logo_lahe.png', 'public/img/logo_lahe.png', 'http://localhost/mvc/', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_sociedad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_sociedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
