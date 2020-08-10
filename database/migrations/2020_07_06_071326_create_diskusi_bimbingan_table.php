<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiskusiBimbinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diskusi_bimbingan', function (Blueprint $table) {
            $table->increments('id_diskusi_bimbingan');

            $table->string('id_bimbingan', 50);
            $table->foreign('id_bimbingan')
                  ->references('id_bimbingan')
                  ->on('bimbingan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');


            $table->integer('id_pembimbing')->unsigned();
            $table->foreign('id_pembimbing')
                ->references('id_pembimbing')
                ->on('pembimbing')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->integer('id_mahasiswa')->unsigned();
            $table->foreign('id_mahasiswa')
                    ->references('id_mahasiswa')
                    ->on('mahasiswa')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->text('pesan');
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
        Schema::dropIfExists('diskusi_bimbingan');
    }
}
