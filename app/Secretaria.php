<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    protected $table = "secretaria";

    protected $fillable = [
        "id_prefeitura",
        "id_endereco",
        "nome",
        "id_brasao",
        "sigla",
    ];

    static function rules()
    {
        return [
            'nome' => 'required',
            'sigla' => 'required',
        ];
    }

    static function defaults()
    {
        return [
            [
                "nome" => "Secretaria Municipal de Finanças",
                "sigla" => "SEFIN",
                "id_endereco" => 0,
                "id_prefeitura" => 0,
                "departamentos" => [
                    [
                        "nome" => "Departamento de Tributos",
                        "sigla" => "DETRIMUN",
                        "id_endereco" => null,
                        "id_prefeitura" => null,
                        "id_secretaria" => null,
                    ],
                    [
                        "nome" => "Departamento de Tezouraria",
                        "sigla" => "DEPTZ",
                        "id_endereco" => null,
                        "id_prefeitura" => null,
                        "id_secretaria" => null,
                    ]
                ]
            ],
            [
                "nome" => "Secretaria Municipal de Saúde",
                "sigla" => "SEMUSAU",
                "id_endereco" => 0,
                "id_prefeitura" => 0,
                "departamentos" => [],
            ],
        ];
    }
}
