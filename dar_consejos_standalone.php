<?php
// Vista standalone de dar consejos para testing
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dar Consejos - HealthMate (Standalone)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">';

echo '<div class="max-w-4xl mx-auto">';
echo '<div class="bg-white rounded-lg shadow-lg p-8">';
echo '<div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg p-8 text-white mb-6">';
echo '<h1 class="text-4xl font-bold mb-2">✍️ Compartir Consejos</h1>';
echo '<p class="text-orange-100 text-lg">Comparte tu conocimiento médico</p>';
echo '</div>';

// Formulario
echo '<form class="space-y-6">';
echo '<div>';
echo '<label class="block text-sm font-medium text-gray-700 mb-2">Título del Consejo</label>';
echo '<input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Ej: Importancia de la actividad física">';
echo '</div>';

echo '<div>';
echo '<label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>';
echo '<select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">';
echo '<option>Alimentación</option>';
echo '<option>Actividad Física</option>';
echo '<option>Bienestar Mental</option>';
echo '<option>Prevención Médica</option>';
echo '<option>Hidratación</option>';
echo '<option>Sueño y Descanso</option>';
echo '</select></div>';

echo '<div>';
echo '<label class="block text-sm font-medium text-gray-700 mb-2">Contenido del Consejo</label>';
echo '<textarea rows="8" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Escribe aquí el contenido completo de tu consejo médico..."></textarea>';
echo '<p class="text-sm text-gray-500 mt-1">Escribe información clara, precisa y útil para los pacientes.</p>';
echo '</div>';

echo '<div>';
echo '<label class="block text-sm font-medium text-gray-700 mb-2">Imagen (opcional)</label>';
echo '<div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition">';
echo '<div class="space-y-2">';
echo '<i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>';
echo '<div class="text-sm">';
echo '<span class="text-blue-600 hover:text-blue-800 font-medium cursor-pointer">Haz clic para subir</span>';
echo '<span class="text-gray-500"> o arrastra y suelta</span>';
echo '</div>';
echo '<p class="text-xs text-gray-500">PNG, JPG hasta 10MB</p>';
echo '</div></div></div>';

echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-6">';
echo '<div>';
echo '<label class="block text-sm font-medium text-gray-700 mb-2">Visibilidad</label>';
echo '<div class="space-y-2">';
echo '<label class="flex items-center"><input type="radio" name="visibilidad" checked class="text-blue-600"> <span class="ml-2 text-sm">Público</span></label>';
echo '<label class="flex items-center"><input type="radio" name="visibilidad" class="text-blue-600"> <span class="ml-2 text-sm">Privado</span></label>';
echo '</div></div>';

echo '<div>';
echo '<label class="block text-sm font-medium text-gray-700 mb-2">Programar Publicación</label>';
echo '<input type="datetime-local" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">';
echo '<p class="text-sm text-gray-500 mt-1">Opcional - se publicará inmediatamente si no se selecciona</p>';
echo '</div></div>';

echo '<div>';
echo '<label class="block text-sm font-medium text-gray-700 mb-2">Etiquetas</label>';
echo '<input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="salud, bienestar, prevención">';
echo '<p class="text-sm text-gray-500 mt-1">Separa las etiquetas con comas</p>';
echo '</div>';

// Acciones
echo '<div class="flex items-center justify-between pt-6 border-t border-gray-200">';
echo '<button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium">Cancelar</button>';
echo '<div class="flex space-x-3">';
echo '<button type="button" class="px-6 py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 font-medium">Guardar Borrador</button>';
echo '<button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">Publicar Consejo</button>';
echo '</div></div>';

echo '</form>';

// Borradores
echo '<div class="bg-white rounded-lg shadow-sm p-6">';
echo '<div class="flex items-center justify-between mb-4">';
echo '<h3 class="text-lg font-semibold text-gray-800">Borradores</h3>';
echo '<span class="text-sm text-gray-500">3 guardados</span>';
echo '</div>';
echo '<div class="space-y-3">';
echo '<div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">';
echo '<div><h4 class="font-medium text-gray-800">Beneficios del sueño reparador</h4>';
echo '<p class="text-sm text-gray-500">Última edición: 15/01/2024</p></div>';
echo '<div class="flex space-x-2">';
echo '<button class="px-3 py-1 text-sm bg-blue-600 text-white rounded-md">Continuar</button>';
echo '<button class="px-3 py-1 text-sm text-red-600 rounded-md">Eliminar</button>';
echo '</div></div></div></div>';

echo '<div class="bg-green-50 border border-green-200 rounded-lg p-4">';
echo '<h3 class="font-semibold text-green-800 mb-2">✅ Vista funcionando correctamente</h3>';
echo '<p class="text-green-700 text-sm">Este es el formulario standalone para crear consejos. El layout completo está disponible en:</p>';
echo '<p class="text-green-600 text-sm font-mono mt-1">/doctor/dar_consejos?debug=1</p>';
echo '</div>';

echo '</div></div></body></html>';
?>
