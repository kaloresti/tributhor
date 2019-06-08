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
                        ->join("prefeitura_estilo", "prefeitura.id_prefeitura_estilo", "=", "prefeitura_estilo.id")
                        ->join("brasao", "prefeitura_estilo.id_brasao", "=", "brasao.id")
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
        $criticaEndereco = Validator::make($request->all(), Endereco::rules())->validate();
        $criticaPrefeituraEstilo = Validator::make($request->all(), PrefeituraEstilo::rules())->validate();
       
        $dados = (Object) $request->all();

        // -- brasao
        $brasao = Brasao::create([
            'nome' => uniqid(date('HisYmd')).'.'.$dados->brasao->extension(),
            'diretorio' => 'brasoes',
            'extensao' => $dados->brasao->extension(),
            'tamanho' => $dados->brasao->getSize(),
        ]);
        $request->brasao->storeAs('brasoes', uniqid(date('HisYmd')).'.'.$dados->brasao->extension());
        
        // -- estilo da prefeitura
        $prefeitura_estilo = PrefeituraEstilo::create([
            "id_brasao" => $brasao->id,
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
            $createSecretaria = Secretaria::create([
                "nome" => $secretaria['nome'],
                "sigla" => $secretaria['sigla'],
                "id_endereco" => $endereco->id,
                "id_prefeitura" => $prefeitura->id
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
    }

    public function show($id_prefeitura)
    {
        $prefeitura = DB::table("prefeitura")
                        ->join("prefeitura_estilo", "prefeitura.id_prefeitura_estilo", "=", "prefeitura_estilo.id")
                        ->join("brasao", "prefeitura_estilo.id_brasao", "=", "brasao.id")
                        ->join("endereco", "endereco.id", "=", "prefeitura.id_endereco")
                        ->select("prefeitura.*", "endereco.uf","endereco.cep" ,"endereco.ibge","endereco.bairro","endereco.logradouro", "endereco.localidade", "brasao.nome as arquivo", "brasao.diretorio", "brasao.extensao")
                        ->where("prefeitura.id", "=", $id_prefeitura)
                        ->get()[0];

        $secretarias = Secretaria::where("id_prefeitura", $prefeitura->id)->get();

        return view('app/prefeituras/show', compact('prefeitura', 'secretarias'));

    }
}
