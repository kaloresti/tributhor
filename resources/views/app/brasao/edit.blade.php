<form action="/brasao/update" enctype="multipart/form-data" method="POST">
    @csrf
    <input type="hidden" name="id_brasao" value="{{$idBrasao}}">
    Novo brasão
    <file-image-component></file-image-component><br><br>
    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save"></i> Salvar</button><br><br><br>
</form>