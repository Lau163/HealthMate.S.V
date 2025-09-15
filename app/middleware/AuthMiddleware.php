<?php
// app/middleware/AuthMiddleware.php

class AuthMiddleware {
    public static function handle($rolesPermitidos = []) {
        session_start();
        
        // Si no hay sesión activa, redirigir al login
        if (!isset($_SESSION['usuario_id'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            $_SESSION['error'] = 'Por favor inicia sesión para acceder a esta página.';
            header('Location: /login');
            exit;
        }
        
        // Verificar si el rol del usuario está autorizado
        if (!empty($rolesPermitidos) && !in_array($_SESSION['usuario_rol'], $rolesPermitidos)) {
            $_SESSION['error'] = 'No tienes permisos para acceder a esta sección.';
            header('Location: /acceso-denegado');
            exit;
        }
        
        return true;
    }
    
    public static function soloInvitados() {
        session_start();
        
        // Si hay una sesión activa, redirigir al dashboard según el rol
        if (isset($_SESSION['usuario_id'])) {
            $authController = new AuthController();
            $authController->redirigirSegunRol();
        }
    }
}