<?php

namespace Database\Factories;

use App\Models\Clear;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClearFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clear::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role' => $this->faker->text(255),
            'comment' => $this->faker->text(),
            'signature' => '0',
            'date' => $this->faker->date(),
            'status' => '0',
            'clearance_id' => \App\Models\Clearance::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
