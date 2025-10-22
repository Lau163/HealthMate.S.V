<?php
// Configurar variables para el layout
$title = 'Gráficos y Estadísticas - HealthMate';
$pageTitle = 'GRÁFICOS Y ESTADÍSTICAS';

// Obtener datos para los gráficos (ya configurados por el controlador)
$estadisticas = $estadisticas ?? [
    'totalPacientes' => 150,
    'citasMes' => 320,
    'ingresosMensuales' => 45000,
    'satisfaccion' => 4.8,
    'citasPendientes' => 25,
    'citasCompletadas' => 295
];

// Datos de ejemplo para gráficos (ya configurados por el controlador)
$datosGraficos = $datosGraficos ?? [
    'mensual' => [
        'enero' => 45, 'febrero' => 52, 'marzo' => 48, 'abril' => 61,
        'mayo' => 55, 'junio' => 67, 'julio' => 58, 'agosto' => 63,
        'septiembre' => 71, 'octubre' => 69, 'noviembre' => 74, 'diciembre' => 78
    ],
    'especialidades' => [
        'Medicina General' => 35,
        'Cardiología' => 25,
        'Dermatología' => 15,
        'Pediatría' => 15,
        'Ginecología' => 10
    ]
];
?>

<!-- Gráficos y Estadísticas Content -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Gráficos y Estadísticas</h1>
                <p class="text-purple-100 text-lg">Visualiza el rendimiento y métricas de tu consultorio</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-chart-line text-6xl text-purple-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- KPIs Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Pacientes -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Pacientes</p>
                    <p class="text-3xl font-bold text-blue-600"><?php echo number_format($estadisticas['totalPacientes']); ?></p>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-600 font-medium">+12% </span>
                <span class="text-gray-500">vs mes anterior</span>
            </div>
        </div>

        <!-- Citas del Mes -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Citas del Mes</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo number_format($estadisticas['citasMes']); ?></p>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-600 font-medium">+8% </span>
                <span class="text-gray-500">vs mes anterior</span>
            </div>
        </div>

        <!-- Ingresos -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Ingresos Mensuales</p>
                    <p class="text-3xl font-bold text-yellow-600">$<?php echo number_format($estadisticas['ingresosMensuales']); ?></p>
                </div>
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-dollar-sign text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-600 font-medium">+15% </span>
                <span class="text-gray-500">vs mes anterior</span>
            </div>
        </div>

        <!-- Satisfacción -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Calificación</p>
                    <p class="text-3xl font-bold text-purple-600"><?php echo $estadisticas['satisfaccion']; ?>/5.0</p>
                </div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-star text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-600 font-medium">Excelente </span>
                <span class="text-gray-500">promedio</span>
            </div>
        </div>
    </div>

    <!-- Gráficos Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Gráfico de Citas Mensuales -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Citas por Mes</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-sm bg-purple-100 text-purple-600 rounded-md">Mensual</button>
                    <button class="px-3 py-1 text-sm text-gray-500 hover:bg-gray-100 rounded-md">Semanal</button>
                </div>
            </div>
            <div class="h-64 flex items-end justify-between space-x-2">
                <?php foreach ($datosGraficos['mensual'] as $mes => $valor): ?>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-t from-purple-500 to-purple-400 rounded-t-md mb-2 transition-all hover:from-purple-600 hover:to-purple-500"
                             style="height: <?php echo ($valor / 80) * 100; ?>%"
                             title="<?php echo ucfirst($mes) . ': ' . $valor; ?>">
                        </div>
                        <span class="text-xs text-gray-500 transform rotate-45 origin-center"><?php echo substr($mes, 0, 3); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Gráfico de Especialidades -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Citas por Especialidad</h3>
                <button class="px-3 py-1 text-sm bg-indigo-100 text-indigo-600 rounded-md">2024</button>
            </div>
            <div class="space-y-4">
                <?php $colors = ['bg-blue-500', 'bg-green-500', 'bg-yellow-500', 'bg-purple-500', 'bg-red-500']; $i = 0; ?>
                <?php foreach ($datosGraficos['especialidades'] as $especialidad => $porcentaje): ?>
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 rounded <?php echo $colors[$i % count($colors)]; ?>"></div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700"><?php echo $especialidad; ?></span>
                                <span class="text-sm text-gray-500"><?php echo $porcentaje; ?>%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="<?php echo str_replace('bg-', 'bg-', $colors[$i % count($colors)]) . ' h-2 rounded-full transition-all duration-500'; ?>"
                                     style="width: <?php echo $porcentaje; ?>%"></div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Estado de Citas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Citas Pendientes -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Citas Pendientes</p>
                    <p class="text-3xl font-bold text-orange-600"><?php echo $estadisticas['citasPendientes']; ?></p>
                </div>
                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="<?php echo BASE_URL; ?>doctor/citas/pendientes" class="text-orange-600 hover:text-orange-800 text-sm font-medium">
                    Ver todas las citas pendientes →
                </a>
            </div>
        </div>

        <!-- Citas Completadas -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Citas Completadas</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo $estadisticas['citasCompletadas']; ?></p>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 text-sm font-medium">92% de efectividad</span>
            </div>
        </div>

        <!-- Próxima Cita -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Próxima Cita</p>
                    <p class="text-lg font-bold text-blue-600">Hoy 14:30</p>
                    <p class="text-sm text-gray-500">Ana García</p>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="<?php echo BASE_URL; ?>doctor/citas/hoy" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Ver agenda completa →
                </a>
            </div>
        </div>
    </div>

    <!-- Acciones -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Exportar Reportes</h3>
                <p class="text-gray-600">Descarga reportes detallados de tu actividad</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <button class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md text-sm font-medium transition duration-150">
                    <i class="fas fa-download mr-2"></i>Exportar PDF
                </button>
                <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition duration-150">
                    <i class="fas fa-file-excel mr-2"></i>Exportar Excel
                </button>
            </div>
        </div>
    </div>
</div>
