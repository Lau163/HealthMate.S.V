<?php
// views/doctor/doctor.view.php

$doctores = $doctores ?? ($this->get('doctores') ?? []);
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);
?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Doctores</h2>
    <form class="d-flex" method="get" action="">
      <input class="form-control me-2" type="search" name="q" placeholder="Buscar por nombre o email" value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
      <button class="btn btn-outline-primary" type="submit">Buscar</button>
    </form>
  </div>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>
  <?php if ($success): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
  <?php endif; ?>

  <?php
    // Filtro simple en memoria si se pasó ?q= en la URL
    $q = strtolower(trim($_GET['q'] ?? ''));
    if ($q !== '') {
      $doctores = array_values(array_filter($doctores, function($d) use ($q) {
        return strpos(strtolower($d['Nombre'] ?? ''), $q) !== false
            || strpos(strtolower($d['Email'] ?? ''), $q) !== false;
      }));
    }
  ?>

  <?php if (empty($doctores)): ?>
    <div class="alert alert-info">No hay doctores para mostrar.</div>
  <?php else: ?>
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
          <?php foreach ($doctores as $d): ?>
            <tr>
              <td><?php echo htmlspecialchars($d['Id_Usuario'] ?? ''); ?></td>
              <td><?php echo htmlspecialchars($d['Nombre'] ?? ''); ?></td>
              <td><?php echo htmlspecialchars($d['Email'] ?? ''); ?></td>
              <td><?php echo htmlspecialchars($d['Edad'] ?? ''); ?></td>
              <td><?php echo htmlspecialchars($d['Sexo'] ?? ''); ?></td>
              <td><?php echo htmlspecialchars($d['Peso'] ?? ''); ?></td>
              <td><?php echo htmlspecialchars($d['Altura'] ?? ''); ?></td>
              <td><?php echo htmlspecialchars($d['Tipo_sangre'] ?? ''); ?></td>
              <td><?php echo htmlspecialchars($d['Alergias'] ?? ''); ?></td>
              <td><?php echo htmlspecialchars($d['Enfermedades'] ?? ''); ?></td>
              <td class="text-end">
                <a class="btn btn-sm btn-primary" href="<?php echo BASE_URL; ?>doctor/editar/<?php echo urlencode($d['Id_Usuario']); ?>">
                  <i class="fas fa-edit"></i> Editar
                </a>
                <form action="<?php echo BASE_URL; ?>doctor/eliminar/<?php echo urlencode($d['Id_Usuario']); ?>" method="post" class="d-inline" onsubmit="return confirm('¿Deseas eliminar este doctor? Esta acción no se puede deshacer.');">
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
  <?php endif; ?>
</div>
