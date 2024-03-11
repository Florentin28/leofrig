<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelevesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('releves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_succ')->constrained('succursales');
            $table->foreignId('id_local')->constrained('locaux');
            $table->dateTime('id_datetime');
            $table->string('id_moment');
            $table->float('releve_temp');
            $table->boolean('tmp_ok');
            $table->float('releve_hum')->nullable();
            $table->boolean('hum_ok')->nullable();
            $table->text('releve_comment')->nullable();
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
        Schema::dropIfExists('releves');
    }
}
