<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = "endereco";

    protected $fillable = [
        "cep",
        "localidade",
        "uf",
        "bairro",
        "logradouro",
        "tipo_logradouro",
        "ibge",
        "numero",
        "complemento",
        "latitude",
        "longitude",
    ];
    
    static function rules()
    {
        return [
            "cep" => "required",
            "localidade" => "required",
            "uf" => "required",
            "bairro" => "required",
            "logradouro" => "required",
            "numero" => "required",
        ];
    }
}
