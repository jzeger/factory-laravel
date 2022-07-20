<?php

namespace Database\Seeders;

use App\Models\MealTranslation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LanguageSeeder::class,
            CategorySeeder::class,
            IngredientSeeder::class,
            TagSeeder::class,
            MealSeeder::class,
        ]);
    }
}
