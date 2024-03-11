<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuccursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('succursales', function (Blueprint $table) {
            $table->id();
            $table->string('Nom');
            $table->string('Pays');
            $table->string('email');
            $table->string('langue');
            $table->string('motpasse');
            $table->boolean('sw_actif')->default(false); // Par défaut, succursale activée
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
        Schema::dropIfExists('succursales');
    }
}
