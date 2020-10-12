<ul class="nav">

	<li class="{{ request()->routeIs('home') ? 'active' : '' }}">
      <a href="{{ route('home') }}">
        <i class="nc-icon nc-layout-11"></i>
        <p>Dashboard</p>
      </a>
    </li>

    <li class="{{ request()->routeIs('user') ? 'active' : '' }}">
      <a href="{{ route('user') }}">
        <i class="nc-icon nc-single-02"></i>
        <p>Mi perfil</p>
      </a>
    </li>


  <li>
    <a href="./icons.html">
      <i class="nc-icon nc-bullet-list-67"></i>
      <p>Matrículas</p>
    </a>
  </li>
  <li>
    <a href="./map.html">
      <i class="nc-icon nc-badge"></i>
      <p>Asignación</p>
    </a>
  </li>
  <li>
    <a href="./notifications.html">
      <i class="nc-icon nc-paper"></i>
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
</ul>