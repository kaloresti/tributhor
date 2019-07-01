<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CargoTableSeeder::class);
        $this->call(PerfilTableSeeder::class);
        $this->call(SituacaoCadastralTableSeeder::class);
        $this->call(SituacaoFuncionalTableSeeder::class);
    }
}
