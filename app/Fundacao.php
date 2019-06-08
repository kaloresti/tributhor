<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fundacao extends Model
{
    protected $table = "fundacao";

    protected $fillable = [
        "id_secretaria",
        "id_orgao",
        "id_prefeitura",
        "id_departamento",
        "nome",
        "id_brasao",
        "sigla",
    ];

    public function rules()
    {
        return [
            'nome' => 'required',
            'id_prefeitura' => 'required',
            'sigla' => 'required',
        ];
    }
}
