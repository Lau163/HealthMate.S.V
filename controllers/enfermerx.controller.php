<?php
class Enfermerx extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
    }
    function render(){
        $this->view->render('enfermerx/index');
    }
}
?>