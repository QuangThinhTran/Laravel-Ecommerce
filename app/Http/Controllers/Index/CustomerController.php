<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repository\Interface\IAttributeChildRepository;
use App\Repository\Interface\IPostRepository;
use App\Repository\Interface\IProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerController extends Controller
{
    protected IPostRepository $postRepository;
    protected IProductRepository $productRepository;
    protected IAttributeChildRepository $attributeChildRepository;

    public function __construct
    (
        IPostRepository $postRepository,
        IProductRepository $productRepository,
        IAttributeChildRepository $attributeChildRepository
    ) {
        $this->postRepository = $postRepository;
        $this->productRepository = $productRepository;
        $this->attributeChildRepository = $attributeChildRepository;
    }

    /**
     * Get view index of Customer
     * @return View | JsonResponse
     * */
    public function index(): View|JsonResponse
    {
        try {
            $products = $this->productRepository->all();
            $attribute_child = $this->attributeChildRepository->all();
            $posts = $this->postRepository->all();
            return view('customers.index', compact('products', 'attribute_child', 'posts'));
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
}
