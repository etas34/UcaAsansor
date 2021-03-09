<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcaModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parca_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ariza_id')->nullable();
            $table->integer('bakim_id')->nullable();
            $table->integer('asansor_id');
            $table->text('parca')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('miktar')->nullable();
            $table->string('birim')->nullable();
            $table->string('sekil')->nullable();
            $table->string('fatura_no')->nullable();
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
        Schema::dropIfExists('parca_models');
    }
}
