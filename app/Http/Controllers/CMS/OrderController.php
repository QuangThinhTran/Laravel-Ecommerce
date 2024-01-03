<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Repository\Interface\ICartRepository;
use App\Repository\Interface\IOrderRepository;
use App\Services\ItemService;
use App\Services\PivotService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OrderController extends Controller
{
    protected ICartRepository $cartRepository;
    protected IOrderRepository $orderRepository;
    protected PivotService $pivotService;
    protected ItemService $itemService;

    public function __construct
    (
        ICartRepository $cartRepository,
        IOrderRepository $orderRepository,
        PivotService $pivotService,
        ItemService $itemService
    ) {
        $this->cartRepository = $cartRepository;
        $this->orderRepository = $orderRepository;
        $this->pivotService = $pivotService;
        $this->itemService = $itemService;
    }

    /**
     * Get view list orders
     * @return View|JsonResponse
     * */
    public function index(): View|JsonResponse
    {
        try {
            $orders = $this->orderRepository->all();
            return view('orders.list', compact('orders'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get view list orders
     * @param OrderRequest $request
     * @return RedirectResponse|JsonResponse
     * */
    public function checkout(OrderRequest $request): RedirectResponse|JsonResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();

            $products_code = $this->itemService->getArrayItems($input['products_code']);
            $products_name = $this->itemService->getArrayItems($input['products_name']);
            $products_price = $this->itemService->getArrayItems($input['products_price']);
            $products_quantity = $this->itemService->getArrayItems($input['products_quantity']);

            $order = $this->orderRepository->create($input);
            $this->cartRepository->updateStatus($input['cart_id'], $input['active']);
            $this->pivotService->addProductsToOrder($order['id'], $products_code, $products_name, $products_price,
                $products_quantity);
            DB::commit();

            return redirect()->route('order.list');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
