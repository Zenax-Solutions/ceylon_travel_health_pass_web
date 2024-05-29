<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Agent;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgentControllerTest extends TestCase
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
    public function it_displays_index_view_with_agents(): void
    {
        $agents = Agent::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('agents.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.agents.index')
            ->assertViewHas('agents');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_agent(): void
    {
        $response = $this->get(route('agents.create'));

        $response->assertOk()->assertViewIs('app.agents.create');
    }

    /**
     * @test
     */
    public function it_stores_the_agent(): void
    {
        $data = Agent::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('agents.store'), $data);

        $this->assertDatabaseHas('agents', $data);

        $agent = Agent::latest('id')->first();

        $response->assertRedirect(route('agents.edit', $agent));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_agent(): void
    {
        $agent = Agent::factory()->create();

        $response = $this->get(route('agents.show', $agent));

        $response
            ->assertOk()
            ->assertViewIs('app.agents.show')
            ->assertViewHas('agent');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_agent(): void
    {
        $agent = Agent::factory()->create();

        $response = $this->get(route('agents.edit', $agent));

        $response
            ->assertOk()
            ->assertViewIs('app.agents.edit')
            ->assertViewHas('agent');
    }

    /**
     * @test
     */
    public function it_updates_the_agent(): void
    {
        $agent = Agent::factory()->create();

        $data = [
            'type' => $this->faker->word(),
            'name' => $this->faker->name(),
            'profile_image' => $this->faker->text(255),
            'email' => $this->faker->email(),
            'contact_no' => $this->faker->text(),
            'id_no' => $this->faker->text(255),
            'license_no' => $this->faker->text(255),
            'bank_details' => $this->faker->text(),
            'points' => $this->faker->randomNumber(),
            'commission' => $this->faker->randomNumber(),
            'commission_payment_status' => $this->faker->text(255),
            'commission_payment_date' => $this->faker->date(),
            'recent_commission_payment_date' => $this->faker->date(),
            'recent_info' => $this->faker->text(),
            'coupon_code' => $this->faker->text(255),
            'status' => $this->faker->word(),
        ];

        $response = $this->put(route('agents.update', $agent), $data);

        $data['id'] = $agent->id;

        $this->assertDatabaseHas('agents', $data);

        $response->assertRedirect(route('agents.edit', $agent));
    }

    /**
     * @test
     */
    public function it_deletes_the_agent(): void
    {
        $agent = Agent::factory()->create();

        $response = $this->delete(route('agents.destroy', $agent));

        $response->assertRedirect(route('agents.index'));

        $this->assertModelMissing($agent);
    }
}
