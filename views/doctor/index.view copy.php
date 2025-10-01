<?php
// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . 'auth');
    exit;
}

// Obtener datos para las estadísticas
$kpis = $this->get('kpis') ?? [
    'totalPacientes' => 0,
    'citasHoy' => 0,
    'alertas' => 0
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Doctor - HealthMate</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Barra de navegación -->
        <nav class="bg-teal-700 text-white p-4 shadow-md">
            <div class="container mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <h1 class="text-2xl font-bold">Panel del Doctor</h1>
                    <a href="<?= BASE_URL ?>auth/cambiarRol" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-200">
                        <i class="fas fa-exchange-alt mr-1"></i> Cambiar Rol
                    </a>
                    <div class="hidden md:flex space-x-4">
                        <a href="<?= BASE_URL ?>doctor" class="px-3 py-2 rounded-md hover:bg-teal-600">
                            <i class="fas fa-home mr-1"></i> Inicio
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="font-medium"><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Doctor') ?></span>
                    <a href="<?= BASE_URL ?>auth/logout" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-white">
                        <i class="fas fa-sign-out-alt mr-1"></i> Cerrar sesión
                    </a>
                </div>
            </div>
            <!-- Menú móvil -->
            <div class="md:hidden mt-2">
                <div class="flex flex-col space-y-2 px-2 pt-2 pb-3">
                    <a href="<?= BASE_URL ?>doctor" class="px-3 py-2 rounded-md hover:bg-teal-600">
                        <i class="fas fa-home mr-1"></i> Inicio
                    </a>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="flex-grow container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-tachometer-alt text-teal-600 mr-2"></i> Resumen del Día
                    </h2>
                    <a href="<?= BASE_URL ?>doctor/nuevo-paciente" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        <i class="fas fa-user-plus mr-2"></i> Nuevo Paciente
                    </a>
                </div>

                <?php if (isset($_SESSION['mensaje'])): ?>
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        <p><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
                        <?php unset($_SESSION['mensaje']); ?>
                    </div>
                <?php endif; ?>

                <!-- Sección de estadísticas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total de Pacientes</p>
                                <p class="text-3xl font-bold text-blue-600"><?= $kpis['totalPacientes'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 p-6 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-calendar-check text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Citas para Hoy</p>
                                <p class="text-3xl font-bold text-green-600"><?= $kpis['citasHoy'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 p-6 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <i class="fas fa-exclamation-triangle text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Alertas</p>
                                <p class="text-3xl font-bold text-yellow-600"><?= $kpis['alertas'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones rápidas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            <i class="fas fa-user-injured text-teal-600 mr-2"></i> Gestionar Pacientes
                        </h3>
                        <p class="text-gray-600 mb-4">Administra la información de tus pacientes, historiales médicos y más.</p>
                        <a href="<?= BASE_URL ?>paciente" class="text-teal-600 hover:text-teal-800 font-medium flex items-center">
                            Ir a pacientes <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            <i class="fas fa-calendar-alt text-teal-600 mr-2"></i> Ver Agenda
                        </h3>
                        <p class="text-gray-600 mb-4">Revisa y gestiona tus citas programadas para hoy y los próximos días.</p>
                        <a href="#" class="text-teal-600 hover:text-teal-800 font-medium flex items-center">
                            Ver agenda <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Sección de pacientes recientes -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">
                            <i class="fas fa-history text-teal-600 mr-2"></i> Pacientes Recientes
                        </h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-500 italic">No hay pacientes recientes para mostrar.</p>
                        <!-- Aquí podrías incluir una tabla o lista de pacientes recientes -->
                    </div>
                </div>
            </div>
        </main>

        <!-- Pie de página -->
        <footer class="bg-gray-800 text-white p-4 mt-8">
            <div class="container mx-auto text-center">
                <p>&copy; <?= date('Y') ?> HealthMate - Todos los derechos reservados</p>
            </div>
        </footer>
    </div>
</body>
</html>