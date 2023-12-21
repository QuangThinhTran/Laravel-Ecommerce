<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repository\Interface\IUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    protected IUserRepository $userRepository;

    public function __construct
    (
        IUserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $input = $request->all();

            $user = $this->userRepository->register($input);

            if (is_null($user)) {
                return response()->json([
                    'message' => 'Register failed',
                ], ResponseAlias::HTTP_OK);
            }

            $access_token = $user->createToken('Bearer')->plainTextToken;

            return response()->json([
                'user' => $user,
                'access_token' => $access_token,
                'token_type' => 'Bearer',
                'status_code' => ResponseAlias::HTTP_OK
            ],ResponseAlias::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $input = $request->all();

            $user = $this->userRepository->login($input);
            if (!$user) {
                return response()->json([
                    'message' => 'Login failed',
                ], ResponseAlias::HTTP_OK);
            }

            $access_token = $user->createToken('Bearer')->plainTextToken;

            return response()->json([
                'user' => $user,
                'access_token' => $access_token,
                'token_type' => 'Bearer',
                'status_code' => ResponseAlias::HTTP_OK
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
