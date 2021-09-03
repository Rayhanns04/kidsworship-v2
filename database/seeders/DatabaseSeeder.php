<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([UserSeeder::class]);
        $this->call([AllAssetSeeder::class]);
        $this->call([GraybeardSeeder::class]);
        $this->call([CommonTimeSeeder::class]);
        $this->call([ChildrenSeeder::class]);
        $this->call([PrayerSeeder::class]);
    }
}
