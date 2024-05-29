<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Destination;

use App\Models\City;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestinationControllerTest extends TestCase
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
    public function it_displays_index_view_with_destinations(): void
    {
        $destinations = Destination::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('destinations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.destinations.index')
            ->assertViewHas('destinations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_destination(): void
    {
        $response = $this->get(route('destinations.create'));

        $response->assertOk()->assertViewIs('app.destinations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_destination(): void
    {
        $data = Destination::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('destinations.store'), $data);

        $this->assertDatabaseHas('destinations', $data);

        $destination = Destination::latest('id')->first();

        $response->assertRedirect(route('destinations.edit', $destination));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_destination(): void
    {
        $destination = Destination::factory()->create();

        $response = $this->get(route('destinations.show', $destination));

        $response
            ->assertOk()
            ->assertViewIs('app.destinations.show')
            ->assertViewHas('destination');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_destination(): void
    {
        $destination = Destination::factory()->create();

        $response = $this->get(route('destinations.edit', $destination));

        $response
            ->assertOk()
            ->assertViewIs('app.destinations.edit')
            ->assertViewHas('destination');
    }

    /**
     * @test
     */
    public function it_updates_the_destination(): void
    {
        $destination = Destination::factory()->create();

        $city = City::factory()->create();

        $data = [
            'destination' => $this->faker->sentence(10),
            'location' => $this->faker->text(255),
            'south_asian_price' => $this->faker->randomNumber(1),
            'non_south_asian_price' => $this->faker->randomFloat(2, 0, 9999),
            'discount_price' => $this->faker->randomNumber(1),
            'status' => $this->faker->word(),
            'city_id' => $city->id,
        ];

        $response = $this->put(
            route('destinations.update', $destination),
            $data
        );

        $data['id'] = $destination->id;

        $this->assertDatabaseHas('destinations', $data);

        $response->assertRedirect(route('destinations.edit', $destination));
    }

    /**
     * @test
     */
    public function it_deletes_the_destination(): void
    {
        $destination = Destination::factory()->create();

        $response = $this->delete(route('destinations.destroy', $destination));

        $response->assertRedirect(route('destinations.index'));

        $this->assertModelMissing($destination);
    }
}
