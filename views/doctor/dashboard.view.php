<?php
// Configurar variables para el layout
$title = 'Panel del Doctor - HealthMate';
$pageTitle = 'PANEL PRINCIPAL';

// Obtener datos para las estadísticas
$kpis = $this->get('kpis') ?? [
    'totalPacientes' => 0,
    'citasHoy' => 0,
    'alertas' => 0
];

// Obtener pacientes recientes
$pacientesRecientes = $this->get('pacientesRecientes') ?? [];
?>

<!-- Dashboard Content -->
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Bienvenido a HealthMate</h1>
                <p class="text-emerald-100 text-lg">Panel de control médico - Gestiona tus pacientes y consultas</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-heartbeat text-6xl text-emerald-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- KPIs Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total de Pacientes -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total de Pacientes</p>
                    <p class="text-3xl font-bold text-blue-600"><?php echo number_format($kpis['totalPacientes']); ?></p>
                </div>
            </div>
        </div>

        <!-- Citas de Hoy -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Citas para Hoy</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo number_format($kpis['citasHoy']); ?></p>
                </div>
            </div>
        </div>

        <!-- Alertas -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-exclamation-triangle text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Alertas</p>
                    <p class="text-3xl font-bold text-yellow-600"><?php echo number_format($kpis['alertas']); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Gestionar Pacientes -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start space-x-4">
                <div class="p-3 rounded-lg bg-emerald-100 text-emerald-600">
                    <i class="fas fa-user-injured text-2xl"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Gestionar Pacientes</h3>
                    <p class="text-gray-600 mb-4">Administra la información de tus pacientes, historiales médicos y más.</p>
                    <div class="flex space-x-2">
                        <a href="<?php echo BASE_URL; ?>doctor/pacientes" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-md transition duration-150">
                            Ver Pacientes <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <a href="<?php echo BASE_URL; ?>doctor/nuevo-paciente" class="inline-flex items-center px-4 py-2 border border-emerald-600 text-emerald-600 hover:bg-emerald-50 text-sm font-medium rounded-md transition duration-150">
                            <i class="fas fa-plus mr-2"></i>Nuevo
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ver Agenda -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start space-x-4">
                <div class="p-3 rounded-lg bg-blue-100 text-blue-600">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Ver Agenda</h3>
                    <p class="text-gray-600 mb-4">Revisa y gestiona tus citas programadas para hoy y los próximos días.</p>
                    <div class="flex space-x-2">
                        <a href="<?php echo BASE_URL; ?>doctor/consultas" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition duration-150">
                            Ver Agenda <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <a href="<?php echo BASE_URL; ?>doctor/nueva-consulta" class="inline-flex items-center px-4 py-2 border border-blue-600 text-blue-600 hover:bg-blue-50 text-sm font-medium rounded-md transition duration-150">
                            <i class="fas fa-plus mr-2"></i>Agendar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historial Clínico -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start space-x-4">
                <div class="p-3 rounded-lg bg-purple-100 text-purple-600">
                    <i class="fas fa-file-medical text-2xl"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Historial Clínico</h3>
                    <p class="text-gray-600 mb-4">Accede al historial médico completo de tus pacientes.</p>
                    <div class="flex space-x-2">
                        <a href="<?php echo BASE_URL; ?>doctor/historial" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-md transition duration-150">
                            Ver Historial <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <a href="<?php echo BASE_URL; ?>doctor/buscar-paciente" class="inline-flex items-center px-4 py-2 border border-purple-600 text-purple-600 hover:bg-purple-50 text-sm font-medium rounded-md transition duration-150">
                            <i class="fas fa-search mr-2"></i>Buscar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medicamentos -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start space-x-4">
                <div class="p-3 rounded-lg bg-orange-100 text-orange-600">
                    <i class="fas fa-pills text-2xl"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Medicamentos</h3>
                    <p class="text-gray-600 mb-4">Gestiona recetas, medicamentos y tratamientos prescritos.</p>
                    <div class="flex space-x-2">
                        <a href="<?php echo BASE_URL; ?>doctor/medicamentos" class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-md transition duration-150">
                            Ver Medicamentos <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <a href="<?php echo BASE_URL; ?>doctor/nueva-receta" class="inline-flex items-center px-4 py-2 border border-orange-600 text-orange-600 hover:bg-orange-50 text-sm font-medium rounded-md transition duration-150">
                            <i class="fas fa-plus mr-2"></i>Receta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pacientes Recientes -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-history text-emerald-600 mr-2"></i> Pacientes Recientes
            </h3>
            <a href="<?php echo BASE_URL; ?>doctor/pacientes" class="text-emerald-600 hover:text-emerald-800 text-sm font-medium">
                Ver todos <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="p-6">
            <?php if (empty($pacientesRecientes)): ?>
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-users text-4xl mb-4 text-gray-300"></i>
                    <p>No hay pacientes recientes para mostrar.</p>
                    <a href="<?php echo BASE_URL; ?>doctor/nuevo-paciente" class="mt-2 inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-md transition duration-150">
                        <i class="fas fa-plus mr-2"></i>Agregar Primer Paciente
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($pacientesRecientes as $paciente): ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-3">
                                <div class="h-12 w-12 rounded-full bg-emerald-100 flex items-center justify-center">
                                    <span class="text-emerald-600 font-medium">
                                        <?php
                                        $iniciales = '';
                                        if (!empty($paciente['nombre'])) {
                                            $nombres = explode(' ', $paciente['nombre']);
                                            $iniciales = strtoupper(substr($nombres[0], 0, 1));
                                            if (isset($nombres[1])) {
                                                $iniciales .= strtoupper(substr($nombres[1], 0, 1));
                                            }
                                        }
                                        echo $iniciales ?: 'PG';
                                        ?>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($paciente['nombre']); ?></h4>
                                    <p class="text-xs text-gray-500">ID: <?php echo htmlspecialchars($paciente['id']); ?></p>
                                    <p class="text-xs text-gray-500">Última visita: <?php echo htmlspecialchars($paciente['ultima_visita'] ?? 'N/A'); ?></p>
                                </div>
                            </div>
                            <div class="mt-3 flex space-x-2">
                                <a href="<?php echo BASE_URL; ?>doctor/paciente/ver/<?php echo $paciente['id']; ?>"
                                   class="flex-1 text-center px-3 py-1 bg-emerald-50 text-emerald-600 text-xs font-medium rounded hover:bg-emerald-100 transition">
                                    Ver
                                </a>
                                <a href="<?php echo BASE_URL; ?>doctor/paciente/editar/<?php echo $paciente['id']; ?>"
                                   class="flex-1 text-center px-3 py-1 bg-blue-50 text-blue-600 text-xs font-medium rounded hover:bg-blue-100 transition">
                                    Editar
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer con información útil -->
    <div class="bg-gray-50 rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div>
                <i class="fas fa-info-circle text-emerald-600 text-2xl mb-2"></i>
                <h4 class="font-semibold text-gray-800 mb-1">Centro de Ayuda</h4>
                <p class="text-sm text-gray-600">Encuentra respuestas a preguntas frecuentes</p>
            </div>
            <div>
                <i class="fas fa-phone text-emerald-600 text-2xl mb-2"></i>
                <h4 class="font-semibold text-gray-800 mb-1">Soporte</h4>
                <p class="text-sm text-gray-600">Contacta con nuestro equipo de soporte</p>
            </div>
            <div>
                <i class="fas fa-cog text-emerald-600 text-2xl mb-2"></i>
                <h4 class="font-semibold text-gray-800 mb-1">Configuración</h4>
                <p class="text-sm text-gray-600">Personaliza tu experiencia en la plataforma</p>
            </div>
        </div>
    </div>
</div>
