<?php

namespace Database\Seeders;

use App\Models\Fleet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FleetSeeder extends Seeder
{
    public function run(): void
    {
        Fleet::factory()->count(5)->create();
    }
}
