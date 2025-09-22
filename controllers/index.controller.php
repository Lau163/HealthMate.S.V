<?php
class Index extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
    }
    function render(){
        $this->view->render('index/index');
    } public function register() {
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
            header('Location: ' . BASE_URL . '');
            exit;
        }
    }
}
?>