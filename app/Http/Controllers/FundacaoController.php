<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Secretaria;
use App\Prefeitura;
use App\Departamento;
use App\Fundacao;
use App\Orgao;
use App\Endereco;
use App\Brasao;

class FundacaoController extends Controller
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
        $criticaFundacao = Validator::make($request->all(), Fundacao::rules())->validate();
        $prefeitura = Prefeitura::where("id", $idPrefeitura)->get()[0]; 
        $endereco = Endereco::where("id", $prefeitura->id_endereco)->get()[0];
        $dados = (object)$request->all();
        
        $idSecretaria = NULL;
        $idDepartamento = NULL;
        $idOrgao = NULL;

        if($dados->id_secretaria != '-1')
            $idSecretaria = $dados->id_secretaria;

        if($dados->id_departamento != '-1')
            $idDepartamento = $dados->id_departamento;

        if($dados->id_orgao != '-1')
            $idOrgao = $dados->id_orgao;

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

        $fundacao = Fundacao::create([
            "nome" => $dados->nome,
            "sigla" => $dados->sigla,
            "id_secretaria" => $idSecretaria,
            "id_departamento" => $idDepartamento,
            "id_orgao" => $idOrgao,
            "id_prefeitura" => $idPrefeitura,
            "id_endereco" => $enderecoCreate->id,
            "id_brasao" => $brasao->id,
        ]);

        return redirect()->back()->with('message', 'Fundação cadastrada com sucesso!');
    }

    public function show($idPrefeitura, $idFundacao)
    {
        $prefeitura = DB::table("prefeitura")
                        ->leftJoin("prefeitura_estilo", "prefeitura.id_prefeitura_estilo", "=", "prefeitura_estilo.id")
                        ->leftJoin("brasao", "prefeitura_estilo.id_brasao", "=", "brasao.id")
                        ->join("endereco", "endereco.id", "=", "prefeitura.id_endereco")
                        ->select("prefeitura.*", "endereco.uf","endereco.cep" ,"endereco.ibge","endereco.bairro","endereco.logradouro", "endereco.localidade", "brasao.nome as arquivo", "brasao.diretorio", "brasao.extensao")
                        ->where("prefeitura.id", "=", $idPrefeitura)
                        ->get()[0];

        $fundacao = DB::table("fundacao")
            ->leftJoin("secretaria", "secretaria.id", "=", "fundacao.id_secretaria")
            ->leftJoin("departamento", "departamento.id", "=", "fundacao.id_departamento")
            ->leftJoin("orgao", "orgao.id", "=", "fundacao.id_orgao")
            ->leftJoin("brasao", "fundacao.id_brasao", "=", "brasao.id")
            ->join("prefeitura", "prefeitura.id", "=", "fundacao.id_prefeitura")
            ->select('fundacao.*', 'fundacao.id as id_fundacao', 'fundacao.nome as fundacao', 'brasao.*', 'brasao.nome as arquivo')
            ->where('fundacao.id', $idFundacao)
            ->where('prefeitura.id', $idPrefeitura)
            ->get()[0];
        
        $idBrasao = $fundacao->id_brasao;

        $endereco = Endereco::where("id", $fundacao->id_endereco)->get()[0];

        $departamentos = Departamento::where('id_prefeitura', $idPrefeitura)->get();
        $secretarias = Secretaria::where('id_prefeitura', $idPrefeitura)->get();
        $orgaos = Orgao::where('id_prefeitura', $idPrefeitura)->get();

        return view('app/fundacoes/show', compact('fundacao', 'idBrasao', 'prefeitura', 'endereco','secretarias', 'departamentos', 'orgaos'));
    }

    public function update($idPrefeitura, Request $request)
    {
        $criticaDepartamento = Validator::make($request->all(), Departamento::rules())->validate();
        $prefeitura = Prefeitura::where("id", $idPrefeitura)->get()[0]; 
        $dados = (object)$request->all();
       
        $fundacao = Fundacao::where("id", $dados->id_fundacao)->update([
            "nome" => $dados->nome,
            "sigla" => $dados->sigla,
            "id_secretaria" => $dados->id_secretaria,
            "id_departamento" => $dados->id_departamento,
            "id_orgao" => $dados->id_orgao
        ]);

        return redirect()->back()->with('message', 'Fundação atualizada com sucesso!');
    }
}
