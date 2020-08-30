<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanSubdomainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_subdomain', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laporan_id'); 
            $table->foreign('laporan_id')->references('id')->on('laporan')->onDelete('cascade');
            $table->string('email_domain');
            $table->string('surat_pengajuan');
            $table->string('surat_tugas');
            $table->string('surat_kpe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_subdomain');
    }
}
