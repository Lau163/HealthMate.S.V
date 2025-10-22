<?php
/**
 * Controlador para manejar los signos vitales de los pacientes
 * Gestiona las operaciones CRUD para signos vitales
 */

class SignosVitales extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
        $this->signosVitales = $this->loadModel('signos_vitales');
        $this->paciente = $this->loadModel('paciente');

        if (!$this->signosVitales) {
            error_log("Error: No se pudo cargar el modelo de signos vitales");
        }
        if (!$this->paciente) {
            error_log("Error: No se pudo cargar el modelo de paciente");
        }
    }

    /**
     * Método por defecto - muestra la lista de signos vitales
     */
    public function render()
    {
        // Verificar que sea una petición GET
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Location: ' . BASE_URL . 'dashboard');
            exit;
        }

        // Obtener filtros si existen
        $idPaciente = isset($_GET['paciente']) ? (int)$_GET['paciente'] : null;
        $fechaInicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : null;
        $fechaFin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : null;

        $signosVitales = [];

        if ($idPaciente) {
            $signosVitales = $this->signosVitales->getByPaciente($idPaciente);
        } elseif ($fechaInicio) {
            $signosVitales = $this->signosVitales->getByFecha($fechaInicio, $fechaFin, $idPaciente);
        } else {
            $signosVitales = $this->signosVitales->getAll();
        }

        // Obtener lista de pacientes para el filtro
        $pacientes = $this->paciente->getAll();

        $this->view->set('signos_vitales', $signosVitales);
        $this->view->set('pacientes', $pacientes);
        $this->view->set('filtros', [
            'id_paciente' => $idPaciente,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin
        ]);

        $this->view->render('signos_vitales/index');
    }

    /**
     * Guarda nuevos signos vitales
     */
    public function guardar()
    {
        // Verificar que sea una petición AJAX
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                 strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validar token CSRF
                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
                    throw new Exception('Token CSRF inválido');
                }

                // Obtener y validar datos
                $datos = [
                    'id_paciente' => !empty($_POST['id_paciente']) ? (int)$_POST['id_paciente'] : null,
                    'fecha_registro' => !empty($_POST['fecha_registro']) ? $_POST['fecha_registro'] : date('Y-m-d H:i:s'),
                    'frecuencia_cardiaca' => !empty($_POST['frecuencia_cardiaca']) ? (int)$_POST['frecuencia_cardiaca'] : null,
                    'frecuencia_respiratoria' => !empty($_POST['frecuencia_respiratoria']) ? (int)$_POST['frecuencia_respiratoria'] : null,
                    'temperatura' => !empty($_POST['temperatura']) ? (float)$_POST['temperatura'] : null,
                    'presion_sistolica' => !empty($_POST['presion_sistolica']) ? (int)$_POST['presion_sistolica'] : null,
                    'presion_diastolica' => !empty($_POST['presion_diastolica']) ? (int)$_POST['presion_diastolica'] : null,
                    'saturacion_oxigeno' => !empty($_POST['saturacion_oxigeno']) ? (int)$_POST['saturacion_oxigeno'] : null,
                    'observaciones' => trim($_POST['observaciones'] ?? '')
                ];

                // Validaciones básicas
                if (!$datos['id_paciente']) {
                    throw new Exception('Debe seleccionar un paciente');
                }

                // Verificar que el paciente existe
                $paciente = $this->paciente->getById($datos['id_paciente']);
                if (!$paciente) {
                    throw new Exception('El paciente seleccionado no existe');
                }

                // Insertar signos vitales
                $idRegistro = $this->signosVitales->insert($datos);

                if ($idRegistro) {
                    $response = [
                        'success' => true,
                        'message' => 'Signos vitales registrados correctamente',
                        'id_registro' => $idRegistro
                    ];
                } else {
                    throw new Exception('Error al guardar los signos vitales');
                }

            } catch (Exception $e) {
                $response = [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }

            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                if (isset($response['success']) && $response['success']) {
                    $_SESSION['success'] = $response['message'];
                } else {
                    $_SESSION['error'] = $response['message'];
                }
                header('Location: ' . BASE_URL . 'signos-vitales');
            }
            exit;
        } else {
            $response = [
                'success' => false,
                'message' => 'Método no permitido'
            ];

            if ($isAjax) {
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode($response);
            } else {
                header('Location: ' . BASE_URL . 'signos-vitales');
            }
            exit;
        }
    }

    /**
     * Muestra detalles de un registro específico
     */
    public function ver($params = [])
    {
        $idRegistro = isset($params[0]) ? (int)$params[0] : 0;

        if ($idRegistro <= 0) {
            $_SESSION['error'] = 'ID de registro no válido';
            header('Location: ' . BASE_URL . 'signos-vitales');
            exit;
        }

        $registro = $this->signosVitales->getById($idRegistro);

        if (!$registro) {
            $_SESSION['error'] = 'Registro no encontrado';
            header('Location: ' . BASE_URL . 'signos-vitales');
            exit;
        }

        $this->view->set('registro', $registro);
        $this->view->render('signos_vitales/ver');
    }

    /**
     * Muestra formulario de edición
     */
    public function editar($params = [])
    {
        $idRegistro = isset($params[0]) ? (int)$params[0] : 0;

        if ($idRegistro <= 0) {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'ID de registro no válido']);
                exit;
            } else {
                $_SESSION['error'] = 'ID de registro no válido';
                header('Location: ' . BASE_URL . 'signos-vitales');
                exit;
            }
        }

        $registro = $this->signosVitales->getById($idRegistro);

        if (!$registro) {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Registro no encontrado']);
                exit;
            } else {
                $_SESSION['error'] = 'Registro no encontrado';
                header('Location: ' . BASE_URL . 'signos-vitales');
                exit;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->actualizar($idRegistro);
            return;
        }

        // Obtener lista de pacientes para el formulario
        $pacientes = $this->paciente->getAll();

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'data' => $registro,
                'pacientes' => $pacientes
            ]);
            exit;
        } else {
            $this->view->set('registro', $registro);
            $this->view->set('pacientes', $pacientes);
            $this->view->render('signos_vitales/editar');
        }
    }

    /**
     * Actualiza un registro existente
     */
    private function actualizar($idRegistro)
    {
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                 strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

        try {
            $datos = [
                'frecuencia_cardiaca' => !empty($_POST['frecuencia_cardiaca']) ? (int)$_POST['frecuencia_cardiaca'] : null,
                'frecuencia_respiratoria' => !empty($_POST['frecuencia_respiratoria']) ? (int)$_POST['frecuencia_respiratoria'] : null,
                'temperatura' => !empty($_POST['temperatura']) ? (float)$_POST['temperatura'] : null,
                'presion_sistolica' => !empty($_POST['presion_sistolica']) ? (int)$_POST['presion_sistolica'] : null,
                'presion_diastolica' => !empty($_POST['presion_diastolica']) ? (int)$_POST['presion_diastolica'] : null,
                'saturacion_oxigeno' => !empty($_POST['saturacion_oxigeno']) ? (int)$_POST['saturacion_oxigeno'] : null,
                'observaciones' => trim($_POST['observaciones'] ?? '')
            ];

            $resultado = $this->signosVitales->update($idRegistro, $datos);

            if ($resultado) {
                $response = [
                    'success' => true,
                    'message' => 'Signos vitales actualizados correctamente'
                ];
            } else {
                throw new Exception('No se pudo actualizar el registro');
            }

        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            if (isset($response['success']) && $response['success']) {
                $_SESSION['success'] = $response['message'];
            } else {
                $_SESSION['error'] = $response['message'];
            }
            header('Location: ' . BASE_URL . 'signos-vitales');
        }
        exit;
    }

    /**
     * Elimina un registro
     */
    public function eliminar($params = [])
    {
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                 strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

        $idRegistro = isset($params[0]) ? (int)$params[0] : 0;

        if ($idRegistro <= 0) {
            $response = [
                'success' => false,
                'message' => 'ID de registro no válido'
            ];

            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $_SESSION['error'] = $response['message'];
                header('Location: ' . BASE_URL . 'signos-vitales');
            }
            exit;
        }

        try {
            $registro = $this->signosVitales->getById($idRegistro);

            if (!$registro) {
                throw new Exception('Registro no encontrado');
            }

            $resultado = $this->signosVitales->delete($idRegistro);

            if ($resultado) {
                $response = [
                    'success' => true,
                    'message' => 'Registro eliminado correctamente'
                ];
            } else {
                throw new Exception('No se pudo eliminar el registro');
            }

        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            if (isset($response['success']) && $response['success']) {
                $_SESSION['success'] = $response['message'];
            } else {
                $_SESSION['error'] = $response['message'];
            }
            header('Location: ' . BASE_URL . 'signos-vitales');
        }
        exit;
    }

    /**
     * Obtiene estadísticas de signos vitales por paciente
     */
    public function estadisticas($params = [])
    {
        $idPaciente = isset($params[0]) ? (int)$params[0] : 0;
        $dias = isset($_GET['dias']) ? (int)$_GET['dias'] : 30;

        if ($idPaciente <= 0) {
            $_SESSION['error'] = 'ID de paciente no válido';
            header('Location: ' . BASE_URL . 'signos-vitales');
            exit;
        }

        $estadisticas = $this->signosVitales->getEstadisticasPaciente($idPaciente, $dias);

        if (!$estadisticas) {
            $_SESSION['error'] = 'No se pudieron obtener estadísticas';
            header('Location: ' . BASE_URL . 'signos-vitales');
            exit;
        }

        $paciente = $this->paciente->getById($idPaciente);

        $this->view->set('estadisticas', $estadisticas);
        $this->view->set('paciente', $paciente);
        $this->view->set('dias', $dias);
        $this->view->render('signos_vitales/estadisticas');
    }
}
?>
