<form action="/prefeitura/{{$prefeitura->id}}/secretarias/store" enctype="multipart/form-data" method="POST">
@csrf
    <h3><i class="fa fa-plus"></i> Nova Secretaria</h3>
    <div class="form-row">
        <div class="form-group col-md-10">
            <label class="font-weight-bold" for="">Secretaria (nome)</label>
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