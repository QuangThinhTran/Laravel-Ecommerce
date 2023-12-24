<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repository\Interface\IUserRepository;
use Illuminate\Http\Request;
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

    public function register(RegisterRequest $request)
    {
        try {
            $input = $request->all();

            $user = $this->userRepository->register($input);

            if (is_null($user)) {
                return back()->with('errors', 'Register Failed');
            }

            $this->userRepository->login($input);

            return redirect()->route('home.index', compact('user'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $input = $request->all();

            $user = $this->userRepository->login($input);
            if (!$user) {
                return back()->with('failed', 'Login Failed');
            }

//            $access_token = $user->createToken('Bearer')->plainTextToken;

            return redirect()->route('home.index', compact('user'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }
}
