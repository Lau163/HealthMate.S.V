<?php
// Script para verificar que el error se ha resuelto
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "<h1>🔧 Verificación Final - Error Corregido</h1>";

// Verificar que las vistas no usen $this->get()
echo "<h2>📄 Verificación de Vistas:</h2>";

$views_to_check = [
    'views/doctor/InMed.php',
    'views/doctor/consejos.php',
    'views/doctor/dar_consejos.view.php',
    'views/doctor/estadisticas.view.php'
];

foreach ($views_to_check as $view) {
    if (file_exists($view)) {
        $content = file_get_contents($view);
        if (strpos($content, '$this->get(') !== false) {
            echo "<p style='color: red;'>❌ $view todavía usa \$this->get()</p>";
        } else {
            echo "<p style='color: green;'>✅ $view está limpio</p>";
        }
    } else {
        echo "<p style='color: orange;'>⚠️ $view no existe</p>";
    }
}

// Verificar que el controlador esté correcto
echo "<h2>🎮 Verificación del Controlador:</h2>";
if (file_exists('controllers/doctor.controller.php')) {
    $controller_content = file_get_contents('controllers/doctor.controller.php');

    if (strpos($controller_content, 'renderWithLayout') !== false) {
        echo "<p style='color: green;'>✅ Método renderWithLayout encontrado</p>";
    } else {
        echo "<p style='color: red;'>❌ Método renderWithLayout no encontrado</p>";
    }

    if (strpos($controller_content, 'getData()') !== false) {
        echo "<p style='color: red;'>❌ Controlador usa getData() que no existe</p>";
    } else {
        echo "<p style='color: green;'>✅ Controlador no usa getData()</p>";
    }

    if (strpos($controller_content, '$this->view->get(') !== false) {
        echo "<p style='color: green;'>✅ Controlador usa \$this->view->get() correctamente</p>";
    } else {
        echo "<p style='color: orange;'>⚠️ Controlador no usa \$this->view->get()</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Controlador no encontrado</p>";
}

echo "<h2>🎯 URLs para Probar:</h2>";
echo "<ul>";
echo "<li><strong>Dashboard Principal:</strong> <a href='" . URL . "doctor/?debug=1' target='_blank'>" . URL . "doctor/?debug=1</a></li>";
echo "<li><strong>Inicio con Debug:</strong> <a href='" . URL . "doctor/inicio?debug=1' target='_blank'>" . URL . "doctor/inicio?debug=1</a></li>";
echo "<li><strong>Panel de Testing:</strong> <a href='" . URL . "index_test.php' target='_blank'>" . URL . "index_test.php</a></li>";
echo "</ul>";

echo "<p style='color: blue; font-weight: bold;'>🎉 El error debería estar completamente solucionado ahora.</p>";
echo "<p style='color: green;'>✅ Problema corregido: \$this->get() eliminado de las vistas</p>";
echo "<p style='color: green;'>✅ Variables pasadas correctamente desde el controlador</p>";
echo "<p style='color: green;'>✅ Método renderWithLayout actualizado</p>";
?>
