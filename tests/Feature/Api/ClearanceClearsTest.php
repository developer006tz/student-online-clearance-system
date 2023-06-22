<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Clear;
use App\Models\Clearance;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClearanceClearsTest extends TestCase
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
    public function it_gets_clearance_clears(): void
    {
        $clearance = Clearance::factory()->create();
        $clears = Clear::factory()
            ->count(2)
            ->create([
                'clearance_id' => $clearance->id,
            ]);

        $response = $this->getJson(
            route('api.clearances.clears.index', $clearance)
        );

        $response->assertOk()->assertSee($clears[0]->role);
    }

    /**
     * @test
     */
    public function it_stores_the_clearance_clears(): void
    {
        $clearance = Clearance::factory()->create();
        $data = Clear::factory()
            ->make([
                'clearance_id' => $clearance->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.clearances.clears.store', $clearance),
            $data
        );

        $this->assertDatabaseHas('clears', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $clear = Clear::latest('id')->first();

        $this->assertEquals($clearance->id, $clear->clearance_id);
    }
}
