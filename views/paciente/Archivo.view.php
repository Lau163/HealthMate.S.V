<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Archivo - Signos Vitales | HealthMate</title>
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
            <div class="bg-sky-500 rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-8 mb-4 md:mb-6 lg:mb-8 mt-2 md:mt-4">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white text-center">
                    ARCHIVO - SIGNOS VITALES
                </h1>
            </div>
            
            <!-- Tabla responsive -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                
                <!-- Tabla en desktop -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-300">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-black text-neutral-500/90">#</th>
                                <th class="px-4 py-3 text-left text-sm font-black text-neutral-500/90">ID</th>
                                <th class="px-4 py-3 text-left text-sm font-black text-neutral-500/90">PACIENTE</th>
                                <th class="px-4 py-3 text-left text-sm font-black text-neutral-500/90">FECHA REGISTRO</th>
                                <th class="px-4 py-3 text-left text-sm font-black text-neutral-500/90">DIRECCIÓN</th>
                                <th class="px-4 py-3 text-left text-sm font-black text-neutral-500/90">EMAIL</th>
                                <th class="px-4 py-3 text-left text-sm font-black text-neutral-500/90">TELÉFONO</th>
                                <th class="px-4 py-3 text-left text-sm font-black text-neutral-500/90">SIGNO</th>
                                <th class="px-4 py-3 text-center text-sm font-black text-neutral-500/90">GRÁFICAS</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-400">
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-zinc-700">1</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">R0100</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Luis Gonzales</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">10-02-2025</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Km 40 Lurin</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Luis@gmail.com</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">987686546</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Temperatura Corporal</td>
                                <td class="px-4 py-3 text-center">
                                    <button class="text-teal-700 hover:text-teal-900">
                                        <i class="fas fa-chart-line text-xl"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-zinc-700">2</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">R0101</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Luis Gonzales</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">10-02-2025</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Km 40 Lurin</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Luis@gmail.com</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">987686546</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Saturación Sanguínea</td>
                                <td class="px-4 py-3 text-center">
                                    <button class="text-teal-700 hover:text-teal-900">
                                        <i class="fas fa-chart-line text-xl"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-zinc-700">3</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">R0102</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Luis Gonzales</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">10-02-2025</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Km 40 Lurin</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Luis@gmail.com</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">987686546</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Frecuencia Cardíaca</td>
                                <td class="px-4 py-3 text-center">
                                    <button class="text-teal-700 hover:text-teal-900">
                                        <i class="fas fa-chart-line text-xl"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-zinc-700">4</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">R0103</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Luis Gonzales</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">10-02-2025</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Km 40 Lurin</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Luis@gmail.com</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">987686546</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Presión Arterial</td>
                                <td class="px-4 py-3 text-center">
                                    <button class="text-teal-700 hover:text-teal-900">
                                        <i class="fas fa-chart-line text-xl"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-zinc-700">5</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">R0103</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Luis Gonzales</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">10-02-2025</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Km 40 Lurin</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Luis@gmail.com</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">987686546</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Frecuencia Respiratoria</td>
                                <td class="px-4 py-3 text-center">
                                    <button class="text-teal-700 hover:text-teal-900">
                                        <i class="fas fa-chart-line text-xl"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-zinc-700">6</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">R0103</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Luis Gonzales</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">10-02-2025</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Km 40 Lurin</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Luis@gmail.com</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">987686546</td>
                                <td class="px-4 py-3 text-sm text-zinc-700">Pulso</td>
                                <td class="px-4 py-3 text-center">
                                    <button class="text-teal-700 hover:text-teal-900">
                                        <i class="fas fa-chart-line text-xl"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Cards en móvil/tablet -->
                <div class="lg:hidden space-y-4 p-4">
                    <!-- Card 1 -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-lg font-bold text-teal-700">#1 - R0100</span>
                            <button class="text-teal-700">
                                <i class="fas fa-chart-line text-xl"></i>
                            </button>
                        </div>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-bold">Paciente:</span> Luis Gonzales</p>
                            <p><span class="font-bold">Fecha:</span> 10-02-2025</p>
                            <p><span class="font-bold">Dirección:</span> Km 40 Lurin</p>
                            <p><span class="font-bold">Email:</span> Luis@gmail.com</p>
                            <p><span class="font-bold">Teléfono:</span> 987686546</p>
                            <p><span class="font-bold">Signo:</span> <span class="text-teal-700">Temperatura Corporal</span></p>
                        </div>
                    </div>
                    
                    <!-- Card 2 -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-lg font-bold text-teal-700">#2 - R0101</span>
                            <button class="text-teal-700">
                                <i class="fas fa-chart-line text-xl"></i>
                            </button>
                        </div>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-bold">Paciente:</span> Luis Gonzales</p>
                            <p><span class="font-bold">Fecha:</span> 10-02-2025</p>
                            <p><span class="font-bold">Dirección:</span> Km 40 Lurin</p>
                            <p><span class="font-bold">Email:</span> Luis@gmail.com</p>
                            <p><span class="font-bold">Teléfono:</span> 987686546</p>
                            <p><span class="font-bold">Signo:</span> <span class="text-teal-700">Saturación Sanguínea</span></p>
                        </div>
                    </div>
                    
                    <!-- Card 3 -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-lg font-bold text-teal-700">#3 - R0102</span>
                            <button class="text-teal-700">
                                <i class="fas fa-chart-line text-xl"></i>
                            </button>
                        </div>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-bold">Paciente:</span> Luis Gonzales</p>
                            <p><span class="font-bold">Fecha:</span> 10-02-2025</p>
                            <p><span class="font-bold">Dirección:</span> Km 40 Lurin</p>
                            <p><span class="font-bold">Email:</span> Luis@gmail.com</p>
                            <p><span class="font-bold">Teléfono:</span> 987686546</p>
                            <p><span class="font-bold">Signo:</span> <span class="text-teal-700">Frecuencia Cardíaca</span></p>
                        </div>
                    </div>
                    
                    <!-- Card 4 -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-lg font-bold text-teal-700">#4 - R0103</span>
                            <button class="text-teal-700">
                                <i class="fas fa-chart-line text-xl"></i>
                            </button>
                        </div>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-bold">Paciente:</span> Luis Gonzales</p>
                            <p><span class="font-bold">Fecha:</span> 10-02-2025</p>
                            <p><span class="font-bold">Dirección:</span> Km 40 Lurin</p>
                            <p><span class="font-bold">Email:</span> Luis@gmail.com</p>
                            <p><span class="font-bold">Teléfono:</span> 987686546</p>
                            <p><span class="font-bold">Signo:</span> <span class="text-teal-700">Presión Arterial</span></p>
                        </div>
                    </div>
                    
                    <!-- Card 5 -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-lg font-bold text-teal-700">#5 - R0103</span>
                            <button class="text-teal-700">
                                <i class="fas fa-chart-line text-xl"></i>
                            </button>
                        </div>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-bold">Paciente:</span> Luis Gonzales</p>
                            <p><span class="font-bold">Fecha:</span> 10-02-2025</p>
                            <p><span class="font-bold">Dirección:</span> Km 40 Lurin</p>
                            <p><span class="font-bold">Email:</span> Luis@gmail.com</p>
                            <p><span class="font-bold">Teléfono:</span> 987686546</p>
                            <p><span class="font-bold">Signo:</span> <span class="text-teal-700">Frecuencia Respiratoria</span></p>
                        </div>
                    </div>
                    
                    <!-- Card 6 -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-lg font-bold text-teal-700">#6 - R0103</span>
                            <button class="text-teal-700">
                                <i class="fas fa-chart-line text-xl"></i>
                            </button>
                        </div>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-bold">Paciente:</span> Luis Gonzales</p>
                            <p><span class="font-bold">Fecha:</span> 10-02-2025</p>
                            <p><span class="font-bold">Dirección:</span> Km 40 Lurin</p>
                            <p><span class="font-bold">Email:</span> Luis@gmail.com</p>
                            <p><span class="font-bold">Teléfono:</span> 987686546</p>
                            <p><span class="font-bold">Signo:</span> <span class="text-teal-700">Pulso</span></p>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </main>
        
    </div>
</body>
</html>
