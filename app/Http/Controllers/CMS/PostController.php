<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Repository\Interface\IPostRepository;
use App\Util;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{
    protected IPostRepository $postRepository;

    public function __construct
    (
        IPostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    public function index(): JsonResponse
    {
        try {
            $posts = $this->postRepository->index();

            return response()->json([
                'data' => $posts
            ]);
        } catch (Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();

            $this->postRepository->create($input);
            Util::uploadImage($request);
            DB::commit();

            return response()->json([
                'result' => true,
                'message' => 'Created Successful'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function detail($id): JsonResponse
    {
        try {
            $post = $this->postRepository->find($id);

            return response()->json([
                'data' => $post,
                'status_code' => ResponseAlias::HTTP_OK
            ]);
        } catch (Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, PostRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();

            $post = $this->postRepository->update($id, $input);
            Util::uploadImage($request);
            DB::commit();

            return response()->json([
                'data' => $post,
                'status_code' => ResponseAlias::HTTP_OK
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $this->postRepository->delete($id);

            return response()->json([
                'result' => true,
                'message' => 'Deleted Successful',
                'status_code' => ResponseAlias::HTTP_OK
            ]);
        } catch (Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
