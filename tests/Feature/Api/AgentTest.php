<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agent;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgentTest extends TestCase
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
    public function it_gets_agents_list(): void
    {
        $agents = Agent::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.agents.index'));

        $response->assertOk()->assertSee($agents[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_agent(): void
    {
        $data = Agent::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.agents.store'), $data);

        $this->assertDatabaseHas('agents', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.agents.update', $agent), $data);

        $data['id'] = $agent->id;

        $this->assertDatabaseHas('agents', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_agent(): void
    {
        $agent = Agent::factory()->create();

        $response = $this->deleteJson(route('api.agents.destroy', $agent));

        $this->assertModelMissing($agent);

        $response->assertNoContent();
    }
}
