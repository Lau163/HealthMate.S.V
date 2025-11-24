<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Pacientes</title>
</head>
<body>
<?php
$pacientes = $pacientes ?? ($this->get('pacientes') ?? []);
?>

<div class="table-responsive">
  <table class="table table-striped table-hover align-middle">
    <thead class="table-light">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Edad</th>
        <th>Sexo</th>
        <th>Peso (kg)</th>
        <th>Altura (cm)</th>
        <th>Tipo de sangre</th>
        <th>Alergias</th>
        <th>Enfermedades</th>
        <th class="text-end">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pacientes as $p): ?>
        <tr>
          <td><?php echo htmlspecialchars($p['Id_Usuario'] ?? ''); ?></td>
          <td><?php echo htmlspecialchars($p['Nombre'] ?? ''); ?></td>
          <td><?php echo htmlspecialchars($p['Email'] ?? ''); ?></td>
          <td><?php echo htmlspecialchars($p['Edad'] ?? ''); ?></td>
          <td><?php echo htmlspecialchars($p['Sexo'] ?? ''); ?></td>
          <td><?php echo htmlspecialchars($p['Peso'] ?? ''); ?></td>
          <td><?php echo htmlspecialchars($p['Altura'] ?? ''); ?></td>
          <td><?php echo htmlspecialchars($p['Tipo_sangre'] ?? ''); ?></td>
          <td><?php echo htmlspecialchars($p['Alergias'] ?? ''); ?></td>
          <td><?php echo htmlspecialchars($p['Enfermedades'] ?? ''); ?></td>
          <td class="text-end">
            <a class="btn btn-sm btn-primary" href="<?php echo BASE_URL; ?>paciente/editar/<?php echo urlencode($p['Id_Usuario']); ?>">
              <i class="fas fa-edit"></i> Editar
            </a>
            <form action="<?php echo BASE_URL; ?>paciente/eliminar/<?php echo urlencode($p['Id_Usuario']); ?>" method="post" class="d-inline" onsubmit="return confirm('¿Deseas eliminar este paciente? Esta acción no se puede deshacer.');">
              <button type="submit" class="btn btn-sm btn-danger">
                <i class="fas fa-trash-alt"></i> Eliminar
              </button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>