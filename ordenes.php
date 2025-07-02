<?php
require_once 'conexion.php';
include 'menu.php';
include 'boton_flotante.php';

$estados = ["Abierta", "Cerrada", "En espera", "Pausada", "Cancelada"];
$tipos_trabajo = ["Mecánica general", "Mantenimiento", "Garantía", "Reparación rápida", "Otro"];
$errores = [];

$mecanicos = $conn->query("SELECT id, nombre FROM mecanicos");

// Alta de orden
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['numero_orden'])) {
    if (empty($_POST['numero_orden'])) $errores[] = "Falta el número de orden.";
    if (empty($_POST['mecanico_id'])) $errores[] = "Seleccioná el mecánico.";
    if (empty($_POST['fecha_apertura'])) $errores[] = "Falta la fecha de apertura.";
    if (empty($_POST['fecha_cierre'])) $errores[] = "Falta la fecha de cierre.";
    if (!in_array($_POST['estado'], $estados)) $errores[] = "Estado inválido.";
    if (!in_array($_POST['tipo_trabajo'], $tipos_trabajo)) $errores[] = "Tipo de trabajo inválido.";

    if (count($errores) === 0) {
        $sql = "INSERT INTO ordenes_trabajo 
          (numero_orden, cliente, unidad, fecha_apertura, fecha_cierre, asesor, mecanico_id, estado, observaciones, tareas_especiales, tiempo_espera, tiempo_fichado, tiempo_estandar, tipo_trabajo)
          VALUES (
            '{$conn->real_escape_string($_POST['numero_orden'])}',
            '{$conn->real_escape_string($_POST['cliente'])}',
            '{$conn->real_escape_string($_POST['unidad'])}',
            '{$_POST['fecha_apertura']}',
            '{$_POST['fecha_cierre']}',
            '{$conn->real_escape_string($_POST['asesor'])}',
            {$_POST['mecanico_id']},
            '{$conn->real_escape_string($_POST['estado'])}',
            '{$conn->real_escape_string($_POST['observaciones'])}',
            '{$conn->real_escape_string($_POST['tareas_especiales'])}',
            ".(int)$_POST['tiempo_espera'].",
            ".(int)$_POST['tiempo_fichado'].",
            ".(int)$_POST['tiempo_estandar'].",
            '{$conn->real_escape_string($_POST['tipo_trabajo'])}'
          )";
        $conn->query($sql);
        header("Location: ordenes.php");
        exit;
    }
}

// Consulta órdenes
$ordenes = $conn->query("SELECT o.*, m.nombre AS mecanico FROM ordenes_trabajo o LEFT JOIN mecanicos m ON o.mecanico_id = m.id ORDER BY o.fecha_apertura DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Órdenes | Tablero VW</title>
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
    <h1 class="mb-4 text-center fw-bold text-primary">Órdenes de Trabajo</h1>
    <!-- MOSTRAR ERRORES -->
    <?php if (!empty($errores)): ?>
      <div class="alert alert-danger">
        <ul class="mb-0"><?php foreach($errores as $err): ?><li><?= $err ?></li><?php endforeach; ?></ul>
      </div>
    <?php endif; ?>
    <!-- Formulario de alta -->
    <div class="card mb-4 shadow-sm">
      <div class="card-header bg-secondary text-white fw-semibold">Agregar Orden de Trabajo</div>
      <div class="card-body">
        <form method="post" class="row g-3">
          <div class="col-md-2"><input type="text" name="numero_orden" class="form-control" placeholder="N° Orden" required></div>
          <div class="col-md-2"><input type="text" name="cliente" class="form-control" placeholder="Cliente"></div>
          <div class="col-md-2"><input type="text" name="unidad" class="form-control" placeholder="Unidad"></div>
          <div class="col-md-2"><input type="datetime-local" name="fecha_apertura" class="form-control" placeholder="Apertura" required></div>
          <div class="col-md-2"><input type="datetime-local" name="fecha_cierre" class="form-control" placeholder="Cierre" required></div>
          <div class="col-md-2"><input type="text" name="asesor" class="form-control" placeholder="Asesor"></div>
          <div class="col-md-2">
            <select name="mecanico_id" class="form-select" required>
              <option value="">Mecánico</option>
              <?php
              $mecanicos->data_seek(0);
              while($m = $mecanicos->fetch_assoc()): ?>
                <option value="<?= $m['id'] ?>"><?= $m['nombre'] ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-md-2">
            <select name="estado" class="form-select" required>
              <option value="">Estado</option>
              <?php foreach($estados as $op): ?>
                <option value="<?= $op ?>"><?= $op ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-2"><input type="text" name="observaciones" class="form-control" placeholder="Observaciones"></div>
          <div class="col-md-2"><input type="text" name="tareas_especiales" class="form-control" placeholder="Tareas Especiales"></div>
          <div class="col-md-2"><input type="number" name="tiempo_espera" class="form-control" placeholder="Espera (min)"></div>
          <div class="col-md-2"><input type="number" name="tiempo_fichado" class="form-control" placeholder="Fichado (min)"></div>
          <div class="col-md-2"><input type="number" name="tiempo_estandar" class="form-control" placeholder="Estándar (min)"></div>
          <div class="col-md-2">
            <select name="tipo_trabajo" class="form-select" required>
              <option value="">Tipo de Trabajo</option>
              <?php foreach($tipos_trabajo as $op): ?>
                <option value="<?= $op ?>"><?= $op ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-success w-100">Agregar Orden</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Tabla de órdenes -->
    <div class="card shadow-sm">
      <div class="card-header bg-secondary text-white fw-semibold">Órdenes de Trabajo</div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
              <tr>
                <th>N° Orden</th><th>Cliente</th><th>Unidad</th><th>Apertura</th><th>Cierre</th>
                <th>Asesor</th><th>Mecánico</th><th>Estado</th>
                <th>Observaciones</th><th>Tareas Especiales</th>
                <th>Espera</th><th>Fichado</th><th>Estándar</th><th>Tipo Trabajo</th>
              </tr>
            </thead>
            <tbody>
              <?php while($o = $ordenes->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($o['numero_orden']) ?></td>
                  <td><?= htmlspecialchars($o['cliente']) ?></td>
                  <td><?= htmlspecialchars($o['unidad']) ?></td>
                  <td><?= htmlspecialchars($o['fecha_apertura']) ?></td>
                  <td><?= htmlspecialchars($o['fecha_cierre']) ?></td>
                  <td><?= htmlspecialchars($o['asesor']) ?></td>
                  <td><?= htmlspecialchars($o['mecanico']) ?></td>
                  <td><?= htmlspecialchars($o['estado']) ?></td>
                  <td><?= htmlspecialchars($o['observaciones']) ?></td>
                  <td><?= htmlspecialchars($o['tareas_especiales']) ?></td>
                  <td><?= htmlspecialchars($o['tiempo_espera']) ?></td>
                  <td><?= htmlspecialchars($o['tiempo_fichado']) ?></td>
                  <td><?= htmlspecialchars($o['tiempo_estandar']) ?></td>
                  <td><?= htmlspecialchars($o['tipo_trabajo']) ?></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
