-- Drop tables if they exist
DROP TABLE IF EXISTS `usuarios`;
DROP TABLE IF EXISTS `roles`;

-- Create roles table
CREATE TABLE `roles` (
  `Id_Rol` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nombre_Rol` varchar(50) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Fecha_Creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id_Rol`),
  UNIQUE KEY `Nombre_Rol` (`Nombre_Rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert default roles
INSERT INTO `roles` (`Id_Rol`, `Nombre_Rol`, `Descripcion`) VALUES
(1, 'admin', 'Administrador del sistema'),
(2, 'doctor', 'Médico'),
(3, 'enfermera', 'Enfermera/o'),
(4, 'paciente', 'Paciente');

-- Create usuarios table
CREATE TABLE `usuarios` (
  `Id_Usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Id_Rol` int(11) UNSIGNED NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Edad` varchar(20) DEFAULT NULL,
  `Sexo` varchar(10) DEFAULT NULL,
  `Peso` varchar(20) DEFAULT NULL,
  `Altura` varchar(20) DEFAULT NULL,
  `Tipo_sangre` varchar(10) DEFAULT NULL,
  `Alergias` text DEFAULT NULL,
  `Enfermedades` text DEFAULT NULL,
  `Activo` tinyint(1) DEFAULT 1,
  `Fecha_Registro` timestamp DEFAULT CURRENT_TIMESTAMP,
  `Ultimo_Acceso` datetime DEFAULT NULL,
  `Token_Recuperacion` varchar(255) DEFAULT NULL,
  `Token_Expiracion` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Usuario`),
  UNIQUE KEY `Email` (`Email`),
  KEY `Id_Rol` (`Id_Rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Id_Rol`) REFERENCES `roles` (`Id_Rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert admin user (password: admin123)
INSERT INTO `usuarios` 
(`Id_Rol`, `Nombre`, `Email`, `Password`, `Activo`) 
VALUES 
(1, 'Administrador', 'admin@healthmate.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1);
