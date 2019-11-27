@extends('layout.app')

@section('content')
    <body class="login">
    <div class="wrapper wrapper-login wrapper-login-full p-0">
        <div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-secondary-gradient">
            <h1 class="title fw-bold text-white mb-3">SGAV - SISTEMA DE GERENCIAMENTO DE ATENDIMENTOS E VENDAS</h1>
            <p class="subtitle text-white op-7">{{ $welcome->message }}</p>
        </div>
        <div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
            <div class="container container-login container-transparent animated fadeIn">
                <h3 class="text-center">CENTRAL ALARME</h3>
                <div class="login-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="placeholder"><b>E-mail</b></label>
                            <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="placeholder"><b>Senha</b></label>
                            <div class="position-relative">
                                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                                <div class="show-password">
                                    <i class="icon-eye"></i>
                                </div>
                                @error('password')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-action-d-flex mb-3">
                            <button type="submit" class="btn btn-secondary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
