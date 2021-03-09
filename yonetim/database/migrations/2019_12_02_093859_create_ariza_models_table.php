<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArizaModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ariza_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('asansor_id');
            $table->boolean('icindebiri')->nullable();
            $table->boolean('fotosel')->nullable();
            $table->boolean('lamba')->nullable();
            $table->boolean('calismiyor')->nullable();
            $table->boolean('sesgeliyor')->nullable();
            $table->boolean('kapisurtme')->nullable();
            $table->text('disinda')->nullable();
            $table->text('ariza_not')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('buyuk_ariza')->nullable();
            $table->tinyInteger('durum')->nullable()->default(1);
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
        Schema::dropIfExists('ariza_models');
    }
}
