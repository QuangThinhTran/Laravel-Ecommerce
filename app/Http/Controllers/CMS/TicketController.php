<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Repository\Interface\ITicketRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TicketController extends Controller
{
    protected ITicketRepository $reportRepository;

    public function __construct
    (
        ITicketRepository $reportRepository
    ) {
        $this->reportRepository = $reportRepository;
    }

    public function create(ReportRequest $request): JsonResponse
    {
        try {
            $input = $request->all();

            $this->reportRepository->create($input);

            return response()->json([
                'result' => true,
                'message' => 'Create Successful',
                'status_code' => ResponseAlias::HTTP_CREATED
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, ReportRequest $request): JsonResponse
    {
        try {
            $input = $request->all();

            $this->reportRepository->update($id, $input);

            return response()->json([
                'result' => true,
                'message' => 'Update Successful',
                'status_code' => ResponseAlias::HTTP_CREATED
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $this->reportRepository->delete($id);

            return response()->json([
                'result' => true,
                'message' => 'Delete Successful',
                'status_code' => ResponseAlias::HTTP_CREATED
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
