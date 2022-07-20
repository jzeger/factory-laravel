<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\IngredientTranslation;
Use App\Models\Language;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingredient::factory(15)->create()->each(function($ingredient) {
            foreach (Language::get() as $language) {
                IngredientTranslation::factory()->create([
                    'ingredient_id' => $ingredient->id,
                    'language_id' => $language->id,
                ]);
            }
        });
    }
}
