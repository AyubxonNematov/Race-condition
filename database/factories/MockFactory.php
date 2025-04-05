<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mock;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mock>
 */
class MockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mock::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed> 
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
        ];
    }
}
