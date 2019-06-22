<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Brasao;

class BrasaoController extends Controller
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
        $dados = (object)$request->all();

        $nomeArquivo = uniqid(date('HisYmd')).'.'.$dados->brasao->extension();

        $brasao = Brasao::where(
            "id", $dados->id_brasao
        )->update([
            'nome' => $nomeArquivo,
            'extensao' => $dados->brasao->extension(),
            'tamanho' => $dados->brasao->getSize(),
        ]);

        $request->brasao->storeAs('public/brasoes/', $nomeArquivo);

        return redirect()->back();
    }
}
