-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2025 a las 05:40:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `health_mate`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

-- Tabla de roles
CREATE TABLE `roles` (
  `Id_Rol` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nombre_Rol` varchar(50) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Fecha_Creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id_Rol`),
  UNIQUE KEY `Nombre_Rol` (`Nombre_Rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar roles básicos
INSERT INTO `roles` (`Id_Rol`, `Nombre_Rol`, `Descripcion`) VALUES
(1, 'paciente', 'Usuario paciente del sistema'),
(2, 'doctor', 'Personal médico con permisos de diagnóstico'),
(3, 'enfermero', 'Personal de enfermería');

-- Modificar tabla usuarios para autenticación
ALTER TABLE `usuarios` 
  ADD `Email` VARCHAR(255) NOT NULL AFTER `Nombre`,
  ADD `Password` VARCHAR(255) NOT NULL AFTER `Email`,
  ADD `Id_Rol` INT UNSIGNED NOT NULL DEFAULT 1 AFTER `Id_Usuario`,
  ADD `Activo` TINYINT(1) NOT NULL DEFAULT 1,
  ADD `Fecha_Registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  ADD `Ultimo_Acceso` DATETIME DEFAULT NULL,
  ADD `Token_Recuperacion` VARCHAR(100) DEFAULT NULL,
  ADD `Token_Expiracion` DATETIME DEFAULT NULL,
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `Id_Rol` (`Id_Rol`);

-- Convertir Id_Usuario a autoincremental
ALTER TABLE `usuarios` MODIFY `Id_Usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- Añadir clave foránea
ALTER TABLE `usuarios` 
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Id_Rol`) REFERENCES `roles` (`Id_Rol`) ON DELETE RESTRICT ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
