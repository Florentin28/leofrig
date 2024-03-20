<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Chemin vers votre fichier CSV
        $csvFile = base_path('database/seeders/csv/user.csv');

        // Lire le contenu du fichier CSV
        $lines = file($csvFile);

        // Ignorer la première ligne si elle contient les en-têtes
        unset($lines[0]);

        // Insérer les données dans la table des utilisateurs
        foreach ($lines as $line) {
            // Diviser la ligne en utilisant la virgule comme délimiteur
            $data = explode(',', $line);

            // Insérer les données seulement si le nombre de valeurs est correct
            if (count($data) >= 5) {
                $user = new User();
                $user->name = $data[0];
                $user->email = $data[1];
                $user->role = $data[2];
                $user->password = Hash::make($data[3]);
                $user->id_succ = isset($data[4]) ? $data[4] : null;
                $user->email_verified_at = Carbon::now(); // Définir la date actuelle comme email_verified_at
                $user->remember_token = Str::random(10); // Générer un token de rappel aléatoire
                $user->save();
            }
        }
    }
}
