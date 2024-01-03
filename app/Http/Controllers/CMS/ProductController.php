<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\ProductRequest;
use App\Repository\Interface\ITermRepository;
use App\Repository\Interface\IAttributeRepository;
use App\Repository\Interface\ICategoryRepository;
use App\Repository\Interface\IProductRepository;
use App\Services\ItemService;
use App\Services\PivotService;
use App\Services\TermService;
use App\Util;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductController extends Controller
{
    use Util;

    protected ICategoryRepository $categoryRepository;
    protected IProductRepository $productRepository;
    protected IAttributeRepository $attributeRepository;
    protected ITermRepository $attributeChildRepository;
    protected PivotService $pivotService;
    protected ItemService $itemService;

    public function __construct
    (
        ICategoryRepository $categoryRepository,
        IProductRepository $productRepository,
        IAttributeRepository $attributeRepository,
        ITermRepository $attributeChildRepository,
        PivotService $pivotService,
        ItemService $itemService
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
        $this->pivotService = $pivotService;
        $this->attributeChildRepository = $attributeChildRepository;
        $this->itemService = $itemService;
    }

    /**
     * Get view list products
     * @return View | JsonResponse
     * */
    public function create(): View|JsonResponse
    {
        try {
            $categories = $this->categoryRepository->all();
            $products = $this->productRepository->getProductByUser();
            $attributes = $this->attributeRepository->all();
            return view('products.list', compact('categories', 'products', 'attributes'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create product
     * @param ProductRequest $request
     * @return RedirectResponse | JsonResponse
     * */
    public function store(ProductRequest $request): RedirectResponse|JsonResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();

            $product = $this->productRepository->create($input);
            self::uploadImages($request, $product['id']);

            $price_items = $this->itemService->getArrayItems($input['price_items']);
            $this->pivotService->addTermToProduct($product['id'], $input['terms'], $price_items);

            DB::commit();
            return back()->with('infor', 'Product created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get detail Product by id
     * @param $id
     * @return RedirectResponse | JsonResponse
     * */
    public function detail($id): RedirectResponse|JsonResponse
    {
        try {
            $product = $this->productRepository->find($id);
            return redirect()->route('home.index', compact('product'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update Product
     * @param $id
     * @param Request $request
     * @return RedirectResponse | JsonResponse
     * */
    public function update($id, Request $request): RedirectResponse|JsonResponse
    {
        try {
            $input = $request->all();

            $this->productRepository->update($id, $input);
            return redirect()->route('home.index')->with('infor', 'Not found');
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete Product
     * @param $id
     * @return RedirectResponse | JsonResponse
     * */
    public function delete($id): RedirectResponse|JsonResponse
    {
        try {
            $this->productRepository->delete($id);
            return redirect()->route('home.index');
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Restore Product
     * @param $id
     * @return RedirectResponse | JsonResponse
     * */
    public function restore($id): RedirectResponse|JsonResponse
    {
        try {
            $this->productRepository->restore($id);
            return redirect()->route('home.index');
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
