<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommonTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('common_times')->insert([
            [
                "name" => 'Shalat Subuh',
                'all_asset_id' => 1,
                'startTime' => "05:00:00",
                'endTime' => '06:00:00',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Shalat Dzuhur',
                'all_asset_id' => 2,
                'startTime' => '12:15:00',
                'endTime' => '14:59:59',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Shalat Ashar',
                'all_asset_id' => 3,
                'startTime' => '15:00:00',
                'endTime' => '17:59:59',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Shalat Maghrib',
                'all_asset_id' => 4,
                'startTime' => '18:15:00',
                'endTime' => '18:59:59',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Shalat Isya',
                'all_asset_id' => 5,
                'startTime' => '19:00:00',
                'endTime' => '23:59:59',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Shalat Dhuha',
                'all_asset_id' => 6,
                'startTime' => '08:00:00',
                'endTime' => '11:59:59',
                'created_at' => Carbon::now()
            ]
            ]);
    }
}
