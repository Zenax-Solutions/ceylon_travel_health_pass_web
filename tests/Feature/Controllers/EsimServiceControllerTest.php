<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\EsimService;

use App\Models\Agent;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EsimServiceControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_esim_services(): void
    {
        $esimServices = EsimService::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('esim-services.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.esim_services.index')
            ->assertViewHas('esimServices');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_esim_service(): void
    {
        $response = $this->get(route('esim-services.create'));

        $response->assertOk()->assertViewIs('app.esim_services.create');
    }

    /**
     * @test
     */
    public function it_stores_the_esim_service(): void
    {
        $data = EsimService::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('esim-services.store'), $data);

        $this->assertDatabaseHas('esim_services', $data);

        $esimService = EsimService::latest('id')->first();

        $response->assertRedirect(route('esim-services.edit', $esimService));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_esim_service(): void
    {
        $esimService = EsimService::factory()->create();

        $response = $this->get(route('esim-services.show', $esimService));

        $response
            ->assertOk()
            ->assertViewIs('app.esim_services.show')
            ->assertViewHas('esimService');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_esim_service(): void
    {
        $esimService = EsimService::factory()->create();

        $response = $this->get(route('esim-services.edit', $esimService));

        $response
            ->assertOk()
            ->assertViewIs('app.esim_services.edit')
            ->assertViewHas('esimService');
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

        $response = $this->put(
            route('esim-services.update', $esimService),
            $data
        );

        $data['id'] = $esimService->id;

        $this->assertDatabaseHas('esim_services', $data);

        $response->assertRedirect(route('esim-services.edit', $esimService));
    }

    /**
     * @test
     */
    public function it_deletes_the_esim_service(): void
    {
        $esimService = EsimService::factory()->create();

        $response = $this->delete(route('esim-services.destroy', $esimService));

        $response->assertRedirect(route('esim-services.index'));

        $this->assertModelMissing($esimService);
    }
}
