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

                <form action="<?= BASE_URL ?>enfermerx/registrar-paciente" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Datos Personales -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                                <i class="fas fa-id-card text-teal-600 mr-2"></i>Datos Personales
                            </h3>
                            
                            <div>
                                <label for="nombres" class="block text-sm font-medium text-gray-700">Nombres *</label>
                                <input type="text" id="nombres" name="nombres" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            </div>

                            <div>
                                <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos *</label>
                                <input type="text" id="apellidos" name="apellidos" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            </div>

                            <div>
                                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Género</label>
                                <div class="mt-1 space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="genero" value="M" class="text-teal-600 focus:ring-teal-500">
                                        <span class="ml-2">Masculino</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="genero" value="F" class="text-teal-600 focus:ring-teal-500">
                                        <span class="ml-2">Femenino</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="genero" value="O" class="text-teal-600 focus:ring-teal-500">
                                        <span class="ml-2">Otro</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Información de Contacto -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                                <i class="fas fa-address-book text-teal-600 mr-2"></i>Información de Contacto
                            </h3>
                            
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="tel" id="telefono" name="telefono"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                                <input type="email" id="email" name="email"
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
                            <label for="enfermedades_cronicas" class="block text-sm font-medium text-gray-700">Enfermedades Crónicas</label>
                            <textarea id="enfermedades_cronicas" name="enfermedades_cronicas" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="Ej: Diabetes, Hipertensión..."></textarea>
                        </div>

                        <div>
                            <label for="medicamentos" class="block text-sm font-medium text-gray-700">Medicamentos Actuales</label>
                            <textarea id="medicamentos" name="medicamentos" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="Lista de medicamentos y dosis..."></textarea>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex justify-end space-x-4 pt-6 border-t">
                        <a href="<?= BASE_URL ?>enfermerx" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <i class="fas fa-save mr-1"></i> Guardar Paciente
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <!-- Pie de página -->
        <footer class="bg-gray-800 text-white p-4 mt-8">
            <div class="container mx-auto text-center">
                <p>&copy; <?= date('Y') ?> HealthMate - Todos los derechos reservados</p>
            </div>
        </footer>
    </div>
</body>
</html>
