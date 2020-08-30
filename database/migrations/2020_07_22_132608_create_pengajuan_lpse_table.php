<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanLpseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_lpse', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laporan_id'); 
            $table->foreign('laporan_id')->references('id')->on('laporan')->onDelete('cascade');
            $table->string('attachment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_lpse');
    }
}
