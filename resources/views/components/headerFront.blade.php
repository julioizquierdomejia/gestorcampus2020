@if (Route::has('login'))
        @auth
            {{--<span> Bienvenido : {{ Auth::user()->email }}</span>--}}
            {{-- Verificamos si es super admin irole_id = 9 --}}
            @if(Auth::user()->roles->first()->pivot->role_id == 9)
              <a href="{{ route('perfil') }}" class="btn btn-success">{{ Auth::user()->userMoodle->name }}</a>
              <a href="{{ url('/home') }}" class="btn btn-primary"><i class="fas fa-cog"></i></a>
              <a href="{{ route('logout') }}" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i></a>
            @else
              
            @if(Auth::user()->userMoodle->name == null)
                <a href="{{ route('perfil') }}" class="btn btn-success">Ingresa Aqui para completar tus datos</a>
            @else
                <a href="{{ route('perfil') }}" class="btn btn-success">{{ Auth::user()->userMoodle->name }}</a>
            @endif

              


                {{-- Consultamos si el usuario logeado tiene algo en el carrito de compras --}}
                @if(Auth::user()->carritos->count() == null)
                @else
                    <a type="button" class="btn btn-primary" href="/carrito">
                        <i class="fal fa-shopping-cart mr-2"></i> <span class="badge badge-light">{{Auth::user()->carritos->count()}}</span>
                        <span class="sr-only">unread messages</span>
                    </a>
                @endif

              <a href="{{ route('logout') }}" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i></a>
            @endif
            
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Acceder</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-danger">Registrate</a>
            @endif
        @endif
@endif