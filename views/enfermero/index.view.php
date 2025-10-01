<?php
// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . 'auth');
    exit;
}

// Obtener datos para las estadísticas (ejemplo)
$kpis = [
    'pacientesHoy' => 8,
    'citasPendientes' => 5,
    'alertas' => 2
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Enfermero - HealthMate</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Barra de navegación -->
        <nav class="bg-teal-700 text-white p-4 shadow-md">
            <div class="container mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <h1 class="text-2xl font-bold">Panel del Enfermero</h1>
                    <a href="<?= BASE_URL ?>auth/cambiarRol" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-200">
                        <i class="fas fa-exchange-alt mr-1"></i> Cambiar Rol
                    </a>
                    <div class="hidden md:flex space-x-4">
                        <a href="<?= BASE_URL ?>enfermero" class="px-3 py-2 rounded-md hover:bg-teal-600">
                            <i class="fas fa-home mr-1"></i> Inicio
                        </a>
                        <a href="<?= BASE_URL ?>enfermero/pacientes" class="px-3 py-2 rounded-md hover:bg-teal-600">
                            <i class="fas fa-users mr-1"></i> Pacientes
                        </a>
                        <a href="<?= BASE_URL ?>enfermero/citas" class="px-3 py-2 rounded-md hover:bg-teal-600">
                            <i class="fas fa-calendar-alt mr-1"></i> Citas
                        </a>
                        <a href="<?= BASE_URL ?>enfermero/medicamentos" class="px-3 py-2 rounded-md hover:bg-teal-600">
                            <i class="fas fa-pills mr-1"></i> Medicamentos
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="font-medium"><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Enfermero') ?></span>
                    <a href="<?= BASE_URL ?>auth/logout" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-white">
                        <i class="fas fa-sign-out-alt mr-1"></i> Cerrar sesión
                    </a>
                </div>
            </div>
            <!-- Menú móvil -->
            <div class="md:hidden mt-2">
                <div class="flex flex-col space-y-2 px-2 pt-2 pb-3">
                    <a href="<?= BASE_URL ?>enfermero" class="px-3 py-2 rounded-md hover:bg-teal-600">
                        <i class="fas fa-home mr-1"></i> Inicio
                    </a>
                    <a href="<?= BASE_URL ?>enfermero/pacientes" class="px-3 py-2 rounded-md hover:bg-teal-600">
                        <i class="fas fa-users mr-1"></i> Pacientes
                    </a>
                    <a href="<?= BASE_URL ?>enfermero/citas" class="px-3 py-2 rounded-md hover:bg-teal-600">
                        <i class="fas fa-calendar-alt mr-1"></i> Citas
                    </a>
                    <a href="<?= BASE_URL ?>enfermero/medicamentos" class="px-3 py-2 rounded-md hover:bg-teal-600">
                        <i class="fas fa-pills mr-1"></i> Medicamentos
                    </a>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="flex-grow container mx-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Tarjeta de Pacientes de Hoy -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Pacientes de Hoy</p>
                            <p class="text-2xl font-bold"><?= $kpis['pacientesHoy'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Citas Pendientes -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-calendar-check text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Citas Pendientes</p>
                            <p class="text-2xl font-bold"><?= $kpis['citasPendientes'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Alertas -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <i class="fas fa-bell text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Alertas</p>
                            <p class="text-2xl font-bold"><?= $kpis['alertas'] ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Citas del Día -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-calendar-day text-teal-600 mr-2"></i> Citas de Hoy
                    </h2>
                    <a href="<?= BASE_URL ?>enfermero/citas" class="text-teal-600 hover:text-teal-800">
                        Ver todas <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 text-left">Hora</th>
                                <th class="py-2 px-4 text-left">Paciente</th>
                                <th class="py-2 px-4 text-left">Médico</th>
                                <th class="py-2 px-4 text-left">Tipo</th>
                                <th class="py-2 px-4 text-left">Estado</th>
                                <th class="py-2 px-4 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-3 px-4">09:00 AM</td>
                                <td class="py-3 px-4">María González</td>
                                <td class="py-3 px-4">Dr. Juan Pérez</td>
                                <td class="py-3 px-4">Consulta General</td>
                                <td class="py-3 px-4">
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        Pendiente
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <button class="text-blue-600 hover:text-blue-800 mr-2">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 px-4">10:30 AM</td>
                                <td class="py-3 px-4">Carlos López</td>
                                <td class="py-3 px-4">Dra. Ana García</td>
                                <td class="py-3 px-4">Control</td>
                                <td class="py-3 px-4">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        Confirmada
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <button class="text-blue-600 hover:text-blue-800 mr-2">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Sección de Tareas Pendientes -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-tasks text-teal-600 mr-2"></i> Tareas Pendientes
                    </h2>
                    <button class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-plus mr-1"></i> Nueva Tarea
                    </button>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <input type="checkbox" class="w-5 h-5 text-teal-600 rounded border-gray-300 focus:ring-teal-500">
                        <span class="ml-3 text-gray-700">Tomar signos vitales a paciente en habitación 205</span>
                        <span class="ml-auto text-sm text-gray-500">Hoy - 11:00 AM</span>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <input type="checkbox" class="w-5 h-5 text-teal-600 rounded border-gray-300 focus:ring-teal-500">
                        <span class="ml-3 text-gray-700">Preparar medicamentos para la ronda de la tarde</span>
                        <span class="ml-auto text-sm text-gray-500">Hoy - 2:00 PM</span>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <input type="checkbox" class="w-5 h-5 text-teal-600 rounded border-gray-300 focus:ring-teal-500">
                        <span class="ml-3 text-gray-700">Actualizar historial de paciente #12345</span>
                        <span class="ml-auto text-sm text-gray-500">Hoy - 3:30 PM</span>
                    </div>
                </div>
            </div>
        </main>

        <!-- Pie de página -->
        <footer class="bg-gray-800 text-white p-4 mt-8">
            <div class="container mx-auto text-center">
                <p>&copy; <?= date('Y') ?> HealthMate. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
</body>
</html>
