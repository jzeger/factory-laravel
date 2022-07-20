<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(5)->create()->each(function($category) {
            foreach (Language::get() as $language) {
                CategoryTranslation::factory()->create([
                    'category_id' => $category->id,
                    'language_id' => $language->id,
                ]);
            }
        });
    }
}
