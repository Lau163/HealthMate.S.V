<?php
// Configurar variables para el layout
$title = 'Gestión de Medicamentos - HealthMate';
$pageTitle = 'GESTIÓN DE MEDICAMENTOS';

// Obtener datos de medicamentos desde el controlador
$medicamentos = $medicamentos ?? [];
$totalMedicamentos = $totalMedicamentos ?? 0;
?>

<!-- Gestión de Medicamentos Content -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-yellow-500 to-orange-600 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Gestión de Medicamentos</h1>
                <p class="text-yellow-100 text-lg">Controla el inventario y prescripciones de medicamentos</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-pills text-6xl text-yellow-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Medicamentos</p>
                    <p class="text-3xl font-bold text-yellow-600"><?php echo $totalMedicamentos; ?></p>
                </div>
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-pills text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">En Stock</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo array_sum(array_column($medicamentos, 'stock')); ?></p>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-boxes text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Stock Bajo</p>
                    <p class="text-3xl font-bold text-red-600"><?php echo count(array_filter($medicamentos, fn($m) => $m['stock'] < 50)); ?></p>
                </div>
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-exclamation-triangle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Valor Total</p>
                    <p class="text-3xl font-bold text-blue-600">$<?php echo number_format(array_sum(array_map(fn($m) => $m['precio'] * $m['stock'], $medicamentos)), 2); ?></p>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-dollar-sign text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de medicamentos -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Inventario de Medicamentos</h2>
                <p class="text-gray-600">Gestiona el stock y disponibilidad de medicamentos</p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-medium transition duration-200">
                    <i class="fas fa-download mr-2"></i>Exportar
                </button>
                <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Agregar Medicamento
                </button>
            </div>
        </div>

        <!-- Filtros -->
        <div class="mb-6 flex flex-wrap gap-4">
            <div class="flex-1 min-w-48">
                <input type="text"
                       placeholder="Buscar por nombre, principio activo..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
            </div>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                <option value="">Todas las categorías</option>
                <option value="analgesicos">Analgésicos</option>
                <option value="antiinflamatorios">Antiinflamatorios</option>
                <option value="antibiotico">Antibióticos</option>
            </select>
            <button class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition duration-200">
                <i class="fas fa-filter mr-2"></i>Filtros
            </button>
        </div>

        <!-- Tabla de medicamentos -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Medicamento
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Información
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Stock
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Precio
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Categoría
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($medicamentos)): ?>
                        <?php foreach ($medicamentos as $medicamento): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-yellow-500 flex items-center justify-center">
                                                <i class="fas fa-pills text-white"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php echo htmlspecialchars($medicamento['nombre']); ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <?php echo htmlspecialchars($medicamento['principio_activo']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <?php echo htmlspecialchars($medicamento['presentacion']); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium <?php echo $medicamento['stock'] < 50 ? 'text-red-600' : 'text-gray-900'; ?>">
                                            <?php echo htmlspecialchars($medicamento['stock']); ?> unidades
                                        </span>
                                        <?php if ($medicamento['stock'] < 50): ?>
                                            <i class="fas fa-exclamation-triangle text-red-500 ml-2"></i>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    $<?php echo number_format($medicamento['precio'], 2); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <?php echo htmlspecialchars($medicamento['categoria']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <button class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-plus"></i>
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
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                <i class="fas fa-pills text-4xl mb-2"></i>
                                <p>No hay medicamentos registrados</p>
                                <button class="mt-2 px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-medium">
                                    <i class="fas fa-plus mr-2"></i>Agregar Primer Medicamento
                                </button>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Alertas de stock bajo -->
    <?php $stockBajo = array_filter($medicamentos, fn($m) => $m['stock'] < 50); ?>
    <?php if (!empty($stockBajo)): ?>
        <div class="bg-red-50 border border-red-200 rounded-lg p-6">
            <div class="flex items-center mb-4">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
                <h3 class="text-lg font-semibold text-red-800">Alertas de Stock Bajo</h3>
            </div>
            <div class="space-y-3">
                <?php foreach ($stockBajo as $medicamento): ?>
                    <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-red-100">
                        <div>
                            <span class="font-medium text-red-800"><?php echo htmlspecialchars($medicamento['nombre']); ?></span>
                            <span class="text-red-600 ml-2">(<?php echo htmlspecialchars($medicamento['stock']); ?> unidades restantes)</span>
                        </div>
                        <button class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-medium">
                            Reordenar
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Accesos rápidos -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">🚀 Accesos Rápidos</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/medicamentos/nuevo?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-yellow-500 hover:bg-yellow-50 transition">
                <i class="fas fa-plus text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nuevo Medicamento</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/recetas?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition">
                <i class="fas fa-prescription-bottle text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Recetas</span>
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
