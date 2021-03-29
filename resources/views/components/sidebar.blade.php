<ul class="nav">
  @if ( Auth::user()->roles->first()->name == 'superadmin')
    @include('components.sidebar.superadminsidebar')
  @endif
  @if ( Auth::user()->roles->first()->name == 'adim')
    @include('components.sidebar.adminsidebar')
  @endif
  @if ( Auth::user()->roles->first()->name == 'user')
    @include('components.sidebar.usersidebar')
  @endif

</ul>