<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'assigned'=>1,
            'title'=>fake()->jobTitle(),
            'description'=>fake()->text(),
            'deadline'=>date('d-m-Y H:i:s',strtotime('dec 20th 2022'))
        ];
    }
}
