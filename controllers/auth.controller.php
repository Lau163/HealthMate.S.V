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
        // Si ya está autenticado, redirigir según su rol
        if (isset($_SESSION['usuario_id'])) {
            $this->redirigirSegunRol();
            return;
        }
        
        // Mostrar mensajes de error si existen
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);
        
        $this->view->set('error', $error);
        $this->view->render('auth/login');
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
            header('Location: /auth');
            exit;
        }

        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                throw new Exception('Por favor, ingresa tu correo y contraseña');
            }

            $usuario = $this->usuarioModel->verificarCredenciales($email, $password);

            if (!$usuario) {
                throw new Exception('Credenciales incorrectas. Por favor, inténtalo de nuevo.');
            }

            // Crear sesión
            $this->usuarioModel->crearSesion($usuario);
            
            // Actualizar último acceso
            $this->usuarioModel->actualizarUltimoAcceso($usuario['Id_Usuario']);

            // Redirigir según el rol
            $this->redirigirSegunRol();
            
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /auth/login');
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
                $destino = '/admin';
                break;
            case 'doctor':
                $destino = '/doctor';
                break;
            case 'enfermerx':
                $destino = '/enfermerx';
                break;
            case 'paciente':
                $destino = '/paciente';
                break;
            default:
                $destino = '/';
        }
        
        // Verificar si hay una URL de redirección guardada
        $redirectUrl = $_SESSION['redirect_url'] ?? $destino;
        unset($_SESSION['redirect_url']);
        
        header('Location: ' . $redirectUrl);
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
            $this->view->render('auth/register');
            return;
        }

        try {
            // Recoger y sanitizar datos
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';
            $edad = filter_input(INPUT_POST, 'edad', FILTER_SANITIZE_NUMBER_INT);
            $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
            $peso = filter_input(INPUT_POST, 'peso', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $altura = filter_input(INPUT_POST, 'altura', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $tipoSangre = filter_input(INPUT_POST, 'tipo_sangre', FILTER_SANITIZE_STRING);
            $alergias = filter_input(INPUT_POST, 'alergias', FILTER_SANITIZE_STRING);
            $enfermedades = filter_input(INPUT_POST, 'enfermedades', FILTER_SANITIZE_STRING);

            // Validaciones básicas
            if (empty($nombre) || empty($email) || empty($password) || empty($edad) || empty($sexo)) {
                throw new Exception('Los campos obligatorios no pueden estar vacíos.');
            }

            if (strlen($password) < 8) {
                throw new Exception('La contraseña debe tener al menos 8 caracteres.');
            }

            // Por defecto, los nuevos usuarios son pacientes (Id_Rol = 4)
            $idRol = 4;

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

            // Redirigir al login con un mensaje de éxito
            $_SESSION['success'] = '¡Registro exitoso! Ahora puedes iniciar sesión.';
            header('Location: ');
            exit;

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: '); // Volver al formulario de registro con el error
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
        header('Location: /auth');
        exit;
    }
}