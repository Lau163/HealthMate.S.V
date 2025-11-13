<?php
// Configurar variables para el layout
$title = 'Inicio Médico - HealthMate';
$pageTitle = 'INICIO MÉDICO';

// Obtener datos del dashboard desde el controlador
$totalPacientes = $totalPacientes ?? 150;
$citasHoy = $citasHoy ?? 8;
$mensajesPendientes = $mensajesPendientes ?? 3;
?>

<!-- Dashboard Principal Content -->
<div class="space-y-6">
    <!-- Header de Bienvenida -->
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">🏥 Bienvenido a HealthMate</h1>
                <p class="text-emerald-100 text-lg">Panel de control médico - Gestiona tu práctica de manera eficiente</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-stethoscope text-6xl text-emerald-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- KPIs Rápidos -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Pacientes Total -->
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
            <div class="mt-4">
                <a href="<?php echo BASE_URL; ?>doctor/pacientes?debug=1" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Ver todos los pacientes →
                </a>
            </div>
        </div>

        <!-- Citas de Hoy -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Citas de Hoy</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo $citasHoy; ?></p>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="<?php echo BASE_URL; ?>doctor/consultas?debug=1" class="text-green-600 hover:text-green-800 text-sm font-medium">
                    Ver agenda completa →
                </a>
            </div>
        </div>

        <!-- Mensajes -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Mensajes</p>
                    <p class="text-3xl font-bold text-purple-600"><?php echo $mensajesPendientes; ?></p>
                </div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="<?php echo BASE_URL; ?>doctor/mensajes?debug=1" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                    Ver mensajes →
                </a>
            </div>
        </div>
    </div>

    <!-- Menú Principal de Funciones -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Consejos Médicos -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition duration-300">
            <div class="text-center">
                <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-2xl text-pink-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">💡 Consejos</h3>
                <p class="text-gray-600 text-sm mb-4">Comparte conocimiento médico y promueve la salud</p>
                <a href="<?php echo BASE_URL; ?>doctor/consejos?debug=1"
                   class="inline-flex items-center px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-md text-sm font-medium transition">
                    <i class="fas fa-arrow-right mr-2"></i>Ir a Consejos
                </a>
            </div>
        </div>

        <!-- Gestión de Pacientes -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition duration-300">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">👥 Pacientes</h3>
                <p class="text-gray-600 text-sm mb-4">Administra información y historial de pacientes</p>
                <a href="<?php echo BASE_URL; ?>doctor/pacientes?debug=1"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition">
                    <i class="fas fa-arrow-right mr-2"></i>Ver Pacientes
                </a>
            </div>
        </div>

        <!-- Agenda y Consultas -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition duration-300">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-alt text-2xl text-green-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">📅 Agenda</h3>
                <p class="text-gray-600 text-sm mb-4">Gestiona tus citas y consultas programadas</p>
                <a href="<?php echo BASE_URL; ?>doctor/consultas?debug=1"
                   class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md text-sm font-medium transition">
                    <i class="fas fa-arrow-right mr-2"></i>Ver Agenda
                </a>
            </div>
        </div>

        <!-- Medicamentos -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition duration-300">
            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-pills text-2xl text-yellow-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">💊 Medicamentos</h3>
                <p class="text-gray-600 text-sm mb-4">Gestiona prescripciones y medicamentos</p>
                <a href="<?php echo BASE_URL; ?>doctor/medicamentos?debug=1"
                   class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-md text-sm font-medium transition">
                    <i class="fas fa-arrow-right mr-2"></i>Ver Medicamentos
                </a>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition duration-300">
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-bar text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">📊 Estadísticas</h3>
                <p class="text-gray-600 text-sm mb-4">Visualiza métricas y rendimiento de tu práctica</p>
                <a href="<?php echo BASE_URL; ?>doctor/estadisticas?debug=1"
                   class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-md text-sm font-medium transition">
                    <i class="fas fa-arrow-right mr-2"></i>Ver Estadísticas
                </a>
            </div>
        </div>

        <!-- Recetas -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition duration-300">
            <div class="text-center">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-prescription-bottle text-2xl text-orange-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">📋 Recetas</h3>
                <p class="text-gray-600 text-sm mb-4">Gestiona prescripciones médicas</p>
                <a href="<?php echo BASE_URL; ?>doctor/recetas?debug=1"
                   class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-md text-sm font-medium transition">
                    <i class="fas fa-arrow-right mr-2"></i>Ver Recetas
                </a>
            </div>
        </div>
    </div>

    <!-- Accesos Rápidos -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">🚀 Accesos Rápidos</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/perfil?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition">
                <i class="fas fa-user-circle text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Mi Perfil</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/historial_clinico?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-red-500 hover:bg-red-50 transition">
                <i class="fas fa-file-medical text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Historial Clínico</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/pacientes/nuevo?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-emerald-500 hover:bg-emerald-50 transition">
                <i class="fas fa-plus text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nuevo Paciente</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/consultas/nueva?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                <i class="fas fa-calendar-plus text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nueva Cita</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/dar_consejos?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-pink-500 hover:bg-pink-50 transition">
                <i class="fas fa-lightbulb text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nuevo Consejo</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/estadisticas?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                <i class="fas fa-chart-line text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Reportes</span>
            </button>
        </div>
    </div>

    <!-- Actividad Reciente -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">📋 Actividad Reciente</h3>
            <span class="text-sm text-gray-500">Últimas 24 horas</span>
        </div>
        <div class="space-y-3">
            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-user-plus text-blue-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Nuevo paciente registrado</p>
                    <p class="text-xs text-gray-500">Ana García - 10:30 AM</p>
                </div>
                <span class="text-xs text-gray-400">2h</span>
            </div>

            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Consulta completada</p>
                    <p class="text-xs text-gray-500">Carlos Rodríguez - 09:00 AM</p>
                </div>
                <span class="text-xs text-gray-400">3h</span>
            </div>

            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-heart text-pink-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Nuevo consejo publicado</p>
                    <p class="text-xs text-gray-500">Importancia de la hidratación - 08:00 AM</p>
                </div>
                <span class="text-xs text-gray-400">4h</span>
            </div>
        </div>
    </div>
</div>