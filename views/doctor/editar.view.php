<?php
// views/doctor/editar.view.php

$doctor = $this->get('doctor') ?? [];
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);

$id = htmlspecialchars($doctor['Id_Usuario'] ?? '', ENT_QUOTES, 'UTF-8');
?>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Editar doctor #<?php echo $id; ?></h5>
        </div>
        <div class="card-body">
          <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
          <?php endif; ?>
          <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
          <?php endif; ?>

          <form action="<?php echo BASE_URL; ?>doctor/editar/<?php echo $id; ?>" method="post" class="row g-3" novalidate>
            <div class="col-md-6">
              <label for="Nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo htmlspecialchars($doctor['Nombre'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="col-md-6">
              <label for="Email" class="form-label">Email</label>
              <input type="email" class="form-control" id="Email" name="Email" value="<?php echo htmlspecialchars($doctor['Email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="col-md-4">
              <label for="Edad" class="form-label">Edad</label>
              <input type="number" class="form-control" id="Edad" name="Edad" value="<?php echo htmlspecialchars($doctor['Edad'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-4">
              <label for="Sexo" class="form-label">Sexo</label>
              <select id="Sexo" name="Sexo" class="form-select">
                <?php $sexo = strtolower($doctor['Sexo'] ?? ''); ?>
                <option value="">Selecciona</option>
                <option value="Masculino" <?php echo $sexo === 'masculino' ? 'selected' : ''; ?>>Masculino</option>
                <option value="Femenino" <?php echo $sexo === 'femenino' ? 'selected' : ''; ?>>Femenino</option>
                <option value="Otro" <?php echo $sexo === 'otro' ? 'selected' : ''; ?>>Otro</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="Peso" class="form-label">Peso (kg)</label>
              <input type="number" step="0.01" class="form-control" id="Peso" name="Peso" value="<?php echo htmlspecialchars($doctor['Peso'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-4">
              <label for="Altura" class="form-label">Altura (cm)</label>
              <input type="number" step="0.01" class="form-control" id="Altura" name="Altura" value="<?php echo htmlspecialchars($doctor['Altura'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-4">
              <label for="Tipo_sangre" class="form-label">Tipo de sangre</label>
              <input type="text" class="form-control" id="Tipo_sangre" name="Tipo_sangre" value="<?php echo htmlspecialchars($doctor['Tipo_sangre'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-6">
              <label for="Alergias" class="form-label">Alergias</label>
              <input type="text" class="form-control" id="Alergias" name="Alergias" value="<?php echo htmlspecialchars($doctor['Alergias'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-6">
              <label for="Enfermedades" class="form-label">Enfermedades</label>
              <input type="text" class="form-control" id="Enfermedades" name="Enfermedades" value="<?php echo htmlspecialchars($doctor['Enfermedades'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="col-12 d-flex justify-content-between mt-3">
              <a href="<?php echo BASE_URL; ?>doctor" class="btn btn-outline-secondary">Cancelar</a>
              <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
