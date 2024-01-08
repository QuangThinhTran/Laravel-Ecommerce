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
     * Attach newly created employee to the merchant
     * @param User $user The data for creating the new employee
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
     * Attach newly created Term to a Product with corresponding price items
     * @param mixed $id The ID of the Product to which the terms will be attached
     * @param array $terms An array of Term IDs to attach
     * @param array $price_items An array of prices corresponding to each Term
     * @return void
     * */
    public function addTermToProduct(mixed $id, array $terms, array $price_items): void
    {
        $product = $this->productRepository->find($id);

        foreach ($terms as $key => $term) {
            $product->terms()->attach($term, ['price' => $price_items[$key]]);
        }
    }

    /**
     * Attach newly created Products to Cart with quantities
     * @param mixed $id The ID of the Cart to which the products will be attached
     * @param array $products An array of Product IDs to attach
     * @param array $quantity_products An array of quantities corresponding to each Product
     * @return void
     * */
    public function addProductsToCart(mixed $id, array $products, array $quantity_products): void
    {
        $carts = $this->cartRepository->detail($id);

        foreach ($products as $key => $product) {
            $carts->listProducts()->attach($product, ['quantity' => $quantity_products[$key]]);
        }
    }

    /**
     * Create a new Products records within Order Detail
     * @param mixed $id The ID of the Order to which the products will be added
     * @param array|null $products_code An array of product codes
     * @param array|null $products_name An array of product names
     * @param array|null $products_price An array of product prices
     * @param array|null $products_quantity An array of product quantities
     * @return void
     */
    public function addProductsToOrderDetail(mixed $id, ?array $products_code, ?array $products_name, ?array $products_price, ?array $products_quantity): void
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
     * Create new Terms records within Order Detail
     * @param mixed $id The ID of the Order to which the terms will be added
     * @param array|null $terms_price An array of term prices
     * @param array|null $terms_name An array of term names
     * @return void
     */
    public function addTermsToOrderDetail(mixed $id, ?array $terms_price, ?array $terms_name): void
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