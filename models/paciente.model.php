<?php

/**
 *
 */
if (!class_exists('PacienteModel')):
class PacienteModel extends ModelBase
{

    public function __construct()
    {
        parent::__construct();
    }

    public function deleteById($id)
    {
        $stmt = $this->con->pdo->prepare("DELETE FROM usuarios WHERE Id_Usuario = :id");
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Inserta un nuevo paciente en la tabla usuarios con el rol 'paciente'.
     * Acepta datos flexibles provenientes de formularios de Doctor/Enfermerx.
     */
    /**
     * Obtiene un paciente por su ID
     * @param int $id ID del paciente
     * @return array|false Datos del paciente o false si no se encuentra
     */
    public function getById($id) {
        $query = "SELECT * FROM usuarios WHERE Id_Usuario = :id";
        $stmt = $this->con->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Actualiza los datos de un paciente
     * @param int $id ID del paciente a actualizar
     * @param array $datos Datos a actualizar
     * @return bool True si la actualización fue exitosa, false en caso contrario
     */
    public function actualizar($id, $datos) {
        // Construir la consulta dinámicamente
        $campos = [];
        $valores = [':id' => $id];
        
        foreach ($datos as $campo => $valor) {
            // Solo actualizar campos permitidos
            if (in_array($campo, ['Nombre', 'Email', 'Edad', 'Sexo', 'Tipo_sangre', 'Peso', 'Altura', 'Alergias', 'Enfermedades'])) {
                $campos[] = "$campo = :$campo";
                $valores[":$campo"] = $valor !== '' ? $valor : null;
            }
        }
        
        if (empty($campos)) {
            return false; // No hay campos para actualizar
        }
        
        $query = "UPDATE usuarios SET " . implode(', ', $campos) . " WHERE Id_Usuario = :id";
        $stmt = $this->con->pdo->prepare($query);
        
        try {
            return $stmt->execute($valores);
        } catch (PDOException $e) {
            error_log("Error al actualizar paciente: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtiene todos los pacientes de la base de datos
     * @return array Lista de pacientes
     */
    public function getAll() {
        $query = "SELECT u.*, r.Nombre_Rol as Rol 
                 FROM usuarios u 
                 INNER JOIN roles r ON u.Id_Rol = r.Id_Rol 
                 WHERE LOWER(r.Nombre_Rol) = 'paciente' 
                 ORDER BY u.Nombre ASC";
        
        $stmt = $this->con->pdo->prepare($query);
        $stmt->execute();
        
        // Depuración: Verificar resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        error_log("Consulta SQL ejecutada: " . $query);
        error_log("Número de pacientes encontrados: " . count($resultados));
        
        return $resultados;
    }

    public function insert($datos)
    {
        // Resolver Id_Rol para 'paciente'
        $stmtRol = $this->con->pdo->prepare("SELECT Id_Rol FROM roles WHERE LOWER(Nombre_Rol) = 'paciente' LIMIT 1");
        $stmtRol->execute();
        $rol = $stmtRol->fetch(PDO::FETCH_ASSOC);
        if (!$rol || empty($rol['Id_Rol'])) {
            throw new Exception("No se encontró el rol 'paciente'");
        }
        $idRolPaciente = (int)$rol['Id_Rol'];

        // Mapear entradas comunes de formularios a columnas de usuarios
        $nombres = trim(($datos['nombres'] ?? '') . ' ' . ($datos['apellidos'] ?? ''));
        $nombre = $datos['Nombre'] ?? ($datos['nombre'] ?? ($nombres ?: null));
        $email = $datos['Email'] ?? ($datos['email'] ?? null);
        $sexo = $datos['Sexo'] ?? ($datos['genero'] ?? null);
        $peso = $datos['Peso'] ?? ($datos['peso'] ?? null);
        $altura = $datos['Altura'] ?? ($datos['altura'] ?? null);
        $tipoSangre = $datos['Tipo_sangre'] ?? ($datos['tipo_sangre'] ?? null);
        $alergias = $datos['Alergias'] ?? ($datos['alergias'] ?? null);
        $enfermedades = $datos['Enfermedades'] ?? ($datos['enfermedades'] ?? ($datos['enfermedades_cronicas'] ?? null));

        // Calcular edad si se proporciona fecha_nacimiento
        $edad = $datos['Edad'] ?? ($datos['edad'] ?? null);
        if (!$edad && !empty($datos['fecha_nacimiento'])) {
            try {
                $fn = new DateTime($datos['fecha_nacimiento']);
                $hoy = new DateTime('today');
                $edad = (int)$fn->diff($hoy)->y;
            } catch (Throwable $e) {
                $edad = null;
            }
        }

        $sql = "INSERT INTO usuarios (Nombre, Email, Edad, Sexo, Peso, Altura, Tipo_sangre, Alergias, Enfermedades, Id_Rol)
                VALUES (:Nombre, :Email, :Edad, :Sexo, :Peso, :Altura, :Tipo_sangre, :Alergias, :Enfermedades, :Id_Rol)";
        $stmt = $this->con->pdo->prepare($sql);
        $ok = $stmt->execute([
            ':Nombre' => $nombre,
            ':Email' => $email,
            ':Edad' => $edad,
            ':Sexo' => $sexo,
            ':Peso' => $peso,
            ':Altura' => $altura,
            ':Tipo_sangre' => $tipoSangre,
            ':Alergias' => $alergias,
            ':Enfermedades' => $enfermedades,
            ':Id_Rol' => $idRolPaciente,
        ]);
        if (!$ok) return false;
        return (int)$this->con->pdo->lastInsertId();
    }
    
}
endif;
