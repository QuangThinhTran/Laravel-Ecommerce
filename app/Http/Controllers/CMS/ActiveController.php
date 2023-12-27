<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;

class ActiveController extends Controller
{
    public function follow(User $user): void
    {
        $follower = auth()->user();
        $follower->followings()->attach($user);
    }

    public function unfollow(User $user): void
    {
        $follower = auth()->user();
        $follower->followings()->detach($user);
    }

    public function like(Post $post): void
    {
        $user = auth()->user();
        $user->like()->attach($post);
    }

    public function unlike(Post $post): void
    {
        $user = auth()->user();
        $user->like()->detach($post);
    }
}
