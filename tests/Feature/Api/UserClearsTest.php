<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Clear;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserClearsTest extends TestCase
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
    public function it_gets_user_clears(): void
    {
        $user = User::factory()->create();
        $clears = Clear::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.clears.index', $user));

        $response->assertOk()->assertSee($clears[0]->role);
    }

    /**
     * @test
     */
    public function it_stores_the_user_clears(): void
    {
        $user = User::factory()->create();
        $data = Clear::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.clears.store', $user),
            $data
        );

        $this->assertDatabaseHas('clears', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $clear = Clear::latest('id')->first();

        $this->assertEquals($user->id, $clear->user_id);
    }
}
