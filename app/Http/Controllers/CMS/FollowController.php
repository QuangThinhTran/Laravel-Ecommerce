<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        $auth = Auth::user();
        if (isset($auth)) {
            $follower = auth()->user();
            $follower->followings()->attach($user);
            return back();
        }
        return view('login');
    }

    public function unfollow(User $user)
    {
        $auth = Auth::user();
        if (isset($auth)) {
            $follower = auth()->user();
            $follower->followings()->detach($user);
            return back();
        }
        return view('login');
    }
}
