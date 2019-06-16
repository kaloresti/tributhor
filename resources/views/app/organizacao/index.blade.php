@extends('layouts.mun')

@section('content')
<h3><i class="fas fa-sitemap"></i> Estrutura Organizacional do Município</h3>
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
            <a class="nav-link" id="pills-servidor-tab" data-toggle="pill" href="#pills-servidor" role="tab" aria-controls="pills-servidor" aria-selected="false"> <i class="fas fa-user-friends"></i> Servidores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-receita-tab" data-toggle="pill" href="#pills-receita" role="tab" aria-controls="pills-receita" aria-selected="false"> <i class="fas fa-money-check-alt"></i> Receitas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-patrimonio-tab" data-toggle="pill" href="#pills-patrimonio" role="tab" aria-controls="pills-patrimonio" aria-selected="false"> <i class="fas fa-city"></i> Patrimonios</a>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-secretaria" role="tabpanel" aria-labelledby="pills-secretaria-tab">
            <div class="row">
                <div class="col-md-10">
                    <simple-search-component></simple-search-component>
                </div>
                <div class="col-md-2">
                    <a href="" class="btn btn-outline-info" data-toggle="modal" data-target="#modalCreateSecretaria"> <i class="fas fa-plus"></i> nova secretaria</a>
                    
                </div>
            </div>
            <table class="table table-hover table-dashed table-bordered table-condensed">
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
                    <a href="" class="btn btn-outline-info"> <i class="fas fa-plus"></i> novo departamento</a>
                </div>
            </div>
            
            <table class="table table-hover table-dashed table-bordered table-condensed">
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
                            <td>{{$departamento->departamento}}</td>
                            <td>{{$departamento->sigla_departamento}}</td>
                            <td>{{$departamento->secretaria}}</td>
                            <td>
                                <a href="" class="btn btn-outline-info pull-right btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="" class="btn btn-outline-danger pull-right btn-sm"><i class="fas fa-trash"></i></a>
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
                    <a href="" class="btn btn-outline-info"> <i class="fas fa-plus"></i> novo órgão</a>
                </div>
            </div>
            
            <table class="table table-hover table-dashed table-bordered table-condensed">
                <tbody>
                    @forelse ($orgaos as $orgao)
                        <tr>
                            <td>{{$orgao->orgao}}</td>
                            <td>{{$orgao->secretaria}}</td>
                            <td>{{$orgao->departamento}}</td>
                            <td>
                                <a href="" class="btn btn-outline-info pull-right btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="" class="btn btn-outline-danger pull-right btn-sm"><i class="fas fa-trash"></i></a>
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
            <a href="" class="btn btn-outline-info"> <i class="fas fa-plus"></i> nova fundação</a>
        </div>
        <div class="tab-pane fade" id="pills-servidor" role="tabpanel" aria-labelledby="pills-servidor-tab">
            <a href="" class="btn btn-outline-info"> <i class="fas fa-plus"></i> novo servidor</a>
        </div>
        <div class="tab-pane fade" id="pills-receita" role="tabpanel" aria-labelledby="pills-receita-tab">receitas</div>
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
@endsection