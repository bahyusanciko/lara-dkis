<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminAktifitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_aktifitas', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->foreign('nip')->references('nip')->on('admins')->onDelete('cascade');
            $table->string('nama');
            $table->string('aktifitas');
            $table->string('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_aktifitas');
    }
}
