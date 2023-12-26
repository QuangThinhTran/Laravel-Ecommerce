<?php
namespace App\Repository;

use App\Models\Post;
use App\Repository\Interface\IPostRepository;

class PostRepository implements IPostRepository
{
    public function index()
    {
        return Post::with('user', 'comments.user')->paginate(5);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }
    public function detail($id)
    {
        return Post::find($id);
    }
    public function update($id, array $data)
    {
        return Post::find($id)->update($data);
    }
    public function delete($id)
    {
        return Post::findOrFail($id)->delete();
    }
    public function restore($id)
    {
        return Post::find($id)->withTrashed()->restore();
    }
}