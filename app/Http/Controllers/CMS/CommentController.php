<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Repository\Interface\ICommentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected ICommentRepository $commentRepository;

    public function __construct
    (
        ICommentRepository $commentRepository
    ) {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Create comment parent
     * @param CommentRequest $request
     * @return RedirectResponse
     * */
    public function addComment(CommentRequest $request): RedirectResponse
    {
        $input = $request->all();
        $this->commentRepository->add($input);
        return back();
    }

    /**
     * Create comment child
     * @param Request $request
     * @return RedirectResponse
     */
    public function addCommentChild(Request $request): RedirectResponse
    {
        $input = $request->all();
        $this->commentRepository->addChildComment($input);
        return back();
    }
}