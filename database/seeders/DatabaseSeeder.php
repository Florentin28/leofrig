<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LocauxSeeder::class);
        $this->call(SuccursalesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TypeLocalSeeder::class);
        $this->call(JourOuverturesSeeder::class);
       // $this->call(RelevesSeeder::class);


    }
}
