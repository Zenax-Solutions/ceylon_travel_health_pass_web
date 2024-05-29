<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Package;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PackageTest extends TestCase
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
    public function it_gets_packages_list(): void
    {
        $packages = Package::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.packages.index'));

        $response->assertOk()->assertSee($packages[0]->main_title);
    }

    /**
     * @test
     */
    public function it_stores_the_package(): void
    {
        $data = Package::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.packages.store'), $data);

        $this->assertDatabaseHas('packages', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_package(): void
    {
        $package = Package::factory()->create();

        $data = [
            'main_title' => $this->faker->sentence(10),
            'second_title' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'travel_info' => $this->faker->text(),
            'health_info' => $this->faker->text(),
            'days' => $this->faker->randomNumber(),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'child_price' => $this->faker->randomNumber(1),
            'additional_per_adult_price' => $this->faker->randomNumber(1),
            'additional_per_day_price' => $this->faker->randomNumber(1),
            'discount_shop_list' => [],
            'discount_service_list' => [],
            'expire_days_count' => $this->faker->randomNumber(),
        ];

        $response = $this->putJson(
            route('api.packages.update', $package),
            $data
        );

        $data['id'] = $package->id;

        $this->assertDatabaseHas('packages', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_package(): void
    {
        $package = Package::factory()->create();

        $response = $this->deleteJson(route('api.packages.destroy', $package));

        $this->assertModelMissing($package);

        $response->assertNoContent();
    }
}
