<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->increments('id_mahasiswa');

            $table->string('nim', 20)->unique();
            $table->string('nama_lengkap', 20);
            $table->string('password', 100);
            $table->string('email', 25)->unique();
            $table->text('foto')->nullable();
            
            $table->integer('id_jurusan')->unsigned();
            $table->foreign('id_jurusan')
                  ->references('id_jurusan')
                  ->on('jurusan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->string('no_telp', 16)->nullable();
            $table->year('angkatan')->nullable();
            
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
        Schema::dropIfExists('mahasiswa');
    }
}
