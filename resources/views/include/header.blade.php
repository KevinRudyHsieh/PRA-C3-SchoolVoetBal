<head>

</head>
    <header>
        <nav class="topNav">
            <a href="{{ route('home') }}" class="navElement">Homepagina</a>
            
            <a href="{{ route('oudetournoi') }}" class="navElement">Vorige tournaments</a>

            <a href="{{ route('onGoing') }}" class="navElement">tournaments die nu bezig zijn</a>

            <a href="{{ route('allteams') }}" class="navElement">Alle Teams</a>

            
            @auth
                @if(auth()->user()->team_id === null)
                    <a href="{{ route('joinTeams') }}" class="navElement">Voeg je toe aan een team</a>
                @else
                <a href="{{ route('checkTeam') }}" class="navElement">Mijn Team</a>
                @endif
            @endauth
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
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                    
                                @auth
                                    @if(auth()->check() && auth()->user()->isAdmin)
                                    <!-- Alleen tonen voor admins -->
                                        <a class="dropdown-item" href="{{ route('AdminPage') }}">
                                            admin page
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
    </header>
