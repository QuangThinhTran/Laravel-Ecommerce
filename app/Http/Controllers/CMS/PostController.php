<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Repository\Interface\ICategoryRepository;
use App\Repository\Interface\IPostRepository;
use App\Util;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{
    use Util;

    protected ICategoryRepository $categoryRepository;
    protected IPostRepository $postRepository;

    public function __construct
    (
        ICategoryRepository $categoryRepository,
        IPostRepository $postRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * Get view list product to create
     * @return View | JsonResponse
     * */
    public function create(): View | JsonResponse
    {
        try {
            $categories = $this->categoryRepository->all();

            return view('products.list', compact('categories'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get view list product to create
     * @param $id // Id post
     * @return View | JsonResponse
     * */
    public function detail($id): View | JsonResponse
    {
        try {
            $post = $this->postRepository->detail($id);
            return view('posts.detail', compact('post'));
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get view list product to create
     * @param Request $request
     * @return View | JsonResponse
     * */
    public function delete(Request $request): View | RedirectResponse
    {
        try {
            $user = Auth::user();
            if (!isset($user)) {
                return view('errors.not_found');
            }
            $post = $this->postRepository->detail($request->id);
            if ($user['role_id'] == 1 || $post->user_id == $user['id']) {
                $this->postRepository->delete($request->id);
                return back()->with('infor', 'Delete Success');
            }
            return view('errors.not_found');
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
