@extends('layout.app')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Lista de atendimento</h4>
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
                    <a href="#">Atendimento</a>
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
                        <h4 class="card-title">Atendimentos realizados</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Monitor</th>
                                        <th>Empresa</th>
                                        <th>Cliente</th>
                                        <th>Solicitante</th>
                                        <th>Agente</th>
                                        <th>Horario de acionamento</th>
                                        <th>Horario de check-in</th>
                                        <th>Horario de saida</th>
                                        <th>Obs</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Data</th>
                                        <th>Monitor</th>
                                        <th>Empresa</th>
                                        <th>Cliente</th>
                                        <th>Solicitante</th>
                                        <th>Agente</th>
                                        <th>Horario de acionamento</th>
                                        <th>Horario de check-in</th>
                                        <th>Horario de saida</th>
                                        <th>Obs</th>
                                        <th>Ações</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($attendances as $attendance)
                                        <tr>
                                            <td>{{ $attendance->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $attendance->user->first_name }}</td>
                                            <td>{{ $attendance->company->name }}</td>
                                            <td>{{ $attendance->client }}</td>
                                            <td>{{ $attendance->requester }}</td>
                                            <td>{{ $attendance->agent->name }}</td>
                                            <td>{{ $attendance->time_trigger }}</td>
                                            <td>{{ $attendance->time_checkin }}</td>
                                            <td>{{ $attendance->time_exit }}</td>
                                            <td><button class="btn btn-success btn-xs" onclick="centralalarme.attendance.index().modalNote('{{$attendance->note}}')">Visualizar</button></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-cogs"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="{{ route('attendance.edit', $attendance->id) }}">Editar</a>
                                                        <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="dropdown-item" style="cursor: pointer">Deletar</button>
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
    <div class="modal fade" id="modal-note" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Observação do atendimento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-note-text">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- Datatables -->
    <script src="/js/plugin/datatables/datatables.min.js"></script>
    <!-- Sweet Alert -->
    <script src="/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="/js/modules/attendance.js"></script>
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
            centralalarme.attendance.index().translateDataTable();
        });
    </script>
@endsection
