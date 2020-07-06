<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDospemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dospem', function (Blueprint $table) {
            $table->increments('id_dospem');

            //foreign key on account
            $table->integer('id_account')->unsigned();
            $table->foreign('id_account')
                  ->references('id_account')
                  ->on('account')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->enum('pembimbing', [1, 2]);
            
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
        Schema::dropIfExists('dospem');
    }
}
