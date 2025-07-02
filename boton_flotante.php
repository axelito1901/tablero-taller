<!-- BOTÓN FLOTANTE Y MODAL AGREGAR ORDEN FUNCIONAL -->

<!-- Botón flotante -->
<button class="vw-fab btn btn-primary rounded-circle shadow-lg"
  title="Agregar Orden"
  data-bs-toggle="modal"
  data-bs-target="#modalAgregarOrden"
  id="vwFabBtn">
  <span class="vw-fab-plus">+</span>
</button>

<div class="vw-fab-tooltip" id="vwFabTooltip">Agregar Orden</div>

<!-- Modal para agregar orden -->
<div class="modal fade" id="modalAgregarOrden" tabindex="-1" aria-labelledby="modalOrdenLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="ordenes.php">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalOrdenLabel">Agregar Orden de Trabajo</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-3"><input type="text" name="numero_orden" class="form-control" placeholder="N° Orden" required></div>
            <div class="col-md-3"><input type="text" name="cliente" class="form-control" placeholder="Cliente"></div>
            <div class="col-md-3"><input type="text" name="unidad" class="form-control" placeholder="Unidad"></div>
            <div class="col-md-3"><input type="datetime-local" name="fecha_apertura" class="form-control" placeholder="Apertura" required></div>
            <div class="col-md-3"><input type="datetime-local" name="fecha_cierre" class="form-control" placeholder="Cierre" required></div>
            <div class="col-md-3"><input type="text" name="asesor" class="form-control" placeholder="Asesor"></div>
            <div class="col-md-3">
              <select name="mecanico_id" class="form-select" required>
                <option value="">Mecánico</option>
                <?php
                if (!isset($conn)) require_once 'conexion.php';
                $mecanicos_modal = $conn->query("SELECT id, nombre FROM mecanicos");
                while($m = $mecanicos_modal->fetch_assoc()): ?>
                  <option value="<?= $m['id'] ?>"><?= $m['nombre'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="col-md-3">
              <select name="estado" class="form-select" required>
                <option value="">Estado</option>
                <?php
                $estados = ["Abierta", "Cerrada", "En espera", "Pausada", "Cancelada"];
                foreach($estados as $op): ?>
                  <option value="<?= $op ?>"><?= $op ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-3"><input type="text" name="observaciones" class="form-control" placeholder="Observaciones"></div>
            <div class="col-md-3"><input type="text" name="tareas_especiales" class="form-control" placeholder="Tareas Especiales"></div>
            <div class="col-md-2"><input type="number" name="tiempo_espera" class="form-control" placeholder="Espera (min)"></div>
            <div class="col-md-2"><input type="number" name="tiempo_fichado" class="form-control" placeholder="Fichado (min)"></div>
            <div class="col-md-2"><input type="number" name="tiempo_estandar" class="form-control" placeholder="Estándar (min)"></div>
            <div class="col-md-3">
              <select name="tipo_trabajo" class="form-select" required>
                <option value="">Tipo de Trabajo</option>
                <?php
                $tipos_trabajo = ["Mecánica general", "Mantenimiento", "Garantía", "Reparación rápida", "Otro"];
                foreach($tipos_trabajo as $op): ?>
                  <option value="<?= $op ?>"><?= $op ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Agregar Orden</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
.vw-fab {
  position: fixed;
  right: 26px;
  bottom: 34px;
  width: 62px;
  height: 62px;
  font-size: 2.45rem;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1200;
  background: #1976d2 !important;
  border: none;
  box-shadow: 0 8px 36px rgba(30,60,90,0.25), 0 2px 8px rgba(30,60,90,0.18);
  transition: background 0.22s, box-shadow 0.22s, transform 0.20s;
  animation: fabBounceIn 0.6s cubic-bezier(.3,1.3,.2,1) 0.2s backwards;
}
.vw-fab-plus {
  font-size: 2.4rem;
  color: #fff;
  font-weight: 700;
  filter: drop-shadow(0 2px 6px rgba(0,0,0,0.10));
  transition: color 0.22s;
}
.vw-fab:hover {
  background: #00449f !important;
  box-shadow: 0 14px 50px rgba(0,30,80,0.23), 0 2px 16px rgba(30,60,90,0.19);
  transform: scale(1.10) rotate(-8deg);
}
.vw-fab:active {
  transform: scale(0.96) rotate(2deg);
}
@keyframes fabBounceIn {
  0% { transform: scale(0.6) translateY(50px); opacity: 0;}
  60% { transform: scale(1.18) translateY(-20px);}
  90% { transform: scale(0.95);}
  100% { transform: scale(1) translateY(0); opacity: 1;}
}

/* Tooltip fachero */
.vw-fab-tooltip {
  display: none;
  position: fixed;
  right: 100px;
  bottom: 54px;
  background: #1b253b;
  color: #fff;
  font-size: 1.06rem;
  border-radius: 8px;
  padding: 7px 16px;
  box-shadow: 0 4px 12px rgba(0,16,80,0.14);
  pointer-events: none;
  z-index: 9999;
  font-family: 'VWHead', Arial, sans-serif;
  transition: opacity 0.21s;
  opacity: 0;
}
@media (max-width: 650px) {
  .vw-fab-tooltip { display: none !important;}
}
</style>

<script>
const fab = document.getElementById("vwFabBtn");
const tip = document.getElementById("vwFabTooltip");
fab.addEventListener("mouseenter", e=>{
  tip.style.display = "block";
  setTimeout(()=>{tip.style.opacity=1;}, 10);
});
fab.addEventListener("mouseleave", e=>{
  tip.style.opacity=0;
  setTimeout(()=>{tip.style.display="none";}, 210);
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
