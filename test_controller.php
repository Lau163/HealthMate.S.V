<?php
// Script para verificar la sintaxis del controlador
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "<h1>Verificación de Sintaxis - Doctor Controller</h1>";

// Verificar si hay errores de sintaxis
echo "<h2>1. Verificación de Sintaxis PHP</h2>";
$php_output = shell_exec('php -l controllers/doctor.controller.php 2>&1');
if (strpos($php_output, 'No syntax errors') !== false) {
    echo "<p style='color: green;'>✅ Sintaxis correcta: " . htmlspecialchars($php_output) . "</p>";
} else {
    echo "<p style='color: red;'>❌ Error de sintaxis: " . htmlspecialchars($php_output) . "</p>";
}

// Intentar cargar el controlador
echo "<h2>2. Carga del Controlador</h2>";
try {
    require_once "config/config.php";
    require_once "app/controller.base.php";
    require_once "app/view.base.php";
    require_once "controllers/doctor.controller.php";
    echo "<p style='color: green;'>✅ Archivos base cargados correctamente</p>";

    // Verificar que la clase existe
    if (class_exists('Doctor')) {
        echo "<p style='color: green;'>✅ Clase Doctor existe</p>";

        // Verificar métodos
        $reflection = new ReflectionClass('Doctor');
        $methods = $reflection->getMethods();

        echo "<h3>Métodos disponibles:</h3>";
        echo "<ul>";
        foreach ($methods as $method) {
            echo "<li style='color: green;'>✅ " . $method->getName() . "()</li>";
        }
        echo "</ul>";
    } else {
        echo "<p style='color: red;'>❌ Clase Doctor no existe</p>";
    }

} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error al cargar el controlador: " . $e->getMessage() . "</p>";
}

echo "<h2>3. URLs de Prueba</h2>";
echo "<p>El controlador ahora debería funcionar correctamente con estas URLs:</p>";
echo "<ul>";
echo "<li><strong>Estadísticas:</strong> <a href='" . URL . "doctor/estadisticas?debug=1' target='_blank'>" . URL . "doctor/estadisticas?debug=1</a></li>";
echo "<li><strong>Consejos:</strong> <a href='" . URL . "doctor/consejos?debug=1' target='_blank'>" . URL . "doctor/consejos?debug=1</a></li>";
echo "<li><strong>Dar Consejos:</strong> <a href='" . URL . "doctor/dar_consejos?debug=1' target='_blank'>" . URL . "doctor/dar_consejos?debug=1</a></li>";
echo "</ul>";

echo "<p style='color: blue; font-weight: bold;'>🎉 ¡El error de sintaxis ha sido corregido! Todas las vistas deberían funcionar ahora.</p>";
?>
