<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interval>
 */
final class IntervalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->numberBetween(int1: 0, int2: 100000);
        $end = fake()->boolean(chanceOfGettingTrue: 80) 
            ? $start + fake()->numberBetween(int1: 1, int2: 1000) 
            : null;

        return [
            'start' => $start,
            'end' => $end,
        ];
    }
}
