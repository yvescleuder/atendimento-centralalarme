@extends('layout.app')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Relatório de atendimentos</h4>
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
                    <a href="#">Relatório</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Atendimento</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('report.attendance.export') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="card-header">
                            <div class="card-title">Exportar relatório de atendimentos</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Empresa <span class="text-danger font-weight-bold">*</span></label>
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
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Mes <span class="text-danger font-weight-bold">*</span></label>
                                        <select name="month" class="form-control" required>
                                            <option value>-- Selecione</option>
                                                <option value="01" {{ (old('month') == '01' ? 'selected' : '') }}>Janeiro</option>
                                                <option value="02" {{ (old('month') == '02' ? 'selected' : '') }}>Fevereiro</option>
                                                <option value="03" {{ (old('month') == '03' ? 'selected' : '') }}>Março</option>
                                                <option value="04" {{ (old('month') == '04' ? 'selected' : '') }}>Abril</option>
                                                <option value="05" {{ (old('month') == '05' ? 'selected' : '') }}>Maio</option>
                                                <option value="06" {{ (old('month') == '06' ? 'selected' : '') }}>Junho</option>
                                                <option value="07" {{ (old('month') == '07' ? 'selected' : '') }}>Julho</option>
                                                <option value="08" {{ (old('month') == '08' ? 'selected' : '') }}>Agosto</option>
                                                <option value="09" {{ (old('month') == '09' ? 'selected' : '') }}>Setembro</option>
                                                <option value="10" {{ (old('month') == '10' ? 'selected' : '') }}>Outubro</option>
                                                <option value="11" {{ (old('month') == '11' ? 'selected' : '') }}>Novembro</option>
                                                <option value="12" {{ (old('month') == '12' ? 'selected' : '') }}>Dezembro</option>
                                        </select>
                                        @if ($errors->has('month'))
                                            <div class="text-small text-danger">{{ $errors->first('month') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Ano <span class="text-danger font-weight-bold">*</span></label>
                                        <select name="year" class="form-control" required>
                                            <option value>-- Selecione</option>
                                            <option value="2019" {{ (old('year') == '2019' ? 'selected' : '') }}>2019</option>
                                            <option value="2020" {{ (old('year') == '2020' ? 'selected' : '') }}>2020</option>
                                        </select>
                                        @if ($errors->has('year'))
                                            <div class="text-small text-danger">{{ $errors->first('year') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <small class="form-text text-muted text-danger font-weight-bold">* preencher todos os campos que estiverem com este indicativo.</small>
                            <button type="submit" class="btn btn-success">Exportar</button>
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
    @if( Session::has('error'))
        <script>
            swal("{{ Session::get('error') }}", {
                icon : "error",
                buttons: {
                    confirm: {
                        className : 'btn btn-error'
                    }
                },
            });
        </script>
    @endif
@endsection
