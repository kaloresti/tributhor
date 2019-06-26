<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SituacaoFuncionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('situacao_funcional')->insert([
            ['nome' => 'ativo'], 
            ['nome' => 'férias'],
            ['nome' => 'licença'],
            ['nome' => 'demitido'],
            ['nome' => 'afastado'],
            ['nome' => 'exonerado'],
        ]);
    }
}
