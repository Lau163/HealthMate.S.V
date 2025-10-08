<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor | HealthMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleSidebar = document.getElementById('toggle-sidebar');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            
            // Toggle sidebar
            toggleSidebar.addEventListener('click', function() {
                const isCollapsed = sidebar.classList.contains('w-20');
                
                if (isCollapsed) {
                    // Expandir el sidebar
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-64');
                    mainContent.classList.remove('md:ml-20');
                    mainContent.classList.add('md:ml-64');
                } else {
                    // Colapsar el sidebar
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-20');
                    mainContent.classList.remove('md:ml-64');
                    mainContent.classList.add('md:ml-20');
                }
                
                // Toggle text in sidebar items
                sidebarTexts.forEach(text => {
                    text.classList.toggle('hidden');
                    text.classList.toggle('md:inline-block');
                });
                
                // Toggle icons position
                sidebarItems.forEach(item => {
                    item.classList.toggle('justify-center');
                    item.classList.toggle('px-6');
                });
            });
            
            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 768 && !sidebar.contains(event.target) && event.target !== toggleSidebar) {
                    sidebar.classList.add('hidden');
                    mainContent.classList.remove('md:ml-64');
                }
            });
        });
    </script>
</head>
<body class="bg-gray-100 overflow-hidden">
<<<<<<< Updated upstream
    <div class="flex h-screen w-full">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-white shadow-lg w-64 h-full transition-all duration-300 ease-in-out z-50 fixed md:relative flex-shrink-0">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center">
                    <i class="fas fa-heartbeat text-2xl text-emerald-600"></i>
                    <span class="sidebar-text ml-3 font-bold text-xl text-gray-800 hidden md:inline-block">HealthMate</span>
                </div>
                <button id="toggle-sidebar" class="p-1 rounded-full hover:bg-gray-100">
                    <i class="fas fa-bars text-gray-600"></i>
                </button>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-8">
                <div class="px-2 space-y-1">
                    <!-- Dashboard -->
                    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-emerald-600 bg-emerald-50">
                        <i class="fas fa-home text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Inicio</span>
                    </a>
                    
                    <!-- Doctor -->
                    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                        <i class="fas fa-users text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Doctor</span>
                    </a>
                    
                    <!-- Reservas -->
                    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                        <i class="far fa-calendar-alt text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Reservas</span>
                    </a>
                    
                    <!-- Servicios -->
                    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                        <i class="fas fa-concierge-bell text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Servicios</span>
                    </a>
                    
                    <!-- Mascotas -->
                    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                        <i class="fas fa-paw text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Mascotas</span>
                    </a>
                    
                    <!-- Reportes -->
                    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                        <i class="fas fa-chart-bar text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Reportes</span>
                    </a>
                </div>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div id="main-content" class="flex-1 flex flex-col overflow-auto transition-all duration-300 ease-in-out w-full">
            <!-- Top Navigation -->
            <header class="bg-emerald-600 shadow-sm z-10">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <button id="mobile-menu-button" class="md:hidden text-white mr-4">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-white">Doctor</h1>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Search Bar -->
                        <div class="relative hidden md:block">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" class="block w-64 pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-emerald-500 text-white placeholder-emerald-200 focus:outline-none focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:text-gray-900" placeholder="Buscar...">
                        </div>
                        
                        <!-- User Menu -->
                        <div class="relative">
                            <button class="flex items-center text-sm text-white focus:outline-none">
                                <div class="h-8 w-8 rounded-full bg-emerald-400 flex items-center justify-center">
                                    <span class="text-white font-medium">U</span>
                                </div>
                                <span class="ml-2 hidden md:inline-block">Usuario</span>
                                <i class="fas fa-chevron-down ml-1 text-xs hidden md:inline-block"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 md:p-6 w-full">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <!-- Content Header -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Lista de Pacientes</h2>
                            <p class="text-sm text-gray-500 mt-1">Gestiona los pacientes del sistema</p>
                        </div>
                        <a href="<?= BASE_URL ?>doctor/nuevo-paciente" class="mt-4 md:mt-0 inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            <i class="fas fa-plus mr-2"></i>Nuevo Paciente
                        </a>
                    </div>
                    
                    <?php 
                    // Obtener los pacientes del controlador
                    $pacientes = $pacientes ?? ($this->get('pacientes') ?? []);
                    $error = $_SESSION['error'] ?? '';
                    $success = $_SESSION['success'] ?? '';
                    
                    // Mostrar mensajes de éxito o error
                    if ($error): ?>
                        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                            <p><?php echo htmlspecialchars($error); ?></p>
                        </div>
                    <?php 
                    unset($_SESSION['error']);
                    endif; 
                    
                    if ($success): ?>
                        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                            <p><?php echo htmlspecialchars($success); ?></p>
                        </div>
                    <?php 
                    unset($_SESSION['success']);
                    endif; 
                    ?>
                    
                    <!-- Search Bar -->
                    <div class="mb-6">
                        <form method="get" action="" class="flex">
                            <div class="relative flex-grow">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" name="q" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" 
                                       placeholder="Buscar por nombre o email" value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
                            </div>
                            <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                Buscar
                            </button>
                        </form>
                    </div>
                    
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <?php if (empty($pacientes)): ?>
                            <div class="text-center py-4 text-gray-500">
                                No hay pacientes para mostrar.
                            </div>
                        <?php else: ?>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paciente</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edad</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sexo</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Altura</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo Sangre</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registro</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($pacientes as $paciente): 
                                        $nombreCompleto = trim($paciente['Nombre'] ?? '');
                                        $iniciales = '';
                                        if (!empty($nombreCompleto)) {
                                            $nombres = explode(' ', $nombreCompleto);
                                            $iniciales = strtoupper(substr($nombres[0], 0, 1) . (isset($nombres[1]) ? substr($nombres[1], 0, 1) : ''));
                                        }
                                    ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <?php echo htmlspecialchars($paciente['Id_Usuario'] ?? ''); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center mr-3">
                                                        <span class="text-emerald-600 font-medium"><?php echo $iniciales; ?></span>
                                                    </div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <?php echo htmlspecialchars($paciente['Nombre'] ?? 'Sin nombre'); ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <?php echo htmlspecialchars($paciente['Email'] ?? 'No especificado'); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <?php 
                                                if (!empty($paciente['Edad'])) {
                                                    echo htmlspecialchars($paciente['Edad']) . ' años';
                                                } else {
                                                    echo 'No especificado';
                                                }
                                                ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <?php 
                                                $sexo = $paciente['Sexo'] ?? '';
                                                if ($sexo === 'M') {
                                                    echo 'Masculino';
                                                } elseif ($sexo === 'F') {
                                                    echo 'Femenino';
                                                } else {
                                                    echo 'No especificado';
                                                }
                                                ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <?php 
                                                if (!empty($paciente['Altura'])) {
                                                    echo htmlspecialchars($paciente['Altura']) . ' cm';
                                                } else {
                                                    echo 'No especificado';
                                                }
                                                ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <?php 
                                                echo !empty($paciente['Tipo_sangre']) 
                                                    ? htmlspecialchars($paciente['Tipo_sangre'])
                                                    : 'No especificado';
                                                ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <?php 
                                                if (!empty($paciente['Fecha_Registro'])) {
                                                    $fecha = new DateTime($paciente['Fecha_Registro']);
                                                    echo $fecha->format('d/m/Y');
                                                } else {
                                                    echo 'No especificado';
                                                }
                                                ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="<?php echo URL; ?>paciente/ver/<?php echo $paciente['Id_Usuario']; ?>" class="text-emerald-600 hover:text-emerald-900 mr-3" title="Ver">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <a href="<?php echo URL; ?>paciente/editar/<?php echo $paciente['Id_Usuario']; ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Editar">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <a href="<?php echo URL; ?>paciente/eliminar/<?php echo $paciente['Id_Usuario']; ?>" class="text-red-600 hover:text-red-900" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este paciente?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-6 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Mostrando <span class="font-medium">1</span> a <span class="font-medium">10</span> de <span class="font-medium">24</span> resultados
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 rounded border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Anterior
                            </button>
                            <button class="px-3 py-1 rounded border border-emerald-500 bg-emerald-50 text-sm font-medium text-emerald-600">
                                1
                            </button>
                            <button class="px-3 py-1 rounded border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                2
                            </button>
                            <button class="px-3 py-1 rounded border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Siguiente
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                mainContent.classList.add('md:ml-64');
            } else {
                sidebar.classList.add('hidden');
                mainContent.classList.remove('md:ml-64');
            }
        });
    </script>
                        
    </div>
