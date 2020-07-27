<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriBimbinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bab', function (Blueprint $table) {
            $table->increments('id_bab');

            $table->integer('id_mahasiswa')->unsigned();
            $table->foreign('id_mahasiswa')
                  ->references('id_mahasiswa')
                  ->on('mahasiswa')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->string('nama_bab', 10);
            $table->enum('status', ['progress', 'selesai'])->default('progress');
            $table->timestamps();
        });

        Schema::create('plagiatisme', function(Blueprint $table) {
            $table->increments('id_plagiatisme');

            $table->integer('id_bab')->unsigned();
            $table->foreign('id_bab')
                  ->references('id_bab')
                  ->on('bab')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
           
            $table->string('nilai_plagiatisme', 25);
            $table->text('foto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plagiatisme');
        Schema::dropIfExists('bab');
    }
}
