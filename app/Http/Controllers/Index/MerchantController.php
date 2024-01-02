<?php

namespace App\Http\Controllers\Index;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repository\Interface\IUserRepository;
use App\Services\PivotService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MerchantController extends Controller
{
    protected IUserRepository $userRepository;
    protected PivotService $pivotService;

    public function __construct
    (
        IUserRepository $userRepository,
        PivotService $pivotService
    ) {
        $this->userRepository = $userRepository;
        $this->pivotService = $pivotService;
    }

    /**
     * Merchant add employees
     * @param RegisterRequest $request
     * @return JsonResponse|RedirectResponse
     * */
    public function createEmployees(RegisterRequest $request): JsonResponse|RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();

            $users = $this->userRepository->register($input);
            $this->pivotService->addEmployee($users);
            DB::commit();

            return back()->with('infor', 'Add employees Successful');
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get Employees by Merchant
     * @return View|JsonResponse
     * */
    public function getEmployees(): View|JsonResponse
    {
        try {
            $employees = $this->userRepository->getUserByMerchant();
            return view('employees.list', compact('employees'));
        } catch (Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
