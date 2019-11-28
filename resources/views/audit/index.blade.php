@extends('layout.app')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Auditoria de Usuários</h4>
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
                    <a href="#">Auditoria</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Logs</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome usuário</th>
                                    <th>E-mail</th>
                                    <th>Evento</th>
                                    <th>Data</th>
                                    <th>URL</th>
                                    <th>Informação</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome usuário</th>
                                    <th>E-mail</th>
                                    <th>Evento</th>
                                    <th>Data</th>
                                    <th>URL</th>
                                    <th>Informação</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($audits as $audit)
                                    <tr>
                                        <td>{{ $audit->getMetadata()['audit_id'] }}</td>
                                        <td>{{ $audit->getMetadata()['user_first_name'] }} {{ $audit->getMetadata()['user_last_name'] }}</td>
                                        <td>{{ $audit->getMetadata()['user_email'] }}</td>
                                        <td>{{ $audit->getMetadata()['audit_event'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($audit->getMetadata()['audit_created_at'])->format('d/m/Y H:i:s') }}</td>
                                        <td>{{ $audit->getMetadata()['audit_url'] }}</td>
                                        <td><button class="btn btn-success btn-xs" onclick='centralalarme.audit.info({!! json_encode($audit->getModified()) !!})'>Visualizar</button></td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Alterações</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="textModal">
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
    <script type="text/javascript" src="/js/modules/datatable.js"></script>
    <script type="text/javascript" src="/js/modules/audit.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            centralalarme.datatable.init(0, 'DESC');
        });
    </script>
@endsection
