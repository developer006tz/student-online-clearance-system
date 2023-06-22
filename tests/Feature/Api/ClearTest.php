<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Clear;

use App\Models\Clearance;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClearTest extends TestCase
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
    public function it_gets_clears_list(): void
    {
        $clears = Clear::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.clears.index'));

        $response->assertOk()->assertSee($clears[0]->role);
    }

    /**
     * @test
     */
    public function it_stores_the_clear(): void
    {
        $data = Clear::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.clears.store'), $data);

        $this->assertDatabaseHas('clears', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.clears.update', $clear), $data);

        $data['id'] = $clear->id;

        $this->assertDatabaseHas('clears', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_clear(): void
    {
        $clear = Clear::factory()->create();

        $response = $this->deleteJson(route('api.clears.destroy', $clear));

        $this->assertModelMissing($clear);

        $response->assertNoContent();
    }
}
