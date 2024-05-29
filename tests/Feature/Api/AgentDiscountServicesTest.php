<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agent;
use App\Models\DiscountService;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgentDiscountServicesTest extends TestCase
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
    public function it_gets_agent_discount_services(): void
    {
        $agent = Agent::factory()->create();
        $discountServices = DiscountService::factory()
            ->count(2)
            ->create([
                'agent_id' => $agent->id,
            ]);

        $response = $this->getJson(
            route('api.agents.discount-services.index', $agent)
        );

        $response->assertOk()->assertSee($discountServices[0]->service_name);
    }

    /**
     * @test
     */
    public function it_stores_the_agent_discount_services(): void
    {
        $agent = Agent::factory()->create();
        $data = DiscountService::factory()
            ->make([
                'agent_id' => $agent->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.agents.discount-services.store', $agent),
            $data
        );

        $this->assertDatabaseHas('discount_services', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $discountService = DiscountService::latest('id')->first();

        $this->assertEquals($agent->id, $discountService->agent_id);
    }
}
