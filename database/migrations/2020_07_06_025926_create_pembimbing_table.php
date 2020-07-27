<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembimbingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembimbing', function (Blueprint $table) {
            $table->increments('id_pembimbing');
            
            $table->integer('id_account')->unsigned();
            $table->foreign('id_account')
                  ->references('id_account')
                  ->on('account')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->enum('pembimbing_status', ['','1','2'])->default('');

            $table->integer('id_mahasiswa')->unsigned();
            $table->foreign('id_mahasiswa')
                ->references('id_mahasiswa')
                ->on('mahasiswa')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->text('ttd_pembimbing')->nullable();
            $table->timestamps();
        });

        Schema::create('pengujian_sistem', function(Blueprint $table) {
            $table->increments('id_pengujian');

            $table->date('tanggal');
            $table->text('hasil_pengujian')->nullable();
            $table->enum('status', ['oke','tidak'])->default('oke');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengujian_sistem');
        Schema::dropIfExists('pembimbing');
    }
}
