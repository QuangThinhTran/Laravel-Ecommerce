<?php
namespace App\Repository;
use App\Models\User;
use App\Repository\Interface\IUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    public function index(){
        return User::inRandomOrder()->limit(3)->get();
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
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id']
        ]);
    }

    public function find($id) {
        return User::with('posts')->find($id);
    }

    public function search()
    {
        return User::search()->get();
    }
}