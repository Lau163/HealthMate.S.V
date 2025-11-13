<?php
// Configurar variables para el layout
$title = 'Perfil del Paciente - HealthMate';
$pageTitle = 'PERFIL DEL PACIENTE';

// Obtener datos del paciente desde el controlador
$paciente = $paciente ?? [
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
?>

<!-- Perfil del Paciente Content -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Perfil del Paciente</h1>
                <p class="text-indigo-100 text-lg">Información completa y detallada del paciente</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-user-circle text-6xl text-indigo-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Información principal del paciente -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Foto y datos básicos -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <div class="w-32 h-32 mx-auto mb-4 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
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
                <h3 class="text-2xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($paciente['nombre']); ?></h3>
                <p class="text-gray-600 mb-4">ID: <?php echo htmlspecialchars($paciente['id']); ?></p>

                <!-- Información básica -->
                <div class="space-y-3 text-left">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Edad:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($paciente['edad']); ?> años</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Género:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($paciente['genero']); ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Tipo de Sangre:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($paciente['tipo_sangre']); ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">Peso:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($paciente['peso']); ?> kg</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="font-semibold text-gray-600">Altura:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($paciente['altura']); ?> cm</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información médica -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">📋 Información Médica</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Información médica izquierda -->
                    <div class="space-y-4">
                        <div class="p-4 bg-red-50 rounded-lg border-l-4 border-red-500">
                            <h4 class="font-semibold text-red-800 mb-2">🚨 Alergias</h4>
                            <p class="text-red-700 text-sm"><?php echo htmlspecialchars($paciente['alergias']); ?></p>
                        </div>

                        <div class="p-4 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                            <h4 class="font-semibold text-yellow-800 mb-2">🏥 Enfermedades Crónicas</h4>
                            <p class="text-yellow-700 text-sm"><?php echo htmlspecialchars($paciente['enfermedades_cronicas']); ?></p>
                        </div>

                        <div class="p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                            <h4 class="font-semibold text-blue-800 mb-2">💊 Medicamentos Actuales</h4>
                            <p class="text-blue-700 text-sm"><?php echo htmlspecialchars($paciente['medicamentos_actuales']); ?></p>
                        </div>
                    </div>

                    <!-- Información médica derecha -->
                    <div class="space-y-4">
                        <div class="p-4 bg-green-50 rounded-lg border-l-4 border-green-500">
                            <h4 class="font-semibold text-green-800 mb-2">📅 Última Visita</h4>
                            <p class="text-green-700 text-sm"><?php echo htmlspecialchars($paciente['ultima_visita']); ?></p>
                        </div>

                        <div class="p-4 bg-purple-50 rounded-lg border-l-4 border-purple-500">
                            <h4 class="font-semibold text-purple-800 mb-2">📝 Fecha de Registro</h4>
                            <p class="text-purple-700 text-sm"><?php echo htmlspecialchars($paciente['fecha_registro']); ?></p>
                        </div>

                        <div class="p-4 bg-indigo-50 rounded-lg border-l-4 border-indigo-500">
                            <h4 class="font-semibold text-indigo-800 mb-2">🎂 Fecha de Nacimiento</h4>
                            <p class="text-indigo-700 text-sm"><?php echo htmlspecialchars($paciente['fecha_nacimiento']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información de contacto -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">📞 Información de Contacto</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-phone text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Teléfono</p>
                        <p class="text-gray-600"><?php echo htmlspecialchars($paciente['telefono']); ?></p>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-envelope text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Email</p>
                        <p class="text-gray-600"><?php echo htmlspecialchars($paciente['email']); ?></p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-map-marker-alt text-red-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Dirección</p>
                        <p class="text-gray-600"><?php echo htmlspecialchars($paciente['direccion']); ?></p>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-user-friends text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Contacto de Emergencia</p>
                        <p class="text-gray-600"><?php echo htmlspecialchars($paciente['contacto_emergencia']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones disponibles -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">🚀 Acciones Disponibles</h3>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/historial_clinico?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition">
                <i class="fas fa-file-medical text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Historial</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/consultas/nueva?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
                <i class="fas fa-calendar-plus text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nueva Cita</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/recetas/nueva?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition">
                <i class="fas fa-prescription-bottle text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nueva Receta</span>
            </button>

            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/pacientes?debug=1'"
                    class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                <i class="fas fa-users text-2xl text-gray-400 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Ver Pacientes</span>
            </button>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="flex justify-center space-x-4">
        <button class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition duration-200">
            <i class="fas fa-edit mr-2"></i>Editar Perfil
        </button>
        <button onclick="location.href='<?php echo BASE_URL; ?>doctor/historial_clinico?debug=1'"
                class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition duration-200">
            <i class="fas fa-file-medical mr-2"></i>Ver Historial Clínico
        </button>
        <button class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-semibold transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Volver al Dashboard
        </button>
    </div>
</div>
