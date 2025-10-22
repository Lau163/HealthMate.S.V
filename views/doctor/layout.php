<?php
// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . 'auth');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Doctor | HealthMate'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="<?php echo BASE_URL; ?>views/doctor/sidebar.js" defer></script>
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
                <div class="px-2 space-y-1">
                    <!-- Dashboard -->
                    <a href="<?php echo BASE_URL; ?>doctor/inicio?debug=1" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-emerald-600 bg-emerald-50">
                        <i class="fas fa-home text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Inicio</span>
                    </a>

                    <!-- Doctor -->
                    <a href="<?php echo BASE_URL; ?>doctor/perfil?debug=1" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                        <i class="fas fa-user-md text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Mi Perfil</span>
                    </a>

                    <!-- Pacientes -->
                    <a href="<?php echo BASE_URL; ?>doctor/pacientes?debug=1" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                        <i class="fas fa-users text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Pacientes</span>
                    </a>

                    <!-- Consultas -->
                    <a href="<?php echo BASE_URL; ?>doctor/consultas?debug=1" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                        <i class="far fa-calendar-alt text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Consultas</span>
                    </a>

                    <!-- Historial Clínico -->
                    <a href="<?php echo BASE_URL; ?>doctor/historial_clinico?debug=1" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                        <i class="fas fa-file-medical text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Historial Clínico</span>
                    </a>

                    <!-- Medicamentos -->
                    <a href="<?php echo BASE_URL; ?>doctor/medicamentos?debug=1" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                        <i class="fas fa-pills text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Medicamentos</span>
                    </a>

                    <!-- Estadísticas -->
                    <a href="<?php echo BASE_URL; ?>doctor/estadisticas?debug=1" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                        <i class="fas fa-chart-bar text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Estadísticas</span>
                    </a>

                    <!-- Consejos -->
                    <a href="<?php echo BASE_URL; ?>doctor/consejos?debug=1" class="sidebar-item flex items-center px-6 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                        <i class="fas fa-heart text-lg"></i>
                        <span class="sidebar-text ml-3 hidden md:inline-block">Consejos</span>
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
                        <h1 class="text-xl font-semibold text-white"><?php echo $pageTitle ?? 'Panel del Doctor'; ?></h1>
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
                                    <span class="text-white font-medium">
                                        <?php
                                        $nombre = $_SESSION['usuario_nombre'] ?? 'U';
                                        $iniciales = '';
                                        if (!empty($nombre)) {
                                            $nombres = explode(' ', $nombre);
                                            $iniciales = strtoupper(substr($nombres[0], 0, 1));
                                            if (isset($nombres[1])) {
                                                $iniciales .= strtoupper(substr($nombres[1], 0, 1));
                                            }
                                        }
                                        echo $iniciales ?: 'U';
                                        ?>
                                    </span>
                                </div>
                                <span class="ml-2 hidden md:inline-block"><?php echo htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Usuario'); ?></span>
                                <i class="fas fa-chevron-down ml-1 text-xs hidden md:inline-block"></i>
                            </button>
                        </div>

                        <!-- Logout -->
                        <a href="<?php echo BASE_URL; ?>auth/logout" class="text-white hover:text-emerald-200 transition-colors">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 md:p-6 w-full">
                <?php
                // Mostrar mensajes de éxito o error
                if (isset($_SESSION['error'])): ?>
                    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                        <p><?php echo htmlspecialchars($_SESSION['error']); ?></p>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                        <p><?php echo htmlspecialchars($_SESSION['success']); ?></p>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <!-- Aquí va el contenido específico de cada página -->
                <?php echo $content ?? ''; ?>
            </main>
        </div>
    </div>
</body>
</html>
