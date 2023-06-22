<?php

namespace Database\Seeders;

use App\Models\Clearance;
use Illuminate\Database\Seeder;

class ClearanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clearance::factory()
            ->count(0)
            ->create();
    }
}