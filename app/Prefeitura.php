<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefeitura extends Model
{
    protected $table = "prefeitura";

    protected $fillable = [
        "id_endereco",
        "id_prefeitura_estilo",
        "nome",
        "sigla",
        "situacao", 
    ];
    
    static function rules()
    {
        return [
            'sigla' => 'required',
            'situacao' => 'required',
            "cep" => "required",
            "localidade" => "required",
            "uf" => "required",
            "bairro" => "required",
            "logradouro" => "required",
            "numero" => "required",
            'cor_primaria' => 'required|max:10',
            'cor_secundaria' => 'required|max:10'
            //"nome" => 'required',
        ];
    }
}
