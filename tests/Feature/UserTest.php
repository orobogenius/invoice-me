<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    /** @test */
    public function it_can_create_a_user()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => 'password',
            'password_confirmation' => 'password',
            'remember_token' => Str::random(10),
            'account_number' => $this->faker->bankAccountNumber,
            'account_name' => $this->faker->name,
            'bank_name' => $this->faker->word,
        ];

        $this->post(route('register'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('users', collect($data)->only(['email', 'name'])->toArray());
    }

    /** @test */
    public function it_can_login_user()
    {
        $data = [
           'email' => $this->user->email,
           'password' => 'password',
        ];

        $this->post(route('login'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('dashboard'));
    }
}
