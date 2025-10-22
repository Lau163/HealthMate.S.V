-- =============================================
-- Script para crear la tabla de signos vitales
-- Ejecutar en phpMyAdmin o MySQL Command Line
-- =============================================

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS health_mate CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- Usar la base de datos
USE health_mate;

-- Crear tabla de signos vitales
CREATE TABLE IF NOT EXISTS signos_vitales (
    id_registro INT PRIMARY KEY AUTO_INCREMENT COMMENT 'ID único del registro',
    id_paciente INT NOT NULL COMMENT 'ID del paciente (relacionado con usuarios)',
    fecha_registro DATETIME NOT NULL COMMENT 'Fecha y hora del registro',
    frecuencia_cardiaca INT COMMENT 'Frecuencia cardíaca (latidos por minuto)',
    frecuencia_respiratoria INT COMMENT 'Frecuencia respiratoria (respiraciones por minuto)',
    temperatura DECIMAL(4,2) COMMENT 'Temperatura corporal en grados Celsius',
    presion_sistolica INT COMMENT 'Presión arterial sistólica (mmHg)',
    presion_diastolica INT COMMENT 'Presión arterial diastólica (mmHg)',
    saturacion_oxigeno INT COMMENT 'Saturación de oxígeno en sangre (%)',
    observaciones TEXT COMMENT 'Observaciones adicionales del profesional',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Última actualización',

    -- Índices para mejorar rendimiento de consultas
    INDEX idx_paciente_fecha (id_paciente, fecha_registro),
    INDEX idx_fecha_registro (fecha_registro),

    -- Clave foránea hacia la tabla usuarios (pacientes)
    CONSTRAINT fk_signos_paciente FOREIGN KEY (id_paciente)
    REFERENCES usuarios(Id_Usuario) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para almacenar signos vitales de pacientes';

-- Insertar algunos datos de ejemplo para pruebas
INSERT INTO signos_vitales (
    id_paciente, fecha_registro, frecuencia_cardiaca, frecuencia_respiratoria,
    temperatura, presion_sistolica, presion_diastolica, saturacion_oxigeno, observaciones
) VALUES
(1, NOW(), 75, 18, 36.5, 120, 80, 98, 'Paciente estable, sin signos de alarma'),
(2, NOW(), 82, 20, 37.2, 135, 88, 97, 'Paciente con fiebre leve, monitoreo continuo'),
(1, DATE_SUB(NOW(), INTERVAL 1 DAY), 78, 16, 36.8, 118, 82, 99, 'Paciente en recuperación');

-- Mostrar información de la tabla creada
DESCRIBE signos_vitales;

-- Mostrar datos insertados
SELECT
    sv.id_registro,
    u.Nombre as nombre_paciente,
    sv.fecha_registro,
    CONCAT(sv.frecuencia_cardiaca, ' lpm') as frecuencia_cardiaca,
    CONCAT(sv.frecuencia_respiratoria, ' rpm') as frecuencia_respiratoria,
    CONCAT(sv.temperatura, ' °C') as temperatura,
    CONCAT(sv.presion_sistolica, '/', sv.presion_diastolica, ' mmHg') as presion_arterial,
    CONCAT(sv.saturacion_oxigeno, '%') as saturacion_oxigeno,
    sv.observaciones
FROM signos_vitales sv
INNER JOIN usuarios u ON sv.id_paciente = u.Id_Usuario
ORDER BY sv.fecha_registro DESC;

-- =============================================
-- FIN DEL SCRIPT
-- =============================================

-- Notas importantes:
-- 1. Asegúrate de que la tabla 'usuarios' exista antes de ejecutar este script
-- 2. El campo 'id_paciente' debe corresponder a usuarios con rol 'paciente'
-- 3. Puedes ejecutar este script múltiples veces sin problemas (IF NOT EXISTS)
-- 4. Los índices mejoran el rendimiento de consultas frecuentes
