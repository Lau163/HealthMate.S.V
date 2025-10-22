<?php
// Obtener datos del paciente
$paciente = $this->get('paciente') ?? [
    'id' => 'R0101',
    'nombre' => 'Luis Gonzalez',
    'fecha_cita' => '25-10-2020',
    'check_in' => '20-10-2020',
    'check_out' => '25-10-2020',
    'contacto_emergencia' => 'Km 40 Lurin',
    'email' => 'Luis@gmail.com',
    'telefono' => '987686546'
];

// Obtener historial médico
$historial = $this->get('historial') ?? [
    ['id' => 1, 'diagnostico' => 'Hipertension', 'descripcion' => 'El px presenta hipertencion tras toma de S.V.', 'tratamiento' => 'Checar P.A una vez al dia durante 7 dias'],
    ['id' => 2, 'diagnostico' => 'Amigdalitis', 'descripcion' => 'Px con febricula e inflamacion en garganta', 'tratamiento' => 'Loratadina 1 c/24 hrs por 3 dias. Paracetamol 1 c/8 hrs']
];

// Información del doctor
$doctor = $this->get('doctor') ?? [
    'nombre' => 'Jhon Delgado',
    'cedula' => 'CD8957552',
    'especialidad' => 'Medico cirujano',
    'telefono' => '987687657',
    'email' => 'jhontlv@gmail.com',
    'direccion' => 'Chorillos'
];

// Configurar variables para el layout
$title = 'Historial Clínico - HealthMate';
$pageTitle = 'HISTORIAL CLÍNICO';
?>

<!-- Contenido de la página -->
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Header de la página -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Historial Clínico del Paciente</h2>
            <p class="text-sm text-gray-500 mt-1">Información detallada del paciente y su historial médico</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-2">
            <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                <i class="fas fa-edit mr-2"></i>Editar Paciente
            </button>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                <i class="fas fa-print mr-2"></i>Imprimir
            </button>
        </div>
    </div>

    <!-- Información del paciente -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Foto y datos básicos -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[20px] shadow-lg border border-gray-200 p-6 text-center">
                <div class="w-36 h-36 mx-auto mb-4 bg-stone-300 rounded-full border-2 border-gray-300 flex items-center justify-center">
                    <span class="text-4xl font-bold text-gray-600">
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

                <!-- Información básica -->
                <div class="space-y-3 text-left">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-semibold text-gray-600">ID:</span>
                        <span class="text-gray-800"><?php echo htmlspecialchars($paciente['id']); ?></span>
                    </div>
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
            </div>
        </div>

        <!-- Información del doctor -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[20px] shadow-lg border border-gray-200 p-6">
                <h4 class="text-lg font-bold text-gray-800 mb-4 text-center">Información del Doctor</h4>

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
        </div>

        <!-- Contacto de emergencia -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[20px] shadow-lg border border-gray-200 p-6">
                <h4 class="text-lg font-bold text-gray-800 mb-4 text-center">Contacto de Emergencia</h4>

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
    </div>

    <!-- Historial médico -->
    <div class="bg-white rounded-[20px] shadow-lg border border-gray-200 overflow-hidden">
        <div class="bg-slate-300 px-6 py-4 border-b border-gray-200">
            <div class="grid grid-cols-12 gap-4 text-sm font-black text-gray-600">
                <div class="col-span-1">#</div>
                <div class="col-span-3">DIAGNÓSTICO</div>
                <div class="col-span-4">DESCRIPCIÓN</div>
                <div class="col-span-4">TRATAMIENTO</div>
            </div>
        </div>

        <div class="divide-y divide-gray-200">
            <?php if (empty($historial)): ?>
                <div class="px-6 py-8 text-center text-gray-500">
                    <i class="fas fa-file-medical-alt text-4xl mb-4 text-gray-300"></i>
                    <p>No hay historial médico registrado para este paciente.</p>
                </div>
            <?php else: ?>
                <?php foreach ($historial as $registro): ?>
                    <div class="px-6 py-4">
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-1 text-gray-800 font-medium"><?php echo htmlspecialchars($registro['id']); ?></div>
                            <div class="col-span-3 text-gray-800 font-medium"><?php echo htmlspecialchars($registro['diagnostico']); ?></div>
                            <div class="col-span-4 text-gray-600 text-sm"><?php echo htmlspecialchars($registro['descripcion']); ?></div>
                            <div class="col-span-4 text-gray-600 text-sm"><?php echo htmlspecialchars($registro['tratamiento']); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Acciones -->
    <div class="mt-8 flex justify-center space-x-4">
        <button class="bg-teal-700 hover:bg-teal-800 text-white px-8 py-3 rounded-lg font-bold transition duration-200">
            <i class="fas fa-save mr-2"></i>Guardar Cambios
        </button>
        <button class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-bold transition duration-200">
            <i class="fas fa-times mr-2"></i>Cerrar
        </button>
    </div>
</div>
