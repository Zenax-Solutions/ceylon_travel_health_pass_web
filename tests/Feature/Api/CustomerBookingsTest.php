<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Booking;
use App\Models\Customer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerBookingsTest extends TestCase
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
    public function it_gets_customer_bookings(): void
    {
        $customer = Customer::factory()->create();
        $bookings = Booking::factory()
            ->count(2)
            ->create([
                'customer_id' => $customer->id,
            ]);

        $response = $this->getJson(
            route('api.customers.bookings.index', $customer)
        );

        $response->assertOk()->assertSee($bookings[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_bookings(): void
    {
        $customer = Customer::factory()->create();
        $data = Booking::factory()
            ->make([
                'customer_id' => $customer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.customers.bookings.store', $customer),
            $data
        );

        $this->assertDatabaseHas('bookings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $booking = Booking::latest('id')->first();

        $this->assertEquals($customer->id, $booking->customer_id);
    }
}
