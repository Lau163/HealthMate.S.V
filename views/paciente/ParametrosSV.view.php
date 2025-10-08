<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Signos Vitales | HealthMate</title>
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
            <div class="bg-emerald-300/80 rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-8 mb-4 md:mb-6 lg:mb-8 mt-2 md:mt-4">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-black text-center">
                    SIGNOS VITALES
                </h1>
            </div>
            
            <!-- Layout con sidebar y contenido -->
            <div class="flex flex-col lg:flex-row gap-4 md:gap-6">
                
                <!-- Sidebar - Filtro -->
                <aside class="w-full lg:w-1/4 flex-shrink-0">
                    <div class="bg-white rounded-lg shadow-md border border-black p-4 md:p-6">
                        <h2 class="text-lg md:text-xl font-bold text-black mb-3 md:mb-4 text-center">
                            FILTRADO POR
                        </h2>
                        <div class="mb-4">
                            <p class="text-teal-700 text-base md:text-lg font-bold text-center mb-4">Categoría</p>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="w-5 h-5 border-2 border-black" />
                                <label class="text-stone-500/90 text-base md:text-lg font-bold">PERFIL</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="w-5 h-5 border-2 border-black" />
                                <label class="text-stone-500/90 text-base md:text-lg font-bold">DATOS</label>
                            </div>
                        </div>
                    </div>
                </aside>
                
                <!-- Contenido principal - Imagen de parámetros -->
                <div class="flex-1 w-full">
                    <div class="bg-white rounded-lg shadow-lg p-4 md:p-6">
                        <img class="w-full h-auto object-contain rounded-lg" 
                             src="<?= constant("URL") ?>public/img/PX/PSV.png" 
                             alt="Parámetros de Signos Vitales" />
                    </div>
                </div>
                
            </div>
            
        </main>
        
    </div>
</body>