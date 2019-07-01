<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Secretaria;
use App\Prefeitura;
use App\Departamento;
use App\Endereco;
use App\Brasao;
use App\Orgao;
use App\Fundacao;
use App\Servidor;

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
        $endereco = Endereco::where("id", $prefeitura->id_endereco)->get()[0];
        $dados = (object)$request->all();
        
        $brasao = Brasao::create([
            "nome" => "no-image.png",
            "extensao" => "png",
            "diretorio" => "brasoes",
            "tamanho" => "0"
        ]);
        
        $enderecoCreate = Endereco::create([
            "cep" => $endereco->cep,
            "localidade" => $endereco->localidade,
            "uf" => $endereco->uf,
            "bairro" => $endereco->bairro,
            "logradouro" => $endereco->logradouro,
            "ibge" => $endereco->ibge,
            "numero" => $endereco->numero,
            "complemento" => $endereco->complemento
        ]);

        $secretaria = Secretaria::create([
            "nome" => $dados->nome,
            "sigla" => $dados->sigla,
            "id_prefeitura" => $idPrefeitura,
            "id_endereco" => $enderecoCreate->id,
            "id_brasao" => $brasao->id,
        ]);

        return redirect()->back()->with(
            ['message' => 'Secretaria cadastrada com sucesso!'],
            ['tab' => 'secretaria']);
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
            ->leftJoin('brasao', 'brasao.id', "=", 'secretaria.id_brasao')
            ->select('secretaria.*', 'secretaria.id as id_secretaria', 'secretaria.nome as secretaria', 'brasao.*', 'brasao.nome as arquivo')
            ->where('secretaria.id', $idSecretaria)
            ->where('prefeitura.id', $idPrefeitura)
            ->get()[0];
        
        $idBrasao = $secretaria->id_brasao;

        $endereco = Endereco::where("id", $secretaria->id_endereco)->get()[0];

        $departamentos = Departamento::where('id_secretaria', $idSecretaria)->get();
        $orgaos = Orgao::where('id_secretaria', $idSecretaria)->get();
        $fundacoes = Fundacao::where('id_secretaria', $idSecretaria)->get();

        $servidores = DB::table('servidor')
            ->join('alocacao', 'alocacao.id_servidor', "=", 'servidor.id')
            ->join('cargo', 'alocacao.id_cargo', "=", 'cargo.id')
            ->join('pessoa_fisica', 'pessoa_fisica.id', "=", 'servidor.id_pessoa_fisica')
            ->select('pessoa_fisica.*', 'cargo.nome as cargo')
            ->where('alocacao.id_secretaria', $idSecretaria)
            ->get();

        return view('app/secretarias/show', compact('secretaria', 'servidores','idBrasao','departamentos', 'orgaos', 'fundacoes', 'prefeitura', 'endereco'));
    }

    public function update($idPrefeitura, Request $request)
    {
        $criticaSecretaria = Validator::make($request->all(), Secretaria::rules())->validate();
        $prefeitura = Prefeitura::where("id", $idPrefeitura)->get()[0]; 
        $dados = (object)$request->all();
       
        $secretaria = Secretaria::where("id", $dados->id_secretaria)->update([
            "nome" => $dados->nome,
            "sigla" => $dados->sigla,
        ]);

        return redirect()->back()->with('message', 'Secretaria atualizada com sucesso!');
    }

    public function delete($idPrefeitura, $idSecretaria)
    {
        Secretaria::where("id", $idSecretaria)->delete();

        return redirect("/prefeituras/".$idPrefeitura.'/organizacao')->with('message', 'Secretaria excluída com sucesso!');
    }
}
