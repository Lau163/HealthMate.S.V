<?php
/**
 * Modelo para manejar los signos vitales de los pacientes
 * Maneja operaciones CRUD para la tabla signos_vitales
 */

class SignosVitalesModel extends ModelBase
{
    private $table = 'signos_vitales';

    /**
     * Constructor del modelo
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = 'signos_vitales';
    }

    /**
     * Obtiene todos los signos vitales con información del paciente
     */
    public function getAll()
    {
        try {
            $query = "SELECT sv.*,
                           u.Nombre as nombre_paciente,
                           u.Email as email_paciente
                    FROM {$this->table} sv
                    INNER JOIN usuarios u ON sv.id_paciente = u.Id_Usuario
                    ORDER BY sv.fecha_registro DESC";

            $stmt = $this->con->pdo->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener signos vitales: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtiene signos vitales por ID de paciente
     */
    public function getByPaciente($idPaciente)
    {
        try {
            $query = "SELECT sv.*,
                           u.Nombre as nombre_paciente,
                           u.Email as email_paciente
                    FROM {$this->table} sv
                    INNER JOIN usuarios u ON sv.id_paciente = u.Id_Usuario
                    WHERE sv.id_paciente = :id_paciente
                    ORDER BY sv.fecha_registro DESC";

            $stmt = $this->con->pdo->prepare($query);
            $stmt->bindParam(':id_paciente', $idPaciente, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener signos vitales del paciente: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtiene un registro específico por su ID
     */
    public function getById($idRegistro)
    {
        try {
            $query = "SELECT sv.*,
                           u.Nombre as nombre_paciente,
                           u.Email as email_paciente
                    FROM {$this->table} sv
                    INNER JOIN usuarios u ON sv.id_paciente = u.Id_Usuario
                    WHERE sv.id_registro = :id_registro";

            $stmt = $this->con->pdo->prepare($query);
            $stmt->bindParam(':id_registro', $idRegistro, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener registro de signos vitales: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Inserta un nuevo registro de signos vitales
     */
    public function insert($datos)
    {
        try {
            $query = "INSERT INTO {$this->table} (
                        id_paciente, fecha_registro, frecuencia_cardiaca,
                        frecuencia_respiratoria, temperatura, presion_sistolica,
                        presion_diastolica, saturacion_oxigeno, observaciones
                    ) VALUES (
                        :id_paciente, :fecha_registro, :frecuencia_cardiaca,
                        :frecuencia_respiratoria, :temperatura, :presion_sistolica,
                        :presion_diastolica, :saturacion_oxigeno, :observaciones
                    )";

            $stmt = $this->con->pdo->prepare($query);

            $params = [
                ':id_paciente' => $datos['id_paciente'],
                ':fecha_registro' => $datos['fecha_registro'] ?? date('Y-m-d H:i:s'),
                ':frecuencia_cardiaca' => $datos['frecuencia_cardiaca'] ?? null,
                ':frecuencia_respiratoria' => $datos['frecuencia_respiratoria'] ?? null,
                ':temperatura' => $datos['temperatura'] ?? null,
                ':presion_sistolica' => $datos['presion_sistolica'] ?? null,
                ':presion_diastolica' => $datos['presion_diastolica'] ?? null,
                ':saturacion_oxigeno' => $datos['saturacion_oxigeno'] ?? null,
                ':observaciones' => $datos['observaciones'] ?? null
            ];

            $stmt->execute($params);

            return $this->con->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error al insertar signos vitales: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Actualiza un registro existente
     */
    public function update($idRegistro, $datos)
    {
        try {
            $query = "UPDATE {$this->table} SET
                        frecuencia_cardiaca = :frecuencia_cardiaca,
                        frecuencia_respiratoria = :frecuencia_respiratoria,
                        temperatura = :temperatura,
                        presion_sistolica = :presion_sistolica,
                        presion_diastolica = :presion_diastolica,
                        saturacion_oxigeno = :saturacion_oxigeno,
                        observaciones = :observaciones,
                        updated_at = CURRENT_TIMESTAMP
                    WHERE id_registro = :id_registro";

            $stmt = $this->con->pdo->prepare($query);

            $params = [
                ':id_registro' => $idRegistro,
                ':frecuencia_cardiaca' => $datos['frecuencia_cardiaca'] ?? null,
                ':frecuencia_respiratoria' => $datos['frecuencia_respiratoria'] ?? null,
                ':temperatura' => $datos['temperatura'] ?? null,
                ':presion_sistolica' => $datos['presion_sistolica'] ?? null,
                ':presion_diastolica' => $datos['presion_diastolica'] ?? null,
                ':saturacion_oxigeno' => $datos['saturacion_oxigeno'] ?? null,
                ':observaciones' => $datos['observaciones'] ?? null
            ];

            $stmt->execute($params);

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error al actualizar signos vitales: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Elimina un registro por su ID
     */
    public function delete($idRegistro)
    {
        try {
            $query = "DELETE FROM {$this->table} WHERE id_registro = :id_registro";
            $stmt = $this->con->pdo->prepare($query);
            $stmt->bindParam(':id_registro', $idRegistro, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error al eliminar signos vitales: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtiene estadísticas de signos vitales por paciente
     */
    public function getEstadisticasPaciente($idPaciente, $dias = 30)
    {
        try {
            $query = "SELECT
                        COUNT(*) as total_registros,
                        AVG(frecuencia_cardiaca) as avg_frecuencia_cardiaca,
                        AVG(frecuencia_respiratoria) as avg_frecuencia_respiratoria,
                        AVG(temperatura) as avg_temperatura,
                        AVG(presion_sistolica) as avg_presion_sistolica,
                        AVG(presion_diastolica) as avg_presion_diastolica,
                        AVG(saturacion_oxigeno) as avg_saturacion_oxigeno,
                        MIN(fecha_registro) as primera_fecha,
                        MAX(fecha_registro) as ultima_fecha
                    FROM {$this->table}
                    WHERE id_paciente = :id_paciente
                    AND fecha_registro >= DATE_SUB(NOW(), INTERVAL :dias DAY)";

            $stmt = $this->con->pdo->prepare($query);
            $stmt->bindParam(':id_paciente', $idPaciente, PDO::PARAM_INT);
            $stmt->bindParam(':dias', $dias, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener estadísticas: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Obtiene signos vitales en un rango de fechas
     */
    public function getByFecha($fechaInicio, $fechaFin = null, $idPaciente = null)
    {
        try {
            $query = "SELECT sv.*,
                           u.Nombre as nombre_paciente,
                           u.Email as email_paciente
                    FROM {$this->table} sv
                    INNER JOIN usuarios u ON sv.id_paciente = u.Id_Usuario
                    WHERE sv.fecha_registro >= :fecha_inicio";

            $params = [':fecha_inicio' => $fechaInicio];

            if ($fechaFin) {
                $query .= " AND sv.fecha_registro <= :fecha_fin";
                $params[':fecha_fin'] = $fechaFin;
            }

            if ($idPaciente) {
                $query .= " AND sv.id_paciente = :id_paciente";
                $params[':id_paciente'] = $idPaciente;
            }

            $query .= " ORDER BY sv.fecha_registro DESC";

            $stmt = $this->con->pdo->prepare($query);
            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener signos vitales por fecha: " . $e->getMessage());
            return [];
        }
    }
}
?>
