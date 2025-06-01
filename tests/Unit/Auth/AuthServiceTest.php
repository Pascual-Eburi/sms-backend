<?php

namespace Tests\Unit\Auth;

use PHPUnit\Framework\TestCase;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mockery;

class AuthServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }


    public function test_returns_token_when_credentials_are_valid()
    {
        $credentials = ['email' => 'user@example.com', 'password' => 'secret'];

        $mockGuard = Mockery::mock();
        $mockGuard->shouldReceive('attempt')
            ->once()
            ->with($credentials)
            ->andReturn('test_token');

        Auth::shouldReceive('guard')
            ->once()
            ->with('api')
            ->andReturn($mockGuard);

        $service = new AuthService();
        $result = $service->login($credentials);

        $this->assertIsArray($result);
        $this->assertEquals('test_token', $result['access_token']);
    }


    public function test_returns_false_when_credentials_are_invalid()
    {
        $mockGuard = Mockery::mock();
        $mockGuard->shouldReceive('attempt')
            ->once()
            ->with(['email' => 'bad', 'password' => 'bad'])
            ->andReturn(false);

        Auth::shouldReceive('guard')
            ->once()
            ->with('api')
            ->andReturn($mockGuard);

        $service = new AuthService();
        $result = $service->login(['email' => 'bad', 'password' => 'bad']);

        $this->assertFalse($result);
    }


    public function test_refreshes_token_successfully()
    {
        $oldToken = 'expired_token';
        $newToken = 'new_token';

        JWTAuth::shouldReceive('setToken')
            ->once()
            ->with($oldToken)
            ->andReturnSelf();

        JWTAuth::shouldReceive('refresh')
            ->once()
            ->andReturn($newToken);

        JWTAuth::shouldReceive('factory->getTTL')
            ->once()
            ->andReturn(60); // minutos

        $service = new AuthService();
        $result = $service->refreshToken($oldToken);

        $this->assertEquals([
            'access_token' => $newToken,
            'token_type' => 'bearer',
            'expires_in' => 60 * 60,
        ], $result);
    }


    public function test_returns_null_when_refresh_token_fails()
    {
        $token = 'invalid_token';

        JWTAuth::shouldReceive('setToken')
            ->once()
            ->with($token)
            ->andThrow(new JWTException());

        $service = new AuthService();
        $result = $service->refreshToken($token);

        $this->assertEquals([
            'access_token' => null,
            'token_type' => null,
            'expires_in' => null,
        ], $result);
    }


    public function test_logs_out_successfully()
    {

        JWTAuth::shouldReceive('getToken')
            ->once()
            ->andReturn('fake_token');

        JWTAuth::shouldReceive('invalidate')
            ->with('fake_token')
            ->once()
            ->andReturn(true);

        $service = new AuthService();
        $this->assertTrue($service->logout());
    }


    public function test_returns_false_when_logout_fails()
    {

        JWTAuth::shouldReceive('getToken')
            ->once()
            ->andReturn('fake_token');

        JWTAuth::shouldReceive('invalidate')
            ->with('fake_token')
            ->once()
            ->andThrow(new \Exception());

        $service = new AuthService();
        $this->assertFalse($service->logout());
    }


}
