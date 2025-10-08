<?php
// views/paciente/nuevo.view.php

$error = $this->get('error') ?? '';
$paciente = $this->get('paciente') ?? [];
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Nuevo Paciente</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    
                    <form method="post" action="<?php echo BASE_URL; ?>paciente/nuevo">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Nombre" class="form-label">Nombre completo *</label>
                                <input type="text" class="form-control" id="Nombre" name="Nombre" 
                                       value="<?php echo htmlspecialchars($paciente['Nombre'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="Email" class="form-label">Correo electrónico *</label>
                                <input type="email" class="form-control" id="Email" name="Email" 
                                       value="<?php echo htmlspecialchars($paciente['Email'] ?? ''); ?>" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="Edad" class="form-label">Edad</label>
                                <input type="number" class="form-control" id="Edad" name="Edad" 
                                       value="<?php echo htmlspecialchars($paciente['Edad'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="Sexo" class="form-label">Sexo</label>
                                <select class="form-select" id="Sexo" name="Sexo">
                                    <option value="">Seleccionar...</option>
                                    <option value="M" <?php echo (isset($paciente['Sexo']) && $paciente['Sexo'] === 'M') ? 'selected' : ''; ?>>Masculino</option>
                                    <option value="F" <?php echo (isset($paciente['Sexo']) && $paciente['Sexo'] === 'F') ? 'selected' : ''; ?>>Femenino</option>
                                    <option value="O" <?php echo (isset($paciente['Sexo']) && $paciente['Sexo'] === 'O') ? 'selected' : ''; ?>>Otro</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="Peso" class="form-label">Peso (kg)</label>
                                <input type="number" step="0.1" class="form-control" id="Peso" name="Peso" 
                                       value="<?php echo htmlspecialchars($paciente['Peso'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="Altura" class="form-label">Altura (cm)</label>
                                <input type="number" class="form-control" id="Altura" name="Altura" 
                                       value="<?php echo htmlspecialchars($paciente['Altura'] ?? ''); ?>">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="Tipo_sangre" class="form-label">Tipo de sangre</label>
                                <select class="form-select" id="Tipo_sangre" name="Tipo_sangre">
                                    <option value="">Seleccionar...</option>
                                    <option value="A+" <?php echo (isset($paciente['Tipo_sangre']) && $paciente['Tipo_sangre'] === 'A+') ? 'selected' : ''; ?>>A+</option>
                                    <option value="A-" <?php echo (isset($paciente['Tipo_sangre']) && $paciente['Tipo_sangre'] === 'A-') ? 'selected' : ''; ?>>A-</option>
                                    <option value="B+" <?php echo (isset($paciente['Tipo_sangre']) && $paciente['Tipo_sangre'] === 'B+') ? 'selected' : ''; ?>>B+</option>
                                    <option value="B-" <?php echo (isset($paciente['Tipo_sangre']) && $paciente['Tipo_sangre'] === 'B-') ? 'selected' : ''; ?>>B-</option>
                                    <option value="AB+" <?php echo (isset($paciente['Tipo_sangre']) && $paciente['Tipo_sangre'] === 'AB+') ? 'selected' : ''; ?>>AB+</option>
                                    <option value="AB-" <?php echo (isset($paciente['Tipo_sangre']) && $paciente['Tipo_sangre'] === 'AB-') ? 'selected' : ''; ?>>AB-</option>
                                    <option value="O+" <?php echo (isset($paciente['Tipo_sangre']) && $paciente['Tipo_sangre'] === 'O+') ? 'selected' : ''; ?>>O+</option>
                                    <option value="O-" <?php echo (isset($paciente['Tipo_sangre']) && $paciente['Tipo_sangre'] === 'O-') ? 'selected' : ''; ?>>O-</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Alergias" class="form-label">Alergias</label>
                                <textarea class="form-control" id="Alergias" name="Alergias" rows="2"><?php echo htmlspecialchars($paciente['Alergias'] ?? ''); ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="Enfermedades" class="form-label">Enfermedades crónicas</label>
                                <textarea class="form-control" id="Enfermedades" name="Enfermedades" rows="2"><?php echo htmlspecialchars($paciente['Enfermedades'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?php echo BASE_URL; ?>paciente" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Guardar Paciente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Incluir scripts necesarios para validación del formulario -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validación del formulario antes de enviar
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const nombre = document.getElementById('Nombre').value.trim();
        const email = document.getElementById('Email').value.trim();
        
        if (!nombre || !email) {
            e.preventDefault();
            alert('Por favor complete los campos obligatorios (*)');
            return false;
        }
        
        // Validación básica de email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            alert('Por favor ingrese un correo electrónico válido');
            return false;
        }
        
        return true;
    });
});
</script>
