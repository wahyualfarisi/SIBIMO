<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaprodiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaprodi', function (Blueprint $table) {
            $table->increments('id_kaprodi');

            //foreign on acccont
            $table->integer('id_account')->unsigned();
            $table->foreign('id_account')
                  ->references('id_account')
                  ->on('account')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            $table->integer('id_jurusan')->unsigned();
            $table->foreign('id_jurusan')
                  ->references('id_jurusan')
                  ->on('jurusan')
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
        Schema::dropIfExists('kaprodi');
    }
}
