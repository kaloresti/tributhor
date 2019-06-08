<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brasao extends Model
{
    protected $table = "brasao";

    protected $fillable = [
        "nome",
        "diretorio",
        "extensao",
        "tamanho",
    ];

    static function rules()
    {
        return [
            'nome' => 'required|unique:brasao',
            'diretorio' => 'required',
            'extensao' => 'required',
            'tamanho' => 'required',
        ];
    }

}
