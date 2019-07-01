<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SituacaoFuncional extends Model
{
    protected $table = "situacao_funcional";
    
    static function rules()
    {
        return [
            'id_situacao_funcional' => 'required',
            'id_cargo' => 'required'
        ];
    }
}
