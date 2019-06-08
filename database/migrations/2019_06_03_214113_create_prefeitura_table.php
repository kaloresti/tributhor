<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrefeituraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefeitura', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_endereco');
            $table->integer('id_prefeitura_estilo');
            $table->string('nome');
            $table->string('sigla');
            $table->string('situacao');
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
        Schema::dropIfExists('prefeitura');
    }
}
