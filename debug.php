<?php
/**
 * Script de diagnóstico para HealthMate
 * Guarda este archivo como debug.php en la raíz de tu proyecto
 */

echo "<h1>Diagnóstico de HealthMate</h1>\n";

// 1. Verificar archivos críticos
echo "<h2>1. Verificación de Archivos</h2>\n";
$archivos = [
    'config/config.php',
    'app/database.php',
    'app/model.base.php',
    'app/controller.base.php',
    'controllers/enfermerx.controller.php',
    'models/usuario.model.php',
    'views/enfermerx/nuevo_paciente.view.php',
    '.htaccess',
    'index.php'
];

foreach ($archivos as $archivo) {
    $existe = file_exists($archivo) ? '✓' : '✗';
    echo "{$existe} {$archivo}<br>\n";
}

// 2. Verificar constantes
echo "<h2>2. Verificación de Constantes</h2>\n";
require_once 'config/config.php';
echo "BASE_URL: " . BASE_URL . "<br>\n";
echo "ROOT definida: " . (defined('ROOT') ? '✓' : '✗') . "<br>\n";

// 3. Verificar controlador
echo "<h2>3. Verificación de Controlador</h2>\n";
if (file_exists('controllers/enfermerx.controller.php')) {
    require_once 'controllers/enfermerx.controller.php';
    if (class_exists('Enfermerx')) {
        echo "✓ Clase Enfermerx existe<br>\n";
        $controller = new Enfermerx();
        if (method_exists($controller, 'nuevo')) {
            echo "✓ Método nuevo() existe<br>\n";
        } else {
            echo "✗ Método nuevo() NO existe<br>\n";
        }
    } else {
        echo "✗ Clase Enfermerx NO existe<br>\n";
    }
}

// 4. Información del servidor
echo "<h2>4. Información del Servidor</h2>\n";
echo "Servidor: " . $_SERVER['SERVER_SOFTWARE'] . "<br>\n";
echo "PHP Version: " . phpversion() . "<br>\n";
echo "URL Actual: " . $_SERVER['REQUEST_URI'] . "<br>\n";

// 5. Sugerencias
echo "<h2>5. URLs de Prueba</h2>\n";
echo "<a href='" . BASE_URL . "enfermerx'>Panel Enfermerx</a><br>\n";
echo "<a href='" . BASE_URL . "enfermerx/nuevo'>Formulario Nuevo Paciente</a><br>\n";
echo "<a href='" . BASE_URL . "index.php?url=enfermerx/nuevo'>Formulario (con parámetro)</a><br>\n";

echo "<h2>6. Solución</h2>\n";
echo "Si el formulario no funciona, prueba:<br>\n";
echo "1. Reinicia XAMPP<br>\n";
echo "2. Usa el servidor PHP integrado: php -S localhost:8080<br>\n";
echo "3. Accede directamente: /index.php?url=enfermerx/nuevo<br>\n";
?>
