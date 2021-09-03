<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GraybeardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('graybeards')->insert([
            'id' => 942692967,
            'email' => 'cookies@gmail.com',
            'fullname' => 'Cookies',
            'password' => bcrypt('adminintek')
            ]);
    }
}
