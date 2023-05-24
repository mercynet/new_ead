<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        Group::upsert([
            ['id' => 1, 'name' => 'Coordenador', 'created_at' => now(), 'updated_at' => now()]
        ], ['id']);
    }
}
