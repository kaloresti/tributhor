<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrefeituraEstiloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefeitura_estilo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_brasao')->nullable();
            $table->string('cor_primaria');
            $table->string('cor_secundaria');
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
        Schema::dropIfExists('prefeitura_estilo');
    }
}
