<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        Language::upsert([
            [
                'id' => 1,
                'active' => 1,
                'locale' => 'pt_BR',
                'name' => "Português Brasileiro",
                'code' => 'PT-BR',
                'icon' => '',
            ],
            [
                'id' => 2,
                'active' => 1,
                'locale' => 'en',
                'name' => "English",
                'code' => 'EN',
                'icon' => '',
            ],
        ], ['id']);
    }
}
