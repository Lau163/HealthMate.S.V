<?php
/**
 * Clase base para todos los controladores
 */
class ControllerBase {
    protected $models = []; // Almacena las instancias de los modelos
    public $view;
    public $sociedadEmail;
    public $correoEmail;
    public $passwordEmail;
    public $logoEmail;
    
    function __construct() {
        $this->view = new ViewBase();
    }

    /**
     * Carga un modelo y lo devuelve
     * @param string $model Nombre del modelo a cargar
     * @return object|null Instancia del modelo o null si no se pudo cargar
     */
    function loadModel($model) {
        // Si el modelo ya está cargado, lo devolvemos
        if (isset($this->models[$model])) {
            return $this->models[$model];
        }
        
        $url = "models/" . $model . ".model.php";

        if (file_exists($url)) {
            require_once $url;

            $modelName = $model . "Model";
            if (class_exists($modelName)) {
                $this->models[$model] = new $modelName();
                return $this->models[$model];
            }
        }
        
        error_log("No se pudo cargar el modelo: " . $model);
        return null;
    }
    
    /**
     * Obtiene una instancia de un modelo cargado
     * @param string $modelName Nombre del modelo
     * @return object|null Instancia del modelo o null si no existe
     */
    function getModel($modelName) {
        return $this->models[$modelName] ?? null;
    }
    
    /**
     * Redirige a otra URL
     * @param string $url URL a la que redirigir
     */
    function redirect($url) {
        header('Location: ' . $url);
        exit;
    }
    
    /**
     * Recarga la página actual
     */
    function recargar() {
        $this->redirect($_SERVER['REQUEST_URI']);
    }

    /**
     * Renderiza una vista
     * @param string $vista Ruta de la vista a renderizar
     */
    function renderView($vista) {
        if ($this->view instanceof ViewBase) {
            $this->view->render($vista);
        }
    }
}

 ?>
