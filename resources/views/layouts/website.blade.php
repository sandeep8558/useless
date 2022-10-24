<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('head')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="/images/favicon.png" type="image/png" sizes="16x16">

</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="/">Vainkho Admin</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-user fa-fw"></i> Login</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>


        <div class="container-fluid bg-dark text-light py-3">
            <div class="container">
            <span class="para" style="color: #999;" >Copyright &copy; {{ date('Y') }} <a href="/" class="text-light">VAINKHO ECOMMERCE PVT. LTD.</a> All Rights Reserved.</span>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')

</body>
</html>
