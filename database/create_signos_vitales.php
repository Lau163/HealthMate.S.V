<?php
/**
 * Script para crear la tabla de signos vitales
 * Ejecutar este script en phpMyAdmin o línea de comandos MySQL
 */

$config = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'health_mate'
];

// Conectar a MySQL
$conn = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conectado exitosamente a la base de datos\n";

// Crear tabla signos_vitales
$sql = "CREATE TABLE IF NOT EXISTS signos_vitales (
    id_registro INT PRIMARY KEY AUTO_INCREMENT,
    id_paciente INT NOT NULL,
    fecha_registro DATETIME NOT NULL,
    frecuencia_cardiaca INT,
    frecuencia_respiratoria INT,
    temperatura DECIMAL(4,2),
    presion_sistolica INT,
    presion_diastolica INT,
    saturacion_oxigeno INT,
    observaciones TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- Índices para mejorar rendimiento
    INDEX idx_paciente_fecha (id_paciente, fecha_registro),
    INDEX idx_fecha_registro (fecha_registro),

    -- Clave foránea hacia usuarios (pacientes)
    CONSTRAINT fk_signos_paciente FOREIGN KEY (id_paciente) REFERENCES usuarios(Id_Usuario) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para almacenar signos vitales de pacientes';";

if ($conn->query($sql) === TRUE) {
    echo "✓ Tabla 'signos_vitales' creada exitosamente\n";
} else {
    echo "✗ Error al crear tabla: " . $conn->error . "\n";
}

// Insertar algunos datos de ejemplo
$ejemplos = [
    [
        'id_paciente' => 1,
        'frecuencia_cardiaca' => 75,
        'frecuencia_respiratoria' => 18,
        'temperatura' => 36.5,
        'presion_sistolica' => 120,
        'presion_diastolica' => 80,
        'saturacion_oxigeno' => 98,
        'observaciones' => 'Paciente estable, sin signos de alarma'
    ],
    [
        'id_paciente' => 2,
        'frecuencia_cardiaca' => 82,
        'frecuencia_respiratoria' => 20,
        'temperatura' => 37.2,
        'presion_sistolica' => 135,
        'presion_diastolica' => 88,
        'saturacion_oxigeno' => 97,
        'observaciones' => 'Paciente con fiebre leve, monitoreo continuo'
    ]
];

foreach ($ejemplos as $ejemplo) {
    $sql = "INSERT INTO signos_vitales (
        id_paciente, fecha_registro, frecuencia_cardiaca, frecuencia_respiratoria,
        temperatura, presion_sistolica, presion_diastolica, saturacion_oxigeno, observaciones
    ) VALUES (
        ?, NOW(), ?, ?, ?, ?, ?, ?, ?
    )";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'iiiiiiis',
        $ejemplo['id_paciente'],
        $ejemplo['frecuencia_cardiaca'],
        $ejemplo['frecuencia_respiratoria'],
        $ejemplo['temperatura'],
        $ejemplo['presion_sistolica'],
        $ejemplo['presion_diastolica'],
        $ejemplo['saturacion_oxigeno'],
        $ejemplo['observaciones']
    );

    if ($stmt->execute()) {
        echo "✓ Registro de ejemplo insertado para paciente ID: " . $ejemplo['id_paciente'] . "\n";
    } else {
        echo "✗ Error al insertar ejemplo: " . $stmt->error . "\n";
    }
}

// Mostrar estructura de la tabla creada
echo "\n=== ESTRUCTURA DE LA TABLA SIGNOS_VITALES ===\n";
$sql = "DESCRIBE signos_vitales";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo sprintf("%-20s %-15s %-8s %-5s %-10s\n", "Campo", "Tipo", "Nulo", "Clave", "Predet.");
    echo str_repeat("-", 70) . "\n";

    while($row = $result->fetch_assoc()) {
        echo sprintf(
            "%-20s %-15s %-8s %-5s %-10s\n",
            $row['Field'],
            $row['Type'],
            $row['Null'],
            $row['Key'],
            $row['Default'] ?? 'NULL'
        );
    }
} else {
    echo "No se pudo obtener la estructura de la tabla\n";
}

echo "\n=== VERIFICACIÓN DE DATOS ===\n";
$sql = "SELECT COUNT(*) as total FROM signos_vitales";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo "Total de registros en signos_vitales: " . $row['total'] . "\n";

$conn->close();
echo "\n✓ Script completado exitosamente\n";
?>
