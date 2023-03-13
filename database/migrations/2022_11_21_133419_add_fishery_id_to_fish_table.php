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
            $table->unsignedBigInteger('fishery_id');
            $table->foreign('fishery_id')->references('id')->on('fisheries')->onUpdate('cascade')->onDelete('restrict');
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
            $table->dropForeign(['fishery_id']);
            $table->dropColumn('fishery_id');
        });
    }
};
