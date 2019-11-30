@extends('layout.app')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Lista de Usuários</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Usuários</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Listar</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Usuários cadastrados</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome</th>
                                    <th>Sobrenome</th>
                                    <th>E-mail</th>
                                    <th>Permissão</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome</th>
                                    <th>Sobrenome</th>
                                    <th>E-mail</th>
                                    <th>Permissão</th>
                                    <th>Ações</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->getRoleNames()[0] }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cogs"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">Editar</a>
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item" style="cursor: pointer">{{ $user->active == true ? 'Desativar' : 'Ativar' }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- Datatables -->
    <script src="/js/plugin/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="/js/modules/datatable.js"></script>
    <script type="text/javascript" src="/js/modules/message.js"></script>
    @if(Session::has('success'))
        <script type="text/javascript">
            centralalarme.message.success("{{ Session::get('success') }}");
        </script>
    @endif
    @if(Session::has('error'))
        <script type="text/javascript">
            centralalarme.message.error("{{ Session::get('error') }}");
        </script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {
            centralalarme.datatable.init(0, 'asc');
        });
    </script>
@endsection
