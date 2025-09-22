<?php
class Enfermerx extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
        // Cargar modelo
        // $this->loadModel('enfermerx');
    }
    function render(){
        $this->view->render('enfermerx/index');
    }
}
?>