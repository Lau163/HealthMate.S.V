<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?? '' ?>">
    <title>Enfermerx | HealthMate</title>
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
                <div class="px-2 space-y-1 flex flex-col h-[calc(100vh-200px)]">
                    <div class="space-y-1">
                        <!-- Dashboard -->
                        <a href="#" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-emerald-600 bg-emerald-50">
                            <i class="fas fa-home text-lg"></i>
                            <span class="sidebar-text ml-3 hidden md:inline-block">Inicio</span>
                        </a>
                        
                        <!-- Enfermerx -->
                        <a href="#" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-users text-lg"></i>
                            <span class="sidebar-text ml-3 hidden md:inline-block">Enfermerx</span>
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

                    <!-- Botón de Cerrar Sesión -->
                    <div class="mt-auto pb-8">
                        <form action="<?= BASE_URL ?>auth/logout" method="post" class="w-full">
                            <button type="submit" class="w-full sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-red-600 hover:bg-red-50 transition-colors">
                                <i class="fas fa-sign-out-alt text-lg"></i>
                                <span class="sidebar-text ml-3 hidden md:inline-block">Cerrar Sesión</span>
                            </button>
                        </form>
                    </div>
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
                        <h1 class="text-xl font-semibold text-white">Enfermerx</h1>
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
                            <?php if (isset($error)): ?>
                                <div class="mt-2 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                                    <?php echo htmlspecialchars($error); ?>
                                </div>
                            <?php endif; ?>
                            <p class="text-sm text-gray-500 mt-1">Gestiona los pacientes del sistema</p>
                        </div>
                        <button onclick="abrirModalNuevoPaciente()" class="mt-4 md:mt-0 inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            <i class="fas fa-plus mr-2"></i>Nuevo Paciente
                        </button>
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
                                                <button onclick="verPaciente(<?php echo htmlspecialchars(json_encode($paciente)); ?>)" class="text-emerald-600 hover:text-emerald-900 mr-3" title="Ver">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                                <button onclick="editarPaciente(<?php echo htmlspecialchars(json_encode($paciente)); ?>)" class="text-blue-600 hover:text-blue-900 mr-3" title="Editar">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <button onclick="confirmarEliminarPaciente(<?php echo htmlspecialchars(json_encode(['Id_Usuario' => $paciente['Id_Usuario'], 'Nombre' => $paciente['Nombre']])); ?>)" class="text-red-600 hover:text-red-900" title="Eliminar">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
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
        // Funciones para abrir y cerrar modales
        function abrirModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function cerrarModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Función para abrir el modal de nuevo paciente
        function abrirModalNuevoPaciente() {
            document.getElementById('nuevoPacienteModal').classList.remove('hidden');
        }

        // Funciones para manejar pacientes
        function verPaciente(paciente) {
            // Formatear los datos del paciente para mostrarlos
            const detalles = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Nombre completo</p>
                        <p class="font-medium">${paciente.Nombre || 'No especificado'}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Correo electrónico</p>
                        <p class="font-medium">${paciente.Email || 'No especificado'}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Edad</p>
                        <p class="font-medium">${paciente.Edad || 'No especificado'}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Sexo</p>
                        <p class="font-medium">${paciente.Sexo || 'No especificado'}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tipo de sangre</p>
                        <p class="font-medium">${paciente.Tipo_sangre || 'No especificado'}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Peso</p>
                        <p class="font-medium">${paciente.Peso ? paciente.Peso + ' kg' : 'No especificado'}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Altura</p>
                        <p class="font-medium">${paciente.Altura ? paciente.Altura + ' cm' : 'No especificado'}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Alergias</p>
                        <p class="font-medium">${paciente.Alergias || 'Ninguna registrada'}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Enfermedades crónicas</p>
                        <p class="font-medium">${paciente.Enfermedades || 'Ninguna registrada'}</p>
                    </div>
                </div>
            `;
            
            document.getElementById('detallesPaciente').innerHTML = detalles;
            abrirModal('verPacienteModal');
        }
        
        function editarPaciente(paciente) {
            // Llenar el formulario con los datos del paciente
            document.getElementById('editar_id').value = paciente.Id_Usuario;
            document.getElementById('editar_nombre').value = paciente.Nombre || '';
            document.getElementById('editar_email').value = paciente.Email || '';
            document.getElementById('editar_edad').value = paciente.Edad || '';
            document.getElementById('editar_sexo').value = paciente.Sexo || '';
            document.getElementById('editar_tipo_sangre').value = paciente.Tipo_sangre || '';
            document.getElementById('editar_peso').value = paciente.Peso || '';
            document.getElementById('editar_altura').value = paciente.Altura || '';
            document.getElementById('editar_alergias').value = paciente.Alergias || '';
            document.getElementById('editar_enfermedades').value = paciente.Enfermedades || '';
            
            // Configurar el formulario para la actualización
            const form = document.getElementById('formEditarPaciente');
            form.action = `<?= BASE_URL ?>enfermerx/editar/${paciente.Id_Usuario}`;
            
            abrirModal('editarPacienteModal');
        }
        
        function confirmarEliminarPaciente(paciente) {
            document.getElementById('nombrePacienteEliminar').textContent = paciente.Nombre || 'este paciente';
            
            // Configurar el botón de confirmación
            const btnEliminar = document.getElementById('confirmarEliminar');
            btnEliminar.onclick = function() {
                // Realizar la petición de eliminación
                fetch(`<?= BASE_URL ?>enfermerx/eliminar/${paciente.Id_Usuario}`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Recargar la página para ver los cambios
                        window.location.reload();
                    } else {
                        alert(data.message || 'Error al eliminar el paciente');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al intentar eliminar el paciente');
                });
                
                cerrarModal('eliminarPacienteModal');
            };
            
            abrirModal('eliminarPacienteModal');
        }
        
        // Manejar el envío del formulario de edición
        const formEditarPaciente = document.getElementById('formEditarPaciente');
        if (formEditarPaciente) {
            formEditarPaciente.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Recargar la página para ver los cambios
                        window.location.reload();
                    } else {
                        alert(data.message || 'Error al actualizar el paciente');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al intentar actualizar el paciente');
                });
            });
        }
        
        // Cerrar modales al hacer clic fuera del contenido
        document.querySelectorAll('.fixed.inset-0').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });
        
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
    
    <!-- Modal Nuevo Paciente -->
    <div id="nuevoPacienteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-xl font-semibold text-gray-800">Nuevo Paciente</h3>
                <button onclick="document.getElementById('nuevoPacienteModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            
            <form id="formNuevoPaciente" action="<?= BASE_URL ?>enfermerx/guardarPaciente" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre completo *</label>
                            <input type="text" id="nombre" name="nombre" required 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico *</label>
                            <input type="email" id="email" name="email" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
                            <input type="number" id="edad" name="edad" min="0" max="120"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                            <select id="sexo" name="sexo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                <option value="">Seleccionar...</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                                <option value="O">Otro</option>
                            </select>
                        </div>
                        <div>
                            <label for="tipo_sangre" class="block text-sm font-medium text-gray-700">Tipo de sangre</label>
                            <select id="tipo_sangre" name="tipo_sangre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                <option value="">Desconocido</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="peso" class="block text-sm font-medium text-gray-700">Peso (kg)</label>
                            <input type="number" id="peso" name="peso" step="0.1" min="0" max="300"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="altura" class="block text-sm font-medium text-gray-700">Altura (cm)</label>
                            <input type="number" id="altura" name="altura" min="0" max="250"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        </div>
                    </div>

                    <div>
                        <label for="alergias" class="block text-sm font-medium text-gray-700">Alergias</label>
                        <textarea id="alergias" name="alergias" rows="2"
                                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"></textarea>
                    </div>

                    <div>
                        <label for="enfermedades" class="block text-sm font-medium text-gray-700">Enfermedades crónicas</label>
                        <textarea id="enfermedades" name="enfermedades" rows="2"
                                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('nuevoPacienteModal').classList.add('hidden')" 
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Guardar Paciente
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Ver Paciente -->
    <div id="verPacienteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-xl font-semibold text-gray-800">Detalles del Paciente</h3>
                <button onclick="cerrarModal('verPacienteModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            
            <div class="mt-4 space-y-4" id="detallesPaciente">
                <!-- Los detalles del paciente se cargarán aquí dinámicamente -->
            </div>
            
            <div class="mt-6 flex justify-end">
                <button type="button" onclick="cerrarModal('verPacienteModal')" 
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Editar Paciente -->
    <div id="editarPacienteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-xl font-semibold text-gray-800">Editar Paciente</h3>
                <button onclick="cerrarModal('editarPacienteModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            
            <form id="formEditarPaciente" action="" method="POST" class="space-y-4 mt-4">
                <input type="hidden" id="editar_id" name="id">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="editar_nombre" class="block text-sm font-medium text-gray-700">Nombre completo *</label>
                        <input type="text" id="editar_nombre" name="nombre" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="editar_email" class="block text-sm font-medium text-gray-700">Correo electrónico *</label>
                        <input type="email" id="editar_email" name="email" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="editar_edad" class="block text-sm font-medium text-gray-700">Edad</label>
                        <input type="number" id="editar_edad" name="edad" min="0" max="120"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="editar_sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                        <select id="editar_sexo" name="sexo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                            <option value="">Seleccionar...</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div>
                        <label for="editar_tipo_sangre" class="block text-sm font-medium text-gray-700">Tipo de sangre</label>
                        <input type="text" id="editar_tipo_sangre" name="tipo_sangre"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"
                               placeholder="Ej: O+">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="editar_peso" class="block text-sm font-medium text-gray-700">Peso (kg)</label>
                        <input type="number" id="editar_peso" name="peso" step="0.1" min="0"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="editar_altura" class="block text-sm font-medium text-gray-700">Altura (cm)</label>
                        <input type="number" id="editar_altura" name="altura" min="0"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                    </div>
                </div>

                <div>
                    <label for="editar_alergias" class="block text-sm font-medium text-gray-700">Alergias</label>
                    <textarea id="editar_alergias" name="alergias" rows="2"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"></textarea>
                </div>

                <div>
                    <label for="editar_enfermedades" class="block text-sm font-medium text-gray-700">Enfermedades crónicas</label>
                    <textarea id="editar_enfermedades" name="enfermedades" rows="2"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"></textarea>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="cerrarModal('editarPacienteModal')" 
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Eliminar Paciente -->
    <div id="eliminarPacienteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/3 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-xl font-semibold text-gray-800">Confirmar Eliminación</h3>
                <button onclick="cerrarModal('eliminarPacienteModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            
            <div class="mt-4">
                <p class="text-gray-700">¿Estás seguro de que deseas eliminar a <span id="nombrePacienteEliminar" class="font-semibold"></span>?</p>
                <p class="text-sm text-red-600 mt-2">Esta acción no se puede deshacer.</p>
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="cerrarModal('eliminarPacienteModal')" 
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    Cancelar
                </button>
                <button type="button" id="confirmarEliminar" 
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Eliminar
                </button>
            </div>
        </div>
    </div>

    <script>
        // Funciones para abrir y cerrar modales
        function abrirModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function cerrarModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Función para abrir el modal de nuevo paciente
        function abrirModalNuevoPaciente() {
            document.getElementById('nuevoPacienteModal').classList.remove('hidden');
        }
        
        // Cerrar el modal al hacer clic fuera del contenido
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('nuevoPacienteModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.add('hidden');
                    }
                });
            }

            // Manejar el envío del formulario con AJAX
            const form = document.getElementById('formNuevoPaciente');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Mostrar los datos del formulario en consola para depuración
                    const formData = new FormData(this);
                    const formObject = {};
                    formData.forEach((value, key) => {
                        formObject[key] = value;
                        console.log(key + ': ' + value);
                    });
                    
                    // Usar FormData directamente en lugar de convertir a JSON
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || document.querySelector('input[name="csrf_token"]')?.value;
                    
                    // Crear un nuevo FormData para asegurar que los datos se envíen correctamente
                    const formDataToSend = new FormData();
                    formDataToSend.append('nombre', formObject.nombre || '');
                    formDataToSend.append('email', formObject.email || '');
                    formDataToSend.append('edad', formObject.edad || '');
                    // El backend espera 'genero'; el formulario usa 'sexo'
                    formDataToSend.append('genero', formObject.sexo || formObject.genero || '');
                    formDataToSend.append('peso', formObject.peso || '');
                    formDataToSend.append('altura', formObject.altura || '');
                    formDataToSend.append('tipo_sangre', formObject.tipo_sangre || '');
                    formDataToSend.append('alergias', formObject.alergias || '');
                    formDataToSend.append('enfermedades', formObject.enfermedades || '');
                    
                    // Agregar el token CSRF si está presente
                    if (csrfToken) {
                        formDataToSend.append('csrf_token', csrfToken);
                    }
                    
                    // Enviar los datos usando FormData directamente
                    fetch(this.action, {
                        method: 'POST',
                        body: formDataToSend,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin' // Asegura que las cookies se envíen con la solicitud
                    })
                    .then(async response => {
                        const responseText = await response.text();
                        console.log('Respuesta del servidor:', response.status, response.statusText, responseText);
                        
                        if (!response.ok) {
                            // Si la respuesta no es exitosa, intentar obtener el mensaje de error
                            try {
                                // Intentar analizar la respuesta como JSON
                                const errorData = JSON.parse(responseText);
                                const errorMessage = errorData.message || 
                                                  errorData.error || 
                                                  'Error desconocido del servidor';
                                
                                // Si hay errores de validación, mostrarlos
                                if (errorData.errors) {
                                    const validationErrors = Object.values(errorData.errors).join('\n');
                                    return Promise.reject(`Error de validación:\n${validationErrors}`);
                                }
                                
                                return Promise.reject(errorMessage);
                            } catch (e) {
                                // Si no se puede analizar como JSON, devolver el texto de respuesta
                                return Promise.reject(responseText || `Error ${response.status}: ${response.statusText}`);
                            }
                        }
                        
                        // Si la respuesta es exitosa, intentar analizarla como JSON
                        try {
                            return JSON.parse(responseText);
                        } catch (e) {
                            console.error('Error al analizar la respuesta JSON:', e);
                            return Promise.reject('Error al procesar la respuesta del servidor');
                        }
                    })
                    .then(data => {
                        if (data && data.success) {
                            // Mostrar mensaje de éxito
                            const successAlert = document.createElement('div');
                            successAlert.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4';
                            successAlert.role = 'alert';
                            successAlert.innerHTML = `
                                <strong class="font-bold">¡Éxito!</strong>
                                <span class="block sm:inline">${data.message || 'Paciente creado correctamente'}</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <i class="fas fa-times cursor-pointer" onclick="this.parentElement.parentElement.remove()"></i>
                                </span>
                            `;
                            
                            // Insertar el mensaje antes del formulario
                            this.parentNode.insertBefore(successAlert, this);
                            
                            // Cerrar el modal después de 2 segundos
                            setTimeout(() => {
                                const modal = document.getElementById('nuevoPacienteModal');
                                if (modal) modal.classList.add('hidden');
                                // Recargar la página para ver los cambios
                                window.location.reload();
                            }, 2000);
                        } else {
                            // Mostrar mensaje de error del servidor
                            let errorMsg = 'Error al procesar la solicitud';
                            let errorDetails = '';
                            
                            if (data) {
                                if (typeof data === 'string') {
                                    errorMsg = data;
                                } else if (data.message) {
                                    errorMsg = data.message;
                                } else if (data.error) {
                                    errorMsg = data.error;
                                } else if (data.errors) {
                                    errorDetails = Object.values(data.errors).join('\n');
                                }
                            }
                            
                            console.error('Error en la respuesta:', data);
                            throw new Error(`${errorMsg}\n${errorDetails}`);
                        }
                    })
                    .catch(error => {
                        console.error('Error en la petición:', {
                            message: error.message,
                            name: error.name,
                            stack: error.stack,
                            response: error.response
                        });
                        
                        // Mostrar el error en la consola para depuración
                        if (error.response) {
                            console.error('Respuesta del servidor:', error.response);
                        }
                        
                        // Mostrar mensaje de error detallado
                        const errorAlert = document.createElement('div');
                        errorAlert.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4';
                        errorAlert.role = 'alert';
                        errorAlert.innerHTML = `
                            <strong class="font-bold">¡Error!</strong>
                            <span class="block sm:inline">${error.message || 'Error al intentar crear el paciente. Verifica los datos e inténtalo de nuevo.'}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <i class="fas fa-times cursor-pointer" onclick="this.parentElement.parentElement.remove()"></i>
                            </span>
                            <div class="mt-2 text-sm text-red-600">
                                Si el problema persiste, por favor contacta al soporte técnico.
                            </div>
                        `;
                        
                        // Insertar el mensaje antes del formulario
                        const formContainer = document.querySelector('#nuevoPacienteModal .bg-white');
                        if (formContainer) {
                            formContainer.insertBefore(errorAlert, formContainer.firstChild);
                        } else {
                            this.parentNode.insertBefore(errorAlert, this);
                        }
                        
                        // Hacer scroll hasta el mensaje de error
                        errorAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    });
                });
            }
        });
    </script>
{{ ... }}
    </div>
</body>
</html>
