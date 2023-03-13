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
        Schema::create('fish_basket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fish_id');
            $table->unsignedBigInteger('basket_id');

            $table->foreign('fish_id')->references('id')->on('fish')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('basket_id')->references('id')->on('baskets')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('fish_basket');
    }
};
