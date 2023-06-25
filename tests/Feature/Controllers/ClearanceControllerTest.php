<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Clearance;

use App\Models\Student;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClearanceControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_clearances(): void
    {
        $clearances = Clearance::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('clearances.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.clearances.index')
            ->assertViewHas('clearances');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_clearance(): void
    {
        $response = $this->get(route('clearances.create'));

        $response->assertOk()->assertViewIs('app.clearances.create');
    }

    /**
     * @test
     */
    public function it_stores_the_clearance(): void
    {
        $data = Clearance::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('clearances.store'), $data);

        $this->assertDatabaseHas('clearances', $data);

        $clearance = Clearance::latest('id')->first();

        $response->assertRedirect(route('clearances.edit', $clearance));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_clearance(): void
    {
        $clearance = Clearance::factory()->create();

        $response = $this->get(route('clearances.show', $clearance));

        $response
            ->assertOk()
            ->assertViewIs('app.clearances.show')
            ->assertViewHas('clearance');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_clearance(): void
    {
        $clearance = Clearance::factory()->create();

        $response = $this->get(route('clearances.edit', $clearance));

        $response
            ->assertOk()
            ->assertViewIs('app.clearances.edit')
            ->assertViewHas('clearance');
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

        $response = $this->put(route('clearances.update', $clearance), $data);

        $data['id'] = $clearance->id;

        $this->assertDatabaseHas('clearances', $data);

        $response->assertRedirect(route('clearances.edit', $clearance));
    }

    /**
     * @test
     */
    public function it_deletes_the_clearance(): void
    {
        $clearance = Clearance::factory()->create();

        $response = $this->delete(route('clearances.destroy', $clearance));

        $response->assertRedirect(route('clearances.index'));

        $this->assertModelMissing($clearance);
    }
}
