<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Booking;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTicketsTest extends TestCase
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
    public function it_gets_booking_tickets(): void
    {
        $booking = Booking::factory()->create();
        $tickets = Ticket::factory()
            ->count(2)
            ->create([
                'booking_id' => $booking->id,
            ]);

        $response = $this->getJson(
            route('api.bookings.tickets.index', $booking)
        );

        $response->assertOk()->assertSee($tickets[0]->ticket_id);
    }

    /**
     * @test
     */
    public function it_stores_the_booking_tickets(): void
    {
        $booking = Booking::factory()->create();
        $data = Ticket::factory()
            ->make([
                'booking_id' => $booking->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.bookings.tickets.store', $booking),
            $data
        );

        $this->assertDatabaseHas('tickets', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $ticket = Ticket::latest('id')->first();

        $this->assertEquals($booking->id, $ticket->booking_id);
    }
}
