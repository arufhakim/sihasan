<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender', function (Blueprint $table) {
            $table->id();
            $table->string('no_pr');
            $table->string('tender');
            $table->datetime('periode_awal');
            $table->datetime('periode_akhir');
            $table->mediumText('keterangan')->nullable();
            $table->string('oleh', 100)->nullable();
            $table->string('slug');
            $table->timestamps('deleted_at');
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
        Schema::dropIfExists('tender');
    }
}
