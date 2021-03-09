<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelgeModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('belge_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ad');
            $table->string('image')->nullable();
            $table->tinyInteger('hatirlatma');
            $table->date('gecerlilik');
            $table->tinyInteger('durum')->default(1);
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
        Schema::dropIfExists('belge_models');
    }
}
