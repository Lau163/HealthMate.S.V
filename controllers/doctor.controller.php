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
        $this->inicio();
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
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al eliminar el doctor: ' . $e->getMessage();
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

    /**
     * Vista de Estadísticas y Gráficos
     */
    public function estadisticas() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Datos de ejemplo para estadísticas (en producción vendrían de la base de datos)
        $estadisticas = [
            'totalPacientes' => 150,
            'citasMes' => 320,
            'ingresosMensuales' => 45000,
            'satisfaccion' => 4.8,
            'citasPendientes' => 25,
            'citasCompletadas' => 295
        ];

        // Datos para gráficos
        $datosGraficos = [
            'mensual' => [
                'enero' => 45, 'febrero' => 52, 'marzo' => 48, 'abril' => 61,
                'mayo' => 55, 'junio' => 67, 'julio' => 58, 'agosto' => 63,
                'septiembre' => 71, 'octubre' => 69, 'noviembre' => 74, 'diciembre' => 78
            ],
            'especialidades' => [
                'Medicina General' => 35,
                'Cardiología' => 25,
                'Dermatología' => 15,
                'Pediatría' => 15,
                'Ginecología' => 10
            ]
        ];

        // Configurar datos para la vista
        $this->view->set('estadisticas', $estadisticas);
        $this->view->set('datosGraficos', $datosGraficos);

        // Usar el layout base con la vista de estadísticas
        $this->renderWithLayout('estadisticas');
    }

    /**
     * Vista de Consejos Médicos
     */
    public function consejos() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Datos de ejemplo para consejos (en producción vendrían de la base de datos)
        $consejos = [
            [
                'id' => 1,
                'titulo' => 'Importancia de la Hidratación',
                'categoria' => 'Hidratación',
                'contenido' => 'Mantenerse hidratado es fundamental para el funcionamiento óptimo del cuerpo humano. Se recomienda consumir al menos 8 vasos de agua al día, especialmente durante épocas de calor o cuando se realiza actividad física.',
                'autor' => 'Dr. María González',
                'fecha' => '2024-01-15',
                'imagen' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=300&fit=crop'
            ],
            [
                'id' => 2,
                'titulo' => 'Beneficios del Ejercicio Regular',
                'categoria' => 'Actividad Física',
                'contenido' => 'Realizar actividad física regular mejora la salud cardiovascular, fortalece los músculos y huesos, y contribuye significativamente al bienestar mental. Se recomienda al menos 30 minutos de ejercicio moderado 5 días a la semana.',
                'autor' => 'Dr. Carlos Rodríguez',
                'fecha' => '2024-01-10',
                'imagen' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=300&fit=crop'
            ],
            [
                'id' => 3,
                'titulo' => 'Alimentación Saludable',
                'categoria' => 'Alimentación',
                'contenido' => 'Una dieta equilibrada rica en frutas, verduras, proteínas magras y granos enteros es esencial para mantener una buena salud. Los colores en los alimentos indican diferentes nutrientes que el cuerpo necesita.',
                'autor' => 'Dra. Ana López',
                'fecha' => '2024-01-08',
                'imagen' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=400&h=300&fit=crop'
            ]
        ];

        $categorias = ['Alimentación', 'Actividad Física', 'Bienestar Mental', 'Prevención Médica', 'Hidratación', 'Sueño y Descanso'];
        $consejoActual = 0;

        // Configurar datos para la vista
        $this->view->set('consejos', $consejos);
        $this->view->set('categorias', $categorias);
        $this->view->set('consejoActual', $consejoActual);

        // Usar el layout base con la vista de consejos
        $this->renderWithLayout('consejos');
    }

    /**
     * Vista para Dar/Crear Consejos
     */
    public function dar_consejos() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Procesar formulario si se envió
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->procesarConsejo();
        }

        // Categorías disponibles
        $categorias = [
            'Alimentación', 'Actividad Física', 'Bienestar Mental',
            'Prevención Médica', 'Hidratación', 'Sueño y Descanso'
        ];

        // Configurar datos para la vista
        $this->view->set('categorias', $categorias);
        $this->view->set('formData', $_POST ?? []);
        $this->view->set('errors', $_SESSION['form_errors'] ?? []);

        // Limpiar errores de sesión
        if (isset($_SESSION['form_errors'])) {
            unset($_SESSION['form_errors']);
        }

        // Usar el layout base con la vista de dar consejos
        $this->renderWithLayout('dar_consejos');
    }

    /**
     * Procesar la creación de un nuevo consejo
     */
    private function procesarConsejo() {
        try {
            // Validar datos requeridos
            $errores = [];

            if (empty(trim($_POST['titulo'] ?? ''))) {
                $errores[] = 'El título es obligatorio';
            }

            if (empty(trim($_POST['categoria'] ?? ''))) {
                $errores[] = 'La categoría es obligatoria';
            }

            if (empty(trim($_POST['contenido'] ?? ''))) {
                $errores[] = 'El contenido es obligatorio';
            }

            if (!empty($errores)) {
                $_SESSION['form_errors'] = $errores;
                $_SESSION['error'] = 'Por favor corrige los errores del formulario';
                header('Location: ' . BASE_URL . 'doctor/dar_consejos');
                exit;
            }

            // Aquí iría el código para guardar en la base de datos
            // Por ahora, solo simulamos que se guardó correctamente

            $_SESSION['success'] = 'Consejo creado exitosamente';
            header('Location: ' . BASE_URL . 'doctor/consejos');
            exit;

        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al crear el consejo: ' . $e->getMessage();
            header('Location: ' . BASE_URL . 'doctor/dar_consejos');
            exit;
        }
    }

    /**
     * Vista de Inicio/Dashboard Médico
     */
    public function inicio() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Datos del dashboard
        $totalPacientes = 150;
        $citasHoy = 8;
        $mensajesPendientes = 3;

        // Configurar datos para la vista usando el sistema de vistas base
        $this->view->set('totalPacientes', $totalPacientes);
        $this->view->set('citasHoy', $citasHoy);
        $this->view->set('mensajesPendientes', $mensajesPendientes);

        // Usar el layout base con la vista de inicio
        $this->renderWithLayout('InMed');
    }

    /**
     * Vista de Gestión de Pacientes
     */
    public function pacientes() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Datos de ejemplo para pacientes (en producción vendrían de la base de datos)
        $pacientes = [
            [
                'id' => 1,
                'nombre' => 'Ana García',
                'edad' => 28,
                'email' => 'ana.garcia@email.com',
                'telefono' => '+1234567890',
                'ultima_visita' => '2024-01-15',
                'estado' => 'Activo'
            ],
            [
                'id' => 2,
                'nombre' => 'Carlos Rodríguez',
                'edad' => 35,
                'email' => 'carlos.rodriguez@email.com',
                'telefono' => '+1234567891',
                'ultima_visita' => '2024-01-10',
                'estado' => 'Activo'
            ],
            [
                'id' => 3,
                'nombre' => 'María López',
                'edad' => 42,
                'email' => 'maria.lopez@email.com',
                'telefono' => '+1234567892',
                'ultima_visita' => '2024-01-08',
                'estado' => 'Inactivo'
            ]
        ];

        // Configurar datos para la vista
        $this->view->set('pacientes', $pacientes);
        $this->view->set('totalPacientes', count($pacientes));

        // Usar el layout base con la vista de pacientes
        $this->renderWithLayout('pacientes');
    }

    /**
     * Vista de Agenda y Consultas
     */
    public function consultas() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Datos de ejemplo para consultas (en producción vendrían de la base de datos)
        $consultas = [
            [
                'id' => 1,
                'paciente' => 'Ana García',
                'fecha' => '2024-01-20',
                'hora' => '09:00',
                'tipo' => 'Consulta General',
                'estado' => 'Confirmada',
                'notas' => 'Revisión de rutina'
            ],
            [
                'id' => 2,
                'paciente' => 'Carlos Rodríguez',
                'fecha' => '2024-01-20',
                'hora' => '10:30',
                'tipo' => 'Seguimiento',
                'estado' => 'Pendiente',
                'notas' => 'Control de hipertensión'
            ],
            [
                'id' => 3,
                'paciente' => 'María López',
                'fecha' => '2024-01-21',
                'hora' => '14:00',
                'tipo' => 'Consulta Especializada',
                'estado' => 'Cancelada',
                'notas' => 'Dermatología'
            ]
        ];

        // Configurar datos para la vista
        $this->view->set('consultas', $consultas);
        $this->view->set('totalConsultas', count($consultas));
        $this->view->set('consultasHoy', 8);

        // Usar el layout base con la vista de consultas
        $this->renderWithLayout('consultas');
    }

    /**
     * Vista de Gestión de Medicamentos
     */
    public function medicamentos() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Datos de ejemplo para medicamentos (en producción vendrían de la base de datos)
        $medicamentos = [
            [
                'id' => 1,
                'nombre' => 'Paracetamol 500mg',
                'principio_activo' => 'Paracetamol',
                'presentacion' => 'Tabletas',
                'stock' => 150,
                'precio' => 25.50,
                'categoria' => 'Analgésicos'
            ],
            [
                'id' => 2,
                'nombre' => 'Ibuprofeno 400mg',
                'principio_activo' => 'Ibuprofeno',
                'presentacion' => 'Tabletas',
                'stock' => 75,
                'precio' => 32.00,
                'categoria' => 'Antiinflamatorios'
            ],
            [
                'id' => 3,
                'nombre' => 'Amoxicilina 500mg',
                'principio_activo' => 'Amoxicilina',
                'presentacion' => 'Cápsulas',
                'stock' => 45,
                'precio' => 85.00,
                'categoria' => 'Antibióticos'
            ]
        ];

        // Configurar datos para la vista
        $this->view->set('medicamentos', $medicamentos);
        $this->view->set('totalMedicamentos', count($medicamentos));

        // Usar el layout base con la vista de medicamentos
        $this->renderWithLayout('medicamentos');
    }

    /**
     * Vista de Gestión de Recetas
     */
    public function recetas() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Datos de ejemplo para recetas (en producción vendrían de la base de datos)
        $recetas = [
            [
                'id' => 1,
                'paciente' => 'Ana García',
                'fecha' => '2024-01-15',
                'medicamentos' => 'Paracetamol 500mg - 1 cada 8 horas por 5 días',
                'estado' => 'Activa',
                'doctor' => 'Dr. Juan Pérez'
            ],
            [
                'id' => 2,
                'paciente' => 'Carlos Rodríguez',
                'fecha' => '2024-01-10',
                'medicamentos' => 'Ibuprofeno 400mg - 1 cada 12 horas por 7 días',
                'estado' => 'Completada',
                'doctor' => 'Dr. Juan Pérez'
            ],
            [
                'id' => 3,
                'paciente' => 'María López',
                'fecha' => '2024-01-08',
                'medicamentos' => 'Amoxicilina 500mg - 1 cada 8 horas por 10 días',
                'estado' => 'Activa',
                'doctor' => 'Dr. Juan Pérez'
            ]
        ];

        // Configurar datos para la vista
        $this->view->set('recetas', $recetas);
        $this->view->set('totalRecetas', count($recetas));

        // Usar el layout base con la vista de recetas
        $this->renderWithLayout('recetas');
    }

    /**
     * Vista de Mensajes
     */
    public function mensajes() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Datos de ejemplo para mensajes (en producción vendrían de la base de datos)
        $mensajes = [
            [
                'id' => 1,
                'remitente' => 'Ana García',
                'asunto' => 'Consulta sobre medicamento',
                'fecha' => '2024-01-15 14:30',
                'estado' => 'No leído',
                'mensaje' => 'Hola doctor, tengo dudas sobre el medicamento que me recetó...'
            ],
            [
                'id' => 2,
                'remitente' => 'Carlos Rodríguez',
                'asunto' => 'Solicitud de cita',
                'fecha' => '2024-01-15 10:15',
                'estado' => 'Leído',
                'mensaje' => 'Buen día doctor, me gustaría agendar una cita para la próxima semana...'
            ],
            [
                'id' => 3,
                'remitente' => 'María López',
                'asunto' => 'Resultados de análisis',
                'fecha' => '2024-01-14 16:45',
                'estado' => 'Respondido',
                'mensaje' => 'Doctor, ¿ya tiene los resultados de mis análisis de sangre?...'
            ]
        ];

        // Configurar datos para la vista
        $this->view->set('mensajes', $mensajes);
        $this->view->set('mensajesNoLeidos', count(array_filter($mensajes, fn($m) => $m['estado'] === 'No leído')));
        $this->view->set('mensajesTotal', count($mensajes));

        // Usar el layout base con la vista de mensajes
        $this->renderWithLayout('mensajes');
    }

    /**
     * Vista de Historial Clínico del Paciente
     */
    public function historial_clinico() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Datos de ejemplo para el paciente (en producción vendrían de la base de datos)
        $paciente = [
            'id' => 'R0101',
            'nombre' => 'Luis Gonzalez',
            'fecha_cita' => '25-10-2024',
            'check_in' => '20-10-2024',
            'check_out' => '25-10-2024',
            'contacto_emergencia' => 'Km 40 Lurin',
            'email' => 'Luis@gmail.com',
            'telefono' => '987686546'
        ];

        // Historial médico del paciente
        $historial = [
            [
                'id' => 1,
                'fecha' => '15-10-2024',
                'diagnostico' => 'Hipertensión',
                'descripcion' => 'El px presenta hipertensión tras toma de S.V.',
                'tratamiento' => 'Checar P.A una vez al día durante 7 días',
                'signos_vitales' => [
                    'presion_arterial' => '150/95 mmHg',
                    'frecuencia_cardiaca' => '78 bpm',
                    'temperatura' => '36.5°C',
                    'peso' => '75 kg'
                ],
                'estado' => 'Activo'
            ],
            [
                'id' => 2,
                'fecha' => '08-09-2024',
                'diagnostico' => 'Amigdalitis',
                'descripcion' => 'Px con febrícula e inflamación en garganta',
                'tratamiento' => 'Loratadina 1 c/24 hrs por 3 días. Paracetamol 1 c/8 hrs',
                'signos_vitales' => [
                    'presion_arterial' => '130/85 mmHg',
                    'frecuencia_cardiaca' => '82 bpm',
                    'temperatura' => '38.2°C',
                    'peso' => '74 kg'
                ],
                'estado' => 'Completado'
            ],
            [
                'id' => 3,
                'fecha' => '20-08-2024',
                'diagnostico' => 'Control de rutina',
                'descripcion' => 'Consulta de seguimiento para control de hipertensión',
                'tratamiento' => 'Continuar con Losartán 50mg/día',
                'signos_vitales' => [
                    'presion_arterial' => '135/88 mmHg',
                    'frecuencia_cardiaca' => '76 bpm',
                    'temperatura' => '36.8°C',
                    'peso' => '75 kg'
                ],
                'estado' => 'Completado'
            ]
        ];

        // Información del doctor
        $doctor = [
            'nombre' => 'Dr. Juan Pérez',
            'cedula' => 'CD8957552',
            'especialidad' => 'Médico cirujano',
            'telefono' => '987687657',
            'email' => 'juan.perez@healthmate.com',
            'direccion' => 'Chorillos'
        ];

        // Configurar datos para la vista
        $this->view->set('paciente', $paciente);
        $this->view->set('historial', $historial);
        $this->view->set('doctor', $doctor);

        // Usar el layout base con la vista de historial clínico
        $this->renderWithLayout('historial_clinico');
    }

    /**
     * Alias para Historial Clínico (para compatibilidad con URLs antiguas)
     */
    public function historial() {
        // Redirigir a la vista correcta de historial clínico
        $this->historial_clinico();
    }

    /**
     * Vista de Perfil del Paciente
     */
    public function perfil() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Datos de ejemplo para el perfil del paciente (en producción vendrían de la base de datos)
        $paciente = [
            'id' => 'R0101',
            'nombre' => 'Luis Gonzalez',
            'fecha_nacimiento' => '15-05-1990',
            'edad' => 34,
            'genero' => 'Masculino',
            'tipo_sangre' => 'O+',
            'peso' => 75,
            'altura' => 175,
            'alergias' => 'Ninguna conocida',
            'enfermedades_cronicas' => 'Hipertensión',
            'medicamentos_actuales' => 'Losartán 50mg - 1 vez al día',
            'contacto_emergencia' => 'María Gonzalez (Hermana) - 987654321',
            'email' => 'Luis@gmail.com',
            'telefono' => '987686546',
            'direccion' => 'Km 40 Lurin, Lima',
            'fecha_registro' => '15-03-2024',
            'ultima_visita' => '15-10-2024'
        ];

        // Configurar datos para la vista
        $this->view->set('paciente', $paciente);

        // Usar el layout base con la vista de perfil
        $this->renderWithLayout('perfil');
    }

    /**
     * Vista para Crear Nueva Cita
     */
    public function nueva_cita() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Procesar formulario si se envió
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->procesarNuevaCita();
        }

        // Pacientes disponibles para la cita
        $pacientes = [
            ['id' => 1, 'nombre' => 'Ana García'],
            ['id' => 2, 'nombre' => 'Carlos Rodríguez'],
            ['id' => 3, 'nombre' => 'María López'],
            ['id' => 4, 'nombre' => 'Luis Gonzalez']
        ];

        // Configurar datos para la vista
        $this->view->set('pacientes', $pacientes);
        $this->view->set('formData', $_POST ?? []);
        $this->view->set('errors', $_SESSION['form_errors'] ?? []);

        // Limpiar errores de sesión
        if (isset($_SESSION['form_errors'])) {
            unset($_SESSION['form_errors']);
        }

        // Usar el layout base con la vista de nueva cita
        $this->renderWithLayout('nueva_cita');
    }

    /**
     * Procesar la creación de una nueva cita
     */
    private function procesarNuevaCita() {
        try {
            // Validar datos requeridos
            $errores = [];

            if (empty(trim($_POST['paciente'] ?? ''))) {
                $errores[] = 'Debe seleccionar un paciente';
            }

            if (empty(trim($_POST['fecha'] ?? ''))) {
                $errores[] = 'La fecha es obligatoria';
            }

            if (empty(trim($_POST['hora'] ?? ''))) {
                $errores[] = 'La hora es obligatoria';
            }

            if (empty(trim($_POST['tipo'] ?? ''))) {
                $errores[] = 'El tipo de consulta es obligatorio';
            }

            if (!empty($errores)) {
                $_SESSION['form_errors'] = $errores;
                $_SESSION['error'] = 'Por favor corrige los errores del formulario';
                header('Location: ' . BASE_URL . 'doctor/consultas/nueva?debug=1');
                exit;
            }

            // Aquí iría el código para guardar en la base de datos
            // Por ahora, solo simulamos que se guardó correctamente

            $_SESSION['success'] = 'Cita creada exitosamente';
            header('Location: ' . BASE_URL . 'doctor/consultas?debug=1');
            exit;

        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al crear la cita: ' . $e->getMessage();
            header('Location: ' . BASE_URL . 'doctor/consultas/nueva?debug=1');
            exit;
        }
    }

    /**
     * Vista para Crear Nueva Receta
     */
    public function nueva_receta() {
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        // Procesar formulario si se envió
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->procesarNuevaReceta();
        }

        // Pacientes disponibles
        $pacientes = [
            ['id' => 1, 'nombre' => 'Ana García'],
            ['id' => 2, 'nombre' => 'Carlos Rodríguez'],
            ['id' => 3, 'nombre' => 'María López'],
            ['id' => 4, 'nombre' => 'Luis Gonzalez']
        ];

        // Medicamentos disponibles
        $medicamentos = [
            'Paracetamol 500mg',
            'Ibuprofeno 400mg',
            'Amoxicilina 500mg',
            'Losartán 50mg',
            'Omeprazol 20mg'
        ];

        // Configurar datos para la vista
        $this->view->set('pacientes', $pacientes);
        $this->view->set('medicamentos', $medicamentos);
        $this->view->set('formData', $_POST ?? []);
        $this->view->set('errors', $_SESSION['form_errors'] ?? []);

        // Limpiar errores de sesión
        if (isset($_SESSION['form_errors'])) {
            unset($_SESSION['form_errors']);
        }

        // Usar el layout base con la vista de nueva receta
        $this->renderWithLayout('nueva_receta');
    }

    /**
     * Procesar la creación de una nueva receta
     */
    private function procesarNuevaReceta() {
        try {
            // Validar datos requeridos
            $errores = [];

            if (empty(trim($_POST['paciente'] ?? ''))) {
                $errores[] = 'Debe seleccionar un paciente';
            }

            if (empty(trim($_POST['medicamentos'] ?? ''))) {
                $errores[] = 'Debe especificar los medicamentos';
            }

            if (!empty($errores)) {
                $_SESSION['form_errors'] = $errores;
                $_SESSION['error'] = 'Por favor corrige los errores del formulario';
                header('Location: ' . BASE_URL . 'doctor/recetas/nueva?debug=1');
                exit;
            }

            // Aquí iría el código para guardar en la base de datos
            // Por ahora, solo simulamos que se guardó correctamente

            $_SESSION['success'] = 'Receta creada exitosamente';
            header('Location: ' . BASE_URL . 'doctor/recetas?debug=1');
            exit;

        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al crear la receta: ' . $e->getMessage();
            header('Location: ' . BASE_URL . 'doctor/recetas/nueva?debug=1');
            exit;
        }
    }

    /**
     * Método para renderizar con el layout base
     */
    private function renderWithLayout($viewName) {
        // Configurar variables para el layout
        $data = [
            'title' => ucwords(str_replace('_', ' ', $viewName)) . ' - HealthMate',
            'pageTitle' => strtoupper(str_replace('_', ' ', $viewName)),
        ];

        // Obtener las variables del sistema de vistas base
        $viewData = [];
        $viewData['totalPacientes'] = $this->view->get('totalPacientes');
        $viewData['citasHoy'] = $this->view->get('citasHoy');
        $viewData['mensajesPendientes'] = $this->view->get('mensajesPendientes');
        $viewData['estadisticas'] = $this->view->get('estadisticas');
        $viewData['datosGraficos'] = $this->view->get('datosGraficos');
        $viewData['consejos'] = $this->view->get('consejos');
        $viewData['categorias'] = $this->view->get('categorias');
        $viewData['consejoActual'] = $this->view->get('consejoActual');
        $viewData['formData'] = $this->view->get('formData');
        $viewData['errors'] = $this->view->get('errors');
        $viewData['pacientes'] = $this->view->get('pacientes');
        $viewData['consultas'] = $this->view->get('consultas');
        $viewData['medicamentos'] = $this->view->get('medicamentos');
        $viewData['recetas'] = $this->view->get('recetas');
        $viewData['mensajes'] = $this->view->get('mensajes');
        $viewData['paciente'] = $this->view->get('paciente');
        $viewData['historial'] = $this->view->get('historial');
        $viewData['doctor'] = $this->view->get('doctor');

        // Obtener el contenido de la vista específica
        ob_start();
        // Hacer disponibles las variables del controlador en la vista
        extract($viewData, EXTR_SKIP);

        // Intentar cargar el archivo con extensión .view.php primero, luego .php
        $viewFile = 'views/doctor/' . $viewName . '.view.php';
        if (!file_exists($viewFile)) {
            $viewFile = 'views/doctor/' . $viewName . '.php';
        }

        include $viewFile;
        $content = ob_get_clean();

        // Hacer disponibles las variables del layout
        extract($data, EXTR_SKIP);

        // Incluir el layout base
        include 'views/doctor/layout.php';
    }
}
?>