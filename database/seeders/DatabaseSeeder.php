<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            FleetSeeder::class,
            DriverSeeder::class,
        ]);

        $adminUser = User::factory()->create([
            'name' => 'Admin Logistik',
            'email' => 'admin@oplan.local',
            'password' => bcrypt('password'),
        ]);
        $adminUser->assignRole('Admin Logistik');

        $managerUser = User::factory()->create([
            'name' => 'Manager Operasional',
            'email' => 'manager@oplan.local',
            'password' => bcrypt('password'),
        ]);
        $managerUser->assignRole('Manager');

        Driver::all()->each(function (Driver $driver) {
            if (!$driver->user) {
                $user = User::factory()->create([
                    'name' => $driver->name,
                    'email' => strtolower(str_replace(' ', '.', $driver->name)) . '@driver.oplan.local',
                    'password' => bcrypt('password'),
                    'driver_id' => $driver->id,
                ]);
                $user->assignRole('Driver');
            }
        });

        $this->call([
            DeliveryOrderSeeder::class,
        ]);
    }
}
