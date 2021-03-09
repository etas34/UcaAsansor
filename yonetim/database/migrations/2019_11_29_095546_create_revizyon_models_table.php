<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevizyonModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revizyon_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('asansor_id');
            $table->integer('teklif_id')->nullable();
            $table->text('ekstra')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('pdf')->nullable();
            $table->date('tarih')->nullable();
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
        Schema::dropIfExists('revizyon_models');
    }
}
