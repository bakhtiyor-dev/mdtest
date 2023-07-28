<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class AnswersTypeRightOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'answers' => [
                ['id' => 1, 'answer' => $this->faker->sentence()],
                ['id' => 2, 'answer' => $this->faker->sentence()],
                ['id' => 3, 'answer' => $this->faker->sentence()],
                ['id' => 4, 'answer' => $this->faker->sentence()],
            ],
            'correct_order' => Arr::shuffle([1, 2, 3, 4]),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime()
        ];
    }
}
