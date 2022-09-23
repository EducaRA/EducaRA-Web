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
        Schema::create('augumented_objects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('size');
            $table->string9('extension');
            $table->string('url_download');

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
        Schema::dropIfExists('augumented_objects');
    }
};
