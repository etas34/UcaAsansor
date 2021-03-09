<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeklifModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teklif_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('asansor_id');
            $table->date ('tarih')->nullable();
            $table->date ('rapor_tarihi')->nullable();
            $table->string('musteri')->nullable();
            $table->string('musteri_yetkili')->nullable();
            $table->string('musteri_tel')->nullable();
            $table->string('sirket_yetkili')->nullable();
            $table->string('sirket_gorev')->nullable();
            $table->string('sirket_tel')->nullable();
            $table->string('sirket_email')->nullable();
            $table->text('urun')->nullable();
            $table->string('toplam')->nullable();
            $table->string('kdv')->nullable();
            $table->string('gentoplam')->nullable();
            $table->string('pdf')->nullable();
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
        Schema::dropIfExists('teklif_models');
    }
}
