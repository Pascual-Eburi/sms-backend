<?php

namespace App\Contracts\Auth;

interface AuthServiceInterface
{
    public function login(array $credentials);
    public function logout(): bool;
    public function refreshToken(string $token);
}
