<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Clearance;

use App\Models\Student;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClearanceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_clearances_list(): void
    {
        $clearances = Clearance::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.clearances.index'));

        $response->assertOk()->assertSee($clearances[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_clearance(): void
    {
        $data = Clearance::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.clearances.store'), $data);

        $this->assertDatabaseHas('clearances', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_clearance(): void
    {
        $clearance = Clearance::factory()->create();

        $student = Student::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'registration_number' => $this->faker->text(255),
            'block_number' => $this->faker->text(255),
            'room_number' => $this->faker->text(255),
            'level' => $this->faker->text(255),
            'hall-wadern' => '0',
            'librarian-udsm' => '0',
            'librarian-cse' => '0',
            'coordinator' => '0',
            'principal' => '0',
            'smart-card' => '0',
            'student_id' => $student->id,
        ];

        $response = $this->putJson(
            route('api.clearances.update', $clearance),
            $data
        );

        $data['id'] = $clearance->id;

        $this->assertDatabaseHas('clearances', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_clearance(): void
    {
        $clearance = Clearance::factory()->create();

        $response = $this->deleteJson(
            route('api.clearances.destroy', $clearance)
        );

        $this->assertModelMissing($clearance);

        $response->assertNoContent();
    }
}
