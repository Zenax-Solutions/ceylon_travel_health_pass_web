<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\EsimService;

use App\Models\Agent;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EsimServiceTest extends TestCase
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
    public function it_gets_esim_services_list(): void
    {
        $esimServices = EsimService::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.esim-services.index'));

        $response->assertOk()->assertSee($esimServices[0]->service_name);
    }

    /**
     * @test
     */
    public function it_stores_the_esim_service(): void
    {
        $data = EsimService::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.esim-services.store'), $data);

        $this->assertDatabaseHas('esim_services', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_esim_service(): void
    {
        $esimService = EsimService::factory()->create();

        $agent = Agent::factory()->create();

        $data = [
            'service_name' => $this->faker->text(255),
            'per_sim_price' => $this->faker->randomFloat(2, 0, 9999),
            'status' => $this->faker->word(),
            'agent_id' => $agent->id,
        ];

        $response = $this->putJson(
            route('api.esim-services.update', $esimService),
            $data
        );

        $data['id'] = $esimService->id;

        $this->assertDatabaseHas('esim_services', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_esim_service(): void
    {
        $esimService = EsimService::factory()->create();

        $response = $this->deleteJson(
            route('api.esim-services.destroy', $esimService)
        );

        $this->assertModelMissing($esimService);

        $response->assertNoContent();
    }
}
