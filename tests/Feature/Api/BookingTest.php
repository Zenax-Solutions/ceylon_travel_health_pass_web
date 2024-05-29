<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Booking;

use App\Models\Package;
use App\Models\Customer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
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
    public function it_gets_bookings_list(): void
    {
        $bookings = Booking::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.bookings.index'));

        $response->assertOk()->assertSee($bookings[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_booking(): void
    {
        $data = Booking::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.bookings.store'), $data);

        $this->assertDatabaseHas('bookings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_booking(): void
    {
        $booking = Booking::factory()->create();

        $package = Package::factory()->create();
        $customer = Customer::factory()->create();

        $data = [
            'adult_pass_count' => $this->faker->randomNumber(),
            'child_pass_count' => $this->faker->randomNumber(),
            'destination_list' => [],
            'esim_list' => [],
            'total' => $this->faker->randomFloat(2, 0, 9999),
            'date' => $this->faker->date(),
            'payment_status' => $this->faker->text(255),
            'package_id' => $package->id,
            'customer_id' => $customer->id,
        ];

        $response = $this->putJson(
            route('api.bookings.update', $booking),
            $data
        );

        $data['id'] = $booking->id;

        $this->assertDatabaseHas('bookings', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_booking(): void
    {
        $booking = Booking::factory()->create();

        $response = $this->deleteJson(route('api.bookings.destroy', $booking));

        $this->assertModelMissing($booking);

        $response->assertNoContent();
    }
}
