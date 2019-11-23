@extends('layout.app')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Cadastrar atendimento</h4>
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
                    <a href="#">Alterar</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}
                        <div class="card-header">
                            <div class="card-title">Alterar atendimento</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Empresa solicitante <span class="text-danger font-weight-bold">*</span></label>
                                        <select name="company_id" class="form-control">
                                            <option>-- Selecione</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}" {{ ($attendance->company_id == $company->id) ? 'selected' : ''}}>{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Local (Cliente) <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" name="client" class="form-control" placeholder="Qual cliente?" value="{{ $attendance->client }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Solicitante <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" name="requester" class="form-control" placeholder="Quem fez a solicitação de atendimento?" value="{{ $attendance->requester }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Agente <span class="text-danger font-weight-bold">*</span></label>
                                        <select name="agent_id" class="form-control">
                                            <option>-- Selecione</option>
                                            @foreach($agents as $agent)
                                                <option value="{{ $agent->id }}" {{ ($attendance->agent_id == $agent->id) ? 'selected' : ''}}>{{ $agent->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Horário de acionamento <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="input-group">
                                            <input name="time_trigger" type="text" class="form-control timepicker" value="{{ $attendance->time_trigger }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Horário de chegada <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="input-group">
                                            <input name="time_checkin" type="text" class="form-control timepicker" value="{{ $attendance->time_checkin }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Horário de saida <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="input-group">
                                            <input name="time_exit" type="text" class="form-control timepicker" value="{{ $attendance->time_exit }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Observações <span class="text-danger font-weight-bold">*</span></label>
                                        <textarea name="note" class="form-control" rows="5">{{ $attendance->note }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <small class="form-text text-muted text-danger font-weight-bold">* preencher todos os campos que estiverem com este indicativo.</small>
                            <button type="submit" class="btn btn-success">Salvar alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- DateTimePicker -->
    <script src="https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/js/plugin/moment/moment.min.js"></script>
    <script src="https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>
    <script>
        $('.timepicker').datetimepicker({
            format: 'HH:mm',
        });
    </script>
@endsection
