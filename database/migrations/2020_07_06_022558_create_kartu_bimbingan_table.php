<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartuBimbinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_bimbingan', function (Blueprint $table) {
            $table->increments('id_kartu_bimbingan');

            $table->date('diterima_tanggal')->nullable();
            $table->date('diujikan_tanggal')->nullable();
            $table->enum('status',['selesai','proses'])->default('proses');

            $table->integer('id_mahasiswa')->unsigned();
            $table->foreign('id_mahasiswa')
                  ->references('id_mahasiswa')
                  ->on('mahasiswa')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

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
        Schema::dropIfExists('kartu_bimbingan');
    }
}
