@extends('layouts.mun')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/prefeituras/{{$prefeitura->id}}/show">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/prefeituras/{{$prefeitura->id}}/organizacao">Organização</a></li>
    <li class="breadcrumb-item active" aria-current="page">Departamento</li>
  </ol>
</nav>
<h5><i class="fas fa-building"></i> {{$orgao->orgao}}</h5>
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
        <form action="/prefeitura/{{$prefeitura->id}}/orgaos/update" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden" value="{{$orgao->id_orgao}}" name="id_orgao" class="form-control input-lg text-uppercase" id="id_orgao"/>
            <div class="row">
                <div class="col-md-2">
                    <img class="img-circle" width="150" height="150" src="{{ asset('storage/brasoes/'.$orgao->arquivo)}}" alt="">
                    <br>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modalEditBrasao"><i class="fas fa-sync-alt"></i></button>
                </div>
                <div class="col-md-3">
                    <label class="font-weight-bold" for="">Órgão (nome)</label>
                    <div id="cp2" class="input-group" title="Using input value">
                        <input type="text" value="{{$orgao->orgao}}" name="nome" class="form-control input-lg text-uppercase" id="nome"/>
                    </div>
                </div>
                <div class="col-md-1">
                    <label class="font-weight-bold">Sigla</label>
                    <input type="text" value="{{$orgao->sigla}}" name="sigla" class="form-control" id="sigla">
                </div>
                <div class="col-md-3">
                    <label class="font-weight-bold" for="">Secretaria </label>
                    <div id="cp2" class="input-group" title="Using input value">
                        <select name="id_secretaria" id="id_secretaria" class="form-control">
                            <option  value="-1">Não sincronizar</option>
                            @foreach($secretarias as $secretaria)
                                @if($orgao->id_secretaria == $secretaria->id)
                                    <option selected="selected" value="{{$secretaria->id}}">{{$secretaria->nome}}</option>
                                @else
                                    <option value="{{$secretaria->id}}">{{$secretaria->nome}}</option>
                                @endif 
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <br>
                    <button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-sync-alt"></i> salvar</button>
                    @if($orgao->id_secretaria != null)
                        <button title="Existem registros vinculados à este orgao, portanto não pode ser excluido" disabled="true" class="btn btn-outline-danger disabled" type="button"><i class="fas fa-trash"></i> </button>
                    @else
                        <a href="/prefeitura/{{$prefeitura->id}}/orgaos/{{$orgao->id_orgao}}/delete" class="btn btn-outline-danger"><i class="fas fa-trash"></i> </a>
                    @endif
                </div>
            </div><br>            
        </form>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h5>Fundações</h5>
            
            </div>
            <div class="col-md-6">
                <h5>Servidores</h5>
                
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

<div class="modal fade" id="modalEditBrasao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content modal-sm">
            <div class="modal-body modal-sm">
                @include('app.brasao.edit')
            </div>
        </div>
    </div>
</div>
@endsection