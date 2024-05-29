<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Package;
use App\Models\Booking;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PackageBookingsTest extends TestCase
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
    public function it_gets_package_bookings(): void
    {
        $package = Package::factory()->create();
        $bookings = Booking::factory()
            ->count(2)
            ->create([
                'package_id' => $package->id,
            ]);

        $response = $this->getJson(
            route('api.packages.bookings.index', $package)
        );

        $response->assertOk()->assertSee($bookings[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_package_bookings(): void
    {
        $package = Package::factory()->create();
        $data = Booking::factory()
            ->make([
                'package_id' => $package->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.packages.bookings.store', $package),
            $data
        );

        $this->assertDatabaseHas('bookings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $booking = Booking::latest('id')->first();

        $this->assertEquals($package->id, $booking->package_id);
    }
}
