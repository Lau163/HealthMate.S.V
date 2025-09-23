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
  
  /**
   * Obtiene todos los pacientes a partir de la tabla usuarios con rol 'paciente'.
   */
  public function getAll()
  {
      $sql = "SELECT u.Id_Usuario,
                     u.Nombre,
                     u.Email,
                     u.Edad,
                     u.Sexo,
                     u.Peso,
                     u.Altura,
                     u.Tipo_sangre,
                     u.Alergias,
                     u.Enfermedades,
                     r.Nombre_Rol AS Rol
              FROM usuarios u
              INNER JOIN roles r ON r.Id_Rol = u.Id_Rol
              WHERE LOWER(r.Nombre_Rol) = 'paciente'";
      $stmt = $this->con->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Obtiene un paciente por Id_Usuario si su rol es paciente.
   */
  public function getById($id)
  {
      $sql = "SELECT u.Id_Usuario,
                     u.Nombre,
                     u.Email,
                     u.Edad,
                     u.Sexo,
                     u.Peso,
                     u.Altura,
                     u.Tipo_sangre,
                     u.Alergias,
                     u.Enfermedades,
                     r.Nombre_Rol AS Rol
              FROM usuarios u
              INNER JOIN roles r ON r.Id_Rol = u.Id_Rol
              WHERE u.Id_Usuario = :id AND LOWER(r.Nombre_Rol) = 'paciente'";
      $stmt = $this->con->pdo->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Actualiza un paciente (registro en usuarios) por Id_Usuario.
   */
  public function updateById($id, $datos)
  {
      $sql = "UPDATE usuarios SET 
                Nombre = :Nombre,
                Email = :Email,
                Edad = :Edad,
                Sexo = :Sexo,
                Peso = :Peso,
                Altura = :Altura,
                Tipo_sangre = :Tipo_sangre,
                Alergias = :Alergias,
                Enfermedades = :Enfermedades
              WHERE Id_Usuario = :Id_Usuario";
      $stmt = $this->con->pdo->prepare($sql);
      return $stmt->execute([
          ':Nombre' => $datos['Nombre'] ?? null,
          ':Email' => $datos['Email'] ?? null,
          ':Edad' => $datos['Edad'] ?? null,
          ':Sexo' => $datos['Sexo'] ?? null,
          ':Peso' => $datos['Peso'] ?? null,
          ':Altura' => $datos['Altura'] ?? null,
          ':Tipo_sangre' => $datos['Tipo_sangre'] ?? null,
          ':Alergias' => $datos['Alergias'] ?? null,
          ':Enfermedades' => $datos['Enfermedades'] ?? null,
          ':Id_Usuario' => $id,
      ]);
  }

  /**
   * Elimina (hard delete) un paciente por Id_Usuario.
   */
  public function deleteById($id)
  {
      $stmt = $this->con->pdo->prepare("DELETE FROM usuarios WHERE Id_Usuario = :id");
      return $stmt->execute([':id' => $id]);
  }
}
endif;
