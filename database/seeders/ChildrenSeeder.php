<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChildrenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('childrens')->insert([
            'email' => 'default@gmail.com',
            'fullname' => 'Children default',
            'password' => Hash::make("adminintek"),
            'old' => '5',
            'number_child' => '1',
            'graybeard_id' => 942692967
        ]);
    }
}
