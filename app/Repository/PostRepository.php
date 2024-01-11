<?php

namespace App\Repository;

use App\Models\Post;
use App\Repository\Interface\IPostRepository;

class PostRepository implements IPostRepository
{
    public function all()
    {
        return Post::with('user', 'images', 'comments.user', 'countComments')->paginate(10);
    }

    public function getPostsByUser()
    {
        return Post::with('user', 'images', 'reports', 'comments.user', 'countComments')->where('user_id', auth()->id())->paginate(10);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function find($id)
    {
        return Post::with('user', 'reports', 'comments.user', 'images')->findOrFail($id);
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