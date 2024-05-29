<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agent;
use App\Models\EsimService;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgentEsimServicesTest extends TestCase
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
    public function it_gets_agent_esim_services(): void
    {
        $agent = Agent::factory()->create();
        $esimServices = EsimService::factory()
            ->count(2)
            ->create([
                'agent_id' => $agent->id,
            ]);

        $response = $this->getJson(
            route('api.agents.esim-services.index', $agent)
        );

        $response->assertOk()->assertSee($esimServices[0]->service_name);
    }

    /**
     * @test
     */
    public function it_stores_the_agent_esim_services(): void
    {
        $agent = Agent::factory()->create();
        $data = EsimService::factory()
            ->make([
                'agent_id' => $agent->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.agents.esim-services.store', $agent),
            $data
        );

        $this->assertDatabaseHas('esim_services', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $esimService = EsimService::latest('id')->first();

        $this->assertEquals($agent->id, $esimService->agent_id);
    }
}
