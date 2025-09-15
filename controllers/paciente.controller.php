<?php
class Paciente extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
    }
    function render(){
        $this->view->render('paciente/index');
    }
}
?>