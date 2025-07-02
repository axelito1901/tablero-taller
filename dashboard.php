<?php
require_once 'conexion.php';
include 'menu.php';
include 'boton_flotante.php';

// Dashboard de indicadores
$hoy = date('Y-m-d');
$mes = date('Y-m');
$dias_lab_mes = 0;
$fecha_ini = date('Y-m-01');
$fecha_fin = date('Y-m-t');
$actual = $fecha_ini;
while ($actual <= $fecha_fin) {
    $dia_semana = date('N', strtotime($actual)); // 1=lunes ... 7=domingo
    if ($dia_semana < 6) $dias_lab_mes++;
    $actual = date('Y-m-d', strtotime($actual . ' +1 day'));
}
$res = $conn->query("SELECT COUNT(DISTINCT DATE(fecha_apertura)) as dias_presentes FROM ordenes_trabajo WHERE fecha_apertura BETWEEN '$fecha_ini' AND '$fecha_fin'");
$dias_presentes = $res->fetch_assoc()['dias_presentes'];
$presencia = $dias_lab_mes > 0 ? round(($dias_presentes / $dias_lab_mes) * 100) : 0;

$min_laborales = $dias_lab_mes * 9 * 60;
$res2 = $conn->query("SELECT SUM(tiempo_fichado) as min_fichados FROM ordenes_trabajo WHERE fecha_apertura BETWEEN '$fecha_ini' AND '$fecha_fin'");
$min_fichados = $res2->fetch_assoc()['min_fichados'] ?: 0;
$ocupacion = $min_laborales > 0 ? round(($min_fichados / $min_laborales) * 100) : 0;

$res3 = $conn->query("SELECT SUM(tiempo_estandar) as min_estandar FROM ordenes_trabajo WHERE fecha_apertura BETWEEN '$fecha_ini' AND '$fecha_fin'");
$min_estandar = $res3->fetch_assoc()['min_estandar'] ?: 0;
$productividad = $min_fichados > 0 ? round(($min_estandar / $min_fichados) * 100) : 0;
$eficiencia = $min_estandar > 0 ? round(($min_fichados / $min_estandar) * 100) : 0;
$rendimiento = round(($presencia + $ocupacion + $productividad + $eficiencia) / 4);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard | Tablero VW</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @font-face {font-family: 'VWText';src: url('VWText-Regular.otf');font-weight: 400;}
    @font-face {font-family: 'VWText';src: url('VWText-Bold.otf');font-weight: 700;}
    @font-face {font-family: 'VWHead';src: url('VWHead-Regular.otf');font-weight: 400;}
    @font-face {font-family: 'VWHead';src: url('VWHead-Bold.otf');font-weight: 700;}
    body {font-family: 'VWText', Arial, sans-serif;background-color: #f4f8fb;color: #232b38;}
    h1 {font-family: 'VWHead', 'VWText', Arial, sans-serif;font-weight: 700;font-size: 2.1rem;text-align: center;margin-bottom: 20px;letter-spacing: 0.01em;color: #001e50;}
    .main-content {margin-left: 170px;}
    .dashboard {display: flex;flex-wrap: wrap;justify-content: center;gap: 18px;margin-bottom: 40px;}
    .dashboard .card {min-width: 140px;max-width: 170px;flex: 1 1 150px;box-shadow: 0 2px 16px rgba(0,0,0,0.06);border-radius: 16px !important;}
    .dashboard .card-header {background: #001e50 !important;font-size: 1.13em;font-family: 'VWHead', Arial, sans-serif;font-weight: 700;letter-spacing: 0.04em;text-align: center;border-bottom: none;padding: 0.65em 0.3em;}
    .dashboard .card-body {padding: 1.1em 0.3em 1em 0.3em;text-align: center;font-family: 'VWText', Arial, sans-serif;font-weight: 700;font-size: 2.1em;}
    .dashboard .bg-primary {background: #1976d2 !important;}
    .dashboard .bg-success {background: #009688 !important;}
    .dashboard .bg-warning {background: #ffc107 !important; color: #001e50 !important;}
    .dashboard .bg-info {background: #29b6f6 !important; color: #001e50 !important;}
    .dashboard .bg-dark {background: #232b38 !important;}
    @media (max-width: 991px) {.main-content {margin-left: 60px;}}
    @media (max-width: 600px) {.main-content {margin-left: 0;}}
  </style>
</head>
<body>
  <div class="main-content container py-4">
    <img src="assets/vwlogo.png" alt="vw-logo" class="vw-logo mx-auto d-block">
    <h1 class="mb-4 text-center fw-bold text-primary">Tablero de Control del Taller - Dashboard</h1>
    <div class="dashboard mb-4">
      <div class="card text-white bg-primary shadow">
        <div class="card-header text-center fw-semibold">Presencia</div>
        <div class="card-body text-center"><span class="display-6"><?= $presencia ?>%</span></div>
      </div>
      <div class="card text-white bg-success shadow">
        <div class="card-header text-center fw-semibold">Ocupación</div>
        <div class="card-body text-center"><span class="display-6"><?= $ocupacion ?>%</span></div>
      </div>
      <div class="card text-white bg-warning shadow">
        <div class="card-header text-center fw-semibold">Productividad</div>
        <div class="card-body text-center"><span class="display-6"><?= $productividad ?>%</span></div>
      </div>
      <div class="card text-white bg-info shadow">
        <div class="card-header text-center fw-semibold">Eficiencia</div>
        <div class="card-body text-center"><span class="display-6"><?= $eficiencia ?>%</span></div>
      </div>
      <div class="card text-white bg-dark shadow">
        <div class="card-header text-center fw-semibold">Rendimiento</div>
        <div class="card-body text-center"><span class="display-6"><?= $rendimiento ?>%</span></div>
      </div>
    </div>
  </div>
</body>
</html>
