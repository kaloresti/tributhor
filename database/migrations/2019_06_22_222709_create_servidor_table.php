<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServidorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    
        Schema::create('servidor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_pessoa_fisica');
            $table->string('email');
            $table->string('matricula');
            $table->string('grau_escolaridade');
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
        Schema::dropIfExists('servidor');
    }
}
