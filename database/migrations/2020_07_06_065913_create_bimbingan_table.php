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
            $table->string('id_bimbingan', 32)->primary();

            $table->integer('id_mahasiswa')->unsigned();
            $table->foreign('id_mahasiswa')
                ->references('id_mahasiswa')
                ->on('mahasiswa')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('id_pembimbing')->unsigned();
            $table->foreign('id_pembimbing')
                  ->references('id_pembimbing')
                  ->on('pembimbing')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->enum('bab', ['BAB 1','BAB 2','BAB 3','BAB 4','BAB 5']);
            $table->date('tanggal_bimbingan');
            $table->text('deskripsi_bimbingan');
            $table->text('file');
            $table->enum('status', ['progress','selesai'])->default('progress');

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
