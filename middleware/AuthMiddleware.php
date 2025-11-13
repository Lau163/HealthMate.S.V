<?php

class AuthMiddleware {
    private $rutasPublicas = [
        'auth/login',
        'auth/register',
        'auth/forgot-password',
        'auth/reset-password',
        'index/sessionCleaner',
        'servicios/registrarPorTipo', // Para peticiones AJAX de servicios
        'servicios/getHistorial',
        'servicios/getEstadisticas',
        'servicios', // Vista de servicios
        '' // Página de inicio
    ];

    public function handle() {
        // Limpiar cualquier output buffer que pueda estar causando problemas
        if (ob_get_level()) {
            ob_clean();
        }

        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Generar token CSRF si no existe
        if (empty($_SESSION['csrf_token'])) {
            try {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            } catch (Exception $e) {
                // Fallback en caso de que random_bytes no esté disponible
                $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
            }
        }

        // Verificar si hay demasiadas redirecciones (indicador de bucle)
        if (isset($_SESSION['redirect_count']) && $_SESSION['redirect_count'] > 3) {
            // Reset counter and redirect to session cleaner
            unset($_SESSION['redirect_count']);
            header('Location: ' . BASE_URL . 'session_cleaner.php');
            exit;
        }

        // Incrementar contador de redirecciones
        $_SESSION['redirect_count'] = ($_SESSION['redirect_count'] ?? 0) + 1;

        // Obtener la URL solicitada
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $basePath = trim(parse_url(BASE_URL, PHP_URL_PATH), '/');

        // Eliminar el path base de la URI si existe
        if (!empty($basePath) && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
            $uri = trim($uri, '/');
        }

        // Si la URI está vacía (raíz del sitio), permitir acceso y reset counter
        if (empty($uri)) {
            $_SESSION['redirect_count'] = 0;
            return true;
        }

        // Verificar si es una petición AJAX
        $isAjaxRequest = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        // Verificar si la ruta es pública
        $esRutaPublica = false;
        foreach ($this->rutasPublicas as $ruta) {
            if (strpos($uri, $ruta) === 0) {
                $esRutaPublica = true;
                $_SESSION['redirect_count'] = 0; // Reset counter for public routes
                break;
            }
        }

        // Si es una ruta pública, permitir el acceso
        if ($esRutaPublica) {
            return true;
        }

        // Modo debug: permitir acceso si hay parámetro debug en la URL
        if (isset($_GET['debug']) && $_GET['debug'] === '1') {
            // Simular sesión de usuario para testing
            $_SESSION['usuario_id'] = 1;
            $_SESSION['usuario_nombre'] = 'Usuario de Prueba';
            $_SESSION['usuario_email'] = 'test@healthmate.com';
            $_SESSION['redirect_count'] = 0;
            $_SESSION['ultimo_acceso'] = time();
        }

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            // Reset redirect counter before redirecting
            $_SESSION['redirect_count'] = 0;

            if ($isAjaxRequest) {
                // Para peticiones AJAX, devolver error JSON en lugar de redirigir
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
                exit;
            } else {
                $_SESSION['redirect_url'] = $uri;
                header('Location: ' . BASE_URL . 'auth/login');
                exit;
            }
        } else {
            // DEBUG: Usuario autenticado, mostrar información de la sesión
            error_log("DEBUG AuthMiddleware: Usuario autenticado - ID: " . $_SESSION['usuario_id']);
            error_log("DEBUG AuthMiddleware: URI: $uri");
            error_log("DEBUG AuthMiddleware: Is AJAX: " . ($isAjaxRequest ? 'Sí' : 'No'));
        }

        // Verificar si la sesión ha expirado (reducir tiempo para testing)
        $tiempoInactividad = 3600; // 1 hora para testing (antes 30 minutos)
        if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso'] > $tiempoInactividad)) {
            //Destruir la sesión y reset counter
            $_SESSION['redirect_count'] = 0;
            session_unset();
            session_destroy();

            if ($isAjaxRequest) {
                // Para peticiones AJAX, devolver error JSON
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Sesión expirada']);
                exit;
            } else {
                $_SESSION['error'] = 'Tu sesión ha expirado por inactividad. Por favor, inicia sesión nuevamente.';
                header('Location: ' . BASE_URL . 'auth/login');
                exit;
            }
        } else {
            // Si no ha expirado, actualizar el tiempo de último acceso
            $_SESSION['ultimo_acceso'] = time();
        }
    }
}
