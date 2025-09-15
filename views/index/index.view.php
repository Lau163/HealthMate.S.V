<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#10b981">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>HealthMate - Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media (max-width: 768px) {
            .login-container {
                width: 90% !important;
                padding: 1.5rem !important;
            }
            .login-image {
                display: none !important;
            }
        }
        @media (min-width: 769px) and (max-width: 1024px) {
            .login-container {
                width: 80% !important;
            }
        }
        body {
            font-family: 'Roboto', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }
        input:focus {
            outline: none;
            border-color: #0d9488 !important;
            box-shadow: 0 0 0 2px rgba(13, 148, 136, 0.2);
        }
        .btn-login {
            transition: all 0.3s ease;
        }
        .btn-login:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body class="min-h-screen bg-emerald-500 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-xl overflow-hidden flex flex-col md:flex-row">
        <!-- Imagen de inicio de sesión (visible solo en escritorio) -->
        <div class="login-image w-full md:w-2/5 bg-gray-100 flex items-center justify-center p-8">
            <div class="w-full h-48 md:h-64 bg-stone-300 rounded-lg shadow-md flex items-center justify-center">
                <span class="text-gray-500">Logo/Imagen</span>
            </div>
        </div>
        
        <!-- Formulario de inicio de sesión -->
        <div class="login-container w-full md:w-3/5 p-8 md:p-12">
            <h1 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-8">Iniciar Sesión</h1>
            
            <form class="space-y-6">
                <!-- Campo de correo electrónico -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <input 
                        type="email" 
                        id="email" 
                        name="email"
                        placeholder=" "
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500 transition duration-200"
                        required
                    >
                    <label for="email" class="absolute left-10 top-1/2 -translate-y-1/2 text-gray-400 bg-white px-1 transition-all duration-200 pointer-events-none">
                        Correo electrónico
                    </label>
                </div>

                <!-- Campo de contraseña -->
                <div class="relative mt-8">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        placeholder=" "
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500 transition duration-200"
                        required
                    >
                    <label for="password" class="absolute left-10 top-1/2 -translate-y-1/2 text-gray-400 bg-white px-1 transition-all duration-200 pointer-events-none">
                        Contraseña
                    </label>
                </div>

                <!-- Botón de ingresar -->
                <button 
                    type="submit" 
                    class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 px-4 rounded-lg btn-login focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50 transition duration-200 transform active:scale-95"
                >
                    Ingresar
                </button>

                <!-- Enlace de olvidé mi contraseña -->
                <div class="text-center mt-4">
                    <a href="#" class="text-sm text-teal-700 hover:underline">¿Olvidaste tu contraseña?</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Mejora la experiencia en dispositivos táctiles
        document.addEventListener('DOMContentLoaded', function() {
            // Asegura que los inputs tengan el tamaño de fuente correcto en iOS
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
                    window.scrollTo(0, currentScroll);
                });
            });
        });
    </script>
</body>
</html>