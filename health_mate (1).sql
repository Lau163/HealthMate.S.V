-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2026 a las 06:09:03
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
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `Id_Rol` int(11) UNSIGNED NOT NULL,
  `Nombre_Rol` varchar(50) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Fecha_Creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Id_Rol`, `Nombre_Rol`, `Descripcion`, `Fecha_Creacion`) VALUES
(1, 'paciente', 'Usuario paciente del sistema', '2025-09-15 06:39:05'),
(2, 'doctor', 'Personal médico con permisos de diagnóstico', '2025-09-15 06:39:05'),
(3, 'enfermerX', 'Personal de enfermería', '2025-09-15 06:39:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `signos_vitales`
--

CREATE TABLE `signos_vitales` (
  `id_registro` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `frecuencia_cardiaca` int(3) DEFAULT NULL,
  `frecuencia_respiratoria` int(3) DEFAULT NULL,
  `temperatura` varchar(10) DEFAULT NULL,
  `presion_sistolica` int(3) DEFAULT NULL,
  `presion_diastolica` int(3) DEFAULT NULL,
  `saturacion_oxigeno` int(3) DEFAULT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_Usuario` int(10) UNSIGNED NOT NULL,
  `Id_Rol` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `Nombre` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Edad` varchar(20) NOT NULL,
  `Sexo` varchar(10) NOT NULL,
  `Peso` varchar(20) NOT NULL,
  `Altura` varchar(20) DEFAULT NULL,
  `Tipo_sangre` varchar(200) DEFAULT NULL,
  `Alergias` varchar(10) NOT NULL,
  `Enfermedades` varchar(10) NOT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1,
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `Ultimo_Acceso` datetime DEFAULT NULL,
  `Token_Recuperacion` varchar(100) DEFAULT NULL,
  `Token_Expiracion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Id_Rol`, `Nombre`, `Email`, `Password`, `Edad`, `Sexo`, `Peso`, `Altura`, `Tipo_sangre`, `Alergias`, `Enfermedades`, `Activo`, `Fecha_Registro`, `Ultimo_Acceso`, `Token_Recuperacion`, `Token_Expiracion`) VALUES
(10, 3, 'Alejandro', 'edwinale.ro02@gmail.com', '$2y$10$T8S525V9a7oH0G8vqhFr/e3WG/SvbLaVor6pWZj7DTqcQW.kto8WG', '23', 'Masculino', '80', '2.00', 'B+', 'ninguna', 'ninguna', 1, '2025-09-23 01:51:54', '2025-11-24 00:26:50', NULL, NULL),
(49, 1, 'Carlos Elias Parra Dominguez', 'eliasparra61@gmail.com', '', '27', 'Masculino', '70', '178', 'A-', 'Ninguna', 'Ninguna', 1, '2025-11-13 03:56:45', NULL, NULL, NULL),
(50, 1, 'Juan Pepe Lopez Mendez', 'recep@test.com', '', '19', 'M', '60.6', '150', 'A+', 'Al polvo', 'Estornuda ', 1, '2025-11-13 04:03:34', NULL, NULL, NULL),
(51, 1, 'Ozuna Yandel Wishin', 'yandel.O@Health.com', '', '30', 'M', '90', '170', 'AB+', 'A trabajar', 'Pendejez', 1, '2025-11-13 04:06:28', NULL, NULL, NULL),
(52, 1, 'Joel Lebron Montero', 'Joel@healthmate.com', '$2y$10$v/RwPHQAlJdMdJfd3.sfUOvfND/SFVrwuxrpxHj6R//h7v961ldFW', '26', 'masculino', '67', '170', 'B+', 'ninguna', 'ninguna', 1, '2025-11-13 04:12:30', '2025-11-12 22:46:42', NULL, NULL),
(53, 1, 'Juanin Juan Harry', 'juaninjh@healthmate.com', '', '25', 'M', '3', '10', 'AB+', 'Ninguna', 'alergico a', 1, '2025-11-22 17:09:03', NULL, NULL, NULL),
(55, 1, 'Mario Hugo', 'marihugo@healthmate.com', '', '26', '', '7.3', '110', 'O+', 'Ninguna', 'Ninguna', 1, '2025-11-24 05:10:11', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id_Rol`),
  ADD UNIQUE KEY `Nombre_Rol` (`Nombre_Rol`);

--
-- Indices de la tabla `signos_vitales`
--
ALTER TABLE `signos_vitales`
  ADD PRIMARY KEY (`id_registro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `Id_Rol` (`Id_Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Id_Rol` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `signos_vitales`
--
ALTER TABLE `signos_vitales`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_Usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Id_Rol`) REFERENCES `roles` (`Id_Rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
