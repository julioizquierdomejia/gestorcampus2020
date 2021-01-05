<li class="{{ request()->routeIs('home') ? 'active' : '' }}">
  <a href="{{ route('home') }}">
    <i class="fal fa-tachometer-alt-fastest"></i>
    <p>Dashboard</p>
  </a>
</li>

<li class="{{ request()->routeIs('user') ? 'active' : '' }}">
  <a href="{{ route('user') }}">
    <i class="fal fa-user-md"></i>
    <p>Mi perfil</p>
  </a>
</li>

<li class="{{ request()->routeIs('grupos') ? 'active' : '' }}">
  <a href="/grupos">
    <i class="fal fa-object-group"></i>
    <p>Agrupacion de cursos</p>
  </a>
</li>

<li class="{{ request()->routeIs('cursos') ? 'active' : '' }}">
  <a href="/cursos">
    <i class="fal fa-clipboard-user"></i>
    <p>Cursos</p>
  </a>
</li>

<li class="{{ request()->routeIs('matricula') ? 'active' : '' }}">
  <a href="{{ route('matricula') }}">
    <i class="fal fa-chalkboard-teacher"></i>
    <p>Matrículas</p>
  </a>
</li>

<li>
  <a href="./map.html">
    <i class="fal fa-clipboard-user"></i>
    <p>Asignación</p>
  </a>
</li>
<li>
  <a href="./notifications.html">
    <i class="fal fa-file-certificate"></i>
    <p>Certificados</p>
  </a>
</li>
<li>
  <a href="./user.html">
    <i class="nc-icon nc-tv-2"></i>
    <p>Video Conferencias</p>
  </a>
</li>
<li>
  <a href="./tables.html">
    <i class="nc-icon nc-money-coins"></i>
    <p>Pagos</p>
  </a>
</li>