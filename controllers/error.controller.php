<?php
/**
 *
 */
class Errores extends ControllerBase
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Muestra la vista de error.
     * @param string $codigo El código de error (ej. 404).
     */
    public function index($codigo = '404')
    {
        $this->view->set('codigo', $codigo);
        $this->view->render('error/index');
    }
}

?>