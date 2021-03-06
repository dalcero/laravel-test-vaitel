<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNumberPreferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_preferences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('number_id');
            $table->foreign('number_id')->references('id')->on('numbers')->onDelete('cascade');
            $table->string('name');
            $table->string('value');
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
        Schema::dropIfExists('number_preferences');
    }
}
