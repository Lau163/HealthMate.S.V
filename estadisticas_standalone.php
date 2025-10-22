<?php
// Vista standalone de estadísticas para testing
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas - HealthMate (Standalone)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">';

echo '<div class="max-w-7xl mx-auto">';
echo '<div class="bg-white rounded-lg shadow-lg p-8 mb-6">';
echo '<h1 class="text-4xl font-bold text-gray-800 mb-4">📊 Estadísticas y Gráficos</h1>';
echo '<p class="text-gray-600 mb-6">Vista refactorizada funcionando correctamente</p>';

// KPIs
echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">';
echo '<div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-500">';
echo '<div class="flex items-center justify-between">';
echo '<div><p class="text-sm font-medium text-gray-600">Total Pacientes</p><p class="text-3xl font-bold text-blue-600">150</p></div>';
echo '<div class="p-3 rounded-full bg-blue-100 text-blue-600"><i class="fas fa-users text-2xl"></i></div>';
echo '</div></div>';

echo '<div class="bg-green-50 p-6 rounded-lg border-l-4 border-green-500">';
echo '<div class="flex items-center justify-between">';
echo '<div><p class="text-sm font-medium text-gray-600">Citas del Mes</p><p class="text-3xl font-bold text-green-600">320</p></div>';
echo '<div class="p-3 rounded-full bg-green-100 text-green-600"><i class="fas fa-calendar-check text-2xl"></i></div>';
echo '</div></div>';

echo '<div class="bg-yellow-50 p-6 rounded-lg border-l-4 border-yellow-500">';
echo '<div class="flex items-center justify-between">';
echo '<div><p class="text-sm font-medium text-gray-600">Ingresos</p><p class="text-3xl font-bold text-yellow-600">$45,000</p></div>';
echo '<div class="p-3 rounded-full bg-yellow-100 text-yellow-600"><i class="fas fa-dollar-sign text-2xl"></i></div>';
echo '</div></div>';

echo '<div class="bg-purple-50 p-6 rounded-lg border-l-4 border-purple-500">';
echo '<div class="flex items-center justify-between">';
echo '<div><p class="text-sm font-medium text-gray-600">Calificación</p><p class="text-3xl font-bold text-purple-600">4.8/5.0</p></div>';
echo '<div class="p-3 rounded-full bg-purple-100 text-purple-600"><i class="fas fa-star text-2xl"></i></div>';
echo '</div></div>';
echo '</div>';

// Gráficos de ejemplo
echo '<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">';
echo '<div class="bg-white rounded-lg shadow-sm p-6">';
echo '<h3 class="text-lg font-semibold text-gray-800 mb-6">Citas por Mes</h3>';
echo '<div class="h-64 flex items-end justify-between space-x-2">';
$meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
$valores = [45, 52, 48, 61, 55, 67, 58, 63, 71, 69, 74, 78];
for ($i = 0; $i < 12; $i++) {
    echo '<div class="flex flex-col items-center flex-1">';
    echo '<div class="w-full bg-gradient-to-t from-purple-500 to-purple-400 rounded-t-md mb-2 transition-all" style="height: ' . ($valores[$i] / 80 * 100) . '%">';
    echo '</div>';
    echo '<span class="text-xs text-gray-500">' . $meses[$i] . '</span>';
    echo '</div>';
}
echo '</div></div>';

echo '<div class="bg-white rounded-lg shadow-sm p-6">';
echo '<h3 class="text-lg font-semibold text-gray-800 mb-6">Citas por Especialidad</h3>';
echo '<div class="space-y-4">';
$especialidades = ["Medicina General" => 35, "Cardiología" => 25, "Dermatología" => 15, "Pediatría" => 15, "Ginecología" => 10];
$colors = ["bg-blue-500", "bg-green-500", "bg-yellow-500", "bg-purple-500", "bg-red-500"];
$i = 0;
foreach ($especialidades as $especialidad => $porcentaje) {
    echo '<div class="flex items-center space-x-3">';
    echo '<div class="w-4 h-4 rounded ' . $colors[$i] . '"></div>';
    echo '<div class="flex-1">';
    echo '<div class="flex justify-between items-center mb-1">';
    echo '<span class="text-sm font-medium text-gray-700">' . $especialidad . '</span>';
    echo '<span class="text-sm text-gray-500">' . $porcentaje . '%</span>';
    echo '</div>';
    echo '<div class="w-full bg-gray-200 rounded-full h-2">';
    echo '<div class="' . $colors[$i] . ' h-2 rounded-full transition-all" style="width: ' . $porcentaje . '%"></div>';
    echo '</div></div></div>';
    $i++;
}
echo '</div></div>';
echo '</div>';

echo '<div class="bg-green-50 border border-green-200 rounded-lg p-4">';
echo '<h3 class="font-semibold text-green-800 mb-2">✅ Vista funcionando correctamente</h3>';
echo '<p class="text-green-700 text-sm">Esta es la versión standalone de las estadísticas. El layout completo está disponible en:</p>';
echo '<p class="text-green-600 text-sm font-mono mt-1">/doctor/estadisticas?debug=1</p>';
echo '</div>';

echo '</div></div></body></html>';
?>
