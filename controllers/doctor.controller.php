<?php
class Doctor extends ControllerBase
{
    // Declarar propiedades correctamente para evitar errores de PHP 8.2+
    protected $usuario;
    protected $doctor;
    protected $paciente;

    function __construct() {
        parent::__construct();
        
        // Cargar modelos necesarios
        $this->usuario = $this->loadModel('usuario');
        $this->doctor = $this->loadModel('doctor');
        $this->paciente = $this->loadModel('paciente');
        
        // Verificar que los modelos se cargaron correctamente
        if (!$this->usuario) {
            error_log("Error: No se pudo cargar el modelo de usuario");
        }
        if (!$this->doctor) {
            error_log("Error: No se pudo cargar el modelo de doctor");
        }
        if (!$this->paciente) {
            error_log("Error: No se pudo cargar el modelo de paciente");
        }
    }
    function render(){
        $this->panel();
    }

    /**
     * Muestra el formulario para agregar un nuevo paciente
     */
    /**
     * Guarda un nuevo paciente desde el modal
     */
    public function guardarPaciente() {
        // Verificar que sea una petición AJAX
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                 strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        
        // Verificar que el usuario esté autenticado
        if (!isset($_SESSION['usuario_id'])) {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => 'No autorizado. Por favor, inicia sesión.'
                ]);
                exit;
            } else {
                header('Location: ' . BASE_URL . 'auth');
                exit;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Método no permitido
            if ($isAjax) {
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'success' => false,
                    'message' => 'Método no permitido. Se esperaba una petición POST.'
                ]);
            } else {
                $_SESSION['error'] = 'Método no permitido';
                header('Location: ' . BASE_URL . 'doctor');
            }
            exit;
        }

        try {
            // Depuración: Registrar los datos recibidos
            error_log('Datos recibidos en guardarPaciente: ' . print_r($_POST, true));
            
            // Validar que el modelo de usuario esté cargado
            if (!$this->usuario) {
                $error = 'Error: No se pudo cargar el modelo de usuario';
                error_log($error);
                throw new Exception($error);
            }

            // Validar datos requeridos
            $errores = [];
            if (empty(trim($_POST['nombre'] ?? ''))) {
                $errores[] = 'El nombre es obligatorio';
            }
            if (empty(trim($_POST['email'] ?? ''))) {
                $errores[] = 'El correo electrónico es obligatorio';
            } elseif (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
                $errores[] = 'El formato del correo electrónico no es válido';
            }
            
            if (!empty($errores)) {
                throw new Exception(implode(', ', $errores));
            }
            
            $email = trim($_POST['email']);
            
            // Verificar si el correo ya existe
            $usuarioExistente = $this->usuario->buscarPorEmail($email);
            if ($usuarioExistente) {
                throw new Exception('El correo electrónico ya está registrado');
            }

            // Preparar datos del paciente
            $datosPaciente = [
                'Id_Rol' => 4, // ID del rol de paciente
                'Nombre' => trim($_POST['nombre']),
                'Email' => $email,
                'Password' => password_hash('temp123', PASSWORD_DEFAULT), // Contraseña temporal
                'Edad' => !empty($_POST['edad']) ? (int)$_POST['edad'] : null,
                'Sexo' => $_POST['sexo'] ?? null,
                'Peso' => !empty($_POST['peso']) ? (float)$_POST['peso'] : null,
                'Altura' => !empty($_POST['altura']) ? (float)$_POST['altura'] : null,
                'Tipo_sangre' => $_POST['tipo_sangre'] ?? null,
                'Alergias' => trim($_POST['alergias'] ?? ''),
                'Enfermedades' => trim($_POST['enfermedades'] ?? ''),
                'Activo' => 1,
                'Fecha_Creacion' => date('Y-m-d H:i:s')
            ];

            // Depuración: Registrar los datos que se intentan guardar
            error_log('Intentando crear paciente con datos: ' . print_r($datosPaciente, true));

            // Crear el paciente
            $idPaciente = $this->usuario->create($datosPaciente);
            
            if ($idPaciente === false) {
                $error = 'Error al intentar crear el paciente. Verifica los datos e inténtalo de nuevo.';
                error_log($error);
                throw new Exception($error);
            }
            
            error_log('Paciente creado con ID: ' . $idPaciente);
            
            // Respuesta exitosa
            $response = [
                'success' => true,
                'message' => 'Paciente creado correctamente',
                'id' => $idPaciente
            ];
            
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $_SESSION['success'] = $response['message'];
                header('Location: ' . BASE_URL . 'doctor');
            }
            exit;
            
        } catch (Exception $e) {
            // Manejo de errores
            $errorMsg = $e->getMessage();
            error_log('Error en guardarPaciente: ' . $errorMsg);
            
            if ($isAjax) {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => $errorMsg
                ]);
            } else {
                $_SESSION['error'] = $errorMsg;
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            exit;
        }
    }

    /**
     * Muestra el formulario para agregar un nuevo paciente
     */
    public function nuevo_paciente() {
        // Verificar que el usuario esté autenticado
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validar datos requeridos
                if (empty($_POST['Nombre']) || empty($_POST['Email'])) {
                    throw new Exception('Nombre y correo electrónico son campos obligatorios');
                }

                // Preparar datos del paciente
                $datosPaciente = [
                    'Id_Rol' => 4, // ID del rol de paciente
                    'Nombre' => $_POST['Nombre'] ?? '',
                    'Email' => $_POST['Email'] ?? '',
                    'Password' => password_hash('temp123', PASSWORD_DEFAULT), // Contraseña temporal
                    'Edad' => $_POST['Edad'] ?? null,
                    'Sexo' => $_POST['Sexo'] ?? null,
                    'Peso' => $_POST['Peso'] ?? null,
                    'Altura' => $_POST['Altura'] ?? null,
                    'Tipo_sangre' => $_POST['Tipo_sangre'] ?? null,
                    'Alergias' => $_POST['Alergias'] ?? null,
                    'Enfermedades' => $_POST['Enfermedades'] ?? null,
                    'Activo' => 1
                ];

                // Crear el paciente
                $idPaciente = $this->usuario->create($datosPaciente);
                
                if ($idPaciente) {
                    $_SESSION['success'] = 'Paciente creado exitosamente';
                    header('Location: ' . BASE_URL . 'doctor');
                    exit;
                } else {
                    throw new Exception('No se pudo crear el paciente');
                }
            } catch (Exception $e) {
                $this->view->set('error', $e->getMessage());
                $this->view->set('paciente', $_POST); // Mantener los datos ingresados
            }
        }
        
        // Mostrar el formulario de nuevo paciente
        $this->view->render('doctor/nuevo-paciente');
    }

    // Panel tipo dashboard para doctores (estilo enfermerx)
    public function panel()
    {
        // Seguridad básica: requerir sesión
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        $totalDoctores = 0;
        try {
            // Usar $this->doctor en lugar de $this->model
            $lista = $this->doctor ? $this->doctor->getAll() : [];
            $totalDoctores = is_array($lista) ? count($lista) : 0;
        } catch (Throwable $th) {
            error_log("Error al obtener la lista de doctores: " . $th->getMessage());
            $totalDoctores = 0;
        }

        // Datos de ejemplo para KPIs adicionales
        $citasHoy = 8; // TODO: integrar citas reales
        $alertas = 1; // TODO: integrar alertas reales

        $this->view->set('kpis', [
            'totalDoctores' => $totalDoctores,
            'citasHoy' => $citasHoy,
            'alertas' => $alertas,
        ]);
        // Cargar lista de pacientes para mostrar en la vista del Doctor
        try {
            if (class_exists('PacienteModel')) {
                $pm = new PacienteModel();
                $pacientes = $pm->getAll();
                $this->view->set('pacientes', $pacientes);
            }
        } catch (Throwable $th) {
            // opcional: log error y continuar sin pacientes
        }
        $this->view->render('doctor/index');
    }

    // Mostrar formulario de edición o actualizar un doctor (según método)
    public function editar($params = [])
    {
        if (!$this->doctor) { $this->view->render('doctor/doctor'); return; }

        $id = isset($params[0]) ? (int)$params[0] : 0;
        if ($id <= 0) {
            $_SESSION['error'] = 'ID de doctor inválido';
            header('Location: ' . BASE_URL . 'doctor');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'Nombre' => $_POST['Nombre'] ?? null,
                'Email' => $_POST['Email'] ?? null,
                'Edad' => $_POST['Edad'] ?? null,
                'Sexo' => $_POST['Sexo'] ?? null,
                'Peso' => $_POST['Peso'] ?? null,
                'Altura' => $_POST['Altura'] ?? null,
                'Tipo_sangre' => $_POST['Tipo_sangre'] ?? null,
                'Alergias' => $_POST['Alergias'] ?? null,
                'Enfermedades' => $_POST['Enfermedades'] ?? null,
            ];
            try {
                $this->doctor->updateById($id, $datos);
                $_SESSION['success'] = 'Doctor actualizado correctamente';
                header('Location: ' . BASE_URL . 'doctor');
                exit;
            } catch (Throwable $th) {
                $_SESSION['error'] = 'No se pudo actualizar el doctor';
                header('Location: ' . BASE_URL . 'doctor/editar/' . $id);
                exit;
            }
        } else {
            $doctor = $this->doctor->getById($id);
            if (!$doctor) {
                $_SESSION['error'] = 'Doctor no encontrado';
                header('Location: ' . BASE_URL . 'doctor');
                exit;
            }
            $this->view->set('doctor', $doctor);
            $this->view->render('doctor/editar');
        }
    }

    // Eliminar doctor (solo POST)
    public function eliminar($params = [])
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'doctor');
            exit;
        }

        $id = isset($params[0]) ? (int)$params[0] : 0;
        if ($id <= 0) {
            $_SESSION['error'] = 'ID de doctor inválido';
            header('Location: ' . BASE_URL . 'doctor');
            exit;
        }

        try {
            $this->doctor->deleteById($id);
            $_SESSION['success'] = 'Doctor eliminado correctamente';
        } catch (Throwable $th) {
            $_SESSION['error'] = 'No se pudo eliminar el doctor';
        }
        header('Location: ' . BASE_URL . 'doctor');
        exit;
    }

    // Procesar el registro de nuevo paciente (método antiguo, mantenido por compatibilidad)
    public function registrarPaciente()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'doctor');
            exit;
        }

        // Validar y sanitizar datos
        $datos = [
            'nombres' => filter_input(INPUT_POST, 'nombres', FILTER_SANITIZE_STRING),
            'apellidos' => filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING),
            'fecha_nacimiento' => filter_input(INPUT_POST, 'fecha_nacimiento', FILTER_SANITIZE_STRING),
            'genero' => filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING),
            'telefono' => filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'direccion' => filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING),
            'tipo_sangre' => filter_input(INPUT_POST, 'tipo_sangre', FILTER_SANITIZE_STRING),
            'alergias' => filter_input(INPUT_POST, 'alergias', FILTER_SANITIZE_STRING),
            'enfermedades_cronicas' => filter_input(INPUT_POST, 'enfermedades_cronicas', FILTER_SANITIZE_STRING),
            'medicamentos' => filter_input(INPUT_POST, 'medicamentos', FILTER_SANITIZE_STRING)
        ];

        // Validaciones básicas
        if (empty($datos['nombres']) || empty($datos['apellidos'])) {
            $_SESSION['error'] = 'El nombre y apellido son obligatorios';
            header('Location: ' . BASE_URL . 'doctor/nuevo-paciente');
            exit;
        }

        try {
            // Insertar en la base de datos
            $resultado = $this->paciente->insert($datos);
            
            if ($resultado) {
                $_SESSION['mensaje'] = 'Paciente registrado exitosamente';
                header('Location: ' . BASE_URL . 'doctor');
            } else {
                throw new Exception('Error al registrar el paciente');
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al registrar el paciente: ' . $e->getMessage();
            header('Location: ' . BASE_URL . 'doctor/nuevo-paciente');
        }
        exit;
    }
}
?>