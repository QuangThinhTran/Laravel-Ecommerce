<?php

namespace App\Repository;

use App\Models\Comment;
use App\Repository\Interface\ICommentRepository;

class CommentRepository implements ICommentRepository
{
    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        return Comment::findOrFail($id);
    }

    public function getCommentByAction($action, $data)
    {
        return Comment::with('user', 'post.users')->where($action, $data)->get();
    }
}