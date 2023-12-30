<?php

namespace App\Repository;

use App\Models\Post;
use App\Repository\Interface\IPostRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostRepository implements IPostRepository
{
    /**
     * Get list Posts and paginate
     * @return LengthAwarePaginator
     * */
    public function index()
    {
        return Post::with('user', 'products', 'comments.user',
            'comments.childComments.user')->orderByDesc('id')->paginate(5);
    }

    /**
     * Create Posts
     * @param array $data
     * @return Model|Collection
     * */
    public function create(array $data): Model|Collection
    {
        return Post::create($data);
    }

    /**
     * Detail Posts
     * @param $id
     * @return Model|Collection
     * */
    public function detail($id): Model|Collection
    {
        return Post::with('user', 'products', 'comments.user', 'comments.childComments.user')->findOrFail($id);
    }

    /**
     * Update Posts
     * @param $id
     * @param array $data
     * @return bool
     * */
    public function update($id, array $data): bool
    {
        return Post::findOrFail($id)->update($data);
    }

    /**
     * Delete Posts
     * @param $id
     * @return bool|null
     * */
    public function delete($id): bool|null
    {
        return Post::findOrFail($id)->delete();
    }

    /**
     * Restore Posts
     * @param $id
     * @return bool
     * */
    public function restore($id): bool
    {
        return Post::findOrFail($id)->withTrashed()->restore();
    }
}