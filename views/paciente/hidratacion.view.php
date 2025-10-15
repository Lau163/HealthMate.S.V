<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Hidratación Saludable | HealthMate</title>
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
            <div class="bg-gradient-to-r from-blue-500 to-cyan-600 rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-8 mb-4 md:mb-6 lg:mb-8 mt-2 md:mt-4">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white text-center">
                    <i class="fas fa-tint mr-3"></i> Hidratación Saludable
                </h1>
                <p class="text-blue-100 text-center mt-2 text-sm md:text-base">
                    La importancia del agua y cómo mantenerte adecuadamente hidratado
                </p>
            </div>

            <!-- Contenido principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                <!-- Artículo principal -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">

                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-water text-blue-600 mr-2"></i>
                            ¿Por qué es importante la hidratación?
                        </h2>

                        <div class="prose prose-lg max-w-none text-gray-700">
                            <p class="mb-4">
                                El agua es esencial para la vida. Nuestro cuerpo está compuesto aproximadamente de un 60% de agua,
                                y esta sustancia participa en prácticamente todas las funciones corporales importantes.
                            </p>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-list-check text-blue-500 mr-2"></i>
                                Funciones del Agua en el Organismo
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-blue-800 mb-2 flex items-center">
                                        <i class="fas fa-thermometer-half mr-2"></i>
                                        Regulación de Temperatura
                                    </h4>
                                    <p class="text-sm text-gray-600">El agua ayuda a mantener la temperatura corporal estable mediante la sudoración.</p>
                                </div>

                                <div class="bg-blue-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-blue-800 mb-2 flex items-center">
                                        <i class="fas fa-heartbeat mr-2"></i>
                                        Transporte de Nutrientes
                                    </h4>
                                    <p class="text-sm text-gray-600">Transporta vitaminas, minerales y hormonas por todo el cuerpo.</p>
                                </div>

                                <div class="bg-blue-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-blue-800 mb-2 flex items-center">
                                        <i class="fas fa-broom mr-2"></i>
                                        Eliminación de Toxinas
                                    </h4>
                                    <p class="text-sm text-gray-600">Ayuda a eliminar desechos y toxinas a través de la orina y el sudor.</p>
                                </div>

                                <div class="bg-blue-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-blue-800 mb-2 flex items-center">
                                        <i class="fas fa-brain mr-2"></i>
                                        Función Cognitiva
                                    </h4>
                                    <p class="text-sm text-gray-600">Mantiene el cerebro hidratado, mejorando la concentración y el estado de alerta.</p>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-calculator text-cyan-500 mr-2"></i>
                                ¿Cuánta agua necesitas?
                            </h3>

                            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg p-4 mb-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                                    <div>
                                        <h4 class="font-semibold text-blue-800">Adulto Promedio</h4>
                                        <p class="text-2xl font-bold text-blue-600">2-3 litros</p>
                                        <p class="text-sm text-gray-600">por día</p>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-blue-800">Ejercicio Intenso</h4>
                                        <p class="text-2xl font-bold text-blue-600">3-4 litros</p>
                                        <p class="text-sm text-gray-600">por día</p>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-blue-800">Clima Caluroso</h4>
                                        <p class="text-2xl font-bold text-blue-600">+1 litro</p>
                                        <p class="text-sm text-gray-600">extra por día</p>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i>
                                Señales de Deshidratación
                            </h3>

                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h4 class="font-semibold text-yellow-800 mb-2">Síntomas Leves:</h4>
                                        <ul class="list-disc list-inside text-gray-700 text-sm space-y-1">
                                            <li>Boca seca</li>
                                            <li>Sed intensa</li>
                                            <li>Orina oscura</li>
                                            <li>Fatiga</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-yellow-800 mb-2">Síntomas Graves:</h4>
                                        <ul class="list-disc list-inside text-gray-700 text-sm space-y-1">
                                            <li>Mareos</li>
                                            <li>Confusión</li>
                                            <li>Taquicardia</li>
                                            <li>Pérdida de conciencia</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-glass-water text-blue-500 mr-2"></i>
                                Consejos para Mantenerte Hidratado
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="bg-blue-100 p-2 rounded-lg flex-shrink-0">
                                            <i class="fas fa-clock text-blue-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Horario Regular</h4>
                                            <p class="text-sm text-gray-600">Bebe agua a intervalos regulares, incluso si no tienes sed.</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start space-x-3">
                                        <div class="bg-blue-100 p-2 rounded-lg flex-shrink-0">
                                            <i class="fas fa-thermometer-half text-blue-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Monitorea el Color</h4>
                                            <p class="text-sm text-gray-600">Tu orina debe ser de color amarillo claro, como limonada.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="bg-blue-100 p-2 rounded-lg flex-shrink-0">
                                            <i class="fas fa-bottle-water text-blue-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Lleva tu Botella</h4>
                                            <p class="text-sm text-gray-600">Ten siempre una botella de agua reutilizable contigo.</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start space-x-3">
                                        <div class="bg-blue-100 p-2 rounded-lg flex-shrink-0">
                                            <i class="fas fa-apple-alt text-blue-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Alimentos Hidratantes</h4>
                                            <p class="text-sm text-gray-600">Incluye frutas y vegetales con alto contenido de agua como sandía, pepino y naranjas.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Sidebar con herramientas -->
                <div class="space-y-6">

                    <!-- Calculadora de hidratación -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-calculator text-blue-600 mr-2"></i>
                            Calculadora de Hidratación
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tu peso (kg)</label>
                                <input type="number" id="peso" placeholder="70" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nivel de actividad</label>
                                <select id="actividad" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="1.2">Sedentario</option>
                                    <option value="1.5">Moderado</option>
                                    <option value="1.8">Alto</option>
                                </select>
                            </div>

                            <button onclick="calcularHidratacion()" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors">
                                Calcular
                            </button>

                            <div id="resultado" class="mt-4 p-3 bg-blue-50 rounded-lg hidden">
                                <p class="text-sm text-gray-700">
                                    Necesitas aproximadamente: <span id="cantidad-agua" class="font-bold text-blue-600"></span> litros por día
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Consejos rápidos -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-lightbulb text-cyan-600 mr-2"></i>
                            Consejos Prácticos
                        </h3>

                        <div class="space-y-3">
                            <div class="flex items-start space-x-3">
                                <div class="bg-cyan-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-mobile-alt text-cyan-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Apps Recordatorias</h4>
                                    <p class="text-xs text-gray-600">Usa aplicaciones que te recuerden beber agua regularmente.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="bg-cyan-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-coffee text-cyan-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Limita Cafeína</h4>
                                    <p class="text-xs text-gray-600">El café y el té pueden deshidratar; compensa con agua adicional.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recordatorio -->
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl p-4">
                        <h4 class="font-semibold mb-2">
                            <i class="fas fa-bell mr-2"></i>
                            Recordatorio
                        </h4>
                        <p class="text-sm opacity-90">
                            La hidratación adecuada es esencial para el óptimo funcionamiento de todos tus órganos. ¡No esperes a tener sed!
                        </p>
                    </div>

                </div>

            </div>

        </main>

        <script>
            function calcularHidratacion() {
                const peso = parseFloat(document.getElementById('peso').value);
                const actividad = parseFloat(document.getElementById('actividad').value);

                if (peso && actividad) {
                    const litrosNecesarios = (peso * 0.033 * actividad).toFixed(2);
                    document.getElementById('cantidad-agua').textContent = litrosNecesarios;
                    document.getElementById('resultado').classList.remove('hidden');
                }
            }
        </script>

    </div>
</body>
</html>
