<?php

namespace Database\Seeders;

use App\Models\Clear;
use Illuminate\Database\Seeder;

class ClearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clear::factory()
            ->count(0)
            ->create();
    }
}