<?php
// Configurar variables para el layout
$title = 'Nueva Cita - HealthMate';
$pageTitle = 'NUEVA CITA';

// Obtener datos desde el controlador
$pacientes = $pacientes ?? [];
$formData = $formData ?? [];
$errors = $errors ?? [];
?>

<!-- Nueva Cita Content -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">📅 Nueva Cita</h1>
                <p class="text-green-100 text-lg">Programa una nueva consulta médica</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-calendar-plus text-6xl text-green-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Formulario de Nueva Cita -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Información de la Cita</h2>
                <p class="text-gray-600">Complete los datos para programar la consulta</p>
            </div>
            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/consultas?debug=1'"
                    class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Volver a Consultas
            </button>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                    <div>
                        <h3 class="font-semibold text-red-800">Errores en el formulario</h3>
                        <ul class="text-red-700 text-sm mt-1">
                            <?php foreach ($errors as $error): ?>
                                <li>• <?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo BASE_URL; ?>doctor/consultas/nueva?debug=1" class="space-y-6">
            <!-- Información del Paciente -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Paciente <span class="text-red-500">*</span>
                    </label>
                    <select name="paciente"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 <?php echo isset($errors) && in_array('Debe seleccionar un paciente', $errors) ? 'border-red-500' : ''; ?>">
                        <option value="">Seleccionar paciente...</option>
                        <?php foreach ($pacientes as $paciente): ?>
                            <option value="<?php echo htmlspecialchars($paciente['id']); ?>"
                                    <?php echo (isset($formData['paciente']) && $formData['paciente'] == $paciente['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($paciente['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de Consulta <span class="text-red-500">*</span>
                    </label>
                    <select name="tipo"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 <?php echo isset($errors) && in_array('El tipo de consulta es obligatorio', $errors) ? 'border-red-500' : ''; ?>">
                        <option value="">Seleccionar tipo...</option>
                        <option value="Consulta General" <?php echo (isset($formData['tipo']) && $formData['tipo'] == 'Consulta General') ? 'selected' : ''; ?>>Consulta General</option>
                        <option value="Seguimiento" <?php echo (isset($formData['tipo']) && $formData['tipo'] == 'Seguimiento') ? 'selected' : ''; ?>>Seguimiento</option>
                        <option value="Consulta Especializada" <?php echo (isset($formData['tipo']) && $formData['tipo'] == 'Consulta Especializada') ? 'selected' : ''; ?>>Consulta Especializada</option>
                        <option value="Control" <?php echo (isset($formData['tipo']) && $formData['tipo'] == 'Control') ? 'selected' : ''; ?>>Control</option>
                        <option value="Emergencia" <?php echo (isset($formData['tipo']) && $formData['tipo'] == 'Emergencia') ? 'selected' : ''; ?>>Emergencia</option>
                    </select>
                </div>
            </div>

            <!-- Fecha y Hora -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha <span class="text-red-500">*</span>
                    </label>
                    <input type="date"
                           name="fecha"
                           value="<?php echo htmlspecialchars($formData['fecha'] ?? ''); ?>"
                           min="<?php echo date('Y-m-d'); ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 <?php echo isset($errors) && in_array('La fecha es obligatoria', $errors) ? 'border-red-500' : ''; ?>">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Hora <span class="text-red-500">*</span>
                    </label>
                    <input type="time"
                           name="hora"
                           value="<?php echo htmlspecialchars($formData['hora'] ?? ''); ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 <?php echo isset($errors) && in_array('La hora es obligatoria', $errors) ? 'border-red-500' : ''; ?>">
                </div>
            </div>

            <!-- Notas adicionales -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Notas / Observaciones
                </label>
                <textarea name="notas"
                          rows="4"
                          placeholder="Información adicional sobre la consulta..."
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"><?php echo htmlspecialchars($formData['notas'] ?? ''); ?></textarea>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-center space-x-4 pt-6">
                <button type="submit"
                        class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-bold transition duration-200">
                    <i class="fas fa-calendar-plus mr-2"></i>Programar Cita
                </button>
                <button type="reset"
                        class="px-8 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-bold transition duration-200">
                    <i class="fas fa-undo mr-2"></i>Limpiar
                </button>
                <button type="button"
                        onclick="location.href='<?php echo BASE_URL; ?>doctor/consultas?debug=1'"
                        class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg font-bold transition duration-200">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
            </div>
        </form>
    </div>

    <!-- Información útil -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
        <div class="flex items-center mb-4">
            <i class="fas fa-info-circle text-blue-500 text-xl mr-3"></i>
            <h3 class="text-lg font-semibold text-blue-800">💡 Información Importante</h3>
        </div>
        <div class="text-blue-700 text-sm space-y-2">
            <p>• Asegúrese de que el paciente esté disponible en la fecha y hora seleccionada</p>
            <p>• Las citas de emergencia serán atendidas con prioridad</p>
            <p>• Recuerde confirmar la cita con el paciente antes de programarla</p>
            <p>• Puede modificar o cancelar la cita desde la vista de consultas</p>
        </div>
    </div>
</div>
