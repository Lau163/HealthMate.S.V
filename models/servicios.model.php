<?php

/**
 * Modelo para manejar los servicios de signos vitales
 * Maneja operaciones CRUD para registros de signos vitales
 */
class ServiciosModel extends ModelBase
{
    private $table = 'signos_vitales';

    /**
     * Constructor del modelo
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Registra un signo vital específico
     */
    public function registrarSignoVital($idPaciente, $tipo, $valor, $observaciones = null)
    {
        try {
            // Validar el tipo de signo vital
            $tiposValidos = [
                'frecuencia_cardiaca' => 'frecuencia_cardiaca',
                'frecuencia_respiratoria' => 'frecuencia_respiratoria',
                'temperatura' => 'temperatura',
                'presion_sistolica' => 'presion_sistolica',
                'presion_diastolica' => 'presion_diastolica',
                'saturacion_oxigeno' => 'saturacion_oxigeno',
                'pulso' => 'frecuencia_cardiaca' // El pulso usa el mismo campo que frecuencia cardíaca
            ];

            if (!array_key_exists($tipo, $tiposValidos)) {
                throw new Exception("Tipo de signo vital inválido: $tipo");
            }

            // Preparar los datos para insertar
            $campoReal = $tiposValidos[$tipo];
            $datos = [
                'id_paciente' => $idPaciente,
                'fecha_registro' => date('Y-m-d H:i:s'),
                $campoReal => $valor,
                'observaciones' => $observaciones
            ];

            // Crear una instancia del modelo de signos vitales y usar su método insert
            $signosVitalesModel = new SignosVitalesModel();
            $idRegistro = $signosVitalesModel->insert($datos);

            if ($idRegistro) {
                return $idRegistro;
            } else {
                throw new Exception("Error al insertar el registro en la base de datos");
            }

        } catch (Exception $e) {
            error_log("Error en registrarSignoVital: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Registra múltiples signos vitales a la vez
     */
    public function registrarSignosVitalesMultiples($idPaciente, $datosSignos)
    {
        try {
            $resultados = [];

            foreach ($datosSignos as $tipo => $datos) {
                $valor = $datos['valor'];
                $observaciones = $datos['observaciones'] ?? null;

                $idRegistro = $this->registrarSignoVital($idPaciente, $tipo, $valor, $observaciones);
                $resultados[$tipo] = $idRegistro;
            }

            return $resultados;
        } catch (Exception $e) {
            error_log("Error en registrarSignosVitalesMultiples: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Obtiene el historial de signos vitales de un paciente
     */
    public function getHistorialPaciente($idPaciente)
    {
        try {
            $signosVitalesModel = new SignosVitalesModel();
            return $signosVitalesModel->getByPaciente($idPaciente);
        } catch (Exception $e) {
            error_log("Error en getHistorialPaciente: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtiene estadísticas de signos vitales de un paciente
     */
    public function getEstadisticasPaciente($idPaciente, $dias = 30)
    {
        try {
            $signosVitalesModel = new SignosVitalesModel();
            return $signosVitalesModel->getEstadisticasPaciente($idPaciente, $dias);
        } catch (Exception $e) {
            error_log("Error en getEstadisticasPaciente: " . $e->getMessage());
            return null;
        }
    }
}
