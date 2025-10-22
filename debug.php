<?php
// Script de diagnóstico para verificar si el sistema funciona
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "<h1>Diagnóstico del Sistema HealthMate</h1>";

// Verificar si BASE_URL está definido
echo "<h2>1. Configuración de URL</h2>";
echo "BASE_URL: " . (defined('BASE_URL') ? BASE_URL : 'NO DEFINIDO') . "<br>";
echo "URL completa: " . (defined('URL') ? URL : 'NO DEFINIDO') . "<br>";
echo "Directorio actual: " . __DIR__ . "<br>";
echo "PHP Version: " . phpversion() . "<br><br>";

// Verificar archivos de configuración
echo "<h2>2. Archivos de Configuración</h2>";
$files = [
    'config/config.php',
    'app/app.php',
    'app/controller.base.php',
    'app/view.base.php',
    'controllers/doctor.controller.php',
    'views/doctor/layout.php',
    'views/doctor/estadisticas.view.php',
    'views/doctor/consejos.view.php',
    'views/doctor/dar_consejos.view.php'
];

foreach ($files as $file) {
    echo "$file: " . (file_exists($file) ? '<span style="color: green;">✓ Existe</span>' : '<span style="color: red;">✗ No existe</span>') . "<br>";
}
echo "<br>";

// Verificar permisos de archivos
echo "<h2>3. Permisos de Archivos</h2>";
foreach ($files as $file) {
    if (file_exists($file)) {
        echo "$file: " . (is_readable($file) ? '<span style="color: green;">✓ Lectura</span>' : '<span style="color: red;">✗ Sin lectura</span>') . "<br>";
    }
}
echo "<br>";

// Verificar sesión
echo "<h2>4. Configuración de Sesión</h2>";
echo "Sesión iniciada: " . (session_status() === PHP_SESSION_ACTIVE ? '<span style="color: green;">✓ Sí</span>' : '<span style="color: red;">✗ No</span>') . "<br>";
echo "ID de sesión: " . session_id() . "<br><br>";

// Verificar rutas de archivos
echo "<h2>5. Rutas de Archivos</h2>";
echo "Ruta absoluta de layout: " . realpath('views/doctor/layout.php') . "<br>";
echo "Ruta absoluta de estadísticas: " . realpath('views/doctor/estadisticas.view.php') . "<br><br>";

// Probar carga de archivos
echo "<h2>6. Prueba de Carga</h2>";
try {
    require_once "config/config.php";
    echo "Config.php: <span style='color: green;'>✓ Cargado correctamente</span><br>";
} catch (Exception $e) {
    echo "Config.php: <span style='color: red;'>✗ Error: " . $e->getMessage() . "</span><br>";
}

try {
    require_once "app/controller.base.php";
    echo "ControllerBase: <span style='color: green;'>✓ Cargado correctamente</span><br>";
} catch (Exception $e) {
    echo "ControllerBase: <span style='color: red;'>✗ Error: " . $e->getMessage() . "</span><br>";
}

try {
    require_once "app/view.base.php";
    echo "ViewBase: <span style='color: green;'>✓ Cargado correctamente</span><br>";
} catch (Exception $e) {
    echo "ViewBase: <span style='color: red;'>✗ Error: " . $e->getMessage() . "</span><br>";
}
echo "<br>";

// Verificar clases
echo "<h2>7. Clases Disponibles</h2>";
echo "ControllerBase: " . (class_exists('ControllerBase') ? '<span style="color: green;">✓ Disponible</span>' : '<span style="color: red;">✗ No disponible</span>') . "<br>";
echo "ViewBase: " . (class_exists('ViewBase') ? '<span style="color: green;">✓ Disponible</span>' : '<span style="color: red;">✗ No disponible</span>') . "<br>";
echo "Doctor: " . (file_exists('controllers/doctor.controller.php') ? '<span style="color: green;">✓ Controlador existe</span>' : '<span style="color: red;">✗ Controlador no existe</span>') . "<br><br>";

// Probar métodos del controlador
echo "<h2>8. Métodos del Controlador Doctor</h2>";
if (file_exists('controllers/doctor.controller.php')) {
    $methods = ['estadisticas', 'consejos', 'dar_consejos', 'panel', 'render'];
    foreach ($methods as $method) {
        // Usar reflexión para verificar si el método existe sin instanciar
        $reflection = new ReflectionClass('Doctor');
        echo "$method: " . ($reflection->hasMethod($method) ? '<span style="color: green;">✓ Existe</span>' : '<span style="color: red;">✗ No existe</span>') . "<br>";
    }
}
echo "<br>";

// Verificar variables de servidor
echo "<h2>9. Variables de Servidor</h2>";
echo "HTTP_HOST: " . ($_SERVER['HTTP_HOST'] ?? 'NO DEFINIDO') . "<br>";
echo "REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'NO DEFINIDO') . "<br>";
echo "SCRIPT_NAME: " . ($_SERVER['SCRIPT_NAME'] ?? 'NO DEFINIDO') . "<br><br>";

echo "<h2>10. Enlaces de Prueba</h2>";
echo "<p>Para probar las vistas sin necesidad de login, agrega <code>?debug=1</code> al final de la URL:</p>";
echo "<h3>💻 Con Layout Completo:</h3>";
echo "<ul>";
echo "<li><a href='" . URL . "doctor/estadisticas?debug=1' target='_blank'>" . URL . "doctor/estadisticas?debug=1</a> - Estadísticas</li>";
echo "<li><a href='" . URL . "doctor/consejos?debug=1' target='_blank'>" . URL . "doctor/consejos?debug=1</a> - Consejos</li>";
echo "<li><a href='" . URL . "doctor/dar_consejos?debug=1' target='_blank'>" . URL . "doctor/dar_consejos?debug=1</a> - Dar Consejos</li>";
echo "<li><a href='" . URL . "doctor?debug=1' target='_blank'>" . URL . "doctor?debug=1</a> - Dashboard</li>";
echo "</ul>";

echo "<h3>🧪 Versiones Standalone (para testing rápido):</h3>";
echo "<ul>";
echo "<li><a href='" . URL . "estadisticas_standalone.php' target='_blank'>" . URL . "estadisticas_standalone.php</a> - Estadísticas</li>";
echo "<li><a href='" . URL . "consejos_standalone.php' target='_blank'>" . URL . "consejos_standalone.php</a> - Consejos</li>";
echo "<li><a href='" . URL . "dar_consejos_standalone.php' target='_blank'>" . URL . "dar_consejos_standalone.php</a> - Dar Consejos</li>";
echo "<li><a href='" . URL . "sidebar_test.php' target='_blank'>" . URL . "sidebar_test.php</a> - Test Sidebar</li>";
echo "</ul>";

echo "<h2>11. URLs Normales (requieren autenticación)</h2>";
echo "<ul>";
echo "<li><a href='" . URL . "doctor/estadisticas' target='_blank'>" . URL . "doctor/estadisticas</a> - Estadísticas</li>";
echo "<li><a href='" . URL . "doctor/consejos' target='_blank'>" . URL . "doctor/consejos</a> - Consejos</li>";
echo "<li><a href='" . URL . "doctor/dar_consejos' target='_blank'>" . URL . "doctor/dar_consejos</a> - Dar Consejos</li>";
echo "</ul>";
?>
