<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repository\Interface\IUserRepository;

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

    public function searchUserByName()
    {
        $users = $this->userRepository->search();
        return view('search_user', compact('users'));
    }
}
