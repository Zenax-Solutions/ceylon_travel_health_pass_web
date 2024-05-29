<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\City;
use App\Models\Destination;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityDestinationsTest extends TestCase
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
    public function it_gets_city_destinations(): void
    {
        $city = City::factory()->create();
        $destinations = Destination::factory()
            ->count(2)
            ->create([
                'city_id' => $city->id,
            ]);

        $response = $this->getJson(
            route('api.cities.destinations.index', $city)
        );

        $response->assertOk()->assertSee($destinations[0]->destination);
    }

    /**
     * @test
     */
    public function it_stores_the_city_destinations(): void
    {
        $city = City::factory()->create();
        $data = Destination::factory()
            ->make([
                'city_id' => $city->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.cities.destinations.store', $city),
            $data
        );

        $this->assertDatabaseHas('destinations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $destination = Destination::latest('id')->first();

        $this->assertEquals($city->id, $destination->city_id);
    }
}
