<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Organisation;
use App\Models\RatingSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'test_category_count' => [
                ['tests_count' => $this->faker->randomNumber(2), 'test_category_id' => 2]
            ],
            'time' => $this->faker->randomNumber(2),
            'rating_setting_id' => RatingSetting::factory(),
            'department_id' => Department::factory(),
            'organisation_id' => Organisation::factory(),
            'attempts_count' => $this->faker->randomNumber(1),
            'can_complete_untill_all_answered' => $this->faker->boolean(),
            'can_return_to_passed_question' => $this->faker->boolean(),
            'can_skip_question' => $this->faker->boolean(),
            'enable_explanation' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
