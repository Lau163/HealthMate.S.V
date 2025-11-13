<?php
// Script para probar que el controlador funciona
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "<h1>🔧 Test del Controlador Doctor</h1>";

// Verificar que el controlador existe
if (file_exists('controllers/doctor.controller.php')) {
    echo "<p style='color: green;'>✅ Controlador encontrado</p>";
} else {
    echo "<p style='color: red;'>❌ Controlador no encontrado</p>";
    exit;
}

// Verificar que las clases base existen
$classes_base = [
    'config/config.php',
    'app/controller.base.php',
    'app/view.base.php'
];

foreach ($classes_base as $class) {
    if (file_exists($class)) {
        echo "<p style='color: green;'>✅ $class encontrado</p>";
    } else {
        echo "<p style='color: red;'>❌ $class no encontrado</p>";
    }
}

// Verificar que las vistas existen
$views = [
    'views/doctor/InMed.php',
    'views/doctor/estadisticas.view.php',
    'views/doctor/consejos.php',
    'views/doctor/dar_consejos.view.php',
    'views/doctor/layout.php'
];

echo "<h2>📁 Verificación de Vistas:</h2>";
foreach ($views as $view) {
    if (file_exists($view)) {
        echo "<p style='color: green;'>✅ $view encontrado</p>";
    } else {
        echo "<p style='color: red;'>❌ $view no encontrado</p>";
    }
}

echo "<h2>🔍 Test de Clases:</h2>";
try {
    require_once "config/config.php";
    require_once "app/controller.base.php";
    require_once "app/view.base.php";

    if (class_exists('ControllerBase')) {
        echo "<p style='color: green;'>✅ ControllerBase disponible</p>";
    }

    if (class_exists('ViewBase')) {
        echo "<p style='color: green;'>✅ ViewBase disponible</p>";

        // Probar el método getData
        $view = new ViewBase();
        $view->set('test', 'valor de prueba');
        $data = $view->getData();

        if (isset($data['test']) && $data['test'] === 'valor de prueba') {
            echo "<p style='color: green;'>✅ Método getData() funciona</p>";
        } else {
            echo "<p style='color: red;'>❌ Método getData() no funciona</p>";
        }
    }

} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error al cargar clases: " . $e->getMessage() . "</p>";
}

echo "<h2>🎯 URLs de Prueba:</h2>";
echo "<ul>";
echo "<li><strong>Dashboard Principal:</strong> <a href='" . URL . "doctor/?debug=1' target='_blank'>" . URL . "doctor/?debug=1</a></li>";
echo "<li><strong>Inicio Médico:</strong> <a href='" . URL . "doctor/inicio?debug=1' target='_blank'>" . URL . "doctor/inicio?debug=1</a></li>";
echo "<li><strong>Estadísticas:</strong> <a href='" . URL . "doctor/estadisticas?debug=1' target='_blank'>" . URL . "doctor/estadisticas?debug=1</a></li>";
echo "<li><strong>Consejos:</strong> <a href='" . URL . "doctor/consejos?debug=1' target='_blank'>" . URL . "doctor/consejos?debug=1</a></li>";
echo "</ul>";

echo "<p style='color: blue; font-weight: bold;'>🎉 El controlador debería funcionar ahora. Prueba las URLs arriba.</p>";
?>
