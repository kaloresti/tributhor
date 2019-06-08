@extends('layouts.app')

@section('content')
 
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <fieldset>
        <legend>
            Nova Prefeitura 
        </legend>
        <form method="POST" action="/prefeituras/store" enctype="multipart/form-data">
        @csrf
            <endereco-component></endereco-component>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for=""> <b>Sigla</b></label>
                    <input type="text" class="form-control" id="sigla" name="sigla">
                </div>
                
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label class="font-weight-bold">Status/Situação</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" checked="true" id="situacao" name="situacao" value="homologacao">
                        <label class="custom-control-label" for="customSwitch1">Em homologação</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" disabled class="custom-control-input" id="situacao" name="situacao">
                        <label class="custom-control-label" for="customSwitch2">Ativo</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" disabled class="custom-control-input" id="situacao" name="situacao">
                        <label class="custom-control-label" for="customSwitch2">Inativo</label>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Brasão</label>
                    <file-image-component></file-image-component>
                </div>
                <div class="form-group col-md-3">
                    <label class="font-weight-bold" for="">Cor Principal</label>
                    <div id="cp2" class="input-group" title="Using input value">
                        <input type="color" name="cor_primaria" class="form-control input-lg" value="cor_primaria"/>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="font-weight-bold">Cor Secundária</label>
                    <input type="color" name="cor_secundaria" class="form-control" id="cor_secundaria">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-lg">Salvar</button>
        </form>
    </fieldset>
   
@endsection