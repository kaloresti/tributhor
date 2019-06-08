<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orgao extends Model
{
    protected $table = "orgao";

    protected $fillable = [
        "id_secretaria",
        "id_prefeitura",
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
