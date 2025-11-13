<?php
// Configurar variables para el layout
$title = 'Nueva Receta - HealthMate';
$pageTitle = 'NUEVA RECETA';

// Obtener datos desde el controlador
$pacientes = $pacientes ?? [];
$medicamentos = $medicamentos ?? [];
$formData = $formData ?? [];
$errors = $errors ?? [];
?>

<!-- Nueva Receta Content -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">📋 Nueva Receta</h1>
                <p class="text-orange-100 text-lg">Crea una nueva prescripción médica</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-prescription-bottle text-6xl text-orange-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Formulario de Nueva Receta -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Información de la Receta</h2>
                <p class="text-gray-600">Complete los datos para generar la prescripción</p>
            </div>
            <button onclick="location.href='<?php echo BASE_URL; ?>doctor/recetas?debug=1'"
                    class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Volver a Recetas
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

        <form method="POST" action="<?php echo BASE_URL; ?>doctor/recetas/nueva?debug=1" class="space-y-6">
            <!-- Información del Paciente -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Paciente <span class="text-red-500">*</span>
                    </label>
                    <select name="paciente"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 <?php echo isset($errors) && in_array('Debe seleccionar un paciente', $errors) ? 'border-red-500' : ''; ?>">
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
                        Fecha de la Receta
                    </label>
                    <input type="date"
                           name="fecha"
                           value="<?php echo htmlspecialchars($formData['fecha'] ?? date('Y-m-d')); ?>"
                           max="<?php echo date('Y-m-d'); ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                </div>
            </div>

            <!-- Medicamentos -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Medicamentos e Indicaciones <span class="text-red-500">*</span>
                </label>
                <div class="space-y-4">
                    <!-- Medicamento 1 -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 border border-gray-200 rounded-lg">
                        <div>
                            <select name="medicamento1"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Seleccionar medicamento...</option>
                                <?php foreach ($medicamentos as $medicamento): ?>
                                    <option value="<?php echo htmlspecialchars($medicamento); ?>"
                                            <?php echo (isset($formData['medicamento1']) && $formData['medicamento1'] == $medicamento) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($medicamento); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <input type="text"
                                   name="dosis1"
                                   placeholder="Dosis (ej: 1 tableta)"
                                   value="<?php echo htmlspecialchars($formData['dosis1'] ?? ''); ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <input type="text"
                                   name="frecuencia1"
                                   placeholder="Frecuencia (ej: cada 8 horas)"
                                   value="<?php echo htmlspecialchars($formData['frecuencia1'] ?? ''); ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>

                    <!-- Medicamento 2 (opcional) -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <div>
                            <select name="medicamento2"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Seleccionar medicamento...</option>
                                <?php foreach ($medicamentos as $medicamento): ?>
                                    <option value="<?php echo htmlspecialchars($medicamento); ?>"
                                            <?php echo (isset($formData['medicamento2']) && $formData['medicamento2'] == $medicamento) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($medicamento); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <input type="text"
                                   name="dosis2"
                                   placeholder="Dosis (ej: 1 tableta)"
                                   value="<?php echo htmlspecialchars($formData['dosis2'] ?? ''); ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <input type="text"
                                   name="frecuencia2"
                                   placeholder="Frecuencia (ej: cada 8 horas)"
                                   value="<?php echo htmlspecialchars($formData['frecuencia2'] ?? ''); ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>

                    <!-- Medicamento 3 (opcional) -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <div>
                            <select name="medicamento3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Seleccionar medicamento...</option>
                                <?php foreach ($medicamentos as $medicamento): ?>
                                    <option value="<?php echo htmlspecialchars($medicamento); ?>"
                                            <?php echo (isset($formData['medicamento3']) && $formData['medicamento3'] == $medicamento) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($medicamento); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <input type="text"
                                   name="dosis3"
                                   placeholder="Dosis (ej: 1 tableta)"
                                   value="<?php echo htmlspecialchars($formData['dosis3'] ?? ''); ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <input type="text"
                                   name="frecuencia3"
                                   placeholder="Frecuencia (ej: cada 8 horas)"
                                   value="<?php echo htmlspecialchars($formData['frecuencia3'] ?? ''); ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Indicaciones adicionales -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Indicaciones Adicionales
                </label>
                <textarea name="indicaciones"
                          rows="4"
                          placeholder="Indicaciones especiales, recomendaciones, etc..."
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"><?php echo htmlspecialchars($formData['indicaciones'] ?? ''); ?></textarea>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-center space-x-4 pt-6">
                <button type="submit"
                        class="px-8 py-3 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-bold transition duration-200">
                    <i class="fas fa-prescription-bottle mr-2"></i>Generar Receta
                </button>
                <button type="reset"
                        class="px-8 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-bold transition duration-200">
                    <i class="fas fa-undo mr-2"></i>Limpiar
                </button>
                <button type="button"
                        onclick="location.href='<?php echo BASE_URL; ?>doctor/recetas?debug=1'"
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
            <p>• Asegúrese de que los medicamentos seleccionados sean los correctos</p>
            <p>• Incluya siempre las dosis y frecuencias de administración</p>
            <p>• Las indicaciones adicionales ayudan al paciente a seguir el tratamiento</p>
            <p>• Puede modificar la receta desde la vista de recetas</p>
        </div>
    </div>
</div>
