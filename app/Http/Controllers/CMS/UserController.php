<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repository\Interface\IUserRepository;

class UserController extends Controller
{
    protected IUserRepository $userRepository;

    public function __construct
    (
        IUserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function detail($id)
    {
        $user = $this->userRepository->find($id);
        $paginatedPosts = $user->posts()->paginate(5);
        $users = $this->userRepository->index();
        return view('profile', compact('user','users', 'paginatedPosts'));
    }
}