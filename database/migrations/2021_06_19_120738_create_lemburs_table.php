<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLembursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lemburs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->dateTime('hadir')->default(date('Y-m-d'));
            $table->dateTime('pulang')->default(date('Y-m-d'));
            $table->double('lamakerja');
            $table->double('jam');
            $table->double('harga');
            $table->string('status')->default('PENDING');
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('lemburs');
    }
}
