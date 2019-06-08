@extends('layouts.mun')

@section('content')
 

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
            <table class="table table-hover">
                <tbody>
                    @forelse ($secretarias as $secretaria)
                        <tr>
                            <td>{{$secretaria->nome}}</td>
                            <td>
                                <a href="/prefeituras/{{$secretaria->id}}/show" class="btn btn-info pull-right"><i class="fas fa-edit"></i></a>
                                <a href="/prefeituras/{{$secretaria->id}}/show" class="btn btn-danger pull-right"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>nenhum registro encontrado</tr>
                    @endforelse
                </tbody>
            </table>
            </div>
            <div class="tab-pane fade" id="pills-departamento" role="tabpanel" aria-labelledby="pills-departamento-tab">departamentos</div>
            <div class="tab-pane fade" id="pills-orgao" role="tabpanel" aria-labelledby="pills-orgao-tab">órgãos</div>
            <div class="tab-pane fade" id="pills-fundacao" role="tabpanel" aria-labelledby="pills-fundacao-tab">fundações</div>
            <div class="tab-pane fade" id="pills-servidor" role="tabpanel" aria-labelledby="pills-servidor-tab">servidores</div>
            <div class="tab-pane fade" id="pills-receita" role="tabpanel" aria-labelledby="pills-receita-tab">receitas</div>
            <div class="tab-pane fade" id="pills-patrimonio" role="tabpanel" aria-labelledby="pills-patrimonio-tab">patrimonios</div>
        </div>
    </fieldset> 
@endsection