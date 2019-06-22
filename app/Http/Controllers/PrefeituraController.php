<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Brasao;
use App\PrefeituraEstilo;
use App\Endereco;
use App\Prefeitura;
use App\Secretaria;
use App\Departamento;
use App\Orgao;
use App\Fundacao;

class PrefeituraController extends Controller
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

    /**
     * Abre a view principal de prefeituras
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $prefeituras = DB::table("prefeitura")
                        ->leftJoin("prefeitura_estilo", "prefeitura.id_prefeitura_estilo", "=", "prefeitura_estilo.id")
                        ->leftJoin("brasao", "prefeitura_estilo.id_brasao", "=", "brasao.id")
                        ->join("endereco", "endereco.id", "=", "prefeitura.id_endereco")
                        ->select("prefeitura.*", "endereco.uf","endereco.ibge" ,"brasao.nome as arquivo", "brasao.diretorio", "brasao.extensao")
                        ->get();

        return view('app/prefeituras/index', compact('prefeituras'));
    }

    /**
     * Abre a página de cadastro de prefeituras
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('app/prefeituras/create');
    }

    public function store(Request $request)
    {
        // -- validações
        $criticaPrefeitura = Validator::make($request->all(), Prefeitura::rules())->validate();
        //$criticaEndereco = Validator::make($request->all(), Endereco::rules())->validate();
        //$criticaPrefeituraEstilo = Validator::make($request->all(), PrefeituraEstilo::rules())->validate();
       
        $dados = (Object) $request->all();
        $idBrasao = null;
        // -- brasao
        if(isset($dados->brasao))
        {
            $nomeArquivo = uniqid(date('HisYmd')).'.'.$dados->brasao->extension();
            $brasao = Brasao::create([
                'nome' => $nomeArquivo,
                'diretorio' => 'brasoes',
                'extensao' => $dados->brasao->extension(),
                'tamanho' => $dados->brasao->getSize(),
            ]);
            $idBrasao = $brasao->id;
            $request->brasao->storeAs('public/brasoes/', $nomeArquivo);
        }
        
        
        // -- estilo da prefeitura
        $prefeitura_estilo = PrefeituraEstilo::create([
            "id_brasao" => $idBrasao,
            "cor_primaria" => $dados->cor_primaria,
            "cor_secundaria" => $dados->cor_secundaria
        ]);
        
        // -- endereço
        $endereco = Endereco::create([
            "cep" => $dados->cep,
            "localidade" => $dados->localidade,
            "uf" => $dados->uf,
            "bairro" => $dados->bairro,
            "logradouro" => $dados->logradouro,
            "ibge" => $dados->ibge,
            "numero" => $dados->numero,
            "complemento" => $dados->complemento
        ]);
        
        // -- prefeitura
        $prefeitura = Prefeitura::create([
            "id_endereco" => $endereco->id,   // -- variavel de retorno da gravação de endereco
            "id_prefeitura_estilo" => $prefeitura_estilo->id,
            "nome" => 'Prefeitura Municipal de '.$dados->localidade,
            "sigla" => $dados->sigla,
            "situacao" => $dados->situacao
        ]);

        // -- dados complementares (inclusão de secretarias e departamentos padrões)
        foreach (Secretaria::defaults() as $secretaria)
        {
            $secretaria['id_prefeitura'] = $prefeitura->id;
            
            $brasao_secretaria = Brasao::create([
                "nome" => "no-image.png",
                "extensao" => "png",
                "diretorio" => "brasoes",
                "tamanho" => "0"
            ]);

            $endereco_secretaria = Endereco::create([
                "cep" => $dados->cep,
                "localidade" => $dados->localidade,
                "uf" => $dados->uf,
                "bairro" => $dados->bairro,
                "logradouro" => $dados->logradouro,
                "ibge" => $dados->ibge,
                "numero" => $dados->numero,
                "complemento" => $dados->complemento
            ]);

            $createSecretaria = Secretaria::create([
                "nome" => $secretaria['nome'],
                "sigla" => $secretaria['sigla'],
                "id_endereco" => $endereco_secretaria->id,
                "id_prefeitura" => $prefeitura->id,
                "id_brasao" => $brasao_secretaria->id
            ]);
        
            if (count($secretaria['departamentos']) > 0)
            {
                foreach ($secretaria['departamentos'] as $departamento)
                {
                    Departamento::create([
                        "nome" => $departamento['nome'],
                        "sigla" => $departamento['sigla'],
                        "id_prefeitura" => $prefeitura->id,
                        "id_endereco" => $endereco->id,
                        "id_secretaria" => $createSecretaria->id
                    ]);
                }
            }
        }

        return redirect()->back()->with('message', $prefeitura->nome.' cadastrada com sucesso!');
    }

    public function show($id_prefeitura)
    {
        $classSituacao = 'danger';
        
        $prefeitura = DB::table("prefeitura")
                        ->leftJoin("prefeitura_estilo", "prefeitura.id_prefeitura_estilo", "=", "prefeitura_estilo.id")
                        ->leftJoin("brasao", "prefeitura_estilo.id_brasao", "=", "brasao.id")
                        ->join("endereco", "endereco.id", "=", "prefeitura.id_endereco")
                        ->select("prefeitura.*", "endereco.uf","endereco.cep" ,"endereco.ibge","endereco.bairro","endereco.logradouro", "endereco.localidade", "brasao.nome as arquivo", "brasao.diretorio", "brasao.extensao")
                        ->where("prefeitura.id", "=", $id_prefeitura)
                        ->get()[0];

        $secretarias = Secretaria::where("id_prefeitura", $prefeitura->id)->get();
        
        if($prefeitura->situacao == 'homologacao')
            $classSituacao = "warning";
        
        

        return view('app/prefeituras/show', compact('prefeitura', 'secretarias', 'classSituacao'));

    }

    public function organizacao($id_prefeitura)
    {
        $prefeitura = DB::table("prefeitura")
                        ->leftJoin("prefeitura_estilo", "prefeitura.id_prefeitura_estilo", "=", "prefeitura_estilo.id")
                        ->leftJoin("brasao", "prefeitura_estilo.id_brasao", "=", "brasao.id")
                        ->join("endereco", "endereco.id", "=", "prefeitura.id_endereco")
                        ->select("prefeitura.*", "endereco.uf","endereco.cep" ,"endereco.ibge","endereco.bairro","endereco.logradouro", "endereco.localidade", "brasao.nome as arquivo", "brasao.diretorio", "brasao.extensao")
                        ->where("prefeitura.id", "=", $id_prefeitura)
                        ->get()[0];

        
        $secretarias = Secretaria::where("id_prefeitura", $prefeitura->id)->get();
        
        $departamentos = DB::table("departamento")
                    ->leftJoin("secretaria", "secretaria.id", "=", "departamento.id_secretaria")
                    ->join("prefeitura", "prefeitura.id", "=", "departamento.id_prefeitura")
                    ->select("departamento.nome as departamento",
                            "departamento.id as id_departamento",
                             "departamento.sigla as sigla_departamento", 
                             "secretaria.nome as secretaria")
                    ->where("prefeitura.id", "=", $id_prefeitura)
                    ->get();

        $orgaos = DB::table("orgao")
                    ->leftJoin("secretaria", "secretaria.id", "=", "orgao.id_secretaria")
                    ->join("prefeitura", "prefeitura.id", "=", "orgao.id_prefeitura")
                    ->select("orgao.nome as orgao",
                            "orgao.id as id_orgao",
                                "orgao.sigla as sigla_orgao", 
                                "secretaria.nome as secretaria")
                    ->where("prefeitura.id", "=", $id_prefeitura)
                    ->get();
        
        $fundacoes = DB::table("fundacao")
                    ->leftJoin("secretaria", "secretaria.id", "=", "fundacao.id_secretaria")
                    ->leftJoin("departamento", "departamento.id", "=", "fundacao.id_departamento")
                    ->leftJoin("orgao", "orgao.id", "=", "fundacao.id_orgao")
                    ->join("prefeitura", "prefeitura.id", "=", "fundacao.id_prefeitura")
                    ->select("fundacao.nome as fundacao",
                            "fundacao.id as id_fundacao",
                                "fundacao.sigla as sigla_fundacao", 
                                "secretaria.nome as secretaria",
                                "departamento.nome as departamento",
                                "orgao.nome as orgao")
                    ->where("prefeitura.id", "=", $id_prefeitura)
                    ->get();
        
        
        return view('app/organizacao/index', compact('prefeitura', 'secretarias', 'departamentos', 'orgaos', 'fundacoes'));

    }
}
