<?php
// Iniciar la sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir controlador de errores
require_once "controllers/error.controller.php";
// Incluir el middleware de autenticación
require_once "app/middleware/AuthMiddleware.php";

class App
{
    private $url;
    
    public function __construct()
    {
        // Obtener la URL limpia
        $this->url = isset($_GET['url']) ? $_GET['url'] : null;
        $this->url = rtrim($this->url ?? '', "/");
        $this->url = explode("/", $this->url);
        
        // Manejar rutas públicas (que no requieren autenticación)
        $rutasPublicas = [ 'index','auth', 'login', 'recuperar', 'registro', 'error', ];
        
        // Verificar si la ruta actual es pública
        $rutaActual = $this->url[0] ?? 'index';
        $esRutaPublica = in_array($rutaActual, $rutasPublicas);
        
        // Si no es una ruta pública y el usuario no está autenticado, redirigir al login
        if (!$esRutaPublica && !isset($_SESSION['usuario_id'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            $_SESSION['error'] = 'Por favor inicia sesión para acceder a esta página.';
            header('Location: index');
            exit;
        }
        
        // Si la ruta es el índice principal
        if (empty($this->url[0])) {
            $this->cargarControlador('index');
            return;
        }
        
        // Manejar la ruta solicitada
        $this->manejarRuta($this->url);
    }
    
    /**
     * Maneja la ruta solicitada
     */
    private function manejarRuta($url)
    {
        $archivoController = "controllers/" . $url[0] . ".controller.php";
        
        // Si el controlador no existe, mostrar error 404
        if (!file_exists($archivoController)) {
            $this->mostrarError(404);
            return;
        }
        
        // Cargar el controlador
        require_once $archivoController;
        $nombreControlador = $url[0];
        $controlador = new $nombreControlador();
        $controlador->loadModel($url[0]);
        
        // Verificar si el controlador requiere autenticación
        $this->verificarAutenticacion($controlador, $url);
        
        // Número de elementos del arreglo URL
        $nparam = count($url);
        
        // Si hay un método específico
        if ($nparam > 1) {
            $metodo = $url[1];
            
            // Verificar si el método existe en el controlador
            if (!method_exists($controlador, $metodo)) {
                $this->mostrarError(404);
                return;
            }
            
            // Si hay parámetros adicionales
            if ($nparam > 2) {
                $parametros = array_slice($url, 2);
                $controlador->{$metodo}($parametros);
            } else {
                $controlador->{$metodo}();
            }
        } else {
            // Si no hay método específico, cargar la vista por defecto
            if (method_exists($controlador, 'render')) {
                $controlador->render();
            } else {
                $this->mostrarError(404);
            }
        }
    }
    
    /**
     * Carga un controlador específico
     */
    private function cargarControlador($nombre)
    {
        $archivoController = "controllers/{$nombre}.controller.php";
        
        if (file_exists($archivoController)) {
            require_once $archivoController;
            $controlador = new $nombre();
            $controlador->loadModel($nombre);
            $controlador->render();
        } else {
            $this->mostrarError(404);
        }
    }
    
    /**
     * Verifica la autenticación y los roles del usuario
     */
    private function verificarAutenticacion($controlador, $url)
    {
        // Si el controlador tiene un método 'verificarAcceso', usarlo
        if (method_exists($controlador, 'verificarAcceso')) {
            $controlador->verificarAcceso();
            return;
        }
        
        // Verificación estándar de roles para rutas protegidas
        $rutaActual = $url[0];
        $rutasProtegidas = [
            'admin' => ['admin'],
            'doctor' => ['doctor'],
            'enfermero' => ['enfermero'],
            'paciente' => ['paciente']
        ];
        
        foreach ($rutasProtegidas as $rol => $rutas) {
            if (in_array($rutaActual, $rutas)) {
                // Verificar si el usuario tiene el rol requerido
                if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== $rol) {
                    $_SESSION['error'] = 'No tienes permisos para acceder a esta sección.';
                    header('Location: /acceso-denegado');
                    exit;
                }
                break;
            }
        }
    }
    
    /**
     * Muestra una página de error
     */
    private function mostrarError($codigo = 404)
    {
        $error = new Errores();
        $error->error($codigo);
    }
}