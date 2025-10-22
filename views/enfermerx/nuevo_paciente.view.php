<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . 'auth');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Paciente - HealthMate</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Barra de navegación -->
        <nav class="bg-teal-700 text-white p-4 shadow-md">
            <div class="container mx-auto flex justify-between items-center">
                <a href="<?= BASE_URL ?>enfermerx" class="text-2xl font-bold">
                    <i class="fas fa-arrow-left mr-2"></i> Volver al Panel
                </a>
                <div class="flex items-center space-x-4">
                    <span class="font-medium"><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Enfermerx') ?></span>
                    <a href="<?= BASE_URL ?>auth/logout" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-white">
                        <i class="fas fa-sign-out-alt mr-1"></i> Cerrar sesión
                    </a>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="flex-grow container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-user-plus text-teal-600 mr-2"></i> Nuevo Paciente
                    </h2>
                </div>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        <p><?= htmlspecialchars($_SESSION['error']) ?></p>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>enfermerx/guardarPaciente" method="POST" class="space-y-6" enctype="multipart/form-data" id="form-paciente">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Datos Personales -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                                <i class="fas fa-id-card text-teal-600 mr-2"></i>Datos Personales
                            </h3>
                            
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre Completo *</label>
                                <input type="text" id="nombre" name="nombre" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                <p id="nombre-error" class="mt-1 text-sm text-red-600 hidden">Por favor ingrese el nombre completo</p>
                            </div>

                            <div>
                                <label for="edad" class="block text-sm font-medium text-gray-700">Edad *</label>
                                <input type="number" id="edad" name="edad" min="0" max="120" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                <p id="edad-error" class="mt-1 text-sm text-red-600 hidden">Por favor ingrese una edad válida (0-120)</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Género *</label>
                                <div class="mt-1 space-x-4" id="genero-container">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="genero" value="M" class="text-teal-600 focus:ring-teal-500" required>
                                        <span class="ml-2">Masculino</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="genero" value="F" class="text-teal-600 focus:ring-teal-500" required>
                                        <span class="ml-2">Femenino</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="genero" value="O" class="text-teal-600 focus:ring-teal-500" required>
                                        <span class="ml-2">Otro</span>
                                    </label>
                                    <p id="genero-error" class="mt-1 text-sm text-red-600 hidden">Por favor seleccione un género</p>
                                </div>
                            </div>
                        </div>

                        <!-- Información de Contacto -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                                <i class="fas fa-address-book text-teal-600 mr-2"></i>Información de Contacto
                            </h3>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico *</label>
                                <input type="email" id="email" name="email" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                <p id="email-error" class="mt-1 text-sm text-red-600 hidden">Por favor ingrese un correo electrónico válido</p>
                            </div>

                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="tel" id="telefono" name="telefono"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            </div>

                            <div>
                                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                                <textarea id="direccion" name="direccion" rows="2"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Información Médica -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            <i class="fas fa-heartbeat text-teal-600 mr-2"></i>Información Médica
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="tipo_sangre" class="block text-sm font-medium text-gray-700">Tipo de Sangre</label>
                                <select id="tipo_sangre" name="tipo_sangre"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    <option value="">Seleccionar...</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label for="alergias" class="block text-sm font-medium text-gray-700">Alergias</label>
                                <input type="text" id="alergias" name="alergias" placeholder="Ej: Penicilina, Mariscos..."
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            </div>
                        </div>

                        <div>
                            <label for="enfermedades" class="block text-sm font-medium text-gray-700">Enfermedades Crónicas</label>
                            <textarea id="enfermedades" name="enfermedades" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="Ej: Diabetes, Hipertensión..."></textarea>
                        </div>

                        <div>
                            <label for="medicamentos" class="block text-sm font-medium text-gray-700">Medicamentos</label>
                            <textarea id="medicamentos" name="medicamentos" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="Ej: Aspirina, Metformina..."></textarea>
                        </div>

                        <div>
                            <label for="peso" class="block text-sm font-medium text-gray-700">Peso (kg)</label>
                            <input type="number" id="peso" name="peso" min="0" max="500" step="0.1"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="70.5">
                        </div>

                        <div>
                            <label for="altura" class="block text-sm font-medium text-gray-700">Altura (cm)</label>
                            <input type="number" id="altura" name="altura" min="0" max="300"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="175">
                        </div>
                    </div>

                    <!-- Documentos -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            <i class="fas fa-file-alt text-teal-600 mr-2"></i>Documentos
                        </h3>
                        
                        <div>
                            <label for="documentos" class="block text-sm font-medium text-gray-700">Subir Documentos</label>
                            <input type="file" id="documentos" name="documentos[]" multiple
                                class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-teal-50 file:text-teal-700
                                hover:file:bg-teal-100">
                            <p class="mt-1 text-xs text-gray-500">Puedes seleccionar múltiples archivos (PDF, JPG, PNG)</p>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 pt-4 border-t">
                        <a href="<?= BASE_URL ?>enfermerx" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <i class="fas fa-save mr-2"></i> Guardar Paciente
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <!-- Pie de página -->
        <footer class="bg-gray-800 text-white p-4 mt-8">
            <div class="container mx-auto text-center">
                <p>&copy; <?= date('Y') ?> HealthMate. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form-paciente');
            const submitBtn = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Crear FormData para enviar archivos
                const formData = new FormData(form);

                // Deshabilitar botón y mostrar loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Guardando...';

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mostrar mensaje de éxito
                        showMessage('Paciente registrado exitosamente', 'success');
                        setTimeout(() => {
                            window.location.href = '<?= BASE_URL ?>enfermerx';
                        }, 2000);
                    } else {
                        showMessage(data.message || 'Error al guardar el paciente', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('Error de conexión. Inténtalo de nuevo.', 'error');
                })
                .finally(() => {
                    // Rehabilitar botón
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save mr-1"></i> Guardar Paciente';
                });
            });

            function showMessage(message, type) {
                // Remover mensajes anteriores
                const existingMessages = document.querySelectorAll('.alert-message');
                existingMessages.forEach(msg => msg.remove());

                // Crear nuevo mensaje
                const messageDiv = document.createElement('div');
                messageDiv.className = `alert-message ${type === 'success' ? 'bg-green-100 border-green-500 text-green-700' : 'bg-red-100 border-red-500 text-red-700'} border-l-4 p-4 mb-4`;
                messageDiv.innerHTML = `<p>${message}</p>`;

                // Insertar después del título
                const title = document.querySelector('h2');
                title.parentNode.insertBefore(messageDiv, title.nextSibling);
            }
        });
    </script>
</body>
</html>
