<?php

namespace App\Services\Users;

use App\Repositories\Users\UsersRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class UsersService
{
    private UsersRepository $usersRepository;
    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function getAuthUser(): ?array
    {
        $authUser = Auth::guard('api')->user();

        if (!$authUser) {return null;}

        return $this->usersRepository->getUserInfoById(
            $authUser->getAuthIdentifier()
        );
    }
}
