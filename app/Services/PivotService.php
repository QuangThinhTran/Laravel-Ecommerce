<?php

namespace App\Services;

use App\Models\User;
use App\Repository\Interface\ICartRepository;
use App\Repository\Interface\ICommentRepository;
use App\Repository\Interface\IOrderRepository;
use App\Repository\Interface\IProductRepository;
use Illuminate\Http\RedirectResponse;

class PivotService
{
    protected IProductRepository $productRepository;
    protected ICommentRepository $commentRepository;
    protected ICartRepository $cartRepository;
    protected IOrderRepository $orderRepository;

    public function __construct
    (
        IProductRepository $productRepository,
        ICommentRepository $commentRepository,
        ICartRepository $cartRepository,
        IOrderRepository $orderRepository
    ) {
        $this->productRepository = $productRepository;
        $this->commentRepository = $commentRepository;
        $this->cartRepository = $cartRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Feature add employees for User
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
     * Attach data Terms to Product
     * @param $id
     * @param array $terms
     * @param array $price_items
     * @return void
     * */
    public function addTermToProduct($id, array $terms, array $price_items): void
    {
        $product = $this->productRepository->find($id);

        foreach ($terms as $key => $term) {
            $product->terms()->attach($term, ['price' => $price_items[$key]]);
        }
    }

    /**
     * Attach data Products to Cart
     * @param $id
     * @param array $products
     * @param array $quantity_products
     * @return void
     * */
    public function addProductsToCart($id, array $products, array $quantity_products): void
    {
        $carts = $this->cartRepository->detail($id);

        foreach ($products as $key => $product) {
            $carts->listProducts()->attach($product, ['quantity' => $quantity_products[$key]]);
        }
    }

    /**
     * Attach data Products to Order
     * @param $id
     * @param array $products
     * @return void
     * */
    public function addProductsToOrder($id, array $products): void
    {
        $order = $this->orderRepository->detail($id);
        foreach ($products as $product) {
            $order->listOrderDetail()->attach($product);
        }
    }
}