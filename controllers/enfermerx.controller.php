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
     * Muestra el formulario para crear un nuevo paciente
     */
    public function nuevo() {
        // Verificar que sea una petición GET
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Location: ' . BASE_URL . 'enfermerx');
            exit;
        }

        // Renderizar la vista del formulario
        $this->view->render('enfermerx/nuevo_paciente');
    }
    public function guardarPaciente() {
        // Verificar que sea una petición AJAX
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                 strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validar token CSRF
                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
                    throw new Exception('Token CSRF inválido');
                }

                // Obtener y validar datos del formulario
                $datosPaciente = [
                    'nombre' => trim($_POST['nombre'] ?? ''),
                    'edad' => !empty($_POST['edad']) ? (int)$_POST['edad'] : null,
                    'genero' => $_POST['genero'] ?? null,
                    'email' => filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL),
                    'telefono' => $_POST['telefono'] ?? null,
                    'direccion' => $_POST['direccion'] ?? null,
                    'tipo_sangre' => $_POST['tipo_sangre'] ?? null,
                    'alergias' => $_POST['alergias'] ?? null,
                    'enfermedades' => $_POST['enfermedades'] ?? null,
                    'medicamentos' => $_POST['medicamentos'] ?? null,
                    'peso' => !empty($_POST['peso']) ? (float)$_POST['peso'] : null,
                    'altura' => !empty($_POST['altura']) ? (float)$_POST['altura'] : null
                ];

                // Validar campos obligatorios
                if (empty($datosPaciente['nombre'])) {
                    throw new Exception('El nombre es obligatorio');
                }

                if (!$datosPaciente['email']) {
                    throw new Exception('El correo electrónico no es válido');
                }

                // Procesar documentos si se subieron
                $documentos = [];
                if (!empty($_FILES['documentos'])) {
                    $documentos = $this->procesarDocumentos($_FILES['documentos']);
                }

                // Guardar en la base de datos usando el modelo
                if (method_exists($this->paciente, 'insert')) {
                    $idPaciente = $this->paciente->insert($datosPaciente);

                    if ($idPaciente) {
                        // Procesar documentos si se subieron
                        if (!empty($documentos)) {
                            $this->guardarDocumentosPaciente($idPaciente, $documentos);
                        }

                        $response = [
                            'success' => true,
                            'message' => 'Paciente registrado exitosamente',
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
                        throw new Exception('Error al guardar el paciente en la base de datos');
                    }
                } else {
                    throw new Exception('Método insert no encontrado en el modelo');
                }

            } catch (Exception $e) {
                $errorMsg = $e->getMessage();
                $response = [
                    'success' => false,
                    'message' => $errorMsg
                ];

                if ($isAjax) {
                    header('Content-Type: application/json');
                    http_response_code(400);
                    echo json_encode($response);
                } else {
                    $_SESSION['error'] = $errorMsg;
                    $_SESSION['form_data'] = $_POST;
                    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? BASE_URL . 'enfermerx/nuevo'));
                }
                exit;
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Método no permitido. Se esperaba una petición POST.'
            ];

            if ($isAjax) {
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode($response);
            } else {
                header('Location: ' . BASE_URL . 'enfermerx/nuevo');
            }
            exit;
        }
    }

    /**
     * Procesa los documentos subidos
     */
    private function procesarDocumentos($archivos) {
        $documentos = [];
        $directorio = ROOT . 'public/documentos/pacientes/';

        // Crear directorio si no existe
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }

        // Procesar múltiples archivos
        $numArchivos = is_array($archivos['name']) ? count($archivos['name']) : 0;

        for ($i = 0; $i < $numArchivos; $i++) {
            if ($archivos['error'][$i] === UPLOAD_ERR_OK) {
                $nombreArchivo = uniqid() . '_' . basename($archivos['name'][$i]);
                $rutaArchivo = $directorio . $nombreArchivo;

                if (move_uploaded_file($archivos['tmp_name'][$i], $rutaArchivo)) {
                    $documentos[] = [
                        'nombre' => $archivos['name'][$i],
                        'ruta' => 'documentos/pacientes/' . $nombreArchivo,
                        'tipo' => $archivos['type'][$i],
                        'tamano' => $archivos['size'][$i]
                    ];
                }
            }
        }

        return $documentos;
    }

    /**
     * Guarda los documentos de un paciente
     */
    private function guardarDocumentosPaciente($idPaciente, $documentos) {
        try {
            $query = "INSERT INTO documentos_pacientes (Id_Usuario, Nombre_Archivo, Ruta_Archivo, Tipo_Archivo, Tamano_Archivo, Fecha_Subida)
                     VALUES (:id_usuario, :nombre, :ruta, :tipo, :tamano, NOW())";

            $stmt = $this->paciente->con->pdo->prepare($query);

            foreach ($documentos as $documento) {
                $stmt->execute([
                    ':id_usuario' => $idPaciente,
                    ':nombre' => $documento['nombre'],
                    ':ruta' => $documento['ruta'],
                    ':tipo' => $documento['tipo'],
                    ':tamano' => $documento['tamano']
                ]);
            }
        } catch (PDOException $e) {
            error_log("Error guardando documentos: " . $e->getMessage());
        }
    }
}