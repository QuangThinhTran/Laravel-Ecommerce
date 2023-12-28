<?php

namespace App\Http\Controllers;

class RedirectController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function notFound()
    {
        return view('errors.not_found');
    }

    public function index()
    {
        return view('index');
    }

    public function products()
    {
        return view('products.list');
    }
}