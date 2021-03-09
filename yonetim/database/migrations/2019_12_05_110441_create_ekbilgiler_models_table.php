<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEkbilgilerModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekbilgiler_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('asansor_id');
            $table->string('uretici')->nullable();
            $table->date ('uretim_tarihi')->nullable();
            $table->string('motor_marka')->nullable();
            $table->string('kapi_marka')->nullable();
            $table->string('pano_marka')->nullable();
            $table->integer('kisilik')->nullable();
            $table->tinyInteger('hidrolik')->default(0);
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
        Schema::dropIfExists('ekbilgiler_models');
    }
}
