<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="/img/profile.jpg" class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Yves Clêuder
                            <span class="user-level">Administrator</span>
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item @if(Route::is('home')) ?? active : '' @endif">
                    <a  href="#dashboard" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item @if(Route::is('attendance.*')) ?? active : '' @endif">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-book-open"></i>
                        <p>Atendimento</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('attendance.create') }}">
                                    <span class="sub-item">Cadastrar</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('attendance.index') }}">
                                    <span class="sub-item">Listar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#sidebarLayouts">
                        <i class="fas fa-file"></i>
                        <p>Relatório</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-building"></i>
                        <p>Empresa</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="sidebar-style-1.html">
                                    <span class="sub-item">Cadastrar</span>
                                </a>
                            </li>
                            <li>
                                <a href="overlay-sidebar.html">
                                    <span class="sub-item">Listar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-user"></i>
                        <p>Usuario</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="sidebar-style-1.html">
                                    <span class="sub-item">Cadastrar</span>
                                </a>
                            </li>
                            <li>
                                <a href="overlay-sidebar.html">
                                    <span class="sub-item">Listar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#sidebarLayouts">
                        <i class="fas fa-history"></i>
                        <p>Log</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
