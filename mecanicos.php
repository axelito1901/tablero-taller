<?php
require_once 'conexion.php';
include 'menu.php';
include 'boton_flotante.php';

// Alta de mecánico
$errores = [];
if (isset($_POST['nombre_mecanico'], $_POST['legajo']) && !empty($_POST['nombre_mecanico']) && !empty($_POST['legajo'])) {
    $nombre = $conn->real_escape_string($_POST['nombre_mecanico']);
    $legajo = $conn->real_escape_string($_POST['legajo']);
    $conn->query("INSERT INTO mecanicos (nombre, legajo) VALUES ('$nombre', '$legajo')");
    header("Location: mecanicos.php");
    exit;
}
$mecanicos = $conn->query("SELECT * FROM mecanicos ORDER BY nombre");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mecánicos | Tablero VW</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @font-face {font-family: 'VWText';src: url('VWText-Regular.otf');font-weight: 400;}
    @font-face {font-family: 'VWHead';src: url('VWHead-Regular.otf');font-weight: 400;}
    body {font-family: 'VWText', Arial, sans-serif;background-color: #f4f8fb;color: #232b38;}
    h1 {font-family: 'VWHead', 'VWText', Arial, sans-serif;font-weight: 700;font-size: 2.1rem;text-align: center;margin-bottom: 20px;color: #001e50;}
    .main-content {margin-left: 170px;}
    @media (max-width: 991px) {.main-content {margin-left: 60px;}}
    @media (max-width: 600px) {.main-content {margin-left: 0;}}
  </style>
</head>
<body>
  <div class="main-content container py-4">
    <h1 class="mb-4 text-center fw-bold text-primary">Gestión de Mecánicos</h1>
    <!-- Formulario alta -->
    <div class="card mb-4 shadow-sm">
      <div class="card-header bg-secondary text-white fw-semibold">Agregar Mecánico</div>
      <div class="card-body">
        <form method="post" class="row g-3 align-items-center">
          <div class="col-md-5"><input type="text" name="nombre_mecanico" class="form-control" placeholder="Nombre Mecánico" required></div>
          <div class="col-md-4"><input type="text" name="legajo" class="form-control" placeholder="Legajo" required></div>
          <div class="col-md-2"><button type="submit" class="btn btn-primary">Agregar</button></div>
        </form>
      </div>
    </div>
    <!-- Tabla -->
    <div class="card shadow-sm">
      <div class="card-header bg-secondary text-white fw-semibold">Lista de Mecánicos</div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark"><tr><th>Nombre</th><th>Legajo</th></tr></thead>
            <tbody>
              <?php while($m = $mecanicos->fetch_assoc()): ?>
                <tr><td><?= htmlspecialchars($m['nombre']) ?></td><td><?= htmlspecialchars($m['legajo']) ?></td></tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
