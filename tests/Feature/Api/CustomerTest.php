<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
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
    public function it_gets_customers_list(): void
    {
        $customers = Customer::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.customers.index'));

        $response->assertOk()->assertSee($customers[0]->first_name);
    }

    /**
     * @test
     */
    public function it_stores_the_customer(): void
    {
        $data = Customer::factory()
            ->make()
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(route('api.customers.store'), $data);

        unset($data['password']);

        $this->assertDatabaseHas('customers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_customer(): void
    {
        $customer = Customer::factory()->create();

        $data = [
            'first_name' => $this->faker->text(255),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'region_type' => $this->faker->text(255),
            'contact_no' => $this->faker->text(255),
            'whatsapp_no' => $this->faker->address(),
            'address' => $this->faker->address(),
            'status' => $this->faker->text(255),
        ];

        $data['password'] = \Str::random('8');

        $response = $this->putJson(
            route('api.customers.update', $customer),
            $data
        );

        unset($data['password']);

        $data['id'] = $customer->id;

        $this->assertDatabaseHas('customers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_customer(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->deleteJson(
            route('api.customers.destroy', $customer)
        );

        $this->assertModelMissing($customer);

        $response->assertNoContent();
    }
}
