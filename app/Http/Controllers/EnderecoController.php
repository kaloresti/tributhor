<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Endereco;

class EnderecoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {
        $critica = Validator::make($request->all(), Endereco::rules())->validate();
        $dados = (object)$request->all();
       
        $endereco = Endereco::where("id", $dados->id_endereco)->update([
            "cep" => $dados->cep,
            "localidade" => $dados->localidade,
            "uf" => $dados->uf,
            "bairro" => $dados->bairro,
            "logradouro" => $dados->logradouro,
            "ibge" => $dados->ibge,
            "numero" => $dados->numero,
            "complemento" => $dados->complemento
        ]);

        return redirect()->back()->with('message', 'Endereço atualizado com sucesso!');
    }
}
