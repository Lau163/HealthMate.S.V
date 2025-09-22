<?php
// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . 'auth');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo de Enfermería - HealthMate</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Barra de navegación -->
        <nav class="bg-teal-700 text-white p-4 shadow-md">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold">Módulo de Enfermería</h1>
                <div class="flex items-center space-x-4">
                    <span class="font-medium"><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Usuario') ?></span>
                    <a href="<?= BASE_URL ?>auth/logout" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-white">Cerrar sesión</a>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="flex-grow container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Bienvenido al panel de enfermería</h2>
                <p>Aquí puedes gestionar la información de los pacientes y sus registros médicos.</p>
                
                <!-- Sección de estadísticas rápidas -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-blue-800">Pacientes hoy</h3>
                        <p class="text-3xl font-bold text-blue-600">12</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-green-800">Citas pendientes</h3>
                        <p class="text-3xl font-bold text-green-600">5</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-yellow-800">Alertas</h3>
                        <p class="text-3xl font-bold text-yellow-600">2</p>
                    </div>
                </div>

                <!-- Lista de tareas pendientes -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium mb-4">Tareas pendientes</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center space-x-2">
                            <input type="checkbox" class="rounded text-teal-600">
                            <span>Tomar signos vitales al paciente #123</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <input type="checkbox" class="rounded text-teal-600">
                            <span>Actualizar historial médico del paciente #456</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <input type="checkbox" class="rounded text-teal-600">
                            <span>Revisar resultados de laboratorio pendientes</span>
                        </li>
                    </ul>
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