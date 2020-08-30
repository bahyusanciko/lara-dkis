<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->foreign('nip')->references('nip')->on('users')->onDelete('cascade');
            $table->unsignedTinyInteger('id_aplikasi');
            $table->foreign('id_aplikasi')->references('id_aplikasi')->on('aplikasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user__details');
    }
}
