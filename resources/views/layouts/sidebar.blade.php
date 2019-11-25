<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="/img/profile.jpg" class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a aria-expanded="true">
                        <span>
                            {{ Auth::user()->frist_name }}
                            <span class="user-level">{{ Auth::user()->roles[0]->name }}</span>
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item {{ (Route::is('home')) ? 'active' : '' }}">
                    <a  href="{{ route('home') }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ (Route::is('attendance.*')) ? 'active' : '' }} ">
                    <a data-toggle="collapse" href="#attendance">
                        <i class="fas fa-book-open"></i>
                        <p>Atendimento</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="attendance">
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
                @role('Administrador')
                <li class="nav-item {{ (Route::is('report.*')) ? 'active' : '' }} ">
                    <a data-toggle="collapse" href="#report">
                        <i class="fas fa-file"></i>
                        <p>Relatório</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="report">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('report.attendance') }}">
                                    <span class="sub-item">Atendimento</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
                @role('Administrador')
                <li class="nav-item {{ (Route::is('company.*')) ? 'active' : '' }} ">
                    <a data-toggle="collapse" href="#company">
                        <i class="fas fa-building"></i>
                        <p>Empresa</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="company">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('company.create') }}">
                                    <span class="sub-item">Cadastrar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
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
