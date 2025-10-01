<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . 'auth');
    exit;
}

$usuario = [
    'nombre' => $_SESSION['usuario_nombre'] ?? 'Usuario',
    'email' => $_SESSION['usuario_email'] ?? ''
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Rol - HealthMate</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .card-rol {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .card-rol:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-color: #0d9488; /* Color teal-700 */
        }
        .card-rol:active {
            transform: translateY(0);
        }
        .btn-cerrar-sesion {
            transition: all 0.3s ease;
        }
        .btn-cerrar-sesion:hover {
            background-color: #dc2626; /* Color red-700 */
        }
    </style>
</head>
<body class="bg-gradient-to-br from-teal-50 to-blue-50">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div class="w-full max-w-4xl">
            <!-- Encabezado -->
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-user-md text-teal-600 mr-2"></i>
                    Bienvenido, <?= htmlspecialchars($usuario['nombre']) ?>
                </h1>
                <p class="text-gray-600 mb-4">
                    <i class="fas fa-envelope text-teal-500 mr-1"></i>
                    <?= htmlspecialchars($usuario['email']) ?>
                </p>
                <p class="text-gray-600">
                    <i class="fas fa-arrow-circle-down text-teal-500 mr-1"></i>
                    Selecciona el módulo al que deseas acceder:
                </p>
            </div>

            <!-- Tarjetas de roles -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php if (empty($roles)): ?>
                    <div class="col-span-3 text-center py-4">
                        <p class="text-red-600">No tienes roles asignados. Por favor, contacta al administrador.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($roles as $rol): ?>
                        <?php 
                            // Mapear roles a iconos y colores
                            $rolNombre = strtolower($rol['Nombre_Rol']);
                            $icono = '';
                            $color = '';
                            $bgColor = '';
                            $textColor = '';
                            $descripcion = '';
                            
                            switch ($rolNombre) {
                                case 'paciente':
                                    $icono = 'user-injured';
                                    $color = 'teal';
                                    $descripcion = 'Accede a tu historial médico, citas y más.';
                                    break;
                                case 'enfermero':
                                case 'enfermerx':
                                    $icono = 'user-nurse';
                                    $color = 'blue';
                                    $descripcion = 'Gestiona pacientes, registros y atenciones.';
                                    break;
                                case 'doctor':
                                case 'médico':
                                    $icono = 'user-md';
                                    $color = 'purple';
                                    $descripcion = 'Accede a diagnósticos, recetas y más.';
                                    break;
                                case 'administrador':
                                case 'admin':
                                    $icono = 'user-shield';
                                    $color = 'green';
                                    $descripcion = 'Administra el sistema y configuración general.';
                                    break;
                                default:
                                    $icono = 'user-tie';
                                    $color = 'gray';
                                    $descripcion = 'Accede al módulo de ' . $rol['Nombre_Rol'];
                            }
                            
                            $bgColor = $color . '-100';
                            $textColor = $color . '-600';
                        ?>
                        <a href="<?= BASE_URL . strtolower($rol['Nombre_Rol']) ?>" class="block">
                            <div class="card-rol bg-white rounded-xl shadow-md overflow-hidden h-full border-2 border-transparent hover:border-<?= $color ?>-500">
                                <div class="p-6 text-center">
                                    <div class="w-16 h-16 bg-<?= $bgColor ?> rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-<?= $icono ?> text-3xl text-<?= $textColor ?>"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2"><?= ucfirst($rol['Nombre_Rol']) ?></h3>
                                    <p class="text-gray-600 text-sm"><?= $descripcion ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Botón de cierre de sesión -->
            <div class="mt-10 text-center">
                <a href="<?= BASE_URL ?>auth/logout" class="inline-flex items-center text-gray-600 hover:text-gray-800">
                    <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesión
                </a>
            </div>
        </div>
    </div>
</body>
</html>
