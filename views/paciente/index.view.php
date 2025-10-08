<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Pacientes | HealthMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Asegurar que el viewport se respete en móviles */
        * {
            box-sizing: border-box;
        }
        
        html, body {
            overflow-x: hidden;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        
        /* Prevenir scroll horizontal */
        body {
            position: relative;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen w-full">
    <!-- Container principal responsive -->
    <div class="w-full min-h-screen bg-white overflow-x-hidden">
        
        <?php include('navbar.view.php') ?>
        
        <!-- Contenido principal -->
        <main class="container mx-auto px-3 sm:px-4 py-4 md:py-6 lg:px-8 max-w-7xl">
            
            <!-- Banner de bienvenida -->
            <div class="bg-emerald-300/80 rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-8 mb-4 md:mb-6 lg:mb-8 mt-2 md:mt-4">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-black text-center">
                    Bienvenido a Health Mate
                </h1>
            </div>
            
            <!-- Layout principal con sidebar y contenido -->
            <div class="flex flex-col lg:flex-row gap-4 md:gap-6">
                
                <!-- Sidebar - Filtro -->
                <aside class="w-full lg:w-1/4 flex-shrink-0">
                    <div class="bg-white rounded-lg shadow-md border border-black p-4 md:p-6">
                        <h2 class="text-lg md:text-xl font-bold text-black mb-3 md:mb-4 text-center">
                            FILTRO SELECCIONADO
                        </h2>
                        <div class="mb-3 md:mb-4">
                            <p class="text-teal-700 text-base md:text-lg font-bold text-center mb-3 md:mb-4">Categoría</p>
                        </div>
                        <div class="text-center">
                            <p class="text-stone-500/90 text-sm md:text-base lg:text-lg font-bold">
                                Este sistema está diseñado para que puedas llevar el control de tus signos vitales
                            </p>
                        </div>
                    </div>
                </aside>
                
                <!-- Contenido principal - Cards -->
                <div class="flex-1 w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6">
                        
                        <!-- Card 1: Alimentación -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[280px] md:min-h-[320px]">
                            <img class="w-32 h-32 sm:w-36 sm:h-36 md:w-40 md:h-40 lg:w-48 lg:h-48 object-contain mb-3 md:mb-4" 
                                 src="<?= constant("URL") ?>public/img/PX/BA.png" 
                                 alt="Alimentación" />
                            <button class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                ALIMENTACIÓN
                            </button>
                        </div>
                        
                        <!-- Card 2: Parámetros de Signos Vitales -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[280px] md:min-h-[320px]">
                            <img class="w-36 h-36 sm:w-40 sm:h-40 md:w-44 md:h-44 lg:w-52 lg:h-52 object-contain mb-3 md:mb-4" 
                                 src="<?= constant("URL") ?>public/img/PX/S1.png" 
                                 alt="Signos Vitales" />
                            <a href="<?= constant("URL") ?>paciente/ParametrosSV" 
                               class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-sm md:text-base lg:text-lg font-bold py-2 md:py-3 px-3 md:px-4 rounded-2xl transition-colors w-full text-center block">
                                Parámetros De Los Signos Vitales
                            </a>
                        </div>
                        
                        <!-- Card 3: Alimentate Sanamente -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[280px] md:min-h-[320px]">
                            <img class="w-32 h-32 sm:w-36 sm:h-36 md:w-40 md:h-40 lg:w-48 lg:h-48 object-contain mb-3 md:mb-4" 
                                 src="<?= constant("URL") ?>public/img/PX/S3.png" 
                                 alt="Alimentación Saludable" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    Aliméntate Sanamente
                                </p>
                            </div>
                            <button class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 px-6 md:px-8 rounded-2xl transition-colors">
                                VER
                            </button>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
        </main>
        
    </div>
    
    <script>
        // Script para verificar el viewport en móviles
        console.log('Viewport width:', window.innerWidth);
        console.log('Device pixel ratio:', window.devicePixelRatio);
        
        // Prevenir zoom accidental en iOS
        document.addEventListener('gesturestart', function(e) {
            e.preventDefault();
        });
    </script>
</body>
</html>