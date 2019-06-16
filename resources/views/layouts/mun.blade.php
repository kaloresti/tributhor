<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9807372c65.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container-fluid">
                <img width="30" height="30" src="{{ asset('storage/brasoes/'.$prefeitura->arquivo)}}" alt=""> 
                &nbsp &nbsp &nbsp
                <a class="navbar-brand" href="/prefeituras/{{$prefeitura->id}}/show">
                    <b class="text-uppercase">{{$prefeitura->nome}} - {{$prefeitura->uf}}</b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-2">
                    <div class="list-group">
                        <a href="/prefeituras/{{$prefeitura->id}}/show" class="list-group-item list-group-item-action flex-column align-items-start active">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="far fa-hand-point-right"></i> Dashboard</h5>
                            </div>
                            <small><i class="fas fa-chart-line"></i> resumo de operações, desempenho e histórico.</small>
                        </a>
                        <a href="/prefeituras/{{$prefeitura->id}}/organizacao" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="far fa-hand-point-right"></i> Estrutura Física</h5>
                            </div>
                            <small><i class="fas fa-sitemap"></i> secretarias, departamentos, servidores e outras entidades.</small>
                        </a>
                    </div>
                        
                        
                      
                       
                        <a href="/prefeituras/{{$prefeitura->id}}/organizacao"><i class="fas fa-briefcase"></i> &nbsp Cadastro Mobiliário</a> <br><br>
                        <a href="/prefeituras/{{$prefeitura->id}}/organizacao"><i class="fas fa-house-damage"></i> &nbsp Cadastro Imobiliário</a> <br><br>
                        <a href="/prefeituras/{{$prefeitura->id}}/organizacao"><i class="fas fa-file-invoice-dollar"></i> &nbsp Arrecadação</a> <br><br>
                        <a href="/prefeituras/{{$prefeitura->id}}/organizacao"><i class="fas fa-receipt"></i> &nbsp NFSe</a> <br><br>
                        <a href="/prefeituras/{{$prefeitura->id}}/organizacao"><i class="fas fa-cogs"></i> &nbsp Configurações</a> <br>
                    </div>
                    <div class="col-md-8">
                       
                        @yield('content')
                       
                    </div>
                </div>
            </div>
        </main>

    </div>
</body>
</html>
