<?php

namespace Database\Seeders;

use App\Enums\Users\Role;
use App\Models\Users\User;
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
        ], ['id']);
        (User::find(1))->assignRole(Role::development->name);
    }
}
