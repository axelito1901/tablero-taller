<?php
require_once 'conexion.php';

$exito = false;
$error = false;

// --- LÓGICA ELIMINAR ---
if (isset($_POST['eliminar_id'])) {
  $id = intval($_POST['eliminar_id']);
  if ($id) {
    // Chequear si tiene órdenes asociadas
    $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM ordenes_trabajo WHERE mecanico_id = ?");
    $stmtCheck->bind_param("i", $id);
    $stmtCheck->execute();
    $stmtCheck->bind_result($cantOrdenes);
    $stmtCheck->fetch();
    $stmtCheck->close();
    if ($cantOrdenes > 0) {
      $error = "No se puede eliminar el mecánico porque tiene órdenes asignadas.";
    } else {
      $stmt = $conn->prepare("DELETE FROM mecanicos WHERE id = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $exito = true;
      header("Location: editor_mecanicos.php?exito=1");
      exit;
    }
  }
}

// --- LÓGICA AGREGAR ---
if (isset($_POST['agregar'])) {
  $nombre = trim($_POST['nombre'] ?? '');
  $legajo = trim($_POST['legajo'] ?? '');
  if ($nombre && $legajo) {
    // Evita duplicados por legajo
    $stmt = $conn->prepare("SELECT id FROM mecanicos WHERE legajo = ?");
    $stmt->bind_param("s", $legajo);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
      $stmt2 = $conn->prepare("INSERT INTO mecanicos (nombre, legajo) VALUES (?, ?)");
      $stmt2->bind_param("ss", $nombre, $legajo);
      $stmt2->execute();
      $exito = true;
      header("Location: editor_mecanicos.php?exito=1");
      exit;
    } else {
      $error = "Ya existe un mecánico con ese legajo.";
    }
    $stmt->close();
  }
}

// --- LÓGICA EDITAR ---
if (isset($_POST['editar_id'], $_POST['editar_nombre'], $_POST['editar_legajo'])) {
  $id = intval($_POST['editar_id']);
  $nombre = trim($_POST['editar_nombre']);
  $legajo = trim($_POST['editar_legajo']);
  if ($id && $nombre && $legajo) {
    // Verificar que no exista ese legajo en otro mecánico
    $stmt = $conn->prepare("SELECT id FROM mecanicos WHERE legajo = ? AND id <> ?");
    $stmt->bind_param("si", $legajo, $id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
      $stmt2 = $conn->prepare("UPDATE mecanicos SET nombre = ?, legajo = ? WHERE id = ?");
      $stmt2->bind_param("ssi", $nombre, $legajo, $id);
      $stmt2->execute();
      $exito = true;
      header("Location: editor_mecanicos.php?exito=1");
      exit;
    } else {
      $error = "Ya existe otro mecánico con ese legajo.";
    }
    $stmt->close();
  }
}

// Mensaje de éxito al volver del redirect
if (isset($_GET['exito'])) $exito = true;

// Avatar helpers (igual que antes)
function vwAvatarInitials($n) {
  $n = explode(' ', strtoupper($n)); return $n[0][0].($n[1][0]??'');
}
function vwAvatarColor($n) {
  $vwColors = ['#1976d2','#003087','#29b6f6','#145ea8','#005ea8','#334e7d'];
  $hash = abs(crc32($n)); return $vwColors[$hash % count($vwColors)];
}

