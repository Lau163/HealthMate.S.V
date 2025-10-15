<?php

class AuthMiddleware {
    private $rutasPublicas = [
        'auth/login',
        'auth/register',
        'auth/forgot-password',
        'auth/reset-password',
        'index/sessionCleaner',
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

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            // Reset redirect counter before redirecting
            $_SESSION['redirect_count'] = 0;
            $_SESSION['redirect_url'] = $uri;

            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        // Verificar si la sesión ha expirado
        $tiempoInactividad = 1800; // 30 minutos de inactividad
        if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso'] > $tiempoInactividad)) {
            //Destruir la sesión y reset counter
            $_SESSION['redirect_count'] = 0;
            session_unset();
            session_destroy();

            $_SESSION['error'] = 'Tu sesión ha expirado por inactividad. Por favor, inicia sesión nuevamente.';
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        // Actualizar el tiempo de último acceso y reset counter
        $_SESSION['ultimo_acceso'] = time();
        $_SESSION['redirect_count'] = 0;

        return true;
    }
}
