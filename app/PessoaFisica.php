<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    protected $table = "pessoa_fisica";

    protected $fillable = [
        "nome",
        "rg",
        "cpf",
        "nascido_em",
        "sexo",
        "nome_pai",
        "nome_mae",
        "etnia",
        "id_endereco"
    ];

    static function rules()
    {
        return [
            'nome' => 'required',
            'rg' => 'required',
            'cpf' => 'required',
            'nascido_em' => 'required',
            'sexo' => 'required',
        ];
    }
}
