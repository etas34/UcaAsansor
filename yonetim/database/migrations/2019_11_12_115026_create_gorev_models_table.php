<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGorevModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gorev_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('baslik');
            $table->string('icerik')->nullable();
            $table->integer('sahip_id');
            $table->integer('atanan_id');
            $table->integer('onem_id');
            $table->date ('bas_zaman');
            $table->date ('bitis_zaman')->nullable();
            $table->integer('durum')->default('1');
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
        Schema::dropIfExists('gorev_models');
    }
}
