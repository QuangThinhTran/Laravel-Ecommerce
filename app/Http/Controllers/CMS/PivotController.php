<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class PivotController extends Controller
{
    protected Authenticatable $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function follow($id): void
    {
        $this->user->followings()->attach($id);
    }

    public function unfollow($id): void
    {
        $this->user->followings()->detach($id);
    }

    public function like($id): void
    {
        $this->user->like()->attach($id);
    }

    public function unlike($id): void
    {
        $this->user->like()->detach($id);
    }

    public function saved($id): void
    {
        $this->user->bookmarks()->attach($id);
    }

    public function unsaved($id): void
    {
        $this->user->bookmarks()->detach($id);
    }
}
