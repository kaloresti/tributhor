<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SituacaoCadastral extends Model
{
    protected $table = "situacao_cadastral";

    static function rules()
    {
        return [
            'id_situacao_cadastral' => 'required',
        ];
    }
}
