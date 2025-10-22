<?php
// Historial Clínico Standalone para testing
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Simular las variables que usaría el controlador
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

$doctor = [
    'nombre' => 'Dr. Juan Pérez',
    'cedula' => 'CD8957552',
    'especialidad' => 'Médico cirujano',
    'telefono' => '987687657',
    'email' => 'juan.perez@healthmate.com',
    'direccion' => 'Chorillos'
];

// Configurar variables para el layout
$title = 'Historial Clínico - HealthMate';
$pageTitle = 'HISTORIAL CLÍNICO';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-red-500 to-pink-600 rounded-lg shadow-lg p-8 text-white mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">📋 Historial Clínico</h1>
                <p class="text-red-100 text-lg">Historial médico completo del paciente</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-file-medical-alt text-6xl text-red-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="bg-white rounded-lg shadow-sm mb-6">
        <div class="border-b border-gray-200">
            <nav class="flex space-x-8 px-6" aria-label="Tabs">
                <a href="#" class="border-red-500 text-red-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    <i class="fas fa-file-medical mr-2"></i>Historial Clínico
                </a>
                <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/HealthMate.S.V/doctor/perfil?debug=1'; ?>" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    <i class="fas fa-user mr-2"></i>Perfil del Paciente
                </a>
                <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/HealthMate.S.V/doctor/consultas?debug=1'; ?>" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    <i class="fas fa-calendar-alt mr-2"></i>Consultas
                </a>
                <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/HealthMate.S.V/doctor/recetas?debug=1'; ?>" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    <i class="fas fa-prescription-bottle mr-2"></i>Recetas
                </a>
            </nav>
        </div>
    </div>

    <!-- Información del paciente -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Datos básicos del paciente -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="text-center mb-6">
                    <div class="w-32 h-32 mx-auto mb-4 bg-gradient-to-br from-red-500 to-pink-600 rounded-full flex items-center justify-center">
                        <span class="text-3xl font-bold text-white">
                            <?php
                            $iniciales = '';
                            if (!empty($paciente['nombre'])) {
                                $nombres = explode(' ', $paciente['nombre']);
                                $iniciales = strtoupper(substr($nombres[0], 0, 1));
                                if (isset($nombres[1])) {
                                    $iniciales .= strtoupper(substr($nombres[1], 0, 1));
                                }
                            }
                            echo $iniciales ?: 'PG';
                            ?>
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($paciente['nombre']); ?></h3>
                    <p class="text-gray-600">ID: <?php echo htmlspecialchars($paciente['id']); ?></p>
                </div>

                <!-- Información básica -->
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Check In:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($paciente['check_in']); ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Check Out:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($paciente['check_out']); ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Teléfono:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($paciente['telefono']); ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="font-semibold text-gray-600">Email:</span>
                        <span class="text-gray-800 text-sm"><?php echo htmlspecialchars($paciente['email']); ?></span>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="mt-6 space-y-2">
                    <button onclick="location.href='<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/HealthMate.S.V/doctor/perfil?debug=1'; ?>'"
                            class="w-full flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition duration-200">
                        <i class="fas fa-user mr-2"></i>Ver Perfil Completo
                    </button>
                    <button onclick="location.href='<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/HealthMate.S.V/doctor/consultas/nueva?debug=1'; ?>'"
                            class="w-full flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition duration-200">
                        <i class="fas fa-calendar-plus mr-2"></i>Nueva Consulta
                    </button>
                    <button onclick="location.href='<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/HealthMate.S.V/doctor/recetas/nueva?debug=1'; ?>'"
                            class="w-full flex items-center justify-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium transition duration-200">
                        <i class="fas fa-prescription-bottle mr-2"></i>Nueva Receta
                    </button>
                </div>
            </div>
        </div>

        <!-- Información del doctor y contacto -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h4 class="text-lg font-bold text-gray-800 mb-4 text-center">👨‍⚕️ Información del Doctor</h4>

                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Doctor:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($doctor['nombre']); ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Cédula:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($doctor['cedula']); ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Especialidad:</span>
                        <span class="text-gray-800 text-sm"><?php echo htmlspecialchars($doctor['especialidad']); ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Teléfono:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($doctor['telefono']); ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="font-semibold text-gray-600">Email:</span>
                        <span class="text-gray-800 text-sm"><?php echo htmlspecialchars($doctor['email']); ?></span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <h4 class="text-lg font-bold text-gray-800 mb-4 text-center">📞 Contacto de Emergencia</h4>

                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Dirección:</span>
                        <span class="text-gray-800 text-sm"><?php echo htmlspecialchars($paciente['contacto_emergencia']); ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Teléfono:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($paciente['telefono']); ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="font-semibold text-gray-600">Email:</span>
                        <span class="text-gray-800 text-sm"><?php echo htmlspecialchars($paciente['email']); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historial médico -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-bold text-gray-800">📋 Historial Médico</h4>
                    <button class="text-red-600 hover:text-red-800">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </div>

                <div class="space-y-3 max-h-96 overflow-y-auto">
                    <?php if (empty($historial)): ?>
                        <div class="text-center text-gray-500 py-8">
                            <i class="fas fa-file-medical-alt text-4xl mb-4 text-gray-300"></i>
                            <p>No hay historial médico registrado.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($historial as $registro): ?>
                            <div class="border border-gray-200 rounded-lg p-4 <?php echo $registro['estado'] === 'Activo' ? 'border-red-300 bg-red-50' : 'border-gray-200'; ?>">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-stethoscope text-red-600 text-sm"></i>
                                        </div>
                                        <div>
                                            <h5 class="font-semibold text-gray-800"><?php echo htmlspecialchars($registro['diagnostico']); ?></h5>
                                            <p class="text-xs text-gray-500"><?php echo htmlspecialchars($registro['fecha']); ?></p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full <?php echo $registro['estado'] === 'Activo' ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800'; ?>">
                                        <?php echo htmlspecialchars($registro['estado']); ?>
                                    </span>
                                </div>

                                <p class="text-sm text-gray-600 mb-2"><?php echo htmlspecialchars($registro['descripcion']); ?></p>

                                <!-- Signos vitales -->
                                <?php if (isset($registro['signos_vitales'])): ?>
                                    <div class="bg-gray-50 rounded p-2 mb-2">
                                        <p class="text-xs font-semibold text-gray-700 mb-1">Signos Vitales:</p>
                                        <div class="grid grid-cols-2 gap-1 text-xs">
                                            <span>🩺 PA: <?php echo htmlspecialchars($registro['signos_vitales']['presion_arterial']); ?></span>
                                            <span>❤️ FC: <?php echo htmlspecialchars($registro['signos_vitales']['frecuencia_cardiaca']); ?></span>
                                            <span>🌡️ Temp: <?php echo htmlspecialchars($registro['signos_vitales']['temperatura']); ?></span>
                                            <span>⚖️ Peso: <?php echo htmlspecialchars($registro['signos_vitales']['peso']); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <p class="text-xs text-gray-500">💊 <strong>Tratamiento:</strong> <?php echo htmlspecialchars($registro['tratamiento']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla completa del historial -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="bg-red-600 px-6 py-4 text-white">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">📊 Historial Clínico Completo</h3>
                <div class="flex space-x-2">
                    <button class="bg-red-700 hover:bg-red-800 px-3 py-1 rounded text-sm transition duration-200">
                        <i class="fas fa-download mr-1"></i>Exportar PDF
                    </button>
                    <button class="bg-red-700 hover:bg-red-800 px-3 py-1 rounded text-sm transition duration-200">
                        <i class="fas fa-print mr-1"></i>Imprimir
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diagnóstico</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tratamiento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Signos Vitales</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($historial)): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-file-medical-alt text-4xl mb-4 text-gray-300"></i>
                                <p>No hay historial médico registrado para este paciente.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($historial as $registro): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo htmlspecialchars($registro['fecha']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($registro['diagnostico']); ?></div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <?php echo htmlspecialchars($registro['descripcion']); ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <?php echo htmlspecialchars($registro['tratamiento']); ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <?php if (isset($registro['signos_vitales'])): ?>
                                        <div class="text-xs">
                                            <div>🩺 <?php echo htmlspecialchars($registro['signos_vitales']['presion_arterial']); ?></div>
                                            <div>❤️ <?php echo htmlspecialchars($registro['signos_vitales']['frecuencia_cardiaca']); ?></div>
                                            <div>🌡️ <?php echo htmlspecialchars($registro['signos_vitales']['temperatura']); ?></div>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $registro['estado'] === 'Activo' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'; ?>">
                                        <?php echo htmlspecialchars($registro['estado']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-red-600 hover:text-red-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Botones de acción principales -->
    <div class="flex justify-center space-x-4 mt-6">
        <button onclick="location.href='<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/HealthMate.S.V/doctor/perfil?debug=1'; ?>'"
                class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition duration-200">
            <i class="fas fa-user mr-2"></i>Ver Perfil del Paciente
        </button>
        <button onclick="location.href='<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/HealthMate.S.V/doctor/consultas/nueva?debug=1'; ?>'"
                class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition duration-200">
            <i class="fas fa-calendar-plus mr-2"></i>Nueva Consulta
        </button>
        <button onclick="location.href='<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/HealthMate.S.V/doctor/recetas/nueva?debug=1'; ?>'"
                class="px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-semibold transition duration-200">
            <i class="fas fa-prescription-bottle mr-2"></i>Nueva Receta
        </button>
        <button onclick="location.href='<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/HealthMate.S.V/doctor/?debug=1'; ?>'"
                class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-semibold transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Volver al Dashboard
        </button>
    </div>

    <!-- Información de debug -->
    <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <h3 class="font-semibold text-yellow-800 mb-2">🔧 Información de Debug</h3>
        <div class="text-yellow-700 text-sm">
            <p><strong>URL Base:</strong> <?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/HealthMate.S.V/'; ?></p>
            <p><strong>Archivo:</strong> historial_standalone.php (Versión independiente)</p>
            <p><strong>Estado:</strong> Vista renderizada correctamente sin controlador</p>
            <p><strong>Variables:</strong> Todas las variables están definidas estáticamente</p>
        </div>
    </div>
</body>
</html>
