<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RatingSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $settings = json_decode('[{"end": "60", "color": "#ee1111", "start": 0, "comment": "Неудовлетворительно"}, {"end": "80", "color": "#f0ca0f", "start": "60", "comment": "Удовлетворительно"}, {"end": "90", "color": "#08f7cf", "start": "80", "comment": "Хорошо"}, {"end": 100, "color": "#04d744", "start": "90", "comment": "Отлично"}]');

        return [
            'title' => $this->faker->sentence(),
            'settings' => $settings,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
