<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecretariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secretaria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_brasao')->nullable();
            $table->integer('id_endereco');
            $table->integer('id_prefeitura');
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
        Schema::dropIfExists('secretaria');
    }
}
