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
     * Create Products to Order Detail
     * @param $id
     * @param array|null $products_code
     * @param array|null $products_name
     * @param array|null $products_price
     * @param array|null $products_quantity
     * @return void
     */
    public function addProductsToOrderDetail($id, ?array $products_code, ?array $products_name, ?array $products_price, ?array $products_quantity): void
    {
        if (is_null($products_code) || is_null($products_name) || is_null($products_price) || is_null($products_quantity)) {
            return;
        }
        $order = $this->orderRepository->detail($id);

        foreach ($products_code as $key => $product_code) {
            $data = [
                'product_code' => $product_code,
                'product_name' => $products_name[$key],
                'product_price' => $products_price[$key],
                'quantity' => $products_quantity[$key],
                'order_id' => $order['id'],
            ];
            $this->orderRepository->createOrderDetailProducts($data);
        }
    }

    /**
     * Create Terms to Order Detail
     * @param $id
     * @param array|null $terms_price
     * @param array|null $terms_name
     * @return void
     */
    public function addTermsToOrderDetail($id, ?array $terms_price, ?array $terms_name): void
    {
        if ($terms_price == null || $terms_name == null) {
            return;
        }
        $order = $this->orderRepository->detail($id);

        foreach ($terms_name as $key => $term_name) {
            $data = [
                'term_name' => $term_name,
                'term_price' => $terms_price[$key],
                'order_id' => $order['id'],
            ];
            $this->orderRepository->createOrderDetailTerms($data);
        }
    }
}