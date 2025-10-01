<?php
// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . 'auth');
    exit;
}

// Obtener datos para las estadísticas (ejemplo)
$kpis = [
    'citasPendientes' => 2,
    'historial' => 5,
    'alertas' => 1
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Paciente - HealthMate</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Barra de navegación -->
        <nav class="bg-teal-700 text-white p-4 shadow-md">
            <div class="container mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <h1 class="text-2xl font-bold">Panel del Paciente</h1>
                    <a href="<?= BASE_URL ?>auth/cambiarRol" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-200">
                        <i class="fas fa-exchange-alt mr-1"></i> Cambiar Rol
                    </a>
                    <div class="hidden md:flex space-x-4">
                        <a href="<?= BASE_URL ?>paciente" class="px-3 py-2 rounded-md hover:bg-teal-600">
                            <i class="fas fa-home mr-1"></i> Inicio
                        </a>
                        <a href="<?= BASE_URL ?>paciente/citas" class="px-3 py-2 rounded-md hover:bg-teal-600">
                            <i class="fas fa-calendar-alt mr-1"></i> Mis Citas
                        </a>
                        <a href="<?= BASE_URL ?>paciente/historial" class="px-3 py-2 rounded-md hover:bg-teal-600">
                            <i class="fas fa-history mr-1"></i> Historial
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="font-medium"><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Paciente') ?></span>
                    <a href="<?= BASE_URL ?>auth/logout" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-white">
                        <i class="fas fa-sign-out-alt mr-1"></i> Cerrar sesión
                    </a>
                </div>
            </div>
            <!-- Menú móvil -->
            <div class="md:hidden mt-2">
                <div class="flex flex-col space-y-2 px-2 pt-2 pb-3">
                    <a href="<?= BASE_URL ?>paciente" class="px-3 py-2 rounded-md hover:bg-teal-600">
                        <i class="fas fa-home mr-1"></i> Inicio
                    </a>
                    <a href="<?= BASE_URL ?>paciente/citas" class="px-3 py-2 rounded-md hover:bg-teal-600">
                        <i class="fas fa-calendar-alt mr-1"></i> Mis Citas
                    </a>
                    <a href="<?= BASE_URL ?>paciente/historial" class="px-3 py-2 rounded-md hover:bg-teal-600">
                        <i class="fas fa-history mr-1"></i> Historial
                    </a>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="flex-grow container mx-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Tarjeta de Citas Pendientes -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-calendar-check text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Citas Pendientes</p>
                            <p class="text-2xl font-bold"><?= $kpis['citasPendientes'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Historial -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-history text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Registros en Historial</p>
                            <p class="text-2xl font-bold"><?= $kpis['historial'] ?></p>
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

            <!-- Sección de Próximas Citas -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-calendar-day text-teal-600 mr-2"></i> Próximas Citas
                    </h2>
                    <a href="<?= BASE_URL ?>paciente/citas" class="text-teal-600 hover:text-teal-800">
                        Ver todas <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 text-left">Fecha</th>
                                <th class="py-2 px-4 text-left">Hora</th>
                                <th class="py-2 px-4 text-left">Médico</th>
                                <th class="py-2 px-4 text-left">Especialidad</th>
                                <th class="py-2 px-4 text-left">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-3 px-4">26/09/2024</td>
                                <td class="py-3 px-4">10:00 AM</td>
                                <td class="py-3 px-4">Dr. Juan Pérez</td>
                                <td class="py-3 px-4">Cardiología</td>
                                <td class="py-3 px-4">
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        Pendiente
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 px-4">28/09/2024</td>
                                <td class="py-3 px-4">04:30 PM</td>
                                <td class="py-3 px-4">Dra. Ana García</td>
                                <td class="py-3 px-4">Dermatología</td>
                                <td class="py-3 px-4">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        Confirmada
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Sección de Historial Reciente -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-history text-teal-600 mr-2"></i> Historial Reciente
                    </h2>
                    <a href="<?= BASE_URL ?>paciente/historial" class="text-teal-600 hover:text-teal-800">
                        Ver historial completo <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="space-y-4">
                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <div class="flex justify-between">
                            <h3 class="font-medium">Consulta de rutina</h3>
                            <span class="text-sm text-gray-500">15/09/2024</span>
                        </div>
                        <p class="text-sm text-gray-600">Dr. Juan Pérez - Cardiología</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 py-2">
                        <div class="flex justify-between">
                            <h3 class="font-medium">Análisis de laboratorio</h3>
                            <span class="text-sm text-gray-500">10/09/2024</span>
                        </div>
                        <p class="text-sm text-gray-600">Laboratorio Central</p>
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
