<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCariharaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cariharakets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cari_id');
            $table->integer('fatura_id');
            $table->decimal('tutar',8,2);
            $table->tinyInteger('tur');
            $table->date('islem_tarih');
            $table->string('metot');
            $table->string('aciklama')->nullable();
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
        Schema::dropIfExists('cariharakets');
    }
}
