<?php

namespace Database\Factories;

use App\Models\Mock;
use App\Models\MockTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MockTime>
 */
class MockTimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MockTime::class; 

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = fake()->dateTimeBetween('+1 day', '+2 weeks');
        $endTime = (clone $startTime)->modify('+60 minutes');
        
        return [
            'mock_id' => Mock::factory(),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'capacity' => 40,
        ];
    }
}
