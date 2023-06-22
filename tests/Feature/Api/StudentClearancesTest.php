<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Student;
use App\Models\Clearance;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentClearancesTest extends TestCase
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
    public function it_gets_student_clearances(): void
    {
        $student = Student::factory()->create();
        $clearances = Clearance::factory()
            ->count(2)
            ->create([
                'student_id' => $student->id,
            ]);

        $response = $this->getJson(
            route('api.students.clearances.index', $student)
        );

        $response->assertOk()->assertSee($clearances[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_student_clearances(): void
    {
        $student = Student::factory()->create();
        $data = Clearance::factory()
            ->make([
                'student_id' => $student->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.students.clearances.store', $student),
            $data
        );

        $this->assertDatabaseHas('clearances', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $clearance = Clearance::latest('id')->first();

        $this->assertEquals($student->id, $clearance->student_id);
    }
}
