<?php
// Vista standalone de consejos para testing
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consejos Médicos - HealthMate (Standalone)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">';

echo '<div class="max-w-7xl mx-auto">';
echo '<div class="bg-white rounded-lg shadow-lg p-8 mb-6">';
echo '<div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-lg p-8 text-white mb-6">';
echo '<h1 class="text-4xl font-bold mb-2">💡 Consejos Médicos</h1>';
echo '<p class="text-pink-100 text-lg">Promoviendo la vida saludable</p>';
echo '</div>';

// Consejo actual
echo '<div class="bg-white rounded-lg shadow-sm p-6 mb-6">';
echo '<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">';
echo '<div class="relative">';
echo '<img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=300&fit=crop" alt="Hidratación" class="w-full h-96 object-cover rounded-lg shadow-lg">';
echo '<div class="absolute top-4 left-4"><span class="px-3 py-1 bg-emerald-600 text-white text-sm font-medium rounded-full">Hidratación</span></div>';
echo '</div>';
echo '<div class="space-y-4">';
echo '<h3 class="text-2xl font-bold text-gray-800">Importancia de la Hidratación</h3>';
echo '<div class="flex items-center text-sm text-gray-500 mb-4">';
echo '<i class="fas fa-user-md mr-2"></i><span>Por Dr. María González</span>';
echo '<span class="mx-2">•</span><i class="fas fa-calendar mr-2"></i><span>15/01/2024</span>';
echo '</div>';
echo '<div class="text-gray-700 leading-relaxed">';
echo '<p>Mantenerse hidratado es fundamental para el funcionamiento óptimo del cuerpo humano. Se recomienda consumir al menos 8 vasos de agua al día, especialmente durante épocas de calor o cuando se realiza actividad física.</p>';
echo '</div>';
echo '<div class="flex items-center space-x-4 pt-4 border-t border-gray-200">';
echo '<button class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition">';
echo '<i class="fas fa-share mr-2"></i>Compartir</button>';
echo '<button class="flex items-center px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md text-sm font-medium transition">';
echo '<i class="fas fa-heart mr-2"></i>Me gusta</button>';
echo '<button class="flex items-center px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md text-sm font-medium transition">';
echo '<i class="fas fa-comment mr-2"></i>Comentarios</button>';
echo '</div></div></div>';

// Categorías
echo '<div class="bg-white rounded-lg shadow-sm p-6 mb-6">';
echo '<h3 class="text-lg font-semibold text-gray-800 mb-4">Categorías</h3>';
echo '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">';
$categorias = [
    ['nombre' => 'Alimentación', 'icono' => 'fas fa-apple-alt', 'color' => 'text-red-500'],
    ['nombre' => 'Actividad Física', 'icono' => 'fas fa-running', 'color' => 'text-blue-500'],
    ['nombre' => 'Bienestar Mental', 'icono' => 'fas fa-brain', 'color' => 'text-purple-500'],
    ['nombre' => 'Prevención', 'icono' => 'fas fa-shield-alt', 'color' => 'text-green-500'],
    ['nombre' => 'Hidratación', 'icono' => 'fas fa-tint', 'color' => 'text-blue-400'],
    ['nombre' => 'Sueño', 'icono' => 'fas fa-moon', 'color' => 'text-indigo-500']
];
foreach ($categorias as $cat) {
    echo '<button class="p-4 border-2 border-gray-200 rounded-lg hover:border-emerald-500 hover:bg-emerald-50 transition text-center">';
    echo '<div class="text-2xl mb-2"><i class="' . $cat['icono'] . ' ' . $cat['color'] . '"></i></div>';
    echo '<div class="text-sm font-medium text-gray-700">' . $cat['nombre'] . '</div></button>';
}
echo '</div></div>';

// Consejos recientes
echo '<div class="bg-white rounded-lg shadow-sm p-6">';
echo '<div class="flex items-center justify-between mb-6">';
echo '<h3 class="text-lg font-semibold text-gray-800">Consejos Recientes</h3>';
echo '<a href="#" class="text-emerald-600 hover:text-emerald-800 text-sm font-medium">Ver todos</a>';
echo '</div>';
echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">';
$consejos = [
    ['titulo' => 'Ejercicio Regular', 'categoria' => 'Actividad Física', 'color' => 'bg-blue-100 text-blue-700', 'imagen' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=300&fit=crop'],
    ['titulo' => 'Dieta Saludable', 'categoria' => 'Alimentación', 'color' => 'bg-red-100 text-red-700', 'imagen' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=400&h=300&fit=crop'],
    ['titulo' => 'Sueño Reparador', 'categoria' => 'Sueño', 'color' => 'bg-indigo-100 text-indigo-700', 'imagen' => 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=400&h=300&fit=crop']
];
foreach ($consejos as $consejo) {
    echo '<div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition">';
    echo '<img src="' . $consejo['imagen'] . '" alt="' . $consejo['titulo'] . '" class="w-full h-48 object-cover">';
    echo '<div class="p-4">';
    echo '<span class="px-2 py-1 ' . $consejo['color'] . ' text-xs font-medium rounded-full">' . $consejo['categoria'] . '</span>';
    echo '<h4 class="font-semibold text-gray-800 mt-2 mb-2">' . $consejo['titulo'] . '</h4>';
    echo '<p class="text-gray-600 text-sm">Consejo sobre ' . strtolower($consejo['categoria']) . '</p>';
    echo '</div></div>';
}
echo '</div></div>';

echo '<div class="bg-green-50 border border-green-200 rounded-lg p-4">';
echo '<h3 class="font-semibold text-green-800 mb-2">✅ Vista funcionando correctamente</h3>';
echo '<p class="text-green-700 text-sm">Esta es la versión standalone de los consejos médicos. El layout completo está disponible en:</p>';
echo '<p class="text-green-600 text-sm font-mono mt-1">/doctor/consejos?debug=1</p>';
echo '</div>';

echo '</div></div></body></html>';
?>
