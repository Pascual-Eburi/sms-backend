<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('secret'),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'secret',
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['access_token']);
    }

    public function test_login_with_invalid_credentials()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'wrong@example.com',
            'password' => 'badpassword',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson(['error' => 'Invalid credentials']);
    }

    public function test_me_requires_authentication()
    {
        $response = $this->getJson('/api/auth/me');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED); // No autenticado, espera Response::HTTP_UNAUTHORIZED
    }

    public function test_me_returns_user_data_when_authenticated()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $response = $this->getJson('/api/auth/me');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['user_data']);
    }

    public function test_logout_requires_authentication()
    {
        $response = $this->postJson('/api/auth/logout');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_logout_successfully()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson('/api/auth/logout');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['message' => 'Successfully logged out']);
    }

    public function test_refresh_requires_authentication()
    {
        $response = $this->postJson('/api/auth/refresh', ['token' => 'dummy']);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_refresh_returns_new_token_when_authenticated()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $response = $this->postJson('/api/auth/refresh', [
            'token' => 'dummy_token',
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }
}
