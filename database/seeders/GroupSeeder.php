<?php

namespace Database\Seeders;

use App\Models\Users\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        Group::upsert([
            ['id' => 1, 'name' => 'VIP', 'created_at' => now(), 'updated_at' => now()]
        ], ['id']);
    }
}
