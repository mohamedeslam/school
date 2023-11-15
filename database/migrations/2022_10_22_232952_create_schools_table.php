<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Constraint\Constraint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate()->nullable();

            $table->string('school_name');
            $table->integer('num_of_teacher')->nullable();
            $table->integer('num_of_students')->nullable();
            $table->string('type_of');
            $table->date('subscription');
            $table->string('phone');
            $table->string('email');
            $table->string('city_address');
            $table->string('town_address');
            $table->string('street_address');
            $table->string('about_school')->nullable();
            $table->string('schoolLogo')->nullable();
            $table->string('supDirSchool');
            $table->boolean('status')->default(false)->nullable();
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
        Schema::dropIfExists('schools');
    }
};
