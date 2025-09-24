<?php
class Doctor extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
        // Cargar el modelo de doctores
        $this->loadModel('doctor');
    }
    function render(){
        // Obtener doctores de forma dinámica
        $doctores = [];
        if ($this->model) {
            try {
                $doctores = $this->model->getAll();
            } catch (Throwable $th) {
                // Puedes loguear el error si deseas
            }
        }
        $this->view->set('doctores', $doctores);
        $this->view->render('doctor/doctor');
    }

    // Mostrar formulario de edición o actualizar un doctor (según método)
    public function editar($params = [])
    {
        if (!$this->model) { $this->view->render('doctor/doctor'); return; }

        $id = isset($params[0]) ? (int)$params[0] : 0;
        if ($id <= 0) {
            $_SESSION['error'] = 'ID de doctor inválido';
            header('Location: ' . BASE_URL . 'doctor');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'Nombre' => $_POST['Nombre'] ?? null,
                'Email' => $_POST['Email'] ?? null,
                'Edad' => $_POST['Edad'] ?? null,
                'Sexo' => $_POST['Sexo'] ?? null,
                'Peso' => $_POST['Peso'] ?? null,
                'Altura' => $_POST['Altura'] ?? null,
                'Tipo_sangre' => $_POST['Tipo_sangre'] ?? null,
                'Alergias' => $_POST['Alergias'] ?? null,
                'Enfermedades' => $_POST['Enfermedades'] ?? null,
            ];
            try {
                $this->model->updateById($id, $datos);
                $_SESSION['success'] = 'Doctor actualizado correctamente';
                header('Location: ' . BASE_URL . 'doctor');
                exit;
            } catch (Throwable $th) {
                $_SESSION['error'] = 'No se pudo actualizar el doctor';
                header('Location: ' . BASE_URL . 'doctor/editar/' . $id);
                exit;
            }
        } else {
            $doctor = $this->model->getById($id);
            if (!$doctor) {
                $_SESSION['error'] = 'Doctor no encontrado';
                header('Location: ' . BASE_URL . 'doctor');
                exit;
            }
            $this->view->set('doctor', $doctor);
            $this->view->render('doctor/editar');
        }
    }

    // Eliminar doctor (solo POST)
    public function eliminar($params = [])
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error'] = 'Método no permitido para eliminar';
            header('Location: ' . BASE_URL . 'doctor');
            exit;
        }
        if (!$this->model) { $_SESSION['error'] = 'Modelo no disponible'; header('Location: ' . BASE_URL . 'doctor'); exit; }
        $id = isset($params[0]) ? (int)$params[0] : 0;
        if ($id <= 0) {
            $_SESSION['error'] = 'ID inválido';
            header('Location: ' . BASE_URL . 'doctor');
            exit;
        }
        try {
            $this->model->deleteById($id);
            $_SESSION['success'] = 'Doctor eliminado correctamente';
        } catch (Throwable $th) {
            $_SESSION['error'] = 'No se pudo eliminar el doctor';
        }
        header('Location: ' . BASE_URL . 'doctor');
        exit;
    }
}
?>