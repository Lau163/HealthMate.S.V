<?php
// controllers/auth.controller.php
class Auth extends ControllerBase {
    private $usuarioModel;
    
    public function __construct() {
        parent::__construct();
        
        // Cargar el modelo de usuario usando el método loadModel actualizado
        $this->usuarioModel = $this->loadModel('usuario');
        
        // Verificar que el modelo se cargó correctamente
        if (!$this->usuarioModel) {
            error_log('Error: No se pudo cargar el modelo de usuario en Auth');
        }
    }
    
    /**
     * Muestra el formulario de login
     */
    public function mostrarLogin() {
        // Si ya está autenticado, redirigir a la selección de roles
        if (isset($_SESSION['usuario_id'])) {
            $this->seleccionarRol();
            return;
        }
        
        // Obtener todos los mensajes flash
        $flash_messages = getAllFlashMessages();
        $error = '';
        
        // Buscar el primer mensaje de error
        foreach ($flash_messages as $flash) {
            if ($flash['type'] === 'error') {
                $error = $flash['message'];
                break;
            }
        }
        
        // Pasar el error a la vista
        $this->view->set('error', $error);
        
        // Renderizar la vista de login
        $this->view->render('auth/login');
    }

    // Render por defecto para /auth
    public function render() {
        $this->mostrarLogin();
    }
    
    /**
     * Cambia el rol del usuario actual
     * Elimina solo los datos de sesión relacionados con el rol actual
     */
    public function cambiarRol() {
        // Eliminar solo los datos de sesión relacionados con el rol
        unset($_SESSION['rol_actual']);
        unset($_SESSION['modulo_actual']);
        
        // Redirigir a la selección de roles
        $this->seleccionarRol();
    }
    
