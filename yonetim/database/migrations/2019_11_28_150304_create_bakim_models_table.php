<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBakimModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bakim_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('asansor_id');
            $table->boolean('yag')->nullable();
            $table->boolean('makina')->nullable();
            $table->boolean('kabin')->nullable();
            $table->boolean('pano')->nullable();
            $table->boolean('kuyu')->nullable();
            $table->text('ekstra')->nullable();
            $table->text('images')->nullable();
            $table->integer('user_id');
            $table->string('fatura_no')->nullable();
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
        Schema::dropIfExists('bakim_models');
    }
}
