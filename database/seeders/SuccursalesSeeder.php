<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuccursalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Chemin vers votre fichier CSV
        $csvFile = base_path('database/seeders/csv/succursales.csv');

        // Lire le contenu du fichier CSV
        $lines = file($csvFile);

        // Ignorer la première ligne si elle contient les en-têtes
        unset($lines[0]);

        // Insérer les données dans la table succursales
        foreach ($lines as $line) {
            // Diviser la ligne en utilisant le point-virgule comme délimiteur
            $data = explode(';', $line);

            // Insérer les données seulement si le nombre de valeurs est correct
            if (count($data) >= 9) {
                DB::table('succursales')->insert([
                    'id' => $data[0],
                    'Nom' => $data[1],
                    'Pays' => $data[2],
                    'email' => $data[3],
                    'langue' => $data[4],
                    'motpasse' => $data[5],
                    'sw_actif' => $data[6],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
