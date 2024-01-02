<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repository\Interface\IUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
     * @return View | JsonResponse
     * */
    public function detail($id): View|JsonResponse
    {
        try {
            $user = $this->userRepository->find($id);
            $paginatedPosts = $user->posts()->paginate(5);
            $users = $this->userRepository->all();
            return view('profile', compact('user', 'users', 'paginatedPosts'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}