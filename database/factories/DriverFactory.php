<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Fleet;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    protected $model = Driver::class;

    public function definition(): array
    {
        $indonesianNames = [
            'Budi Santoso', 'Ahmad Hidayat', 'Rini Suryanto', 'Dedi Gunawan', 'Siti Nurhaliza',
            'Agus Prasetyo', 'Dwi Handoko', 'Eka Putri', 'Fajar Kusuma', 'Gilang Ramadhan',
            'Hendra Wijaya', 'Ika Wijayanti', 'Joko Santoso', 'Krisna Wijaya', 'Lina Kusuma',
            'Maman Suryaman', 'Nani Kusumah', 'Onggo Wijaya', 'Pardi Santoso', 'Quarani Kusuma',
            'Rahmat Hidayat', 'Suryanto Wijaya', 'Taufik Rahman', 'Usman Harahap', 'Vina Kusuma',
            'Wawan Gunawan', 'Xenia Wijaya', 'Yoga Pratama', 'Zaki Maulana', 'Bambang Setiawan',
        ];

        return [
            'name' => $this->faker->randomElement($indonesianNames),
            'phone' => '08' . $this->faker->numerify('##########'),
            'license_number' => $this->faker->bothify('???-####-??'),
            'license_expiry' => $this->faker->dateTimeBetween('+1 day', '+5 years')->format('Y-m-d'),
            'status' => 'available',
            'rating' => $this->faker->randomFloat(2, 3.5, 5.0),
            'fleet_id' => Fleet::inRandomOrder()->first()?->id ?? Fleet::factory(),
            'notes' => $this->faker->optional(0.3)->text(50),
        ];
    }

    public function available(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'available',
        ]);
    }

    public function assigned(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'assigned',
        ]);
    }

    public function offDuty(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'off_duty',
        ]);
    }
}
