<?php
// Iniciar sesión solo si no está ya iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "controllers/error.controller.php";
class App
{
    private $alertLogin;
    private $url;
    public function __construct()
    {
        // Obtener y normalizar la URL
        $this->url = isset($_GET['url']) ? $_GET['url'] : null;
        $this->url = rtrim($this->url ?? '', "/");
        $this->url = filter_var($this->url, FILTER_SANITIZE_URL);
        $this->url = explode("/", $this->url);

        // Cuando se ingresa sin definir el controlador
        if (empty($this->url[0])) {
            $archivoController = "controllers/index.controller.php";
            require_once $archivoController;
            $controller = new Index();
            $controller->loadModel("index");
            $controller->render();
            return false;
        }
        $this->general($this->url);
    }
    function general($url_general)
    {
        $archivoController = "controllers/" . $url_general[0] . ".controller.php";

        if (file_exists($archivoController)) {
            require_once $archivoController;
            // Inicializa el controlador
            $controller = new $url_general[0];
            $controller->loadModel($url_general[0]);
            // Número de elementos del arreglo URL
            $nparam = sizeof($url_general);
            if ($nparam > 1) {
                if ($nparam > 2) {
                    $param = [];
                    for ($i = 2; $i < $nparam; $i++) {
                        array_push($param, $url_general[$i]);
                    }
                    if (method_exists($controller, $url_general[1])) {
                        $controller->{$url_general[1]}($param);
                    } else {
                        $controller = new Errores();
                        $controller->index('404');
                    }
                } else {
                    if (method_exists($controller, $url_general[1])) {
                        $controller->{$url_general[1]}(); //Carga el metodo
                    } else {
                        $controller = new Errores();
                        $controller->index('404');
                    }
                }
            } else {
                $controller->render();
            }
        } else {
            $controller = new Errores();
            $controller->index('404');
        }
    }
}