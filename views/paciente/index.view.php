<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes | HealthMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Fuentes personalizadas */
        @import url('https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap');

        /* Scroll suave */
        html {
            scroll-behavior: smooth;
        }

        /* Animaciones para las tarjetas */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Navbar -->
    <?php include('navbar.view.php') ?>

    <!-- Contenido principal con scroll -->
    <div class="min-h-screen pt-20">
        <div class="container mx-auto px-4 py-8">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-emerald-400 to-teal-500 rounded-3xl p-8 mb-8 shadow-lg">
                <div class="text-center text-white">
                    <h1 class="text-5xl font-bold font-['Roboto'] mb-4">Bienvenido a HealthMate</h1>
                    <p class="text-xl opacity-90">Tu compañero digital para el cuidado de la salud</p>
                </div>
            </div>

            <!-- Filtros Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">FILTRO SELECCIONADO</h2>
                    <div class="flex gap-4">
                        <button class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition-colors">
                            Todos
                        </button>
                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition-colors">
                            Favoritos
                        </button>
                    </div>
                </div>
            </div>

            <!-- Servicios Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Signos Vitales Card -->
                <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-heartbeat text-2xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Parámetros de Signos Vitales</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Este sistema está diseñado para que puedas llevar el control de tus signos vitales de manera fácil y efectiva.
                        </p>
                        <button onclick="window.location.href='<?= constant('URL') ?>paciente/ParametrosSV'"
                                class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition-colors w-full">
                            Ver Detalles
                        </button>
                    </div>
                </div>

                <!-- Alimentación Card -->
                <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-utensils text-2xl text-orange-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">ALIMENTACIÓN</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Consejos y seguimiento de tu alimentación saludable para mantener tu bienestar.
                        </p>
                        <button onclick="window.location.href='<?= constant('URL') ?>paciente/servicios'"
                                class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition-colors w-full">
                            Explorar
                        </button>
                    </div>
                </div>

                <!-- Prevención Médica Card -->
                <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-seedling text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Prevención Médica</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Descubre medidas preventivas y cuidados médicos para mantener tu salud óptima.
                        </p>
                        <button onclick="window.location.href='<?= constant('URL') ?>paciente/servicios'"
                                class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition-colors w-full">
                            VER
                        </button>
                    </div>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="mt-12 bg-white rounded-xl shadow-sm p-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">¿Cómo funciona HealthMate?</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-mobile-alt text-2xl text-blue-600"></i>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Registra</h3>
                            <p class="text-gray-600">Registra tus signos vitales diariamente de forma sencilla</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-line text-2xl text-purple-600"></i>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Visualiza</h3>
                            <p class="text-gray-600">Ve gráficos y tendencias de tu salud en tiempo real</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-bell text-2xl text-pink-600"></i>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Recibe Alertas</h3>
                            <p class="text-gray-600">Obtén notificaciones sobre tu salud y bienestar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Funcionalidad mejorada para scroll suave
        document.addEventListener('DOMContentLoaded', function() {
            // Agregar animaciones al hacer scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                    }
                });
            }, observerOptions);

            // Observar todas las tarjetas
            document.querySelectorAll('.card-hover').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>