<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['code' => 'en', 'name' => 'English'],
            ['code' => 'uz', 'name' => 'Uzbek'],
            ['code' => 'ru', 'name' => 'Russian'],
        ];

        foreach ($languages as $language) {
            \App\Models\Language::create($language);
        }
    }
}
