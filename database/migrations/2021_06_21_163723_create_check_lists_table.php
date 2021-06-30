<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user');
            $table->integer('id_mobil');
            $table->enum('masker', ['Ada', 'Tidak Ada'])->nullable();
            $table->enum('tisu', ['Ada', 'Tidak Ada'])->nullable();
            $table->enum('box', ['Ada', 'Tidak Ada'])->nullable();
            $table->enum('parfum', ['Ada', 'Tidak Ada'])->nullable();
            $table->enum('sanitizer', ['Ada', 'Tidak Ada'])->nullable();
            $table->enum('washed', ['Ya', 'Tidak'])->nullable();
            $table->longText('keterangan')->nullable();
            $table->longText('photos')->nullable();
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
        Schema::dropIfExists('check_lists');
    }
}