    /**
     * Muestra la vista de selección de roles o redirige si solo tiene un rol
     */
    public function seleccionarRol() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }
        
        // Obtener el ID del usuario actual
        $usuarioId = $_SESSION['usuario_id'];
        
        // Obtener los roles del usuario desde el modelo
        $roles = $this->usuarioModel->obtenerRolesPorUsuario($usuarioId);
        
        if (empty($roles)) {
            // Si el usuario no tiene roles asignados, mostrar un mensaje de error
            setFlashMessage('error', 'No tienes roles asignados. Por favor, contacta al administrador.');
            $this->view->render('auth/seleccionar_rol', ['roles' => []]);
            return;
        }
        
        // Si el usuario solo tiene un rol, redirigir directamente
        if (count($roles) === 1) {
            $rol = strtolower($roles[0]['Nombre_Rol']);
            $this->redirigirSegunRol($rol);
            return;
        }
        
        // Pasar los roles a la vista
        $this->view->render('auth/seleccionar_rol', ['roles' => $roles]);
    }
    
    /**
     * Redirige al usuario según su rol
     * 
     * @param string $rol Nombre del rol en minúsculas
     */
    private function redirigirSegunRol($rol) {
        // Mapeo de roles a rutas
        $rutasPorRol = [
            'admin' => 'admin/dashboard',
            'administrador' => 'admin/dashboard',
            'doctor' => 'doctor',
            'médico' => 'doctor',
            'enfermerx' => 'enfermerx',
            'enfermerx' => 'enfermerx',  // Redirigir a enfermerx para ambos
            'paciente' => 'paciente',
            'recepcionista' => 'recepcion'
        ];
        
        // Obtener la ruta base o usar la ruta por defecto
        $ruta = $rutasPorRol[strtolower($rol)] ?? 'auth/seleccionar-rol';
        
        // Redirigir a la ruta correspondiente
        header('Location: ' . URL . $ruta);
        exit;
    }
    
    /**
     * Procesa el inicio de sesión
     */
    public function login() {
        // Asegurarse de que la sesión esté iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Depuración: Verificar si la sesión está activa
        error_log('Sesión iniciada: ' . (session_status() === PHP_SESSION_ACTIVE ? 'Sí' : 'No'));
        error_log('Método de solicitud: ' . $_SERVER['REQUEST_METHOD']);
        error_log('Datos POST: ' . print_r($_POST, true));

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Redirigir al formulario de login si no es una petición POST
            error_log('Redirigiendo a login - No es una petición POST');
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                throw new Exception('Por favor, ingresa tu correo y contraseña');
            }

            // Primero buscamos el usuario por email
            $usuario = $this->usuarioModel->buscarPorEmail($email);
            
            // Si no se encuentra el usuario, mostramos un mensaje genérico por seguridad
            if (!$usuario) {
                error_log("Intento de inicio de sesión fallido: Usuario no encontrado - " . $email);
                
                // Usar el sistema de mensajes flash mejorado
                setFlashMessage('error', 'Correo electrónico o contraseña incorrectos');
                
                // Registrar en el log de errores
                error_log('Mensaje flash configurado: ' . 'Correo electrónico o contraseña incorrectos');
                
                // Redirigir al login
                header('Location: ' . URL . 'auth/login');
                exit;
            }
            
            // Si el usuario existe pero la contraseña no coincide
            if (!password_verify($password, $usuario['Password'])) {
                error_log("Intento de inicio de sesión fallido: Contraseña incorrecta para el usuario - " . $email);
                
                // Usar el sistema de mensajes flash mejorado
                setFlashMessage('error', 'Contraseña incorrecta. Por favor, inténtalo de nuevo o usa la opción de recuperar contraseña.');
                
                // Registrar en el log de errores
                error_log('Mensaje flash configurado: ' . 'Contraseña incorrecta. Por favor, inténtalo de nuevo o usa la opción de recuperar contraseña.');
                
                // Redirigir al login
                header('Location: ' . URL . 'auth/login');
                exit;
            }
            
            // Si llegamos aquí, el usuario y la contraseña son correctos
            // Continuar con el proceso de autenticación exitosa
            
            if (!$usuario) {
                error_log("Error al verificar credenciales para el usuario: " . $email);
                $_SESSION['error'] = 'Ocurrió un error al iniciar sesión. Por favor, inténtalo de nuevo más tarde.';
                header('Location: ' . BASE_URL . 'auth/login');
                exit;
            }

            error_log("Autenticación exitosa para: " . $email);
            
            // Obtener los roles del usuario para asegurarnos de que tenemos todos los datos necesarios
            $usuarioConRol = $this->usuarioModel->buscarPorEmail($email, true);
            
            if (!$usuarioConRol || !isset($usuarioConRol['Id_Usuario'])) {
                throw new Exception('Error al obtener los datos del usuario. Por favor, inténtalo de nuevo.');
            }
            
            // Asegurarse de que el array de usuario tenga los campos necesarios
            $datosUsuario = array_merge($usuario, $usuarioConRol);
            
            // Crear sesión con los datos completos del usuario
            $this->usuarioModel->crearSesion($datosUsuario);
            
            // Actualizar último acceso
            $this->usuarioModel->actualizarUltimoAcceso($datosUsuario['Id_Usuario']);

            // Redirigir a la selección de roles
            $this->seleccionarRol();
            
        } catch (Exception $e) {
            // Asegurarse de que la sesión esté iniciada antes de guardar el error
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['error'] = $e->getMessage();
            
            // Redirigir de vuelta al formulario de login con el mensaje de error
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }
    }

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
        
        session_destroy();
        
        // Redirigir al inicio de sesión
        header('Location: ' . BASE_URL . 'auth');
        exit();
    }

    public function logout() {
        // Limpiar cualquier buffer de salida primero
        if (ob_get_level() > 0) {
            ob_end_clean();
        }
        
        // Configurar encabezados para evitar caché ANTES de cualquier salida
        header_remove('Pragma');
        header_remove('Expires');
        header_remove('Cache-Control');
        
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0');
        header('Pragma: no-cache');
        header('Expires: Thu, 19 Nov 1981 08:52:00 GMT');
        
        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Registrar la acción de cierre de sesión
        $usuarioId = $_SESSION['usuario_id'] ?? 'No identificado';
        error_log('Iniciando proceso de cierre de sesión para el usuario: ' . $usuarioId);
        
        // Limpiar todas las variables de sesión
        $_SESSION = [];
        
        // Si se desea destruir la sesión completamente, borra también la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), 
                '', 
                [
                    'expires' => time() - 3600,
                    'path' => $params["path"],
                    'domain' => $params["domain"],
                    'secure' => $params["secure"],
                    'httponly' => $params["httponly"],
                    'samesite' => 'Lax'
                ]
            );
        }
        
        // Destruir la sesión
        if (session_destroy()) {
            error_log('Sesión destruida correctamente para el usuario: ' . $usuarioId);
        } else {
            error_log('Error al destruir la sesión para el usuario: ' . $usuarioId);
        }
        
        // Redirigir a la página de inicio con un parámetro para forzar recarga
        // Usar JavaScript para forzar la recarga de la caché
        $redirectUrl = BASE_URL . '?logout=' . time();
        
        // Enviar encabezados adicionales
        header('X-Frame-Options: DENY');
        header('X-Content-Type-Options: nosniff');
        
        // Redirigir con JavaScript para asegurar que no se use la caché
        echo '<!DOCTYPE html>
        <html>
        <head>
            <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
            <meta http-equiv="Pragma" content="no-cache" />
            <meta http-equiv="Expires" content="0" />
            <script>
                // Forzar recarga sin caché
                window.location.replace("' . htmlspecialchars($redirectUrl, ENT_QUOTES, 'UTF-8') . '");
                // Limpiar el historial de navegación
                if (window.history) {
                    window.history.replaceState(null, null, "' . htmlspecialchars($redirectUrl, ENT_QUOTES, 'UTF-8') . '");
                }
            </script>
        </head>
        <body>
            <p>Cerrando sesión... <a href="' . htmlspecialchars($redirectUrl, ENT_QUOTES, 'UTF-8') . '">Continuar</a></p>
        </body>
        </html>';
        exit;
    }
}