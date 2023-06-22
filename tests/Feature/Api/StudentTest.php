<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Student;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
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
    public function it_gets_students_list(): void
    {
        $students = Student::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.students.index'));

        $response->assertOk()->assertSee($students[0]->id_number);
    }

    /**
     * @test
     */
    public function it_stores_the_student(): void
    {
        $data = Student::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.students.store'), $data);

        $this->assertDatabaseHas('students', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_student(): void
    {
        $student = Student::factory()->create();

        $user = User::factory()->create();

        $data = [
            'id_number' => $this->faker->text(255),
            'block_number' => $this->faker->text(255),
            'room_number' => $this->faker->text(255),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.students.update', $student),
            $data
        );

        $data['id'] = $student->id;

        $this->assertDatabaseHas('students', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_student(): void
    {
        $student = Student::factory()->create();

        $response = $this->deleteJson(route('api.students.destroy', $student));

        $this->assertModelMissing($student);

        $response->assertNoContent();
    }
}
