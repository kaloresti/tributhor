@extends('layouts.mun')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/prefeituras/{{$prefeitura->id}}/show">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Servidor</li>
        </ol>
    </nav>
    <h5><i class="fas fa-building"></i> {{$servidor->servidor}}</h5>
    <button type="button" data-toggle="modal" data-target="#modalEditEndereco" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-map-marker-alt"></i> {{$endereco->cep}} - {{$endereco->localidade}} - {{$endereco->uf}}, {{$endereco->logradouro}} - {{$endereco->numero}}, {{$endereco->complemento}}, {{$endereco->bairro}}
    </button>
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
        <form action="/prefeitura/{{$prefeitura->id}}/servidores/update" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden" value="{{$servidor->id_servidor}}" name="id_servidor" class="form-control input-lg text-uppercase" id="id_servidor"/>
            <small>alocação e situação funcional</small>
            <hr>
            <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Secretaria </label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_secretaria" id="id_secretaria" class="form-control">
                        <option  value="-1">Não vinculado</option>
                        @foreach($secretarias as $secretaria)
                            @if($servidor->id_secretaria == $secretaria->id)
                                <option selected="selected" value="{{$secretaria->id}}">{{$secretaria->nome}}</option>
                            @else
                                <option value="{{$secretaria->id}}">{{$secretaria->nome}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Departamento </label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_departamento" id="id_departamento" class="form-control">
                        <option  value="-1">Não vinculado</option>
                        @foreach($departamentos as $departamento)
                            <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Órgão</label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_orgao" id="id_orgao" class="form-control">
                        <option  value="-1">Não vinculado</option>
                        @foreach($orgaos as $orgao)
                            <option value="{{$orgao->id}}">{{$orgao->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Fundação</label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_fundacao" id="id_fundacao" class="form-control">
                        <option  value="-1">Não vinculado</option>
                        @foreach($fundacoes as $fundacao)
                            <option value="{{$fundacao->id}}">{{$fundacao->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Cargo</label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_cargo" id="id_cargo" class="form-control">
                        @foreach($cargos as $cargo)
                            <option value="{{$cargo->id}}">{{$cargo->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Situação funcional</label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_situacao_funcional" id="id_situacao_funcional" class="form-control" required="required">
                        @foreach($situacoesFuncionais as $funcional)
                            <option value="{{$funcional->id}}">{{$funcional->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Situação cadastral</label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_situacao_cadastral" id="id_situacao_cadastral" class="form-control" required="required">
                        @foreach($situacoesCadastrais as $cadastral)
                                <option value="{{$cadastral->id}}">{{$cadastral->nome}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Data Admissão</label>
                <input type="date" name="iniciado_em" class="form-control" id="iniciado_em">
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Clique oara salvar as atualizações</label>
                <div id="cp2" class="input-group" title="Using input value">
                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-sync-alt"></i> salvar</button>
                </div>
            </div>
        </div>
        
        </form>
        <hr>

        <div class="row">
            <div class="col-md-12">
            <h6>Registro de atividades</h6>
                <table class="table table-hover table-condensed table-dark" style="font-size: 10px;">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Request</th>
                            <th>Atividade</th>
                            <th>Rota</th>
                            <th>IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logUser as $log)
                            <tr>
                                <td>
                                    {{$log->created_at}}
                                </td>
                                <td>
                                    @if($log->methodType == 'POST')
                                        <span class="badge badge-success">{{$log->methodType}}</span>
                                    @endif
                                    @if($log->methodType == 'GET')
                                        <span class="badge badge-primary">{{$log->methodType}}</span>
                                    @endif
                                    @if($log->methodType == 'PUT')
                                        <span class="badge badge-warning">{{$log->methodType}}</span>
                                    @endif
                                    @if($log->methodType == 'DELETE')
                                        <span class="badge badge-danger">{{$log->methodType}}</span>
                                    @endif
                                </td>
                                <td>
                                    {{$log->description}}
                                </td>
                                <td>
                                    {{$log->route}}
                                </td>
                                <td>
                                    {{$log->ipAddress}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </fieldset>

    <!-- Modal -->
    <div class="modal fade" id="modalEditEndereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-xl">
                <div class="modal-body modal-xl">
                    @include('app.endereco.edit')
                </div>
            </div>
        </div>
    </div>

<!-- {{--    <div class="modal fade" id="modalEditBrasao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-sm" role="document">--}}
{{--            <div class="modal-content modal-sm">--}}
{{--                <div class="modal-body modal-sm">--}}
{{--                    @include('app.brasao.edit')--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}} -->
@endsection
