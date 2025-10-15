<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Alimentación Saludable | HealthMate</title>
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
            <div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-8 mb-4 md:mb-6 lg:mb-8 mt-2 md:mt-4">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white text-center">
                    <i class="fas fa-utensils mr-3"></i> Alimentación Saludable
                </h1>
                <p class="text-orange-100 text-center mt-2 text-sm md:text-base">
                    Consejos nutricionales para mantener una dieta equilibrada y saludable
                </p>
            </div>

            <!-- Contenido principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                <!-- Artículo principal -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">

                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-apple-alt text-orange-600 mr-2"></i>
                            Fundamentos de la Alimentación Saludable
                        </h2>

                        <div class="prose prose-lg max-w-none text-gray-700">
                            <p class="mb-4">
                                Una alimentación saludable es la base de una buena salud. No se trata de dietas restrictivas,
                                sino de crear hábitos sostenibles que nutran tu cuerpo y te hagan sentir con energía durante todo el día.
                            </p>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-balance-scale text-orange-500 mr-2"></i>
                                El Plato Saludable
                            </h3>

                            <div class="bg-orange-50 border-l-4 border-orange-400 p-4 mb-6">
                                <p class="text-gray-700">
                                    <strong>Idealmente, tu plato debería contener:</strong>
                                </p>
                                <ul class="list-disc list-inside mt-2 space-y-1 text-gray-700">
                                    <li><strong>50% vegetales:</strong> Variedad de colores para obtener diferentes nutrientes</li>
                                    <li><strong>25% proteínas:</strong> Fuentes magras como pollo, pescado, legumbres, huevos</li>
                                    <li><strong>25% carbohidratos:</strong> Granos integrales, arroz integral, quinoa</li>
                                </ul>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-list-ul text-green-500 mr-2"></i>
                                Hábitos Alimenticios Saludables
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div class="border border-green-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-green-800 mb-2 flex items-center">
                                        <i class="fas fa-clock mr-2"></i>
                                        Horarios Regulares
                                    </h4>
                                    <p class="text-sm text-gray-600">Come cada 3-4 horas para mantener estables los niveles de azúcar en sangre.</p>
                                </div>

                                <div class="border border-green-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-green-800 mb-2 flex items-center">
                                        <i class="fas fa-tint mr-2"></i>
                                        Hidratación
                                    </h4>
                                    <p class="text-sm text-gray-600">Bebe agua antes de las comidas, no durante, para una mejor digestión.</p>
                                </div>

                                <div class="border border-green-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-green-800 mb-2 flex items-center">
                                        <i class="fas fa-leaf mr-2"></i>
                                        Colores Naturales
                                    </h4>
                                    <p class="text-sm text-gray-600">"Come el arcoíris" - incluye frutas y vegetales de todos los colores.</p>
                                </div>

                                <div class="border border-green-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-green-800 mb-2 flex items-center">
                                        <i class="fas fa-brain mr-2"></i>
                                        Comer Consciente
                                    </h4>
                                    <p class="text-sm text-gray-600">Come sin distracciones, saboreando cada bocado.</p>
                                </div>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i>
                                Señales de Alerta
                            </h3>

                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                                <p class="text-gray-700 mb-2"><strong>Consulta a un profesional si experimentas:</strong></p>
                                <ul class="list-disc list-inside text-gray-700 space-y-1">
                                    <li>Pérdida o ganancia de peso inexplicada</li>
                                    <li>Fatiga constante después de las comidas</li>
                                    <li>Problemas digestivos persistentes</li>
                                    <li>Deficiencias nutricionales diagnosticadas</li>
                                </ul>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">
                                <i class="fas fa-shopping-cart text-blue-500 mr-2"></i>
                                Planificación de Compras
                            </h3>

                            <div class="bg-blue-50 rounded-lg p-4">
                                <h4 class="font-semibold text-blue-800 mb-3">Lista de Compras Saludable:</h4>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <h5 class="font-semibold text-blue-700">Frutas y Verduras:</h5>
                                        <ul class="list-disc list-inside text-gray-600">
                                            <li>Manzanas</li>
                                            <li>Plátanos</li>
                                            <li>Espinacas</li>
                                            <li>Brócoli</li>
                                            <li>Zanahorias</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5 class="font-semibold text-blue-700">Proteínas:</h5>
                                        <ul class="list-disc list-inside text-gray-600">
                                            <li>Pechuga de pollo</li>
                                            <li>Pescado</li>
                                            <li>Huevos</li>
                                            <li>Lentejas</li>
                                            <li>Nueces</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Sidebar con consejos rápidos -->
                <div class="space-y-6">

                    <!-- Consejos rápidos -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-lightbulb text-orange-600 mr-2"></i>
                            Consejos Rápidos
                        </h3>

                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="bg-orange-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-cookie-bite text-orange-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Snacks Saludables</h4>
                                    <p class="text-xs text-gray-600">Manzana con mantequilla de nuez, yogurt con frutas, o zanahorias con hummus.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="bg-orange-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-weight text-orange-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Porciones Controladas</h4>
                                    <p class="text-xs text-gray-600">Usa platos más pequeños y sírvete porciones razonables para evitar excesos.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="bg-orange-100 p-2 rounded-lg flex-shrink-0">
                                    <i class="fas fa-seedling text-orange-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Variedad es Clave</h4>
                                    <p class="text-xs text-gray-600">No te limites a los mismos alimentos; prueba nuevos vegetales y proteínas cada semana.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Calculadora de calorías -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-calculator text-orange-600 mr-2"></i>
                            Guía de Calorías
                        </h3>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Mantenimiento:</span>
                                <span class="font-semibold">2,000-2,500 cal/día</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pérdida de peso:</span>
                                <span class="font-semibold">1,500-2,000 cal/día</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Ganancia muscular:</span>
                                <span class="font-semibold">2,500-3,000 cal/día</span>
                            </div>
                        </div>

                        <div class="mt-4 p-3 bg-orange-50 rounded-lg">
                            <p class="text-xs text-gray-600">
                                <strong>Nota:</strong> Estas son estimaciones generales. Consulta con un nutricionista para recomendaciones personalizadas.
                            </p>
                        </div>
                    </div>

                    <!-- Recordatorio -->
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl p-4">
                        <h4 class="font-semibold mb-2">
                            <i class="fas fa-bell mr-2"></i>
                            Recordatorio
                        </h4>
                        <p class="text-sm opacity-90">
                            Una alimentación saludable es un viaje, no un destino. Sé paciente contigo mismo y celebra los pequeños cambios.
                        </p>
                    </div>

                </div>

            </div>

        </main>

    </div>
</body>
</html>
