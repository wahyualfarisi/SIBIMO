<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->increments('id_account');

            $table->string('nip', 20)->unique();
            $table->string('email', 15)->unique();
            $table->string('nama_lengkap', 20);
            $table->string('password', 150);
            $table->string('no_telp', 15);
            $table->text('alamat');
            $table->text('foto');
            $table->enum('level', ['TU','KAPRODI','DOSEN']);
            
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
        Schema::dropIfExists('account');
    }
}
