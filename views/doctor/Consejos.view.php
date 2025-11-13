<?php
// Configurar variables para el layout
$title = 'Consejos Médicos - HealthMate';
$pageTitle = 'CONSEJOS MÉDICOS';

// Obtener datos para los consejos (ya configurados por el controlador)
$consejos = $consejos ?? [
    [
        'id' => 1,
        'titulo' => 'Importancia de la Hidratación',
        'categoria' => 'Hidratación',
        'contenido' => 'Mantenerse hidratado es fundamental para el funcionamiento óptimo del cuerpo humano. Se recomienda consumir al menos 8 vasos de agua al día, especialmente durante épocas de calor o cuando se realiza actividad física.',
        'autor' => 'Dr. María González',
        'fecha' => '2024-01-15',
        'imagen' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=300&fit=crop'
    ],
    [
        'id' => 2,
        'titulo' => 'Beneficios del Ejercicio Regular',
        'categoria' => 'Actividad Física',
        'contenido' => 'Realizar actividad física regular mejora la salud cardiovascular, fortalece los músculos y huesos, y contribuye significativamente al bienestar mental. Se recomienda al menos 30 minutos de ejercicio moderado 5 días a la semana.',
        'autor' => 'Dr. Carlos Rodríguez',
        'fecha' => '2024-01-10',
        'imagen' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=300&fit=crop'
    ],
    [
        'id' => 3,
        'titulo' => 'Alimentación Saludable',
        'categoria' => 'Alimentación',
        'contenido' => 'Una dieta equilibrada rica en frutas, verduras, proteínas magras y granos enteros es esencial para mantener una buena salud. Los colores en los alimentos indican diferentes nutrientes que el cuerpo necesita.',
        'autor' => 'Dra. Ana López',
        'fecha' => '2024-01-08',
        'imagen' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=400&h=300&fit=crop'
    ]
];

$categorias = $categorias ?? ['Alimentación', 'Actividad Física', 'Bienestar Mental', 'Prevención Médica', 'Hidratación', 'Sueño y Descanso'];
$consejoActual = $consejoActual ?? 0;
?>

<!-- Consejos Médicos Content -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-500 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">💡 Consejos Médicos</h1>
                <p class="text-pink-100 text-lg">Promoviendo la vida saludable</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-heart text-6xl text-pink-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Consejo Destacado -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div class="relative">
                <img src="<?php echo $consejos[$consejoActual]['imagen']; ?>"
                     alt="<?php echo $consejos[$consejoActual]['titulo']; ?>"
                     class="w-full h-96 object-cover rounded-lg shadow-lg">
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 bg-emerald-600 text-white text-sm font-medium rounded-full">
                        <?php echo $consejos[$consejoActual]['categoria']; ?>
                    </span>
                </div>
            </div>
            <div class="space-y-4">
                <h3 class="text-2xl font-bold text-gray-800"><?php echo $consejos[$consejoActual]['titulo']; ?></h3>
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <i class="fas fa-user-md mr-2"></i>
                    <span>Por <?php echo $consejos[$consejoActual]['autor']; ?></span>
                    <span class="mx-2">•</span>
                    <i class="fas fa-calendar mr-2"></i>
                    <span><?php echo date('d/m/Y', strtotime($consejos[$consejoActual]['fecha'])); ?></span>
                </div>
                <div class="text-gray-700 leading-relaxed">
                    <p><?php echo $consejos[$consejoActual]['contenido']; ?></p>
                </div>
                <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
                    <button class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition">
                        <i class="fas fa-share mr-2"></i>Compartir
                    </button>
                    <button class="flex items-center px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md text-sm font-medium transition">
                        <i class="fas fa-heart mr-2"></i>Me gusta
                    </button>
                    <button class="flex items-center px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md text-sm font-medium transition">
                        <i class="fas fa-comment mr-2"></i>Comentarios
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Categorías -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Categorías</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <?php foreach ($categorias as $categoria): ?>
                <button class="p-4 border-2 border-gray-200 rounded-lg hover:border-emerald-500 hover:bg-emerald-50 transition text-center">
                    <div class="text-2xl mb-2">
                        <?php
                        $iconos = [
                            'Alimentación' => 'fas fa-apple-alt text-red-500',
                            'Actividad Física' => 'fas fa-running text-blue-500',
                            'Bienestar Mental' => 'fas fa-brain text-purple-500',
                            'Prevención Médica' => 'fas fa-shield-alt text-green-500',
                            'Hidratación' => 'fas fa-tint text-blue-400',
                            'Sueño y Descanso' => 'fas fa-moon text-indigo-500'
                        ];
                        echo '<i class="' . ($iconos[$categoria] ?? 'fas fa-heart text-gray-500') . '"></i>';
                        ?>
                    </div>
                    <div class="text-sm font-medium text-gray-700"><?php echo $categoria; ?></div>
                </button>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Consejos Recientes -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Consejos Recientes</h3>
            <a href="<?php echo BASE_URL; ?>doctor/consejos/todos" class="text-emerald-600 hover:text-emerald-800 text-sm font-medium">Ver todos</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($consejos as $consejo): ?>
                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition">
                    <img src="<?php echo $consejo['imagen']; ?>"
                         alt="<?php echo $consejo['titulo']; ?>"
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-medium rounded-full">
                            <?php echo $consejo['categoria']; ?>
                        </span>
                        <h4 class="font-semibold text-gray-800 mt-2 mb-2"><?php echo $consejo['titulo']; ?></h4>
                        <p class="text-gray-600 text-sm mb-3"><?php echo substr($consejo['contenido'], 0, 100) . '...'; ?></p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span><?php echo $consejo['autor']; ?></span>
                            <span><?php echo date('d/m/Y', strtotime($consejo['fecha'])); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Acciones -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Contribuir con la Comunidad</h3>
                <p class="text-gray-600">Comparte tu conocimiento médico con otros profesionales y pacientes</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="<?php echo BASE_URL; ?>doctor/dar_consejos"
                   class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md font-medium transition">
                    <i class="fas fa-plus mr-2"></i>Crear Nuevo Consejo
                </a>
            </div>
        </div>
    </div>
</div>