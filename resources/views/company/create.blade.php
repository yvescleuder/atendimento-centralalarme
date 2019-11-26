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
                    <form action="{{ route('company.store') }}" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="card-header">
                            <div class="card-title">Cadastre uma nova empresa</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Nome da empresa <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Qual nome da empresa?" value="{{ old('name') }}" required>
                                        @if ($errors->has('name'))
                                            <div class="text-small text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Cor <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" name="color_hex" class="form-control demo" placeholder="Selecione uma cor" value="{{ old('color_hex') }}" required>
                                        @if ($errors->has('color_hex'))
                                            <div class="text-small text-danger">{{ $errors->first('color_hex') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group input-file input-file-image">
                                        <img class="img-upload-preview" width="120" src="http://placehold.it/120x80" alt="preview">
                                        <input type="file" class="form-control form-control-file" id="uploadImg2" name="logo" accept="image/*" required>
                                        <label for="uploadImg2" class="label-input-file btn btn-black btn-round">
                                            <span class="btn-label">
                                                <i class="fa fa-file-image"></i>
                                            </span>
                                            Selecionar logo
                                        </label>
                                        @if ($errors->has('logo'))
                                            <div class="text-small text-danger">{{ $errors->first('logo') }}</div>
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
    <script type="text/javascript" src="/js/modules/message.js"></script>
    <link rel='stylesheet' href='/css/jquery.minicolors.css' type='text/css' media='all' />
    <script type="text/javascript" src="/js/plugin/color-picker/jquery.minicolors.min.js"></script>
    <script type="text/javascript" src="/js/modules/company.js"></script>
    @if(Session::has('error'))
        <script type="text/javascript">
            centralalarme.message.error("{{ Session::get('error') }}");
        </script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {
            centralalarme.company.colpick();
        });
    </script>
@endsection
