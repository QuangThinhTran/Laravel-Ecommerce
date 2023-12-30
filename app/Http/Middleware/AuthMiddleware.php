<?php

namespace App\Http\Middleware;

use App\Constant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Handle an incoming request.
 *
 * @param Closure(Request): (Response) $next
 */
class AuthMiddleware
{
    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!isset($user)) {
            return redirect()->route('redirect.login');
        } else {
            if ($user['role_id'] == Constant::ROLE_ADMIN) {
                return $next($request);
            } else {
                return redirect()->route('not.found');
            }
        }
    }
}
