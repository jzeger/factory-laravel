<?php

namespace Database\Factories;

use App\Models\Meal;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class MealTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'meal_id' => Meal::all()->random()->id,
            'tag_id' => Tag::all()->random()->id,
        ];
    }
}
