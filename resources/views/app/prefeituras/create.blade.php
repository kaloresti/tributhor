@extends('layouts.app')

@section('content')
 
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <fieldset>
        <legend>
            Nova Prefeitura 
        </legend>
        <form action="/prefeituras/store">
            <endereco-component></endereco-component>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for=""> <b>Sigla</b></label>
                    <input type="text" class="form-control" id="">
                </div>
                
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label class="font-weight-bold">Status/Situação</label>
                    <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" checked="true" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">Em homologação</label>
                    </div>
                    <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
                    <label class="custom-control-label" for="customSwitch2">Ativo</label>
                    </div>
                    <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
                    <label class="custom-control-label" for="customSwitch2">Inativo</label>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Brasão</label>
                    <file-image-component></file-image-component>
                </div>
                <div class="form-group col-md-3">
                    <label class="font-weight-bold" for="">Cor Principal</label>
                    <input type="text" class="form-control" id="">
                </div>
                <div class="form-group col-md-3">
                    <label class="font-weight-bold">Cor Secundária</label>
                    <input type="text" class="form-control" id="">
                </div>
            </div>
            <hr>
            <button class="btn btn-success btn-lg">Salvar</button>
        </form>
    </fieldset>

@endsection