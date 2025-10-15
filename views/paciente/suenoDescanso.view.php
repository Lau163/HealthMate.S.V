<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Sueño y Descanso | HealthMate</title>
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
            <div class="bg-gradient-to-r from-indigo-800 to-purple-900 rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-8 mb-4 md:mb-6 lg:mb-8 mt-2 md:mt-4">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white text-center">
                    <i class="fas fa-moon mr-3"></i> Sueño y Descanso
                </h1>
                <p class="text-indigo-100 text-center mt-2 text-sm md:text-base">
                    La importancia del descanso reparador para tu salud física y mental
                </p>
            </div>

            <!-- Contenido principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                <!-- Artículo principal -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">

                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-bed text-indigo-600 mr-2"></i>
                            El Sueño: Pilar Fundamental de la Salud
                        </h2>

                        <div class="prose prose-lg max-w-none text-gray-700">
                            <p class="mb-4">
                                Dormir bien no es un lujo, es una necesidad biológica. Durante el sueño, nuestro cuerpo realiza
                                funciones esenciales de reparación, consolidación de la memoria y regulación hormonal.
                            </p>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-clock text-blue-500 mr-2"></i>
                                ¿Cuántas Horas Necesitas?
                            </h3>

                            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="text-center">
                                        <h4 class="font-semibold text-blue-800">Adultos (18-64 años)</h4>
                                        <p class="text-3xl font-bold text-blue-600">7-9 horas</p>
                                        <p class="text-sm text-gray-600">por noche</p>
                                    </div>
                                    <div class="text-center">
                                        <h4 class="font-semibold text-blue-800">Adultos mayores (65+)</h4>
                                        <p class="text-3xl font-bold text-blue-600">7-8 horas</p>
                                        <p class="text-sm text-gray-600">por noche</p>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-star text-yellow-500 mr-2"></i>
                                Beneficios del Sueño de Calidad
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="bg-yellow-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-yellow-800 mb-2 flex items-center">
                                        <i class="fas fa-brain mr-2"></i>
                                        Función Cognitiva
                                    </h4>
                                    <p class="text-sm text-gray-600">Mejora la memoria, concentración y toma de decisiones. Reduce el riesgo de demencia.</p>
                                </div>

                                <div class="bg-yellow-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-yellow-800 mb-2 flex items-center">
                                        <i class="fas fa-heart mr-2"></i>
                                        Salud Cardiovascular
                                    </h4>
                                    <p class="text-sm text-gray-600">Reduce el riesgo de hipertensión, infartos y accidentes cerebrovasculares.</p>
                                </div>

                                <div class="bg-yellow-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-yellow-800 mb-2 flex items-center">
                                        <i class="fas fa-shield-alt mr-2"></i>
                                        Sistema Inmune
                                    </h4>
                                    <p class="text-sm text-gray-600">Fortalece las defensas naturales del cuerpo contra infecciones y enfermedades.</p>
                                </div>

                                <div class="bg-yellow-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-yellow-800 mb-2 flex items-center">
                                        <i class="fas fa-weight mr-2"></i>
                                        Control de Peso
                                    </h4>
                                    <p class="text-sm text-gray-600">Regula las hormonas del apetito, ayudando a mantener un peso saludable.</p>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                                Consecuencias del Sueño Insuficiente
                            </h3>

                            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h4 class="font-semibold text-red-800 mb-2">A Corto Plazo:</h4>
                                        <ul class="list-disc list-inside text-gray-700 text-sm">
                                            <li>Somnolencia diurna</li>
                                            <li>Dificultad para concentrarse</li>
                                            <li>Cambios de humor</li>
                                            <li>Disminución del rendimiento</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-red-800 mb-2">A Largo Plazo:</h4>
                                        <ul class="list-disc list-inside text-gray-700 text-sm">
                                            <li>Aumento riesgo de obesidad</li>
                                            <li>Problemas cardíacos</li>
                                            <li>Debilidad del sistema inmune</li>
                                            <li>Trastornos mentales</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-cog text-purple-500 mr-2"></i>
                                Mejora tu Higiene del Sueño
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="bg-purple-100 p-2 rounded-lg flex-shrink-0">
                                            <i class="fas fa-clock text-purple-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Horario Consistente</h4>
                                            <p class="text-sm text-gray-600">Acuéstate y levántate a la misma hora todos los días, incluso los fines de semana.</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start space-x-3">
                                        <div class="bg-purple-100 p-2 rounded-lg flex-shrink-0">
                                            <i class="fas fa-bed text-purple-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Ambiente Adecuado</h4>
                                            <p class="text-sm text-gray-600">Dormitorio oscuro, fresco (18-22°C) y silencioso.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="bg-purple-100 p-2 rounded-lg flex-shrink-0">
                                            <i class="fas fa-mobile-alt text-purple-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Sin Pantallas</h4>
                                            <p class="text-sm text-gray-600">Evita dispositivos electrónicos al menos 1 hora antes de dormir.</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start space-x-3">
                                        <div class="bg-purple-100 p-2 rounded-lg flex-shrink-0">
                                            <i class="fas fa-coffee text-purple-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Cena Ligera</h4>
                                            <p class="text-sm text-gray-600">Cena al menos 3 horas antes de dormir y evita cafeína después del mediodía.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Sidebar con herramientas -->
                <div class="space-y-6">

                    <!-- Test de calidad de sueño -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-clipboard-check text-indigo-600 mr-2"></i>
                            Evalúa tu Sueño
                        </h3>

                        <div class="space-y-3">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="w-4 h-4 text-indigo-600">
                                <label class="text-sm text-gray-700">Me cuesta conciliar el sueño</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="w-4 h-4 text-indigo-600">
                                <label class="text-sm text-gray-700">Me despierto frecuentemente durante la noche</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="w-4 h-4 text-indigo-600">
                                <label class="text-sm text-gray-700">Ronco o tengo apneas del sueño</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="w-4 h-4 text-indigo-600">
                                <label class="text-sm text-gray-700">Me siento somnoliento durante el día</label>
                            </div>
                        </div>

                        <div class="mt-4 p-3 bg-indigo-50 rounded-lg">
                            <p class="text-xs text-gray-600">
                                Si marcas 2 o más opciones, considera consultar con un especialista del sueño.
                            </p>
                        </div>
                    </div>

                    <!-- Consejos rápidos -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-lightbulb text-purple-600 mr-2"></i>
                            Consejos Rápidos
                        </h3>

                        <div class="space-y-3">
                            <div class="flex items-start space-x-3">
                                <div class="bg-purple-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-thermometer-half text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Temperatura Ideal</h4>
                                    <p class="text-xs text-gray-600">Mantén tu habitación entre 18-22°C para un sueño óptimo.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="bg-purple-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-bath text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Baño Tibio</h4>
                                    <p class="text-xs text-gray-600">Un baño tibio 1 hora antes de dormir ayuda a relajar el cuerpo.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="bg-purple-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-book text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Lectura Relajante</h4>
                                    <p class="text-xs text-gray-600">Lee un libro físico antes de dormir en lugar de usar pantallas.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recordatorio -->
                    <div class="bg-gradient-to-r from-indigo-800 to-purple-800 text-white rounded-xl p-4">
                        <h4 class="font-semibold mb-2">
                            <i class="fas fa-bell mr-2"></i>
                            Recordatorio
                        </h4>
                        <p class="text-sm opacity-90">
                            El sueño es el mejor medicamento natural. Priorízalo como parte esencial de tu rutina de autocuidado.
                        </p>
                    </div>

                </div>

            </div>

        </main>

    </div>
</body>
</html>
