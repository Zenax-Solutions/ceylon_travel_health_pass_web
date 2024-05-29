<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Destination;

use App\Models\City;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestinationTest extends TestCase
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
    public function it_gets_destinations_list(): void
    {
        $destinations = Destination::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.destinations.index'));

        $response->assertOk()->assertSee($destinations[0]->destination);
    }

    /**
     * @test
     */
    public function it_stores_the_destination(): void
    {
        $data = Destination::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.destinations.store'), $data);

        $this->assertDatabaseHas('destinations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.destinations.update', $destination),
            $data
        );

        $data['id'] = $destination->id;

        $this->assertDatabaseHas('destinations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_destination(): void
    {
        $destination = Destination::factory()->create();

        $response = $this->deleteJson(
            route('api.destinations.destroy', $destination)
        );

        $this->assertModelMissing($destination);

        $response->assertNoContent();
    }
}
