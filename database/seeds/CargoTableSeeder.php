<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cargo')->insert([
            ['nome' => 'Diretor', 'cbo' => ''], 
            ['nome' => 'Auxiliar Administrativo', 'cbo' => ''],
            ['nome' => 'Atendente', 'cbo' => ''],
            ['nome' => 'Secretário', 'cbo' => ''],
            ['nome' => 'Prefeito', 'cbo' => ''],
        ]);
    }
}
