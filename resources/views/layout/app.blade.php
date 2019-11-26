<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body>
@if(Auth::check())
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">
                <a href="{{ route('home') }}" class="logo">
                    <img src="/img/logo.svg" alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="icon-menu"></i>
                        </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            @include('layouts.navbar')
        </div>

        @include('layouts.sidebar')

        <div class="main-panel">
            <div class="container">
@endif
                @yield('content')
@if(Auth::check())
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endif
<!--   Core JS Files   -->
<script src="/js/core/jquery.3.2.1.min.js"></script>
<script src="/js/core/popper.min.js"></script>
<script src="/js/core/bootstrap.min.js"></script>
<!-- jQuery UI -->
<script src="/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<!-- jQuery Scrollbar -->
<script src="/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Atlantis JS -->
<script src="/js/atlantis.min.js"></script>
<!-- Sweet Alert -->
<script src="/js/plugin/sweetalert/sweetalert.min.js"></script>
@if(Session::has('welcome'))
    <script type="text/javascript">
        $(document).ready(function() {
            var span = document.createElement("span");
            span.innerHTML = "{!! Session::get('welcome') !!}";

            swal({
                content: span,
                buttons: {
                    confirm: {
                        className : 'btn btn-success'
                    }
                },
            });
        });
    </script>
@endif
@yield('javascript')
</body>
</html>
