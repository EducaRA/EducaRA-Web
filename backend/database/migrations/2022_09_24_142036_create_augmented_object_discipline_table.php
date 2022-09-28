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
        Schema::create('augmented_object_discipline', function (Blueprint $table) {
            $table->unsignedBigInteger('augmented_object_id');
            $table->unsignedBigInteger('discipline_id');
            $table->foreign('augmented_object_id')->references('id')->on('augmented_objects');
            $table->foreign('discipline_id')->references('id')->on('disciplines');
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
        Schema::dropIfExists('augmented_object_discipline');
    }
};
