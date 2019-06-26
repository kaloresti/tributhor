<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    protected $table = "servidor";

    protected $fillable = [
        "id_pessoa_fisica",
        "email",
        "matricula",
        "grau_escolaridade",
        "id_user",
    ];

    static function rules()
    {
        return [
            'matricula' => 'required',
            'email' => 'required',
            'senha' => 'required|min:10',
            /* 'nascido_em' => 'required',
            'sexo' => 'required', */
        ];
    }
}
