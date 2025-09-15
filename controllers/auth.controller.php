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
    
    public function mostrarLogin() {
        // Si ya está autenticado, redirigir al dashboard según su rol
        if (isset($_SESSION['usuario_id'])) {
            $this->redirigirSegunRol();
        }
        
        $this->render('auth/login');
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }
        
        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';
            
            if (empty($email) || empty($password)) {
                throw new Exception('Por favor, completa todos los campos.');
            }
            
            $usuario = $this->usuarioModel->verificarCredenciales($email, $password);
            
            if ($usuario) {
                $this->usuarioModel->crearSesion($usuario);
                $this->redirigirSegunRol();
            } else {
                throw new Exception('Credenciales incorrectas. Por favor, inténtalo de nuevo.');
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /login');
            exit;
        }
    }
    
    public function logout() {
        // Destruir todas las variables de sesión
        $_SESSION = array();
        
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