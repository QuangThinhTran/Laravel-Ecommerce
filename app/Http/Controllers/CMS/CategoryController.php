<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repository\Interface\ICategoryRepository;
use App\Repository\Interface\IProductRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CategoryController extends Controller
{
    protected ICategoryRepository $categoryRepository;
    protected IProductRepository $productRepository;

    public function __construct
    (
        ICategoryRepository $categoryRepository,
        IProductRepository $productRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        try {
            $categories = $this->categoryRepository->all();
            $products = $this->productRepository->index();

            return view('products.list', compact('categories','products'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(CategoryRequest $request)
    {
        try {
            $input = $request->all();
            $product = $this->categoryRepository->create($input);
            if (empty($product)) {
                return back()->with('infor', 'Not found');
            }
            return redirect()->route('home.index');
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $this->categoryRepository->delete($id);
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
