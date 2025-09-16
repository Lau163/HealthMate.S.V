<?php
// controllers/auth.controller.php

require_once __DIR__ . '/../app/controller.base.php';
require_once __DIR__ . '/../models/usuario.model.php';

class AuthController extends BaseController {
    private $usuarioModel;
    
    public function __construct() {
        parent::__construct();
        $this->usuarioModel = new Usuario();
    }
    
    /**
     * Muestra el formulario de login
     */
    public function mostrarLogin() {
        // Si ya está autenticado, redirigir según su rol
        if (isset($_SESSION['usuario_id'])) {
            $this->redirigirSegunRol();
            return;
        }
        
        // Mostrar mensajes de error si existen
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);
        
        $this->view->set('error', $error);
        $this->render('auth/login');
    }
    
    /**
     * Procesa el inicio de sesión
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /auth/login');
            exit;
        }

        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                throw new Exception('Por favor, ingresa tu correo y contraseña');
            }

            $usuario = $this->usuarioModel->verificarCredenciales($email, $password);

            if (!$usuario) {
                throw new Exception('Credenciales incorrectas. Por favor, inténtalo de nuevo.');
            }

            // Crear sesión
            $this->usuarioModel->crearSesion($usuario);
            
            // Actualizar último acceso
            $this->usuarioModel->actualizarUltimoAcceso($usuario['Id_Usuario']);

            // Redirigir según el rol
            $this->redirigirSegunRol();
            
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /auth/login');
            exit;
        }
    }

    /**
     * Redirige al usuario según su rol
     */
    private function redirigirSegunRol() {
        $rol = $_SESSION['usuario_rol'] ?? '';
        
        // Redirigir según el rol
        switch (strtolower($rol)) {
            case 'admin':
                $destino = '/admin';
                break;
            case 'doctor':
                $destino = '/doctor';
                break;
            case 'enfermera':
                $destino = '/enfermera';
                break;
            case 'paciente':
                $destino = '/paciente';
                break;
            default:
                $destino = '/';
        }
        
        // Verificar si hay una URL de redirección guardada
        $redirectUrl = $_SESSION['redirect_url'] ?? $destino;
        unset($_SESSION['redirect_url']);
        
        header('Location: ' . $redirectUrl);
        exit;
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout() {
        // Destruir todas las variables de sesión
        $_SESSION = [];
        
        // Si se desea destruir la sesión completamente, borra también la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Finalmente, destruir la sesión
        session_destroy();
        
        // Redirigir al login
        header('Location: /auth/login');
        exit;
    }
}
        // Si se desea destruir la sesión completamente, borra también la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Finalmente, destruir la sesión
        session_destroy();
        
        // Redirigir al login
        header('Location: /login');
        exit;
    }
    
    private function redirigirSegunRol() {
        switch ($_SESSION['usuario_rol']) {
            case 'doctor':
                header('Location: /doctor/dashboard');
                break;
            case 'enfermero':
                header('Location: /enfermero/dashboard');
                break;
            case 'paciente':
            default:
                header('Location: /paciente/dashboard');
                break;
        }
        exit;
    }

}