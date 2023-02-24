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
        Schema::table('fish', function (Blueprint $table) {
            $table->unsignedBigInteger('basket_id');
            $table->foreign('basket_id')->references('id')->on('baskets')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fish', function (Blueprint $table)
        {
            $table->dropForeign(['basket_id']);
            $table->dropColumn('basket_id');
        });
    }
};
