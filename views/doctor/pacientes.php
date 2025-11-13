<?php
// Configurar variables para el layout
$title = 'Gestión de Pacientes - HealthMate';
$pageTitle = 'GESTIÓN DE PACIENTES';

// Obtener datos de pacientes desde el controlador
$pacientes = $pacientes ?? [];
$totalPacientes = $totalPacientes ?? 0;
?>

<!-- Gestión de Pacientes Content -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-500 to-cyan-600 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Gestión de Pacientes</h1>
                <p class="text-blue-100 text-lg">Administra información y historial médico de tus pacientes</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-users text-6xl text-blue-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Pacientes</p>
                    <p class="text-3xl font-bold text-blue-600"><?php echo $totalPacientes; ?></p>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Activos</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo count(array_filter($pacientes, fn($p) => $p['estado'] === 'Activo')); ?></p>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-user-check text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pendientes</p>
                    <p class="text-3xl font-bold text-yellow-600"><?php echo count(array_filter($pacientes, fn($p) => $p['estado'] === 'Pendiente')); ?></p>
                </div>
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Este Mes</p>
                    <p class="text-3xl font-bold text-purple-600"><?php echo $totalPacientes; ?></p>
                </div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-calendar-plus text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones principales -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Lista de Pacientes</h2>
                <p class="text-gray-600">Gestiona la información de tus pacientes</p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition duration-200">
                    <i class="fas fa-download mr-2"></i>Exportar
                </button>
                <button onclick="location.href='<?php echo BASE_URL; ?>doctor/pacientes/nuevo?debug=1'"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Nuevo Paciente
                </button>
            </div>
        </div>

        <!-- Filtros -->
        <div class="mb-6 flex flex-wrap gap-4">
            <div class="flex-1 min-w-48">
                <input type="text"
                       placeholder="Buscar por nombre, email..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Todos los estados</option>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
                <option value="pendiente">Pendiente</option>
            </select>
            <button class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition duration-200">
                <i class="fas fa-filter mr-2"></i>Filtros
            </button>
        </div>

        <!-- Tabla de pacientes -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Paciente
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Información
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Última Visita
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($pacientes)): ?>
                        <?php foreach ($pacientes as $paciente): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center">
                                                <span class="text-sm font-medium text-white">
                                                    <?php echo strtoupper(substr($paciente['nombre'], 0, 2)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php echo htmlspecialchars($paciente['nombre']); ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <?php echo htmlspecialchars($paciente['email']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <?php echo htmlspecialchars($paciente['edad']); ?> años
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <?php echo htmlspecialchars($paciente['telefono']); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        <?php echo $paciente['estado'] === 'Activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo htmlspecialchars($paciente['estado']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo htmlspecialchars($paciente['ultima_visita']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <button class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                <i class="fas fa-users text-4xl mb-2"></i>
                                <p>No hay pacientes registrados</p>
                                <button onclick="location.href='<?php echo BASE_URL; ?>doctor/pacientes/nuevo?debug=1'"
                                        class="mt-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                                    <i class="fas fa-plus mr-2"></i>Agregar Primer Paciente
                                </button>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Accesos rápidos -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">🚀 Accesos Rápidos</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/pacientes/nuevo?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                <i class="fas fa-plus text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nuevo Paciente</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/consultas?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
                <i class="fas fa-calendar-alt text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Agenda</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/recetas?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition">
                <i class="fas fa-prescription-bottle text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Recetas</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/estadisticas?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                <i class="fas fa-chart-bar text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Estadísticas</span>
            </button>
        </div>
    </div>
</div>
