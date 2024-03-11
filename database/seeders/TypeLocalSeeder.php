<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TypeLocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Chemin vers votre fichier CSV
        $csvFile = base_path('database/seeders/csv/type_local.csv');

        // Lire le contenu du fichier CSV
        $lines = file($csvFile);

        // Ignorer la première ligne si elle contient les en-têtes
        unset($lines[0]);

        // Insérer les données dans la table type_local
        foreach ($lines as $line) {
            // Diviser la ligne en utilisant le point-virgule comme délimiteur
            $data = explode(';', $line);

            // Insérer les données seulement si le nombre de valeurs est correct
            if (count($data) >= 9) {
                DB::table('type_local')->insert([
                    'id' => $data[0],
                    'desc' => $data[1],
                    'T_min' => $data[2],
                    'T_max' => $data[3],
                    'sw_hum' => $data[4],
                    'H_min' => $data[5],
                    'H_max' => $data[6],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
