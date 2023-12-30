<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\Interface\IUserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Collection\Collection;

class UserRepository implements IUserRepository
{
    /**
     * Get list Users
     * @return LengthAwarePaginator
     * */
    public function index(): LengthAwarePaginator
    {
        return User::with('role', 'carts', 'comments', 'posts', 'attributes')->paginate(10);
    }

    /**
     * Login User
     * @param array $data
     * @return bool|array
     * */
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

    /**
     * Register User
     * @param array $data
     * @return Model|Collection
     * */
    public function register(array $data): Model|Collection
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id']
        ]);
    }

    /**
     * Detail User
     * @param $id
     * @return Model|Collection
     * */
    public function find($id): Model|Collection
    {
        return User::with('posts')->find($id);
    }

    /**
     * Search User by name
     * @return Model|Collection
     * */
    public function search(): Model|Collection
    {
        return User::search()->get();
    }
}