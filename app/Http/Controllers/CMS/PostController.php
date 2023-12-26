<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Repository\Interface\IPostRepository;
use App\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{
    use Util;

    protected IPostRepository $postRepository;

    public function __construct
    (
        IPostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    public function create(PostRequest $request)
    {
        try {
            $input = $request->all();

            $this->postRepository->create($input);
            return redirect()->route('home.index')->with('success', 'Idea created Successfully');
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
            $post = $this->postRepository->detail($id);
            return response()->json([
                'data' => $post
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(Request $request)
    {
        try {
            $user = Auth::user();
            if (!isset($user)) {
                return view('errors.not_found');
            }
            $post = $this->postRepository->detail($request->id);
            if ($user['role_id'] == 1 || $post->user_id == $user['id'])
            {
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
