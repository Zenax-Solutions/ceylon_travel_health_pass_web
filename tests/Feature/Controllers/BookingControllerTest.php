<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Booking;

use App\Models\Package;
use App\Models\Customer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingControllerTest extends TestCase
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
    public function it_displays_index_view_with_bookings(): void
    {
        $bookings = Booking::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bookings.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bookings.index')
            ->assertViewHas('bookings');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_booking(): void
    {
        $response = $this->get(route('bookings.create'));

        $response->assertOk()->assertViewIs('app.bookings.create');
    }

    /**
     * @test
     */
    public function it_stores_the_booking(): void
    {
        $data = Booking::factory()
            ->make()
            ->toArray();

        $data['destination_list'] = json_encode($data['destination_list']);
        $data['esim_list'] = json_encode($data['esim_list']);

        $response = $this->post(route('bookings.store'), $data);

        $data['destination_list'] = $this->castToJson(
            $data['destination_list']
        );
        $data['esim_list'] = $this->castToJson($data['esim_list']);

        $this->assertDatabaseHas('bookings', $data);

        $booking = Booking::latest('id')->first();

        $response->assertRedirect(route('bookings.edit', $booking));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_booking(): void
    {
        $booking = Booking::factory()->create();

        $response = $this->get(route('bookings.show', $booking));

        $response
            ->assertOk()
            ->assertViewIs('app.bookings.show')
            ->assertViewHas('booking');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_booking(): void
    {
        $booking = Booking::factory()->create();

        $response = $this->get(route('bookings.edit', $booking));

        $response
            ->assertOk()
            ->assertViewIs('app.bookings.edit')
            ->assertViewHas('booking');
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

        $data['destination_list'] = json_encode($data['destination_list']);
        $data['esim_list'] = json_encode($data['esim_list']);

        $response = $this->put(route('bookings.update', $booking), $data);

        $data['id'] = $booking->id;

        $data['destination_list'] = $this->castToJson(
            $data['destination_list']
        );
        $data['esim_list'] = $this->castToJson($data['esim_list']);

        $this->assertDatabaseHas('bookings', $data);

        $response->assertRedirect(route('bookings.edit', $booking));
    }

    /**
     * @test
     */
    public function it_deletes_the_booking(): void
    {
        $booking = Booking::factory()->create();

        $response = $this->delete(route('bookings.destroy', $booking));

        $response->assertRedirect(route('bookings.index'));

        $this->assertModelMissing($booking);
    }
}
