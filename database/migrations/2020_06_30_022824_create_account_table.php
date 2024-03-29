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
            $table->string('nip', 30)->unique();
            $table->string('email', 35)->unique();
            $table->string('nama_lengkap', 50);
            $table->string('password', 150);
            $table->string('no_telp', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->text('foto')->nullable();
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
