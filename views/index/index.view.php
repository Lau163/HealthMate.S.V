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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-xl overflow-hidden flex flex-col md:flex-row">
     <div class="w-full max-w-4xl bg-white rounded-xl shadow-xl overflow-hidden flex flex-col md:flex-row">
        <!-- Imagen de inicio de sesión (visible solo en escritorio) -->
        <div class="login-image w-full md:w-2/5 bg-gray-100 flex items-center justify-center p-8">
            <div class="w-full h-48 md:h-64 flex items-center justify-center">
                <img src="<?= URL ?>public/img/LOGO.PNG" alt="HealthMate Logo" class="max-w-full max-h-full object-contain">
            </div>
        </div>
        
        <!-- Formulario de inicio de sesión -->
       <div class="login-container w-full md:w-3/5 p-8 md:p-12">
    <div class="mb-8 border-b border-gray-200">
        <nav class="flex space-x-4" id="tabs-nav">
            <button class="tab-btn text-teal-700 font-bold py-2 px-4 border-b-2 border-teal-700 focus:outline-none" data-tab="login">Iniciar Sesión</button>
            <button class="tab-btn text-gray-500 font-bold py-2 px-4 border-b-2 border-transparent hover:text-teal-700 focus:outline-none" data-tab="register">Registrarse</button>
        </nav>
    </div>
    <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- Login Form -->

   <form id="login-tab" class="space-y-6" method="POST" action="<?= BASE_URL ?>auth/login">
    <!-- Email -->
    <div class="relative mb-6">
        <input type="email" id="email" name="email" placeholder=" " class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500" required>
        <label for="email_login" class="input-floating-label">Correo electrónico</label>
    </div>
    <!-- Password -->
    <div class="relative mb-6">
        <div class="relative">
            <input type="password" id="password" name="password" placeholder=" " class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500" required>
            <label for="password" class="input-floating-label">Contraseña</label>
            <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-teal-700 focus:outline-none" onclick="togglePasswordVisibility()">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>
    <button type="submit" class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 px-4 rounded-lg btn-login focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50 transition duration-200 transform active:scale-95">
        Ingresar
    </button>
    
    <!-- Términos y condiciones -->
    <div class="text-center mt-4 text-sm text-gray-600">
        <p>Al iniciar sesión, aceptas nuestros 
            <a href="/terminos" class="text-teal-600 hover:text-teal-700 font-medium">Términos de Servicio</a> y 
            <a href="/privacidad" class="text-teal-600 hover:text-teal-700 font-medium">Política de Privacidad</a>
        </p>
    </div>
    
    <div class="text-center mt-2">
        <a href="/auth/recuperar" class="text-sm text-teal-700 hover:underline">¿Olvidaste tu contraseña?</a>
    </div>
</form>

  <!-- Register Form -->
<form id="register-tab" class="space-y-6 hidden" method="POST" action="<?= BASE_URL ?>auth/register" onsubmit="return validateRegisterForm()">
    <?php if (isset($_SESSION['error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($_SESSION['error']) ?></span>
        <?php unset($_SESSION['error']); ?>
    </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($_SESSION['success']) ?></span>
        <?php unset($_SESSION['success']); ?>
    </div>
    <?php endif; ?>
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
        <input type="text" id="tipo_sangre" name="tipo_sangre" placeholder=" " class="input-floating w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-200 focus:border-teal-500">
        <label for="tipo_sangre" class="input-floating-label">Tipo de sangre</label>
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
    // Función para alternar la visibilidad de la contraseña
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');
        const icon = toggleButton.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
            toggleButton.setAttribute('title', 'Ocultar contraseña');
            toggleButton.setAttribute('aria-label', 'Ocultar contraseña');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
            toggleButton.setAttribute('title', 'Mostrar contraseña');
            toggleButton.setAttribute('aria-label', 'Mostrar contraseña');
        }
    }
    
    // Inicialización de tooltips
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Manejar el envío del formulario
        const form = document.getElementById('login-tab');
        if (form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }
    });

    // Función para cambiar de pestaña
    function switchTab(tabName) {
        // Actualizar botones
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('text-teal-700', 'border-teal-700');
            b.classList.add('text-gray-500', 'border-transparent');
            if (b.dataset.tab === tabName) {
                b.classList.add('text-teal-700', 'border-teal-700');
                b.classList.remove('text-gray-500', 'border-transparent');
            }
        });
        
        // Mostrar/ocultar formularios
        document.getElementById('login-tab').classList.toggle('hidden', tabName !== 'login');
        document.getElementById('register-tab').classList.toggle('hidden', tabName !== 'register');
    }
    
    // Inicializar tabs
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tabName = this.dataset.tab;
            switchTab(tabName);
            
            // Limpiar mensajes de error al cambiar de pestaña
            const errorMessages = document.querySelectorAll('.alert-danger, .alert-success');
            errorMessages.forEach(msg => msg.remove());
        });
    });
    
    // Establecer pestaña activa desde la sesión o por defecto 'login'
    const activeTab = '<?php echo $_SESSION['active_tab'] ?? 'login'; ?>';
    switchTab(activeTab);
    
    // Rellenar formulario con datos guardados en caso de error
    <?php if (isset($_SESSION['form_data'])): ?>
    const formData = <?php echo json_encode($_SESSION['form_data']); ?>;
    Object.keys(formData).forEach(key => {
        const input = document.querySelector(`[name="${key}"]`);
        if (input) {
            input.value = formData[key];
            // Disparar evento para actualizar etiquetas flotantes
            const event = new Event('input', { bubbles: true });
            input.dispatchEvent(event);
        }
    });
    <?php 
    // Limpiar datos del formulario después de usarlos
    unset($_SESSION['form_data']);
    endif; 
    ?>

    // Validación del formulario de registro
    function validateRegisterForm() {
        const form = document.getElementById('register-tab');
        const password = document.getElementById('password_reg').value;
        const email = document.getElementById('email_reg').value;
        const edad = document.getElementById('edad').value;
        
        // Validar contraseña
        if (password.length < 8) {
            showError('La contraseña debe tener al menos 8 caracteres');
            return false;
        }
        
        // Validar email
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showError('Por favor ingresa un correo electrónico válido');
            return false;
        }
        
        // Validar edad
        const edadNum = parseInt(edad);
        if (isNaN(edadNum) || edadNum < 1 || edadNum > 120) {
            showError('La edad debe estar entre 1 y 120 años');
            return false;
        }
        
        return true;
    }
    
    function showError(message) {
        // Eliminar mensajes de error existentes
        const existingError = document.querySelector('.register-error');
        if (existingError) {
            existingError.remove();
        }
        
        // Crear y mostrar el nuevo mensaje de error
        const errorDiv = document.createElement('div');
        errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 register-error';
        errorDiv.role = 'alert';
        errorDiv.innerHTML = `
            <span class="block sm:inline">${message}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Cerrar</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </span>
        `;
        
        // Insertar el mensaje de error al principio del formulario
        const form = document.getElementById('register-tab');
        form.insertBefore(errorDiv, form.firstChild);
        
        // Desplazarse al mensaje de error
        errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
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