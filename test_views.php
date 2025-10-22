<?php
// Script de prueba rápido para verificar que las vistas funcionan
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "<h1>🔍 Prueba Rápida de Vistas</h1>";

// Simular datos del controlador
$estadisticas = [
    'totalPacientes' => 150,
    'citasMes' => 320,
    'ingresosMensuales' => 45000,
    'satisfaccion' => 4.8,
    'citasPendientes' => 25,
    'citasCompletadas' => 295
];

$datosGraficos = [
    'mensual' => [
        'enero' => 45, 'febrero' => 52, 'marzo' => 48, 'abril' => 61,
        'mayo' => 55, 'junio' => 67, 'julio' => 58, 'agosto' => 63,
        'septiembre' => 71, 'octubre' => 69, 'noviembre' => 74, 'diciembre' => 78
    ],
    'especialidades' => [
        'Medicina General' => 35,
        'Cardiología' => 25,
        'Dermatología' => 15,
        'Pediatría' => 15,
        'Ginecología' => 10
    ]
];

$consejos = [
    [
        'id' => 1,
        'titulo' => 'Importancia de la Hidratación',
        'categoria' => 'Hidratación',
        'contenido' => 'Mantenerse hidratado es fundamental para el funcionamiento óptimo del cuerpo humano.',
        'autor' => 'Dr. María González',
        'fecha' => '2024-01-15',
        'imagen' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=300&fit=crop'
    ]
];

$categorias = ['Alimentación', 'Actividad Física', 'Bienestar Mental', 'Prevención Médica', 'Hidratación', 'Sueño y Descanso'];
$consejoActual = 0;

echo "<h2>✅ Probando Estadísticas</h2>";
echo "<p style='color: green;'>Variables configuradas correctamente</p>";

// Probar el método renderWithLayout directamente
echo "<h2>🔧 Probando renderWithLayout</h2>";

function renderWithLayout($viewName, $data = []) {
    // Hacer disponibles las variables del controlador
    extract($data, EXTR_SKIP);

    // Obtener el contenido de la vista específica
    ob_start();
    include 'views/doctor/' . $viewName . '.view.php';
    $content = ob_get_clean();

    // Incluir el layout base
    include 'views/doctor/layout.php';
}

try {
    echo "<h3>📊 Vista de Estadísticas:</h3>";
    renderWithLayout('estadisticas', compact('estadisticas', 'datosGraficos'));

    echo "<h3>💡 Vista de Consejos:</h3>";
    renderWithLayout('consejos', compact('consejos', 'categorias', 'consejoActual'));

    echo "<h3>✍️ Vista de Dar Consejos:</h3>";
    renderWithLayout('dar_consejos', compact('categorias'));

} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p style='color: blue; font-weight: bold;'>🎉 ¡Todas las vistas deberían estar funcionando ahora!</p>";
echo "<p>Ve a estas URLs para probar:</p>";
echo "<ul>";
echo "<li><a href='doctor/estadisticas?debug=1' target='_blank'>doctor/estadisticas?debug=1</a></li>";
echo "<li><a href='doctor/consejos?debug=1' target='_blank'>doctor/consejos?debug=1</a></li>";
echo "<li><a href='doctor/dar_consejos?debug=1' target='_blank'>doctor/dar_consejos?debug=1</a></li>";
echo "</ul>";
?>
