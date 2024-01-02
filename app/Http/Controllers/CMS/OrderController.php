<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Repository\Interface\ICartRepository;
use App\Repository\Interface\IOrderRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OrderController extends Controller
{
    protected ICartRepository $cartRepository;
    protected IOrderRepository $orderRepository;

    public function __construct
    (
        ICartRepository $cartRepository,
        IOrderRepository $orderRepository
    ) {
        $this->cartRepository = $cartRepository;
        $this->orderRepository = $orderRepository;
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
            $this->orderRepository->create($input);
            $this->cartRepository->updateStatus($input['cart_id'], $input['active']);
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
