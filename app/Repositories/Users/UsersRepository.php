<?php

namespace App\Repositories\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersRepository
{
    public function getUserInfoById(int $userId): array
    {
        return User::with(['role', 'person', 'person.center'])
                ->find($userId)
                ->toArray();
    }
}
