<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlocacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alocacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_prefeitura');
            $table->integer('id_cargo');
            $table->integer('id_situacao_funcional');
            $table->integer('id_situacao_cadastral');
            $table->integer('id_perfil');
            $table->integer('id_secretaria')->nullable();
            $table->integer('id_departamento')->nullable();
            $table->integer('id_orgao')->nullable();
            $table->integer('id_fundacao')->nullable();
            $table->date('inaciado_em');
            $table->date('finalizado_em')->nullable();
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
        Schema::dropIfExists('alocacao');
    }
}
