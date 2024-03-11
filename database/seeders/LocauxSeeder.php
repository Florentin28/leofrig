<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class LocauxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Chemin vers votre fichier CSV
        $csvFile = base_path('database/seeders/csv/locaux.csv');

        // Lire le contenu du fichier CSV
        $lines = file($csvFile);

        // Ignorer la première ligne si elle contient les en-têtes
        unset($lines[0]);

        // Insérer les données dans la table locaux
        foreach ($lines as $line) {
            // Diviser la ligne en utilisant le point-virgule comme délimiteur
            $data = explode(';', $line);

            // Insérer les données seulement si le nombre de valeurs est correct
            if (count($data) >= 5) {
                DB::table('locaux')->insert([
                    'id' => $data[0],
                    'id_succ' => $data[1],
                    'id_typelocal' => $data[2],
                    'description' => $data[3],
                    'sw_actif' => $data[4],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
