<?php include 'menu.php';
include 'boton_flotante.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Configuración | Tablero VW</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @font-face {font-family: 'VWText';src: url('VWText-Regular.otf');font-weight: 400;}
    @font-face {font-family: 'VWHead';src: url('VWHead-Regular.otf');font-weight: 400;}
    body {font-family: 'VWText', Arial, sans-serif;background-color: #f4f8fb;color: #232b38;
    h1 {font-family: 'VWHead', 'VWText', Arial, sans-serif;font-weight: 700;font-size: 2.1rem;text-align: center;margin-bottom: 20px;color: #001e50;}
    .main-content {margin-left: 170px;}
    @media (max-width: 991px) {.main-content {margin-left: 60px;}}
    @media (max-width: 600px) {.main-content {margin-left: 0;}}
  </style>
</head>
<body>
  <div class="main-content container py-4">
    <h1 class="mb-4 text-center fw-bold text-primary">Configuración</h1>
    <p>Pendiente...</p>

    <form method="post" enctype="multipart/form-data">
      <label>Seleccionar backup (.sql):</label>
        <input type="file" name="backup_sql" accept=".sql" required>
          <br><br>
            <button type="submit" name="restaurar">Restaurar Base de Datos</button>
    </form>
  </div>
</body>
</html>