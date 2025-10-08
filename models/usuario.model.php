<?php
// models/usuario.model.php

class UsuarioModel extends ModelBase {
    protected $table = 'usuarios';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Busca un usuario por su correo electrónico con información del rol
     * @param string $email Correo electrónico a buscar
     * @param bool $conRol Si es true, incluye información del rol
     * @return array|false Datos del usuario o false si no se encuentra
     */
    public function buscarPorEmail($email, $conRol = false, $soloActivos = true) {
        try {
            $query = "SELECT u.*";
            
            if ($conRol) {
                $query .= ", r.Nombre_Rol as Rol 
                          FROM {$this->table} u
                          JOIN roles r ON u.Id_Rol = r.Id_Rol";
            } else {
                $query .= " FROM {$this->table} u";
            }
            
            $query .= " WHERE u.Email = :email";
            
            // Si solo se buscan usuarios activos, agregar la condición
            if ($soloActivos) {
                $query .= " AND u.Activo = 1";
            }
            
            $stmt = $this->con->pdo->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en UsuarioModel->buscarPorEmail(): " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Crea un nuevo registro en la base de datos
     * @param array $data Datos a insertar
     * @return int|bool ID del nuevo registro o false en caso de error
     */
    public function create($data) {
        try {
            // Filtrar los datos para incluir solo las columnas que existen en la tabla
            $columns = [];
            $placeholders = [];
            $values = [];
            
            // Obtener las columnas de la tabla
            $stmt = $this->con->pdo->query("DESCRIBE {$this->table}");
            $tableColumns = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            // Preparar los datos para la inserción
            foreach ($data as $key => $value) {
                if (in_array($key, $tableColumns)) {
                    $columns[] = $key;
                    $placeholders[] = ":$key";
                    $values[":$key"] = $value;
                }
            }
            
            if (empty($columns)) {
                throw new Exception("No se proporcionaron datos válidos para la inserción");
            }
            
            // Construir la consulta SQL
            $sql = "INSERT INTO {$this->table} (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";
            
            $stmt = $this->con->pdo->prepare($sql);
            
            // Ejecutar la consulta
            if ($stmt->execute($values)) {
                return $this->con->pdo->lastInsertId();
            }
            
            return false;
            
        } catch (PDOException $e) {
            error_log("Error en UsuarioModel->create(): " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Error en UsuarioModel->create(): " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Actualiza los datos de un usuario existente
     * @param int $id ID del usuario a actualizar
     * @param array $datos Datos a actualizar
     * @return bool|int ID del usuario actualizado o false en caso de error
     */
    public function actualizar($id, $datos) {
        try {
            // Obtener las columnas de la tabla
            $stmt = $this->con->pdo->query("DESCRIBE {$this->table}");
            $columnas = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            // Filtrar los datos para incluir solo las columnas que existen en la tabla
            $datosFiltrados = array_intersect_key($datos, array_flip($columnas));
            
            if (empty($datosFiltrados)) {
                return false;
            }
            
            // Construir la consulta SQL
            $setPart = [];
            $valores = [':id' => $id];
            
            foreach ($datosFiltrados as $campo => $valor) {
                // No actualizar el ID
                if ($campo === 'Id_Usuario') {
                    continue;
                }
                
                $param = ":$campo";
                $setPart[] = "`$campo` = $param";
                $valores[$param] = $valor;
            }
            
            if (empty($setPart)) {
                return false;
            }
            
            $query = "UPDATE {$this->table} SET " . implode(', ', $setPart) . " WHERE Id_Usuario = :id";
            
            $stmt = $this->con->pdo->prepare($query);
            $resultado = $stmt->execute($valores);
            
            return $resultado ? $id : false;
            
        } catch (PDOException $e) {
            error_log("Error en UsuarioModel->actualizar(): " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Verifica las credenciales del usuario
     */
    public function verificarCredenciales($email, $password) {
        // Buscar el usuario por email
        $usuario = $this->buscarPorEmail($email);
        
        // Si no se encuentra el usuario, retornar falso
        if (!$usuario) {
            error_log("Usuario no encontrado para el email: " . $email);
            return false;
        }
        
        // Verificar si la contraseña coincide
        $passwordMatch = password_verify($password, $usuario['Password']);
        
        // Depuración
        error_log("Verificando contraseña para: " . $email);
        error_log("Hash almacenado: " . $usuario['Password']);
        error_log("¿La contraseña coincide? " . ($passwordMatch ? 'Sí' : 'No'));
        
        // Si la contraseña no coincide, verificar si es la contraseña sin hashear (solo para depuración)
        if (!$passwordMatch && $password === $usuario['Password']) {
            error_log("ADVERTENCIA: La contraseña no está hasheada en la base de datos");
            // Hashear la contraseña y actualizarla en la base de datos
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->actualizarPassword($usuario['Id_Usuario'], $hashedPassword);
            $usuario['Password'] = $hashedPassword;
            $passwordMatch = true;
        }
        
        return $passwordMatch ? $usuario : false;
    }
    
    /**
     * Actualiza la contraseña de un usuario
     */
    private function actualizarPassword($usuarioId, $nuevoHash) {
        $query = "UPDATE {$this->table} SET Password = :password WHERE Id_Usuario = :id";
        $stmt = $this->con->pdo->prepare($query);
        return $stmt->execute([':password' => $nuevoHash, ':id' => $usuarioId]);
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
    
    /**
     * Obtiene todos los roles disponibles en el sistema
     */
    public function obtenerRolesDisponibles() {
        $query = "SELECT * FROM roles ORDER BY Id_Rol ASC";
        $stmt = $this->con->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Obtiene los roles asignados a un usuario específico
     * 
     * @param int $usuarioId ID del usuario
     * @return array Lista de roles del usuario
     */
    public function obtenerRolesPorUsuario($usuarioId) {
        $query = "SELECT r.* FROM roles r 
                 INNER JOIN usuarios u ON r.Id_Rol = u.Id_Rol 
                 WHERE u.Id_Usuario = :usuarioId";
        
        $stmt = $this->con->pdo->prepare($query);
        $stmt->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}