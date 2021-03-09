<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsansorModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asansor_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kimlik');
            $table->string('apartman');
            $table->string('blok')->nullable();
            $table->string('yonetici')->nullable();
            $table->string('yonetici_tel')->nullable();
            $table->string('adres')->nullable();
            $table->date ('aylik_bakim')->nullable();
            $table->date ('etiket_tarihi')->nullable();
            $table->date ('etiket_deg_tarihi')->nullable();
            $table->date ('bu_ay_bakim_tarih')->nullable();
            $table->string('etiket')->nullable()->default('Yeşil');
            $table->string('sozlesme')->nullable()->default('Süresi Var');
            $table->integer('bakimci_id')->nullable();
            $table->integer('revizyoncu_id')->nullable();
            $table->integer('cari_id')->nullable();
            $table->integer('bolge_id')->nullable();
            $table->integer('bakim_ucreti')->nullable();
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
        Schema::dropIfExists('asansor_models');
    }
}
