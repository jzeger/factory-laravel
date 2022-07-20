<?php

namespace Database\Factories;

use App\Models\TagTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TagTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
        ];
    }
}
