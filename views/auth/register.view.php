<?php
// views/auth/register.view.php

$titulo = 'Registro - HealthMate';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4><i class="fas fa-user-plus me-2"></i>Crear cuenta</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                    <?php endif; ?>

                    <form action="/auth/register" method="post" id="registerForm" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                <div class="invalid-feedback">Ingresa tu nombre.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">Ingresa un correo válido.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" minlength="8" required>
                                <div class="invalid-feedback">La contraseña debe tener al menos 8 caracteres.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="number" class="form-control" id="edad" name="edad" min="0" required>
                                <div class="invalid-feedback">Ingresa tu edad.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select id="sexo" name="sexo" class="form-select" required>
                                    <option value="" selected disabled>Selecciona tu sexo</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                                <div class="invalid-feedback">Selecciona una opción.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="peso" class="form-label">Peso (kg)</label>
                                <input type="number" step="0.01" class="form-control" id="peso" name="peso" required>
                                <div class="invalid-feedback">Ingresa tu peso.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="altura" class="form-label">Altura (cm)</label>
                                <input type="number" step="0.01" class="form-control" id="altura" name="altura">
                            </div>
                            <div class="col-md-6">
                                <label for="tipo_sangre" class="form-label">Tipo de sangre</label>
                                <input type="text" class="form-control" id="tipo_sangre" name="tipo_sangre">
                            </div>
                            <div class="col-md-6">
                                <label for="alergias" class="form-label">Alergias</label>
                                <input type="text" class="form-control" id="alergias" name="alergias" required>
                            </div>
                            <div class="col-md-6">
                                <label for="enfermedades" class="form-label">Enfermedades</label>
                                <input type="text" class="form-control" id="enfermedades" name="enfermedades" required>
                            </div>
                        </div>

                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">

                        <div class="mt-4 d-grid">
                            <button type="submit" class="btn btn-success">Registrarse</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0">¿Ya tienes cuenta? <a href="/auth" class="text-primary">Inicia sesión</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validación del formulario
(function () {
    'use strict'
    var form = document.getElementById('registerForm')
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
