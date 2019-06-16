<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Secretaria;
use App\Prefeitura;
use App\Departamento;
use App\Endereco;

class SecretariaController extends Controller
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

    public function store($idPrefeitura, Request $request)
    {
        $criticaSecretaria = Validator::make($request->all(), Secretaria::rules())->validate();
        $prefeitura = Prefeitura::where("id", $idPrefeitura)->get()[0]; 
        $dados = (object)$request->all();
        
        $secretaria = Secretaria::create([
            "nome" => $dados->nome,
            "sigla" => $dados->sigla,
            "id_prefeitura" => $idPrefeitura,
            "id_endereco" => $prefeitura->id_endereco,
        ]);

        return redirect()->back()->with('message', 'Secretaria cadastrada com sucesso!');
    }

    public function show($idPrefeitura, $idSecretaria)
    {
        $prefeitura = DB::table("prefeitura")
                        ->leftJoin("prefeitura_estilo", "prefeitura.id_prefeitura_estilo", "=", "prefeitura_estilo.id")
                        ->leftJoin("brasao", "prefeitura_estilo.id_brasao", "=", "brasao.id")
                        ->join("endereco", "endereco.id", "=", "prefeitura.id_endereco")
                        ->select("prefeitura.*", "endereco.uf","endereco.cep" ,"endereco.ibge","endereco.bairro","endereco.logradouro", "endereco.localidade", "brasao.nome as arquivo", "brasao.diretorio", "brasao.extensao")
                        ->where("prefeitura.id", "=", $idPrefeitura)
                        ->get()[0];

        $secretaria = DB::table('secretaria')
            ->join('prefeitura', 'prefeitura.id', "=", 'secretaria.id_prefeitura')
            ->select('secretaria.*')
            ->where('secretaria.id', $idSecretaria)
            ->where('prefeitura.id', $idPrefeitura)
            ->get()[0];

        $endereco = Endereco::where("id", $secretaria->id_endereco)->get()[0];

        $departamentos = Departamento::where('id_secretaria', $idSecretaria)->get();

        return view('app/secretarias/show', compact('secretaria', 'departamentos', 'prefeitura', 'endereco'));
    }
}
