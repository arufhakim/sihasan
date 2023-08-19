<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBagianTenderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bagian_tender', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tender_id')->unsigned();
            $table->unsignedBigInteger('bagian_id')->unsigned();
            $table->foreign('tender_id')->references('id')->on('tender');
            $table->foreign('bagian_id')->references('id')->on('bagian');
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
        Schema::dropIfExists('bagian_tender');
    }
}
