<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Bienestar Mental | HealthMate</title>
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
            <div class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-8 mb-4 md:mb-6 lg:mb-8 mt-2 md:mt-4">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white text-center">
                    <i class="fas fa-brain mr-3"></i> Bienestar Mental
                </h1>
                <p class="text-purple-100 text-center mt-2 text-sm md:text-base">
                    Consejos y técnicas para mantener una mente sana y equilibrada
                </p>
            </div>

            <!-- Contenido principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                <!-- Artículo principal -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">

                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-heart text-purple-600 mr-2"></i>
                            Introducción al Bienestar Mental
                        </h2>

                        <div class="prose prose-lg max-w-none text-gray-700">
                            <p class="mb-4">
                                El bienestar mental es fundamental para nuestra calidad de vida. No se trata solo de la ausencia de enfermedades mentales,
                                sino de un estado de completo bienestar emocional, psicológico y social que nos permite enfrentar los desafíos diarios,
                                trabajar de manera productiva y contribuir a nuestra comunidad.
                            </p>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-star text-yellow-500 mr-2"></i>
                                Beneficios del Bienestar Mental
                            </h3>

                            <ul class="list-disc list-inside mb-6 space-y-2">
                                <li><strong>Mejor manejo del estrés:</strong> Técnicas efectivas para reducir la ansiedad y la tensión diaria</li>
                                <li><strong>Relaciones más saludables:</strong> Comunicación efectiva y empatía mejorada</li>
                                <li><strong>Mayor productividad:</strong> Concentración y enfoque mejorados en el trabajo y estudios</li>
                                <li><strong>Sueño de calidad:</strong> Descanso más reparador y recuperación adecuada</li>
                                <li><strong>Autoestima elevada:</strong> Mayor confianza y seguridad personal</li>
                            </ul>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-lightbulb text-yellow-400 mr-2"></i>
                                Estrategias Prácticas
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div class="bg-purple-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-purple-800 mb-2">Meditación Diaria</h4>
                                    <p class="text-sm text-gray-600">Dedica 10-15 minutos al día a la meditación mindfulness para reducir el estrés y mejorar la concentración.</p>
                                </div>

                                <div class="bg-purple-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-purple-800 mb-2">Gratitud</h4>
                                    <p class="text-sm text-gray-600">Escribe tres cosas por las que estás agradecido cada día para fomentar una actitud positiva.</p>
                                </div>

                                <div class="bg-purple-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-purple-800 mb-2">Conexiones Sociales</h4>
                                    <p class="text-sm text-gray-600">Mantén relaciones significativas y busca apoyo cuando lo necesites.</p>
                                </div>

                                <div class="bg-purple-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-purple-800 mb-2">Límites Saludables</h4>
                                    <p class="text-sm text-gray-600">Aprende a decir "no" y establece límites claros en tus relaciones y responsabilidades.</p>
                                </div>
                            </div>

                            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mt-8">
                                <h4 class="font-semibold text-blue-800 mb-2">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    ¿Cuándo buscar ayuda profesional?
                                </h4>
                                <p class="text-sm text-gray-700">
                                    Si experimentas síntomas persistentes como ansiedad intensa, depresión, cambios de humor extremos,
                                    o dificultad para realizar actividades diarias, consulta con un profesional de la salud mental.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar con consejos rápidos -->
                <div class="space-y-6">

                    <!-- Consejos rápidos -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-clock text-purple-600 mr-2"></i>
                            Consejos Rápidos
                        </h3>

                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="bg-purple-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-sun text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Técnica 5-4-3-2-1</h4>
                                    <p class="text-xs text-gray-600">Para momentos de ansiedad: nombra 5 cosas que ves, 4 que tocas, 3 que oyes, 2 que hueles, 1 que saboreas.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="bg-purple-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-moon text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Respiración 4-7-8</h4>
                                    <p class="text-xs text-gray-600">Inhala 4 segundos, retiene 7, exhala 8. Repite 4 veces para relajarte antes de dormir.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="bg-purple-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-users text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Contacto Social</h4>
                                    <p class="text-xs text-gray-600">Una llamada de 10 minutos con un ser querido puede mejorar significativamente tu estado de ánimo.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recursos -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-book-open text-purple-600 mr-2"></i>
                            Recursos Adicionales
                        </h3>

                        <div class="space-y-3">
                            <a href="#" class="block bg-gray-50 hover:bg-gray-100 p-3 rounded-lg transition-colors">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-file-pdf text-red-500"></i>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm">Guía de Meditación</p>
                                        <p class="text-xs text-gray-600">Técnicas básicas de mindfulness</p>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="block bg-gray-50 hover:bg-gray-100 p-3 rounded-lg transition-colors">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-video text-blue-500"></i>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm">Videos de Relajación</p>
                                        <p class="text-xs text-gray-600">Sesiones guiadas de 10 minutos</p>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="block bg-gray-50 hover:bg-gray-100 p-3 rounded-lg transition-colors">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-phone text-green-500"></i>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm">Líneas de Apoyo</p>
                                        <p class="text-xs text-gray-600">24/7 para crisis emocionales</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Recordatorio -->
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl p-4">
                        <h4 class="font-semibold mb-2">
                            <i class="fas fa-bell mr-2"></i>
                            Recordatorio
                        </h4>
                        <p class="text-sm opacity-90">
                            Tu salud mental es tan importante como tu salud física. No dudes en buscar ayuda profesional cuando la necesites.
                        </p>
                    </div>

                </div>

            </div>

        </main>

    </div>
</body>
</html>
