@extends('layouts.mun')

@section('content')

<h3><i class="fas fa-building"></i> {{$secretaria->nome}}</h3>
<button class="btn btn-info btn-sm">
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
        <form action="">
            <div class="row">
                <div class="col-md-2">
                    <label class="font-weight-bold" for="">Logo</label>
                    <img src="..." class="rounded float-left" alt="...">
                </div>
                <div class="col-md-5">
                    <label class="font-weight-bold" for="">Secretaria (nome)</label>
                    <div id="cp2" class="input-group" title="Using input value">
                        <input type="text" value="{{$secretaria->nome}}" name="nome" class="form-control input-lg" id="nome"/>
                    </div>
                </div>
                <div class="col-md-5">
                    <label class="font-weight-bold">Sigla</label>
                    <input type="text" value="{{$secretaria->sigla}}" name="sigla" class="form-control" id="sigla">
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-sync-alt"></i> Salvar atualizações</button>
                    @if(count($departamentos) > 0)
                        <button title="Existem registros vinculados à esta secretaria, portanto não pode ser excluida" disabled="true" class="btn btn-danger disabled" type="button"><i class="fas fa-trash"></i> Deletar</button>
                    @else
                        <button type="button" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar</button>
                    @endif
                </div>
            </div>
        </form>
        <br><br>
        <h5>outros cadastros relacionados</h5>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h5>Departamentos</h5>
                @forelse ($departamentos as $departamento)
                    <a class="link" href="">{{$departamento->nome}} - {{$departamento->sigla}}</a><br>
                @empty
                    <div class="alert alert-warning">nenhum registro encontrado</div>  
                @endforelse
            </div>
            <div class="col-md-6">
                <h5>Sintético de Arrecadação</h5>
            </div>
            <div class="col-md-6">
                <h5>Órgãos</h5>
                @forelse ($departamentos as $departamento)
                    <a class="link" href="">{{$departamento->nome}} - {{$departamento->sigla}}</a><br>
                @empty
                    <div class="alert alert-warning">nenhum registro encontrado</div>  
                @endforelse
            </div>
            <div class="col-md-6">
                <h5>Fundações</h5>
                @forelse ($departamentos as $departamento)
                    <a class="link" href="">{{$departamento->nome}} - {{$departamento->sigla}}</a><br>
                @empty
                    <div class="alert alert-warning">nenhum registro encontrado</div>  
                @endforelse
            </div>
            <div class="col-md-6">
                <h5>Servidores</h5>
                @forelse ($departamentos as $departamento)
                    <a class="link" href="">{{$departamento->nome}} - {{$departamento->sigla}}</a><br>
                @empty
                    <div class="alert alert-warning">nenhum registro encontrado</div>  
                @endforelse
            </div>
        </div>
    </fieldset>
@endsection