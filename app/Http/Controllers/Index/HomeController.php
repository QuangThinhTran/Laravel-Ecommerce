<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repository\Interface\IPostRepository;
use App\Repository\Interface\IUserRepository;
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

    public function index()
    {
        try {
            $posts = $this->postRepository->all();
            $users = $this->userRepository->all();

            return response()->json([
                'result' => [$posts, $users],
                'statusCode' => ResponseAlias::HTTP_OK
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
