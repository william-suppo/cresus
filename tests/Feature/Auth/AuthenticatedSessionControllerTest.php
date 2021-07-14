<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticatedSessionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_login()
    {
        $user = User::factory()->create();

        $response = $this->get('/');

        $response->assertSuccessful();

        $response = $this->from('/')->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function guest_cant_login_with_wrong_credentials()
    {
        $response = $this->from('/')->post('/login', [
            'email' => 'h4ck3r@noway.com',
            'password' => 'bad password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors(['email']);
        $response->assertRedirect('/');
    }

    /** @test */
    public function guest_cant_login_with_inactive_account()
    {
        $user = User::factory()->create([
            'active' => false,
        ]);

        $response = $this->from('/')->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors(['email']);
        $response->assertRedirect('/');
    }

    /** @test */
    public function authenticated_user_cant_relogin()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertRedirect('/dashboard');

        $response = $this
            ->from('/')
            ->actingAs($user)
            ->post('/login');

        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function authenticated_user_can_logout()
    {
        $user = User::factory()->create();

        $response = $this
            ->from('/transactions')
            ->actingAs($user)
            ->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
