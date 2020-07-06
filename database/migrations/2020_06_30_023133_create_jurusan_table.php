<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->increments('id_jurusan');

            $table->integer('id_fakultas')->unsigned();
            $table->foreign('id_fakultas')
                  ->references('id_fakultas')
                  ->on('fakultas')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->string('nama_fakultas', 15);
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
        Schema::dropIfExists('jurusan');
    }
}
