<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repository\Interface\IUserRepository;
use Illuminate\View\View;

class UserController extends Controller
{
    protected IUserRepository $userRepository;

    public function __construct
    (
        IUserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Get detail User
     * @param $id
     * @return View
     * */
    public function detail($id): View
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return view('errors.not_found');
        }
        $paginatedPosts = $user->posts()->paginate(5);
        $users = $this->userRepository->index();
        return view('profile', compact('user', 'users', 'paginatedPosts'));
    }
}