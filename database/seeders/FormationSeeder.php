<?php

namespace Database\Seeders;

use App\Models\Formation;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Formation::factory()->count(5)->create();
    }
}
