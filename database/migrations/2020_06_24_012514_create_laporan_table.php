<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->foreign('nip')->references('nip')->on('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('no_hp');
            $table->string('jenis_pengajuan');
            $table->string('tanggal_pengajuan');
            $table->string('status')->default('Terkirim');
            $table->MediumText('feedback')->nullable();
            $table->boolean('is_read')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
