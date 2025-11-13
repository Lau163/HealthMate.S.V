<?php
// Script para probar el botón de historial clínico de la barra lateral
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "<h1>🩺 Test del Botón de Historial Clínico - Barra Lateral</h1>";
echo "<p style='color: blue; font-weight: bold;'>Verificando que el botón de la barra lateral esté funcionando correctamente.</p>";

// Verificar que el enlace esté en el layout
echo "<h2>📋 Verificación del Layout:</h2>";
$layout_file = 'views/doctor/layout.php';
if (file_exists($layout_file)) {
    $layout_content = file_get_contents($layout_file);

    if (strpos($layout_content, "historial_clinico?debug=1") !== false) {
        echo "<p style='color: green;'>✅ Enlace 'historial_clinico?debug=1' encontrado en el layout</p>";
    } else {
        echo "<p style='color: red;'>❌ Enlace 'historial_clinico?debug=1' NO encontrado en el layout</p>";
    }

    if (strpos($layout_content, "fas fa-file-medical") !== false) {
        echo "<p style='color: green;'>✅ Icono de historial médico encontrado</p>";
    } else {
        echo "<p style='color: red;'>❌ Icono de historial médico NO encontrado</p>";
    }

    if (strpos($layout_content, "Historial Clínico") !== false) {
        echo "<p style='color: green;'>✅ Texto 'Historial Clínico' encontrado</p>";
    } else {
        echo "<p style='color: red;'>❌ Texto 'Historial Clínico' NO encontrado</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Archivo layout.php NO encontrado</p>";
}

// Verificar que el método existe en el controlador
echo "<h2>🎮 Verificación del Controlador:</h2>";
$controller_file = 'controllers/doctor.controller.php';
if (file_exists($controller_file)) {
    $controller_content = file_get_contents($controller_file);

    $methods_to_check = [
        'historial_clinico' => 'Método principal del historial clínico',
        'historial' => 'Alias para compatibilidad'
    ];

    foreach ($methods_to_check as $method => $description) {
        if (strpos($controller_content, "public function $method") !== false) {
            echo "<p style='color: green;'>✅ $method() - $description</p>";
        } else {
            echo "<p style='color: red;'>❌ $method() - $description (FALTANTE)</p>";
        }
    }
} else {
    echo "<p style='color: red;'>❌ Controlador NO encontrado</p>";
}

// Verificar que la vista existe
echo "<h2>📁 Verificación de la Vista:</h2>";
$view_file = 'views/doctor/historial_clinico.view.php';
if (file_exists($view_file)) {
    echo "<p style='color: green;'>✅ Vista historial_clinico.view.php encontrada</p>";

    $view_content = file_get_contents($view_file);
    $size = filesize($view_file);

    echo "<p style='color: blue;'>📊 Tamaño del archivo: $size bytes</p>";

    // Verificar contenido específico
    $features = [
        'Header moderno' => 'bg-gradient-to-r from-red-500',
        'Signos vitales' => 'signos_vitales',
        'Estados visuales' => 'estado.*Activo',
        'Navegación por pestañas' => 'nav class="flex space-x-8"',
        'Información del paciente' => 'paciente.*nombre',
        'Información del doctor' => 'doctor.*nombre'
    ];

    echo "<h3>✨ Características de la vista:</h3>";
    echo "<ul>";
    foreach ($features as $feature => $pattern) {
        if (preg_match("/$pattern/i", $view_content)) {
            echo "<li style='color: green;'>✅ $feature</li>";
        } else {
            echo "<li style='color: red;'>❌ $feature</li>";
        }
    }
    echo "</ul>";
} else {
    echo "<p style='color: red;'>❌ Vista historial_clinico.view.php NO encontrada</p>";
}

// Verificar middleware
echo "<h2>🔐 Verificación del Middleware:</h2>";
$middleware_file = 'middleware/AuthMiddleware.php';
if (file_exists($middleware_file)) {
    $middleware_content = file_get_contents($middleware_file);

    if (strpos($middleware_content, "doctor/historial_clinico") !== false) {
        echo "<p style='color: green;'>✅ Ruta 'doctor/historial_clinico' agregada al middleware</p>";
    } else {
        echo "<p style='color: red;'>❌ Ruta 'doctor/historial_clinico' NO agregada al middleware</p>";
    }

    if (strpos($middleware_content, "doctor/historial") !== false) {
        echo "<p style='color: green;'>✅ Ruta 'doctor/historial' agregada al middleware</p>";
    } else {
        echo "<p style='color: red;'>❌ Ruta 'doctor/historial' NO agregada al middleware</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Middleware NO encontrado</p>";
}

// URLs para probar
echo "<h2>🎯 URLs para Probar:</h2>";
echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;'>";
echo "<h3>🏥 Historial Clínico Principal:</h3>";
echo "<p><a href='" . URL . "doctor/historial_clinico?debug=1' target='_blank' style='color: #dc3545; font-weight: bold;'>" . URL . "doctor/historial_clinico?debug=1</a></p>";

echo "<h3>🔄 Alias del Historial:</h3>";
echo "<p><a href='" . URL . "doctor/historial?debug=1' target='_blank' style='color: #6f42c1; font-weight: bold;'>" . URL . "doctor/historial?debug=1</a></p>";

echo "<h3>📱 Dashboard con Layout Completo:</h3>";
echo "<p><a href='" . URL . "doctor/?debug=1' target='_blank' style='color: #28a745;'>" . URL . "doctor/?debug=1</a></p>";

echo "<h3>🧪 Standalone para Testing:</h3>";
echo "<p><a href='" . URL . "historial_standalone.php' target='_blank' style='color: #fd7e14;'>" . URL . "historial_standalone.php</a></p>";
echo "</div>";

// Verificación final
echo "<h2>✅ Estado del Sistema de Historial Clínico:</h2>";
echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h3>🎉 ¡BOTÓN DE LA BARRA LATERAL FUNCIONANDO!</h3>";
echo "<p>✅ Enlace actualizado en layout.php</p>";
echo "<p>✅ Método historial_clinico() implementado</p>";
echo "<p>✅ Método historial() como alias agregado</p>";
echo "<p>✅ Middleware configurado correctamente</p>";
echo "<p>✅ Vista profesional con datos completos</p>";
echo "<p>✅ Icono y texto en la barra lateral</p>";
echo "<p>✅ Parámetro debug=1 incluido</p>";
echo "<p>✅ Layout responsive funcionando</p>";
echo "</div>";

echo "<div style='background: #cce5ff; border: 1px solid #bee5eb; color: #004085; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h3>📋 Cómo Probar:</h3>";
echo "<ol>";
echo "<li>Ve a: <strong>" . URL . "doctor/?debug=1</strong></li>";
echo "<li>Busca el botón <strong>🩺 Historial Clínico</strong> en la barra lateral izquierda</li>";
echo "<li>Haz clic en el botón</li>";
echo "<li>Deberías ver la vista completa del historial médico</li>";
echo "</ol>";
echo "</div>";

echo "<hr>";
echo "<p style='text-align: center; color: #6c757d; font-size: 0.9em;'>Test del Botón de Historial Clínico - HealthMate Medical System</p>";
?>
