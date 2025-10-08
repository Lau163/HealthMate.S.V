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

    function servicios(){
        // Renderizar la vista de servicios
        $this->view->render('paciente/servicios');
    }

    function Graficas(){
        // Renderizar la vista de gráficas
        $this->view->render('paciente/Graficas');
    }

    function Perfil(){
        // Renderizar la vista de perfil
        $this->view->render('paciente/Perfil');
    }

    function ParametrosSV(){
        // Renderizar la vista de parámetros de signos vitales
        $this->view->render('paciente/ParametrosSV');
    }

    function Archivo(){
        // Renderizar la vista de archivo
        $this->view->render('paciente/Archivo');
    }

    function ConsejoPx(){
        // Renderizar la vista de consejos para pacientes
        $this->view->render('paciente/ConsejoPx');
    }

    function PaginasConsejos(){
        // Renderizar la vista de páginas de consejos
        $this->view->render('paciente/PaginasConsejos');
    }

    function editar(){
        // Renderizar la vista de editar
        $this->view->render('paciente/editar');
    }

}
?>