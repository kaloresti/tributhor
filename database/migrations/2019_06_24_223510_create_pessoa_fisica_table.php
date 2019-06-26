<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoaFisicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_fisica', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_endereco');
            $table->string('nome');
            $table->string('rg');
            $table->string('cpf');
            $table->string('sexo');
            $table->date('nascido_em');
            $table->string('nome_pai')->nullable();
            $table->string('nome_mae')->nullable();
            $table->string('etnia')->nullable();
            $table->string('tel')->nullable();
            $table->string('cel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoa_fisica');
    }
}
