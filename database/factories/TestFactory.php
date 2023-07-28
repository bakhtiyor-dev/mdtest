<?php

namespace Database\Factories;

use App\Enums\AnswerType;
use App\Models\Department;
use App\Models\TestCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $answersType = Arr::random([
            AnswerType::RIGHT_ORDER,
            AnswerType::MULTIPLE_CHOICE,
            AnswerType::SINGLE_CHOICE,
            AnswerType::TEXT_INPUT
        ]);

        return [
            'body' => $this->faker->text(),
            'answers_type' => $answersType,
            'answers_id' => $answersType::factory(),
            'status' => $this->faker->boolean(),
            'category_id' => TestCategory::inRandomOrder()->first()->id,
            'explanation' => $this->faker->sentence(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
