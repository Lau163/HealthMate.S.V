<?php require_once "config/config.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Servicios - Signos Vitales | HealthMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
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
                        <div class="mb-4">
                            <p class="text-teal-700 text-base md:text-lg font-bold text-center mb-4">Categoría</p>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="w-5 h-5 border-2 border-black" />
                                <label class="text-stone-500/90 text-base md:text-lg font-bold">REGISTRO</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="w-5 h-5 border-2 border-black" />
                                <label class="text-stone-500/90 text-base md:text-lg font-bold">DATOS</label>
                            </div>
                        </div>
                    </div>
                </aside>
                
                <!-- Contenido principal - Grid de servicios -->
                <div class="flex-1 w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6">
                        
                        <!-- Card 1: Temperatura Corporal -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[300px] md:min-h-[350px]">
                            <img class="w-36 h-36 sm:w-40 sm:h-40 md:w-44 md:h-44 object-contain mb-3 md:mb-4" 
                                 src="<?= constant("URL") ?>public/img/PX/E.png" 
                                 alt="Temperatura Corporal" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    TEMPERATURA CORPORAL
                                </p>
                            </div>
                            <button class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                REGISTRAR
                            </button>
                        </div>
                        
                        <!-- Card 2: Saturación Sanguínea -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[300px] md:min-h-[350px]">
                            <img class="w-36 h-36 sm:w-40 sm:h-40 md:w-44 md:h-44 object-contain mb-3 md:mb-4" 
                                 src="<?= constant("URL") ?>public/img/PX/PA.png" 
                                 alt="Saturación Sanguínea" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    SATURACIÓN SANGUÍNEA
                                </p>
                            </div>
                            <button class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                REGISTRAR
                            </button>
                        </div>
                        
                        <!-- Card 3: Frecuencia Cardíaca -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[300px] md:min-h-[350px]">
                            <img class="w-40 h-40 sm:w-44 sm:h-44 md:w-48 md:h-48 object-contain mb-3 md:mb-4" 
                                 src="<?= constant("URL") ?>public/img/PX/B.png" 
                                 alt="Frecuencia Cardíaca" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    FRECUENCIA CARDÍACA
                                </p>
                            </div>
                            <button class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                REGISTRAR
                            </button>
                        </div>
                        
                        <!-- Card 4: Presión Arterial -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[300px] md:min-h-[350px]">
                            <img class="w-32 h-32 sm:w-36 sm:h-36 md:w-40 md:h-40 object-contain mb-3 md:mb-4" 
                                 src="<?= constant("URL") ?>public/img/PX/T.png" 
                                 alt="Presión Arterial" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    PRESIÓN ARTERIAL
                                </p>
                            </div>
                            <button class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                REGISTRAR
                            </button>
                        </div>
                        
                        <!-- Card 5: Frecuencia Respiratoria -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[300px] md:min-h-[350px]">
                            <img class="w-40 h-40 sm:w-44 sm:h-44 md:w-48 md:h-48 object-contain mb-3 md:mb-4" 
                                 src="<?= constant("URL") ?>public/img/PX/C.png" 
                                 alt="Frecuencia Respiratoria" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    FRECUENCIA RESPIRATORIA
                                </p>
                            </div>
                            <button class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                REGISTRAR
                            </button>
                        </div>
                        
                        <!-- Card 6: Pulso -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[300px] md:min-h-[350px]">
                            <img class="w-36 h-36 sm:w-40 sm:h-40 md:w-44 md:h-44 object-contain mb-3 md:mb-4" 
                                 src="<?= constant("URL") ?>public/img/PX/P.png" 
                                 alt="Pulso" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    PULSO
                                </p>
                            </div>
                            <button class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                REGISTRAR
                            </button>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
        </main>
        
    </div>
</body>
</html>
