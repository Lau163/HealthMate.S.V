<?php
class Servicios extends ControllerBase
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel("servicios");
    }

    function render(){
        $this->view->render('paciente/servicios');
    }

    /**
     * Registra un signo vital desde AJAX
     */
    public function registrarSignoVital() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
            return;
        }

        try {
            // Obtener datos del POST
            $tipo = $_POST['tipo'] ?? '';
            $valor = $_POST['valor'] ?? '';
            $observaciones = $_POST['observaciones'] ?? null;

            // Validar datos requeridos
            if (empty($tipo) || empty($valor)) {
                echo json_encode(['status' => 'error', 'message' => 'Tipo y valor son requeridos']);
                return;
            }

            // Obtener ID del paciente de la sesión
            if (!isset($_SESSION['usuario_id'])) {
                echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
                return;
            }

            $idPaciente = $_SESSION['usuario_id'];
            // Usar el modelo para registrar el signo vital
            $resultado = $this->models['servicios']->registrarSignoVital($idPaciente, $tipo, $valor, $observaciones);

            if ($resultado) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Signo vital registrado correctamente',
                    'id_registro' => $resultado
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al registrar el signo vital']);
            }

        } catch (Exception $e) {
            error_log("Error en registrarSignoVital: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Error interno del servidor']);
        }
    }

    /**
     * Registra múltiples signos vitales
     */
    public function registrarMultiplesSignosVitales() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
            return;
        }

        try {
            $datosSignos = $_POST['signos_vitales'] ?? [];

            if (empty($datosSignos)) {
                echo json_encode(['status' => 'error', 'message' => 'No se recibieron datos de signos vitales']);
                return;
            }

            // Obtener ID del paciente de la sesión
            if (!isset($_SESSION['usuario_id'])) {
                echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
                return;
            }

            $idPaciente = $_SESSION['usuario_id'];
            $resultados = $this->models['servicios']->registrarSignosVitalesMultiples($idPaciente, $datosSignos);

            echo json_encode([
                'status' => 'success',
                'message' => 'Signos vitales registrados correctamente',
                'resultados' => $resultados
            ]);

        } catch (Exception $e) {
            error_log("Error en registrarMultiplesSignosVitales: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Error interno del servidor']);
        }
    }

    /**
     * Obtiene el historial de signos vitales del paciente
     */
    public function getHistorial() {
        try {
            // Obtener ID del paciente de la sesión
            if (!isset($_SESSION['usuario_id'])) {
                echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
                return;
            }

            $idPaciente = $_SESSION['usuario_id'];
            $historial = $this->models['servicios']->getHistorialPaciente($idPaciente);

            echo json_encode([
                'status' => 'success',
                'data' => $historial
            ]);

        } catch (Exception $e) {
            error_log("Error en getHistorial: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Error interno del servidor']);
        }
    }

    /**
     * Obtiene estadísticas de signos vitales del paciente
     */
    public function getEstadisticas() {
        try {
            $dias = $_GET['dias'] ?? 30;

            // Obtener ID del paciente de la sesión
            if (!isset($_SESSION['usuario_id'])) {
                echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
                return;
            }

            $idPaciente = $_SESSION['usuario_id'];
            $estadisticas = $this->models['servicios']->getEstadisticasPaciente($idPaciente, $dias);

            echo json_encode([
                'status' => 'success',
                'data' => $estadisticas
            ]);

        } catch (Exception $e) {
            error_log("Error en getEstadisticas: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Error interno del servidor']);
        }
    }

    /**
     * Método para registrar signos vitales específicos por tipo
     * Este método maneja las peticiones desde el modal de cada servicio
     */
    public function registrarPorTipo() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
            return;
        }

        try {
            $tipo = $_POST['tipo'] ?? '';
            $valor = $_POST['valor'] ?? '';
            $observaciones = $_POST['observaciones'] ?? null;

            // Validar datos
            if (empty($tipo) || empty($valor)) {
                echo json_encode(['status' => 'error', 'message' => 'Tipo y valor son requeridos']);
                return;
            }

            // Obtener ID del paciente de la sesión
            if (!isset($_SESSION['usuario_id'])) {
                echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
                return;
            }

            $idPaciente = $_SESSION['usuario_id'];
            // Mapear tipos de signos vitales a campos de base de datos
            $tipoMapping = [
                'temperatura' => 'temperatura',
                'saturacion' => 'saturacion_oxigeno',
                'frecuencia' => 'frecuencia_cardiaca',
                'presion' => 'presion_sistolica', // Solo sistólica por simplicidad, se puede mejorar
                'respiratoria' => 'frecuencia_respiratoria',
                'pulso' => 'frecuencia_cardiaca'
            ];

            // Si es presión arterial, necesitamos manejar sistólica y diastólica por separado
            if ($tipo === 'presion') {
                $sistolica = $_POST['sistolica'] ?? '';
                $diastolica = $_POST['diastolica'] ?? '';

                if (empty($sistolica) || empty($diastolica)) {
                    echo json_encode(['status' => 'error', 'message' => 'Presión sistólica y diastólica son requeridas']);
                    return;
                }

                // Registrar presión sistólica
                $this->models['servicios']->registrarSignoVital($idPaciente, 'presion_sistolica', $sistolica, $observaciones);
                // Registrar presión diastólica
                $this->models['servicios']->registrarSignoVital($idPaciente, 'presion_diastolica', $diastolica, $observaciones);

                echo json_encode(['status' => 'success', 'message' => 'Presión arterial registrada correctamente']);
                return;
            }

            // Para otros tipos, usar el mapeo directo
            $campoDB = $tipoMapping[$tipo] ?? $tipo;
            $resultado = $this->models['servicios']->registrarSignoVital($idPaciente, $campoDB, $valor, $observaciones);

            if ($resultado) {
                echo json_encode(['status' => 'success', 'message' => 'Signo vital registrado correctamente']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al registrar el signo vital']);
            }

        } catch (Exception $e) {
            error_log("Error en registrarPorTipo: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Error interno del servidor']);
        }
    }
}
