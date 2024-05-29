<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\DiscountShop;

use App\Models\Agent;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiscountShopControllerTest extends TestCase
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
    public function it_displays_index_view_with_discount_shops(): void
    {
        $discountShops = DiscountShop::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('discount-shops.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.discount_shops.index')
            ->assertViewHas('discountShops');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_discount_shop(): void
    {
        $response = $this->get(route('discount-shops.create'));

        $response->assertOk()->assertViewIs('app.discount_shops.create');
    }

    /**
     * @test
     */
    public function it_stores_the_discount_shop(): void
    {
        $data = DiscountShop::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('discount-shops.store'), $data);

        $this->assertDatabaseHas('discount_shops', $data);

        $discountShop = DiscountShop::latest('id')->first();

        $response->assertRedirect(route('discount-shops.edit', $discountShop));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_discount_shop(): void
    {
        $discountShop = DiscountShop::factory()->create();

        $response = $this->get(route('discount-shops.show', $discountShop));

        $response
            ->assertOk()
            ->assertViewIs('app.discount_shops.show')
            ->assertViewHas('discountShop');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_discount_shop(): void
    {
        $discountShop = DiscountShop::factory()->create();

        $response = $this->get(route('discount-shops.edit', $discountShop));

        $response
            ->assertOk()
            ->assertViewIs('app.discount_shops.edit')
            ->assertViewHas('discountShop');
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

        $response = $this->put(
            route('discount-shops.update', $discountShop),
            $data
        );

        $data['id'] = $discountShop->id;

        $this->assertDatabaseHas('discount_shops', $data);

        $response->assertRedirect(route('discount-shops.edit', $discountShop));
    }

    /**
     * @test
     */
    public function it_deletes_the_discount_shop(): void
    {
        $discountShop = DiscountShop::factory()->create();

        $response = $this->delete(
            route('discount-shops.destroy', $discountShop)
        );

        $response->assertRedirect(route('discount-shops.index'));

        $this->assertModelMissing($discountShop);
    }
}
