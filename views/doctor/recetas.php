<?php
// Configurar variables para el layout
$title = 'Gestión de Recetas - HealthMate';
$pageTitle = 'GESTIÓN DE RECETAS';

// Obtener datos de recetas desde el controlador
$recetas = $recetas ?? [];
$totalRecetas = $totalRecetas ?? 0;
?>

<!-- Gestión de Recetas Content -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Gestión de Recetas</h1>
                <p class="text-orange-100 text-lg">Gestiona prescripciones médicas y tratamientos</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-prescription-bottle text-6xl text-orange-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Recetas</p>
                    <p class="text-3xl font-bold text-orange-600"><?php echo $totalRecetas; ?></p>
                </div>
                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                    <i class="fas fa-prescription-bottle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Activas</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo count(array_filter($recetas, fn($r) => $r['estado'] === 'Activa')); ?></p>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Completadas</p>
                    <p class="text-3xl font-bold text-blue-600"><?php echo count(array_filter($recetas, fn($r) => $r['estado'] === 'Completada')); ?></p>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-clipboard-check text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Este Mes</p>
                    <p class="text-3xl font-bold text-purple-600"><?php echo count(array_filter($recetas, function($r) {
                        return strtotime($r['fecha']) >= strtotime(date('Y-m-01'));
                    })); ?></p>
                </div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-calendar-plus text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de recetas -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Lista de Recetas</h2>
                <p class="text-gray-600">Gestiona las prescripciones médicas de tus pacientes</p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium transition duration-200">
                    <i class="fas fa-download mr-2"></i>Exportar
                </button>
                <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Nueva Receta
                </button>
            </div>
        </div>

        <!-- Filtros -->
        <div class="mb-6 flex flex-wrap gap-4">
            <div class="flex-1 min-w-48">
                <input type="text"
                       placeholder="Buscar por paciente, medicamento..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
            </div>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                <option value="">Todos los estados</option>
                <option value="activa">Activa</option>
                <option value="completada">Completada</option>
                <option value="cancelada">Cancelada</option>
            </select>
            <button class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition duration-200">
                <i class="fas fa-filter mr-2"></i>Filtros
            </button>
        </div>

        <!-- Tabla de recetas -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Paciente
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Medicamentos
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Doctor
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($recetas)): ?>
                        <?php foreach ($recetas as $receta): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center">
                                                <span class="text-sm font-medium text-white">
                                                    <?php echo strtoupper(substr($receta['paciente'], 0, 2)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php echo htmlspecialchars($receta['paciente']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo htmlspecialchars($receta['fecha']); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs truncate">
                                        <?php echo htmlspecialchars($receta['medicamentos']); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        <?php
                                        echo match($receta['estado']) {
                                            'Activa' => 'bg-green-100 text-green-800',
                                            'Completada' => 'bg-blue-100 text-blue-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                        ?>">
                                        <?php echo htmlspecialchars($receta['estado']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo htmlspecialchars($receta['doctor']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <button class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-print"></i>
                                        </button>
                                        <button class="text-orange-600 hover:text-orange-900">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <?php if ($receta['estado'] === 'Activa'): ?>
                                            <button class="text-green-600 hover:text-green-900">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                <i class="fas fa-prescription-bottle text-4xl mb-2"></i>
                                <p>No hay recetas registradas</p>
                                <button class="mt-2 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium">
                                    <i class="fas fa-plus mr-2"></i>Crear Primera Receta
                                </button>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recetas recientes -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">📋 Recetas Recientes</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            $recetasRecientes = array_slice($recetas, 0, 6);
            ?>
            <?php if (!empty($recetasRecientes)): ?>
                <?php foreach ($recetasRecientes as $receta): ?>
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-medium text-gray-800">
                                <?php echo htmlspecialchars($receta['paciente']); ?>
                            </h4>
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                <?php
                                echo match($receta['estado']) {
                                    'Activa' => 'bg-green-100 text-green-800',
                                    'Completada' => 'bg-blue-100 text-blue-800',
                                    default => 'bg-gray-100 text-gray-800'
                                };
                                ?>">
                                <?php echo htmlspecialchars($receta['estado']); ?>
                            </span>
                        </div>
                        <div class="text-sm text-gray-600 mb-3">
                            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($receta['fecha']); ?></p>
                            <p><strong>Doctor:</strong> <?php echo htmlspecialchars($receta['doctor']); ?></p>
                        </div>
                        <div class="text-sm text-gray-700 bg-gray-50 p-2 rounded">
                            <?php echo htmlspecialchars(substr($receta['medicamentos'], 0, 80)) . '...'; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-8">
                    <i class="fas fa-prescription-bottle text-4xl text-gray-300 mb-2"></i>
                    <p class="text-gray-500">No hay recetas recientes</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Accesos rápidos -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">🚀 Accesos Rápidos</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/recetas/nueva?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition">
                <i class="fas fa-plus text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nueva Receta</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/medicamentos?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-yellow-500 hover:bg-yellow-50 transition">
                <i class="fas fa-pills text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Medicamentos</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/pacientes?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                <i class="fas fa-users text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Pacientes</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/estadisticas?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                <i class="fas fa-chart-bar text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Reportes</span>
            </button>
        </div>
    </div>
</div>
