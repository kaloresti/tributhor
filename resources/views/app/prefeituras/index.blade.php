@extends('layouts.app')

@section('content')
<h4><i class="fas fa-list"></i> Prefeituras <a href="/prefeituras/create" style="text-align:right" class="btn btn-outline-info btn-sm pull-right"><i class="fas fa-plus"></i> Nova prefeitura</a></h4>
<hr>
<table class="table table-hover">
    <thead>
        <tr>
            <th>brasao</th>
            <th>Prefeitura</th>
            <th>UF</th>
            <th>Situação</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($prefeituras as $prefeitura)
            <tr>
                <td><img width="30" height="30" src="{{ asset('storage/brasoes/'.$prefeitura->arquivo)}}" alt=""></td>
                <td>{{$prefeitura->nome}}</td>
                <td>{{$prefeitura->uf}}</td>
                <td>{{$prefeitura->situacao}}</td>
                <td>
                    <a href="/prefeituras/{{$prefeitura->id}}/show" class="btn btn-outline-primary pull-right btn-sm"><i class="fas fa-folder-open"></i> abrir</a>
                    <a href="/prefeituras/{{$prefeitura->id}}/edit" class="btn btn-outline-info pull-right btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="/prefeituras/{{$prefeitura->id}}/delete" class="btn btn-outline-danger pull-right btn-sm"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        @empty
            <div class="alert alert-warning">Nenhum registro encontrado</div>
        @endforelse
    </tbody>
</table>   
@endsection