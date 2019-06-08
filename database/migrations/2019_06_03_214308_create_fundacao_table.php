<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_brasao')->nullable();
            $table->integer('id_secretaria')->nullable();
            $table->integer('id_prefeitura');
            $table->integer('id_departamento')->nullable();
            $table->integer('id_orgao')->nullable();
            $table->string('nome');
            $table->string('sigla');
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
        Schema::dropIfExists('fundacao');
    }
}
