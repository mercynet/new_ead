<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(CountrySeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(TimezoneSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PermissionsSeeder::class);
    }
}
