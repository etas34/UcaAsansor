<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cari_unvan');
            $table->string('adres')->nullable();
            $table->string('telefon')->nullable();
            $table->string('ilgili_kisi')->nullable();
            $table->decimal('alacak_bakiye',8,2)->default(0);
            $table->decimal('borc_bakiye',8,2)->default(0);
            $table->string('vergi_dairesi')->nullable();
            $table->string('vergi_numarasi')->nullable();
            $table->date('sozlesme_tarih')->nullable();
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
        Schema::dropIfExists('caris');
    }
}
