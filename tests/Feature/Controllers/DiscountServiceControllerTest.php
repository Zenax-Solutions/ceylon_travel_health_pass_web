<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\DiscountService;

use App\Models\Agent;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiscountServiceControllerTest extends TestCase
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
    public function it_displays_index_view_with_discount_services(): void
    {
        $discountServices = DiscountService::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('discount-services.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.discount_services.index')
            ->assertViewHas('discountServices');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_discount_service(): void
    {
        $response = $this->get(route('discount-services.create'));

        $response->assertOk()->assertViewIs('app.discount_services.create');
    }

    /**
     * @test
     */
    public function it_stores_the_discount_service(): void
    {
        $data = DiscountService::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('discount-services.store'), $data);

        $this->assertDatabaseHas('discount_services', $data);

        $discountService = DiscountService::latest('id')->first();

        $response->assertRedirect(
            route('discount-services.edit', $discountService)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_discount_service(): void
    {
        $discountService = DiscountService::factory()->create();

        $response = $this->get(
            route('discount-services.show', $discountService)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.discount_services.show')
            ->assertViewHas('discountService');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_discount_service(): void
    {
        $discountService = DiscountService::factory()->create();

        $response = $this->get(
            route('discount-services.edit', $discountService)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.discount_services.edit')
            ->assertViewHas('discountService');
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

        $response = $this->put(
            route('discount-services.update', $discountService),
            $data
        );

        $data['id'] = $discountService->id;

        $this->assertDatabaseHas('discount_services', $data);

        $response->assertRedirect(
            route('discount-services.edit', $discountService)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_discount_service(): void
    {
        $discountService = DiscountService::factory()->create();

        $response = $this->delete(
            route('discount-services.destroy', $discountService)
        );

        $response->assertRedirect(route('discount-services.index'));

        $this->assertModelMissing($discountService);
    }
}
