<?php
// controllers/auth.controller.php
class Auth extends ControllerBase {
    private $usuarioModel;
    
    public function __construct() {
        parent::__construct();
        // Cargar el modelo de usuario según la convención inicial
        $this->loadModel('usuario');
        $this->usuarioModel = $this->model; // instancia de UsuarioModel
    }
    
    /**
     * Muestra el formulario de login
     */
    public function mostrarLogin() {
        // Si ya está autenticado, redirigir a la página principal
        if (isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL);
            exit;
        }
        
        // Si estamos en la ruta /auth, redirigir a la raíz
        if (strpos($_SERVER['REQUEST_URI'], '/auth') === 0) {
            header('Location: ' . BASE_URL);
            exit;
        }
    }

    // Render por defecto para /auth
    public function render() {
        $this->mostrarLogin();
    }
    
    /**
     * Procesa el inicio de sesión
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Evitar loop de redirecciones a un endpoint POST
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                throw new Exception('Por favor, ingresa tu correo y contraseña');
            }

            // Depuración: Mostrar el correo que se está intentando autenticar
            error_log("Intento de inicio de sesión para: " . $email);

            $usuario = $this->usuarioModel->buscarPorEmail($email);
            
            // Depuración: Verificar si se encontró el usuario
            if ($usuario) {
                error_log("Usuario encontrado en la base de datos: " . print_r($usuario, true));
                // Verificar la contraseña
                $passwordMatch = password_verify($password, $usuario['Password']);
                error_log("¿La contraseña coincide? " . ($passwordMatch ? 'Sí' : 'No'));
                
                if (!$passwordMatch) {
                    error_log("Hash de la contraseña almacenada: " . $usuario['Password']);
                    error_log("Contraseña proporcionada: " . $password);
                }
            } else {
                error_log("No se encontró ningún usuario con el correo: " . $email);
            }

            $usuario = $this->usuarioModel->verificarCredenciales($email, $password);

            if (!$usuario) {
                error_log("Las credenciales son incorrectas para: " . $email);
                throw new Exception('Credenciales incorrectas. Por favor, inténtalo de nuevo.');
            }

            error_log("Autenticación exitosa para: " . $email);
            
            // Crear sesión
            $this->usuarioModel->crearSesion($usuario);
            
            // Actualizar último acceso
            $this->usuarioModel->actualizarUltimoAcceso($usuario['Id_Usuario']);

            // Redirigir según el rol del usuario
            $this->redirigirSegunRol();
            
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }
    }

    /**
     * Redirige al usuario según su rol
     */
    private function redirigirSegunRol() {
        $rol = $_SESSION['usuario_rol'] ?? '';
        
        // Redirigir según el rol
        switch (strtolower($rol)) {
            case 'admin':
                $destino = 'admin';
                break;
            case 'doctor':
                $destino = 'doctor';
                break;
            case 'enfermerx':
                $destino = 'enfermerx';
                break;
            case 'paciente':
                $destino = 'paciente';
                break;
            default:
                $destino = '';
        }
        
        // Verificar si hay una URL de redirección guardada
        $redirectUrl = $_SESSION['redirect_url'] ?? $destino;
        unset($_SESSION['redirect_url']);
        
        // Construir la URL final
        $finalUrl = rtrim(BASE_URL, '/') . '/' . ltrim($redirectUrl, '/');
        
        // Limpiar posibles dobles barras
        $finalUrl = str_replace('//', '/', $finalUrl);
        $finalUrl = str_replace(':/', '://', $finalUrl);
        
        error_log("Redirigiendo a: " . $finalUrl);
        header('Location: ' . $finalUrl);
        exit;
    }

    /**
     * Cierra la sesión del usuario
     */
    /**
     * Procesa el registro de un nuevo usuario.
     */
    public function register() {
        // Si es GET, renderizar el formulario de registro
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $error = $_SESSION['error'] ?? null;
            unset($_SESSION['error']);
            if ($error) {
                $this->view->set('error', $error);
            }
            $this->view->render('index/index');
            return;
        }

        try {
            // Recoger y validar datos
            $nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''), ENT_QUOTES, 'UTF-8');
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
            if ($email === false) {
                throw new Exception('El formato del correo electrónico no es válido.');
            }
            $password = $_POST['password'] ?? '';
            $edad = filter_var(trim($_POST['edad'] ?? ''), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 120]]);
            if ($edad === false) {
                throw new Exception('La edad debe ser un número entre 1 y 120 años.');
            }
            $sexo = in_array(strtolower(trim($_POST['sexo'] ?? '')), ['masculino', 'femenino', 'otro']) ? 
                   strtolower(trim($_POST['sexo'])) : '';
            
            // Validar y formatear números flotantes
            $peso = filter_var(trim($_POST['peso'] ?? '0'), FILTER_VALIDATE_FLOAT, ['options' => ['min_range' => 0]]);
            $altura = filter_var(trim($_POST['altura'] ?? '0'), FILTER_VALIDATE_FLOAT, ['options' => ['min_range' => 0]]);
            
            // Sanitizar texto libre
            $tipoSangre = htmlspecialchars(trim($_POST['tipo_sangre'] ?? ''), ENT_QUOTES, 'UTF-8');
            $alergias = htmlspecialchars(trim($_POST['alergias'] ?? ''), ENT_QUOTES, 'UTF-8');
            $enfermedades = htmlspecialchars(trim($_POST['enfermedades'] ?? ''), ENT_QUOTES, 'UTF-8');

            // Validaciones básicas
            if (empty($nombre) || empty($email) || empty($password) || empty($edad) || empty($sexo)) {
                throw new Exception('Los campos obligatorios no pueden estar vacíos.');
            }

            if (strlen($password) < 8) {
                throw new Exception('La contraseña debe tener al menos 8 caracteres.');
            }

            // Obtener roles disponibles
            $roles = $this->usuarioModel->obtenerRolesDisponibles();
            
            // Buscar el rol de paciente (si existe)
            $idRol = null;
            foreach ($roles as $rol) {
                if (strtolower($rol['Nombre_Rol']) === 'paciente') {
                    $idRol = $rol['Id_Rol'];
                    break;
                }
            }
            
            // Si no se encontró el rol de paciente, usar el primer rol disponible
            if ($idRol === null && !empty($roles)) {
                $idRol = $roles[0]['Id_Rol'];
            }
            
            // Si no hay roles disponibles, mostrar error
            if ($idRol === null) {
                throw new Exception('No se encontraron roles disponibles en el sistema. Contacta al administrador.');
            }

            $datos = [
                'Id_Rol' => $idRol,
                'Nombre' => $nombre,
                'Email' => $email,
                'Password' => $password, // El hasheo se hará en el modelo
                'Edad' => $edad,
                'Sexo' => $sexo,
                'Peso' => $peso,
                'Altura' => $altura,
                'Tipo_sangre' => $tipoSangre,
                'Alergias' => $alergias,
                'Enfermedades' => $enfermedades
            ];

            $this->usuarioModel->crear($datos);

            // Redirigir de vuelta a la página de inicio con mensaje de éxito
            $_SESSION['success'] = '¡Registro exitoso! Ahora puedes iniciar sesión.';
            // Cambiar a la pestaña de login
            $_SESSION['active_tab'] = 'login';
            header('Location: ' . BASE_URL);
            exit;

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            // Mantener los datos del formulario para no perderlos
            $_SESSION['form_data'] = $_POST;
            // Cambiar a la pestaña de registro
            $_SESSION['active_tab'] = 'register';
            header('Location: ' . BASE_URL . 'auth/register');
            exit;
        }
    }

    public function logout() {
        // Destruir todas las variables de sesión
        $_SESSION = [];
        
        // Si se desea destruir la sesión completamente, borra también la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Finalmente, destruir la sesión
        session_destroy();
        
        // Redirigir al login
        header('Location: ');
        exit;
    }
}