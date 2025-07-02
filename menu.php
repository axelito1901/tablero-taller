<!-- BOTÓN HAMBURGUESA Y SIDEBAR INTERACTIVO -->
<button class="vw-menu-btn" id="vwMenuBtn" aria-label="Abrir menú">
  <span class="vw-menu-ico"></span>
</button>

<aside class="vw-sidebar" id="vwSidebar">
  <div class="vw-sidebar-logo">
    <img src="assets/vwlogo.png" alt="VW Logo">
  </div>
  <nav>
    <ul>
      <li class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
        <a href="index.php">
          <span class="vw-ico"><svg viewBox="0 0 24 24" width="22" height="22"><path fill="currentColor" d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg></span>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- EDITOR CON SUBMENÚ -->
      <li class="editor-li">
        <a href="javascript:void(0);" onclick="toggleEditorSubmenu()" id="editorBtn">
          <span class="vw-ico"><svg width="22" height="22" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21v-2h14v2H5zm7-3l5-5-1.41-1.41L13 15.17V4h-2v11.17l-2.59-2.58L7 13l5 5z"/></svg></span>
          <span>Editor</span>
          <span id="editorArrow" style="margin-left:auto;transition:.18s;"><svg width="16" height="16" style="transform:rotate(0deg);"><path fill="currentColor" d="M4 7l4 4 4-4z"/></svg></span>
        </a>
        <ul class="submenu" id="editorSubmenu" style="display:none; background:#f7fbff; border-radius:8px; margin:2px 10px 5px 28px; box-shadow:0 3px 10px rgba(0,30,90,0.07);">
          <li><a href="editor_mecanicos.php"><span class="vw-ico"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M12 12c2.67 0 8 1.34 8 4v4H4v-4c0-2.66 5.33-4 8-4zm0-2a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/></svg></span>Mecánicos</a></li>
          <li><a href="editor_modelos.php"><span class="vw-ico"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M5,16A3,3 0 0,0 8,19H16A3,3 0 0,0 19,16V11C19,8.79 17.21,7 15,7H9C6.79,7 5,8.79 5,11V16Z"/></svg></span>Modelos de Autos</a></li>
          <li><a href="editor_tipos.php"><span class="vw-ico"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M17 10.5V6a5 5 0 0 0-10 0v4.5A5.5 5.5 0 0 0 2 16v3a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-3a5.5 5.5 0 0 0-5-5.5zM7 6a3 3 0 1 1 6 0v4.5H7V6zm13 13a.5.5 0 0 1-.5.5h-16a.5.5 0 0 1-.5-.5v-3a3.5 3.5 0 0 1 3.5-3.5h10a3.5 3.5 0 0 1 3.5 3.5v3z"/></svg></span>Tipos de Trabajo</a></li>
        </ul>
      </li>
      <li class="<?= basename($_SERVER['PHP_SELF']) == 'ordenes.php' ? 'active' : '' ?>">
        <a href="ordenes.php">
          <span class="vw-ico"><svg viewBox="0 0 24 24" width="22" height="22"><path fill="currentColor" d="M22.7 19.3l-2.41-2.41c-.37-.37-.88-.59-1.41-.59-.53 0-1.04.22-1.41.59l-1.16 1.16a3.023 3.023 0 01-4.25 0l-1.41-1.41c-1.17-1.17-1.17-3.07 0-4.24l1.16-1.16c.37-.37.59-.88.59-1.41 0-.53-.22-1.04-.59-1.41l-2.41-2.41c-.37-.37-.88-.59-1.41-.59s-1.04.22-1.41.59l-1.16 1.16A7.014 7.014 0 0012 21a7.014 7.014 0 006.02-3.19l1.16-1.16c.37-.37.59-.88.59-1.41 0-.53-.22-1.04-.59-1.41z"/></svg></span>
          <span>Órdenes</span>
        </a>
      </li>
      <li class="<?= basename($_SERVER['PHP_SELF']) == 'configuracion.php' ? 'active' : '' ?>">
        <a href="configuracion.php">
          <span class="vw-ico"><svg viewBox="0 0 24 24" width="22" height="22"><path fill="currentColor" d="M19.14,12.94l1.43-1.43c0.17-0.17,0.17-0.44,0-0.61l-1.43-1.43c0.1-0.41,0.16-0.83,0.16-1.27s-0.06-0.86-0.16-1.27 l1.43-1.43c0.17-0.17,0.17-0.44,0-0.61l-1.43-1.43c-0.41-0.1-0.83-0.16-1.27-0.16c-0.44,0-0.86,0.06-1.27,0.16l-1.43-1.43 c-0.17-0.17-0.44-0.17-0.61,0l-1.43,1.43c-0.41-0.1-0.83-0.16-1.27-0.16c-0.44,0-0.86,0.06-1.27,0.16L6.64,3.36 c-0.17-0.17-0.44-0.17-0.61,0L4.6,4.79C4.5,5.2,4.44,5.62,4.44,6.06c0,0.44,0.06,0.86,0.16,1.27L3.17,8.76 c-0.17,0.17-0.17,0.44,0,0.61l1.43,1.43c-0.1,0.41-0.16,0.83-0.16,1.27s0.06,0.86,0.16,1.27l-1.43,1.43c-0.17,0.17-0.17,0.44,0,0.61 l1.43,1.43c0.41,0.1,0.83,0.16,1.27,0.16s0.86-0.06,1.27-0.16l1.43,1.43c0.17,0.17,0.44,0.17,0.61,0l1.43-1.43 c0.41,0.1,0.83,0.16,1.27,0.16c0.44,0,0.86-0.06,1.27-0.16l1.43,1.43c0.17,0.17,0.44,0.17,0.61,0l1.43-1.43 c0.41-0.1,0.83-0.16,1.27-0.16C18.31,13.1,18.73,13.04,19.14,12.94z M12,15.5c-1.93,0-3.5-1.57-3.5-3.5S10.07,8.5,12,8.5 s3.5,1.57,3.5,3.5S13.93,15.5,12,15.5z"/></svg></span>
          <span>Configuración</span>
        </a>
      </li>
    </ul>
  </nav>
