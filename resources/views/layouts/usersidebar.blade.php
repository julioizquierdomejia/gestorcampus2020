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
      <p>Mi actividad</p>
    </a>
  </li>