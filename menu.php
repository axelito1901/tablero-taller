<!-- MENU SIDEBAR FIJO FACHERO -->

<aside class="vw-sidebar">
  <div class="vw-sidebar-logo">
    <img src="assets/vwlogo.png" alt="VW Logo">
  </div>
  <nav>
    <ul>
      <li class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
        <a href="index.php">
          <!-- ICONO DASHBOARD -->
          <span class="vw-ico">
            <svg viewBox="0 0 24 24" width="22" height="22"><path fill="currentColor" d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
          </span>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="<?= basename($_SERVER['PHP_SELF']) == 'mecanicos.php' ? 'active' : '' ?>">
        <a href="mecanicos.php">
          <!-- ICONO USUARIO -->
          <span class="vw-ico">
            <svg viewBox="0 0 24 24" width="22" height="22"><path fill="none" d="M0 0h24v24H0z"/><path fill="currentColor" d="M12 12c2.67 0 8 1.34 8 4v4H4v-4c0-2.66 5.33-4 8-4zm0-2a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/></svg>
          </span>
          <span>Mecánicos</span>
        </a>
      </li>
      <li class="<?= basename($_SERVER['PHP_SELF']) == 'ordenes.php' ? 'active' : '' ?>">
        <a href="ordenes.php">
          <!-- ICONO LLAVE INGLESA -->
          <span class="vw-ico">
            <svg viewBox="0 0 24 24" width="22" height="22"><path fill="currentColor" d="M22.7 19.3l-2.41-2.41c-.37-.37-.88-.59-1.41-.59-.53 0-1.04.22-1.41.59l-1.16 1.16a3.023 3.023 0 01-4.25 0l-1.41-1.41c-1.17-1.17-1.17-3.07 0-4.24l1.16-1.16c.37-.37.59-.88.59-1.41 0-.53-.22-1.04-.59-1.41l-2.41-2.41c-.37-.37-.88-.59-1.41-.59s-1.04.22-1.41.59l-1.16 1.16A7.014 7.014 0 0012 21a7.014 7.014 0 006.02-3.19l1.16-1.16c.37-.37.59-.88.59-1.41 0-.53-.22-1.04-.59-1.41z"/></svg>
          </span>
          <span>Órdenes</span>
        </a>
      </li>
      <li class="<?= basename($_SERVER['PHP_SELF']) == 'configuracion.php' ? 'active' : '' ?>">
        <a href="configuracion.php">
          <!-- ICONO CONFIGURACION -->
          <span class="vw-ico">
            <svg viewBox="0 0 24 24" width="22" height="22"><path fill="currentColor" d="M19.14,12.94l1.43-1.43c0.17-0.17,0.17-0.44,0-0.61l-1.43-1.43c0.1-0.41,0.16-0.83,0.16-1.27s-0.06-0.86-0.16-1.27 l1.43-1.43c0.17-0.17,0.17-0.44,0-0.61l-1.43-1.43c-0.41-0.1-0.83-0.16-1.27-0.16c-0.44,0-0.86,0.06-1.27,0.16l-1.43-1.43 c-0.17-0.17-0.44-0.17-0.61,0l-1.43,1.43c-0.41-0.1-0.83-0.16-1.27-0.16c-0.44,0-0.86,0.06-1.27,0.16L6.64,3.36 c-0.17-0.17-0.44-0.17-0.61,0L4.6,4.79C4.5,5.2,4.44,5.62,4.44,6.06c0,0.44,0.06,0.86,0.16,1.27L3.17,8.76 c-0.17,0.17-0.17,0.44,0,0.61l1.43,1.43c-0.1,0.41-0.16,0.83-0.16,1.27s0.06,0.86,0.16,1.27l-1.43,1.43c-0.17,0.17-0.17,0.44,0,0.61 l1.43,1.43c0.41,0.1,0.83,0.16,1.27,0.16s0.86-0.06,1.27-0.16l1.43,1.43c0.17,0.17,0.44,0.17,0.61,0l1.43-1.43 c0.41,0.1,0.83,0.16,1.27,0.16c0.44,0,0.86-0.06,1.27-0.16l1.43,1.43c0.17,0.17,0.44,0.17,0.61,0l1.43-1.43 c0.41-0.1,0.83-0.16,1.27-0.16C18.31,13.1,18.73,13.04,19.14,12.94z M12,15.5c-1.93,0-3.5-1.57-3.5-3.5S10.07,8.5,12,8.5 s3.5,1.57,3.5,3.5S13.93,15.5,12,15.5z"/></svg>
          </span>
          <span>Configuración</span>
        </a>
      </li>
    </ul>
  </nav>
</aside>

<style>
/* Sidebar layout */
body {
  margin-left: 0;
}
.vw-sidebar {
  position: fixed;
  top: 0; left: 0;
  width: 190px;
  height: 100vh;
  background: #fff;
  box-shadow: 2px 0 18px rgba(30,40,90,0.06);
  padding-top: 22px;
  z-index: 1300;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.vw-sidebar-logo img {
  width: 70px;
  display: block;
  margin: 0 auto 18px auto;
  filter: drop-shadow(0 1px 6px rgba(0,16,80,0.08));
}
.vw-sidebar nav {
  width: 100%;
}
.vw-sidebar ul {
  padding: 0;
  margin: 0;
  list-style: none;
}
.vw-sidebar li {
  margin-bottom: 9px;
  width: 100%;
}
.vw-sidebar a {
  display: flex;
  align-items: center;
  gap: 13px;
  padding: 12px 14px 12px 19px;
  color: #072058;
  font-family: 'VWHead', Arial, sans-serif;
  font-weight: 500;
  font-size: 1.08rem;
  border-radius: 9px;
  text-decoration: none;
  transition: background .17s, color .16s, box-shadow .2s;
}
.vw-sidebar a .vw-ico {
  display: flex;
  align-items: center;
  justify-content: center;
  min-width: 22px;
}
.vw-sidebar li.active a,
.vw-sidebar a:hover,
.vw-sidebar a:focus {
  background: #001e50;
  color: #fff;
  box-shadow: 0 2px 12px rgba(30,60,120,0.05);
}
.vw-sidebar li.active a .vw-ico,
.vw-sidebar a:hover .vw-ico,
.vw-sidebar a:focus .vw-ico {
  color: #ffe200;
}
@media (max-width: 900px) {
  .vw-sidebar { width: 60px; }
  .vw-sidebar-logo img { width: 40px; }
  .vw-sidebar a span:not(.vw-ico) { display: none;}
  .vw-sidebar nav { min-width: 60px;}
}
@media (max-width: 600px) {
  .vw-sidebar { position: static; width: 100vw; height: auto; flex-direction: row; padding-top: 6px;}
  .vw-sidebar-logo { display: none;}
  .vw-sidebar nav { width: 100vw;}
  .vw-sidebar ul { display: flex; flex-direction: row; justify-content: space-around;}
  .vw-sidebar li { margin: 0; }
  .vw-sidebar a { padding: 10px 7px; border-radius: 7px;}
}
</style>
