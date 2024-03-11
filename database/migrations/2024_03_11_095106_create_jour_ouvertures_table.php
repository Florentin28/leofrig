<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourOuverturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jour_ouvertures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_succ')->constrained('succursales');
            $table->tinyInteger('ouv_1')->nullable();
            $table->tinyInteger('ouv_2')->nullable();
            $table->tinyInteger('ouv_3')->nullable();
            $table->tinyInteger('ouv_4')->nullable();
            $table->tinyInteger('ouv_5')->nullable();
            $table->tinyInteger('ouv_6')->nullable();
            $table->tinyInteger('ouv_7')->nullable();
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
        Schema::dropIfExists('jour_ouvertures');
    }
}
