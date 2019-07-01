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
            <div class="row">

            </div>
        </form>


        <hr>
        <div class="row">
            <div class="col-md-12">
                <h6>Registro de atividades</h6>
                <table class="table table-hover table-dark" style="font-size: 10px;">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Request</th>
                            <th>Atividade</th>
                            <th>Rota</th>
                            <th>Localidade</th>
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

                                </td>
                                <td>
                                    {{$log->description}}
                                </td>
                                <td>
                                    {{$log->route}}
                                </td>
                                <td>
                                    {{$log->locale}}
                                </td>
                                <td>
                                    {{$log->ipAddress}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

{{--                <ul class="list-group list-group-flush">--}}
{{--                    @forelse ($servidores as $servidor)--}}
{{--                        <li class="list-group-item">--}}
{{--                            <b class="text-uppercase">{{$servidor->nome}} - {{$servidor->cargo}}</b>--}}
{{--                            <small>3 days ago</small>--}}
{{--                        </li>--}}
{{--                    @empty--}}
{{--                        <div class="alert alert-warning">nenhum registro encontrado</div>--}}
{{--                    @endforelse--}}
{{--                </ul><br>--}}
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

{{--    <div class="modal fade" id="modalEditBrasao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-sm" role="document">--}}
{{--            <div class="modal-content modal-sm">--}}
{{--                <div class="modal-body modal-sm">--}}
{{--                    @include('app.brasao.edit')--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
