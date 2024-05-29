<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\DiscountShop;

use App\Models\Agent;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiscountShopTest extends TestCase
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
    public function it_gets_discount_shops_list(): void
    {
        $discountShops = DiscountShop::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.discount-shops.index'));

        $response->assertOk()->assertSee($discountShops[0]->shope_name);
    }

    /**
     * @test
     */
    public function it_stores_the_discount_shop(): void
    {
        $data = DiscountShop::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.discount-shops.store'), $data);

        $this->assertDatabaseHas('discount_shops', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_discount_shop(): void
    {
        $discountShop = DiscountShop::factory()->create();

        $agent = Agent::factory()->create();

        $data = [
            'shope_name' => $this->faker->text(255),
            'location' => $this->faker->text(255),
            'area' => $this->faker->text(255),
            'discount_amount' => $this->faker->text(255),
            'status' => $this->faker->word(),
            'agent_id' => $agent->id,
        ];

        $response = $this->putJson(
            route('api.discount-shops.update', $discountShop),
            $data
        );

        $data['id'] = $discountShop->id;

        $this->assertDatabaseHas('discount_shops', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_discount_shop(): void
    {
        $discountShop = DiscountShop::factory()->create();

        $response = $this->deleteJson(
            route('api.discount-shops.destroy', $discountShop)
        );

        $this->assertModelMissing($discountShop);

        $response->assertNoContent();
    }
}
