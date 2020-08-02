<?php

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'abbr' => 'en',
            'local' => 'usa',
            'name' => 'english',
            'direction' => 'rtl'
        ]);
        Language::create([
            'abbr' => 'ar',
            'local' => 'egypt',
            'name' => 'arabic',
            'direction' => 'ltr'
        ]);
    }
}
