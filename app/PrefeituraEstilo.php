<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrefeituraEstilo extends Model
{
    protected $table = "prefeitura_estilo";

    protected $fillable = [
        "cor_primaria",
        "cor_secundaria",
        "id_brasao",
    ];

    static function rules()
    {
        return [
            'cor_primaria' => 'required|max:10',
            'cor_secundaria' => 'required|max:10'
        ];
    }
}
