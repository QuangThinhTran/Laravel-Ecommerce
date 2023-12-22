<?php
namespace App\Repository;
use App\Models\User;
use App\Repository\Interface\IUserRepository;
use Illuminate\Support\Facades\Auth;

class UserRepository implements IUserRepository
{
    public function index(){
        return User::all()->random()->get();
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