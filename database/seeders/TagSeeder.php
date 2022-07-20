<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\TagTranslation;
use App\Models\Language;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory(10)->create()->each(function($tag) {
            foreach (Language::get() as $language) {
                TagTranslation::factory()->create([
                    'tag_id' => $tag->id,
                    'language_id' => $language->id,
                ]);
            }
        });
    }
}
