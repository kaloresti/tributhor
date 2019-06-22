<form action="/endereco/update" enctype="multipart/form-data" method="POST">
    @csrf
    <input type="hidden" name="id_endereco" value="{{$endereco->id}}">
    <endereco-component></endereco-component>
    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save"></i> Salvar</button><br><br><br>
    <p><i ></i> <i class="fas fa-map-marker-alt"></i> {{$endereco->cep}} - {{$endereco->localidade}} - {{$endereco->uf}}, {{$endereco->logradouro}} - {{$endereco->numero}}, {{$endereco->complemento}}, {{$endereco->bairro}}</p>
</form>