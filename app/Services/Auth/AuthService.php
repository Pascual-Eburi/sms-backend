<?php

namespace App\Services\Auth;
use App\Contracts\Auth\AuthServiceInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthService implements AuthServiceInterface
{


    /**
     * @param array $credentials
     * @return array|bool
     */
    public function login(array $credentials = []): array|bool
    {

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return false;
        }

        return [
            'access_token' => $token
        ];
    }

    /**
     * @param string $token
     * @return array|bool
     */
    public function refreshToken(string $token): array|null
    {
        try {
            // Establecer el token actual
            JWTAuth::setToken($token);

            // Refrescar el token
            $new_token = JWTAuth::refresh();

            return [
                'access_token' => $new_token,
                'token_type' => 'bearer',
                'expires_in' => JWTAuth::factory()->getTTL() * 60, // Tiempo en segundos
            ];
        } catch (JWTException $e) {
            return [
                'access_token' => null,
                'token_type' => null,
                'expires_in' => null,
            ];
        }

    }

    public function logout(): bool
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }

}
