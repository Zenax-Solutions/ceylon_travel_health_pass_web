<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agent;
use App\Models\DiscountShop;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgentDiscountShopsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_agent_discount_shops(): void
    {
        $agent = Agent::factory()->create();
        $discountShops = DiscountShop::factory()
            ->count(2)
            ->create([
                'agent_id' => $agent->id,
            ]);

        $response = $this->getJson(
            route('api.agents.discount-shops.index', $agent)
        );

        $response->assertOk()->assertSee($discountShops[0]->shope_name);
    }

    /**
     * @test
     */
    public function it_stores_the_agent_discount_shops(): void
    {
        $agent = Agent::factory()->create();
        $data = DiscountShop::factory()
            ->make([
                'agent_id' => $agent->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.agents.discount-shops.store', $agent),
            $data
        );

        $this->assertDatabaseHas('discount_shops', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $discountShop = DiscountShop::latest('id')->first();

        $this->assertEquals($agent->id, $discountShop->agent_id);
    }
}
