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
                    <a href="#">Cadastrar</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('attendance.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="card-header">
                            <div class="card-title">Cadastre um novo atendimento</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Empresa solicitante <span class="text-danger font-weight-bold">*</span></label>
                                        <select name="company_id" class="form-control" required>
                                            <option value>-- Selecione</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}" {{ (old('company_id') == $company->id ? 'selected' : '') }}>{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('company_id'))
                                            <div class="text-small text-danger">{{ $errors->first('company_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Local (Cliente) <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" name="client" class="form-control" placeholder="Qual cliente?" value="{{ old('client') }}" required>
                                        @if ($errors->has('client'))
                                            <div class="text-small text-danger">{{ $errors->first('client') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Solicitante <span class="text-danger font-weight-bold">*</span></label>
                                        <select type="text" name="requester" class="form-control requester" required>
                                            <option value=""></option>
                                            @if(old('requester'))
                                                <option value="{{ old('requester') }}" selected>{{ old('requester') }}</option>
                                            @endif
                                            @foreach($requesters as $requester)
                                                @if($requester->name == old('requester'))
                                                    <option value="{{ $requester->name }}" selected>{{ $requester->name }}</option>
                                                @else
                                                    <option value="{{ $requester->name }}">{{ $requester->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('requester'))
                                            <div class="text-small text-danger">{{ $errors->first('requester') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Agente <span class="text-danger font-weight-bold">*</span></label>
                                        <select name="agent_id" class="form-control" required>
                                            <option value>-- Selecione</option>
                                            @foreach($agents as $agent)
                                                <option value="{{ $agent->id }}" {{ (old('agent_id') == $agent->id ? 'selected' : '') }}>{{ $agent->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('agent_id'))
                                            <div class="text-small text-danger">{{ $errors->first('agent_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Horário de acionamento <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="input-group">
                                            <input name="time_trigger" type="text" class="form-control timepicker" value="{{ old('time_trigger') }}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('time_trigger'))
                                            <div class="text-small text-danger">{{ $errors->first('time_trigger') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Horário de chegada <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="input-group">
                                            <input name="time_checkin" type="text" class="form-control timepicker" value="{{ old('time_checkin') }}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('time_checkin'))
                                            <div class="text-small text-danger">{{ $errors->first('time_checkin') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Horário de saida <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="input-group">
                                            <input name="time_exit" type="text" class="form-control timepicker" value="{{ old('time_exit') }}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('time_exit'))
                                            <div class="text-small text-danger">{{ $errors->first('time_exit') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Observações <span class="text-danger font-weight-bold">*</span></label>
                                        <textarea name="note" class="form-control" rows="5" required>{{ old('note') }}</textarea>
                                        @if ($errors->has('note'))
                                            <div class="text-small text-danger">{{ $errors->first('note') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <small class="form-text text-muted text-danger font-weight-bold">* preencher todos os campos que estiverem com este indicativo.</small>
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- Sweet Alert -->
    <script src="/js/plugin/sweetalert/sweetalert.min.js"></script>
    <!-- DateTimePicker -->
    <script src="https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/js/plugin/moment/moment.min.js"></script>
    <script src="https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>
    <!-- Select2 -->
    <script src="http://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
    <script type="text/javascript" src="/js/modules/attendance.js"></script>
    <script type="text/javascript" src="/js/modules/message.js"></script>
    @if( Session::has('error'))
        <script type="text/javascript">
            centralalarme.message.error("{{ Session::get('error') }}");
        </script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {
            centralalarme.attendance.timepicker();
            centralalarme.attendance.select2();
        });
    </script>
@endsection
