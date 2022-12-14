<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetos_3d', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->string('imagem')->nullable();
            $table->string('filehash')->nullable();
            $table->string('path')->nullable();
            $table->integer('size')->default(0);
            $table->float('escala', 6, 2)->default(0.3);
            $table->uuid('codigo');
            $table->string('extension')->nullable();
            $table->unsignedBigInteger('aula_id');
            $table->foreign('aula_id')->references('id')->on('aulas');
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
        Schema::dropIfExists('objetos_3d');
    }
};
