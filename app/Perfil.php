<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = "perfil";

    protected $fillable = [
        "nome"
    ];

    static function rules()
    {
        return [
            'nome' => 'required'
        ];
    }
}
