<?php

namespace App\Http\Controllers\Auth;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repository\Interface\IUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
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

    /**
     * Register account
     * @param RegisterRequest $request
     * @return RedirectResponse | JsonResponse
     * */
    public function register(RegisterRequest $request): RedirectResponse|JsonResponse
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

    /**
     * Login account
     * @param LoginRequest $request
     * @return  RedirectResponse | JsonResponse | View
     * */
    public function login(LoginRequest $request): RedirectResponse|JsonResponse|View
    {
        try {
            $input = $request->all();

            $user = $this->userRepository->login($input);

            if (!$user) {
                return back()->with('failed', 'Login Failed');
            }

            $user = auth::user();
            if ($user['role_id'] == Constant::ROLE_ADMIN) {
                return redirect()->route('dashboard.index');
            } else if ($user['role_id'] == Constant::ROLE_MERCHANT) {
                return redirect()->route('merchant.employees');
            } else if ($user['role_id'] == Constant::ROLE_EMPLOYEE) {
                return redirect()->route('merchant.employees');
            } else {
                return redirect()->route('customer.index', compact('user'));
            }
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Logout account
     * @return RedirectResponse
     * */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('home.index');
    }
}
