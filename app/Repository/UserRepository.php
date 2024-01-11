<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\Interface\IUserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class UserRepository implements IUserRepository
{
    public function all(): LengthAwarePaginator
    {
        return User::with('posts', 'followings')->paginate(10);
    }

    public function login(array $data): bool|array
    {
        $user = [
            'username' => $data['username'],
            'password' => $data['password'],
        ];

        if (Auth::attempt($user)) {
            return $data;
        }
        return false;
    }

    public function register(array $data): User
    {
        return User::create($data);
    }
}