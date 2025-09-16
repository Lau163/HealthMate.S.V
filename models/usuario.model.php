<?php
// models/usuario.model.php

require_once __DIR__ . '/../app/model.base.php';

class Usuario extends BaseModel {
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
        
        $stmt = $this->db->prepare($query);
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
     * Actualiza el último acceso del usuario
     */
    public function actualizarUltimoAcceso($usuarioId) {
        $query = "UPDATE {$this->table} SET Ultimo_Acceso = NOW() WHERE Id_Usuario = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $usuarioId]);
    }
    
    /**
     * Crea la sesión del usuario
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
    
    /**
     * Actualiza la fecha de último acceso del usuario
     */
    private function actualizarUltimoAcceso($usuarioId) {
        $query = "UPDATE {$this->table} SET Ultimo_Acceso = NOW() WHERE Id_Usuario = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $usuarioId);
        return $stmt->execute();
    }
    
    /**
     * Verifica las credenciales del usuario
     */
    public function verificarCredenciales($email, $password) {
        $usuario = $this->buscarPorEmail($email);
        
        if ($usuario) {
            if (password_verify($password, $usuario['Password'])) {
                if ($usuario['Activo'] == 1) {
                    return $usuario;
                }
                throw new Exception('Tu cuenta está desactivada. Por favor, contacta al administrador.');
            }
        }
        
        // No revelar si el correo existe o no por seguridad
        throw new Exception('Credenciales incorrectas. Por favor, inténtalo de nuevo.');
    }
    
    /**
     * Crea un nuevo usuario
     */
    public function crearUsuario($datos) {
        // Validar que el email no exista
        $existente = $this->buscarPorEmail($datos['email']);
        if ($existente) {
            throw new Exception('El correo electrónico ya está registrado.');
        }
        
        // Hashear la contraseña
        $hashedPassword = password_hash($datos['password'], PASSWORD_DEFAULT);
        
        $query = "INSERT INTO {$this->table} (Nombre, Email, Password, Id_Rol, Activo, Fecha_Creacion) 
                 VALUES (:nombre, :email, :password, :id_rol, 1, NOW())";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id_rol', $datos['id_rol'], PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        
        throw new Exception('Error al crear el usuario. Por favor, inténtalo de nuevo.');
    }
    
    /**
     * Obtiene un usuario por su ID
     */
    public function obtenerPorId($id) {
        $query = "SELECT u.*, r.Nombre_Rol as Rol 
                 FROM {$this->table} u
                 JOIN roles r ON u.Id_Rol = r.Id_Rol
                 WHERE u.Id_Usuario = :id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Métodos existentes...
    
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
     * Actualiza el último acceso del usuario
     */
    public function actualizarUltimoAcceso($usuarioId) {
        $query = "UPDATE {$this->table} SET Ultimo_Acceso = NOW() WHERE Id_Usuario = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $usuarioId]);
    }
}