<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBimbinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bimbingan', function (Blueprint $table) {
            $table->increments('id_bimbingan');

            $table->integer('id_mahasiswa')->unsigned();
            $table->foreign('id_mahasiswa')
                  ->references('id_mahasiswa')
                  ->on('mahasiswa')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');


            $table->integer('id_kategori_bimbingan')->unsigned();
            $table->foreign('id_kategori_bimbingan')
                  ->references('id_kategori_bimbingan')
                  ->on('kategori_bimbingan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('id_pembimbing')->unsigned();
            $table->foreign('id_pembimbing')
                  ->references('id_pembimbing')
                  ->on('pembimbing')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->date('tanggal_bimbingan');
            $table->text('deskripsi_bimbingan');
            $table->text('file');
            $table->enum('status', ['progress','seleseai'])->default('progress');

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
        Schema::dropIfExists('bimbingan');
    }
}
