<?php

namespace App\Repository;

use App\Models\Post;
use App\Repository\Interface\IPostRepository;

class PostRepository implements IPostRepository
{
    public function index()
    {
        return Post::with('user', 'products', 'comments.user', 'comments.childComments.user')->orderByDesc('id')->paginate(5);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function detail($id)
    {
        return Post::with('user', 'products', 'comments.user', 'comments.childComments.user')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        return Post::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return Post::findOrFail($id)->delete();
    }

    public function restore($id)
    {
        return Post::findOrFail($id)->withTrashed()->restore();
    }
}