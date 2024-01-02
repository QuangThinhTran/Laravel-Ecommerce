<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\Interface\IUserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    /**
     * Get all Users
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return User::with('role', 'carts', 'comments', 'posts', 'attributes')->paginate(10);
    }

    /**
     * Find Users by action
     * @param $action // column want find
     * @param $data // data of column want find
     * @return LengthAwarePaginator
     */
    public function getUserByAction($action, $data): LengthAwarePaginator
    {
        return User::with('role', 'carts', 'comments', 'posts', 'attributes')
            ->where($action, $data)->paginate(10);
    }

    /**
     * Get employees by merchant
     * @return LengthAwarePaginator|null
     */
    public function getUserByMerchant(): LengthAwarePaginator|null
    {
        $auth = auth()->user();

        if ($auth instanceof User) {
            return $auth->employees()->paginate(10);
        }
        return null;
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
        return User::with('posts')->findOrFail($id);
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