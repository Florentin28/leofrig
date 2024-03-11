<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeLocalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_local', function (Blueprint $table) {
            $table->id(); // Colonne id auto-incrémentée
            $table->string('desc'); // Colonne pour la description
            $table->integer('T_min'); // Colonne pour la température minimale
            $table->integer('T_max'); // Colonne pour la température maximale
            $table->boolean('sw_hum'); // Colonne pour l'indicateur d'humidité activée
            $table->integer('H_min'); // Colonne pour l'humidité minimale
            $table->integer('H_max'); // Colonne pour l'humidité maximale
            $table->timestamps(); // Colonnes pour les timestamps created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_local');
    }
}
