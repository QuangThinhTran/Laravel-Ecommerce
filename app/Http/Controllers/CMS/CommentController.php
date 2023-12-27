<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Repository\Interface\ICommentRepository;
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

    public function create(CommentRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $input = $request->all();

            $comment = $this->commentRepository->create($input);
            if (empty($comment)) {
                return response()->json([
                    'result' => false,
                    'message' => 'Create failed',
                ], ResponseAlias::HTTP_OK);
            }
            return response()->json([
                'result' => true,
                'message' => 'Create Success',
            ], ResponseAlias::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
