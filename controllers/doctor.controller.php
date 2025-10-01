<?php
class Doctor extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
        // Cargar modelos necesarios
        $this->loadModel('doctor');
        $this->loadModel('paciente');
    }
    function render(){
        $this->panel();
    }

    // Panel tipo dashboard para doctores (estilo enfermerx)
    public function panel()
    {
        // Seguridad básica: requerir sesión
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        $totalDoctores = 0;
        try {
            $lista = $this->model ? $this->model->getAll() : [];
            $totalDoctores = is_array($lista) ? count($lista) : 0;
        } catch (Throwable $th) {
            $totalDoctores = 0;
        }

        // Datos de ejemplo para KPIs adicionales
        $citasHoy = 8; // TODO: integrar citas reales
        $alertas = 1; // TODO: integrar alertas reales

        $this->view->set('kpis', [
            'totalDoctores' => $totalDoctores,
            'citasHoy' => $citasHoy,
            'alertas' => $alertas,
        ]);
        $this->view->render('doctor/index');
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
            header('Location: ' . BASE_URL . 'doctor');
            exit;
        }

        $id = isset($params[0]) ? (int)$params[0] : 0;
        if ($id <= 0) {
            $_SESSION['error'] = 'ID de doctor inválido';
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

    // Mostrar formulario para nuevo paciente
    public function nuevoPaciente()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }
        $this->view->render('doctor/nuevo_paciente');
    }

    // Procesar el registro de nuevo paciente
    public function registrarPaciente()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'doctor');
            exit;
        }

        // Validar y sanitizar datos
        $datos = [
            'nombres' => filter_input(INPUT_POST, 'nombres', FILTER_SANITIZE_STRING),
            'apellidos' => filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING),
            'fecha_nacimiento' => filter_input(INPUT_POST, 'fecha_nacimiento', FILTER_SANITIZE_STRING),
            'genero' => filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING),
            'telefono' => filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'direccion' => filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING),
            'tipo_sangre' => filter_input(INPUT_POST, 'tipo_sangre', FILTER_SANITIZE_STRING),
            'alergias' => filter_input(INPUT_POST, 'alergias', FILTER_SANITIZE_STRING),
            'enfermedades_cronicas' => filter_input(INPUT_POST, 'enfermedades_cronicas', FILTER_SANITIZE_STRING),
            'medicamentos' => filter_input(INPUT_POST, 'medicamentos', FILTER_SANITIZE_STRING)
        ];

        // Validaciones básicas
        if (empty($datos['nombres']) || empty($datos['apellidos'])) {
            $_SESSION['error'] = 'El nombre y apellido son obligatorios';
            header('Location: ' . BASE_URL . 'doctor/nuevo-paciente');
            exit;
        }

        try {
            // Insertar en la base de datos
            $resultado = $this->model->insert($datos);
            
            if ($resultado) {
                $_SESSION['mensaje'] = 'Paciente registrado exitosamente';
                header('Location: ' . BASE_URL . 'doctor');
            } else {
                throw new Exception('Error al registrar el paciente');
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al registrar el paciente: ' . $e->getMessage();
            header('Location: ' . BASE_URL . 'doctor/nuevo-paciente');
        }
        exit;
    }
}
?>