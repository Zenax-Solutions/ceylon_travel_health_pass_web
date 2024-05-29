<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\DiscountService;

use App\Models\Agent;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiscountServiceTest extends TestCase
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
    public function it_gets_discount_services_list(): void
    {
        $discountServices = DiscountService::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.discount-services.index'));

        $response->assertOk()->assertSee($discountServices[0]->service_name);
    }

    /**
     * @test
     */
    public function it_stores_the_discount_service(): void
    {
        $data = DiscountService::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.discount-services.store'),
            $data
        );

        $this->assertDatabaseHas('discount_services', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_discount_service(): void
    {
        $discountService = DiscountService::factory()->create();

        $agent = Agent::factory()->create();

        $data = [
            'service_name' => $this->faker->text(255),
            'location' => $this->faker->text(255),
            'area' => $this->faker->text(255),
            'discount_amount' => $this->faker->text(255),
            'status' => $this->faker->word(),
            'agent_id' => $agent->id,
        ];

        $response = $this->putJson(
            route('api.discount-services.update', $discountService),
            $data
        );

        $data['id'] = $discountService->id;

        $this->assertDatabaseHas('discount_services', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_discount_service(): void
    {
        $discountService = DiscountService::factory()->create();

        $response = $this->deleteJson(
            route('api.discount-services.destroy', $discountService)
        );

        $this->assertModelMissing($discountService);

        $response->assertNoContent();
    }
}
