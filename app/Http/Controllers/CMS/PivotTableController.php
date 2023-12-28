<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use App\Repository\Interface\IAttributeRepository;
use App\Repository\Interface\ICommentRepository;
use App\Repository\Interface\IPostRepository;
use App\Repository\Interface\IProductRepository;
use Illuminate\Http\Request;

class PivotTableController extends Controller
{
    protected IPostRepository $postRepository;
    protected IProductRepository $productRepository;
    protected ICommentRepository $commentRepository;
    protected IAttributeRepository $attributeRepository;

    public function __construct
    (
        IPostRepository $postRepository,
        IProductRepository $productRepository,
        ICommentRepository $commentRepository,
        IAttributeRepository $attributeRepository
    ) {
        $this->postRepository = $postRepository;
        $this->productRepository = $productRepository;
        $this->commentRepository = $commentRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function follow(User $user)
    {
        $follower = auth()->user();
        $follower->followings()->attach($user);
        return back();
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();
        $follower->followings()->detach($user);
        return back();
    }
}
