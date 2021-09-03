<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        $timeCarbon = $time->isoFormat('HH:mm');


        DB::table('prayers')->insert([
            'name' => 'Shalat Subuh',
            'description' => "Tadarus Al-Qur'qn, beramal",
            'children_id' => 1,
            'common_time_id' => 1,
            'created_time' => $timeCarbon,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
