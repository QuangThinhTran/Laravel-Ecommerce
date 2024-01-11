<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Repository\Interface\ICommentRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CommentController extends Controller
{
    protected ICommentRepository $commentRepository;

    public function __construct
    (
        ICommentRepository $commentRepository
    ) {
        $this->commentRepository = $commentRepository;
    }

    public function create(CommentRequest $request): JsonResponse
    {
        try {
            $input = $request->all();

            $this->commentRepository->create($input);
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

    public function update($id, CommentRequest $request): JsonResponse
    {
        try {
            $input = $request->all();

            $this->commentRepository->update($id, $input);
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
            $this->commentRepository->delete($id);
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
