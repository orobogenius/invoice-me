<?php

namespace Tests\Feature;

use App\Customer;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    /** @test */
    public function it_can_list_customers()
    {
        $this->user->customers()->saveMany(factory(Customer::class, 10)->make());

        $response = $this->actingAs($this->user)
                        ->get(route('customers.index'))
                        ->assertOk()
                        ->assertViewHas('customers');
    }

    /** @test */
    public function it_can_create_customer()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->e164PhoneNumber,
            'whatsapp_number' => $this->faker->e164PhoneNumber,
            'fb_username' => $this->faker->userName,
         ];

        $response = $this->actingAs($this->user)
                            ->post(route('customers.store'), $data)
                            ->assertStatus(302)
                            ->assertRedirect(route('customers.index'))
                            ->assertSessionHas('message', 'Customer created successfully');

        $this->assertDatabaseHas('customers', collect($data)->merge(['user_id' => $this->user->id])->toArray());
    }

    /** @test */
    public function it_can_update_customer()
    {
        $customer = factory(Customer::class)->create();

        $data = [
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->e164PhoneNumber,
            'whatsapp_number' => $this->faker->e164PhoneNumber,
            'fb_username' => $this->faker->userName,
         ];

        $response = $this->actingAs($this->user)
                        ->put(route('customers.update', $customer->id), $data)
                        ->assertStatus(302)
                        ->assertRedirect(route('customers.edit', $customer->id))
                        ->assertSessionHas('message', 'Customer updated successfully');

        $this->assertDatabaseHas('customers', $customer->fresh()->toArray());
    }

    /** @test */
    public function it_can_delete_customer()
    {
        $customer = factory(Customer::class)->create();

        $this->actingAs($this->user)
            ->delete(route('customers.destroy', $customer->id))
            ->assertStatus(302)
            ->assertRedirect(route('customers.index'))
            ->assertSessionHas('message', 'Customer deleted successfully');

        $this->assertDatabaseMissing('customers', $customer->toArray());
    }
}
