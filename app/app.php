<?php
session_start();
require_once "controllers/error.controller.php";
class App
{
    
    // Rutas de autenticación
    private $rutas = [
        'auth/login' => ['auth', 'mostrarLogin'],
        'auth/logout' => ['auth', 'logout'],
        'auth/autenticar' => ['auth', 'login'],
        // ... otras rutas
    ];

    public function __construct() {
        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Configurar token CSRF si no existe
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Obtener la URL solicitada
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'inicio';
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        // Manejar la ruta
        $this->manejarRuta($url);
    }

    private function manejarRuta($url) {
        // Convertir la URL a un string para buscar en las rutas
        $rutaSolicitada = implode('/', $url);
        
        // Verificar si la ruta existe en el array de rutas
        if (array_key_exists($rutaSolicitada, $this->rutas)) {
            $controlador = $this->rutas[$rutaSolicitada][0];
            $metodo = $this->rutas[$rutaSolicitada][1];
            
            // Cargar el controlador
            $archivoControlador = 'controllers/' . $controlador . '.controller.php';
            
            if (file_exists($archivoControlador)) {
                require_once $archivoControlador;
                
                // Crear instancia del controlador
                $claseControlador = ucfirst($controlador) . 'Controller';
                $controlador = new $claseControlador();
                
                // Llamar al método correspondiente
                if (method_exists($controlador, $metodo)) {
                    $controlador->$metodo();
                    return;
                }
            }
        }
        
        // Si no se encontró la ruta, mostrar error 404
        $this->mostrarError(404);
    }
    
    private function mostrarError($codigo) {
        http_response_code($codigo);
        require_once 'controllers/error.controller.php';
        $error = new ErrorController();
        $error->index($codigo);
        exit;
    }
}