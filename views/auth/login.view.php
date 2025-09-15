<?php
// views/auth/login.view.php

$titulo = 'Iniciar Sesión - HealthMate';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4><i class="fas fa-user-md me-2"></i>HealthMate</h4>
                    <p class="mb-0">Sistema de Gestión Médica</p>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    
                    <form action="/auth/login" method="post" id="loginForm" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" 
                                       required data-bs-toggle="tooltip" 
                                       data-bs-placement="top" 
                                       title="Ingresa tu correo electrónico registrado">
                                <div class="invalid-feedback">
                                    Por favor ingresa un correo electrónico válido.
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" 
                                       required minlength="8"
                                       data-bs-toggle="tooltip" 
                                       data-bs-placement="top" 
                                       title="La contraseña debe tener al menos 8 caracteres">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <div class="invalid-feedback">
                                    La contraseña es requerida (mínimo 8 caracteres).
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                            </button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="/auth/recuperar" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0">¿No tienes una cuenta? 
                        <a href="/auth/registro" class="text-primary">Regístrate aquí</a>
                    </p>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <small class="text-muted">
                    Al iniciar sesión, aceptas nuestros 
                    <a href="/terminos" class="text-decoration-none">Términos de Servicio</a> y 
                    <a href="/privacidad" class="text-decoration-none">Política de Privacidad</a>.
                </small>
            </div>
        </div>
    </div>
</div>

<script>
// Mostrar/ocultar contraseña
document.getElementById('togglePassword').addEventListener('click', function() {
    const password = document.getElementById('password');
    const icon = this.querySelector('i');
    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

// Validación del formulario
(function () {
    'use strict'
    
    // Obtener el formulario al que queremos aplicar la validación
    var form = document.getElementById('loginForm')
    
    // Validar al enviar el formulario
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }
        
        form.classList.add('was-validated')
    }, false)
})()
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>