<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Clear;

use App\Models\Clearance;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClearControllerTest extends TestCase
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
    public function it_displays_index_view_with_clears(): void
    {
        $clears = Clear::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('clears.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.clears.index')
            ->assertViewHas('clears');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_clear(): void
    {
        $response = $this->get(route('clears.create'));

        $response->assertOk()->assertViewIs('app.clears.create');
    }

    /**
     * @test
     */
    public function it_stores_the_clear(): void
    {
        $data = Clear::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('clears.store'), $data);

        $this->assertDatabaseHas('clears', $data);

        $clear = Clear::latest('id')->first();

        $response->assertRedirect(route('clears.edit', $clear));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_clear(): void
    {
        $clear = Clear::factory()->create();

        $response = $this->get(route('clears.show', $clear));

        $response
            ->assertOk()
            ->assertViewIs('app.clears.show')
            ->assertViewHas('clear');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_clear(): void
    {
        $clear = Clear::factory()->create();

        $response = $this->get(route('clears.edit', $clear));

        $response
            ->assertOk()
            ->assertViewIs('app.clears.edit')
            ->assertViewHas('clear');
    }

    /**
     * @test
     */
    public function it_updates_the_clear(): void
    {
        $clear = Clear::factory()->create();

        $clearance = Clearance::factory()->create();
        $user = User::factory()->create();

        $data = [
            'role' => $this->faker->text(255),
            'comment' => $this->faker->text(),
            'signature' => '0',
            'date' => $this->faker->date(),
            'status' => '0',
            'clearance_id' => $clearance->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('clears.update', $clear), $data);

        $data['id'] = $clear->id;

        $this->assertDatabaseHas('clears', $data);

        $response->assertRedirect(route('clears.edit', $clear));
    }

    /**
     * @test
     */
    public function it_deletes_the_clear(): void
    {
        $clear = Clear::factory()->create();

        $response = $this->delete(route('clears.destroy', $clear));

        $response->assertRedirect(route('clears.index'));

        $this->assertModelMissing($clear);
    }
}
