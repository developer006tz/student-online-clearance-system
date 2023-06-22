<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Student;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStudentsTest extends TestCase
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
    public function it_gets_user_students(): void
    {
        $user = User::factory()->create();
        $students = Student::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.students.index', $user));

        $response->assertOk()->assertSee($students[0]->id_number);
    }

    /**
     * @test
     */
    public function it_stores_the_user_students(): void
    {
        $user = User::factory()->create();
        $data = Student::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.students.store', $user),
            $data
        );

        $this->assertDatabaseHas('students', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $student = Student::latest('id')->first();

        $this->assertEquals($user->id, $student->user_id);
    }
}
