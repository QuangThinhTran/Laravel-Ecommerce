<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repository\Interface\IPostRepository;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected IPostRepository $postRepository;

    public function __construct
    (
        IPostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    /**
     * Get view dashboard index
     * @return View
     * */
    public function index()
    {
        $posts = $this->postRepository->index();

        return view('dashboard.index', compact('posts'));
    }
}
