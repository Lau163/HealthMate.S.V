<?php
// models/usuario.model.php

require_once __DIR__ . '/../app/model.base.php';

class Usuario extends BaseModel {
    protected $table = 'usuarios';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function buscarPorEmail($email) {
        $query = "SELECT u.*, r.Nombre_Rol as Rol 
                 FROM {$this->table} u
                 JOIN roles r ON u.Id_Rol = r.Id_Rol
                 WHERE u.Email = :email";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function crearSesion($usuario) {
        $_SESSION['usuario_id'] = $usuario['Id_Usuario'];
        $_SESSION['usuario_nombre'] = $usuario['Nombre'];
        $_SESSION['usuario_rol'] = $usuario['Rol'];
        $_SESSION['usuario_email'] = $usuario['Email'];
        
        // Actualizar último acceso
        $this->actualizarUltimoAcceso($usuario['Id_Usuario']);
    }
    
    private function actualizarUltimoAcceso($usuarioId) {
        $query = "UPDATE {$this->table} SET Ultimo_Acceso = NOW() WHERE Id_Usuario = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $usuarioId);
        $stmt->execute();
    }
    
    public function verificarCredenciales($email, $password) {
        $usuario = $this->buscarPorEmail($email);
        
        if ($usuario && password_verify($password, $usuario['Password'])) {
            if ($usuario['Activo'] == 1) {
                return $usuario;
            }
            throw new Exception('Tu cuenta está desactivada. Por favor, contacta al administrador.');
        }
        
        return false;
    }
}