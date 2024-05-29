<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Package;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PackageControllerTest extends TestCase
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

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return \DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_packages(): void
    {
        $packages = Package::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('packages.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.packages.index')
            ->assertViewHas('packages');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_package(): void
    {
        $response = $this->get(route('packages.create'));

        $response->assertOk()->assertViewIs('app.packages.create');
    }

    /**
     * @test
     */
    public function it_stores_the_package(): void
    {
        $data = Package::factory()
            ->make()
            ->toArray();

        $data['discount_shop_list'] = json_encode($data['discount_shop_list']);
        $data['discount_service_list'] = json_encode(
            $data['discount_service_list']
        );

        $response = $this->post(route('packages.store'), $data);

        $data['discount_shop_list'] = $this->castToJson(
            $data['discount_shop_list']
        );
        $data['discount_service_list'] = $this->castToJson(
            $data['discount_service_list']
        );

        $this->assertDatabaseHas('packages', $data);

        $package = Package::latest('id')->first();

        $response->assertRedirect(route('packages.edit', $package));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_package(): void
    {
        $package = Package::factory()->create();

        $response = $this->get(route('packages.show', $package));

        $response
            ->assertOk()
            ->assertViewIs('app.packages.show')
            ->assertViewHas('package');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_package(): void
    {
        $package = Package::factory()->create();

        $response = $this->get(route('packages.edit', $package));

        $response
            ->assertOk()
            ->assertViewIs('app.packages.edit')
            ->assertViewHas('package');
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

        $data['discount_shop_list'] = json_encode($data['discount_shop_list']);
        $data['discount_service_list'] = json_encode(
            $data['discount_service_list']
        );

        $response = $this->put(route('packages.update', $package), $data);

        $data['id'] = $package->id;

        $data['discount_shop_list'] = $this->castToJson(
            $data['discount_shop_list']
        );
        $data['discount_service_list'] = $this->castToJson(
            $data['discount_service_list']
        );

        $this->assertDatabaseHas('packages', $data);

        $response->assertRedirect(route('packages.edit', $package));
    }

    /**
     * @test
     */
    public function it_deletes_the_package(): void
    {
        $package = Package::factory()->create();

        $response = $this->delete(route('packages.destroy', $package));

        $response->assertRedirect(route('packages.index'));

        $this->assertModelMissing($package);
    }
}
