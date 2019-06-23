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
<style>
.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 14px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 500px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 14px;}
}
</style>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-laravel">
            <div class="container-fluid">
                &nbsp &nbsp &nbsp
                <span style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fas fa-bars"></i></span>
                
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
                                    <a class="dropdown-item" href="/prefeituras/{{$prefeitura->id}}/configuracoes"><i class="fas fa-cogs"></i> Configurações</a> 
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
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
            <div class="container-fluid ">
                <div class="row justify-content-center">
                    
                    <div id="mySidenav" class="sidenav">
                        <div class="row">
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-8" style="text-align:center;">
                                <img style="margin:auto" width="150" height="150" src="{{ asset('storage/brasoes/'.$prefeitura->arquivo)}}" alt="">
                            </div>
                            <div class="col-md-2">
                                    
                            </div>
                        </div>
                        <div class="row" style="text-align:center;">
                            <div class="col-md-12"><br>
                                <b style="color:grey" class="text-uppercase">{{$prefeitura->nome}} - {{$prefeitura->uf}}</b><br>
                                <b style="color:grey" ><i class="fas fa-user"></i> {{ Auth::user()->name }}</b> 
                            </div>
                        </div><br>
                        <div class="row" style="text-align:center; padding: 5px 5px 5px 5px;">
                                <div class="col-md-4">
                                    <button title="Dashboard" class="btn btn-outline-secondary btn-lg col-md-12" onclick="location.href='{{ url('/prefeituras/'.$prefeitura->id.'/show') }}'"><i class="fas fa-chart-line"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <button title="Estrutura Física do Município"  class="btn btn-outline-secondary btn-lg col-md-12" onclick="location.href='{{ url('/prefeituras/'.$prefeitura->id.'/organizacao') }}'"><i class="fas fa-sitemap"></i> </button> 
                                </div>
                                <div class="col-md-4">
                                <button title="Receitas Municipais" class="btn btn-outline-secondary btn-lg col-md-12" onclick="location.href='{{ url('/prefeitura/'.$prefeitura->id.'/receitas') }}'"><i class="fas fa-cash-register"></i></button>
                                </div>
                        </div>
                        <div class="row" style="text-align:center; padding: 5px 5px 5px 5px;">
                                <div class="col-md-4">
                                    <button title="Servidores e Funcionários" class="btn btn-outline-secondary btn-lg col-md-12" onclick="location.href='{{ url('/prefeitura/'.$prefeitura->id.'/servidores/list') }}'"><i class="fas fa-users"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <button title="Cadastro Mobiliário"  class="btn btn-outline-secondary btn-lg col-md-12" onclick="location.href='{{ url('/prefeitura/'.$prefeitura->id.'/mobiliaria') }}'"><i class="fas fa-briefcase"></i> </button> 
                                </div>
                                <div class="col-md-4">
                                    <button title="Cadastro de Imóveis" class="btn btn-outline-secondary btn-lg col-md-12" onclick="location.href='{{ url('/prefeitura/'.$prefeitura->id.'/imobiliaria') }}'"><i class="fas fa-warehouse"></i></i></button>
                                </div>
                        </div>
                        <div class="row" style="text-align:center; padding: 5px 5px 5px 5px;">  
                                <div class="col-md-4">
                                    <button title="Arrecadação" class="btn btn-outline-secondary btn-lg col-md-12" onclick="location.href='{{ url('/prefeitura/'.$prefeitura->id.'/arrecadacao') }}'"><i class="fas fa-money-bill-wave"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <button title="Nota Fiscal de Serviços Eletrônica"  class="btn btn-outline-secondary btn-lg col-md-12" onclick="location.href='{{ url('/prefeitura/'.$prefeitura->id.'/nfse') }}'"><i class="fas fa-file-invoice-dollar"></i> </button> 
                                </div>
                                <div class="col-md-4">
                                     <button title="Relatórios" class="btn btn-outline-secondary btn-lg col-md-12" onclick="location.href='{{ url('/prefeitura/'.$prefeitura->id.'/relatorios') }}'"><i class="fas fa-file-alt"></i></button>
                                </div>
                        </div>
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    </div>
                    <div class="col-lg-10 shadow">
                       <br>
                        @yield('content')
                        
                        
                        <nav class="navbar fixed-bottom navbar-light bg-light">
                        &copy 2019 Tributhor - Sistema de Automação em Arrecadação Municipal 
                        </nav>
                    </div>
                </div>
 
            </div>
        </main>

    </div>
</body>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "450px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>

</html>
