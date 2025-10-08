<?php
class Enfermerx extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
        // Cargar modelos necesarios
        $this->usuario = $this->loadModel('usuario');
        $this->enfermerx = $this->loadModel('enfermerx');
        $this->paciente = $this->loadModel('paciente');
        
        // Verificar que los modelos se cargaron correctamente
        if (!$this->usuario) {
            error_log("Error: No se pudo cargar el modelo de usuario");
        }
        if (!$this->enfermerx) {
            error_log("Error: No se pudo cargar el modelo de enfermerx");
        }
        if (!$this->paciente) {
            error_log("Error: No se pudo cargar el modelo de paciente");
        }
    }
    
    /**
     * Muestra el formulario de edición de un paciente
     * @param array $params Parámetros de la URL (debe contener el ID del paciente)
     */
    public function editar($params = []) {
        // Verificar que sea una petición AJAX
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                 strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        
        // Obtener el ID del paciente de los parámetros
        $idPaciente = isset($params[0]) ? intval($params[0]) : 0;
        
        if ($idPaciente <= 0) {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => 'ID de paciente no válido.'
                ]);
                exit;
            } else {
                $_SESSION['error'] = 'ID de paciente no válido';
                header('Location: ' . BASE_URL . 'enfermerx');
                exit;
            }
        }
        
        // Obtener los datos del paciente
        $paciente = $this->paciente->getById($idPaciente);
        
        if (!$paciente) {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => 'No se encontró el paciente especificado.'
                ]);
                exit;
            } else {
                $_SESSION['error'] = 'No se encontró el paciente especificado';
                header('Location: ' . BASE_URL . 'enfermerx');
                exit;
            }
        }
        
        // Si es una petición POST, procesar la actualización
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->actualizarPaciente($idPaciente);
            return;
        }
        
        // Si es una petición GET, devolver los datos del paciente
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'data' => $paciente
            ]);
            exit;
        }
    }
    
    /**
     * Actualiza los datos de un paciente
     * @param int $idPaciente ID del paciente a actualizar
     */
    private function actualizarPaciente($idPaciente) {
        // Verificar que sea una petición AJAX
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                 strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        
        try {
            // Validar datos de entrada
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $edad = isset($_POST['edad']) ? intval($_POST['edad']) : null;
            $sexo = trim($_POST['sexo'] ?? '');
            $tipoSangre = trim($_POST['tipo_sangre'] ?? '');
            $peso = !empty($_POST['peso']) ? floatval($_POST['peso']) : null;
            $altura = !empty($_POST['altura']) ? intval($_POST['altura']) : null;
            $alergias = trim($_POST['alergias'] ?? '');
            $enfermedades = trim($_POST['enfermedades'] ?? '');
            
            // Validaciones básicas
            if (empty($nombre) || empty($email)) {
                throw new Exception('El nombre y el correo electrónico son campos obligatorios.');
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('El correo electrónico no tiene un formato válido.');
            }
            
            // Preparar datos para actualizar
            $datosActualizacion = [
                'Nombre' => $nombre,
                'Email' => $email,
                'Edad' => $edad,
                'Sexo' => $sexo,
                'Tipo_sangre' => $tipoSangre,
                'Peso' => $peso,
                'Altura' => $altura,
                'Alergias' => $alergias,
                'Enfermedades' => $enfermedades
            ];
            
            // Actualizar el paciente
            $resultado = $this->paciente->actualizar($idPaciente, $datosActualizacion);
            
            if ($resultado) {
                $respuesta = [
                    'success' => true,
                    'message' => 'Paciente actualizado correctamente.'
                ];
            } else {
                throw new Exception('No se pudo actualizar el paciente. Inténtalo de nuevo.');
            }
            
        } catch (Exception $e) {
            error_log('Error al actualizar paciente: ' . $e->getMessage());
            $respuesta = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
        
        // Devolver respuesta
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode($respuesta);
            exit;
        } else {
            if (isset($respuesta['success']) && $respuesta['success']) {
                $_SESSION['success'] = $respuesta['message'];
            } else {
                $_SESSION['error'] = $respuesta['message'] ?? 'Error al actualizar el paciente';
            }
            header('Location: ' . BASE_URL . 'enfermerx');
            exit;
        }
    }
    
    function render(){
        // Listar pacientes para la vista de enfermería
        $pacientes = [];
        if (class_exists('PacienteModel')) {
            try {
                $pm = new PacienteModel();
                $pacientes = $pm->getAll();
                
                // Depuración: Verificar datos recuperados
                error_log("Pacientes recuperados: " . print_r($pacientes, true));
                
            } catch (Throwable $th) {
                $errorMsg = "Error al cargar pacientes: " . $th->getMessage();
                error_log($errorMsg);
                // Pasar el mensaje de error a la vista
                $this->view->set('error', $errorMsg);
            }
        } else {
            $errorMsg = "La clase PacienteModel no existe";
            error_log($errorMsg);
            $this->view->set('error', $errorMsg);
        }
        
        // Depuración: Verificar estructura de datos antes de pasar a la vista
        error_log("Total de pacientes a mostrar: " . count($pacientes));
        
        $this->view->set('pacientes', $pacientes);
        $this->view->render('enfermerx/index');
    }
    
    /**
     * Guarda un nuevo paciente desde el modal
     */
    /**
     * Elimina un paciente por su ID
     * @param array $params Parámetros de la URL (debe contener el ID del paciente)
     */
    public function eliminar($params = []) {
        // Verificar que sea una petición AJAX
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                 strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        
        // Obtener el ID del paciente de los parámetros
        $idPaciente = isset($params[0]) ? intval($params[0]) : 0;
        
        if ($idPaciente <= 0) {
            $response = [
                'success' => false,
                'message' => 'ID de paciente no válido.'
            ];
            
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            } else {
                $_SESSION['error'] = $response['message'];
                header('Location: ' . BASE_URL . 'enfermerx');
                exit;
            }
        }
        
        try {
            // Verificar si el paciente existe
            $paciente = $this->paciente->getById($idPaciente);
            
            if (!$paciente) {
                throw new Exception('No se encontró el paciente especificado');
            }
            
            // Eliminar el paciente
            $resultado = $this->paciente->deleteById($idPaciente);
            
            if ($resultado) {
                $response = [
                    'success' => true,
                    'message' => 'Paciente eliminado correctamente.'
                ];
            } else {
                throw new Exception('No se pudo eliminar el paciente. Inténtalo de nuevo.');
            }
            
        } catch (Exception $e) {
            error_log('Error al eliminar paciente: ' . $e->getMessage());
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
        
        // Devolver respuesta
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            if (isset($response['success']) && $response['success']) {
                $_SESSION['success'] = $response['message'];
            } else {
                $_SESSION['error'] = $response['message'] ?? 'Error al eliminar el paciente';
            }
            header('Location: ' . BASE_URL . 'enfermerx');
            exit;
        }
    }
    
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
                header('Location: ' . BASE_URL . 'enfermerx');
            }
            exit;
        }

        try {
            // Depuración: Registrar los datos recibidos
            error_log('Datos recibidos en guardarPaciente (enfermerx): ' . print_r($_POST, true));
            
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
            
            // Preparar datos del paciente
            $datosPaciente = [
                'Id_Rol' => 4, // ID del rol de paciente
                'Nombre' => trim($_POST['nombre']), // Usar el nombre directamente del campo 'nombre'
                'Email' => $email,
                'Password' => password_hash('temp123', PASSWORD_DEFAULT), // Contraseña temporal
                'Edad' => !empty($_POST['edad']) ? (int)$_POST['edad'] : null,
                'Sexo' => $_POST['genero'] ?? null, // Cambiado de 'sexo' a 'genero' para coincidir con el formulario
                'Peso' => !empty($_POST['peso']) ? (float)$_POST['peso'] : null,
                'Altura' => !empty($_POST['altura']) ? (float)$_POST['altura'] : null,
                'Tipo_sangre' => $_POST['tipo_sangre'] ?? null,
                'Alergias' => trim($_POST['alergias'] ?? ''),
                'Enfermedades' => trim($_POST['enfermedades'] ?? ''),
                'Activo' => 1,
                'Fecha_Creacion' => date('Y-m-d H:i:s')
            ];
            
            // Verificar si el correo ya existe (incluyendo inactivos)
            $usuarioExistente = $this->usuario->buscarPorEmail($email, false, false);
            if ($usuarioExistente) {
                if ($usuarioExistente['Activo'] == 1) {
                    throw new Exception('El correo electrónico ya está registrado');
                } else {
                    // Si el usuario existe pero está inactivo, actualizarlo en lugar de crear uno nuevo
                    $datosPaciente['Id_Usuario'] = $usuarioExistente['Id_Usuario'];
                    
                    // Actualizar el usuario existente con los nuevos datos
                    $idPaciente = $this->usuario->actualizar($usuarioExistente['Id_Usuario'], $datosPaciente);
                    
                    if ($idPaciente) {
                        $response = [
                            'success' => true,
                            'message' => 'Paciente registrado correctamente (usuario reactivado)',
                            'id' => $idPaciente
                        ];
                        
                        if ($isAjax) {
                            header('Content-Type: application/json');
                            echo json_encode($response);
                        } else {
                            $_SESSION['success'] = $response['message'];
                            header('Location: ' . BASE_URL . 'enfermerx');
                        }
                        exit;
                    } else {
                        throw new Exception('No se pudo actualizar el usuario existente');
                    }
                }
            }

            // Depuración: Registrar los datos que se intentan guardar
            error_log('Intentando crear paciente con datos: ' . print_r($datosPaciente, true));

            // Crear el paciente con manejo de errores detallado
            try {
                $idPaciente = $this->usuario->create($datosPaciente);
                
                if ($idPaciente === false) {
                    $errorInfo = $this->usuario->getErrorInfo();
                    $error = 'Error al intentar crear el paciente. ';
                    
                    if (!empty($errorInfo)) {
                        $error .= 'Detalles: ' . json_encode($errorInfo);
                    } else {
                        $error .= 'No se pudo completar la operación.';
                    }
                    
                    error_log($error);
                    throw new Exception($error);
                }
            } catch (Exception $e) {
                // Capturar cualquier excepción durante la creación del usuario
                $error = 'Excepción al crear el paciente: ' . $e->getMessage();
                error_log($error);
                error_log('Datos del paciente: ' . print_r($datosPaciente, true));
                
                // Verificar si hay errores de base de datos
                if (method_exists($this->usuario, 'getErrorInfo')) {
                    $errorInfo = $this->usuario->getErrorInfo();
                    if (!empty($errorInfo)) {
                        error_log('Error de base de datos: ' . print_r($errorInfo, true));
                    }
                }
                
                throw new Exception('Error al intentar guardar el paciente. ' . $e->getMessage());
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
                header('Location: ' . BASE_URL . 'enfermerx');
            }
            exit;
            
        } catch (Exception $e) {
            // Manejo de errores detallado
            $errorMsg = $e->getMessage();
            $errorDetails = [
                'error' => $errorMsg,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'post_data' => $_POST
            ];
            
            error_log('Error en guardarPaciente (enfermerx): ' . print_r($errorDetails, true));
            
            if ($isAjax) {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => 'Error al intentar guardar el paciente. ' . $errorMsg,
                    'debug' => (ENVIRONMENT === 'development') ? $errorDetails : null
                ]);
            } else {
                $_SESSION['error'] = 'Error al intentar guardar el paciente. ' . $errorMsg;
                if (isset($_SERVER['HTTP_REFERER'])) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                } else {
                    header('Location: ' . BASE_URL . 'enfermerx');
                }
            }
            exit;
        }
    }
}