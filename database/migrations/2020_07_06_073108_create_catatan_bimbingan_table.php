<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatatanBimbinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catatan_bimbingan', function (Blueprint $table) {
            $table->increments('id_catatan_bimbingan');

            $table->string('id_bimbingan', 50);
            $table->foreign('id_bimbingan')
                ->references('id_bimbingan')
                ->on('bimbingan')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->text('file')->nullable();
            $table->text('catatan');

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
        Schema::dropIfExists('catatan_bimbingan');
    }
}
