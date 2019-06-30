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
use App\User;
use App\Cargo;
use App\SituacaoFuncional;
use App\SituacaoCadastral;
use App\Perfil;
use App\PessoaFisica;
use App\Servidor;
use App\Alocacao;

class ServidorController extends Controller
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

    public function list($idPrefeitura)
    {
        $prefeitura = DB::table("prefeitura")
            ->leftJoin("prefeitura_estilo", "prefeitura.id_prefeitura_estilo", "=", "prefeitura_estilo.id")
            ->leftJoin("brasao", "prefeitura_estilo.id_brasao", "=", "brasao.id")
            ->join("endereco", "endereco.id", "=", "prefeitura.id_endereco")
            ->select("prefeitura.*", "endereco.uf","endereco.cep" ,"endereco.ibge","endereco.bairro","endereco.logradouro", "endereco.localidade", "brasao.nome as arquivo", "brasao.diretorio", "brasao.extensao")
            ->where("prefeitura.id", "=", $idPrefeitura)
            ->get()[0];

        $servidores = DB::table('servidor')
                    ->join('pessoa_fisica', 'pessoa_fisica.id', 'servidor.id_pessoa_fisica')
                    ->join('alocacao', 'alocacao.id_servidor', 'servidor.id')
                    ->leftJoin('secretaria' , 'secretaria.id', 'alocacao.id_secretaria')
                    ->leftJoin('departamento' , 'departamento.id', 'alocacao.id_departamento')
                    ->leftJoin('orgao' , 'orgao.id', 'alocacao.id_orgao')
                    ->leftJoin('fundacao' , 'fundacao.id', 'alocacao.id_fundacao')
                    ->leftJoin('situacao_funcional' , 'situacao_funcional.id', 'alocacao.id_situacao_funcional')
                    ->leftJoin('situacao_cadastral' , 'situacao_cadastral.id', 'alocacao.id_situacao_cadastral')
                    ->join('cargo' , 'cargo.id', 'alocacao.id_cargo')
                    ->join('perfil' , 'perfil.id', 'alocacao.id_perfil')
                    ->join('endereco', 'pessoa_fisica.id_endereco', 'endereco.id')
                    ->select('pessoa_fisica.nome as servidor',
                             'pessoa_fisica.cpf as cpf',
                             'pessoa_fisica.rg as rg',
                             'pessoa_fisica.nascido_em as nascido_em',
                             'servidor.*',
                             'endereco.*',
                             'cargo.nome as cargo',
                             'perfil.nome as perfil',
                             'secretaria.nome as secretaria',
                             'departamento.nome as departamento',
                             'orgao.nome as orgao',
                             'fundacao.nome as fundacao',
                             'alocacao.*',
                             'situacao_cadastral.nome as situacao_cadastral',
                             'situacao_funcional.nome as situacao_funcional')
                    ->where('alocacao.id_prefeitura', "=", $idPrefeitura)
                    ->get();
        //dd($servidores);
        $departamentos = Departamento::where('id_prefeitura', $idPrefeitura)->get();
        $secretarias = Secretaria::where('id_prefeitura', $idPrefeitura)->get();
        $orgaos = Orgao::where('id_prefeitura', $idPrefeitura)->get();
        $fundacoes = Fundacao::where('id_prefeitura', $idPrefeitura)->get();

        $cargos = Cargo::all();
        $situacoesCadastrais = SituacaoCadastral::all();
        $situacoesFuncionais = SituacaoFuncional::all();
        $perfis = Perfil::all();;

        return view('app/servidores/list', compact('prefeitura', 'servidores', 'fundacoes','secretarias', 'departamentos', 'orgaos', 'cargos', 'situacoesFuncionais', 'situacoesCadastrais', 'perfis'));
    }

    public function store($idPrefeitura, Request $request)
    {
        $dados = (object) $request->all();
        //$criticaPrefeitura = Validator::make($request->all(), Prefeitura::rules())->validate();
        // -- validações
        $criticaPessoaFisica = Validator::make($request->all(), PessoaFisica::rules())->validate();
        $criticaEndereco = Validator::make($request->all(), Endereco::rules())->validate();
        $criticaSituacaoFuncional = Validator::make($request->all(), SituacaoFuncional::rules())->validate();
        $criticaSituacaoCadastral = Validator::make($request->all(), SituacaoCadastral::rules())->validate();

        // critica alocação dupla na prefeitura

        // cpf unico
        $cpfUnico = PessoaFisica::where('cpf', $dados->cpf)->get();
        if(count($cpfUnico) > 0)
        {
            return redirect()->back()->with('message', "CPF já existe em nossa base de dados!");
        } else {
            // email unico
            $emailUnico = User::where('email', $dados->email)->get();
            if(count($emailUnico) > 0)
            {
                return redirect()->back()->with('message', "O email já existe em nossa base de dados, favor escolher outro!");
            } else {
                // e-mails iguais
                if(trim($dados->email) !== trim($dados->email_confirmacao))
                {
                    return redirect()->back()->with('message', "Os e-mails digitados devem ser identicos!");
                } else {
                    // senhas iguais
                    if(trim($dados->senha) !== trim($dados->senha_confirmacao))
                    {
                        return redirect()->back()->with('message', "As senhas devem ser identicas");
                    } else {

                        $createEndereco = Endereco::create([
                            "cep" => $dados->cep,
                            "localidade" => $dados->localidade,
                            "uf" => $dados->uf,
                            "bairro" => $dados->bairro,
                            "logradouro" => $dados->logradouro,
                            "ibge" => $dados->ibge,
                            "numero" => $dados->numero,
                            "complemento" => $dados->complemento
                        ]);

                        $createPessoaFisica = PessoaFisica::create([
                            "nome" => $dados->nome,
                            "rg" => $dados->rg,
                            "cpf" => $dados->cpf,
                            "nascido_em" => $dados->nascido_em,
                            "sexo" => $dados->sexo,
                            "nome_pai" => $dados->nome_pai,
                            "nome_mae" => $dados->nome_mae,
                            "etnia" => $dados->etnia,
                            "id_endereco" => $createEndereco->id,
                        ]);

                        $createUser = User::create([
                            "email" => $dados->email,
                            "password" => bcrypt($dados->senha),
                            "name" => $dados->nome,
                        ]);

                        $createServidor = Servidor::create([
                            "id_pessoa_fisica" => $createPessoaFisica->id,
                            "id_user" => $createUser->id,
                            "email" => $dados->email,
                            "matricula" => $dados->matricula,
                            "grau_escolaridade" => $dados->grau_escolaridade,
                        ]);

                        $createAlocacao = Alocacao::create([
                            "id_secretaria" => $dados->id_secretaria,
                            "id_prefeitura" => $idPrefeitura,
                            "id_orgao" => $dados->id_orgao,
                            "id_fundacao" => $dados->id_fundacao,
                            "id_departamento" => $dados->id_departamento,
                            "id_situacao_funcional" => $dados->id_situacao_funcional,
                            "id_situacao_cadastral" => $dados->id_situacao_cadastral,
                            "id_cargo" => $dados->id_cargo,
                            //"id_funcao" => $dados->id_funcao,
                            "id_servidor" => $createServidor->id,
                            "iniciado_em" => $dados->iniciado_em,
                            //"finalizado_em" => $dados->finalizado_em,
                            "id_perfil" => $dados->id_perfil,
                        ]);
                        return redirect()->back()->with('message', "Servidor cadastrado com sucesso!");

                    }
                }
            } 
        } 
        
        dd($dados);
    }
}
