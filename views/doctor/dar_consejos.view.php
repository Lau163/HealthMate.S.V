<?php
// Configurar variables para el layout
$title = 'Dar Consejos - HealthMate';
$pageTitle = 'DAR CONSEJOS';

// Obtener categorías disponibles (ya configuradas por el controlador)
$categorias = $categorias ?? [
    'Alimentación', 'Actividad Física', 'Bienestar Mental',
    'Prevención Médica', 'Hidratación', 'Sueño y Descanso'
];

// Obtener datos del formulario si existe
$formData = $formData ?? [];
$errors = $errors ?? [];
?>

<!-- Dar Consejos Content -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-500 to-cyan-600 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Compartir Consejos</h1>
                <p class="text-blue-100 text-lg">Comparte tu conocimiento médico y promueve la salud</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-bullhorn text-6xl text-blue-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Formulario para crear consejo -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Crear Nuevo Consejo</h2>
            <p class="text-gray-600">Comparte información valiosa con tus pacientes y la comunidad</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500">
                <div class="flex">
                    <i class="fas fa-exclamation-triangle text-red-500 mt-0.5 mr-3"></i>
                    <div>
                        <h3 class="text-red-800 font-medium">Por favor corrige los siguientes errores:</h3>
                        <ul class="text-red-700 text-sm mt-1">
                            <?php foreach ($errors as $error): ?>
                                <li>• <?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <form action="<?php echo BASE_URL; ?>doctor/dar_consejos" method="POST" enctype="multipart/form-data" class="space-y-6">
            <!-- Título -->
            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">
                    Título del Consejo *
                </label>
                <input type="text"
                       id="titulo"
                       name="titulo"
                       value="<?php echo htmlspecialchars($formData['titulo'] ?? ''); ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                       placeholder="Ej: Importancia de la actividad física regular"
                       required>
            </div>

            <!-- Categoría -->
            <div>
                <label for="categoria" class="block text-sm font-medium text-gray-700 mb-2">
                    Categoría *
                </label>
                <select id="categoria"
                        name="categoria"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        required>
                    <option value="">Selecciona una categoría</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo htmlspecialchars($categoria); ?>"
                                <?php echo (isset($formData['categoria']) && $formData['categoria'] === $categoria) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($categoria); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Contenido -->
            <div>
                <label for="contenido" class="block text-sm font-medium text-gray-700 mb-2">
                    Contenido del Consejo *
                </label>
                <textarea id="contenido"
                          name="contenido"
                          rows="8"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                          placeholder="Escribe aquí el contenido completo de tu consejo médico..."
                          required><?php echo htmlspecialchars($formData['contenido'] ?? ''); ?></textarea>
                <p class="text-sm text-gray-500 mt-1">Escribe información clara, precisa y útil para los pacientes.</p>
            </div>

            <!-- Imagen -->
            <div>
                <label for="imagen" class="block text-sm font-medium text-gray-700 mb-2">
                    Imagen (opcional)
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                    <div class="space-y-2">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                        <div class="text-sm">
                            <label for="imagen" class="cursor-pointer text-blue-600 hover:text-blue-800 font-medium">
                                Haz clic para subir
                            </label>
                            <span class="text-gray-500"> o arrastra y suelta</span>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG hasta 10MB</p>
                    </div>
                    <input type="file"
                           id="imagen"
                           name="imagen"
                           accept="image/*"
                           class="hidden">
                </div>
            </div>

            <!-- Opciones adicionales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Visibilidad -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Visibilidad
                    </label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio"
                                   name="visibilidad"
                                   value="publico"
                                   class="text-blue-600 focus:ring-blue-500"
                                   <?php echo (isset($formData['visibilidad']) && $formData['visibilidad'] === 'publico') || !isset($formData['visibilidad']) ? 'checked' : ''; ?>>
                            <span class="ml-2 text-sm text-gray-700">Público - Visible para todos</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio"
                                   name="visibilidad"
                                   value="privado"
                                   class="text-blue-600 focus:ring-blue-500"
                                   <?php echo (isset($formData['visibilidad']) && $formData['visibilidad'] === 'privado') ? 'checked' : ''; ?>>
                            <span class="ml-2 text-sm text-gray-700">Privado - Solo para mis pacientes</span>
                        </label>
                    </div>
                </div>

                <!-- Programar publicación -->
                <div>
                    <label for="fecha_publicacion" class="block text-sm font-medium text-gray-700 mb-2">
                        Programar Publicación (opcional)
                    </label>
                    <input type="datetime-local"
                           id="fecha_publicacion"
                           name="fecha_publicacion"
                           value="<?php echo htmlspecialchars($formData['fecha_publicacion'] ?? ''); ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    <p class="text-sm text-gray-500 mt-1">Si no seleccionas fecha, se publicará inmediatamente</p>
                </div>
            </div>

            <!-- Tags -->
            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">
                    Etiquetas (opcional)
                </label>
                <input type="text"
                       id="tags"
                       name="tags"
                       value="<?php echo htmlspecialchars($formData['tags'] ?? ''); ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                       placeholder="Ej: salud, bienestar, prevención, ejercicio">
                <p class="text-sm text-gray-500 mt-1">Separa las etiquetas con comas</p>
            </div>

            <!-- Acciones -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <button type="button"
                        onclick="window.history.back()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition duration-150">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>

                <div class="flex space-x-3">
                    <button type="button"
                            class="px-6 py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 font-medium transition duration-150">
                        <i class="fas fa-save mr-2"></i>Guardar Borrador
                    </button>
                    <button type="submit"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition duration-150">
                        <i class="fas fa-paper-plane mr-2"></i>Publicar Consejo
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Consejos en borrador -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Borradores</h3>
            <span class="text-sm text-gray-500">3 guardados</span>
        </div>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div class="flex-1">
                    <h4 class="font-medium text-gray-800">Beneficios del sueño reparador</h4>
                    <p class="text-sm text-gray-500">Última edición: 15/01/2024</p>
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Continuar
                    </button>
                    <button class="px-3 py-1 text-sm text-red-600 hover:bg-red-50 rounded-md">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Consejos publicados recientemente -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Publicados Recientemente</h3>
            <a href="<?php echo BASE_URL; ?>doctor/consejos/mis-consejos" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Ver todos <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div class="h-32 bg-gradient-to-br from-blue-500 to-purple-600"></div>
                <div class="p-3">
                    <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">Alimentación</span>
                    <h4 class="font-medium text-gray-800 mt-2">Dieta Mediterránea</h4>
                    <p class="text-sm text-gray-500">15/01/2024</p>
                </div>
            </div>
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div class="h-32 bg-gradient-to-br from-green-500 to-teal-600"></div>
                <div class="p-3">
                    <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Ejercicio</span>
                    <h4 class="font-medium text-gray-800 mt-2">Cardio en casa</h4>
                    <p class="text-sm text-gray-500">12/01/2024</p>
                </div>
            </div>
        </div>
    </div>
</div>
