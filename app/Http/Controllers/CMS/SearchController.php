<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repository\Interface\IUserRepository;
use Illuminate\View\View;

class SearchController extends Controller
{
    protected IUserRepository $userRepository;

    public function __construct
    (
        IUserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get result User by name
     * @return View
     * */
    public function searchUserByName(): View
    {
        $users = $this->userRepository->search();
        return view('search_user', compact('users'));
    }
}
