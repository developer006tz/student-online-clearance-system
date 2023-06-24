<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_number' => $this->faker->text(255),
            'level' => 'certificate',
            'block_number' => $this->faker->text(255),
            'room_number' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
