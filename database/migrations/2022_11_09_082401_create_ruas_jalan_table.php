<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuasJalanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruas_jalan', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_ruas');
            $table->string('nama_ruas');
            $table->string('pangkal_ruas');
            $table->string('ujung_ruas');
            $table->string('lingkungan');
            $table->string('kelurahan_id');
            $table->string('kecamatan_id');
            $table->float('panjang');
            $table->float('lebar');
            $table->string('bahu_jalan')->nullable();
            $table->string('perkerasan_id');
            $table->string('kondisi_id');
            $table->string('utilitas')->nullable();
            $table->string('start_x');
            $table->string('start_y');
            $table->string('middle_x');
            $table->string('middle_y');
            $table->string('end_x');
            $table->string('end_y');
            // $table->json('geometry');
            $table->longText('geometry');
            $table->string('image');
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
        Schema::dropIfExists('ruas_jalan');
    }
}
