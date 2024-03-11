<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RelevesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('releves')->insert([
            'id_succ' => 3,
            'id_local' => 1,
            'id_datetime' => Carbon::now(),
            'id_moment' => 'Matin',
            'releve_temp' => 20.5,
            'tmp_ok' => true,
            'releve_hum' => 70.0,
            'hum_ok' => true,
            'releve_comment' => 'Température et humidité normales',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
