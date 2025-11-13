<?php
// Configurar variables para el layout
$title = 'Agenda y Consultas - HealthMate';
$pageTitle = 'AGENDA Y CONSULTAS';

// Obtener datos de consultas desde el controlador
$consultas = $consultas ?? [];
$totalConsultas = $totalConsultas ?? 0;
$consultasHoy = $consultasHoy ?? 0;
?>

<!-- Agenda y Consultas Content -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-500 to-teal-600 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Agenda y Consultas</h1>
                <p class="text-green-100 text-lg">Gestiona tus citas médicas y consultas programadas</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-calendar-alt text-6xl text-green-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Citas de Hoy</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo $consultasHoy; ?></p>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Citas</p>
                    <p class="text-3xl font-bold text-blue-600"><?php echo $totalConsultas; ?></p>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-calendar text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pendientes</p>
                    <p class="text-3xl font-bold text-yellow-600"><?php echo count(array_filter($consultas, fn($c) => $c['estado'] === 'Pendiente')); ?></p>
                </div>
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Canceladas</p>
                    <p class="text-3xl font-bold text-red-600"><?php echo count(array_filter($consultas, fn($c) => $c['estado'] === 'Cancelada')); ?></p>
                </div>
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-times-circle text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendario y lista de citas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Calendario -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">📅 Calendario</h3>
            <div class="text-center py-8">
                <i class="fas fa-calendar text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 mb-4">Selecciona una fecha para ver las citas</p>
                <input type="date"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>
        </div>

        <!-- Lista de citas del día -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Citas del Día</h3>
                    <p class="text-gray-600">Consulta las citas programadas para hoy</p>
                </div>
                <button onclick="location.href='<?php echo BASE_URL; ?>doctor/consultas/nueva?debug=1'"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Nueva Cita
                </button>
            </div>

            <!-- Lista de citas -->
            <div class="space-y-4">
                <?php if (!empty($consultas)): ?>
                    <?php foreach ($consultas as $consulta): ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user-md text-green-600"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">
                                            <?php echo htmlspecialchars($consulta['paciente']); ?>
                                        </h4>
                                        <p class="text-sm text-gray-600">
                                            <?php echo htmlspecialchars($consulta['tipo']); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm font-medium text-gray-900">
                                        <?php echo htmlspecialchars($consulta['hora']); ?>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <?php echo htmlspecialchars($consulta['fecha']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    <?php
                                    echo match($consulta['estado']) {
                                        'Confirmada' => 'bg-green-100 text-green-800',
                                        'Pendiente' => 'bg-yellow-100 text-yellow-800',
                                        'Cancelada' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                    ?>">
                                    <?php echo htmlspecialchars($consulta['estado']); ?>
                                </span>
                                <div class="flex items-center space-x-2">
                                    <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                        Ver Detalles
                                    </button>
                                    <?php if ($consulta['estado'] === 'Pendiente'): ?>
                                        <button class="px-3 py-1 text-sm bg-green-600 text-white rounded-md hover:bg-green-700">
                                            Confirmar
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if (!empty($consulta['notas'])): ?>
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <p class="text-sm text-gray-600">
                                        <strong>Notas:</strong> <?php echo htmlspecialchars($consulta['notas']); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-12">
                        <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">No hay citas programadas</h3>
                        <p class="text-gray-600 mb-6">Agenda una nueva cita para comenzar</p>
                        <button onclick="location.href='<?php echo BASE_URL; ?>doctor/consultas/nueva?debug=1'"
                                class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-bold transition duration-200">
                            <i class="fas fa-plus mr-2"></i>Agendar Primera Cita
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Próximas citas -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">📋 Próximas Citas</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            $proximasCitas = array_filter($consultas, fn($c) => $c['estado'] !== 'Cancelada');
            $proximasCitas = array_slice($proximasCitas, 0, 6);
            ?>
            <?php if (!empty($proximasCitas)): ?>
                <?php foreach ($proximasCitas as $cita): ?>
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-medium text-gray-800">
                                <?php echo htmlspecialchars($cita['paciente']); ?>
                            </h4>
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                <?php
                                echo match($cita['estado']) {
                                    'Confirmada' => 'bg-green-100 text-green-800',
                                    'Pendiente' => 'bg-yellow-100 text-yellow-800',
                                    default => 'bg-gray-100 text-gray-800'
                                };
                                ?>">
                                <?php echo htmlspecialchars($cita['estado']); ?>
                            </span>
                        </div>
                        <div class="text-sm text-gray-600">
                            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($cita['fecha']); ?></p>
                            <p><strong>Hora:</strong> <?php echo htmlspecialchars($cita['hora']); ?></p>
                            <p><strong>Tipo:</strong> <?php echo htmlspecialchars($cita['tipo']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-8">
                    <i class="fas fa-calendar-alt text-4xl text-gray-300 mb-2"></i>
                    <p class="text-gray-500">No hay próximas citas programadas</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Accesos rápidos -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">🚀 Accesos Rápidos</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/consultas/nueva?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
                <i class="fas fa-calendar-plus text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nueva Cita</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/pacientes?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                <i class="fas fa-users text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Pacientes</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/recetas?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition">
                <i class="fas fa-prescription-bottle text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Recetas</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/estadisticas?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                <i class="fas fa-chart-line text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Reportes</span>
            </button>
        </div>
    </div>
</div>
