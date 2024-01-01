<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class RedirectController extends Controller
{
    /**
     * Get view register User
     * @return View
     * */
    public function register(): View
    {
        return view('auth.register');
    }

    /**
     * Get view login User
     * @return View
     * */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * Get view not found
     * @return View
     * */
    public function notFound(): View
    {
        return view('errors.not_found');
    }

    /**
     * Get view index
     * @return View
     * */
    public function index(): View
    {
        return view('index');
    }

    /**
     * Get view products
     * @return View
     * */
    public function products(): View
    {
        return view('products.list');
    }
}