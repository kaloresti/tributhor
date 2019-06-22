<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = "departamento";

    protected $fillable = [
        "id_prefeitura",
        "id_secretaria",
        "id_endereco",
        "nome",
        "id_brasao",
        "sigla",
    ];
    
    static function rules()
    {
        return [
            'nome' => 'required',
            //'id_prefeitura' => 'required',
            'sigla' => 'required',
        ];
    }
}
