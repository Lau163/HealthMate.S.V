<?php
// Página principal con enlaces a todas las vistas
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthMate - Vistas del Doctor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen py-8">';

echo '<div class="max-w-4xl mx-auto px-4">';
echo '<div class="bg-white rounded-lg shadow-lg p-8">';
echo '<div class="text-center mb-8">';
echo '<h1 class="text-4xl font-bold text-gray-800 mb-4">🏥 HealthMate - Panel del Doctor</h1>';
echo '<p class="text-gray-600 text-lg">Sistema de vistas refactorizadas y mejoradas</p>';
echo '</div>';

echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';

// Dashboard
echo '<div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-6 text-white">';
echo '<div class="flex items-center justify-between mb-4">';
echo '<h3 class="text-xl font-bold">📊 Dashboard</h3>';
echo '<i class="fas fa-tachometer-alt text-3xl opacity-75"></i>';
echo '</div>';
echo '<p class="mb-4">Panel principal con KPIs y acciones rápidas</p>';
echo '<div class="space-y-2">';
echo '<a href="' . URL . 'doctor?debug=1" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Con Layout</a>';
echo '<a href="dashboard_standalone.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Standalone</a>';
echo '</div></div>';

// Estadísticas
echo '<div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-6 text-white">';
echo '<div class="flex items-center justify-between mb-4">';
echo '<h3 class="text-xl font-bold">📈 Estadísticas</h3>';
echo '<i class="fas fa-chart-line text-3xl opacity-75"></i>';
echo '</div>';
echo '<p class="mb-4">Gráficos y métricas del consultorio</p>';
echo '<div class="space-y-2">';
echo '<a href="' . URL . 'doctor/estadisticas?debug=1" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Con Layout</a>';
echo '<a href="estadisticas_standalone.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Standalone</a>';
echo '</div></div>';

// Historial Clínico
echo '<div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-6 text-white">';
echo '<div class="flex items-center justify-between mb-4">';
echo '<h3 class="text-xl font-bold">📋 Historial</h3>';
echo '<i class="fas fa-file-medical text-3xl opacity-75"></i>';
echo '</div>';
echo '<p class="mb-4">Historial médico de pacientes</p>';
echo '<div class="space-y-2">';
echo '<a href="' . URL . 'doctor/historial?debug=1" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Con Layout</a>';
echo '<a href="estadisticas_standalone.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Standalone</a>';
echo '<a href="historial_standalone.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Standalone</a>';
echo '</div></div>';

// Consejos
echo '<div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg p-6 text-white">';
echo '<div class="flex items-center justify-between mb-4">';
echo '<h3 class="text-xl font-bold">💡 Consejos</h3>';
echo '<i class="fas fa-heart text-3xl opacity-75"></i>';
echo '</div>';
echo '<p class="mb-4">Sistema de consejos médicos</p>';
echo '<div class="space-y-2">';
echo '<a href="' . URL . 'doctor/consejos?debug=1" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Con Layout</a>';
echo '<a href="consejos_standalone.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Standalone</a>';
echo '</div></div>';

// Dar Consejos
echo '<div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-6 text-white">';
echo '<div class="flex items-center justify-between mb-4">';
echo '<h3 class="text-xl font-bold">✍️ Dar Consejos</h3>';
echo '<i class="fas fa-bullhorn text-3xl opacity-75"></i>';
echo '</div>';
echo '<p class="mb-4">Formulario para crear consejos</p>';
echo '<div class="space-y-2">';
echo '<a href="' . URL . 'doctor/dar_consejos?debug=1" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Con Layout</a>';
echo '<a href="dar_consejos_standalone.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Standalone</a>';
echo '</div></div>';

// Debug
echo '<div class="bg-gradient-to-br from-gray-500 to-gray-600 rounded-lg p-6 text-white">';
echo '<div class="flex items-center justify-between mb-4">';
echo '<h3 class="text-xl font-bold">🔧 Debug</h3>';
echo '<i class="fas fa-tools text-3xl opacity-75"></i>';
echo '</div>';
echo '<p class="mb-4">Herramientas de diagnóstico</p>';
echo '<div class="space-y-2">';
echo '<a href="debug.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Script Debug</a>';
echo '<a href="test_controller.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Test Controller</a>';
echo '<a href="test_views.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Test Views</a>';
echo '<a href="test_completo.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Test Completo</a>';
echo '<a href="quick_test.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Test Rápido</a>';
echo '<a href="final_fix_test.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Corrección Final</a>';
echo '<a href="dashboard_test.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Test Dashboard</a>';
echo '<a href="historial_test.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Test Historial</a>';
echo '<a href="sidebar_test.php" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Test Sidebar</a>';
echo '<a href="views/doctor/README.md" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded px-3 py-2 text-sm font-medium transition">Documentación</a>';
echo '</div></div>';

echo '</div>';

echo '<div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">';
echo '<h3 class="font-semibold text-yellow-800 mb-3">📋 Instrucciones de Uso</h3>';
echo '<div class="text-yellow-700 text-sm space-y-2">';
echo '<p><strong>✅ Con Layout:</strong> Vistas completas con sidebar, header y navegación</p>';
echo '<p><strong>✅ Standalone:</strong> Versiones simplificadas para testing rápido</p>';
echo '<p><strong>✅ Debug:</strong> El parámetro ?debug=1 simula autenticación</p>';
echo '<p><strong>⚠️ Importante:</strong> Asegúrate de que XAMPP esté ejecutándose</p>';
echo '</div>';
echo '</div>';

echo '<div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mt-6">';
echo '<h3 class="font-semibold text-blue-800 mb-3">🔗 URLs Directas</h3>';
echo '<div class="text-blue-700 text-sm font-mono space-y-1">';
echo '<p><a href="' . URL . 'doctor/estadisticas?debug=1" class="hover:underline">' . URL . 'doctor/estadisticas?debug=1</a></p>';
echo '<p><a href="' . URL . 'doctor/consejos?debug=1" class="hover:underline">' . URL . 'doctor/consejos?debug=1</a></p>';
echo '<p><a href="' . URL . 'doctor/dar_consejos?debug=1" class="hover:underline">' . URL . 'doctor/dar_consejos?debug=1</a></p>';
echo '<p><a href="' . URL . 'debug.php" class="hover:underline">' . URL . 'debug.php</a></p>';
echo '</div>';
echo '</div>';

echo '</div></div></body></html>';
?>
