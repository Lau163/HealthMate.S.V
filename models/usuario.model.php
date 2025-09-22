<?php
// models/usuario.model.php

class UsuarioModel extends ModelBase {
    protected $table = 'usuarios';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Busca un usuario por su email con información del rol
     */
    public function buscarPorEmail($email) {
        $query = "SELECT u.*, r.Nombre_Rol as Rol 
                 FROM {$this->table} u
                 JOIN roles r ON u.Id_Rol = r.Id_Rol
                 WHERE u.Email = :email AND u.Activo = 1";
        
        $stmt = $this->con->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Verifica las credenciales del usuario
     */
    public function verificarCredenciales($email, $password) {
        $usuario = $this->buscarPorEmail($email);
        if ($usuario && password_verify($password, $usuario['Password'])) {
            return $usuario;
        }
        return false;
    }

    /**
     * Crea un nuevo usuario en la base de datos.
     */
    public function crear($datos) {
        $usuarioExistente = $this->buscarPorEmail($datos['Email']);
        if ($usuarioExistente) {
            throw new Exception('El correo electrónico ya está registrado.');
        }

        $datos['Password'] = password_hash($datos['Password'], PASSWORD_DEFAULT);

        $query = "INSERT INTO {$this->table} (Id_Rol, Nombre, Email, Password, Edad, Sexo, Peso, Altura, Tipo_sangre, Alergias, Enfermedades)
                  VALUES (:Id_Rol, :Nombre, :Email, :Password, :Edad, :Sexo, :Peso, :Altura, :Tipo_sangre, :Alergias, :Enfermedades)";
        
        $stmt = $this->con->pdo->prepare($query);

        try {
            $stmt->execute([
                ':Id_Rol' => $datos['Id_Rol'],
                ':Nombre' => $datos['Nombre'],
                ':Email' => $datos['Email'],
                ':Password' => $datos['Password'],
                ':Edad' => $datos['Edad'],
                ':Sexo' => $datos['Sexo'],
                ':Peso' => $datos['Peso'],
                ':Altura' => $datos['Altura'],
                ':Tipo_sangre' => $datos['Tipo_sangre'],
                ':Alergias' => $datos['Alergias'],
                ':Enfermedades' => $datos['Enfermedades']
            ]);
            return $this->con->pdo->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception('Error al registrar el usuario: ' . $e->getMessage());
        }
    }

    /**
     * Actualiza la fecha de último acceso del usuario.
     */
    public function actualizarUltimoAcceso($usuarioId) {
        $query = "UPDATE {$this->table} SET Ultimo_Acceso = NOW() WHERE Id_Usuario = :id";
        $stmt = $this->con->pdo->prepare($query);
        return $stmt->execute([':id' => $usuarioId]);
    }

    /**
     * Crea la sesión del usuario.
     */
    public function crearSesion($usuario) {
        $_SESSION['usuario_id'] = $usuario['Id_Usuario'];
        $_SESSION['usuario_nombre'] = $usuario['Nombre'];
        $_SESSION['usuario_rol'] = strtolower($usuario['Rol']); // Asegurar minúsculas
        $_SESSION['usuario_email'] = $usuario['Email'];
        $_SESSION['usuario_rol_id'] = $usuario['Id_Rol'];
        
        // Actualizar último acceso
        $this->actualizarUltimoAcceso($usuario['Id_Usuario']);
        
        // Regenerar ID de sesión para prevenir fijación de sesión
        session_regenerate_id(true);
    }
}