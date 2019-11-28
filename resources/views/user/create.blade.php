@extends('layout.app')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Cadastrar empresa</h4>
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
                    <a href="#">Empresa</a>
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
                    <form action="{{ route('user.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="card-header">
                            <div class="card-title">Cadastro de Usuário</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Nome <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" name="first_name" class="form-control" placeholder="Primeiro nome" value="{{ old('first_name') }}" required>
                                        @if ($errors->has('first_name'))
                                            <div class="text-small text-danger">{{ $errors->first('first_name') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Sobrenome <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Sobrenome" value="{{ old('last_name') }}" required>
                                        @if ($errors->has('last_name'))
                                            <div class="text-small text-danger">{{ $errors->first('last_name') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>E-mail <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <div class="text-small text-danger">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Senha <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="password" name="password" class="form-control" placeholder="Senha" value="{{ old('password') }}" required>
                                        @if ($errors->has('password'))
                                            <div class="text-small text-danger">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="card-title">Grupo de permissões</div>
                        </div>
                        <div class="card-body">
                            @foreach($roles as $role)
                                <div class="row">
                                    <div class="form-check form-check-inline">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="role{{ $role->id }}" name="role_id" class="custom-control-input" value="{{ $role->id }}" required>
                                            <label class="custom-control-label" for="role{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
    <script type="text/javascript" src="/js/modules/message.js"></script>
    @if(Session::has('error'))
        <script type="text/javascript">
            centralalarme.message.error("{{ Session::get('error') }}");
        </script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {
        });
    </script>
@endsection
