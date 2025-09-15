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
        /* ...existing code... */
.input-floating-label {
    position: absolute;
    left: 1rem;
    top: -0.8rem;
    font-size: 0.85rem;
    background: white;
    padding: 0 0.25rem;
    color: #0d9488;
    pointer-events: none;
    transition: all 0.2s;
    z-index: 10;
      text-align: right;
}
.input-floating:focus + .input-floating-label,
.input-floating:not(:placeholder-shown) + .input-floating-label {
    top: 0.2rem;
    left: 0.75rem;
    font-size: 0.75rem;
    color: #0d9488;
    transform: translateY(0);
}
/* ...existing code... */
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
    <!-- Botón Dark Mode -->
    <button id="darkModeToggle" class="absolute top-6 right-6 bg-white dark:bg-slate-800 text-teal-700 dark:text-teal-400 rounded-full p-2 shadow-lg transition duration-200" title="Cambiar modo">
        🌙
    </button>
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-xl overflow-hidden flex flex-col md:flex-row">
     <div class="w-full max-w-4xl bg-white rounded-xl shadow-xl overflow-hidden flex flex-col md:flex-row">
        <!-- Imagen de inicio de sesión (visible solo en escritorio) -->
        <div class="login-image w-full md:w-2/5 bg-gray-100 flex items-center justify-center p-8">
            <div class="w-full h-48 md:h-64 bg-stone-300 rounded-lg shadow-md flex items-center justify-center">
                <span class="text-gray-500">Logo/Imagen</span>
            </div>
        </div>
        
        <!-- Formulario de inicio de sesión -->
       <div class="login-container w-full md:w-3/5 p-8 md:p-12">
    <!-- Tabs -->
    <div class="mb-8 border-b border-gray-200">
        <nav class="flex space-x-4" id="tabs-nav">
            <button class="tab-btn text-teal-700 font-bold py-2 px-4 border-b-2 border-teal-700 focus:outline-none" data-tab="login">Iniciar Sesión</button>
            <button class="tab-btn text-gray-500 font-bold py-2 px-4 border-b-2 border-transparent hover:text-teal-700 focus:outline-none" data-tab="register">Registrarse</button>
        </nav>
    </div>

    <!-- Login Form -->
   <form id="login-tab" class="space-y-6">
    <!-- Email -->
    <div class="relative mb-6">
        <input type="email" id="email_login" name="email" placeholder=" " class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500" required>
        <label for="email_login" class="input-floating-label">Correo electrónico</label>
    </div>
    <!-- Password -->
    <div class="relative mb-6">
        <input type="password" id="password_login" name="password" placeholder=" " class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500" required>
        <label for="password_login" class="input-floating-label">Contraseña</label>
    </div>
    <button type="submit" class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 px-4 rounded-lg btn-login focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50 transition duration-200 transform active:scale-95">
        Ingresar
    </button>
    <div class="text-center mt-4">
        <a href="#" class="text-sm text-teal-700 hover:underline">¿Olvidaste tu contraseña?</a>
    </div>
</form>

  <!-- Register Form -->
<form id="register-tab" class="space-y-6 hidden">
    <!-- Nombre -->
  <div class="relative mb-6">
    <input type="text" id="nombre" name="nombre" placeholder=" " class="input-floating w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500" required>
    <label for="nombre" class="input-floating-label ">Nombre</label>
</div>
    <!-- Email -->
    <div class="relative">
        <input type="email" id="email_reg" name="email" placeholder=" " class="input-floating w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500" required>
        <label for="email_reg" class="input-floating-label">Correo electrónico</label>
    </div>
    <!-- Password -->
    <div class="relative">
        <input type="password" id="password_reg" name="password" placeholder=" " class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500" required>
        <label for="password_reg" class="input-floating-label">Contraseña</label>
    </div>
    <!-- Edad -->
    <div class="relative">
        <input type="number" id="edad" name="edad" placeholder=" " class="input-floating w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500" required>
        <label for="edad" class="input-floating-label">Edad</label>
    </div>
    <!-- Sexo -->
    <div class="relative">
        <select id="sexo" name="sexo" class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500" required>
            <option value="" disabled selected>Selecciona tu sexo</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otro">Otro</option>
        </select>
        <label for="sexo" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 bg-white px-1 pointer-events-none">Sexo</label>
    </div>
    <!-- Peso -->
    <div class="relative">
        <input type="number" step="0.01" id="peso" name="peso" placeholder=" " class="input-floating w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500" required>
        <label for="peso" class="input-floating-label">Peso (kg)</label>
    </div>
    <!-- Altura -->
    <div class="relative">
        <input type="number" step="0.01" id="altura" name="altura" placeholder=" " class="input-floating w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500">
        <label for="altura" class="input-floating-label">Altura (cm)</label>
    </div>
    <!-- Tipo de sangre -->
    <div class="relative">
        <input type="text" id="tipo_sangre" name="" placeholder=" " class="input-floating w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500">
        <label for="" class="input-floating-label">Tipo de sangre</label>
    </div>
    <!-- Alergias -->
    <div class="relative">
        <input type="text" id="alergias" name="alergias" placeholder=" " class="input-floating w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500" required>
        <label for="alergias" class="input-floating-label">Alergias</label>
    </div>
    <!-- Enfermedades -->
    <div class="relative">
        <input type="text" id="enfermedades" name="enfermedades" placeholder=" " class="input-floating w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500" required>
        <label for="enfermedades" class="input-floating-label">Enfermedades</label>
    </div>
    <button type="submit" class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 px-4 rounded-lg btn-login focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50 transition duration-200 transform active:scale-95">
        Registrarse
    </button>
</form>
</div>

<script>
    // Tabs functionality
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('text-teal-700', 'border-teal-700');
                b.classList.add('text-gray-500', 'border-transparent');
            });
            this.classList.add('text-teal-700', 'border-teal-700');
            this.classList.remove('text-gray-500', 'border-transparent');
            // Mostrar/ocultar formularios
            document.getElementById('login-tab').classList.toggle('hidden', this.dataset.tab !== 'login');
            document.getElementById('register-tab').classList.toggle('hidden', this.dataset.tab !== 'register');
        });
    });
</script>
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
        <script>
    // Alternar clase dark en body
    const btn = document.getElementById('darkModeToggle');
    btn.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        // Cambia el icono según el modo
        if(document.body.classList.contains('dark')) {
            btn.textContent = '☀️';
        } else {
            btn.textContent = '🌙';
        }
    });
    // Opcional: Mantener modo al recargar
    if(window.matchMedia('(prefers-color-scheme: dark)').matches){
        document.body.classList.add('dark');
        btn.textContent = '☀️';
    }
</script>
    </script>
</body>
</html>