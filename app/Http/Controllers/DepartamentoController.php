<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Fundacao;
use App\Secretaria;
use App\Prefeitura;
use App\Departamento;
use App\Endereco;
use App\Brasao;

class DepartamentoController extends Controller
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
        Validator::make($request->all(), Departamento::rules())->validate();

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

        $departamento = Departamento::create([
            "nome" => $dados->nome,
            "sigla" => $dados->sigla,
            "id_prefeitura" => $idPrefeitura,
            "id_endereco" => $enderecoCreate->id,
            "id_brasao" => $brasao->id,
            'id_secretaria' => $idSecretaria,
        ]);

        return redirect()->back()->with(
            ['message' => 'Departamento cadastrado com sucesso!'],
            ['tab' => 'departamento']);
    }

    public function show($idPrefeitura, $idDepartamemto)
    {
        $prefeitura = DB::table("prefeitura")
                        ->leftJoin("prefeitura_estilo", "prefeitura.id_prefeitura_estilo", "=", "prefeitura_estilo.id")
                        ->leftJoin("brasao", "prefeitura_estilo.id_brasao", "=", "brasao.id")
                        ->join("endereco", "endereco.id", "=", "prefeitura.id_endereco")
                        ->select("prefeitura.*", "endereco.uf","endereco.cep" ,"endereco.ibge","endereco.bairro","endereco.logradouro", "endereco.localidade", "brasao.nome as arquivo", "brasao.diretorio", "brasao.extensao")
                        ->where("prefeitura.id", "=", $idPrefeitura)
                        ->get()[0];
        
        $secretarias = Secretaria::where("id_prefeitura", $prefeitura->id)->get();
        
        $departamento = DB::table('departamento')
            ->join('prefeitura', 'prefeitura.id', "=", 'departamento.id_prefeitura')
            ->leftJoin('secretaria', 'secretaria.id', "=", 'departamento.id_secretaria')
            ->leftJoin('brasao', 'brasao.id', "=", 'departamento.id_brasao')
            ->select('departamento.*', 'departamento.id as id_departamento', 'departamento.nome as departamento', 'brasao.*', 'brasao.nome as arquivo')
            ->where('departamento.id', $idDepartamemto)
            ->where('prefeitura.id', $idPrefeitura)
            ->get()[0];
        
        $idBrasao = $departamento->id_brasao;

        $endereco = Endereco::where("id", $departamento->id_endereco)->get()[0];

        $servidores = DB::table('servidor')
            ->join('alocacao', 'alocacao.id_servidor', "=", 'servidor.id')
            ->join('cargo', 'alocacao.id_cargo', "=", 'cargo.id')
            ->join('pessoa_fisica', 'pessoa_fisica.id', "=", 'servidor.id_pessoa_fisica')
            ->select('pessoa_fisica.*', 'cargo.nome as cargo')
            ->where('alocacao.id_departamento', $idDepartamemto)
            ->get();

        $fundacoes = Fundacao::where('id_departamento', $idDepartamemto)->get();

        return view('app/departamentos/show', compact('departamento',  'fundacoes', 'servidores','idBrasao','secretarias', 'prefeitura', 'endereco'));
    }

    public function update($idPrefeitura, Request $request)
    {
        Validator::make($request->all(), Departamento::rules())->validate();

        $prefeitura = Prefeitura::where("id", $idPrefeitura)->get()[0]; 
        $dados = (object)$request->all();
       
        $departamento = Departamento::where("id", $dados->id_departamento)->update([
            "nome" => $dados->nome,
            "sigla" => $dados->sigla,
            "id_secretaria" => $dados->id_secretaria
        ]);

        return redirect()->back()->with('message', 'Departamento atualizado com sucesso!');
    }

    public function delete($idPrefeitura, $idDepartamemto)
    {
        Departamento::where("id", $idDepartamemto)->delete();

        return redirect("/prefeituras/".$idPrefeitura.'/organizacao')->with('message', 'Departamento excluída com sucesso!');
    }
}
