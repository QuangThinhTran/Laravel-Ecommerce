<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repository\Interface\IPostRepository;

class DashboardController extends Controller
{
    protected IPostRepository $postRepository;

    public function __construct
    (
        IPostRepository $postRepository
    )
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->index();

        return view('dashboard.index', compact('posts'));
    }
}
