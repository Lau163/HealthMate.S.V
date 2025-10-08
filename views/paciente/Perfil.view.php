<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Perfil - Historial Clínico | HealthMate</title>
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
                    HISTORIAL CLÍNICO
                </h1>
            </div>
            
            <!-- Contenedor del perfil -->
            <div class="bg-white rounded-xl shadow-lg border border-black p-4 md:p-6 lg:p-8 mb-6">
                
                <!-- Header del perfil -->
                <div class="flex flex-col md:flex-row items-center md:items-start gap-4 md:gap-6 mb-6 pb-6 border-b border-gray-200">
                    
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 md:w-32 md:h-32 bg-stone-300 rounded-full border-4 border-black flex items-center justify-center">
                            <i class="fas fa-user text-4xl md:text-5xl text-gray-600"></i>
                        </div>
                    </div>
                    
                    <!-- Información del paciente -->
                    <div class="flex-1 text-center md:text-left">
                        <h2 class="text-2xl md:text-3xl font-bold text-black mb-4">Luis Gonzalez</h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                            <div>
                                <p class="text-sm font-bold text-black mb-1">DUEÑO</p>
                                <p class="text-base text-zinc-700">Jhon Delgado</p>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-black mb-1">CÓDIGO</p>
                                <p class="text-base text-black font-bold">R0101</p>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-black mb-1">DIRECCIÓN</p>
                                <p class="text-base text-zinc-700">Chorillos</p>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-black mb-1">CHECK IN</p>
                                <p class="text-base text-black font-bold">20-10-2020</p>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-black mb-1">TELÉFONO</p>
                                <p class="text-base text-zinc-700">987687657</p>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-black mb-1">CHECK OUT</p>
                                <p class="text-base text-black font-bold">25-10-2020</p>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-sm font-bold text-black mb-1">EMAIL</p>
                                <p class="text-base text-zinc-700">jhontlv@gmail.com</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Diario Saludable -->
                <div class="bg-white rounded-lg border border-black shadow-md p-4 md:p-6">
                    <h3 class="text-xl md:text-2xl font-bold text-black mb-4 text-center">
                        <i class="fas fa-book-medical mr-2 text-teal-600"></i> Diario Saludable
                    </h3>
                    
                    <!-- Tabla responsive -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-300 border border-black">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs md:text-sm font-black text-neutral-500/90 border-r border-black">#</th>
                                    <th class="px-3 py-2 text-left text-xs md:text-sm font-black text-neutral-500/90 border-r border-black">DIAGNÓSTICO</th>
                                    <th class="px-3 py-2 text-left text-xs md:text-sm font-black text-neutral-500/90 border-r border-black">TRATAMIENTO</th>
                                    <th class="px-3 py-2 text-left text-xs md:text-sm font-black text-neutral-500/90">OBSERVACIONES POR DÍA</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-400">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 py-3 text-sm text-zinc-700 border-r border-zinc-400">1</td>
                                    <td class="px-3 py-3 text-sm text-zinc-700 border-r border-zinc-400">Hipertensión</td>
                                    <td class="px-3 py-3 text-xs md:text-sm text-zinc-700 border-r border-zinc-400">
                                        Checar P.A una vez al día durante 7 días
                                    </td>
                                    <td class="px-3 py-3 text-xs md:text-sm text-zinc-700">
                                        Presencia de disminución en presión arterial
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 py-3 text-sm text-zinc-700 border-r border-zinc-400">2</td>
                                    <td class="px-3 py-3 text-sm text-zinc-700 border-r border-zinc-400">Amigdalitis</td>
                                    <td class="px-3 py-3 text-xs md:text-sm text-zinc-700 border-r border-zinc-400">
                                        Loratadina 1 c/24 hrs por 3 días. Paracetamol 1 c/8 hrs
                                    </td>
                                    <td class="px-3 py-3 text-xs md:text-sm text-zinc-700">
                                        Escurrimiento nasal y tos
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Vista de cards en móvil -->
                    <div class="lg:hidden mt-6 space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-bold text-teal-700">#1</span>
                                <span class="text-sm font-bold text-gray-600">Hipertensión</span>
                            </div>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-bold">Tratamiento:</span> Checar P.A una vez al día durante 7 días</p>
                                <p><span class="font-bold">Observaciones:</span> Presencia de disminución en presión arterial</p>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-bold text-teal-700">#2</span>
                                <span class="text-sm font-bold text-gray-600">Amigdalitis</span>
                            </div>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-bold">Tratamiento:</span> Loratadina 1 c/24 hrs por 3 días. Paracetamol 1 c/8 hrs</p>
                                <p><span class="font-bold">Observaciones:</span> Escurrimiento nasal y tos</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Botón cerrar -->
                <div class="mt-6 flex justify-center">
                    <button class="bg-teal-700 hover:bg-teal-800 text-white text-lg md:text-xl font-bold py-3 px-8 md:px-12 rounded-lg transition-colors shadow-lg">
                        <i class="fas fa-times mr-2"></i> Cerrar
                    </button>
                </div>
                
            </div>
            
            <!-- Tabla de pacientes (opcional - puede ocultarse en móvil) -->
            <div class="hidden xl:block bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                <div class="bg-slate-300 px-4 py-3">
                    <h3 class="text-lg font-bold text-black">Lista de Pacientes</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-300">
                            <tr>
                                <th class="px-3 py-2 text-left font-black text-neutral-500/90">#</th>
                                <th class="px-3 py-2 text-left font-black text-neutral-500/90">ID</th>
                                <th class="px-3 py-2 text-left font-black text-neutral-500/90">PACIENTE</th>
                                <th class="px-3 py-2 text-left font-black text-neutral-500/90">FECHA DE CITA</th>
                                <th class="px-3 py-2 text-left font-black text-neutral-500/90">CONTACTO EMERGENCIA</th>
                                <th class="px-3 py-2 text-left font-black text-neutral-500/90">EMAIL</th>
                                <th class="px-3 py-2 text-left font-black text-neutral-500/90">TELÉFONO</th>
                                <th class="px-3 py-2 text-center font-black text-neutral-500/90">SIGNOS VITALES</th>
                                <th class="px-3 py-2 text-center font-black text-neutral-500/90">HISTORIAL CLÍNICO</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-400">
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2">1</td>
                                <td class="px-3 py-2">R0100</td>
                                <td class="px-3 py-2">Luis Gonzales</td>
                                <td class="px-3 py-2">10-02-2025</td>
                                <td class="px-3 py-2">Km 40 Lurin</td>
                                <td class="px-3 py-2">Luis@gmail.com</td>
                                <td class="px-3 py-2">987686546</td>
                                <td class="px-3 py-2 text-center">
                                    <button class="text-teal-700 hover:text-teal-900">
                                        <i class="fas fa-heartbeat text-lg"></i>
                                    </button>
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <button class="text-blue-700 hover:text-blue-900">
                                        <i class="fas fa-file-medical text-lg"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2">2</td>
                                <td class="px-3 py-2">R0101</td>
                                <td class="px-3 py-2">Juan Perez</td>
                                <td class="px-3 py-2">11-02-2025</td>
                                <td class="px-3 py-2">Km 40 Lurin</td>
                                <td class="px-3 py-2">Luis@gmail.com</td>
                                <td class="px-3 py-2">987686546</td>
                                <td class="px-3 py-2 text-center">
                                    <button class="text-teal-700 hover:text-teal-900">
                                        <i class="fas fa-heartbeat text-lg"></i>
                                    </button>
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <button class="text-blue-700 hover:text-blue-900">
                                        <i class="fas fa-file-medical text-lg"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2">3</td>
                                <td class="px-3 py-2">R0102</td>
                                <td class="px-3 py-2">Octavio Lopez</td>
                                <td class="px-3 py-2">12-02-2025</td>
                                <td class="px-3 py-2">Km 40 Lurin</td>
                                <td class="px-3 py-2">Luis@gmail.com</td>
                                <td class="px-3 py-2">987686546</td>
                                <td class="px-3 py-2 text-center">
                                    <button class="text-teal-700 hover:text-teal-900">
                                        <i class="fas fa-heartbeat text-lg"></i>
                                    </button>
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <button class="text-blue-700 hover:text-blue-900">
                                        <i class="fas fa-file-medical text-lg"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
        
    </div>
</body>
</html>
