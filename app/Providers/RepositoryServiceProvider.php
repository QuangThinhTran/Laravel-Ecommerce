<?php

namespace App\Providers;

use App\Repository\CommentRepository;
use App\Repository\Interface\ICommentRepository;
use App\Repository\Interface\IPostRepository;
use App\Repository\Interface\IUserRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register Service
     *
     * @return void
     * */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IPostRepository::class, PostRepository::class);
        $this->app->bind(ICommentRepository::class, CommentRepository::class);
    }
}