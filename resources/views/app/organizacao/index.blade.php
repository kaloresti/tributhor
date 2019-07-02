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
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-secretaria-tab" data-toggle="pill" href="#pills-secretaria" role="tab" aria-controls="pills-secretaria" aria-selected="true"><i class="fas fa-building"></i> Secretarias</a>    
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-departamento-tab" data-toggle="pill" href="#pills-departamento" role="tab" aria-controls="pills-departamento" aria-selected="false"> <i class="fas fa-store-alt"></i> Departamentos</a>          
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-orgao-tab" data-toggle="pill" href="#pills-orgao" role="tab" aria-controls="pills-orgao" aria-selected="false"> <i class="fas fa-store"></i> Órgãos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-fundacao-tab" data-toggle="pill" href="#pills-fundacao" role="tab" aria-controls="pills-fundacao" aria-selected="false"> <i class="fas fa-landmark"></i> Fundações</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-patrimonio-tab" data-toggle="pill" href="#pills-patrimonio" role="tab" aria-controls="pills-patrimonio" aria-selected="false"> <i class="fas fa-city"></i> Patrimonios <span class="badge badge-warning">future</span></a>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-secretaria" role="tabpanel" aria-labelledby="pills-secretaria-tab">
            <div class="row">
                <div class="col-md-10">
                    <simple-search-component></simple-search-component>
                </div>
                <div class="col-md-2">
                    <a href="" class="btn btn-outline-info col-md-12" data-toggle="modal" data-target="#modalCreateSecretaria"> <i class="fas fa-plus"></i> nova secretaria</a>
                </div>
            </div>
            <table class="table table-hover table-dashed table-bordered table-condensed text-uppercase table-dark">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sigla</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($secretarias as $secretaria)
                    <tr>
                        <td> <span class="text-uppercase"> <i class="fas fa-building"></i> {{$secretaria->nome}} </span></td>
                        <td>{{$secretaria->sigla}}</td>
                        <td>
                            <a href="/prefeitura/{{$prefeitura->id}}/secretarias/{{$secretaria->id}}/show" class="btn btn-outline-primary pull-right btn-sm"><i class="fas fa-folder-open"></i> abrir</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <div class="alert alert-warning" role="alert">
                            nenhum registro encontrado
                        </div>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="pills-departamento" role="tabpanel" aria-labelledby="pills-departamento-tab">
            <div class="row">
                <div class="col-md-10">
                    <simple-search-component></simple-search-component>
                </div>
                <div class="col-md-2">
                    <a data-toggle="modal" data-target="#modalCreateDepartamento" href="" class="btn btn-outline-info col-md-12"> <i class="fas fa-plus"></i> Novo Departamento</a>
                </div>
            </div>
            
            <table class="table table-hover table-dashed table-bordered table-condensed text-uppercase table-dark">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sigla</th>
                        <th>Secretaria vinculada</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($departamentos as $departamento)
                        <tr>
                            <td class="text-uppercase">{{$departamento->departamento}}</td>
                            <td>{{$departamento->sigla_departamento}}</td>
                            <td>
                                @if($departamento->secretaria)
                                    {{$departamento->secretaria}}
                                @else
                                    <small class="badge badge-danger">não vinculado</small>
                                @endif
                            </td>
                            <td>
                                <a href="/prefeitura/{{$prefeitura->id}}/departamentos/{{$departamento->id_departamento}}/show" class="btn btn-outline-primary pull-right btn-sm"><i class="fas fa-folder-open"></i> abrir</a>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <div class="alert alert-warning" role="alert">
                            nenhum registro encontrado
                        </div>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
        </div>
        <div class="tab-pane fade" id="pills-orgao" role="tabpanel" aria-labelledby="pills-orgao-tab">
            <div class="row">
                <div class="col-md-10">
                    <simple-search-component></simple-search-component>
                </div>
                <div class="col-md-2">
                    <a href="" data-toggle="modal" data-target="#modalCreateOrgao"  class="btn btn-outline-info col-md-12"> <i class="fas fa-plus"></i> Novo Órgão</a>
                </div>
            </div>
            
            <table class="table table-hover table-dashed table-bordered table-condensed text-uppercase table-dark">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sigla</th>
                        <th>Secretaria vinculada</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orgaos as $orgao)
                        <tr>
                            <td>{{$orgao->orgao}}</td>
                            <td>{{$orgao->sigla_orgao}}</td>
                            <td>
                                @if($orgao->secretaria)
                                    {{$orgao->secretaria}}
                                @else
                                    <small class="badge badge-danger">não vinculado</small>
                                @endif
                            </td>
                            <td>
                                <a href="/prefeitura/{{$prefeitura->id}}/orgaos/{{$orgao->id_orgao}}/show" class="btn btn-outline-primary pull-right btn-sm"><i class="fas fa-folder-open"></i> abrir</a>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <div class="alert alert-warning" role="alert">
                            nenhum registro encontrado
                        </div>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="pills-fundacao" role="tabpanel" aria-labelledby="pills-fundacao-tab">
            <div class="row">
                <div class="col-md-10">
                    <simple-search-component></simple-search-component>
                </div>
                <div class="col-md-2">
                    <a href="" data-toggle="modal" data-target="#modalCreateFundacao"  class="btn btn-outline-info col-md-12"> <i class="fas fa-plus"></i> Nova Fundação</a>
                </div>
            </div>
            
            <table class="table table-hover table-dashed table-bordered table-condensed text-uppercase table-dark">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sigla</th>
                        <th>Secretaria vinculada</th>
                        <th>Departamento vinculada</th>
                        <th>Órgão regulamentador</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fundacoes as $fundacao)
                        <tr>
                            <td>{{$fundacao->fundacao}}</td>
                            <td>{{$fundacao->sigla_fundacao}}</td>
                            <td>
                                @if($fundacao->secretaria)
                                    {{$fundacao->secretaria}}
                                @else
                                    <small class="badge badge-danger">não vinculado</small>
                                @endif
                            </td>
                            <td>
                                @if($fundacao->departamento)
                                    {{$fundacao->departamento}}
                                @else
                                    <small class="badge badge-danger">não vinculado</small>
                                @endif
                            </td>
                            <td>
                                @if($fundacao->orgao)
                                    {{$fundacao->orgao}}
                                @else
                                    <small class="badge badge-danger">não vinculado</small>
                                @endif
                            </td>
                            <td>
                                <a href="/prefeitura/{{$prefeitura->id}}/fundacoes/{{$fundacao->id_fundacao}}/show" class="btn btn-outline-primary pull-right btn-sm"><i class="fas fa-folder-open"></i> abrir</a>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <div class="alert alert-warning" role="alert">
                            nenhum registro encontrado
                        </div>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="pills-patrimonio" role="tabpanel" aria-labelledby="pills-patrimonio-tab">patrimonios</div>
    </div>
</fieldset> 

<!-- Modal -->
<div class="modal fade" id="modalCreateSecretaria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-body modal-xl">
                @include('app.secretarias.create')
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCreateDepartamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-body modal-xl">
                @include('app.departamentos.create')
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCreateOrgao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-body modal-xl">
                @include('app.orgaos.create')
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCreateFundacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-body modal-xl">
                @include('app.fundacoes.create')
            </div>
        </div>
    </div>
</div>

@endsection