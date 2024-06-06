<head>

</head>
<div class="headerstyle">
    <header>
        <div class="topHeader">
            <nav class="topNav">
                <a href="{{ route('home') }}" class="navElement">Homepagina</a>
                <a href="{{ route('create') }}" class="navElement">Toernooi aanmaken</a>
                <a href="{{ route('ToernooiAdmin')}}" class="navElement">alle toernooien</a>
                <a href="{{ route('AdminPage')}}" class="navElement">alle users</a>
                <a href="{{ route('teams') }}" class="navElement">Teams</a>
                
                <a href="{{ route('onGoingAdmin') }}" class="navElement">toernooien nu bezig</a>
                @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login ') }}</a>
                    </li>
                @endif
            
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
            
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
            
                        @auth
                            @if(auth()->check() && auth()->user()->isAdmin)
                                <!-- Only show for admins -->
                                <a class="dropdown-item" href="{{ route('AdminPage') }}">
                                    Admin Page
                                </a>
                            @endif
                        @endauth
            
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            
            </nav>
        </div>
    </header>
</div>