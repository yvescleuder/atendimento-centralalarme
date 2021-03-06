<!-- Navbar Header -->

<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="//via.placeholder.com/50/FFFFFF/000000/?text={{ substr(Auth::user()->first_name, 0, 1) }} {{ substr(Auth::user()->last_name, 0, 1) }}" class="avatar-img rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="u-text">
                                    <h4>
                                        @if(\Carbon\Carbon::now()->format('H') > 18)
                                            Boa noite,
                                        @elseif(\Carbon\Carbon::now()->format('H') > 12)
                                            Boa tarde,
                                        @elseif(\Carbon\Carbon::now()->format('H') < 6)
                                            Boa noite,
                                        @else
                                            Bom dia,
                                        @endif
                                        {{ Auth::user()->first_name }}</h4>
                                    <p class="text-muted">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}">Sair</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- End Navbar -->
