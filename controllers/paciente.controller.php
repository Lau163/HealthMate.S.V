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
        $model = $this->getModel('paciente');
        if ($model) {
            try {
                $pacientes = $model->getAll();
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
            $lista = $this->getModel('paciente') ? $this->getModel('paciente')->getAll() : [];
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
                $usuarioModel = $this->getModel('usuario');
                $idPaciente = $usuarioModel ? $usuarioModel->create($datos) : null;
                
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
        if (!$this->getModel('paciente')) { 
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
                $pacienteModel = $this->getModel('paciente');
                if ($pacienteModel) {
                    $pacienteModel->updateById($id, $datos);
                }
                $_SESSION['success'] = 'Paciente actualizado correctamente';
                header('Location: ' . BASE_URL . 'paciente');
                exit;
            } catch (Throwable $th) {
                $_SESSION['error'] = 'No se pudo actualizar el paciente';
                header('Location: ' . BASE_URL . 'paciente/editar/' . $id);
                exit;
            }
        } else {
            $pacienteModel = $this->getModel('paciente');
            $paciente = $pacienteModel ? $pacienteModel->getById($id) : null;
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
        
        if (!$this->getModel('paciente')) { 
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
            $pacienteModel = $this->getModel('paciente');
            if ($pacienteModel) {
                $pacienteModel->deleteById($id);
            }
            $_SESSION['success'] = 'Paciente eliminado correctamente';
        } catch (Throwable $th) {
            $_SESSION['error'] = 'No se pudo eliminar el paciente';
        }
        
        header('Location: ' . BASE_URL . 'paciente');
        exit;
    }
    public function ParametrosSV() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }
        $this->view->render('paciente/parametrossv');
    }

    // Método para mostrar servicios
    public function servicios() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }
        $this->view->render('paciente/servicios');
    }

    // Método para mostrar gráficas
    public function Graficas() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }
        $this->view->render('paciente/graficas');
    }

    // Método para mostrar archivo médico
    public function Archivo() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }
        $this->view->render('paciente/archivo');
    }

    // Método para mostrar consejos
    public function PaginasConsejos() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }
        $this->view->render('paciente/paginasconsejos');
    }

    // Método para mostrar perfil del paciente
    public function Perfil() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Obtener datos del paciente actual
        $pacienteModel = $this->getModel('paciente');
        $paciente = null;

        if ($pacienteModel && isset($_SESSION['usuario_id'])) {
            try {
                $paciente = $pacienteModel->getByUsuarioId($_SESSION['usuario_id']);
            } catch (Throwable $th) {
                // Error al obtener datos del paciente
            }
        }

        $this->view->set('paciente', $paciente);
        $this->view->render('paciente/perfil');
    }

    // Página de consejos de bienestar mental
    public function bienestarMental() {
        $this->view->render('paciente/bienestarMental');
    }

    // Página de consejos de alimentación
    public function alimentacion() {
        $this->view->render('paciente/alimentacion');
    }

    // Página de consejos de hidratación
    public function hidratacion() {
        $this->view->render('paciente/hidratacion');
    }

    // Página de consejos de prevención médica
    public function prevencionMedica() {
        $this->view->render('paciente/prevencionMedica');
    }

    // Página de consejos de actividad física
    public function actividadFisica() {
        $this->view->render('paciente/actividadFisica');
    }

    // Página de consejos de sueño y descanso
    public function suenoDescanso() {
        $this->view->render('paciente/suenoDescanso');
    }

    // Página de prueba de rutas
    public function testRutas() {
        require_once '../test-rutas.php';
    }
}
?>