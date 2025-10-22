<?php
class SignosVitales extends ControllerBase
{
    public function __construct()
    {
        parent::__construct();
        $this->signosVitales = $this->loadModel('signos_vitales');
        $this->paciente = $this->loadModel('paciente');
    }

    /**
     * Muestra el formulario para registrar signos vitales
     */
    public function index()
    {
        // Verificar que sea una petición GET
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Location: ' . BASE_URL . 'signosvitales');
            exit;
        }

        // Obtener pacientes para el selector
        $pacientes = $this->paciente->getAll();

        $this->view->set('pacientes', $pacientes);
        $this->view->render('signos_vitales/index');
    }

    /**
     * Guarda un nuevo registro de signos vitales
     */
    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validar token CSRF
                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
                    throw new Exception('Token CSRF inválido');
                }

                // Obtener y validar datos del formulario
                $datosSignosVitales = [
                    'id_paciente' => (int)$_POST['id_paciente'],
                    'frecuencia_cardiaca' => !empty($_POST['frecuencia_cardiaca']) ? (int)$_POST['frecuencia_cardiaca'] : null,
                    'frecuencia_respiratoria' => !empty($_POST['frecuencia_respiratoria']) ? (int)$_POST['frecuencia_respiratoria'] : null,
                    'temperatura' => !empty($_POST['temperatura']) ? (float)$_POST['temperatura'] : null,
                    'presion_sistolica' => !empty($_POST['presion_sistolica']) ? (int)$_POST['presion_sistolica'] : null,
                    'presion_diastolica' => !empty($_POST['presion_diastolica']) ? (int)$_POST['presion_diastolica'] : null,
                    'saturacion_oxigeno' => !empty($_POST['saturacion_oxigeno']) ? (int)$_POST['saturacion_oxigeno'] : null,
                    'observaciones' => $_POST['observaciones'] ?? null
                ];

                // Validar campos obligatorios
                if (!$datosSignosVitales['id_paciente']) {
                    throw new Exception('Debe seleccionar un paciente');
                }

                // Guardar en la base de datos
                $idRegistro = $this->signosVitales->insert($datosSignosVitales);

                if ($idRegistro) {
                    $_SESSION['success'] = 'Signos vitales registrados correctamente';
                    header('Location: ' . BASE_URL . 'signosvitales');
                    exit;
                } else {
                    throw new Exception('Error al guardar los signos vitales');
                }

            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                $_SESSION['form_data'] = $_POST;
                header('Location: ' . BASE_URL . 'signosvitales');
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . 'signosvitales');
            exit;
        }
    }

    /**
     * Muestra los signos vitales de un paciente específico
     */
    public function verPaciente($params = [])
    {
        $idPaciente = isset($params[0]) ? (int)$params[0] : 0;

        if ($idPaciente <= 0) {
            $_SESSION['error'] = 'ID de paciente no válido';
            header('Location: ' . BASE_URL . 'signosvitales');
            exit;
        }

        // Obtener signos vitales del paciente
        $signosVitales = $this->signosVitales->getByPaciente($idPaciente);

        // Obtener datos del paciente
        $paciente = $this->paciente->getById($idPaciente);

        if (!$paciente) {
            $_SESSION['error'] = 'Paciente no encontrado';
            header('Location: ' . BASE_URL . 'signosvitales');
            exit;
        }

        $this->view->set('signosVitales', $signosVitales);
        $this->view->set('paciente', $paciente);
        $this->view->render('signos_vitales/ver_paciente');
    }

    /**
     * Elimina un registro de signos vitales
     */
    public function eliminar($params = [])
    {
        $idRegistro = isset($params[0]) ? (int)$params[0] : 0;

        if ($idRegistro <= 0) {
            $_SESSION['error'] = 'ID de registro no válido';
            header('Location: ' . BASE_URL . 'signosvitales');
            exit;
        }

        try {
            $resultado = $this->signosVitales->delete($idRegistro);

            if ($resultado) {
                $_SESSION['success'] = 'Registro eliminado correctamente';
            } else {
                $_SESSION['error'] = 'Error al eliminar el registro';
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al eliminar el registro: ' . $e->getMessage();
        }

        header('Location: ' . BASE_URL . 'signosvitales');
        exit;
    }

    /**
     * API: Obtiene signos vitales de un paciente (AJAX)
     */
    public function apiPaciente($params = [])
    {
        header('Content-Type: application/json');

        $idPaciente = isset($params[0]) ? (int)$params[0] : 0;

        if ($idPaciente <= 0) {
            echo json_encode([
                'success' => false,
                'message' => 'ID de paciente no válido'
            ]);
            exit;
        }

        $signosVitales = $this->signosVitales->getByPaciente($idPaciente);

        echo json_encode([
            'success' => true,
            'data' => $signosVitales
        ]);
        exit;
    }
}
