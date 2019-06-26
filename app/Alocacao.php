<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alocacao extends Model
{
    protected $table = "alocacao";

    protected $fillable = [
        "id_secretaria",
        "id_prefeitura",
        "id_orgao",
        "id_fundacao",
        "id_departamento",
        "id_situacao_funcional",
        "id_cargo",
        "id_funcao",
        "id_servidor",
        "iniciado_em",
        "finalizado_em",
        "id_situacao_cadastral",
        "id_perfil",
    ];

    public $dates = ["iniciado_em", "finalizado_em"];

    static function rules()
    {
        return [
            'iniciado_em' => 'required'
        ];
    }
}
