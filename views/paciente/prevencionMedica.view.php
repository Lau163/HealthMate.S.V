<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Prevención Médica | HealthMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            overflow-x: hidden;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            position: relative;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen w-full">
    <div class="w-full min-h-screen bg-white overflow-x-hidden">

        <?php include('navbar.view.php') ?>

        <!-- Contenido principal -->
        <main class="container mx-auto px-3 sm:px-4 py-4 md:py-6 lg:px-8 max-w-7xl">

            <!-- Banner de título -->
            <div class="bg-gradient-to-r from-green-600 to-emerald-700 rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-8 mb-4 md:mb-6 lg:mb-8 mt-2 md:mt-4">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white text-center">
                    <i class="fas fa-shield-alt mr-3"></i> Prevención Médica
                </h1>
                <p class="text-green-100 text-center mt-2 text-sm md:text-base">
                    Medidas preventivas y cuidados médicos para mantener tu salud óptima
                </p>
            </div>

            <!-- Contenido principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                <!-- Artículo principal -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">

                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-user-md text-green-600 mr-2"></i>
                            La Importancia de la Prevención
                        </h2>

                        <div class="prose prose-lg max-w-none text-gray-700">
                            <p class="mb-4">
                                La prevención médica es la piedra angular de una buena salud. Más que tratar enfermedades,
                                se trata de evitar que aparezcan o detectarlas tempranamente cuando son más tratables.
                            </p>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-calendar-check text-green-500 mr-2"></i>
                                Chequeos Médicos Regulares
                            </h3>

                            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
                                <h4 class="font-semibold text-green-800 mb-2">Programa de Chequeos por Edad:</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                    <div>
                                        <h5 class="font-semibold text-green-700">18-30 años:</h5>
                                        <ul class="list-disc list-inside text-gray-700 text-sm">
                                            <li>Chequeo anual general</li>
                                            <li>Examen dental bianual</li>
                                            <li>Vacunas según calendario</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5 class="font-semibold text-green-700">30-50 años:</h5>
                                        <ul class="list-disc list-inside text-gray-700 text-sm">
                                            <li>Chequeo anual completo</li>
                                            <li>Colonoscopía cada 10 años</li>
                                            <li>Mamografía anual (mujeres)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-syringe text-blue-500 mr-2"></i>
                                Vacunación: Tu Escudo Protector
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-blue-800 mb-3">Vacunas Esenciales para Adultos:</h4>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li><strong>Tétanos-difteria-tos ferina:</strong> Cada 10 años</li>
                                        <li><strong>Influenza:</strong> Anual</li>
                                        <li><strong>COVID-19:</strong> Según recomendaciones</li>
                                        <li><strong>Hepatitis B:</strong> Si no vacunado previamente</li>
                                    </ul>
                                </div>

                                <div class="bg-blue-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-blue-800 mb-3">Vacunas Especiales:</h4>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li><strong>Neumococo:</strong> Para mayores de 65 años</li>
                                        <li><strong>Herpes zóster:</strong> A partir de los 50 años</li>
                                        <li><strong>VPH:</strong> Para adultos jóvenes</li>
                                    </ul>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-heartbeat text-red-500 mr-2"></i>
                                Detección Temprana
                            </h3>

                            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                                <h4 class="font-semibold text-red-800 mb-2">Autoexámenes Importantes:</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h5 class="font-semibold text-red-700">Examen de Mama (Mujeres):</h5>
                                        <ul class="list-disc list-inside text-gray-700 text-sm">
                                            <li>Autoexamen mensual</li>
                                            <li>Examen clínico anual</li>
                                            <li>Mamografía según edad</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5 class="font-semibold text-red-700">Examen de Piel:</h5>
                                        <ul class="list-disc list-inside text-gray-700 text-sm">
                                            <li>Revisión mensual de lunares</li>
                                            <li>Consulta si detectas cambios</li>
                                            <li>Protección solar diaria</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-chart-line text-purple-500 mr-2"></i>
                                Factores de Riesgo a Monitorear
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <div class="text-3xl mb-2">🩺</div>
                                    <h4 class="font-semibold text-gray-800">Presión Arterial</h4>
                                    <p class="text-sm text-gray-600">Medir regularmente, especialmente si hay antecedentes familiares</p>
                                </div>

                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <div class="text-3xl mb-2">⚖️</div>
                                    <h4 class="font-semibold text-gray-800">Peso Corporal</h4>
                                    <p class="text-sm text-gray-600">Mantener un IMC saludable entre 18.5 y 24.9</p>
                                </div>

                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <div class="text-3xl mb-2">🩸</div>
                                    <h4 class="font-semibold text-gray-800">Glucosa</h4>
                                    <p class="text-sm text-gray-600">Chequeo anual si hay riesgo de diabetes</p>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-pills text-orange-500 mr-2"></i>
                                Manejo de Medicamentos
                            </h3>

                            <div class="bg-orange-50 border-l-4 border-orange-400 p-4 mb-6">
                                <h4 class="font-semibold text-orange-800 mb-2">Consejos para el Uso Seguro de Medicamentos:</h4>
                                <ul class="list-disc list-inside text-gray-700 space-y-1">
                                    <li>Sigue siempre las indicaciones de tu médico</li>
                                    <li>No automediques ni compartas medicamentos</li>
                                    <li>Informa sobre alergias y otros medicamentos que tomas</li>
                                    <li>Almacena medicamentos apropiadamente</li>
                                    <li>Desecha medicamentos vencidos correctamente</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Sidebar con herramientas -->
                <div class="space-y-6">

                    <!-- Calendario de chequeos -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-calendar-alt text-green-600 mr-2"></i>
                            Calendario de Prevención
                        </h3>

                        <div class="space-y-3">
                            <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg">
                                <div class="bg-green-100 p-2 rounded-lg">
                                    <i class="fas fa-stethoscope text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-green-800 text-sm">Chequeo General</h4>
                                    <p class="text-xs text-gray-600">Anual</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg">
                                <div class="bg-blue-100 p-2 rounded-lg">
                                    <i class="fas fa-tooth text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-blue-800 text-sm">Dentista</h4>
                                    <p class="text-xs text-gray-600">Cada 6 meses</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-lg">
                                <div class="bg-purple-100 p-2 rounded-lg">
                                    <i class="fas fa-eye text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-purple-800 text-sm">Oftalmólogo</h4>
                                    <p class="text-xs text-gray-600">Cada 2 años</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recordatorios importantes -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-exclamation-circle text-yellow-600 mr-2"></i>
                            Alertas Médicas
                        </h3>

                        <div class="space-y-3">
                            <div class="p-3 bg-red-50 rounded-lg border-l-4 border-red-400">
                                <h4 class="font-semibold text-red-800 text-sm">Síntomas de Emergencia</h4>
                                <p class="text-xs text-gray-600">Dolor intenso en pecho, dificultad para respirar, pérdida de conciencia - ¡Llama al 911!</p>
                            </div>

                            <div class="p-3 bg-yellow-50 rounded-lg border-l-4 border-yellow-400">
                                <h4 class="font-semibold text-yellow-800 text-sm">Consulta Urgente</h4>
                                <p class="text-xs text-gray-600">Fiebre alta persistente, sangrado anormal, cambios repentinos en la visión.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recordatorio -->
                    <div class="bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl p-4">
                        <h4 class="font-semibold mb-2">
                            <i class="fas fa-bell mr-2"></i>
                            Recordatorio
                        </h4>
                        <p class="text-sm opacity-90">
                            La prevención es la mejor medicina. Un chequeo oportuno puede salvar vidas. ¡No pospongas tu salud!
                        </p>
                    </div>

                </div>

            </div>

        </main>

    </div>
</body>
</html>
