<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Repository\Interface\ICartRepository;
use App\Repository\Interface\IProductRepository;
use App\Repository\Interface\ITermRepository;
use App\Services\ItemService;
use App\Services\PivotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CartController extends Controller
{
    protected ICartRepository $cartRepository;
    protected PivotService $pivotService;
    protected IProductRepository $productRepository;
    protected ItemService $itemService;
    protected ITermRepository $termRepository;

    public function __construct
    (
        ICartRepository $cartRepository,
        IProductRepository $productRepository,
        ITermRepository $termRepository,
        PivotService $pivotService,
        ItemService $itemService
    ) {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->termRepository = $termRepository;
        $this->pivotService = $pivotService;
        $this->itemService = $itemService;
    }

    /**
     * Redirect view list carts
     * @return View| JsonResponse
     * */
    public function create(): View|JsonResponse
    {
        try {
            $carts = $this->cartRepository->all();
            $products = $this->productRepository->getProductByUser();
            $terms = $this->termRepository->all();

            return view('carts.list', compact('carts', 'products', 'terms'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create cart
     * @param CartRequest $request
     * @return RedirectResponse| JsonResponse
     * */
    public function store(CartRequest $request): RedirectResponse|JsonResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->input();

            $quantity_products = $this->itemService->getArrayItems($input['quantity_products']);
            $input['quantity'] = $this->itemService->sumArrayItems($quantity_products, null);
            $cart = $this->cartRepository->create($input);
            $this->pivotService->addProductsToCart($cart['id'], $input['product_id'], $quantity_products);
            DB::commit();

            return back()->with('infor', ' Cart created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Redirect view detail carts
     * @param $id
     * @return View| JsonResponse
     * */
    public function detail($id): View|JsonResponse
    {
        try {
            $cart = $this->cartRepository->detail($id);

            return view('carts.detail', compact('cart'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
