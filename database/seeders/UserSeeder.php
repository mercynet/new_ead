<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Timezone;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::upsert([
            [
                'id' => 1,
                'name' => 'Development',
                'email' => 'development@craftsys.com.br',
                'password' => Hash::make('Craft132!@#'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Admin user',
                'email' => 'admin@example.com',
                'password' => Hash::make('Admin132!@#'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id']);
    }
}