</aside>
<div id="vwSidebarBg" class="vw-sidebar-bg"></div>


<style>
body { margin-left: 0 !important; }
.vw-menu-btn {
  position: fixed; top: 25px; left: 22px;
  z-index: 2001;
  width: 48px; height: 48px;
  border-radius: 50%; border: 2px solid #e0e7fa;
  background: #fff; box-shadow: 0 4px 12px rgba(0,30,60,0.10);
  cursor: pointer; display: flex; align-items: center; justify-content: center;
  transition: background .18s, box-shadow .18s;
}
.vw-menu-ico, .vw-menu-ico::before, .vw-menu-ico::after {
  content: ''; display: block; width: 26px; height: 4px;
  background: #1976d2; border-radius: 3px; position: relative;
  transition: .22s cubic-bezier(.6,0,.4,1);
}
.vw-menu-ico { position: relative; }
.vw-menu-ico::before { position: absolute; top: -9px; left: 0; }
.vw-menu-ico::after { position: absolute; top: 9px; left: 0; }
.vw-menu-btn.open .vw-menu-ico { background: transparent; }
.vw-menu-btn.open .vw-menu-ico::before { top: 0; transform: rotate(45deg);}
.vw-menu-btn.open .vw-menu-ico::after { top: 0; transform: rotate(-45deg);}
.vw-sidebar {
  position: fixed; top: 0; left: 0;
  width: 210px; height: 100vh; background: #fff;
  box-shadow: 2px 0 18px rgba(30,40,90,0.07);
  padding-top: 18px; z-index: 2000; display: flex;
  flex-direction: column; align-items: center;
  transform: translateX(-250px);
  transition: transform .22s cubic-bezier(.6,0,.4,1);
}
.vw-sidebar.open { transform: translateX(0);}
.vw-sidebar-logo img { width: 70px; margin: 0 auto 16px auto; display: block; filter: drop-shadow(0 1px 6px rgba(0,16,80,0.08)); }
.vw-sidebar nav { width: 100%; }
.vw-sidebar ul { padding: 0; margin: 0; list-style: none;}
.vw-sidebar li { margin-bottom: 10px; width: 100%;}
.vw-sidebar a {
  display: flex; align-items: center; gap: 13px;
  padding: 11px 14px 11px 18px;
  color: #072058; font-family: 'VWHead', Arial, sans-serif;
  font-weight: 500; font-size: 1.08rem;
  border-radius: 8px; text-decoration: none;
  transition: background .17s, color .16s, box-shadow .2s;
}
.vw-sidebar a .vw-ico { min-width: 22px; display: flex;}
.vw-sidebar li.active a, .vw-sidebar a:hover, .vw-sidebar a:focus {
  background: #001e50; color: #fff;
  box-shadow: 0 2px 8px rgba(30,60,120,0.05);
}
.vw-sidebar li.active a .vw-ico, .vw-sidebar a:hover .vw-ico, .vw-sidebar a:focus .vw-ico { color: #ffe200; }
.vw-sidebar-bg {
  display: none; position: fixed; z-index: 1900;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(10,20,40,0.14); backdrop-filter: blur(2px);
}
.vw-sidebar.open ~ .vw-sidebar-bg { display: block; }
@media (max-width: 899px) {
  .vw-sidebar { width: 85vw; max-width: 245px; }
}
@media (max-width: 600px) {
  .vw-sidebar { width: 99vw; max-width: 98vw;}
}
submenu {
  background: #f7fbff;
  border-radius: 8px;
  box-shadow: 0 3px 10px rgba(0,30,90,0.07);
  padding-left: 0;
  margin: 2px 10px 5px 28px;
  font-size: 0.97em;
}
.submenu li { margin: 0; }
.submenu a {
  padding-left: 22px !important;
  color: #06214b !important;
  background: none !important;
  font-family: 'VWText', Arial, sans-serif;
}
.submenu a:hover {
  background: #e9f3ff !important;
  color: #0a318a !important;
}
.editor-li.open > a { background: #dde9fa !important; }
</style>

<script>
function toggleEditorSubmenu() {
  var submenu = document.getElementById('editorSubmenu');
  var arrow = document.getElementById('editorArrow');
  var editorLi = document.querySelector('.editor-li');
  if (submenu.style.display === 'none' || submenu.style.display === '') {
    submenu.style.display = 'block';
    arrow.children[0].style.transform = "rotate(180deg)";
    editorLi.classList.add("open");
  } else {
    submenu.style.display = 'none';
    arrow.children[0].style.transform = "rotate(0deg)";
    editorLi.classList.remove("open");
  }
}

// Tu script hamburguesa igual
const menuBtn = document.getElementById('vwMenuBtn');
const sidebar = document.getElementById('vwSidebar');
const sidebarBg = document.getElementById('vwSidebarBg');
menuBtn.addEventListener('click', function() {
  this.classList.toggle('open');
  sidebar.classList.toggle('open');
  sidebarBg.style.display = sidebar.classList.contains('open') ? "block" : "none";
});
sidebarBg.addEventListener('click', function(){
  sidebar.classList.remove('open');
  menuBtn.classList.remove('open');
  sidebarBg.style.display = "none";
});
window.addEventListener('keydown', function(e){
  if (e.key === "Escape") {
    sidebar.classList.remove('open');
    menuBtn.classList.remove('open');
    sidebarBg.style.display = "none";
  }
});
</script>
