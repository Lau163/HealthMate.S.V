<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Gráficas - Dashboard | HealthMate</title>
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
    <div class="w-full min-h-screen bg-gradient-to-br from-sky-200 via-sky-100 to-purple-100 overflow-x-hidden">
        
        <?php include('navbar.view.php') ?>
        
        <!-- Contenido principal -->
        <main class="container mx-auto px-3 sm:px-4 py-4 md:py-6 lg:px-8 max-w-7xl">
            
            <!-- Header con usuario -->
            <div class="bg-gradient-to-r from-violet-700 to-indigo-950 rounded-xl md:rounded-2xl p-4 sm:p-6 mb-4 md:mb-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-white">
                        <i class="fas fa-chart-bar mr-2"></i> Dashboard
                    </h1>
                    <div class="text-white text-sm md:text-base">
                        <i class="fas fa-user-circle mr-2"></i> @say.valente
                    </div>
                </div>
            </div>
            
            <!-- Grid de estadísticas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6">
                
                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <div class="bg-teal-100 p-3 rounded-lg">
                            <i class="fas fa-heartbeat text-2xl text-teal-600"></i>
                        </div>
                        <span class="text-2xl md:text-3xl font-bold text-gray-800">120</span>
                    </div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-600">Frecuencia Cardíaca</h3>
                    <p class="text-xs text-gray-500 mt-1">bpm</p>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i class="fas fa-lungs text-2xl text-blue-600"></i>
                        </div>
                        <span class="text-2xl md:text-3xl font-bold text-gray-800">98%</span>
                    </div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-600">Saturación O2</h3>
                    <p class="text-xs text-gray-500 mt-1">SpO2</p>
                </div>
                
                <!-- Card 3 -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <div class="bg-red-100 p-3 rounded-lg">
                            <i class="fas fa-thermometer-half text-2xl text-red-600"></i>
                        </div>
                        <span class="text-2xl md:text-3xl font-bold text-gray-800">36.5°</span>
                    </div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-600">Temperatura</h3>
                    <p class="text-xs text-gray-500 mt-1">Celsius</p>
                </div>
                
            </div>
            
            <!-- Gráficas principales -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6 mb-6">
                
                <!-- Gráfica grande -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-4">
                        <i class="fas fa-chart-line mr-2 text-teal-600"></i> Tendencia Semanal
                    </h3>
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-4 md:p-8 h-48 md:h-64 flex items-center justify-center">
                        <div class="text-center text-gray-400">
                            <i class="fas fa-chart-area text-4xl md:text-6xl mb-3"></i>
                            <p class="text-sm md:text-base">Gráfica de tendencias</p>
                        </div>
                    </div>
                </div>
                
                <!-- Gráfica lateral -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-4">
                        <i class="fas fa-chart-pie mr-2 text-purple-600"></i> Distribución
                    </h3>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 h-48 md:h-64 flex items-center justify-center">
                        <div class="text-center text-purple-400">
                            <i class="fas fa-chart-pie text-4xl md:text-6xl mb-3"></i>
                            <p class="text-sm md:text-base">Gráfica circular</p>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Gráficas inferiores -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                
                <!-- Gráfica 1 -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h3 class="text-base md:text-lg font-bold text-gray-800 mb-4">
                        <i class="fas fa-heartbeat mr-2 text-red-600"></i> Presión Arterial
                    </h3>
                    <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 h-32 md:h-40 flex items-center justify-center">
                        <div class="text-center text-red-400">
                            <i class="fas fa-chart-bar text-3xl md:text-5xl mb-2"></i>
                            <p class="text-xs md:text-sm">120/80 mmHg</p>
                        </div>
                    </div>
                </div>
                
                <!-- Gráfica 2 -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h3 class="text-base md:text-lg font-bold text-gray-800 mb-4">
                        <i class="fas fa-wind mr-2 text-blue-600"></i> Frecuencia Respiratoria
                    </h3>
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 h-32 md:h-40 flex items-center justify-center">
                        <div class="text-center text-blue-400">
                            <i class="fas fa-chart-line text-3xl md:text-5xl mb-2"></i>
                            <p class="text-xs md:text-sm">16 rpm</p>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Menú lateral simulado -->
            <div class="fixed bottom-4 right-4 lg:bottom-8 lg:right-8 flex flex-col space-y-3">
                <button class="bg-violet-700 hover:bg-violet-800 text-white p-3 md:p-4 rounded-full shadow-lg transition-all">
                    <i class="fas fa-home text-lg md:text-xl"></i>
                </button>
                <button class="bg-gray-700 hover:bg-gray-800 text-white p-3 md:p-4 rounded-full shadow-lg transition-all">
                    <i class="fas fa-chart-bar text-lg md:text-xl"></i>
                </button>
                <button class="bg-gray-700 hover:bg-gray-800 text-white p-3 md:p-4 rounded-full shadow-lg transition-all">
                    <i class="fas fa-bell text-lg md:text-xl"></i>
                </button>
                <button class="bg-gray-700 hover:bg-gray-800 text-white p-3 md:p-4 rounded-full shadow-lg transition-all">
                    <i class="fas fa-cog text-lg md:text-xl"></i>
                </button>
            </div>
            
        </main>
        
    </div>
</body>
</html>
