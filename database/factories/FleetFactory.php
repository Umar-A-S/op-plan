<?php

namespace Database\Factories;

use App\Models\Fleet;
use Illuminate\Database\Eloquent\Factories\Factory;

class FleetFactory extends Factory
{
    protected $model = Fleet::class;

    public function definition(): array
    {
        $fleetNames = [
            'Express Logistics',
            'Raindrop Delivery',
            'Skyway Transport',
            'Precision Logistics',
            'Metro Courier',
            'Swift Delivery',
            'Urban Logistics',
            'Regional Transport',
            'Premium Shipping',
            'Nationwide Courier',
        ];

        $fleetCodes = ['EXP', 'RDL', 'SKY', 'PRC', 'MET', 'SWF', 'URB', 'RGN', 'PRM', 'NTW'];

        $index = array_rand($fleetNames);
        $name = $fleetNames[$index];
        $code = $fleetCodes[$index] . '-' . strtoupper($this->faker->bothify('###'));

        return [
            'name' => $name,
            'code' => $code,
            'total_vehicles' => $this->faker->numberBetween(5, 50),
            'status' => $this->faker->randomElement(['active', 'active', 'active', 'inactive']),
            'description' => $this->faker->text(100),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'inactive',
        ]);
    }
}
