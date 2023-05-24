<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Timezone;
use Illuminate\Database\Seeder;

class TimezoneSeeder extends Seeder
{
    public function run(): void
    {
        Timezone::upsert([
            [
                'id' => 1,
                'name' => "São Paulo",
                'code' => 'America/Sao_Paulo',
            ],
        ], ['id']);
    }
}
