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
        Schema::create('participate', function (Blueprint $table) {
            $table->bigInteger('participant_id')->unsigned();
            $table->bigInteger('room_id')->unsigned();
            $table->primary(['participant_id', 'room_id']);

            $table->foreign('participant_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('rooms');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participate');
    }
};
