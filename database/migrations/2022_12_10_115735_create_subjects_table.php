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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();
            $table->foreign('school_id')->references('id')->on('schools')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('teatcher_id')->nullable();
            $table->foreign('teatcher_id')->references('id')->on('teatchers')->cascadeOnDelete()->cascadeOnUpdate();

            // $table->unsignedBigInteger('quiz_id');
            // $table->foreign('quiz_id')->references('id')->on('quizs')->cascadeOnDelete()->cascadeOnUpdate()->nullable();

            $table->string('name');
            $table->integer('level');
            $table->boolean('selection')->nullable();
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
        Schema::dropIfExists('subjects');
    }
};
