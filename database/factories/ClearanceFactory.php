<?php

namespace Database\Factories;

use App\Models\Clearance;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClearanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clearance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'registration_number' => $this->faker->text(255),
            'block_number' => $this->faker->text(255),
            'room_number' => $this->faker->text(255),
            'level' => $this->faker->text(4),
            'hall-wadern' => '0',
            'librarian-udsm' => '0',
            'librarian-cse' => '0',
            'coordinator' => '0',
            'principal' => '0',
            'smart-card' => '0',
            'student_id' => \App\Models\Student::factory(),
        ];
    }
}
