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

     //creates the table in the database called fishs and it has an id, uuid, user_id, name, description, image and price along with a time stamp of when it was made
    public function up()
    {
        Schema::create('fish', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('user_id')->constrained();
            $table->string('fishType');
            $table->string('discription');
            $table->string('image');
            $table->decimal('price');
            //$table->foreignId('fishery_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

     //this drops the table fishs if it exist already with in the database
    public function down()
    {
        Schema::dropIfExists('fish');
    }
};
