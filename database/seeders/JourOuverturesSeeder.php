<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JourOuverturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Chemin vers votre fichier CSV
        $csvFile = base_path('database/seeders/csv/jour_ouvertures.csv');

        // Lire le contenu du fichier CSV
        $lines = file($csvFile);

        // Ignorer la première ligne si elle contient les en-têtes
        unset($lines[0]);

        // Insérer les données dans la table jour_ouvertures
        foreach ($lines as $line) {
            // Diviser la ligne en utilisant le point-virgule comme délimiteur
            $data = explode(';', $line);

            // Insérer les données seulement si le nombre de valeurs est correct
            if (count($data) >= 8) {
                DB::table('jour_ouvertures')->insert([
                    'id_succ' => $data[0],
                    'ouv_1' => $data[1],
                    'ouv_2' => $data[2],
                    'ouv_3' => $data[3],
                    'ouv_4' => $data[4],
                    'ouv_5' => $data[5],
                    'ouv_6' => $data[6],
                    'ouv_7' => $data[7],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
