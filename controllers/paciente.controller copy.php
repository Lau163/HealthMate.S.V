<?php
class Paciente extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
        // Cargar el modelo de pacientes
        $this->loadModel('paciente');
    }

    function render() {
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

    // Panel tipo dashboard para pacientes
    public function panel() {
        // Seguridad básica: requerir sesión
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        $totalPacientes = 0;
        try {
            $lista = $this->model ? $this->model->getAll() : [];
            $totalPacientes = is_array($lista) ? count($lista) : 0;
        } catch (Throwable $th) {
            $totalPacientes = 0;
        }

        // Datos de ejemplo para KPIs adicionales
        $citasPendientes = 5; // TODO: integrar cuando exista módulo de citas
        $alertas = 2; // TODO: integrar alertas reales

        $this->view->set('kpis', [
            'totalPacientes' => $totalPacientes,
            'citasPendientes' => $citasPendientes,
            'alertas' => $alertas,
        ]);
        $this->view->render('paciente/index');
    }

    // Mostrar formulario para nuevo paciente
    public function nuevo() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Cargar el modelo de usuario para crear el paciente
                $this->loadModel('usuario');
                
                // Datos del formulario
                $datos = [
                    'Id_Rol' => 4, // Asumiendo que 4 es el ID del rol de paciente
                    'Nombre' => $_POST['Nombre'] ?? '',
                    'Email' => $_POST['Email'] ?? '',
                    'Password' => password_hash('temp123', PASSWORD_DEFAULT), // Contraseña temporal
                    'Edad' => $_POST['Edad'] ?? null,
                    'Sexo' => $_POST['Sexo'] ?? null,
                    'Peso' => $_POST['Peso'] ?? null,
                    'Altura' => $_POST['Altura'] ?? null,
                    'Tipo_sangre' => $_POST['Tipo_sangre'] ?? null,
                    'Alergias' => $_POST['Alergias'] ?? null,
                    'Enfermedades' => $_POST['Enfermedades'] ?? null,
                    'Activo' => 1
                ];

                // Validar datos requeridos
                if (empty($datos['Nombre']) || empty($datos['Email'])) {
                    throw new Exception('Nombre y correo electrónico son campos requeridos');
                }

                // Crear el paciente
                $idPaciente = $this->model->create($datos);
                
                if ($idPaciente) {
                    $_SESSION['success'] = 'Paciente creado correctamente';
                    header('Location: ' . BASE_URL . 'paciente');
                    exit;
                } else {
                    throw new Exception('No se pudo crear el paciente');
                }
            } catch (Exception $e) {
                $this->view->set('error', $e->getMessage());
                $this->view->set('paciente', $_POST); // Mantener los datos del formulario
                $this->view->render('paciente/nuevo');
            }
        } else {
            // Mostrar formulario vacío
            $this->view->render('paciente/nuevo');
        }
    }

    // Mostrar formulario de edición o actualizar un paciente (según método)
    public function editar($params = []) {
        if (!$this->model) { 
            $this->view->render('paciente/paciente'); 
            return; 
        }

        $id = isset($params[0]) ? (int)$params[0] : 0;
        if ($id <= 0) {
            $_SESSION['error'] = 'ID de paciente inválido';
            header('Location: ' . BASE_URL . 'paciente');
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
                $_SESSION['success'] = 'Paciente actualizado correctamente';
                header('Location: ' . BASE_URL . 'paciente');
                exit;
            } catch (Throwable $th) {
                $_SESSION['error'] = 'No se pudo actualizar el paciente';
                header('Location: ' . BASE_URL . 'paciente/editar/' . $id);
                exit;
            }
        } else {
            $paciente = $this->model->getById($id);
            if (!$paciente) {
                $_SESSION['error'] = 'Paciente no encontrado';
                header('Location: ' . BASE_URL . 'paciente');
                exit;
            }
            $this->view->set('paciente', $paciente);
            $this->view->render('paciente/editar');
        }
    }

    // Eliminar paciente (solo POST)
    public function eliminar($params = []) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error'] = 'Método no permitido para eliminar';
            header('Location: ' . BASE_URL . 'paciente');
            exit;
        }
        
        if (!$this->model) { 
            $_SESSION['error'] = 'Modelo no disponible'; 
            header('Location: ' . BASE_URL . 'paciente'); 
            exit; 
        }
        
        $id = isset($params[0]) ? (int)$params[0] : 0;
        if ($id <= 0) {
            $_SESSION['error'] = 'ID inválido';
            header('Location: ' . BASE_URL . 'paciente');
            exit;
        }
        
        try {
            $this->model->deleteById($id);
            $_SESSION['success'] = 'Paciente eliminado correctamente';
        } catch (Throwable $th) {
            $_SESSION['error'] = 'No se pudo eliminar el paciente';
        }
        
        header('Location: ' . BASE_URL . 'paciente');
        exit;
    }
}
?>