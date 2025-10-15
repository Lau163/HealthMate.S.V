<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Actividad Física | HealthMate</title>
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
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-8 mb-4 md:mb-6 lg:mb-8 mt-2 md:mt-4">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white text-center">
                    <i class="fas fa-running mr-3"></i> Actividad Física
                </h1>
                <p class="text-indigo-100 text-center mt-2 text-sm md:text-base">
                    Beneficios del ejercicio y cómo incorporarlo a tu rutina diaria
                </p>
            </div>

            <!-- Contenido principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                <!-- Artículo principal -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">

                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-dumbbell text-indigo-600 mr-2"></i>
                            Beneficios del Ejercicio Regular
                        </h2>

                        <div class="prose prose-lg max-w-none text-gray-700">
                            <p class="mb-4">
                                El ejercicio físico regular es uno de los pilares fundamentales de una vida saludable.
                                Sus beneficios van mucho más allá de la apariencia física, impactando positivamente en todos los aspectos de nuestra salud.
                            </p>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-heart text-red-500 mr-2"></i>
                                Beneficios Cardiovasculares
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="bg-red-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-red-800 mb-2 flex items-center">
                                        <i class="fas fa-heartbeat mr-2"></i>
                                        Corazón Más Fuerte
                                    </h4>
                                    <p class="text-sm text-gray-600">Reduce el riesgo de enfermedades cardíacas hasta en un 50% con ejercicio regular.</p>
                                </div>

                                <div class="bg-red-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-red-800 mb-2 flex items-center">
                                        <i class="fas fa-tint mr-2"></i>
                                        Presión Arterial
                                    </h4>
                                    <p class="text-sm text-gray-600">Ayuda a mantener niveles saludables de presión arterial de forma natural.</p>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-brain text-purple-500 mr-2"></i>
                                Beneficios Mentales
                            </h3>

                            <div class="bg-purple-50 border-l-4 border-purple-400 p-4 mb-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h4 class="font-semibold text-purple-800 mb-2">Mejora el Ánimo:</h4>
                                        <ul class="list-disc list-inside text-gray-700 text-sm">
                                            <li>Libera endorfinas (hormonas de la felicidad)</li>
                                            <li>Reduce síntomas de depresión y ansiedad</li>
                                            <li>Mejora la autoestima y confianza</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-purple-800 mb-2">Función Cognitiva:</h4>
                                        <ul class="list-disc list-inside text-gray-700 text-sm">
                                            <li>Mejora la memoria y concentración</li>
                                            <li>Reduce riesgo de demencia</li>
                                            <li>Estimula el crecimiento de nuevas neuronas</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-chart-line text-green-500 mr-2"></i>
                                Recomendaciones de la OMS
                            </h3>

                            <div class="bg-green-50 rounded-lg p-4 mb-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="text-center">
                                        <div class="text-4xl mb-2">💪</div>
                                        <h4 class="font-semibold text-green-800">Adultos (18-64 años)</h4>
                                        <p class="text-sm text-gray-700 mb-2">Al menos 150 minutos de actividad moderada por semana</p>
                                        <p class="text-xs text-gray-600">O 75 minutos de actividad vigorosa</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-4xl mb-2">🏃</div>
                                        <h4 class="font-semibold text-green-800">Mayores de 65 años</h4>
                                        <p class="text-sm text-gray-700 mb-2">Mismos requisitos más ejercicios de equilibrio</p>
                                        <p class="text-xs text-gray-600">Para prevenir caídas</p>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-list-ol text-blue-500 mr-2"></i>
                                Tipos de Actividad Física
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div class="text-center p-4 bg-blue-50 rounded-lg">
                                    <div class="text-3xl mb-2">🚶</div>
                                    <h4 class="font-semibold text-blue-800">Cardiovascular</h4>
                                    <p class="text-sm text-gray-600">Caminar, correr, nadar, ciclismo</p>
                                </div>

                                <div class="text-center p-4 bg-blue-50 rounded-lg">
                                    <div class="text-3xl mb-2">💪</div>
                                    <h4 class="font-semibold text-blue-800">Fuerza</h4>
                                    <p class="text-sm text-gray-600">Pesas, ejercicios corporales</p>
                                </div>

                                <div class="text-center p-4 bg-blue-50 rounded-lg">
                                    <div class="text-3xl mb-2">🤸</div>
                                    <h4 class="font-semibold text-blue-800">Flexibilidad</h4>
                                    <p class="text-sm text-gray-600">Yoga, estiramiento, pilates</p>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i>
                                Precauciones Importantes
                            </h3>

                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                                <h4 class="font-semibold text-yellow-800 mb-2">Antes de comenzar:</h4>
                                <ul class="list-disc list-inside text-gray-700 space-y-1">
                                    <li>Consulta con tu médico si tienes condiciones médicas preexistentes</li>
                                    <li>Comienza gradualmente, especialmente si eres principiante</li>
                                    <li>Usa el equipo adecuado y técnicas correctas</li>
                                    <li>Escucha a tu cuerpo y detente si sientes dolor</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Sidebar con rutinas -->
                <div class="space-y-6">

                    <!-- Rutina semanal sugerida -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-calendar-week text-indigo-600 mr-2"></i>
                            Rutina Semanal Sugerida
                        </h3>

                        <div class="space-y-3">
                            <div class="flex items-center space-x-3 p-3 bg-indigo-50 rounded-lg">
                                <div class="bg-indigo-100 p-2 rounded-lg">
                                    <span class="font-bold text-indigo-600">L</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-indigo-800 text-sm">Lunes</h4>
                                    <p class="text-xs text-gray-600">Cardio: 30 min caminata rápida</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-lg">
                                <div class="bg-purple-100 p-2 rounded-lg">
                                    <span class="font-bold text-purple-600">M</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-purple-800 text-sm">Martes</h4>
                                    <p class="text-xs text-gray-600">Fuerza: Ejercicios corporales</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 p-3 bg-indigo-50 rounded-lg">
                                <div class="bg-indigo-100 p-2 rounded-lg">
                                    <span class="font-bold text-indigo-600">X</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-indigo-800 text-sm">Miércoles</h4>
                                    <p class="text-xs text-gray-600">Descanso activo: Yoga o natación</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-lg">
                                <div class="bg-purple-100 p-2 rounded-lg">
                                    <span class="font-bold text-purple-600">J</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-purple-800 text-sm">Jueves</h4>
                                    <p class="text-xs text-gray-600">Cardio: 20 min HIIT</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 p-3 bg-indigo-50 rounded-lg">
                                <div class="bg-indigo-100 p-2 rounded-lg">
                                    <span class="font-bold text-indigo-600">V</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-indigo-800 text-sm">Viernes</h4>
                                    <p class="text-xs text-gray-600">Fuerza: Rutina completa</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Consejos para principiantes -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-seedling text-green-600 mr-2"></i>
                            Para Principiantes
                        </h3>

                        <div class="space-y-3">
                            <div class="flex items-start space-x-3">
                                <div class="bg-green-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-clock text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Empieza Poco a Poco</h4>
                                    <p class="text-xs text-gray-600">Comienza con 10-15 minutos al día e incrementa gradualmente.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="bg-green-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-shoe-prints text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Elige Actividades Divertidas</h4>
                                    <p class="text-xs text-gray-600">Baila, nada o juega con amigos para que el ejercicio sea placentero.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="bg-green-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-users text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Busca Compañía</h4>
                                    <p class="text-xs text-gray-600">Ejercitar con amigos o familiares aumenta la motivación y el compromiso.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recordatorio -->
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl p-4">
                        <h4 class="font-semibold mb-2">
                            <i class="fas fa-bell mr-2"></i>
                            Recordatorio
                        </h4>
                        <p class="text-sm opacity-90">
                            Cualquier actividad física es mejor que ninguna. Encuentra algo que disfrutes y conviértelo en un hábito para toda la vida.
                        </p>
                    </div>

                </div>

            </div>

        </main>

    </div>
</body>
</html>
