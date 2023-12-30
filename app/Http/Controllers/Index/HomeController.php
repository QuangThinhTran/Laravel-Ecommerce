<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repository\Interface\IPostRepository;
use App\Repository\Interface\IUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class HomeController extends Controller
{
    protected IPostRepository $postRepository;
    protected IUserRepository $userRepository;

    public function __construct
    (
        IPostRepository $postRepository,
        IUserRepository $userRepository
    ) {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Get home index
     * @return View | JsonResponse
     * */
    public function index(): View | JsonResponse
    {
        try {
            $posts = $this->postRepository->index();
            $users = $this->userRepository->index();
            return view('index', compact('posts', 'users'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
