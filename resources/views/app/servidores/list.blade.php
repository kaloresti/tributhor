@extends('layouts.mun')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/prefeituras/{{$prefeitura->id}}/show">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Organização</li>
  </ol>
</nav>
<h5><i class="fas fa-sitemap"></i> Estrutura Organizacional do Município</h5>
<hr>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<fieldset>
    <div class="row">
        <div class="col-md-10">
            <simple-search-component></simple-search-component>
        </div>
        <div class="col-md-2">
            <a href="" data-toggle="modal" data-target="#modalCreateServidor"  class="btn btn-outline-info col-md-12"> <i class="fas fa-plus"></i> Novo Servidor</a>
        </div>
    </div>
            
    <table class="table table-hover table-dashed table-bordered table-condensed text-uppercase">
        <tbody>
            @forelse($servidores as $servidor)
                <tr>
                    <td style="width:20%">
                        <img class="img-circle" width="150" height="150" src="{{ asset('storage/brasoes/no-image.png')}}" alt="">
                    </td>
                    <td style="width:50%">
                        <h3 class="text-uppercase"> <i class="fa fa-user"></i> {{$servidor->servidor}}</h3>
                        <small><i class="fas fa-envelope"> </i> 
                            {{$servidor->email}}
                        </small><br>
                        <small><i class="fas fa-envelope"> </i> 
                            Cargo: {{$servidor->cargo}}
                        </small><br>
                        <small>Perfil: <span class="badge badge-primary"><i class="fas fa-envelope"> </i> 
                            {{$servidor->perfil}}</span> 
                        </small><br>
                        <small>Situação Funcional: <span class="badge badge-primary"><i class="fas fa-envelope"> </i> 
                            {{$servidor->situacao_funcional}}</span> 
                        </small><br>
                        <small> <i class="fas fa-map-marker-alt"></i> 
                            {{$servidor->cep}} - {{$servidor->localidade}} - {{$servidor->uf}}, {{$servidor->logradouro}} - {{$servidor->numero}}, {{$servidor->complemento}}, {{$servidor->bairro}}
                        </small>
                    </td>
                    <td style="width:30%">
                        <b>alocação</b>   <br>
                        <small><i class="fas fa-envelope"> </i> 
                            {{$servidor->secretaria}}
                        </small><br>
                        <small><i class="fas fa-envelope"> </i> 
                            {{$servidor->departamento}}
                        </small><br>
                        <small><i class="fas fa-envelope"> </i> 
                            {{$servidor->orgao}}
                        </small><br>
                        <small><i class="fas fa-envelope"> </i> 
                            {{$servidor->fundacao}}
                        </small><br>
                        <small><i class="fas fa-envelope"> </i> 
                            {{$servidor->situacao_cadastral}}
                        </small><br>

                    </td>
                    <td></td>
                </tr>
            @empty
                <p>nenhum registro encontrado</p>
            @endforelse

        </tbody>
    </table>
</fieldset> 

<!-- Modal -->
<div class="modal fade" id="modalCreateServidor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-body modal-xl">
                @include('app.servidores.create')
            </div>
        </div>
    </div>
</div>
@endsection