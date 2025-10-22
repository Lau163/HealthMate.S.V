<?php
// Configurar variables para el layout
$title = 'Mensajes - HealthMate';
$pageTitle = 'MENSAJES';

// Obtener datos de mensajes desde el controlador
$mensajes = $mensajes ?? [];
$mensajesNoLeidos = $mensajesNoLeidos ?? 0;
$mensajesTotal = $mensajesTotal ?? 0;
?>

<!-- Mensajes Content -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-500 to-indigo-600 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Mensajes</h1>
                <p class="text-purple-100 text-lg">Comunicación con pacientes y gestión de consultas</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-envelope text-6xl text-purple-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Mensajes</p>
                    <p class="text-3xl font-bold text-purple-600"><?php echo $mensajesTotal; ?></p>
                </div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">No Leídos</p>
                    <p class="text-3xl font-bold text-red-600"><?php echo $mensajesNoLeidos; ?></p>
                </div>
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-envelope-open text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Leídos</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo count(array_filter($mensajes, fn($m) => $m['estado'] === 'Leído')); ?></p>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Respondidos</p>
                    <p class="text-3xl font-bold text-blue-600"><?php echo count(array_filter($mensajes, fn($m) => $m['estado'] === 'Respondido')); ?></p>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-reply text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de mensajes -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Bandeja de Entrada</h2>
                <p class="text-gray-600">Gestiona la comunicación con tus pacientes</p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium transition duration-200">
                    <i class="fas fa-paper-plane mr-2"></i>Nuevo Mensaje
                </button>
            </div>
        </div>

        <!-- Filtros -->
        <div class="mb-6 flex flex-wrap gap-4">
            <div class="flex-1 min-w-48">
                <input type="text"
                       placeholder="Buscar por remitente, asunto..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
            </div>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                <option value="">Todos los estados</option>
                <option value="no-leido">No leído</option>
                <option value="leido">Leído</option>
                <option value="respondido">Respondido</option>
            </select>
            <button class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition duration-200">
                <i class="fas fa-filter mr-2"></i>Filtros
            </button>
        </div>

        <!-- Lista de mensajes -->
        <div class="space-y-4">
            <?php if (!empty($mensajes)): ?>
                <?php foreach ($mensajes as $mensaje): ?>
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-purple-600">
                                            <?php echo strtoupper(substr($mensaje['remitente'], 0, 2)); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center space-x-2">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            <?php echo htmlspecialchars($mensaje['remitente']); ?>
                                        </p>
                                        <?php if ($mensaje['estado'] === 'No leído'): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Nuevo
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        <?php echo htmlspecialchars($mensaje['asunto']); ?>
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
                                        <?php echo htmlspecialchars(substr($mensaje['mensaje'], 0, 100)) . '...'; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="text-right">
                                    <div class="text-sm text-gray-500">
                                        <?php echo htmlspecialchars($mensaje['fecha']); ?>
                                    </div>
                                    <div class="flex items-center space-x-1 mt-1">
                                        <?php if ($mensaje['estado'] === 'No leído'): ?>
                                            <i class="fas fa-envelope text-red-500"></i>
                                        <?php elseif ($mensaje['estado'] === 'Leído'): ?>
                                            <i class="fas fa-envelope-open text-gray-400"></i>
                                        <?php else: ?>
                                            <i class="fas fa-reply text-green-500"></i>
                                        <?php endif; ?>
                                        <span class="text-xs text-gray-500 capitalize">
                                            <?php echo htmlspecialchars($mensaje['estado']); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-reply"></i>
                                    </button>
                                    <button class="text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-12">
                    <i class="fas fa-envelope text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No hay mensajes</h3>
                    <p class="text-gray-600 mb-6">Tu bandeja de entrada está vacía</p>
                    <button class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-bold transition duration-200">
                        <i class="fas fa-paper-plane mr-2"></i>Enviar Primer Mensaje
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Mensajes no leídos destacados -->
    <?php $mensajesNoLeidosList = array_filter($mensajes, fn($m) => $m['estado'] === 'No leído'); ?>
    <?php if (!empty($mensajesNoLeidosList)): ?>
        <div class="bg-red-50 border border-red-200 rounded-lg p-6">
            <div class="flex items-center mb-4">
                <i class="fas fa-envelope text-red-500 text-xl mr-3"></i>
                <h3 class="text-lg font-semibold text-red-800">Mensajes No Leídos (<?php echo count($mensajesNoLeidosList); ?>)</h3>
            </div>
            <div class="space-y-3">
                <?php foreach ($mensajesNoLeidosList as $mensaje): ?>
                    <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-red-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-red-600">
                                    <?php echo strtoupper(substr($mensaje['remitente'], 0, 1)); ?>
                                </span>
                            </div>
                            <div>
                                <span class="font-medium text-red-800"><?php echo htmlspecialchars($mensaje['remitente']); ?></span>
                                <p class="text-sm text-gray-600"><?php echo htmlspecialchars($mensaje['asunto']); ?></p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs text-red-600 font-medium"><?php echo htmlspecialchars($mensaje['fecha']); ?></span>
                            <button class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-medium">
                                Responder
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Accesos rápidos -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">🚀 Accesos Rápidos</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/mensajes/nuevo?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                <i class="fas fa-plus text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nuevo Mensaje</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/pacientes?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                <i class="fas fa-users text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Pacientes</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/consultas?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
                <i class="fas fa-calendar-alt text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Agenda</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/estadisticas?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition">
                <i class="fas fa-chart-line text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Reportes</span>
            </button>
        </div>
    </div>
</div>
