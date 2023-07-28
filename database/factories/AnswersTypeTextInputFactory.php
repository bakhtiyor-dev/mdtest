<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnswersTypeTextInputFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'correct_answer' => $this->faker->sentence(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime()
        ];
    }
}
