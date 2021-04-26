<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PetsUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_pet')->nullable();
            $table->string('age')->nullable();
            $table->string('weight')->nullable();
            $table->string('breed')->nullable();
            $table->string('sex_pet')->nullable();
            $table->longText('pet_picture')->nullable();
            $table->integer('id_user')->nullable();
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
        Schema::dropIfExists('pets_user');
    }
}
