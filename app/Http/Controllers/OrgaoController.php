<?php

namespace App\Http\Controllers;

use App\Fundacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Secretaria;
use App\Prefeitura;
use App\Orgao;
use App\Endereco;
use App\Brasao;

class OrgaoController extends Controller
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
        $criticaOrgao = Validator::make($request->all(), Orgao::rules())->validate();
        $prefeitura = Prefeitura::where("id", $idPrefeitura)->get()[0]; 
        $endereco = Endereco::where("id", $prefeitura->id_endereco)->get()[0];
        $dados = (object)$request->all();
        $idSecretaria = NULL;

        if($dados->id_secretaria != '-1'){
            $idSecretaria = $dados->id_secretaria;
        }
        
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

        $orgao = Orgao::create([
            "nome" => $dados->nome,
            "sigla" => $dados->sigla,
            "id_prefeitura" => $idPrefeitura,
            "id_endereco" => $enderecoCreate->id,
            "id_brasao" => $brasao->id,
            'id_secretaria' => $idSecretaria,
        ]);

        return redirect()->back()->with('message', 'Orgao cadastrado com sucesso!');
    }

    public function show($idPrefeitura, $idOrgao)
    {
        $prefeitura = DB::table("prefeitura")
                        ->leftJoin("prefeitura_estilo", "prefeitura.id_prefeitura_estilo", "=", "prefeitura_estilo.id")
                        ->leftJoin("brasao", "prefeitura_estilo.id_brasao", "=", "brasao.id")
                        ->join("endereco", "endereco.id", "=", "prefeitura.id_endereco")
                        ->select("prefeitura.*", "endereco.uf","endereco.cep" ,"endereco.ibge","endereco.bairro","endereco.logradouro", "endereco.localidade", "brasao.nome as arquivo", "brasao.diretorio", "brasao.extensao")
                        ->where("prefeitura.id", "=", $idPrefeitura)
                        ->get()[0];
        
        $secretarias = Secretaria::where("id_prefeitura", $prefeitura->id)->get();
        
        $orgao = DB::table('orgao')
            ->join('prefeitura', 'prefeitura.id', "=", 'orgao.id_prefeitura')
            ->leftJoin('secretaria', 'secretaria.id', "=", 'orgao.id_secretaria')
            ->leftJoin('brasao', 'brasao.id', "=", 'orgao.id_brasao')
            ->select('orgao.*', 'orgao.id as id_orgao', 'orgao.nome as orgao', 'brasao.*', 'brasao.nome as arquivo')
            ->where('orgao.id', $idOrgao)
            ->where('prefeitura.id', $idPrefeitura)
            ->get()[0];
        
        $idBrasao = $orgao->id_brasao;

        $endereco = Endereco::where("id", $orgao->id_endereco)->get()[0];

        $servidores = DB::table('servidor')
            ->join('alocacao', 'alocacao.id_servidor', "=", 'servidor.id')
            ->join('cargo', 'alocacao.id_cargo', "=", 'cargo.id')
            ->join('pessoa_fisica', 'pessoa_fisica.id', "=", 'servidor.id_pessoa_fisica')
            ->select('pessoa_fisica.*', 'cargo.nome as cargo')
            ->where('alocacao.id_orgao', $idOrgao)
            ->get();

        $fundacoes = Fundacao::where('id_orgao', $idOrgao)->get();
        return view('app/orgaos/show', compact('orgao', 'servidores', 'fundacoes', 'idBrasao','secretarias', 'prefeitura', 'endereco'));
    }

    public function update($idPrefeitura, Request $request)
    {
        $criticaOrgao = Validator::make($request->all(), Orgao::rules())->validate();
        $prefeitura = Prefeitura::where("id", $idPrefeitura)->get()[0]; 
        $dados = (object)$request->all();
       
        $orgao = Orgao::where("id", $dados->id_orgao)->update([
            "nome" => $dados->nome,
            "sigla" => $dados->sigla,
            "id_secretaria" => $dados->id_secretaria
        ]);

        return redirect()->back()->with('message', 'orgao atualizado com sucesso!');
    }

    public function delete($idPrefeitura, $idOrgao)
    {
        Orgao::where("id", $idOrgao)->delete();

        return redirect("/prefeituras/".$idPrefeitura.'/organizacao')->with('message', 'Orgao excluído com sucesso!');
    }
}
