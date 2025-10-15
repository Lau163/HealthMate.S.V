<?php
class Login extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
    }

    function render(){
        // Renderizar la vista de login
        $this->view->render('auth/login');
    }

    function logout(){
        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Destruir la sesión
        session_unset();
        session_destroy();
        
        // Redirigir al index
        header('Location: ' . BASE_URL);
        exit();
    }
}
