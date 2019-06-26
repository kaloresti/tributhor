<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SituacaoCadastralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('situacao_cadastral')->insert([
            ['nome' => 'ativo'], 
            ['nome' => 'homologacao'],
            ['nome' => 'inativo'],
        ]);
    }
}
