@extends('layouts.app')

@section('content')
 

   
       
        <h2>
        <i class="fas fa-list"></i> Lista de Prefeituras <a href="/prefeituras/create" style="text-align:right" class="btn btn-primary btn-sm pull-right">Nova prefeitura</a>
        </h2>    
       

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Prefeitura</th>
                    <th>UF</th>
                    <th>Situação</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prefeituras as $prefeitura)
                    <tr>
                        <td>{{$prefeitura->nome}}</td>
                        <td>{{$prefeitura->uf}}</td>
                        <td>{{$prefeitura->situacao}}</td>
                        <td>
                            <a href="/prefeituras/{{$prefeitura->id}}/show" class="btn btn-primary pull-right"><i class="fas fa-folder-open"></i> abrir</a>
                            <a href="/prefeituras/{{$prefeitura->id}}/edit" class="btn btn-info pull-right"><i class="fas fa-edit"></i></a>
                            <a href="/prefeituras/{{$prefeitura->id}}/delete" class="btn btn-danger pull-right"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>nenhum registro encontrado</tr>
                @endforelse
            </tbody>
        </table>
     
@endsection