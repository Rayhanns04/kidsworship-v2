<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('all_assets')->insert([
            [
                'image' => 'IShubuh.png',
                'name' => 'IShubuh'
            ],
            [
                'image' => 'IDzuhur.png',
                'name' => 'IDzuhur'
            ],
            [
                'image' => 'IAshar.png',
                'name' => 'IAshar'
            ],
            [
                'image' => 'IMaghrib.png',
                'name' => 'IMaghrib'
            ],
            [
                'image' => 'IIsya.png',
                'name' => 'IIsya'
            ],
            [
                'image' => 'IDhuha.png',
                'name' => 'IDhuha'
            ]
        ]);
    }
}
