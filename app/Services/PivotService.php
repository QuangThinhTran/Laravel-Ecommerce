<?php

namespace App\Services;

use App\Models\User;
use App\Repository\Interface\ICartRepository;
use App\Repository\Interface\ICommentRepository;
use App\Repository\Interface\IProductRepository;
use Illuminate\Http\RedirectResponse;

class PivotService
{
    protected IProductRepository $productRepository;
    protected ICommentRepository $commentRepository;
    protected ICartRepository $cartRepository;

    public function __construct
    (
        IProductRepository $productRepository,
        ICommentRepository $commentRepository,
        ICartRepository $cartRepository
    ) {
        $this->productRepository = $productRepository;
        $this->commentRepository = $commentRepository;
        $this->cartRepository = $cartRepository;
    }

    /**
     * Feature follow user
     * @param User $user
     * @return void
     * */
    public function addEmployee(User $user): void
    {
        $merchant = auth()->user();
        if ($merchant instanceof User) {
            $merchant->employees()->attach($user);
        }
    }

    /**
     * Feature unfollow user
     * @param User $user
     * @return void
     * */
    public function unfollow(User $user)
    {
//        $follower = auth()->user();
//        $follower->followings()->detach($user);
//        return back();
    }

    /**
     * Attach AttributesChild to Product
     * @param $id
     * @param array $attributesChild
     * @return void
     * */
    public function addAttributesChildProduct($id, array $attributesChild): void
    {
        $product = $this->productRepository->find($id);
        foreach ($attributesChild as $attributeChild) {
            $product->attributesChild()->attach($attributeChild);
        }
    }

    /**
     * Attach Products to Cart
     * @param $id
     * @param array $products
     * @return void
     * */
    public function addProductsToCart($id, array $products): void
    {
        $carts = $this->cartRepository->detail($id);
        foreach ($products as $product) {
            $carts->listProducts()->attach($product);
        }
    }
}