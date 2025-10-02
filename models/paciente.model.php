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
        $nombre = $datos['Nombre'] ?? ($nombres ?: null);
        $email = $datos['Email'] ?? ($datos['email'] ?? null);
        $sexo = $datos['Sexo'] ?? ($datos['genero'] ?? null);
        $peso = $datos['Peso'] ?? null;
        $altura = $datos['Altura'] ?? null;
        $tipoSangre = $datos['Tipo_sangre'] ?? ($datos['tipo_sangre'] ?? null);
        $alergias = $datos['Alergias'] ?? ($datos['alergias'] ?? null);
        $enfermedades = $datos['Enfermedades'] ?? ($datos['enfermedades'] ?? ($datos['enfermedades_cronicas'] ?? null));

        // Calcular edad si se proporciona fecha_nacimiento
        $edad = $datos['Edad'] ?? null;
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
