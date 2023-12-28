<?php

namespace App\Providers;

use App\Repository\AttributeRepository;
use App\Repository\CartRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\Interface\IAttributeRepository;
use App\Repository\Interface\ICartRepository;
use App\Repository\Interface\ICategoryRepository;
use App\Repository\Interface\ICommentRepository;
use App\Repository\Interface\IOrderRepository;
use App\Repository\Interface\IPostRepository;
use App\Repository\Interface\IProductRepository;
use App\Repository\Interface\IUserRepository;
use App\Repository\OrderRepository;
use App\Repository\PostRepository;
use App\Repository\ProductRepository;
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
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(ICommentRepository::class, CommentRepository::class);
        $this->app->bind(IAttributeRepository::class, AttributeRepository::class);
        $this->app->bind(ICartRepository::class, CartRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
    }
}