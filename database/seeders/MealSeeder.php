<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Models\MealTranslation;
use App\Models\Language;
use App\Models\Tag;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meal::factory(20)->create()->each(function($meal) {
            foreach (Language::get() as $language) {
                MealTranslation::factory()->create([
                    'meal_id' => $meal->id,
                    'language_id' => $language->id,
                ]);
            }
            
            for ($i = 0; $i <= rand(1, Tag::count()); $i++) { 
                $meal->tags()->syncWithoutDetaching(Tag::get()->random()->id);
            }

            for ($i = 0; $i <= rand(1, Ingredient::count()); $i++) { 
                $meal->ingredients()->syncWithoutDetaching(Ingredient::get()->random()->id);
            }
            
        });
    }
}
