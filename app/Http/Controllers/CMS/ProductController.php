<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\ProductRequest;
use App\Repository\Interface\IAttributeRepository;
use App\Repository\Interface\ICategoryRepository;
use App\Repository\Interface\IProductRepository;
use App\Services\PivotService;
use App\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductController extends Controller
{
    use Util;

    protected ICategoryRepository $categoryRepository;
    protected IProductRepository $productRepository;
    protected IAttributeRepository $attributeRepository;
    protected PivotService $pivotService;

    public function __construct
    (
        ICategoryRepository $categoryRepository,
        IProductRepository $productRepository,
        IAttributeRepository $attributeRepository,
        PivotService $pivotService
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
        $this->pivotService = $pivotService;
    }

    public function create()
    {
        try {
            $categories = $this->categoryRepository->all();
            $products = $this->productRepository->index();
            $attributes = $this->attributeRepository->index();

            return view('products.list', compact('categories', 'products', 'attributes'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();

            $product = $this->productRepository->create($input);
            if (empty($product)) {
                return back()->with('infor', 'Create Failed');
            }
            self::uploadImages($request, $product['id']);
            $this->pivotService->addAttributesProduct($product['id'], $input['attribute']);
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

    public function detail($id)
    {
        try {
            $product = $this->productRepository->find($id);
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

    public function update($id, Request $request)
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

    public function delete($id)
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

    public function restore($id)
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
