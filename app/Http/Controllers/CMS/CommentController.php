<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Repository\Interface\ICommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected ICommentRepository $commentRepository;

    public function __construct
    (
        ICommentRepository $commentRepository
    )
    {
        $this->commentRepository = $commentRepository;
    }

    public function addComment(CommentRequest $request)
    {
        $input = $request->all();
        $this->commentRepository->add($input);
        return back();
    }
}