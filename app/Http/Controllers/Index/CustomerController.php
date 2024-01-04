<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repository\Interface\ICartRepository;
use App\Repository\Interface\ITermRepository;
use App\Repository\Interface\IPostRepository;
use App\Repository\Interface\IProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerController extends Controller
{
    protected IPostRepository $postRepository;
    protected IProductRepository $productRepository;
    protected ITermRepository $termRepository;
    protected ICartRepository $cartRepository;

    public function __construct
    (
        IPostRepository $postRepository,
        IProductRepository $productRepository,
        ITermRepository $termRepository,
        ICartRepository $cartRepository
    ) {
        $this->postRepository = $postRepository;
        $this->productRepository = $productRepository;
        $this->termRepository = $termRepository;
        $this->cartRepository = $cartRepository;
    }

    /**
     * Get view index of Customer
     * @return View | JsonResponse
     * */
    public function index(): View|JsonResponse
    {
        try {
            $products = $this->productRepository->all();
            $terms = $this->termRepository->all();
            $posts = $this->postRepository->all();

            return view('customers.index', compact('products', 'terms', 'posts'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get view index of Customer
     * @return View | JsonResponse
     * */
    public function getProducts(): View|JsonResponse
    {
        try {
            $products = $this->productRepository->all();

            return view('products.list', compact('products'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get view list Carts
     * @return View|JsonResponse
     * */
    public function getCarts(): View|JsonResponse
    {
        try {
            $products = $this->productRepository->all();
            $carts = $this->cartRepository->getCartByUserIDAndStatus(auth()->id(), false);
            $terms = $this->termRepository->all();

            return view('carts.list', compact('carts', 'products', 'terms'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
