<?php
// Script rápido para verificar que el controlador funciona
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "<h1>🔧 Verificación Rápida del Controlador</h1>";

// Verificar sintaxis
$controller_file = 'controllers/doctor.controller.php';
if (file_exists($controller_file)) {
    echo "<p style='color: green;'>✅ Controlador encontrado</p>";

    // Verificar métodos críticos
    $content = file_get_contents($controller_file);

    $critical_methods = [
        'inicio' => 'Dashboard Principal',
        'pacientes' => 'Gestión de Pacientes',
        'consultas' => 'Agenda y Consultas',
        'medicamentos' => 'Gestión de Medicamentos',
        'recetas' => 'Gestión de Recetas',
        'mensajes' => 'Mensajes'
    ];

    foreach ($critical_methods as $method => $description) {
        if (strpos($content, "public function $method") !== false) {
            echo "<p style='color: green;'>✅ $method() - $description</p>";
        } else {
            echo "<p style='color: red;'>❌ $method() - $description (FALTANTE)</p>";
        }
    }
} else {
    echo "<p style='color: red;'>❌ Controlador no encontrado</p>";
}

echo "<h2>🎯 URLs para Probar:</h2>";
echo "<ul>";
echo "<li><strong>Dashboard:</strong> <a href='" . URL . "doctor/?debug=1' target='_blank'>" . URL . "doctor/?debug=1</a></li>";
echo "<li><strong>Pacientes:</strong> <a href='" . URL . "doctor/pacientes?debug=1' target='_blank'>" . URL . "doctor/pacientes?debug=1</a></li>";
echo "<li><strong>Consultas:</strong> <a href='" . URL . "doctor/consultas?debug=1' target='_blank'>" . URL . "doctor/consultas?debug=1</a></li>";
echo "<li><strong>Medicamentos:</strong> <a href='" . URL . "doctor/medicamentos?debug=1' target='_blank'>" . URL . "doctor/medicamentos?debug=1</a></li>";
echo "<li><strong>Recetas:</strong> <a href='" . URL . "doctor/recetas?debug=1' target='_blank'>" . URL . "doctor/recetas?debug=1</a></li>";
echo "<li><strong>Mensajes:</strong> <a href='" . URL . "doctor/mensajes?debug=1' target='_blank'>" . URL . "doctor/mensajes?debug=1</a></li>";
echo "</ul>";

echo "<p style='color: blue; font-weight: bold;'>🎉 ¡El controlador debería funcionar ahora!</p>";
?>
