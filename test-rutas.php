<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test de Rutas - HealthMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                🧪 Test de Rutas - HealthMate
            </h1>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Estado del Sistema:</h2>
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                    <p><strong>URL Base:</strong> <?= constant('URL') ?? 'No definida' ?></p>
                    <p><strong>BASE_URL:</strong> <?= constant('BASE_URL') ?? 'No definida' ?></p>
                    <p><strong>Sesión iniciada:</strong> <?= isset($_SESSION['usuario_id']) ? 'Sí' : 'No' ?></p>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Enlaces de Prueba:</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="<?= constant('URL') ?>paciente"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg text-center transition-colors">
                        🏠 Página Principal Paciente
                    </a>

                    <a href="<?= constant('URL') ?>paciente/bienestarMental"
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg text-center transition-colors">
                        🧠 Bienestar Mental
                    </a>

                    <a href="<?= constant('URL') ?>paciente/alimentacion"
                       class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-3 rounded-lg text-center transition-colors">
                        🥗 Alimentación
                    </a>

                    <a href="<?= constant('URL') ?>paciente/hidratacion"
                       class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-3 rounded-lg text-center transition-colors">
                        💧 Hidratación
                    </a>

                    <a href="<?= constant('URL') ?>paciente/prevencionMedica"
                       class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-3 rounded-lg text-center transition-colors">
                        🩺 Prevención Médica
                    </a>

                    <a href="<?= constant('URL') ?>paciente/actividadFisica"
                       class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-3 rounded-lg text-center transition-colors">
                        🏃 Actividad Física
                    </a>
                </div>
            </div>

            <div class="mt-8 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-lg">
                <h3 class="font-semibold text-yellow-800 mb-2">🔍 Instrucciones:</h3>
                <p class="text-sm text-gray-700">
                    Si puedes ver esta página, significa que el servidor está funcionando correctamente.
                    Haz clic en cualquiera de los enlaces de arriba para probar las rutas.
                    Si encuentras algún error 404, podría ser un problema de caché - intenta recargar con Ctrl+F5.
                </p>
            </div>

            <div class="mt-6 text-center">
                <a href="javascript:history.back()"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors">
                    ← Volver
                </a>
            </div>
        </div>
    </div>
</body>
</html>
