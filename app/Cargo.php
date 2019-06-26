<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = "cargo";

    protected $fillable = [
        "nome",
        "cbo"
    ];

    static function rules()
    {
        return [
            'nome' => 'required'
        ];
    }
}
