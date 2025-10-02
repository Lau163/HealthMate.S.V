<?php
class Paciente extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
        // Cargar el modelo de pacientes
        $this->loadModel('paciente');
    }
    function render(){
        // Obtener pacientes de forma dinámica
        $pacientes = [];
        if ($this->model) {
            try {
                $pacientes = $this->model->getAll();
            } catch (Throwable $th) {
                // Puedes loguear el error si deseas
            }
        }
        $this->view->set('pacientes', $pacientes);
        $this->view->render('paciente/index');
    }

    // Panel tipo dashboard para pacientes (estilo enfermerx)

}
?>