</body>
</html>
=======
   <div class="w-[1440px] h-[900px] relative bg-white overflow-hidden">
  <img class="w-5 h-5 left-[1139px] top-[85px] absolute" src="https://placehold.co/20x20" />
  <img class="w-5 h-5 left-[1239px] top-[85px] absolute" src="https://placehold.co/20x20" />
  <img class="w-5 h-5 left-[1189px] top-[85px] absolute" src="https://placehold.co/20x20" />
  <div class="left-[165px] top-[78px] absolute text-center justify-start text-black text-xl font-normal font-['Baloo_Chettan']">Home</div>
  <div class="left-[265px] top-[78px] absolute text-center justify-start text-black text-xl font-normal font-['Baloo_Chettan']">Tienda</div>
  <div class="left-[369px] top-[78px] absolute text-center justify-start text-black text-xl font-normal font-['Baloo_Chettan']">Servicios</div>
  <div class="left-[496px] top-[80px] absolute text-center justify-start text-black text-xl font-normal font-['Baloo_Chettan']">Página</div>
  <div class="w-8 h-0 left-[396px] top-[115px] absolute shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] outline outline-4 outline-offset-[-2px] outline-neutral-500"></div>
  <div class="w-[1309px] h-0 left-[30px] top-[134px] absolute outline outline-2 outline-offset-[-1px] outline-stone-400/90"></div>
  <div class="left-[97px] top-[321px] absolute text-center justify-start text-black text-xl font-bold font-['Roboto']">FILTRO SELECCIONADO</div>
  <div class="w-28 h-5 left-[109px] top-[422px] absolute text-center justify-start text-teal-700 text-xl font-bold font-['Roboto']">Categoría</div>
  <div class="w-6 h-6 left-[127px] top-[485px] absolute bg-zinc-700 border border-zinc-700"></div>
  <div class="w-64 h-80 left-[84px] top-[379px] absolute bg-stone-300/0 rounded-[10px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] border border-black"></div>
  <div class="w-44 h-24 left-[147px] top-[526px] absolute text-center justify-start text-stone-500/90 text-xl font-bold font-['Roboto']">Este sistema esta diseñado para que puedas llevar el control de tus signoss vitales</div>
  <div class="w-[907px] h-32 left-[396px] top-[172px] absolute bg-emerald-300/80 rounded-[20px]"></div>
  <div class="w-[464px] h-16 left-[613px] top-[208px] absolute text-center justify-start text-black text-4xl font-bold font-['Roboto']">Bienvenido a Healt Mate</div>
  <div class="w-72 h-96 left-[1008px] top-[337px] absolute bg-stone-300/30 rounded-[10px]"></div>
  <div class="w-44 h-10 left-[1061px] top-[668px] absolute bg-teal-700 rounded-2xl"></div>
  <div class="left-[1100px] top-[677px] absolute text-center justify-start text-white text-xl font-bold font-['Roboto']">COMPRAR</div>
  <div class="w-36 left-[1081px] top-[604px] absolute text-center justify-start text-zinc-700 text-lg font-bold font-['Roboto']">Alimentate Sanamente</div>
  <div class="w-72 h-96 left-[710px] top-[337px] absolute bg-stone-300/30 rounded-[10px]"></div>
  <div class="w-44 h-10 left-[763px] top-[668px] absolute bg-teal-700 rounded-2xl"></div>
  <div class="left-[802px] top-[677px] absolute text-center justify-start text-white text-xl font-bold font-['Roboto']">COMPRAR</div>
  <div class="w-48 left-[758px] top-[608px] absolute text-center justify-start text-zinc-700 text-lg font-bold font-['Roboto']">Parametros De Los Signos Vitales</div>
  <div class="w-72 h-96 left-[412px] top-[337px] absolute bg-stone-300/30 rounded-[10px]"></div>
  <div class="w-44 h-10 left-[465px] top-[668px] absolute bg-teal-700 rounded-2xl"></div>
  <div class="w-24 left-[504px] top-[677px] absolute text-center justify-start text-white text-xl font-bold font-['Roboto']">COMPRAR</div>
  <div class="w-36 left-[477px] top-[608px] absolute text-center justify-start text-zinc-700 text-lg font-bold font-['Roboto']">Mantente Hidratado</div>
  <img class="w-40 h-40 left-[444px] top-[396px] absolute" src="https://placehold.co/157x157" />
  <img class="w-24 h-24 left-[570px] top-[379px] absolute" src="https://placehold.co/96x96" />
  <img class="w-52 h-52 left-[1039px] top-[379px] absolute" src="https://placehold.co/210x210" />
  <img class="w-52 h-52 left-[758px] top-[379px] absolute" src="https://placehold.co/210x210" />
</div>
>>>>>>> Stashed changes