include 'menu.php';
include 'boton_flotante.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editor de Mecánicos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preload" href="VWText-Regular.otf" as="font" type="font/otf" crossorigin>
  <link rel="preload" href="VWHead-Bold.otf" as="font" type="font/otf" crossorigin>
  <style>
    @font-face { font-family: 'VWText'; src: url('VWText-Regular.otf'); font-weight: 400;}
    @font-face { font-family: 'VWText'; src: url('VWText-Bold.otf'); font-weight: 700;}
    @font-face { font-family: 'VWHead'; src: url('VWHead-Bold.otf'); font-weight: 700;}
    body {
      background: #f4f7fb;
      font-family: 'VWText', Arial, sans-serif;
      color: #19324a;
      margin: 0; padding: 0;
    }
    .vw-panel {
      background: #fff;
      border-radius: 2.1rem;
      box-shadow: 0 8px 36px rgba(30,60,90,0.08), 0 1.5px 5px rgba(30,60,90,0.04);
      padding: 2.2rem 2.5rem 2.6rem 2.5rem;
      margin: 3rem auto 2rem auto;
      max-width: 900px;
      min-width: 290px;
    }
    .vw-header {
      display: flex; align-items: center; gap: 15px;
      font-family: 'VWHead', 'VWText', Arial, sans-serif;
      font-size: 2.1rem;
      font-weight: 700;
      color: #1564c0;
      margin-bottom: 1.3rem;
      letter-spacing: .01em;
    }
    .vw-header svg {
      width: 2.3em; height: 2.3em;
      color: #1875d2;
      filter: drop-shadow(0 2px 10px #eaf1fb);
    }
    .vw-alert {
      background: #e3f9db; color: #278337; border-radius: 12px; padding: 13px 18px; font-size: 1.08rem;
      margin-bottom: 1.2rem; display: flex; align-items: center; gap: 10px; border: 0;
      box-shadow: 0 2px 14px rgba(60,190,90,0.05);
    }
    .vw-alert svg { width: 1.2em; height: 1.2em; color: #84b600;}
    .vw-alert.vw-error {
      background: #fde2e3; color: #b31730;
      font-weight: bold;
    }
    .vw-form-row {
      display: flex; gap: 15px; margin-bottom: 0.6rem;
    }
    .vw-form-row input[type="text"] {
      flex: 1 1 220px; min-width: 120px; padding: 0.85em 1.1em;
      font-size: 1.07rem; border: 1.5px solid #e2ebf7; border-radius: 10px;
      background: #f7fafd; transition: border .17s;
    }
    .vw-btn-add {
      background: #1875d2; color: #fff;
      border: none; border-radius: 10px; padding: 0.85em 1.3em;
      font-size: 1.08rem; font-weight: 600;
      display: flex; align-items: center; gap: 7px;
      box-shadow: 0 2px 12px rgba(30,60,120,0.06);
      transition: background .17s, box-shadow .18s;
    }
    .vw-btn-add svg { width: 1.2em; height: 1.2em; color: #ffe200; }
    .vw-btn-add:hover { background: #1152a6;}
    .vw-search-row {
      margin-bottom: 1.2rem;
      display: flex;
      justify-content: flex-end;
    }
    .vw-search-input {
      border-radius: 8px; border: 1.5px solid #d8e4f8; padding: 0.7em 1em 0.7em 2.5em;
      background: #f9fbfe; font-size: 1.08rem;
      min-width: 220px; width: 100%;
      background-image: url('data:image/svg+xml;utf8,<svg fill="gray" height="20" width="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M12.9 14.32a8 8 0 111.41-1.41l5.38 5.38a1 1 0 01-1.42 1.42l-5.37-5.39zm-5.9 0a6 6 0 100-12 6 6 0 000 12z"/></svg>');
      background-repeat: no-repeat; background-position: 8px center;
    }
    .vw-table {
      border-radius: 17px; overflow: hidden;
      box-shadow: 0 2px 12px rgba(30,60,90,0.08);
      margin-top: 1.2rem;
    }
    table {
      width: 100%; border-collapse: separate; border-spacing: 0;
      background: transparent;
    }
    thead tr {
      background: linear-gradient(90deg, #1585e2 0%, #0d4ca5 100%);
      color: #fff;
    }
    th, td {
      padding: 1em 1.2em; text-align: left;
      font-size: 1.08rem;
      border-bottom: 1.5px solid #f1f7ff;
    }
    tbody tr {
      background: #f7fafd;
      transition: background .14s;
    }
    tbody tr:hover {
      background: #e4f0fa;
    }
    .vw-avatar {
      display: inline-flex; align-items: center; justify-content: center;
      font-size: 1.17rem; font-weight: 700; color: #fff;
      width: 2.2em; height: 2.2em; border-radius: 50%;
      margin-right: 0.7em; box-shadow: 0 2px 10px rgba(20,60,120,0.07);
      border: 2.5px solid #fff;
    }
    .vw-table-actions {
      display: flex; gap: 13px;
    }
    .vw-btn-editar, .vw-btn-eliminar, .vw-btn-guardar, .vw-btn-cancelar {
      font-size: 1.04rem; padding: 0.6em 1.2em; border-radius: 9px; border: none;
      font-weight: 600; text-decoration: none; outline: none;
      box-shadow: 0 1px 7px rgba(10,60,120,0.03);
      transition: background .14s, color .14s;
      display: inline-flex; align-items: center; gap: 7px;
      cursor: pointer;
    }
    .vw-btn-editar { background: #ffe180; color: #1b3388;}
    .vw-btn-editar:hover { background: #fff066;}
    .vw-btn-eliminar { background: #ff758f; color: #fff;}
    .vw-btn-eliminar:hover { background: #fd4767;}
    .vw-btn-guardar { background: #69e583; color: #173d24;}
    .vw-btn-guardar:hover { background: #4fd167;}
    .vw-btn-cancelar { background: #e2e8f6; color: #22374e;}
    .vw-btn-cancelar:hover { background: #c7d4ee;}
    #exportarExcel {
      font-size: 1.06rem; border-radius: 7px; padding: 0.55em 1em; border: 1.5px solid #1976d2;
      background: #f7fafd; color: #1976d2; font-weight: 600; box-shadow: none;
      margin-top: 0.6rem;
      transition: background .13s, color .13s;
    }
    #exportarExcel:hover { background: #1976d2; color: #fff;}
    /* Responsive */
    @media (max-width: 600px) {
      .vw-panel { padding: 1rem 3vw; }
      .vw-header { font-size: 1.3rem;}
      th, td { font-size: .99rem; padding: 0.6em 0.5em;}
      .vw-btn-editar, .vw-btn-eliminar, .vw-btn-guardar, .vw-btn-cancelar { padding: 0.5em 0.7em; font-size: 0.97rem;}
      .vw-avatar { font-size: 0.95rem; margin-right: 0.4em;}
    }
  </style>
</head>
<body>
  <div class="vw-panel">
    <div class="vw-header">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 20a6.5 6.5 0 0 1 13 0"/></svg>
      Editor de Mecánicos
    </div>

    <?php if ($error): ?>
      <div class="vw-alert vw-error">
        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <?php if ($exito): ?>
      <div class="vw-alert">
        <svg fill="currentColor" viewBox="0 0 20 20"><path d="M13.28 2.71a1 1 0 011.41 1.42L4.12 14.7a1 1 0 01-1.41-1.41L13.28 2.71zM3 12a9 9 0 1114 0 9 9 0 01-14 0z"/></svg>
        Cambios guardados.
      </div>
    <?php endif; ?>

    <form method="post" class="vw-form-row" style="margin-bottom:1.3rem;">
      <input type="text" name="nombre" placeholder="Nombre completo" required>
      <input type="text" name="legajo" placeholder="Legajo" required>
      <button class="vw-btn-add" type="submit" name="agregar">
        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
    Agregar
      </button>
    </form>

    <div class="vw-search-row">
      <input type="text" id="buscadorMecanico" class="vw-search-input" placeholder="🔍 Buscar mecánico o legajo...">
    </div>

    <div class="vw-table">
      <table id="tablaMecanicos">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Legajo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $res = $conn->query("SELECT * FROM mecanicos ORDER BY legajo ASC");
          while ($m = $res->fetch_assoc()):
            if (isset($_GET['editar']) && $_GET['editar'] == $m['id']): ?>
              <tr>
                <form method="post">
                  <td>
                    <input type="text" name="editar_nombre" value="<?= htmlspecialchars($m['nombre']) ?>" required class="form-control">
                    <input type="hidden" name="editar_id" value="<?= $m['id'] ?>">
                  </td>
                  <td><input type="text" name="editar_legajo" value="<?= htmlspecialchars($m['legajo']) ?>" required class="form-control"></td>
                  <td class="vw-table-actions">
                    <button type="submit" class="vw-btn-guardar">Guardar</button>
                    <a href="editor_mecanicos.php" class="vw-btn-cancelar">Cancelar</a>
                  </td>
                </form>
              </tr>
            <?php else: ?>
              <tr data-nombre="<?= strtolower($m['nombre']) ?>" data-legajo="<?= strtolower($m['legajo']) ?>">
                <td>
                  <span class="vw-avatar" style="background:<?= vwAvatarColor($m['nombre']) ?>">
                    <?= vwAvatarInitials($m['nombre']) ?>
                  </span>
                  <?= htmlspecialchars($m['nombre']) ?>
                </td>
                <td><?= htmlspecialchars($m['legajo']) ?></td>
                <td class="vw-table-actions">
                  <a href="editor_mecanicos.php?editar=<?= $m['id'] ?>" class="vw-btn-editar">Editar</a>
                  <button class="vw-btn-eliminar" data-id="<?= $m['id'] ?>" data-nombre="<?= htmlspecialchars($m['nombre']) ?>" type="button">Eliminar</button>
                </td>
              </tr>
            <?php endif;
          endwhile; ?>
        </tbody>
      </table>
    </div>
    <div class="mt-4 mb-2" style="text-align:right;">
      <button id="exportarExcel" class="btn btn-outline-primary"><b>⇩ Exportar a Excel</b></button>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script>
// Buscador en vivo
document.getElementById('buscadorMecanico').addEventListener('input', function() {
  let v = this.value.trim().toLowerCase();
  document.querySelectorAll('#tablaMecanicos tbody tr').forEach(tr=>{
    let nom = tr.dataset.nombre || '';
    let leg = tr.dataset.legajo || '';
    tr.style.display = (nom.includes(v) || leg.includes(v)) ? '' : 'none';
  });
});
// Modal Eliminar
document.querySelectorAll('.vw-btn-eliminar').forEach(btn=>{
  btn.onclick = function(e){
    let id = btn.dataset.id, nombre = btn.dataset.nombre;
    Swal.fire({
      title: '¿Eliminar mecánico?',
      html: `<b>${nombre}</b><br><span style="font-size:.98em;color:#789;">Esta acción no se puede deshacer</span>`,
      icon: 'warning', showCancelButton: true, focusCancel:true,
      confirmButtonText: 'Sí, eliminar', confirmButtonColor:'#ff4747',
      cancelButtonText: 'Cancelar', cancelButtonColor:'#1976d2',
      background: '#fff'
    }).then(res=>{
      if(res.isConfirmed){
        let f = document.createElement('form');
        f.method = "post";
        f.innerHTML = `<input name="eliminar_id" value="${id}">`;
        document.body.appendChild(f); f.submit();
      }
    });
  }
});
// Exportar a Excel
document.getElementById('exportarExcel').onclick = function() {
  let data = [["Nombre", "Legajo"]];
  document.querySelectorAll('#tablaMecanicos tbody tr').forEach(tr=>{
    if(tr.style.display==="none")return;
    let tds = tr.querySelectorAll("td");
    if(tds.length>=2) data.push([tds[0].innerText.trim(), tds[1].innerText.trim()]);
  });
  let wb = XLSX.utils.book_new();
  let ws = XLSX.utils.aoa_to_sheet(data);
  XLSX.utils.book_append_sheet(wb, ws, "Mecanicos");
  XLSX.writeFile(wb, "MecanicosVW.xlsx");
};

// Oculta las alertas después de 3 segundos (3000ms)
setTimeout(function() {
  document.querySelectorAll('.vw-alert').forEach(function(el){
    el.style.transition = 'opacity 0.6s';
    el.style.opacity = '0';
    setTimeout(()=>el.style.display='none', 700);
  });
}, 3000);
</script>
</body>
</html>
