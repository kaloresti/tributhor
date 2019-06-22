<form action="/prefeitura/{{$prefeitura->id}}/fundacoes/store" enctype="multipart/form-data" method="POST">
@csrf
    <h3><i class="fa fa-plus"></i> Nova Fundação</h3>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Secretaria <small>(escolha uma secretaria para sincronizar)</small></label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_secretaria" id="id_secretaria" class="form-control">
                        <option  value="-1">Não sincronizar</option>
                        @foreach($secretarias as $secretaria)
                            <option value="{{$secretaria->id}}">{{$secretaria->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Departamento <small>(escolha um departamento para sincronizar)</small></label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_departamento" id="id_departamento" class="form-control">
                        <option  value="-1">Não sincronizar</option>
                        @foreach($departamentos as $departamento)
                            <option value="{{$departamento->id_departamento}}">{{$departamento->departamento}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold" for="">Órgãos <small>(escolha um órgão para sincronizar)</small></label>
                <div id="cp2" class="input-group" title="Using input value">
                    <select name="id_orgao" id="id_orgao" class="form-control">
                        <option  value="-1">Não sincronizar</option>
                        @foreach($orgaos as $orgao)
                            <option value="{{$orgao->id_orgao}}">{{$orgao->orgao}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-10">
                <label class="font-weight-bold" for="">Fundação (nome)</label>
                <div id="cp2" class="input-group" title="Using input value">
                    <input type="text" name="nome" class="form-control input-lg" id="nome"/>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label class="font-weight-bold">Sigla</label>
                <input type="text" name="sigla" class="form-control" id="sigla">
            </div>
        </div>
    <hr>
    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save"></i> Salvar</button>
</form>