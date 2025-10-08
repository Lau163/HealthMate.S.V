<?php

class AuthMiddleware {
    private $rutasPublicas = [
        'auth/login',
        'auth/register',
        'auth/forgot-password',
        'auth/reset-password',
        '' // Página de inicio
    ];

    public function handle() {
        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener la URL solicitada
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $basePath = trim(parse_url(BASE_URL, PHP_URL_PATH), '/');
        
        // Eliminar el path base de la URI si existe
        if (!empty($basePath) && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
            $uri = trim($uri, '/');
        }

        // Verificar si la ruta es pública
        $esRutaPublica = false;
        foreach ($this->rutasPublicas as $ruta) {
            if (strpos($uri, $ruta) === 0) {
                $esRutaPublica = true;
                break;
            }
        }

        // Si es una ruta pública, permitir el acceso
        if ($esRutaPublica) {
            return true;
        }

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            // Guardar la URL solicitada para redirigir después del login
            $_SESSION['redirect_url'] = $uri;
            
            // Redirigir al login
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        // Verificar si la sesión ha expirado
        $tiempoInactividad = 1800; // 30 minutos de inactividad
        if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso'] > $tiempoInactividad)) {
            // Destruir la sesión
            session_unset();
            session_destroy();
            
            // Redirigir al login con mensaje de sesión expirada
            $_SESSION['error'] = 'Tu sesión ha expirado por inactividad. Por favor, inicia sesión nuevamente.';
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        // Actualizar el tiempo de último acceso
        $_SESSION['ultimo_acceso'] = time();

        return true;
    }
}
