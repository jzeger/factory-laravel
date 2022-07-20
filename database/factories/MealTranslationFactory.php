<?php

namespace Database\Factories;

use App\Models\MealTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class MealTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MealTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(6, true),
        ];
    }
}
