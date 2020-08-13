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
            $table->string('nama_lengkap', 30);
            $table->string('password', 100);
            $table->string('email', 30)->unique();
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


        Schema::create('nilai_plagiatisme', function(Blueprint $table) {
            $table->increments('id_plagiatisme');

            $table->integer('id_mahasiswa')->unsigned();
            $table->foreign('id_mahasiswa')
                  ->references('id_mahasiswa')
                  ->on('mahasiswa')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->enum('bab', ['BAB 1','BAB 2','BAB 3','BAB 4','BAB 5','ALL BAB']);
           
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
        Schema::dropIfExists('nilai_plagiatisme');
        Schema::dropIfExists('mahasiswa');
    }
}
