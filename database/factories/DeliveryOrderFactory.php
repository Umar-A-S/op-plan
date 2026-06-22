<?php

namespace Database\Factories;

use App\Models\DeliveryOrder;
use App\Models\Driver;
use App\Models\Fleet;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryOrderFactory extends Factory
{
    protected $model = DeliveryOrder::class;

    public function definition(): array
    {
        $cities = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang',
            'Makassar', 'Palembang', 'Tangerang', 'Bekasi', 'Depok',
        ];

        $districts = [
            'Pusat', 'Utara', 'Selatan', 'Timur', 'Barat',
            'Sentral', 'Pinggiran', 'Industrial', 'Komersial', 'Residensial',
        ];

        $city = $this->faker->randomElement($cities);
        $district = $this->faker->randomElement($districts);

        $statuses = ['pending', 'pending', 'pending', 'assigned', 'assigned', 'in_transit', 'delivered', 'delivered'];

        $status = $this->faker->randomElement($statuses);
        $driverId = null;
        $fleetId = null;

        if (in_array($status, ['assigned', 'in_transit', 'delivered'])) {
            $driver = Driver::inRandomOrder()->first();
            if ($driver) {
                $driverId = $driver->id;
                $fleetId = $driver->fleet_id;
            }
        } else {
            $fleetId = Fleet::inRandomOrder()->first()?->id ?? Fleet::factory();
        }

        $scheduledDate = $this->faker->dateTimeBetween('now', '+7 days');
        $actualDelivery = null;

        if ($status === 'delivered') {
            $actualDelivery = $this->faker->dateTimeBetween($scheduledDate, '+8 days');
        } elseif ($status === 'in_transit') {
            $actualDelivery = null;
        }

        return [
            'do_number' => 'DO-' . strtoupper($this->faker->bothify('????-###-###')),
            'recipient_name' => $this->faker->name(),
            'recipient_phone' => '08' . $this->faker->numerify('##########'),
            'delivery_address' => $this->faker->streetAddress() . ', ' . $district . ', ' . $city,
            'status' => $status,
            'driver_id' => $driverId,
            'fleet_id' => $fleetId,
            'scheduled_delivery' => $scheduledDate,
            'actual_delivery' => $actualDelivery,
            'notes' => $this->faker->optional(0.2)->text(60),
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'driver_id' => null,
            'actual_delivery' => null,
        ]);
    }

    public function assigned(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'assigned',
            'driver_id' => Driver::inRandomOrder()->first()?->id ?? Driver::factory(),
        ]);
    }

    public function inTransit(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_transit',
            'driver_id' => Driver::inRandomOrder()->first()?->id ?? Driver::factory(),
        ]);
    }

    public function delivered(): static
    {
        $scheduled = $this->faker->dateTimeBetween('-7 days', 'now');
        return $this->state(fn (array $attributes) => [
            'status' => 'delivered',
            'driver_id' => Driver::inRandomOrder()->first()?->id ?? Driver::factory(),
            'actual_delivery' => $this->faker->dateTimeBetween($scheduled, 'now'),
        ]);
    }

    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
            'driver_id' => Driver::inRandomOrder()->first()?->id ?? Driver::factory(),
            'actual_delivery' => null,
        ]);
    }
}
