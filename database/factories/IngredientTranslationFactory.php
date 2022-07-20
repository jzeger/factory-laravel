<?php

namespace Database\Factories;

use App\Models\IngredientTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IngredientTranslation::class;
    
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
