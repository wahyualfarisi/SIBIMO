<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilBimbinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_bimbingan', function (Blueprint $table) {
            $table->increments('id_hasil_bimbingan');

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

            $table->text('permasalahan');
            $table->enum('revisi', ['YA','TIDAK']);
            $table->enum('acc', ['YA','TIDAK']);

            $table->text('paraf');
            
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
        Schema::dropIfExists('hasil_bimbingan');
    }
}
