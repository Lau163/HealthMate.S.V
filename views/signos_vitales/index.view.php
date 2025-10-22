<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signos Vitales | HealthMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-white shadow-lg w-64 h-full">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-emerald-600">HealthMate</h1>
            </div>
            <nav class="mt-6">
                <a href="<?= BASE_URL ?>dashboard" class="block px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-home mr-3"></i>Dashboard
                </a>
                <a href="<?= BASE_URL ?>signos-vitales" class="block px-6 py-3 text-emerald-600 bg-emerald-50">
                    <i class="fas fa-heartbeat mr-3"></i>Signos Vitales
                </a>
                <a href="<?= BASE_URL ?>enfermerx" class="block px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-users mr-3"></i>Pacientes
                </a>
                <a href="<?= BASE_URL ?>auth/logout" class="block px-6 py-3 text-red-600 hover:bg-red-50 mt-auto">
                    <i class="fas fa-sign-out-alt mr-3"></i>Cerrar Sesión
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="flex items-center justify-between px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">Signos Vitales</h2>
                    <button onclick="abrirModalNuevo()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-plus mr-2"></i>Nuevo Registro
                    </button>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                        <?php echo htmlspecialchars($_SESSION['success']); ?>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                        <?php echo htmlspecialchars($_SESSION['error']); ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <!-- Filtros -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Paciente</label>
                            <select name="paciente" class="w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Todos los pacientes</option>
                                <?php foreach ($pacientes as $paciente): ?>
                                    <option value="<?php echo $paciente['Id_Usuario']; ?>"
                                            <?php echo ($filtros['id_paciente'] == $paciente['Id_Usuario']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($paciente['Nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" value="<?php echo $filtros['fecha_inicio']; ?>"
                                   class="w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Fin</label>
                            <input type="date" name="fecha_fin" value="<?php echo $filtros['fecha_fin']; ?>"
                                   class="w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md mr-2">
                                <i class="fas fa-search mr-2"></i>Filtrar
                            </button>
                            <a href="<?= BASE_URL ?>signos-vitales" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Tabla de signos vitales -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <?php if (empty($signos_vitales)): ?>
                        <div class="text-center py-8 text-gray-500">
                            No hay registros de signos vitales para mostrar.
                        </div>
                    <?php else: ?>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paciente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">FC</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">FR</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Temp</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Presión</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SpO2</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($signos_vitales as $registro): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center mr-3">
                                                    <span class="text-emerald-600 font-medium">
                                                        <?php echo strtoupper(substr($registro['nombre_paciente'], 0, 1)); ?>
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <?php echo htmlspecialchars($registro['nombre_paciente']); ?>
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        <?php echo htmlspecialchars($registro['email_paciente']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?php echo date('d/m/Y H:i', strtotime($registro['fecha_registro'])); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?php echo $registro['frecuencia_cardiaca'] ? $registro['frecuencia_cardiaca'] . ' lpm' : '-'; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?php echo $registro['frecuencia_respiratoria'] ? $registro['frecuencia_respiratoria'] . ' rpm' : '-'; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?php echo $registro['temperatura'] ? $registro['temperatura'] . ' °C' : '-'; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?php
                                            if ($registro['presion_sistolica'] && $registro['presion_diastolica']) {
                                                echo $registro['presion_sistolica'] . '/' . $registro['presion_diastolica'] . ' mmHg';
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?php echo $registro['saturacion_oxigeno'] ? $registro['saturacion_oxigeno'] . '%' : '-'; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="verRegistro(<?php echo htmlspecialchars(json_encode($registro)); ?>)"
                                                    class="text-emerald-600 hover:text-emerald-900 mr-3">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button onclick="editarRegistro(<?php echo $registro['id_registro']; ?>)"
                                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="eliminarRegistro(<?php echo $registro['id_registro']; ?>, '<?php echo htmlspecialchars($registro['nombre_paciente']); ?>')"
                                                    class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Nuevo Registro -->
    <div id="nuevoRegistroModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-xl font-semibold text-gray-800">Nuevo Registro de Signos Vitales</h3>
                <button onclick="cerrarModalNuevo()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <form id="formNuevoRegistro" action="<?= BASE_URL ?>signos-vitales/guardar" method="POST" class="mt-4">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Paciente *</label>
                        <select name="id_paciente" required class="w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Seleccionar paciente...</option>
                            <?php foreach ($pacientes as $paciente): ?>
                                <option value="<?php echo $paciente['Id_Usuario']; ?>">
                                    <?php echo htmlspecialchars($paciente['Nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha y Hora</label>
                        <input type="datetime-local" name="fecha_registro"
                               value="<?php echo date('Y-m-d\TH:i'); ?>"
                               class="w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Frecuencia Cardíaca (lpm)</label>
                        <input type="number" name="frecuencia_cardiaca" min="0" max="300"
                               class="w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Frecuencia Respiratoria (rpm)</label>
                        <input type="number" name="frecuencia_respiratoria" min="0" max="100"
                               class="w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Temperatura (°C)</label>
                        <input type="number" name="temperatura" step="0.1" min="30" max="45"
                               class="w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Presión Sistólica (mmHg)</label>
                        <input type="number" name="presion_sistolica" min="0" max="300"
                               class="w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Presión Diastólica (mmHg)</label>
                        <input type="number" name="presion_diastolica" min="0" max="200"
                               class="w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Saturación de Oxígeno (%)</label>
                    <input type="number" name="saturacion_oxigeno" min="0" max="100"
                           class="w-full rounded-md border-gray-300 shadow-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Observaciones</label>
                    <textarea name="observaciones" rows="3"
                              class="w-full rounded-md border-gray-300 shadow-sm"
                              placeholder="Observaciones adicionales..."></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="cerrarModalNuevo()"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md">
                        Guardar Registro
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function abrirModalNuevo() {
            document.getElementById('nuevoRegistroModal').classList.remove('hidden');
        }

        function cerrarModalNuevo() {
            document.getElementById('nuevoRegistroModal').classList.add('hidden');
        }

        function verRegistro(registro) {
            const detalles = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Paciente</p>
                        <p class="font-medium">${registro.nombre_paciente}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Fecha de Registro</p>
                        <p class="font-medium">${new Date(registro.fecha_registro).toLocaleString()}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Frecuencia Cardíaca</p>
                        <p class="font-medium">${registro.frecuencia_cardiaca || 'No registrado'} lpm</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Frecuencia Respiratoria</p>
                        <p class="font-medium">${registro.frecuencia_respiratoria || 'No registrado'} rpm</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Temperatura</p>
                        <p class="font-medium">${registro.temperatura || 'No registrado'} °C</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Presión Arterial</p>
                        <p class="font-medium">${registro.presion_sistolica && registro.presion_diastolica ?
                            registro.presion_sistolica + '/' + registro.presion_diastolica + ' mmHg' : 'No registrado'}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Saturación de Oxígeno</p>
                        <p class="font-medium">${registro.saturacion_oxigeno || 'No registrado'}%</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500">Observaciones</p>
                        <p class="font-medium">${registro.observaciones || 'Sin observaciones'}</p>
                    </div>
                </div>
            `;

            document.getElementById('detallesRegistro').innerHTML = detalles;
            abrirModal('verRegistroModal');
        }

        function editarRegistro(idRegistro) {
            // Aquí puedes implementar la lógica para editar
            alert('Función de editar - ID: ' + idRegistro);
        }

        function eliminarRegistro(idRegistro, nombrePaciente) {
            if (confirm(`¿Estás seguro de que deseas eliminar el registro de ${nombrePaciente}?`)) {
                // Aquí puedes implementar la lógica para eliminar
                alert('Función de eliminar - ID: ' + idRegistro);
            }
        }

        function abrirModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function cerrarModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Cerrar modal al hacer clic fuera
        document.getElementById('nuevoRegistroModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>

    <!-- Modal Ver Registro -->
    <div id="verRegistroModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-xl font-semibold text-gray-800">Detalles del Registro</h3>
                <button onclick="cerrarModal('verRegistroModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <div class="mt-4" id="detallesRegistro">
                <!-- Los detalles se cargarán aquí dinámicamente -->
            </div>

            <div class="mt-6 flex justify-end">
                <button onclick="cerrarModal('verRegistroModal')"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</body>
</html>
