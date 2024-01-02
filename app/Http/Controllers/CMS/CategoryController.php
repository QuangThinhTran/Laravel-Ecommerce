<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repository\Interface\ICategoryRepository;
use App\Repository\Interface\IProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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

    /**
     * Get View Create Category
     * @return View | JsonResponse
     * */
    public function index(): View|JsonResponse
    {
        try {
            $categories = $this->categoryRepository->all();
            $products = $this->productRepository->getProductByUser();

            return view('products.list', compact('categories', 'products'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create Category
     * @param CategoryRequest $request
     * @return RedirectResponse | JsonResponse
     * */
    public function create(CategoryRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $input = $request->all();
            $this->categoryRepository->create($input);
            return redirect()->route('home.index');
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get View Create Category
     * @param $id // Id category
     * @return RedirectResponse | JsonResponse
     * */
    public function delete($id): RedirectResponse|JsonResponse
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
