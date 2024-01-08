<?php

namespace App\Repository;

use App\Models\Comment;
use App\Models\CommentChild;
use App\Repository\Interface\ICommentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CommentRepository implements ICommentRepository
{
    /**
     * Create a new Comment record
     * @param array $data
     * @return Model|Collection
     * */
    public function add(array $data): Model|Collection
    {
        return Comment::create($data);
    }

    /**
     * Find a specific Comment record by ID with relationships
     * @param $id
     * @return Model|Collection
     * */
    public function find($id): Model|Collection
    {
        return Comment::with('user', 'post')->findOrFail($id);
    }

    /**
     *  Create a new CommentChild record
     * @param array $data
     * @return Model|Collection
     * */
    public function addChildComment(array $data): Model|Collection
    {
        return CommentChild::create($data);
    }
}